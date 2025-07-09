 document.querySelectorAll('.message-item').forEach(item => {
        item.addEventListener('click', () => {
            document.querySelectorAll('.message-item').forEach(i => i.classList.remove('active'));
            item.classList.add('active');

            selectedReceiverId = item.getAttribute('data-id');
            chatUserName.textContent = item.getAttribute('data-name');
            chatUserImg.src = item.getAttribute('data-img');
            chatUserImg.style.display = 'block';

            axios.get(`/messages/${selectedReceiverId}`).then(res => {
                chatMessages.innerHTML = '';
               res.data.forEach(msg => {
    const sentByMe = msg.sender_id == authUserId;
    chatMessages.innerHTML += `
        <div class="bubble-container ${sentByMe ? 'sent' : 'received'}">
            ${!sentByMe ? `<img src="${item.getAttribute('data-img')}" alt="user">` : ''}
            <div class="bubble ${sentByMe ? '' : 'received'}">${msg.message}</div>
            ${sentByMe ? `<img src="${authUserImage}" alt="me">` : ''}
        </div>
    `;
    applyStyles();
});

                chatMessages.scrollTop = chatMessages.scrollHeight;
            });
        });
    });

sendButton.addEventListener('click', () => {
    const text = messageInput.value.trim();
    if (text && selectedReceiverId) {
        axios.post('/send-message', {
            receiver_id: selectedReceiverId,
            message: text
        }, {
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).then(res => {
            // Show message in chat pane
            chatMessages.innerHTML += `
                <div class="bubble-container sent">
                    <div class="bubble">${text}</div>
                    <img src="${authUserImage}" alt="me">
                </div>
            `;
            chatMessages.scrollTop = chatMessages.scrollHeight;
            messageInput.value = '';
            applyStyles();

            // Sidebar update on send
            const sidebarItem = document.querySelector(`.message-item[data-id="${selectedReceiverId}"]`);
            if (sidebarItem) {
                // Update preview text
                const preview = sidebarItem.querySelector('.preview');
                if (preview) {
                    preview.textContent = text;
                }
                // Update message time text
                const time = sidebarItem.querySelector('.message-time');
                if (time) {
                    time.textContent = 'Just now';
                }
                // Move updated sidebar item to top
                const messagesList = document.querySelector('.messages-list');
                if (messagesList && sidebarItem.parentNode === messagesList) {
                    messagesList.prepend(sidebarItem);
                }
            }
        });
    }
});


    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '2d1bf5af3517b2dc31df',
        cluster: 'ap2',
        wsHost: window.location.hostname,
        wsPort: 6001,
        forceTLS: false,
        disableStats: true,
        enabledTransports: ['ws', 'wss']
    });

   window.Echo.private(`chat.${authUserId}`).listen('.message.sent', (e) => {
    if (e.message.sender_id == selectedReceiverId || e.message.receiver_id == selectedReceiverId) {
        const sentByMe = e.message.sender_id == authUserId;
        chatMessages.innerHTML += `
            <div class="bubble-container ${sentByMe ? 'sent' : 'received'}">
                ${!sentByMe ? `<img src="${e.message.sender.profile_image_url}" alt="user">` : ''}
                <div class="bubble ${sentByMe ? '' : 'received'}">${e.message.message}</div>
                ${sentByMe ? `<img src="${authUserImage}" alt="me">` : ''}
            </div>
        `;
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // Sidebar latest message update
        const chatIdToUpdate = sentByMe ? e.message.receiver_id : e.message.sender_id;

        const sidebarItem = document.querySelector(`.message-item[data-id="${chatIdToUpdate}"]`);
        if (sidebarItem) {
            // Update preview text
            const preview = sidebarItem.querySelector('.preview');
            if (preview) {
                preview.textContent = e.message.message;
            }
            // Optionally update the time to "just now"
            const time = sidebarItem.querySelector('.message-time');
            if (time) {
                time.textContent = 'Just now';
            }
            // Move updated chat item to top for UX (optional)
            const messagesList = document.querySelector('.messages-list');
            if (messagesList && sidebarItem.parentNode === messagesList) {
                messagesList.prepend(sidebarItem);
            }
        }
    }
    applyStyles();
});



    const picker = new EmojiButton({ position: 'top-start', theme: 'auto' });
    document.querySelector('.emoji-trigger').addEventListener('click', () => picker.togglePicker(document.querySelector('.emoji-trigger')));
    picker.on('emoji', emoji => { messageInput.value += emoji; });

    // Load saved preferences or defaults
let currentFontSize = localStorage.getItem('chatFontSize') || '';
let currentFontColor = localStorage.getItem('chatFontColor') || '';
let currentFontFamily = localStorage.getItem('chatFontFamily') || '';

const fontSizeSelect = document.getElementById('fontSizeSelect');
const fontColorSelect = document.getElementById('fontColorSelect');
const fontFamilySelect = document.getElementById('fontFamilySelect');

// Set dropdowns to saved values
fontSizeSelect.value = currentFontSize;
fontColorSelect.value = currentFontColor;
fontFamilySelect.value = currentFontFamily;

// Apply styles function (messages + sidebar names + previews)
function applyStyles() {
    // Chat messages bubbles
    document.querySelectorAll('.bubble').forEach(bubble => {
        if (currentFontSize) bubble.style.fontSize = currentFontSize;
        else bubble.style.fontSize = '';

        if (currentFontColor) bubble.style.color = currentFontColor;
        else bubble.style.color = '';

        if (currentFontFamily) bubble.style.fontFamily = currentFontFamily;
        else bubble.style.fontFamily = '';
    });

    // Sidebar message names and previews
    document.querySelectorAll('.message-content .name, .message-content .preview').forEach(el => {
        if (currentFontSize) el.style.fontSize = currentFontSize;
        else el.style.fontSize = '';

        if (currentFontColor) el.style.color = currentFontColor;
        else el.style.color = '';

        if (currentFontFamily) el.style.fontFamily = currentFontFamily;
        else el.style.fontFamily = '';
    });
}

// Initial apply styles on page load
applyStyles();

// Event listeners on dropdown change
fontSizeSelect.addEventListener('change', () => {
    currentFontSize = fontSizeSelect.value;
    localStorage.setItem('chatFontSize', currentFontSize);
    applyStyles();
});

fontColorSelect.addEventListener('change', () => {
    currentFontColor = fontColorSelect.value;
    localStorage.setItem('chatFontColor', currentFontColor);
    applyStyles();
});

fontFamilySelect.addEventListener('change', () => {
    currentFontFamily = fontFamilySelect.value;
    localStorage.setItem('chatFontFamily', currentFontFamily);
    applyStyles();
});
