@include('frontend.layout.header')

<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
        background-image: url(assets/img/main.png);
        color: #fff

    }


    .main-section {
        text-align: center;
    }

    .logo-main {
        position: absolute;
        z-index: 99999999999999;
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
    <main>
        <section class="terms">
            <div class="container-terms">
                <div class="logo-main">
                    <img src="assets/img/logo.png" alt="" onclick="navigateTo('{{url('/')}}')">
                </div>
                <div class="main-section">
                    <h1>Terms And Conditions</h1>
                    <p>Welcome to our website. These are the terms and conditions governing your use of our website.</p>

                    <h2>Use of Website</h2>
                    <p>By accessing this website, you agree to comply with our terms of use. If you do not agree with
                        these terms, please do not use the website.</p>

                    <h2>Privacy Policy</h2>
                    <p>Your privacy is important to us. We collect and process personal information in accordance with
                        our privacy policy.</p>

                    <h2>Limitation of Liability</h2>
                    <p>We are not responsible for any damages or losses incurred through the use of our website.</p>

                    <h2>Changes to Terms</h2>
                    <p>We reserve the right to modify these terms at any time. Please review this page regularly for any
                        updates.</p>
                </div>
            </div>
        </section>
        <section>

            @include('frontend.layout.navbar')


            <script>
                function navigateTo(url) {
                    window.location.href = url; // Navigate to the provided URL
                }
            </script>
        </section>
    </main>



    <script src="script.js"></script>
    <script>
        document.getElementById("acceptBtn").addEventListener("click", function() {
            alert("You have accepted the terms and conditions.");
        });

        document.getElementById("declineBtn").addEventListener("click", function() {
            alert("You have declined the terms and conditions.");
        });
    </script>
    <script>
        function showText(id) {
            document.getElementById(id).style.display = 'block';
        }

        function hideText(id) {
            document.getElementById(id).style.display = 'none';
        }
    </script>
    <script>
        document.querySelectorAll('.navbar .icon').forEach(icon => {
            icon.addEventListener('click', function() {
                // Remove active class from all icons
                document.querySelectorAll('.navbar .icon').forEach(item => {
                    item.classList.remove('active');
                });

                // Add active class to the clicked icon
                this.classList.add('active');
            });
        });
    </script>
@include('frontend.layout.footer')
