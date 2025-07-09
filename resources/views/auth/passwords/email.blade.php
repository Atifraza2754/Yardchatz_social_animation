<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <meta name="description" content="Reset your password securely and quickly.">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
      body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-image: url('{{ asset('assets/img/ssdRectangle.svg') }}');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
}


        .login-card {
            width: 100%;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="card login-card">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="100">
                <h5 class="text-center">Reset Your Password</h5>

                <!-- Status Message -->
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required aria-describedby="emailHelp">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Password Reset Link</button>
                    <div class="text-center mt-2">
                        <a href="{{ route('login') }}">Back to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
