@include('frontend.layout.header')
<style>
        body {
            font-family: "Irish Grover", serif;
            font-weight: 200 !important;
            font-style: normal;
            min-height: 45vh;
            background-size: cover;
          
            background-repeat: no-repeat;
            background-image: url('assets/img/Profilsdsd.svg');
            height: 100%;
            overflow: hidden;
        }

        .profile-container {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .info-card {
            position: absolute;
    top: 40px;
    left: 20px;
    background-color: rgba(231, 76, 60, 0.9);
    padding: 20px;
    border-radius: 15px;
    color: white;
    font-size: 14px;
    font-weight: 800;
    line-height: 1.5;
    z-index: 10;
    text-align: center;
        }

        .info-card h2 {
            font-size: 24px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .decorative-frame {
            position: absolute;
            right: 0;
            top: 0;
            width: 65%;
            height: 100%;
            background-color: #e74c3c;
            clip-path: polygon(100% 0, 100% 100%, 0 100%, 30% 50%, 0 0);
            z-index: 1;
        }

        .frame-inner {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 80%;
            height: 90%;
            background-color: #1a237e;
            border-radius: 40px;
            overflow: hidden;
        }

        .floral-pattern {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 20%, #ff6b6b 0%, transparent 8%),
                radial-gradient(circle at 80% 20%, #ff6b6b 0%, transparent 8%),
                radial-gradient(circle at 20% 80%, #ff6b6b 0%, transparent 8%),
                radial-gradient(circle at 80% 80%, #ff6b6b 0%, transparent 8%),
                radial-gradient(circle at 50% 50%, #ff6b6b 0%, transparent 12%);
            background-size: 100px 100px;
            opacity: 0.1;
        }

        .nav-icons {
            position: absolute;
            bottom: 30px;
            right: 0;
            width: 65%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            z-index: 2;
        }

        .nav-icon {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
            text-decoration: none;
        }

        .icon-circle {
            width: 60px;
            height: 60px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 5px;
        }

        .nav-icon span {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .decorative-frame {
                width: 100%;
                clip-path: polygon(0 30%, 100% 0, 100% 100%, 0 100%);
            }

            .frame-inner {
                width: 90%;
                height: 60%;
            }

            .nav-icons {
                width: 100%;
                bottom: 20px;
            }

            .icon-circle {
                width: 50px;
                height: 50px;
            }

            .nav-icon span {
                font-size: 10px;
            }
        }
    </style>

    <div class="profile-container">
        <div class="info-card">
            <h2>Rick <br> Appleyard</h2>
            <p>Workplace: <br> Beau Box</p>
            <p>School: UWF</p>
            <p>Pensacola, FL</p>
            <p>B-Day: 01/29/86</p>
            <p>Loves:<br>The Outdoors</p>
        </div>

<!-- 
        <div class="nav-icons">
            <a href="#" class="nav-icon">
                <div class="icon-circle">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z" fill="white"/>
                    </svg>
                </div>
                <span>Map</span>
            </a>
            <a href="#" class="nav-icon">
                <div class="icon-circle">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.14 12.94C19.18 12.64 19.2 12.33 19.2 12C19.2 11.68 19.18 11.36 19.14 11.06L21.16 9.48C21.34 9.34 21.39 9.07 21.28 8.87L19.36 5.55C19.24 5.33 18.99 5.26 18.77 5.33L16.38 6.29C15.88 5.91 15.35 5.59 14.76 5.35L14.4 2.81C14.36 2.57 14.16 2.4 13.92 2.4H10.08C9.84 2.4 9.65 2.57 9.61 2.81L9.25 5.35C8.66 5.59 8.12 5.92 7.63 6.29L5.24 5.33C5.02 5.25 4.77 5.33 4.65 5.55L2.74 8.87C2.62 9.08 2.66 9.34 2.86 9.48L4.88 11.06C4.84 11.36 4.8 11.69 4.8 12C4.8 12.31 4.82 12.64 4.86 12.94L2.84 14.52C2.66 14.66 2.61 14.93 2.72 15.13L4.64 18.45C4.76 18.67 5.01 18.74 5.23 18.67L7.62 17.71C8.12 18.09 8.65 18.41 9.24 18.65L9.6 21.19C9.65 21.43 9.84 21.6 10.08 21.6H13.92C14.16 21.6 14.36 21.43 14.39 21.19L14.75 18.65C15.34 18.41 15.88 18.09 16.37 17.71L18.76 18.67C18.98 18.75 19.23 18.67 19.35 18.45L21.27 15.13C21.39 14.91 21.34 14.66 21.15 14.52L19.14 12.94ZM12 15.6C10.02 15.6 8.4 13.98 8.4 12C8.4 10.02 10.02 8.4 12 8.4C13.98 8.4 15.6 10.02 15.6 12C15.6 13.98 13.98 15.6 12 15.6Z" fill="white"/>
                    </svg>
                </div>
                <span>Settings</span>
            </a>
            <a href="#" class="nav-icon">
                <div class="icon-circle">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 14C9.33 14 4 15.34 4 18V20H20V18C20 15.34 14.67 14 12 14Z" fill="white"/>
                    </svg>
                </div>
                <span>Profile</span>
            </a>
            <a href="#" class="nav-icon">
                <div class="icon-circle">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.5 3C14.76 3 13.09 3.81 12 5.09C10.91 3.81 9.24 3 7.5 3C4.42 3 2 5.42 2 8.5C2 12.28 5.4 15.36 10.55 20.04L12 21.35L13.45 20.03C18.6 15.36 22 12.28 22 8.5C22 5.42 19.58 3 16.5 3ZM12.1 18.55L12 18.65L11.9 18.55C7.14 14.24 4 11.39 4 8.5C4 6.5 5.5 5 7.5 5C9.04 5 10.54 5.99 11.07 7.36H12.94C13.46 5.99 14.96 5 16.5 5C18.5 5 20 6.5 20 8.5C20 11.39 16.86 14.24 12.1 18.55Z" fill="white"/>
                    </svg>
                </div>
                <span>Friends</span>
            </a>
            <a href="#" class="nav-icon">
                <div class="icon-circle">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 2H4C2.9 2 2.01 2.9 2.01 4L2 22L6 18H20C21.1 18 22 17.1 22 16V4C22 2.9 21.1 2 20 2ZM18 14H6V12H18V14ZM18 11H6V9H18V11ZM18 8H6V6H18V8Z" fill="white"/>
                    </svg>
                </div>
                <span>Feed</span>
            </a>
            <a href="#" class="nav-icon">
                <div class="icon-circle">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 3H15V5H9V3ZM9 5H5V7H9V5ZM15 5V7H19V5H15ZM19 7V19H5V7H3V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V7H19ZM12 18C14.76 18 17 15.76 17 13C17 10.24 14.76 8 12 8C9.24 8 7 10.24 7 13C7 15.76 9.24 18 12 18ZM12 10C13.66 10 15 11.34 15 13C15 14.66 13.66 16 12 16C10.34 16 9 14.66 9 13C9 11.34 10.34 10 12 10Z" fill="white"/>
                    </svg>
                </div>
                <span>Cameras</span>
            </a>
        </div> -->
    </div>
       @include('frontend.layout.navbar')

    @include('frontend.layout.footer')
