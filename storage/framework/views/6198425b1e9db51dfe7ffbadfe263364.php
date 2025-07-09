<?php echo $__env->make('frontend.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
        align-items: center;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        /* background-image: url(assets/img/ssdRectangle.png); */
        background-image: url('<?php echo e(asset('assets/img/ssdRectangle.png')); ?>');
    }

    .gallery {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 2rem;
        flex-wrap: wrap;
        gap: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .section {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        transition: transform 0.3s ease;
    }

    .section:hover {
        transform: translateY(-10px);
    }

    .feed-title {
        font-family: 'Cinzel Decorative', cursive;
        color: white;
        font-size: 2.5rem;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        opacity: 0.9;
        transition: opacity 0.3s ease;
    }

    .section:hover .feed-title {
        opacity: 1;
    }

    .image-wrapper {
        width: 200px;
        height: 200px;
        overflow: hidden;
        border-radius: 10px;
        position: relative;
    }

    .image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .section:hover .image {
        transform: scale(1.1);
    }

    @media (max-width: 1200px) {
        .gallery {
            padding: 1rem;
        }

        .image-wrapper {
            width: 150px;
            height: 150px;
        }

        .feed-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 768px) {
        .gallery {
            flex-direction: column;
        }

        .section {
            width: 100%;
            max-width: 300px;
        }

        .image-wrapper {
            width: 100%;
            height: 200px;
        }
    }

    @media screen and (max-width: 896px) and (orientation: landscape) {
        .gallery {
            gap: 0 !important;
            bottom: 30px;
        }

        .section {
            gap: 0rem;
            transition: transform 0.3s ease;
        }
    }
</style>

<div class="gallery">
    <a href="<?php echo e(route('signal_audio')); ?>" style="text-decoration: none;">
        <div class="section">
            <h2 class="feed-title">Audio</h2>
            <div class="image-wrapper">
                <img src="assets/img/Rectangledsds.svg" alt="Audio equipment" class="image">
            </div>
        </div>
    </a>


    <a href="<?php echo e(route('stills')); ?>" style="text-decoration: none;">
        <div class="section">
            <h2 class="feed-title">Stills</h2>
            <div class="image-wrapper">
                <img src="assets/img/Groupdssd.svg" alt="Vintage camera" class="image">
            </div>
        </div>
    </a>

    <a href="<?php echo e(route('text_upload')); ?>" style="text-decoration: none;">
        <div class="section">
            <h2 class="feed-title">Text</h2>
            <div class="image-wrapper">
                <img src="assets/img/typewriter.svg" alt="Typewriter" class="image">
            </div>
        </div>
    </a>

    <a href="<?php echo e(route('live_page')); ?>" style="text-decoration: none;">
        <div class="section">
            <h2 class="feed-title">Video</h2>
            <div class="image-wrapper">
                <img src="assets/img/Groupsdsd.svg" alt="Retro TVs" class="image">
            </div>
        </div>
    </a>


    <a href="<?php echo e(route('live_screen')); ?>" style="text-decoration: none;">
        <div class="section">
            <h2 class="feed-title">Live</h2>
            <div class="image-wrapper">
                <img src="assets/img/Groupeeef.svg" alt="Camera setup" class="image">
            </div>
        </div>
    </a>

</div>
<?php echo $__env->make('frontend.layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('frontend.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH E:\laragon\www\animation_social\animation_social_project\resources\views/frontend/new_feed.blade.php ENDPATH**/ ?>