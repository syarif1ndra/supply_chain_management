<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;800&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #5f6caf, #8a98e7);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }
        .card {
            background-color: #123640;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 40px;
        }
        .card-body h1 {
            font-size: 2rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 600;
            color: #fff;
        }
        .form-control {
            border-radius: 10px;
            padding: 10px;
            font-size: 1rem;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
        }
        .form-control:focus {
            border-color: #8a98e7;
            box-shadow: 0 0 5px rgba(138, 152, 231, 0.6);
        }
        .btn-primary {
            background-color: #8a98e7;
            border: none;
            padding: 12px 20px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 10px;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #7b87d8;
        }
        .form-check-label {
            font-size: 0.9rem;
        }
        .text-link-blue {
            color: #8a98e7;
        }
        .text-link-blue:hover {
            text-decoration: underline;
        }
        .back-btn {
            background-color: #6c757d;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            font-weight: 500;
        }
        .back-btn:hover {
            background-color: #5a6268;
        }
        .text-center a {
            color: #8a98e7;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
        .form-group input[type="submit"] {
            background-color: #8a98e7;
            border-radius: 5px;
        }
        .form-group input[type="submit"]:hover {
            background-color: #7b87d8;
        }
        .forgot-password {
            font-size: 0.9rem;
            color: #8a98e7;
            text-align: right;
            margin-top: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card shadow-lg p-4 mx-auto" style="max-width: 30rem;">
            <div class="card-body">
                <h1 class="text-center text-white fw-bold mb-4">Log In</h1>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group mb-3">
                        <x-input-label for="email" class="form-label text-white" :value="__('Email')" />
                        <x-text-input id="email" class="form-control form-control-lg bg-light fs-6" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email Address" />
                        <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-3">
                        <x-input-label for="password" class="form-label text-white" :value="__('Password')" />
                        <x-text-input id="password" class="form-control form-control-lg bg-light fs-6" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
                        <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />

                        <!-- Forgot Password Link -->
                        <div class="forgot-password">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                            @endif
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="form-check mb-3">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label text-white">{{ __('Remember me') }}</label>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-lg btn-primary w-100 fs-6" value="Log In">
                    </div>

                    <!-- Forgot Password and Sign Up -->
                    <div class="text-center text-white mb-3">
                        <small>Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none text-link-blue">Sign Up</a></small>
                    </div>

                    <!-- Back Button -->
                    <div class="text-center">
                        <a href="{{ url('/') }}" class="back-btn">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
