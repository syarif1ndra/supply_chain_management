<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to SCM Material</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #5f6caf, #8a98e7);
            font-family: 'Playfair Display', serif;
            color: #ffffff;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(135deg, #4a6d96, #6d7edd, #7b8cf5, #6c84ff);
            background-size: 400% 400%;
            z-index: -1;
            animation: gradientAnimation 15s ease infinite;
        }
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .container-fluid {
            text-align: center;
            z-index: 1;
            padding: 30px;
        }
        .display-3 {
            font-size: 5rem;
            font-weight: 700;
            color: #fff;
            text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.5);
            opacity: 0;
            animation: fadeIn 1.5s forwards 0.5s;
        }
        .lead {
            font-size: 1.6rem;
            font-weight: 400;
            color: #f0f0f0;
            margin-top: 20px;
            opacity: 0;
            animation: fadeIn 1.5s forwards 1s;
        }
        .btn {
            font-size: 1.2rem;
            padding: 12px 30px;
            border-radius: 50px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            font-family: 'Roboto', sans-serif;
        }
        .btn-primary {
            background-color: #8a98e7;
            border: none;
            color: white;
            opacity: 0;
            animation: fadeIn 1.5s forwards 1.5s;
        }
        .btn-outline-primary {
            border: 2px solid #fff;
            color: #fff;
            opacity: 0;
            animation: fadeIn 1.5s forwards 1.5s;
        }
        .btn-success {
            background-color: #27ae60;
            border-color: #27ae60;
            color: white;
            opacity: 0;
            animation: fadeIn 1.5s forwards 2s;
        }
        .btn:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Animasi responsif */
        @media (max-width: 768px) {
            .display-3 {
                font-size: 3rem;
            }
            .lead {
                font-size: 1.2rem;
            }
        }

    </style>
</head>
<body>
    <div class="animated-bg"></div>

    <div class="container-fluid">
        <div class="text-center">
            <h1 class="display-3 font-weight-bold">Selamat Datang di SCM Material</h1>
            <p class="lead">Kelola material Anda dengan mudah dan efisien</p>
            <div class="mt-4">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 py-2 me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-4 py-2">Register</a>
                @endguest
            </div>
        </div>
    </div>

</body>
</html>
