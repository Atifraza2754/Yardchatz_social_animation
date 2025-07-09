function likeStill(stillId) {
    fetch(`/like-still/${stillId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Like added') {
            // Change to filled red heart
            document.getElementById(`likeIcon-${stillId}`).src = 'assets/img/likee.svg';
        } else {
            // Change back to default white heart
            document.getElementById(`likeIcon-${stillId}`).src = 'assets/img/white.png';
        }

        // Update the like count in real-time
        document.getElementById(`likeCount-${stillId}`).innerText = data.like_count;
    });
}


function timeAgo(dateString) {
    const now = new Date();
    const commentDate = new Date(dateString);
    const seconds = Math.floor((now - commentDate) / 1000);

    if (seconds < 60) return 'Just now';
    const minutes = Math.floor(seconds / 60);
    if (minutes < 60) return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
    const hours = Math.floor(minutes / 60);
    if (hours < 24) return `${hours} hour${hours > 1 ? 's' : ''} ago`;
    const days = Math.floor(hours / 24);
    return `${days} day${days > 1 ? 's' : ''} ago`;
}

function openCommentPanel(stillId) {
    const panel = document.getElementById('commentPanel');
    const commentInput = document.getElementById('commentInput');

    // Set the still_id in the comment input to maintain state
    commentInput.setAttribute('data-still-id', stillId);

    // Show the comment panel smoothly
    panel.classList.add('open');

    // Fetch and display the comments in real-time
    fetchComments(stillId);
}

function closeCommentPanel() {
    const panel = document.getElementById('commentPanel');

    // Remove the class to smoothly close the modal
    panel.classList.remove('open');
}

function submitComment() {
    const commentInput = document.getElementById('commentInput');
    const stillId = commentInput.getAttribute('data-still-id'); // Get the still_id
    const comment = commentInput.value.trim();

    if (!comment) {
        alert('Please write a comment.');
        return;
    }

    fetch('/submit-still-comment', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            still_id: stillId,
            comment: comment
        })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('commentInput').value = "";
        fetchComments(stillId);
    })
    .catch(err => console.error(err));
    
}

function fetchComments(stillId) {
    fetch(`/get-still-comments?still_id=${stillId}`)
        .then(response => response.json())
        .then(data => {
            const commentsList = document.getElementById('commentsList');
            commentsList.innerHTML = '';

            // Update the comment count for the still
            document.getElementById(`commentCount-${stillId}`).innerText = data.comments.length;

            data.comments.forEach(comment => {
                const commentElement = document.createElement('div');
                commentElement.classList.add('comment-card');


                commentElement.innerHTML = `
                <div class="comment-header">
                    <div class="comment-user-info">
                        <img src="${comment.user.profile_picture}" alt="${comment.user.name}" class="comment-user-avatar">
                        <strong class="comment-username">${comment.user.name}</strong>
                    </div>
                </div>
                <div class="comment-body">${comment.comment}</div>
                <div class="comment-footer">
                    <span class="comment-time">${timeAgo(comment.created_at)}</span>
                </div>
                `;

                commentsList.appendChild(commentElement);
            });
        });
}


/*  Share still */

function shareContent(stillId) {
    const baseUrl = window.location.origin;
    const stillUrl = `${baseUrl}/share-still/${stillId}`; // Make sure this matches your route

    document.getElementById('shareLink').value = stillUrl;

    // Set share links
    document.getElementById('whatsappShare').href = `https://api.whatsapp.com/send?still=Check this still: ${stillUrl}`;
    document.getElementById('facebookShare').href = `https://www.facebook.com/sharer/sharer.php?u=${stillUrl}`;
    document.getElementById('twitterShare').href = `https://twitter.com/intent/tweet?url=${stillUrl}`;
    document.getElementById('linkedinShare').href = `https://www.linkedin.com/shareArticle?mini=true&url=${stillUrl}`;

    // Show modal
    document.getElementById('shareModal').style.display = 'block';
}

function closeShareModal() {
    document.getElementById('shareModal').style.display = 'none';
}

// Optional: Click outside to close
window.onclick = function(event) {
    const modal = document.getElementById('shareModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}

function copyLink() {
    const linkInput = document.getElementById('shareLink');
    linkInput.select();
    linkInput.setSelectionRange(0, 99999);
    document.execCommand('copy');
    alert('Link copied to clipboard!');
}


/*  end Share still  */


/*  Pin still  */

function pinStill(stillId, icon) {
    fetch('/toggle-still-pin', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ still_id: stillId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            icon.src = data.is_pinned ? 'assets/img/pinned.svg' : 'assets/img/pin.svg';

            const badge = document.getElementById(`pin-badge-${stillId}`);
            badge.innerHTML = data.is_pinned
                ? `<img src="assets/img/pinned.svg" alt="Pinned" style="width: 20px; height: 20px; margin-left:409px; margin-top:-4px;" />`
                : '';

            const wrapper = document.getElementById(`still-wrapper-${stillId}`);
            const container = document.querySelector('.profiles-container');

            if (data.is_pinned) {
                // Move to top
                location.reload();
                container.prepend(wrapper);

            } else {
                // Move to original position (sort DOM again)
                // Just reload the stills list via AJAX or page reload
                location.reload(); // simpler and ensures exact order from DB
            }
        }
    });
}

/* <<<<<<<<<<<<<<<<<<<==============>>>>>>>>>>>>>>>>>>>>>>> */
/* Still flipbook  */


document.addEventListener('DOMContentLoaded', function () {
    const pageFlip = new St.PageFlip(
        document.getElementById("demoBookExample"),
        {
            width: 600,
            height: 800,
            size: "stretch",
            showCover: false,
            maxShadowOpacity: 0.5,
            mobileScrollSupport: false,
        }
    );

    pageFlip.loadFromHTML(document.querySelectorAll(".page"));

    document.querySelector(".page-total").innerText = pageFlip.getPageCount();
    document.querySelector(".page-orientation").innerText = pageFlip.getOrientation();

    document.querySelector(".btn-prev").addEventListener("click", () => pageFlip.flipPrev());
    document.querySelector(".btn-next").addEventListener("click", () => pageFlip.flipNext());

    pageFlip.on("flip", (e) => {
        document.querySelector(".page-current").innerText = e.data + 1;
    });

    pageFlip.on("changeState", (e) => {
        document.querySelector(".page-state").innerText = e.data;
    });

    pageFlip.on("changeOrientation", (e) => {
        document.querySelector(".page-orientation").innerText = e.data;
    });
});