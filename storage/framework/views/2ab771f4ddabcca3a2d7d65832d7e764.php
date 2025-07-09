<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-w76A24a7KoHvjG3ROz5oGzeyPpC1qjErqa2i1p5H5vD0Dlj1k5FMOe3iqwosSI3K" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Irish Grover", serif;
            font-weight: 400;
            font-style: normal;
            background-image: url('<?php echo e(asset('assets/img/11.png')); ?>');
        }

        @media (max-width: 480px) {
            body {
                margin: 0;
                background-image: url(assets/img/tree2.jpg);
                background-size: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                overflow: hidden;
                background-image: url('<?php echo e(asset('assets/img/11.png')); ?>');
            }
        }

        .get_start {
            position: fixed;
            bottom: 50px;
            left: 20%;
            transform: translateX(-50%);
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 37px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .get_start:hover {
            background-color: #0056b3;
        }

        @media screen and (max-width: 896px) and (orientation: landscape) {
            .get_start {
                bottom: 10px;
                padding: 6px 14px;
                font-size: 16px;
                left: 10% !important;
                font-weight: 400;
            }
        }
    </style>
</head>

<body class="main-bakground-img">
    <div class="container">
        <a href="<?php echo e(route('login')); ?>" class="get_start">Get Start</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-QFhVmsAP/yds9NGNlR0MRoqh0hjCoNhthlZIu0DkLqq5/8ifJ44aNs1fgJqS3XiC" crossorigin="anonymous">
    </script>
</body>

</html>
<?php /**PATH E:\laragon\www\animation_social\animation_social_project\resources\views/welcome.blade.php ENDPATH**/ ?>