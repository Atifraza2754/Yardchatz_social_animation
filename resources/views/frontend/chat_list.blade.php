<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.layout.header')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/allchats.css') }}" rel="stylesheet">

    <style>
        {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container-chat {
            flex: 1;
            display: flex;
            overflow: hidden;
            background-image: url('assets/img/ssdRectangle.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .chat-header-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-header-right select {
            background: transparent;
            border: 1px solid #2a75f3;
            color: white;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            padding: 3px 6px;
            font-size: 14px;
        }

        .chat-header-right select option {
            color: black;
        }

    </style>
</head>
<body>
    @include('frontend.layout.navbar')
    <div class="container-chat">
        <div class="sidebar" id="sidebarPanel">
            <div class="sidebar-header">
                <i class="fas fa-comments" id="msg-icon"></i> <span id="msg">MESSAGES</span>
                <i class="fas fa-times" id="closeSidebar" class="X-icon" style="margin-left:auto; cursor:pointer;"></i>
            </div>
            <div class="search">
                <input type="text" placeholder="Search...">
            </div>
            <div class="messages-list">
                @foreach($conversations as $id => $chat)
                <div class="message-item" data-id="{{ $chat['user']->id }}" data-name="{{ $chat['user']->name }}" data-img="{{ asset($chat['user']->profile_picture) }}">
                    <img src="{{ asset($chat['user']->profile_picture) }}" alt="{{ $chat['user']->name }}" />
                    <div class="message-content">
                        <div class="uname">{{ $chat['user']->name }}</div>
                        <div class="preview">{{ $chat['latest_message'] }}</div>
                    </div>
                    <div class="message-time">{{ $chat['time'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="chat-pane">
            <div class="chat-header">
                <div class="chat-header-left">
                    <i class="fas fa-arrow-left" id="openSidebar" style="cursor:pointer;"></i>
                    <img id="chatUserImg" src="" alt="profile" style="display:none;" />
                    <div id="chatUserName" class="chat-header-title"></div>
                </div>

                <div class="chat-header-right">
                    <select id="fontSizeSelect" title="Font Size">
                        <option value="">Font Size</option>
                        @for ($i = 12; $i <= 100; $i+=6) <option value="{{ $i }}px">{{ $i }}px</option>
                            @endfor
                    </select>

                    <select id="fontColorSelect" title="Font Color">
                        <option value="">Font Color</option>
                        <option value="#000000">Black</option>
                        <option value="#FF0000">Red</option>
                        <option value="#0000FF">Blue</option>
                        <option value="#008000">Green</option>
                        <option value="#800080">Purple</option>
                        <option value="#FFA500">Orange</option>
                        <option value="#FFC0CB">Pink</option>
                        <option value="#808080">Gray</option>
                        <option value="#A52A2A">Brown</option>
                        <option value="#FFFFFF">White</option>
                        <option value="#00FFFF">Cyan</option>
                        <option value="#FFD700">Gold</option>
                        <option value="#4B0082">Indigo</option>
                        <option value="#40E0D0">Turquoise</option>
                        <option value="#FF69B4">Hot Pink</option>
                    </select>

                    <select id="fontFamilySelect" title="Font Family">
                        <option value="">Font Family</option>
                        <option value="Arial, sans-serif">Arial</option>
                        <option value="Verdana, sans-serif">Verdana</option>
                        <option value="Georgia, serif">Georgia</option>
                        <option value="'Courier New', Courier, monospace">Courier New</option>
                        <option value="'Times New Roman', Times, serif">Times New Roman</option>
                        <option value="'Trebuchet MS', sans-serif">Trebuchet MS</option>
                        <option value="'Lucida Console', Monaco, monospace">Lucida Console</option>
                        <option value="Impact, Charcoal, sans-serif">Impact</option>
                        <option value="Tahoma, Geneva, sans-serif">Tahoma</option>
                        <option value="'Comic Sans MS', cursive, sans-serif">Comic Sans MS</option>
                        <option value="'Palatino Linotype', 'Book Antiqua', Palatino, serif">Palatino</option>
                        <option value="'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Segoe UI</option>
                        <option value="'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">Gill Sans</option>
                        <option value="'Helvetica Neue', Helvetica, Arial, sans-serif">Helvetica Neue</option>
                        <option value="'Lucida Sans Unicode', 'Lucida Grande', sans-serif">Lucida Sans</option>
                    </select>
                </div>
            </div>

            <div class="chat-messages" id="chatMessages"></div>
            <div class="chat-footer">
                <div class="input-wrapper">
                    <i class="fas fa-smile emoji-trigger"></i>
                    <input type="text" id="messageInput" placeholder="Type a message...">
                </div>
                <button id="sendButton"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
    @include('frontend.layout.footer')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebarPanel');
            const closeBtn = document.getElementById('closeSidebar');
            const openBtn = document.getElementById('openSidebar');

            closeBtn.addEventListener('click', () => {
                sidebar.classList.add('hidden');
            });

            openBtn.addEventListener('click', () => {
                sidebar.classList.remove('hidden');
            });
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.1.1/dist/index.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.0/axios.min.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://unpkg.com/laravel-echo@1.11.3/dist/echo.iife.js"></script>


    <script>
        const messageInput = document.getElementById('messageInput');
        const sendButton = document.getElementById('sendButton');
        const chatMessages = document.getElementById('chatMessages');
        const chatUserImg = document.getElementById('chatUserImg');
        const chatUserName = document.getElementById('chatUserName');
        let selectedReceiverId = null;
        const authUserId = {{ auth() -> id()}};

        const authUserImage = "{{ asset(Auth::user()->profile_picture) }}";


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

                        if (msg.type === 'message') {
                            chatMessages.innerHTML += `
            <div class="bubble-container ${sentByMe ? 'sent' : 'received'}">
                ${!sentByMe ? `<img src="${item.getAttribute('data-img')}" alt="user">` : ''}
                <div class="bubble ${sentByMe ? '' : 'received'}">${msg.message}</div>
                ${sentByMe ? `<img src="${authUserImage}" alt="me">` : ''}
            </div>`;
                        } else if (msg.type === 'call') {
                            const icon = msg.call_type === 'video' ? 'fa-video-camera' : 'fa-phone';
                            chatMessages.innerHTML += `
            <div class="bubble-container ${sentByMe ? 'sent' : 'received'}">
                ${!sentByMe ? `<img src="${item.getAttribute('data-img')}" alt="user">` : ''}
                <div class="bubble call-log ${sentByMe ? '' : 'received'}">
                    <i class="fa ${icon}" style="color:#ec4d4d; margin-right:5px;"></i>
                    <strong>${msg.status.charAt(0).toUpperCase() + msg.status.slice(1)} ${msg.call_type} call</strong><br/>
                    <small style="color:#ccc;">${new Date(msg.started_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</small>
                </div>
                ${sentByMe ? `<img src="${authUserImage}" alt="me">` : ''}
            </div>`;
                        }

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
                    receiver_id: selectedReceiverId
                    , message: text
                }, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(res => {
                    // Show message in chat pane
                    chatMessages.innerHTML += `
                <div class="bubble-container sent">
                    <div class="bubble">${text}</div>
                    <img src="${authUserImage}" alt="me">
                </div>`;

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
            broadcaster: 'pusher'
            , key: '2d1bf5af3517b2dc31df'
            , cluster: 'ap2'
            , wsHost: window.location.hostname
            , wsPort: 6001
            , forceTLS: false
            , disableStats: true
            , enabledTransports: ['ws', 'wss']
        });

        window.Echo.private(`chat.${authUserId}`).listen('.message.sent', (e) => {
            if (e.message.sender_id == selectedReceiverId || e.message.receiver_id == selectedReceiverId) {
                const sentByMe = e.message.sender_id == authUserId;
                chatMessages.innerHTML += `
            <div class="bubble-container ${sentByMe ? 'sent' : 'received'}">
                ${!sentByMe ? `<img src="${e.message.sender.profile_image_url}" alt="user">` : ''}
                <div class="bubble ${sentByMe ? '' : 'received'}">${e.message.message}</div>
                ${sentByMe ? `<img src="${authUserImage}" alt="me">` : ''}
            </div>`;

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



        const picker = new EmojiButton({
            position: 'top-start'
            , theme: 'auto'
        });
        document.querySelector('.emoji-trigger').addEventListener('click', () => picker.togglePicker(document.querySelector('.emoji-trigger')));
        picker.on('emoji', emoji => {
            messageInput.value += emoji;
        });

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

    </script>

</body>
</html>
