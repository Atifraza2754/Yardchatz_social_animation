@include('frontend.layout.header')
    <link rel="stylesheet" href="assets/css/permission.css">
    <style>
        body{
            font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
        }
    </style>
    <div class="logo">
        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23FF0000'%3E%3Cpath d='M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z'/%3E%3C/svg%3E" alt="Yard Chatz Logo">
        <div class="logo-text">YARD CHATZ</div>
    </div>

    <div class="content">
        <div class="green-apple"><a href="{{url('/')}}"> ALLOW ALL </a></div>
        <div class="permission-text">WE NEED PERMISSION FROM YOU FOR SOME THINGS SO YOU CAN JOIN THE FUN</div>
    </div>

    <div class="permissions-grid">
        <div class="permission-item">CAMERA</div>
        <div class="permission-item">PHOTOS/MEDIA</div>
        <div class="permission-item">MICROPHONE</div>
        <div class="permission-item">NOTIFICATIONS</div>
        <div class="permission-item">CONTACTS</div>
        <div class="permission-item">LOCATION</div>
    </div>

    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath fill='%23FFB74D' d='M256 56c110.5 0 200 89.5 200 200s-89.5 200-200 200S56 366.5 56 256 145.5 56 256 56m0-48C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z'/%3E%3Cpath fill='%23FFB74D' d='M256 384c-70.7 0-128-57.3-128-128s57.3-128 128-128 128 57.3 128 128-57.3 128-128 128zm0-208c-44.1 0-80 35.9-80 80s35.9 80 80 80 80-35.9 80-80-35.9-80-80-80z'/%3E%3Ccircle fill='%23FFB74D' cx='256' cy='256' r='56'/%3E%3C/svg%3E" alt="Astronaut" class="astronaut">

    <script>
        document.querySelectorAll('.permission-item').forEach(item => {
            item.addEventListener('click', () => {
                item.style.backgroundColor = 'rgba(127, 255, 0, 0.3)';
                item.style.borderColor = '#7FFF00';
            });
        });

        document.querySelector('.green-apple').addEventListener('click', () => {
            document.querySelectorAll('.permission-item').forEach(item => {
                item.style.backgroundColor = 'rgba(127, 255, 0, 0.3)';
                item.style.borderColor = '#7FFF00';
            });
        });
    </script>
@include('frontend.layout.footer')
