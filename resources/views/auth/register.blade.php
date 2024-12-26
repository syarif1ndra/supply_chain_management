<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;800&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #8a98e7;
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            overflow: hidden;
        }
        .card {
            background-color: rgba(18, 54, 64, 0.9); /* Slightly darkened background for card */
            border-radius: 8px;
        }
        .card-body {
            padding: 2rem;
        }
        .text-link-blue {
            color: #0d6efd; /* Bootstrap primary color */
        }
        .text-link-blue:hover {
            text-decoration: underline;
        }
        .btn {
            font-size: 1rem;
            padding: 10px 30px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background-color: #8a98e7;
            border: none;
        }
        .btn-primary:hover {
            background-color: #8a98e7;
        }
        .btn-secondary {
            background-color: #34495e;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #2c3e50;
        }
        .btn-outline-primary {
            border: 2px solid #fff;
            color: #fff;
        }
        .btn-outline-primary:hover {
            background-color: #fff;
            color: #8a98e7;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card shadow-lg p-4 mx-auto" style="max-width: 30rem;">
            <div class="card-body">
                <h1 class="text-center text-white fw-bold mb-4">Sign Up</h1>
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div class="form-group mb-3">
                        <label for="name" class="form-label text-white">Name</label>
                        <input id="name" class="form-control form-control-lg bg-light fs-6" type="text" name="name" required autofocus placeholder="Full Name" />
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-3">
                        <label for="email" class="form-label text-white">Email</label>
                        <input id="email" class="form-control form-control-lg bg-light fs-6" type="email" name="email" required placeholder="Email Address" />
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-3">
                        <label for="password" class="form-label text-white">Password</label>
                        <input id="password" class="form-control form-control-lg bg-light fs-6" type="password" name="password" required placeholder="Password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group mb-4">
                        <label for="password_confirmation" class="form-label text-white">Confirm Password</label>
                        <input id="password_confirmation" class="form-control form-control-lg bg-light fs-6" type="password" name="password_confirmation" required placeholder="Confirm Password" />
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-primary w-100 fs-6" value="Sign Up">
                    </div>

                    <!-- Login Redirect -->
                    <div class="text-center text-white mb-3">
                        <small>Already have an account? <a href="{{ route('login') }}" class="text-link-blue text-decoration-none">Sign in</a></small>
                    </div>

                    <!-- Back Button -->
                    <div class="form-group text-center">
                        <a href="{{ url('/') }}" class="btn btn-secondary fs-6 px-4">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
