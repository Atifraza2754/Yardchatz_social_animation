// Handle audio play
function toggleAudio(imageElement) {
    var audioSrc = imageElement.getAttribute("data-audio"); // Get the audio file path from the image's data-audio attribute
    var audioPlayer = document.getElementById("audioPlayer"); // Get the audio player element
    var audioSource = document.getElementById("audioSource"); // Get the audio source element
    var audioId = imageElement.getAttribute("data-id"); // yeh add karo

    // If the source has changed, update it
    if (audioSource.src !== audioSrc) {
        audioSource.src = audioSrc; // Set the audio player's source to the selected audio file
        audioPlayer.load(); // Reload the audio player with the new audio file
    }

    // If the audio is currently paused, play it, otherwise pause it
    if (audioPlayer.paused) {
        audioPlayer.play(); // Play the audio
    } else {
        audioPlayer.pause(); // Pause the audio
    }
}
// end Handle audio play

// Handle video fetching in grid
document.addEventListener("DOMContentLoaded", function () {
    const videoCards = document.querySelectorAll(".video-card");
    const menuButtons = document.querySelectorAll(".menu-btn");

    videoCards.forEach((card) => {
        card.addEventListener("click", function (e) {
            if (
                e.target.closest(".menu-btn") ||
                e.target.closest(".dropdown-menu")
            ) {
                return;
            }
        });
    });

    menuButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.stopPropagation();

            document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                if (menu !== this.nextElementSibling) {
                    menu.style.display = "none";
                }
            });

            const dropdownMenu = this.nextElementSibling;
            if (dropdownMenu.style.display === "block") {
                dropdownMenu.style.display = "none";
            } else {
                dropdownMenu.style.display = "block";
            }
        });
    });

    document.addEventListener("click", function (e) {
        if (
            !e.target.closest(".menu-btn") &&
            !e.target.closest(".dropdown-menu")
        ) {
            document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                menu.style.display = "none";
            });
        }
    });

    document.querySelectorAll(".menu-item").forEach((item) => {
        item.addEventListener("click", function (e) {
            e.stopPropagation();

            const action = this.textContent;
            const videoTitle =
                this.closest(".video-card").querySelector(
                    ".video-title"
                ).textContent;
            alert(`${action} for video: ${videoTitle}`);

            this.closest(".dropdown-menu").style.display = "none";
        });
    });

    function handleResize() {
        const width = window.innerWidth;
    }

    handleResize();
    window.addEventListener("resize", handleResize);
});
//end handle video

//Gallery Sections
document.addEventListener("DOMContentLoaded", () => {
    // Section elements
    const sections = {
        audio: document.getElementById("normalAudio"),
        stills: document.getElementById("normalStills"),
        text: document.getElementById("normalText"),
        video: document.getElementById("normalVideos"),
    };

    // Flipbook flags
    let stillsFlipInitialized = false;
    let textFlipInitialized = false;

    // Show the selected section and hide others
    function showSection(key) {
        Object.entries(sections).forEach(([k, el]) => {
            if (k === key) {
                el.style.display = (k === 'audio' || k === 'video') ? 'grid' : 'block';
            } else {
                el.style.display = 'none';
            }
        });

        // Initialize flipbooks only when visible
        if (key === "stills" && !stillsFlipInitialized) {
            const stillsBook = document.getElementById("stillsBookExample");
            if (stillsBook) {
                const pageFlipStills = new St.PageFlip(stillsBook, {
                    width: 600,
                    height: 800,
                    size: "stretch",
                    showCover: false,
                    maxShadowOpacity: 0.5,
                    mobileScrollSupport: false,
                });
                pageFlipStills.loadFromHTML(document.querySelectorAll("#normalStills .page"));
                stillsFlipInitialized = true;
            }
        }

        if (key === "text" && !textFlipInitialized) {
            const textBook = document.getElementById("textBookExample");
            if (textBook) {
                const pageFlipText = new St.PageFlip(textBook, {
                    width: 600,
                    height: 800,
                    size: "stretch",
                    showCover: false,
                    maxShadowOpacity: 0.5,
                    mobileScrollSupport: false,
                });
                pageFlipText.loadFromHTML(document.querySelectorAll("#normalText .page"));
                textFlipInitialized = true;
            }
        }
    }

    // Assign section click handlers
    document.querySelector(".audio-section").onclick = () => showSection("audio");
    document.querySelector(".stills-section").onclick = () => showSection("stills");
    document.querySelector(".text-section").onclick = () => showSection("text");
    document.querySelector(".video-section").onclick = () => showSection("video");

    // Optional: show default section on page load
    // showSection("audio");
});
//end Gallery Sections


// show favorites videos on click on favorite icon
let showingFavorites = false;

function toggleFavorite() {
    const favoriteHeader = document.getElementById("favoriteHeader");
    const favoriteWrapper = document.getElementById("favoriteVideosWrapper");
    const normalVideos = document.getElementById("normalVideos");

    if (!showingFavorites) {
        fetchFavoriteVideos();
    } else {
        favoriteWrapper.style.display = "none";
        normalVideos.style.display = "none";
        favoriteHeader.style.display = "none";
    }
    showingFavorites = !showingFavorites;
}

function fetchFavoriteVideos() {
    fetch("/fetch-favorites")
        .then((response) => response.json())
        .then((data) => {
            const favoriteVideosContainer =
                document.getElementById("favoriteVideos");
            const favoriteWrapper = document.getElementById(
                "favoriteVideosWrapper"
            );
            const favoriteHeader = document.getElementById("favoriteHeader");
            const noFavoritesMessage =
                document.getElementById("noFavoritesMessage");

            // Always clear previous
            favoriteVideosContainer.innerHTML = "";
            noFavoritesMessage.style.display = "none";

            if (data.status) {
                if (data.videos.length > 0) {
                    // Agar videos hain
                    data.videos.forEach((video) => {
                        const videoCard = `
                            <div class="video-card">
                                <div class="thumbnail-container" style="position: relative;">
                                    <video width="100%" height="200" controls preload="metadata" style="border-radius: 6px;">
                                        <source src="${
                                            video.video_path
                                        }" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <span class="duration">0:00</span>
                                </div>
                                <div class="video-info">
                                    <h3 class="video-title">${video.title}</h3>
                                    <div class="video-meta">
                                        <span class="views">0 views</span>
                                        <span class="dot">•</span>
                                        <span class="time">${timeAgo(
                                            new Date(video.created_at)
                                        )}</span>
                                    </div>
                                </div>
                            </div>
                        `;
                        favoriteVideosContainer.innerHTML += videoCard;
                    });
                } else {
                    // Agar koi video nahi hai
                    noFavoritesMessage.style.display = "block";
                }

                document.getElementById("normalVideos").style.display = "none";
                favoriteWrapper.style.display = "block";
                favoriteHeader.style.display = "block";
            }
        })
        .catch((error) => {
            console.error("Error fetching favorite videos:", error);
        });
}

//end favorite

//text buttons script

// Function to apply the selected color
function applyTextColor(color) {
    document.documentElement.style.setProperty("--text-color", color);
    localStorage.setItem("savedTextColor", color);
}

// Function to apply the selected font
function applyTextFont(font) {
    document.documentElement.style.setProperty("--font-family", font);
    localStorage.setItem("savedTextFont", font);
}

// Function to apply the selected font size
function applyTextSize(size) {
    document.documentElement.style.setProperty("--font-size", size);
    localStorage.setItem("savedTextSize", size);
}

// Toggle dropdown visibility
function toggleDropdown(type) {
    const colorDropdown = document.getElementById("colorDropdown");
    const fontDropdown = document.getElementById("fontDropdown");
    const sizeDropdown = document.getElementById("sizeDropdown");

    colorDropdown.style.display = "none";
    fontDropdown.style.display = "none";
    sizeDropdown.style.display = "none";

    // Show the selected dropdown
    if (type === "color") {
        colorDropdown.style.display = "block";
    } else if (type === "font") {
        fontDropdown.style.display = "block";
    } else if (type === "size") {
        sizeDropdown.style.display = "block";
    }
}

