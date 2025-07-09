@include('frontend.layout.header')
<link rel="stylesheet" href="assets/css/friends.css">
<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        margin: 0;
        background-image: url('assets/img/tree2.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /*background-attachment: fixed;*/
        overflow: hidden;
    }

    .container {
        width: 100%;
        height: 100vh;
        position: relative;
    }

    .tree-section {
        position: relative;
        height: 85vh;
        overflow: hidden;
        display: flex;
        justify-content: center;
    }

    #avatars-container {
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .avatar {
        position: absolute;
        width: 60px;
        height: 60px;
        transition: all 0.3s ease;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .avatar {
            width: 40px;
            height: 40px;
        }

        .navbar {

            overflow-x: auto !important;
            /* Horizontal scroll ke liye */
            overflow-y: hidden !important;
            /* Vertical overflow ko remove karne ke liye */
        }
    }

    @media (max-width: 480px) {
        .avatar {
            width: 46px;
            height: 55px;
        }

        .navbar {

            overflow-x: auto !important;
            /* Horizontal scroll ke liye */
            overflow-y: hidden !important;
            /* Vertical overflow ko remove karne ke liye */
        }

        body {

            overflow: scroll !important;
        }

    }

    /* Navbar styles (unchanged) */
    .navbar {
        position: absolute;
        bottom: 45px;
        width: 100%;
        background-color: #ff3131;
        display: flex;
        align-items: center;
        padding: 10px 0;
        z-index: 3;
        /* overflow-x: auto; */
        white-space: nowrap;
        /* overflow-y: hidden; */
    }

    .navbar .icon {
        width: 11%;
        height: auto;
        object-fit: contain;
        transition: transform 0.3s ease, margin-top 0.3s ease;
        margin: 0 0px;
        position: relative;
        padding: 0px 15px;
    }

    .navbar .icon:hover {
        transform: scale(1.2);
        margin-top: 0px;
        z-index: 5;
        overflow: visible;
    }

    @media (max-width: 480px) {
        .navbar .icon {
            width: 26%;
            height: auto;
        }

        .navbar {

            overflow-x: auto;
            overflow-y: hidden;
        }
    }

    .icon {
        position: relative;
        /* Make sure the image is positioned relative */
    }

    .map-text {
        display: none;
        position: absolute;
        top: -50px;
        left: 5%;
        transform: translateX(-50%);
        color: #fff;
        z-index: 9999;
        background-color: #2d6a30;
        color: white;

        font-size: 22px;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        padding: 7px 21px;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        transition: transform 0.3s ease;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .icon:hover+.map-text {
        display: block;
    }

    span.map-text.Radio-text {
        left: 15%;
    }

    span.map-text.music {
        left: 26%;
    }

    span.map-text.feed {
        left: 36%;
    }

    span.map-text.cameras {
        left: 46%;
    }

    span.map-text.Room {
        left: 57%;
    }

    span.map-text.Friends {
        left: 67%;
    }

    span.map-text.name {
        left: 77%;
    }

    span.map-text.setting {
        left: 87%;
    }

    span.map-text.fam {
        left: 96%;
    }
</style>
<div class="container">
    <div class="tree-section">
        <div id="avatars-container">
            <!-- Avatar divs will be dynamically added here -->
        </div>
    </div>
    @include('frontend.layout.navbar')

</div>
<script>
    function navigateTo(url) {
        window.location.href = url;
    }

    // Dynamic avatar positioning
    const avatarsContainer = document.getElementById('avatars-container');
    const avatarPositions = [{
            top: '10%',
            left: '45%'
        },
        {
            top: '15%',
            left: '30%'
        },
        {
            top: '25%',
            left: '15%'
        },
        // { top: '40%', left: '10%' },
        {
            top: '60%',
            left: '15%'
        },
        {
            top: '70%',
            left: '30%'
        },
        {
            top: '75%',
            left: '50%'
        },
        {
            top: '70%',
            left: '70%'
        },
        {
            top: '60%',
            left: '85%'
        },
        // { top: '40%', left: '90%' },
        {
            top: '25%',
            left: '85%'
        },
        {
            top: '15%',
            left: '70%'
        }
    ];

    function createAvatars() {
        avatarsContainer.innerHTML = ''; // Clear existing avatars
        avatarPositions.forEach((position, index) => {
            const avatar = document.createElement('div');
            avatar.className = 'avatar';
            avatar.style.top = position.top;
            avatar.style.left = position.left;
            avatar.innerHTML = `<img src="assets/img/oneman.png" alt="Avatar ${index + 1}">`;
            avatarsContainer.appendChild(avatar);
        });
    }

    // Initial creation of avatars
    createAvatars();

    // Reposition avatars on window resize
    window.addEventListener('resize', createAvatars);
</script>
@include('frontend.layout.footer')
