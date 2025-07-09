@include('frontend.layout.header')

<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
        margin: 0;
        padding: 20px;
        min-height: 100vh;
        color: #ffff00;
        line-height: 1.6;
        overflow-x: hidden;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-image: url(assets/img/ssdRectangle.svg);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        position: relative;
        z-index: 1;
        text-align: center;
        padding: 20px;
    }

    h1 {
        color: white;
        font-size: 4rem;
        margin-bottom: 10px;
        font-weight: normal;
    }

    h2 {
        color: white;
        font-size: 2.5rem;
        margin-bottom: 40px;
        font-weight: normal;
    }

    .content {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 40px;
    }

    .apple-container {
        position: relative;
        width: 250px;
        height: 250px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .apple-container:hover {
        transform: scale(1.05);
    }

    .apple-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .camera-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 1rem;
        text-align: center;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .id-card {
        background: white;
        padding: 15px;
        border-radius: 15px;
        width: 300px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        animation: float 6s ease-in-out infinite;
    }

    .id-header {
        background: #3498db;
        color: white;
        padding: 5px;
        text-align: center;
        border-radius: 5px;
        margin-bottom: 10px;
        font-size: 1.2rem;
    }

    .id-content {
        display: flex;
        gap: 15px;
    }

    .avatar {
        width: 80px;
        height: 80px;
        background: #f0f0f0;
        border-radius: 50%;
        overflow: hidden;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .info-placeholder {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .info-line {
        height: 10px;
        background: #e0e0e0;
        margin-bottom: 8px;
        border-radius: 5px;
    }

    .info-line:nth-child(1) {
        width: 100%;
    }

    .info-line:nth-child(2) {
        width: 80%;
    }

    .info-line:nth-child(3) {
        width: 60%;
    }

    .barcode {
        height: 40px;
        background: #333;
        margin-top: 15px;
        border-radius: 5px;
        padding: 8px 0px;
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

    @media (max-width: 768px) {
        .content {
            flex-direction: column;
        }

        h1 {
            font-size: 3rem;
        }

        h2 {
            font-size: 2rem;
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
        right: 170px;
        top: 85%;
        transform: translateY(-50%);
        z-index: 1100;
    }

    @media (max-width: 500px) {


        .button_proceed {
            display: inline-block;
            padding: 10px 35px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            position: absolute;
            right: 150px;
            top: 130%;
            transform: translateY(-50%);
            z-index: 1100;
        }

    }

</style>

<div class="container">
    <h1>Let's Get Started</h1>
    <h2>Take a picture of your ID Card</h2>

    <form action="{{ route('upload.id.card') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ✅ Display Success / Error Messages --}}
        @if(session('success'))
        <div style="color: #7bf432; margin-bottom: 20px;">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <div class="content">
            <div class="apple-camera-wrapper" id="camera-wrapper" style="min-height: 270px; visibility: hidden;">

                <div class="apple-container" id="camera-trigger">
                    <input type="file" accept="image/*" name="id_card" id="upload-id-card" style="display: none;">
                    <img src="assets/img/Clippatgroup.svg" alt="Green apple with camera" class="apple-image">
                    <div class="camera-text">
                        <img src="assets/img/Maskgroup.svg">
                        Upload Your Student <br>ID CARD
                    </div>
                </div>
            </div>

            <div class="id-card">
                <div class="id-header">ID CARD</div>
                <div class="id-content">
                    <div class="avatar">
                        <img id="preview-avatar" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80'%3E%3Crect width='80' height='80' fill='%23f0f0f0'/%3E%3Ccircle cx='40' cy='35' r='15' fill='%23e0e0e0'/%3E%3C/svg%3E" alt="Avatar preview">
                    </div>
                    <div class="info-placeholder">
                        <div class="info-line"></div>
                        <div class="info-line"></div>
                        <div class="info-line"></div>
                    </div>
                </div>
                <div class="barcode">
                    <button type="submit" style="color: #fff; background: none; border: none; font-size: 1rem;">Submit</button>
                </div>
            </div>
        </div>

        <div style="margin-left:160px ; margin-top:-10px;" class="card-footer">
            <input type="checkbox" id="is-student">
            <label for="is-student" style="color: white;">Are you Student?</label>
        </div>
    </form>
    <a href="{{ route('yardcharz') }}" class="button_proceed" id="proceed-button">proceed</a>
</div>


<script>
    const studentCheckbox = document.getElementById('is-student');
    const cameraWrapper = document.getElementById('camera-wrapper');

    studentCheckbox.addEventListener('change', function() {
        cameraWrapper.style.visibility = this.checked ? 'visible' : 'hidden';

    });

    const cameraTrigger = document.getElementById('camera-trigger');
    const fileInput = document.getElementById('upload-id-card');
    const previewAvatar = document.getElementById('preview-avatar');

    cameraTrigger.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => {
                previewAvatar.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });


    const checkbox = document.getElementById('is-student');
    const proceedButton = document.getElementById('proceed-button');

    checkbox.addEventListener('change', function () {
        proceedButton.style.display = this.checked ? 'none' : 'inline-block';
    });


</script>

@include('frontend.layout.footer')

