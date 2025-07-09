@include('frontend.layout.header')
<style>
    body {
        font-family: "Irish Grover", serif;
        min-height: 100vh;
        background: url('assets/img/imagsdsd.svg') no-repeat center center / cover fixed;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
        margin: 0;
    }

    .font-menu {
        position: fixed;
        top: 2%;
        left: 5%;
        width: 250px;
        z-index: 100;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .album-cover {
        text-align: center;
        margin-top: 20px;
    }

    .image-container {
        position: relative;
        max-width: 100%;
    }

    .album-image {
        /*width: 100%;*/
        max-width: 300px;
        margin: 0 auto;
    }

    .song-title {
        color: white;
        text-shadow: 2px 3px 0px black;
    }

    .song-title h1 {
        font-size: 22px;
        font-weight: bold;
        margin: 0;
    }

    .song-title h2 {
        font-size: 18px;
        margin-top: 10px;
    }

  .profile-card {
    position: fixed;
    top: 51%;
    transform: translateY(-50%);
    width: 80%;
    padding: 25px;
    color: #fff;
    text-align: center;
    font-size: 22px;
    font-weight: 700;
    box-sizing: border-box;
    border-radius: 8px;
    margin-left: 60%;
}

    .field {
        margin-bottom: 18px;
    }

    /* Media Queries for Responsiveness */
    @media (max-width: 1024px) {
        .font-menu {
            width: 220px;
            left: 4%;
        }

        .album-image {
            max-width: 280px;
        }

        .song-title h1 {
            font-size: 20px;
        }

        .song-title h2 {
            font-size: 16px;
        }

        .profile-card {
            font-size: 20px;
            width: 85%;
        }
    }

    @media (max-width: 768px) {
        .font-menu {
            width: 180px;
            left: 3%;
        }

        .album-image {
            max-width: 90%;
        }

        .song-title h1 {
            font-size: 18px;
        }

        .song-title h2 {
            font-size: 14px;
        }

        .profile-card {
            font-size: 18px;
            width: 90%;
            padding: 20px;
            margin-top: 125px;
        }
    }

    @media (max-width: 480px) {
        .font-menu {
            width: 150px;
            left: 2%;
        }


        .album-image {
            max-width: 80%;
        }

        .song-title h1 {
            font-size: 16px;
        }

        .song-title h2 {
            font-size: 12px;
        }

        .profile-card {
            font-size: 16px;
            width: 95%;
            padding: 15px;
            margin-top: 60px;
        }
    }
</style>

<div class="font-menu">
    <div class="album-cover">
        <div class="image-container">
            <img src="assets/img/imagesd.svg" alt="Album Cover" class="album-image">
        </div>
        <div class="song-title">
            <h1>GEORGE HARRISON</h1>
            <h2>"MY SWEET LORD"</h2>
        </div>
    </div>

    <div class="album-cover">
        <div class="image-container">
            <img src="assets/img/imagesssde.svg" alt="Album Cover" class="album-image">
        </div>
        <div class="song-title">
            <h1><img src="assets/img/imagdssds.svg" alt=""> Julie</h1>
        </div>
    </div>
</div>

<div class="profile-card">
    <div class="field">These are the lyrics to the song.</div>
    <div class="field">She may be able to see them or not.</div>
    <div class="field">The guy to the left is singing along too.</div>
    <div class="field">It’s her dad. They’ve never been happier.</div>
    <div class="field">Especially because she’s an independent lady.</div>
</div>
@include('frontend.layout.navbar')

@include('frontend.layout.footer')
