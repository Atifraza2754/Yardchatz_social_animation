<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url(assets/img/ssdRectangle.svg) center center / cover no-repeat fixed;
        }

        .register-wrapper {
            width: 100%;
            max-width: 420px;
            background-color: #fff;
            border-radius: 10px;
            padding: 15px; /* Reduced padding */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .register-wrapper img {
            width: 120px;
            display: block;
            margin: 0 auto 10px;
        }

        .input-group-text {
            background: #f8f9fa;
        }

        /* Adjust spacing for input fields */
        .form-label {
            font-size: 14px;

        }

        .mb-3 {
            margin-bottom: 12px; /* Reduced bottom margin */
        }

        /* Media query for small devices in landscape mode */
        @media (max-width: 576px) and (orientation: landscape) {
            body {
                align-items: flex-start;
                padding: 20px;
            }

            .register-wrapper {
                margin-top: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="register-wrapper">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
        <h4 class="text-center mb-4">Register</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- New Username Field -->
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input id="username" name="username" type="text"
                        class="form-control @error('username') is-invalid @enderror"
                        value="{{ old('username') }}" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input id="name" name="name" type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input id="email" name="email" type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Password Field -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input id="password" name="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Confirm Password Field -->
            <div class="mb-3">
                <label for="password-confirm" class="form-label">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input id="password-confirm" name="password_confirmation" type="password"
                        class="form-control @error('password_confirmation') is-invalid @enderror" required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Profile Picture Field -->
            <div class="mb-3">
                <label for="profile-picture" class="form-label">Profile Picture</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-upload"></i></span>
                    <input id="profile-picture" name="profile_picture" type="file"
                        class="form-control @error('profile-picture') is-invalid @enderror" required>
                    @error('profile-picture')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}">Already have an account? Log in</a>
            </div>
        </form>
    </div>
</body>

</html>
