<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100dvh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url(assets/img/ssdRectangle.svg);
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .login-card {
            width: 600px;
            max-width: 400px;
            padding: 20px;
            border-radius: 8px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-card img {
            display: block;
            margin: 0 auto 15px;
        }

        @media (orientation: landscape) and (max-height: 500px) {
            body {
                align-items: flex-start;
                padding-top: 30px;
            }

            .login-card {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-card">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="100">
        <h5 class="text-center">Login to continue</h5>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="login" class="form-label">Email or Username</label>
                <div class="input-group">
                    <input type="text" id="login" name="login" class="form-control @error('login') is-invalid @enderror" value="{{ old('login') }}" required>
                    <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                    @error('login')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
        
            <button type="submit" class="btn btn-primary w-100">Log in</button>
        
            <div class="text-center mt-2">
                <a href="{{ route('password.request') }}">Forgot Your Password?</a>
            </div>
            <div class="text-center mt-2">
                <a href="{{ route('register') }}">Register</a>
            </div>
        </form>
        
    </div>
</body>

</html>
