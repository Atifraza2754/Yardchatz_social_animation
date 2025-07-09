@include('frontend.layout.footer')

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
        background-image: url(assets/img/ssdRectangle.svg);
        min-height: 100vh;
        color: white;
        padding: 2rem;
        overflow: hidden;
        background-position: center;
        background-repeat: no-repeat;
        background-origin: cover;
        background-size: cover;
    }

    .header {
        display: flex;
        align-items: center;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .apple {
        width: 150px;
        height: 150px;
        background-image: url(assets/img/Clippatgroup.svg);
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        overflow: hidden;
    }

    .apple::after {
        content: '';
        position: absolute;
        top: 10px;
        right: 30px;
        width: 20px;
        height: 20px;
        background: rgba(255, 255, 255, 0.4);
        border-radius: 50%;
        filter: blur(2px);
    }

    .water-drop {
        position: absolute;
        background: rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        filter: blur(1px);
    }

    .water-drop:nth-child(1) {
        width: 15px;
        height: 15px;
        top: 25%;
        left: 20%;
    }

    .water-drop:nth-child(2) {
        width: 10px;
        height: 10px;
        top: 40%;
        right: 25%;
    }

    .water-drop:nth-child(3) {
        width: 12px;
        height: 12px;
        bottom: 30%;
        left: 30%;
    }

    .apple-text {
        text-align: center;
        font-size: 1.8rem;
        font-weight: bold;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    h1 {
        font-size: 2.5rem;

        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        color: white;
    }

    .permissions {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        margin-top: 2rem;
        font-size: 2.2rem;
        padding: 0 2rem;
        text-align: center;
    }

    .permission-item {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeIn 0.5s forwards;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .astronaut {
        position: fixed;
        bottom: -20px;
        left: 115px;
        width: 250px;
        animation: float 4s infinite ease-in-out;
        filter: drop-shadow(0 0 10px rgba(0, 0, 0, 0.3));
    }

    @keyframes glow {
        from {
            box-shadow: 0 0 20px rgba(144, 255, 66, 0.5);
        }

        to {
            box-shadow: 0 0 30px rgba(144, 255, 66, 0.8);
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0) rotate(3deg);
        }

        50% {
            transform: translateY(-20px) rotate(-3deg);
        }
    }

    @keyframes fadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 20px;
        }

        .header {
            flex-direction: column;
            text-align: center;
        }

        h1 {
            font-size: 2rem;
        }

        .permissions {
            grid-template-columns: 1fr;
            font-size: 1.8rem;
        }

        .astronaut {
            width: 150px;
            left: 20px;
        }
    }

    @media (max-width: 480px) {


        .apple-text {
            font-size: 1.5rem;
        }

        h1 {
            font-size: 1.8rem;
        }

        .permissions {
            font-size: 1.5rem;
            gap: 1rem;
        }

        .astronaut {
            width: 120px;
            left: 10px;
        }
    }
</style>

<div class="container" style="padding: 0px 125px;">
    <div class="header">
        <div class="apple">
            <div class="water-drop"></div>
            <div class="water-drop"></div>
            <div class="water-drop"></div>
            <div class="apple-text"> Allow</div>
            <div class="apple-text">All</div>
        </div>
        <h1>We need permission so<br>you can join the fun!</h1>
    </div>

    <div class="permissions">
        <div class="permission-item" style="animation-delay: 0.1s" onclick="window.location.href='{{route('termCondition')}}';">Camera</div>
        <div class="permission-item" style="animation-delay: 0.2s" onclick="window.location.href='{{route('termCondition')}}';">Photos/Media</div>
        <div class="permission-item" style="animation-delay: 0.3s" onclick="window.location.href='{{route('termCondition')}}';">Microphone</div>
        <div class="permission-item" style="animation-delay: 0.4s" onclick="window.location.href='{{route('termCondition')}}';">Notifications</div>
        <div class="permission-item" style="animation-delay: 0.5s" onclick="window.location.href='{{route('termCondition')}}';">Contacts</div>
        <div class="permission-item" style="animation-delay: 0.6s" onclick="window.location.href='{{route('termCondition')}}';">Location</div>
    </div>

    <img src="assets/img/Clippathgroup.svg" alt="Astronaut" class="astronaut">
</div>
<script>
    const apple = document.querySelector('.apple');
    const waterDrops = document.querySelectorAll('.water-drop');

    apple.addEventListener('mouseover', () => {
        waterDrops.forEach(drop => {
            drop.style.transform = 'scale(1.2)';
            drop.style.transition = 'transform 0.3s ease';
        });
    });

    apple.addEventListener('mouseout', () => {
        waterDrops.forEach(drop => {
            drop.style.transform = 'scale(1)';
        });
    });

    apple.addEventListener('click', () => {
        apple.style.transform = 'scale(0.95)';
        setTimeout(() => {
            apple.style.transform = 'scale(1)';
        }, 150);
        alert('Requesting permissions...');
    });

    document.querySelectorAll('.permission-item').forEach(item => {
        item.addEventListener('mouseover', () => {
            item.style.transform = 'scale(1.1)';
            item.style.textShadow = '0 0 10px rgba(255,255,255,0.8)';
        });

        item.addEventListener('mouseout', () => {
            item.style.transform = 'scale(1)';
            item.style.textShadow = '2px 2px 4px rgba(0,0,0,0.5)';
        });
    });
</script>
@include('frontend.layout.footer')