window.addEventListener("DOMContentLoaded", () => {
    const savedColor = localStorage.getItem("savedTextColor");
    const savedFont = localStorage.getItem("savedTextFont");
    const savedSize = localStorage.getItem("savedTextSize");

    if (savedColor) {
        applyTextColor(savedColor);
    }

    if (savedFont) {
        applyTextFont(savedFont);
    }

    if (savedSize) {
        applyTextSize(savedSize);
    }
});
//end text buttons script

/*  Audio Comment */

function timeAgo(dateString) {
    const now = new Date();
    const commentDate = new Date(dateString);
    const seconds = Math.floor((now - commentDate) / 1000);

    if (seconds < 60) return "Just now";
    const minutes = Math.floor(seconds / 60);
    if (minutes < 60) return `${minutes} minute${minutes > 1 ? "s" : ""} ago`;
    const hours = Math.floor(minutes / 60);
    if (hours < 24) return `${hours} hour${hours > 1 ? "s" : ""} ago`;
    const days = Math.floor(hours / 24);
    return `${days} day${days > 1 ? "s" : ""} ago`;
}

function openCommentPanel(audioId) {
    const panel = document.getElementById("commentPanel");
    const commentInput = document.getElementById("commentInput");

    // Set the audio_id in the comment input to maintain state
    commentInput.setAttribute("data-audio-id", audioId);

    // Show the comment panel smoothly
    panel.classList.add("open");

    // Fetch and display the comments in real-time
    fetchComments(audioId);
}

function closeCommentPanel() {
    const panel = document.getElementById("commentPanel");

    // Remove the class to smoothly close the modal
    panel.classList.remove("open");
}

function submitAudioComment() {
    const commentInput = document.getElementById("commentInput");
    const audioId = commentInput.getAttribute("data-audio-id"); // Get the audio_id
    const comment = commentInput.value.trim();

    if (!comment) {
        alert("Please write a comment.");
        return;
    }

    fetch("/submit-audio-comment", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            audio_id: audioId,
            comment: comment,
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            document.getElementById("commentInput").value = "";
            fetchComments(audioId);
            loadAudioCommentsCount(audioId);
        })
        .catch((err) => console.error(err));
}

function loadAudioCommentsCount(audioId) {
    fetch(`/get-audio-comments-count?audio_id=${audioId}`)
        .then((res) => res.json())
        .then((data) => {
            const commentCountEl = document.getElementById(
                `commentCount-${audioId}`
            );
            if (commentCountEl) {
                commentCountEl.innerText = `${data.comment_count} ${
                    data.comment_count !== 1 ? "" : ""
                }`;
            }
        })
        .catch((err) => console.error(err));
}

function fetchComments(audioId) {
    fetch(`/get-audio-comments?audio_id=${audioId}`)
        .then((response) => response.json())
        .then((data) => {
            const commentsList = document.getElementById("commentsList");
            commentsList.innerHTML = "";

            if (data.comments && data.comments.length > 0) {
                data.comments.forEach((comment) => {
                    const commentElement = document.createElement("div");
                    commentElement.classList.add("comment-card");

                    // Correct the path to profile picture by combining it with the base URL
                    const profilePictureUrl = comment.user.profile_picture 
                        ? `/${comment.user.profile_picture}` 
                        : "path/to/default-avatar.png"; // Fallback image

                    commentElement.innerHTML = `
                        <div class="comment-header">
                            <div class="comment-user-info">
                                <img src="${profilePictureUrl}" alt="${comment.user.name}" class="comment-user-avatar">
                                <strong class="comment-username">${comment.user.name}</strong>
                            </div>
                        </div>
                        <div class="comment-body">${comment.comment}</div>
                        <div class="comment-footer">
                            <span class="comment-time">${timeAgo(comment.created_at)}</span>
                        </div>`;
                    commentsList.appendChild(commentElement);
                });
            } else {
                commentsList.innerHTML = "<p>No comments available.</p>";
            }
        })
        .catch((error) => {
            console.error("Error fetching comments:", error);
        });
}


/*  Audio Comment */

/*  Share audio */

