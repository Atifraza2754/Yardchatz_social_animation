/* Pin Audio */
function pinAudio(audioId, icon) {
    fetch('/toggle-audio-pin', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ audio_id: audioId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Change pin icon (button)
            icon.src = data.is_pinned ? 'assets/img/pinned.svg' : 'assets/img/pin.svg';

            // Move card up/down
            const card = document.getElementById(`audio-card-${audioId}`);
            const container = document.querySelector('.profile-row');
            if (data.is_pinned) {
                container.prepend(card);
            } else {
                container.appendChild(card);
            }

            // ✅ Update top-right pin badge dynamically
            const badge = document.getElementById(`pin-badge-${audioId}`);
            if (data.is_pinned) {
                badge.innerHTML = `<img src="assets/img/pinned.svg" alt="Pinned" style="width: 20px; height: 20px;" />`;
            } else {
                badge.innerHTML = ''; // Remove pin icon
            }
        }
    });
}

/* end pin audio */

 
 


/*   end  Audio Comment  */




/*  Share audio */

    function shareContent(audioId) {
        const baseUrl = window.location.origin;
        const audioUrl = `${baseUrl}/share-audio/${audioId}`; // Make sure this matches your route

        document.getElementById('shareLink').value = audioUrl;

        // Set share links
        document.getElementById('whatsappShare').href = `https://api.whatsapp.com/send?text=Check this audio: ${audioUrl}`;
        document.getElementById('facebookShare').href = `https://www.facebook.com/sharer/sharer.php?u=${audioUrl}`;
        document.getElementById('twitterShare').href = `https://twitter.com/intent/tweet?url=${audioUrl}`;
        document.getElementById('linkedinShare').href = `https://www.linkedin.com/shareArticle?mini=true&url=${audioUrl}`;

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


/*  end Share audio  */




    // Add hover effects and interactions
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('mouseover', () => {
            item.style.transform = 'scale(1.1)';
        });
        item.addEventListener('mouseout', () => {
            item.style.transform = 'scale(1)';
        });
    });

    // Add smooth transitions for all interactive elements
    document.querySelectorAll('.profile-card').forEach(card => {
        card.addEventListener('mouseover', () => {
            card.style.transform = 'translateY(-5px)';
            card.style.transition = 'transform 0.3s ease';
        });
        card.addEventListener('mouseout', () => {
            card.style.transform = 'translateY(0)';
        });
    });

    // Add click handlers for profile cards
    document.querySelectorAll('.profile-card').forEach(card => {
        let isActive = false;

        // Handle click on profile image
        const profileImage = card.querySelector('.profile-image');
        profileImage.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent body click

            // Remove active class from all other cards
            document.querySelectorAll('.profile-card').forEach(otherCard => {
                if (otherCard !== card) {
                    otherCard.classList.remove('active');
                }
            });

            // Toggle active state
            isActive = !isActive;
            card.classList.toggle('active');
        });

        // Prevent name link from toggling icons
        const nameLink = card.querySelector('.name-label a');
            if (nameLink) {
                nameLink.addEventListener('click', (e) => {
                    e.stopPropagation(); // Prevent card click
                });
            }

        // Handle icon clicks (unchanged)
        card.querySelectorAll('.icon').forEach(icon => {
            icon.addEventListener('click', (e) => {
                e.stopPropagation(); // Prevent card click
                const action = icon.getAttribute('aria-label');
                const name = card.querySelector('.name-label').textContent;
                console.log(`${action} ${name}`);
                // Add your actual interaction handling here
            });
        });
    });

    // Close active card when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.profile-card')) {
            document.querySelectorAll('.profile-card').forEach(card => {
                card.classList.remove('active');
            });
        }
    });


    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "block";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }



