@include('frontend.layout.header')
<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-image: url('{{ asset('assets/img/ssdRectangle.png') }}');
    }

    .container {
        position: relative;
        width: 100vw;
        height: 95vh;
    }

    .chat-container {
        background-size: cover;
        background-position: center;
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 80vh;
    }

    .message-header {
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        cursor: pointer;
    }

    .profile-container {
        position: relative;
        width: 60px;
        height: 60px;
        flex-shrink: 0;
    }


    .profile-picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .apple-icon {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 20px;
        height: 20px;
        background: linear-gradient(45deg, #ff375f, #ff7eb6);
        border-radius: 50%;
        border: 2px solid #fff;
    }

    .apple-icon::before {
        content: '';
        position: absolute;
        top: 2px;
        right: 6px;
        width: 4px;
        height: 6px;
        background: #fff;
        border-radius: 2px;
        transform: rotate(-45deg);
    }

    .message-text {
        color: #ffffff;
        font-family: 'MedievalSharp', cursive;
        font-size: 24px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .messages {
        flex-grow: 1;
        overflow-y: auto;
        padding: 20px;
    }

    .message {
        max-width: 15%;
        margin: 10px 0;
        padding: 10px 15px;
        border-radius: 15px;
        color: white;
        animation: fadeIn 0.3s ease-out;
    }

    .message.received {
        background-color: rgba(255, 255, 255, 0.1);
        margin-right: auto;
    }

    .message.sent {
        background-color: #2a75f3;
        margin-left: auto;
    }

    .input-area {
        padding: 20px;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        gap: 10px;
        margin-bottom: -10px;
    }

    #messageInput {
        flex-grow: 1;
        padding: 12px;
        border: none;
        border-radius: 20px;
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 16px;
    }

    #messageInput::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    #sendButton {
        padding: 12px 24px;
        border: none;
        border-radius: 20px;
        background-color: #0077ff;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    #sendButton:hover {
        background-color: #0066dd;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .message-text {
            font-size: 20px;
        }
    }

    @media (max-width: 480px) {
        .message-text {
            font-size: 18px;
        }

        .message-header {
            padding: 15px;
        }

        #sendButton {
            padding: 12px 16px;
        }
    }

    .text-options {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
        justify-content: center;
        align-items: center;
    }

    .text-options select {
        padding: 8px 12px;
        border-radius: 25px;
        border: 1px solid #ccc;
        background-color: #f4f4f4;
        font-size: 14px;
        cursor: pointer;
        outline: none;
        transition: all 0.3s ease;
    }

    .prfile-image-container {
        position: relative;
    }

    .profile-name {
        position: absolute;
        top: 74px;
        /* Adjust as necessary */
        font-size: 14px;
        color: white;
        display: none;
    }

    .prfile-image-container:hover .profile-name {
        display: block;
        /* Show name on hover */
    }

</style>

<div class="container">
    <div class="chat-container">
        <div class="message-header">
            <div class="profile-container">
                <div class="profile-picture">

                    @if($user->profile_picture)
                    <img src="{{ asset($user->profile_picture) }}" alt="Mallory" class="profile-image" style="width:60px; height:60px; border-radius:50%;">

                    @else
                    <img src="assets/img/person.png" alt="profile" class="profile-image">
                    @endif
                </div>
                <div class="apple-icon"></div>
            </div>
            <p class="message-text">{{ $user->name }}</p>



            <div class="prfile-image-container" style="position: absolute; top: 23px; right: 21px;">
                @if(auth()->user()->profile_picture)
                <img src="{{ asset(auth()->user()->profile_picture) }}" alt="Logged-in User Profile" class="prfile-image" style="width:60px; height:60px; border-radius:50%;">
                @else
                <img src="assets/img/person.png" alt="profile" class="profile-image">
                @endif
                <div class="profile-name" style="text-align: center; margin-top: 5px;">
                    {{ auth()->user()->name }}
                </div>
            </div>




            <div class="text-options" style="display: flex; gap: 10px; margin-bottom: 10px; margin-left:50%;">
                <!-- Font Size -->
                <select id="fontSizeSelect">
                    <option value="">Font Size</option>
                    @for ($i = 12; $i <= 100; $i+=4) <option value="{{ $i }}px">{{ $i }}px</option>
                        @endfor
                </select>

                <!-- Font Color -->
                <select id="fontColorSelect">
                    <option value="">Font Color</option>
                    <option value="black">Black</option>
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                    <option value="purple">Purple</option>
                    <option value="orange">Orange</option>
                    <option value="pink">Pink</option>
                    <option value="gray">Gray</option>
                    <option value="brown">Brown</option>
                    <option value="white">White</option>
                </select>

                <!-- Font Family -->
                <select id="fontFamilySelect">
                    <option value="">Font Family</option>
                    <option value="Arial">Arial</option>
                    <option value="Verdana">Verdana</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Courier New">Courier New</option>
                    <option value="Times New Roman">Times New Roman</option>
                    <option value="Trebuchet MS">Trebuchet MS</option>
                    <option value="Lucida Console">Lucida Console</option>
                    <option value="Impact">Impact</option>
                    <option value="Tahoma">Tahoma</option>
                    <option value="Comic Sans MS">Comic Sans MS</option>
                </select>
            </div>
        </div>

        <div class="messages" id="messageArea">
            @foreach ($merged as $msg)
            @if($msg->type === 'message')
            <div class="message {{ $msg->sender_id == auth()->id() ? 'sent' : 'received' }}">
                {{ $msg->message }}
            </div>
            @elseif($msg->type === 'call')
            <div class="message call-log {{ $msg->sender_id == auth()->id() ? 'sent' : 'received' }}">
                <div class="call-log-content">
                    
                    <div class="call-log-text">
                         <i class="fa {{ $msg->call_type === 'video' ? 'fa-video-camera' : 'fa-phone' }}" style="color:#ec4d4d; margin-right:5px;"></i>
                        <strong>{{ ucfirst($msg->status) }} {{ $msg->call_type }} call</strong>
                        <div class="call-log-subtext">
                            {{ \Carbon\Carbon::parse($msg->started_at)->format('h:i A') }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>

        <div class="input-area" id="inputArea">
            <input type="text" id="messageInput" placeholder="Type your message...">
            <button id="sendButton" data-user-id="{{ $user->id }}">Send</button>
        </div>
    </div>
    @include('frontend.layout.navbar')

</div>

<!-- ✅ Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- ✅ Pusher -->
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>

<!-- ✅ Laravel Echo (IIFE build) -->
<script src="https://unpkg.com/laravel-echo@1.11.3/dist/echo.iife.js"></script>


<script>
    window.Pusher = Pusher;

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

    axios.defaults.headers.common['X-CSRF-TOKEN'] =
        document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.addEventListener('DOMContentLoaded', () => {
        const messageHeader = document.querySelector('.message-header');
        const inputArea = document.getElementById('inputArea');
        const messageInput = document.getElementById('messageInput');
        const sendButton = document.getElementById('sendButton');
        const messageArea = document.getElementById('messageArea');

        //let isInputVisible = true;
        const selectedReceiverId = sendButton.getAttribute('data-user-id');
        const authUserId = {{ auth() -> id() }};

        // Store current styles (load from localStorage or default empty)
        let currentFontSize = localStorage.getItem('chatFontSize') || '';
        let currentFontColor = localStorage.getItem('chatFontColor') || '';
        let currentFontFamily = localStorage.getItem('chatFontFamily') || '';

        // Select dropdown elements
        const fontSizeSelect = document.getElementById('fontSizeSelect');
        const fontColorSelect = document.getElementById('fontColorSelect');
        const fontFamilySelect = document.getElementById('fontFamilySelect');

        // Set dropdowns to saved values
        fontSizeSelect.value = currentFontSize;
        fontColorSelect.value = currentFontColor;
        fontFamilySelect.value = currentFontFamily;

        // Apply styles to input and messages
        function applyStylesToMessages() {
            const messages = document.querySelectorAll('.message');
            messages.forEach(msg => {
                msg.style.fontSize = currentFontSize;
                msg.style.color = currentFontColor;
                msg.style.fontFamily = currentFontFamily;
            });
        }

        messageInput.style.fontSize = currentFontSize;
        messageInput.style.color = currentFontColor;
        messageInput.style.fontFamily = currentFontFamily;
        applyStylesToMessages();

        // Add a message element with current styles
        const addMessage = (text, isSent) => {
            const message = document.createElement('div');
            message.className = 'message ' + (isSent ? 'sent' : 'received');
            message.textContent = text;

            message.style.fontSize = currentFontSize;
            message.style.color = currentFontColor;
            message.style.fontFamily = currentFontFamily;

            messageArea.appendChild(message);
            messageArea.scrollTop = messageArea.scrollHeight;
        };

        // Send message function
        const sendMessage = () => {
            const text = messageInput.value.trim();
            if (text) {
                addMessage(`You: ${text}`, true);
                messageInput.value = '';

                axios.post('/send-message', {
                    receiver_id: selectedReceiverId
                    , message: text
                    , font_size: currentFontSize
                    , font_color: currentFontColor
                    , font_family: currentFontFamily
                , }, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
            }
        };

        sendButton.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });

        // Dropdown event listeners to update styles and save in localStorage
        fontSizeSelect.addEventListener('change', () => {
            currentFontSize = fontSizeSelect.value || '';
            messageInput.style.fontSize = currentFontSize;
            applyStylesToMessages();
            localStorage.setItem('chatFontSize', currentFontSize);
        });

        fontColorSelect.addEventListener('change', () => {
            currentFontColor = fontColorSelect.value || '';
            messageInput.style.color = currentFontColor;
            applyStylesToMessages();
            localStorage.setItem('chatFontColor', currentFontColor);
        });

        fontFamilySelect.addEventListener('change', () => {
            currentFontFamily = fontFamilySelect.value || '';
            messageInput.style.fontFamily = currentFontFamily;
            applyStylesToMessages();
            localStorage.setItem('chatFontFamily', currentFontFamily);
        });


        window.Echo.private(`chat.${authUserId}`)
            .listen('.message.sent', (e) => {
                addMessage(`${e.message.sender.name}: ${e.message.message}`, false);
            });
    });

</script>



@include('frontend.layout.footer')
