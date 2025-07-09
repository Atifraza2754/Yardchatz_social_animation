@include('frontend.layout.header')
<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 200 !important;
        font-style: normal;
        min-height: 100vh;
        background-size: cover;
        background-position: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-image: url('assets/img/imagedsd.svg');
    }

    .font-menu {
        position: fixed;
        top: 20%;
        left: 40px;
        background: #ffffff;
        border-radius: 12px;
        width: 200px;
        padding: 15px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        z-index: 100;
    }

    .font-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        user-select: none;
    }

    .font-header h3 {
        font-size: 16px;
        font-weight: 500;
    }

    .arrow {
        transition: transform 0.3s ease;
    }

    .font-options {
        margin-top: 15px;
        display: none;
        flex-direction: column;
        gap: 12px;
    }

    .font-options.active {
        display: flex;
    }

    .font-option {
        font-size: 15px;
        cursor: pointer;
        padding: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    .font-option:hover {
        opacity: 0.8;
    }

    .profile-card {
        position: fixed;
        top: 50%;
        right: 40px;
        transform: translateY(-50%);
        background: #ffffff;
        border-radius: 12px;
        padding: 25px;
        width: 320px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s, color 0.3s;
    }

    .field {
        margin-bottom: 18px;
    }

    .field:last-child {
        margin-bottom: 0;
    }

    .field-label {
        margin-bottom: 2px;
    }

    .field-value {
        display: inline;
        font-size: 15px;
        border-bottom: 1px solid #000;
        padding-bottom: 1px;
    }

    .underline {
        display: inline-block;
        width: 180px;
        height: 1px;
        background: #000;
        margin-left: 5px;
        vertical-align: middle;
    }

    .arrow.active {
        transform: rotate(180deg);
    }

    @media (max-width: 768px) {
        .font-menu {
            width: 150px;
            left: 10px;
            padding: 10px;
        }

        .font-header h3 {
            font-size: 14px;
        }

        .profile-card {
            width: 90%;
            right: 5%;
        }
    }

    @media (max-width: 480px) {
        .font-menu {
            width: 120px;
            left: 5px;
            padding: 8px;
        }

        .font-header h3 {
            font-size: 12px;
        }

        .profile-card {
            width: 65%;
            padding: 15px;
            right: 0;
            left: 0;
            margin: 0 auto;
        }

        .field-value {
            font-size: 13px;
        }

        .field-label {
            font-size: 13px;
        }

        .underline {
            width: 150px;
        }
    }
</style>

<div class="font-menu">
    <div class="font-header">
        <h3>Font</h3>
        <span class="arrow">▲</span>
    </div>
    <div class="font-options">
        <div class="font-option" data-color="#FF5733">Red Text</div>
        <div class="font-option" data-color="#1D8348">Green Text</div>
        <div class="font-option" data-color="#5B2C6F">Purple Text</div>
    </div>
    <div class="font-options">
        <div class="font-option" data-bg="red">Red Background</div>
        <div class="font-option" data-bg="green">Green Background</div>
        <div class="font-option" data-bg="purple">Purple Background</div>
    </div>
</div>

<div class="profile-card">
    <div class="field">
        <span class="field-label">Name:</span>
        <span class="field-value">John Appletree</span>
    </div>
    <div class="field">
        <span class="field-label">Workplace:</span>
        <span class="underline"></span>
    </div>
    <div class="field">
        <span class="field-label">School:</span>
        <span class="field-value">Northwestern</span>
    </div>
    <div class="field">
        <span class="field-label">Hometown:</span>
        <span class="field-value">Robertsdale, AL</span>
    </div>
    <div class="field">
        <span class="field-label">Birthday:</span>
        <span class="field-value">03/14/1984</span>
    </div>
</div>
@include('frontend.layout.navbar')
<script>
    const fontHeader = document.querySelector('.font-header');
    const fontOptions = document.querySelectorAll('.font-options');
    const arrow = document.querySelector('.arrow');
    const profileCard = document.querySelector('.profile-card');

    fontHeader.addEventListener('click', () => {
        fontOptions.forEach(option => option.classList.toggle('active'));
        arrow.classList.toggle('active');
    });

    fontOptions[0].querySelectorAll('.font-option').forEach(option => {
        option.addEventListener('click', () => {
            const color = option.getAttribute('data-color');
            profileCard.style.color = color;
        });
    });

    fontOptions[1].querySelectorAll('.font-option').forEach(option => {
        option.addEventListener('click', () => {
            const bg = option.getAttribute('data-bg');
            profileCard.style.backgroundColor = bg;
        });
    });
</script>
@include('frontend.layout.footer')