function shareAudioContent(audioId) {
    const baseUrl = window.location.origin;
    const audioUrl = `${baseUrl}/share-audio/${audioId}`; // Make sure this matches your route

    document.getElementById("shareAudioLink").value = audioUrl;

    // Set share links
    document.getElementById(
        "whatsappShare"
    ).href = `https://api.whatsapp.com/send?text=Check this audio: ${audioUrl}`;
    document.getElementById(
        "facebookShare"
    ).href = `https://www.facebook.com/sharer/sharer.php?u=${audioUrl}`;
    document.getElementById(
        "twitterShare"
    ).href = `https://twitter.com/intent/tweet?url=${audioUrl}`;
    document.getElementById(
        "linkedinShare"
    ).href = `https://www.linkedin.com/shareArticle?mini=true&url=${audioUrl}`;

    // Show modal
    document.getElementById("AudioshareModal").style.display = "block";
}

function closeAudioShareModal() {
    document.getElementById("AudioshareModal").style.display = "none";
}

    // Optional: Click outside to close
    window.onclick = function (event) {
        const modal = document.getElementById("AudioshareModal");
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };

function copyAudioLink() {
    const linkInput = document.getElementById("shareAudioLink");
    linkInput.select();
    linkInput.setSelectionRange(0, 99999);
    document.execCommand("copy");
    alert("Link copied to clipboard!");
}

/*  end Share audio  */

// Function to delete the audio via AJAX
let audioToDeleteId = null;

function openAudioDeleteModal(audioId) {
    audioToDeleteId = audioId;
    const modal = new bootstrap.Modal(
        document.getElementById("AudiodeleteModal")
    );
    modal.show(); // Open the modal
}


 document.getElementById("confirmAudioDeleteBtn")
        .addEventListener("click", function () {
            if (audioToDeleteId) {
                deleteAudio(audioToDeleteId);
            }
 });

function deleteAudio(audioId) {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    fetch(`/delete-audio/${audioId}`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                const audioCard = document.getElementById(
                    `audio-card-${audioId}`
                );
                if (audioCard) audioCard.remove();

                // Close modal
                const modal = bootstrap.Modal.getInstance(
                    document.getElementById("AudiodeleteModal")
                );
                modal.hide();

                location.reload();
            } else {
                alert("Failed to delete audio");
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("An error occurred while deleting the audio");
        });
}

// End delete the audio function

