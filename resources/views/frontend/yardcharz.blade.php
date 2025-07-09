@include('frontend.layout.header')
<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 200 !important;
        font-style: normal;
        min-height: 100vh;
        background: #000;
        overflow: hidden;
        color: white;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover !important;
        background-image: url(assets/img/ssdRectangle.png) !important;
    }

    @keyframes twinkle {

        0%,
        100% {
            opacity: 0.3;
        }

        50% {
            opacity: 1;
        }
    }

    .content {
        position: relative;
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
        text-align: center;
    }

    .pricing {
        font-size: 2rem;
        margin: 1rem 0;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        opacity: 0;
        animation: fadeIn 0.5s forwards;
    }

    .pricing:nth-child(2) {
        animation-delay: 0.3s;
    }

    .pricing:nth-child(3) {
        animation-delay: 0.6s;
    }

    .payment-methods {
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin-top: 4rem;
        gap: 2rem;
        flex-wrap: wrap;
        /* Added this line for responsiveness */
    }

    .payment-icon {
        width: 120px;
        height: 120px;
        object-fit: contain;
        opacity: 0;
        animation: slideUp 0.5s forwards;
    }

    .payment-label {
        font-size: 2rem;
        margin-top: 1rem;
    }

    .astronaut {
        position: fixed;
        bottom: 16px;
        right: 2px;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
    }
    .button_proceed {
        display: inline-block;
        padding: 10px 35px;
        background-color: #3498db;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        position: absolute;
        right: 20px;
        top: 56%;
        transform: translateY(-50%);
    }

    .payment-methods>div {
        display: flex;
        flex-direction: column;
        align-items: center;
        animation: slideUp 0.5s forwards;
        opacity: 0;
    }

    .payment-methods>div:nth-child(1) {
        animation-delay: 0.9s;
    }

    .payment-methods>div:nth-child(2) {
        animation-delay: 1.2s;
    }

    .payment-methods>div:nth-child(3) {
        animation-delay: 1.5s;
    }

    /* Media Queries for responsiveness */
    @media (max-width: 768px) {
        .pricing {
            font-size: 2rem;
        }

        .payment-methods {
            gap: 1rem;
        }

        .payment-label {
            font-size: 1.5rem;
        }

        .payment-icon {
            width: 100px;
            height: 100px;
        }

        .astronaut {
            bottom: 10px;
            right: 10px;
        }
    }

    @media (max-width: 480px) {
        .pricing {
            font-size: 1.5rem;
        }

        .payment-methods {
            flex-direction: column;
            align-items: center;
        }

        .payment-label {
            font-size: 1.2rem;
        }

        .payment-icon {
            width: 80px;
            height: 80px;
        }
    }
    @media screen and (max-width: 896px) and (orientation: landscape) {
        .astronaut {
    bottom: 185px !important;
}
    }
</style>

<div class="content">
    <h1 class="pricing">YardChatz is $2 A Month</h1>
    <h2 class="pricing">$3 for Couples</h2>
    <h2 class="pricing">$5 for Families</h2>
    <h2 class="pricing" style="text-align: end;" >Or use our <br> Free Version </h2>
     <a href="{{route('free_version')}}" class="button_proceed">proceed</a>
 
    <div class="payment-methods">
         
        <div>
            <a href="{{route('Creditcard')}}" style="color:#fff; text-decoration: none;">
                <div class="payment-label">Creditcard</div>
                <img src="assets/img/ertrey.svg" alt="Credit Card" class="payment-icon">
            </a>
        </div>
        <div>
            <a href="{{route('venmo')}}" style="color:#fff; text-decoration: none;">
                <div class="payment-label">Venmo</div>
                <img src="assets/img/imagesxsd.svg" alt="Venmo" class="payment-icon">
            </a>
        </div>
        <div>
            <a href="{{route('apply_pay')}}" style="color:#fff; text-decoration: none;">
                
                <div class="payment-label">Apple Pay</div>
                <img src="assets/img/sxsGroup.svg" alt="Apple Pay" class="payment-icon">
            </a>
        </div>
    </div>
</div>
<img src="assets/img/Group.svg" alt="Astronaut" class="astronaut">

<script>
    // Create starry background
    function createStars() {
        const starsContainer = document.querySelector('.stars');
        const numberOfStars = 200;

        for (let i = 0; i < numberOfStars; i++) {
            const star = document.createElement('div');
            star.className = 'star';

            // Random position
            const x = Math.random() * 100;
            const y = Math.random() * 100;

            // Random size
            const size = Math.random() * 2;

            // Random twinkle duration
            const duration = 3 + Math.random() * 4;

            star.style.cssText = `
                    left: ${x}%;
                    top: ${y}%;
                    width: ${size}px;
                    height: ${size}px;
                    --duration: ${duration}s;
                `;

            starsContainer.appendChild(star);
        }
    }

    // Initialize stars on load
    window.addEventListener('load', createStars);
</script>
@include('frontend.layout.footer')