function likeStill(stillId) {
    fetch(`/like-still/${stillId}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.message === "Like added") {
                // Change to filled red heart
                document.getElementById(`likeIcon-${stillId}`).src =
                    "assets/img/likee.svg";
            } else {
                // Change back to default white heart
                document.getElementById(`likeIcon-${stillId}`).src =
                    "assets/img/white.png";
            }

            // Update the like count in real-time
            document.getElementById(`likeCount-${stillId}`).innerText =
                data.like_count;
        });
}

function openStillCommentPanel(stillId) {
    const panel = document.getElementById("stillcommentPanel");
    const commentInput = document.getElementById("stillcommentInput");

    // Set the still_id in the comment input to maintain state
    commentInput.setAttribute("data-still-id", stillId);

    // Show the comment panel smoothly
    panel.classList.add("open");

    // Fetch and display the comments in real-time
    fetchStillComments(stillId);
}

function closeStillCommentPanel() {
    const panel = document.getElementById("stillcommentPanel");

    // Remove the class to smoothly close the modal
    panel.classList.remove("open");
}

function submitStillComment() {
    const commentInput = document.getElementById("stillcommentInput");
    const stillId = commentInput.getAttribute("data-still-id"); // Get the still_id
    const comment = commentInput.value.trim();

    if (!comment) {
        alert("Please write a comment.");
        return;
    }

    fetch("/submit-still-comment", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            still_id: stillId,
            comment: comment,
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            document.getElementById("stillcommentInput").value = "";
            fetchStillComments(stillId);
        })
        .catch((err) => console.error(err));
}

function fetchStillComments(stillId) {
    fetch(`/get-still-comments?still_id=${stillId}`)
        .then((response) => response.json())
        .then((data) => {

            const commentsList = document.getElementById("stillcommentsList");
            commentsList.innerHTML = ""; // Clear any previous comments

            if (data.comments && data.comments.length > 0) {
                document.getElementById(`commentCount-${stillId}`).innerText = data.comments.length;

                data.comments.forEach((comment) => {
                    const commentElement = document.createElement("div");
                    commentElement.classList.add("comment-card");

                    // Correct the path to profile picture
                    const profilePictureUrl = comment.user.profile_picture
                        ? `/${comment.user.profile_picture}`
                        : "path/to/default-avatar.png"; // Fallback image

                    commentElement.innerHTML = `
                        <div class="comment-header">
                            <div class="comment-user-info">
                                <img src="${profilePictureUrl}" alt="${comment.user.name}" class="comment-user-avatar">
                                <strong class="comment-username">${comment.user.name}</strong>
                            </div>
                        </div>
                        <div class="comment-body">${comment.comment}</div>
                        <div class="comment-footer">
                            <span class="comment-time">${timeAgo(comment.created_at)}</span>
                        </div>`;

                    commentsList.appendChild(commentElement);
                });
            } else {
                commentsList.innerHTML = "<p>No comments available.</p>";
            }
        })
        .catch((error) => {
            console.error("Error fetching still comments:", error);
        });
}



/*  Share still */

function shareStillContent(stillId) {
    const baseUrl = window.location.origin;
    const stillUrl = `${baseUrl}/share-still/${stillId}`; // Make sure this matches your route

    document.getElementById('StillshareLink').value = stillUrl;

    // Set share links
    document.getElementById('whatsappShare').href = `https://api.whatsapp.com/send?still=Check this still: ${stillUrl}`;
    document.getElementById('facebookShare').href = `https://www.facebook.com/sharer/sharer.php?u=${stillUrl}`;
    document.getElementById('twitterShare').href = `https://twitter.com/intent/tweet?url=${stillUrl}`;
    document.getElementById('linkedinShare').href = `https://www.linkedin.com/shareArticle?mini=true&url=${stillUrl}`;

    // Show modal
    document.getElementById('StillshareModal').style.display = 'block';
}

function closeStillShareModal() {
    document.getElementById('StillshareModal').style.display = 'none';
}

// Optional: Click outside to close
window.onclick = function(event) {
    const modal = document.getElementById('StillshareModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}

function copyStillLink() {
    const linkInput = document.getElementById('StillshareLink');
    linkInput.select();
    linkInput.setSelectionRange(0, 99999);
    document.execCommand('copy');
    alert('Link copied to clipboard!');
}

/*  end Share still  */


/*  delete still  */

let deleteStillId = null;
function openStillDeleteModal(stillId) {
    deleteStillId = stillId;
    const deleteModal = new bootstrap.Modal(
        document.getElementById("stilldeleteModal")
    );
    deleteModal.show();
}


document.getElementById("confirmStillDeleteBtn")
    .addEventListener("click", function () {
        if (deleteStillId !== null) {
            fetch(`/delete-still/${deleteStillId}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        const stillCard = document.getElementById(
                            `still-wrapper-${deleteStillId}`
                        );
                        if (stillCard) stillCard.remove();

                        const deleteModal = bootstrap.Modal.getInstance(
                            document.getElementById("stilldeleteModal")
                        );
                        deleteModal.hide();

                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    } else {
                        alert("Failed to delete still.");
                    }
                });
        }
    });
/*   still JS END  */

/*  Text Js Sart with Like  */

function likeText(textId) {
    fetch(`/like-text/${textId}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.message === "Like added") {
                // Change to filled red heart
                document.getElementById(`likeIcon-${textId}`).src =
                    "assets/img/likee.svg";
            } else {
                // Change back to default white heart
                document.getElementById(`likeIcon-${textId}`).src =
                    "assets/img/white.png";
            }

            // Update the like count in real-time
            document.getElementById(`likeCount-${textId}`).innerText =
                data.like_count;
        });
}

function openTextCommentPanel(textId) {
    const panel = document.getElementById("textcommentPanel");
    const commentInput = document.getElementById("textcommentInput");

    commentInput.setAttribute("data-text-id", textId);

    panel.classList.add("open");

    fetchTextComments(textId);
}

function closeTextCommentPanel() {
    const panel = document.getElementById("textcommentPanel");

    panel.classList.remove("open");
}

function submitComment() {
    const commentInput = document.getElementById("textcommentInput");
    const textId = commentInput.getAttribute("data-text-id"); // Get the text_id
    const comment = commentInput.value.trim();

    if (!comment) {
        alert("Please write a comment.");
        return;
    }

    fetch("/submit-text-comment", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            text_id: textId,
            comment: comment,
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            document.getElementById("textcommentInput").value = "";
            fetchTextComments(textId);
        })
        .catch((err) => console.error(err));
}

function fetchTextComments(textId) {
    fetch(`/get-comments?text_id=${textId}`)
        .then((response) => response.json())
        .then((data) => {
            const commentsList = document.getElementById("textcommentsList");
            commentsList.innerHTML = ""; 

            if (data.comments && data.comments.length > 0) {
                document.getElementById(`commentCount-${textId}`).innerText = data.comments.length;

                data.comments.forEach((comment) => {
                    const commentElement = document.createElement("div");
                    commentElement.classList.add("comment-card");

                    const profilePictureUrl = comment.user.profile_picture
                        ? `/${comment.user.profile_picture}`
                        : "path/to/default-avatar.png"; 

                    commentElement.innerHTML = `
                        <div class="comment-header">
                            <div class="comment-user-info">
                                <img src="${profilePictureUrl}" alt="${comment.user.name}" class="comment-user-avatar">
                                <strong class="comment-username">${comment.user.name}</strong>
                            </div>
                        </div>
                        <div class="comment-body">${comment.comment}</div>
                        <div class="comment-footer">
                            <span class="comment-time">${timeAgo(comment.created_at)}</span>
                        </div>`;

                    commentsList.appendChild(commentElement);
                });
            } else {
                commentsList.innerHTML = "<p>No comments available.</p>";
            }
        })
        .catch((error) => {
            console.error("Error fetching text comments:", error);
        });
}

/* text comment end */

/*  Share text */
function shareContent(textId) {
    const baseUrl = window.location.origin;
    const textUrl = `${baseUrl}/share-text/${textId}`; // Make sure this matches your route

    document.getElementById("shareLink").value = textUrl;

    // Set share links
    document.getElementById(
        "whatsappShare"
    ).href = `https://api.whatsapp.com/send?text=Check this text: ${textUrl}`;
    document.getElementById(
        "facebookShare"
    ).href = `https://www.facebook.com/sharer/sharer.php?u=${textUrl}`;
    document.getElementById(
        "twitterShare"
    ).href = `https://twitter.com/intent/tweet?url=${textUrl}`;
    document.getElementById(
        "linkedinShare"
    ).href = `https://www.linkedin.com/shareArticle?mini=true&url=${textUrl}`;

    // Show modal
    document.getElementById("shareModal").style.display = "block";
}

function closeShareModal() {
    document.getElementById("shareModal").style.display = "none";
}

// Optional: Click outside to close
window.onclick = function (event) {
    const modal = document.getElementById("shareModal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
};

function copyLink() {
    const linkInput = document.getElementById("shareLink");
    linkInput.select();
    linkInput.setSelectionRange(0, 99999);
    document.execCommand("copy");
    alert("Link copied to clipboard!");
}
/*  end Share text  */

/*  delete text frame  */

let deleteTextId = null;

function openTextDeleteModal(textId) {
    deleteTextId = textId;
    const deleteModal = new bootstrap.Modal(
        document.getElementById("textdeleteModal")
    );
    deleteModal.show();
}


    document.getElementById("confirmtextDeleteBtn")
    .addEventListener("click", function () {
        if (deleteTextId !== null) {
            fetch(`/delete-text/${deleteTextId}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Close the modal
                        const deleteModal = bootstrap.Modal.getInstance(
                            document.getElementById("textdeleteModal")
                        );
                        deleteModal.hide();

                        // Remove the deleted text from the DOM
                        const textCard = document.getElementById(
                            `text-wrapper-${deleteTextId}`
                        );
                        if (textCard) textCard.remove();

                        // Reload the page after a short delay to reflect the changes
                        setTimeout(() => {
                            location.reload(); // Reload the page
                        }, 500); // Adjust the timeout duration as needed
                    } else {
                        alert("Failed to delete text.");
                    }
                })
                .catch((error) => {
                    console.error("Error deleting text:", error);
                    alert("An error occurred while deleting.");
                });
        }
    });
/*  end delete text frame  */

