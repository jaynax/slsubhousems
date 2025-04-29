<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>Login</title>
    <meta name="description" content="Login Page - SLSU BH Management System">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/NSB.png">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons & Bootstrap -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css">
    <link rel="stylesheet" href="../assets/vendor/css/core.css">
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css">
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
    
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: dimgray;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .login-container {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        h4 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 10px;
        }

        p {
            color: #ddd;
            margin-bottom: 20px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 16px;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-control:focus {
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .btn-primary {
            background: linear-gradient(to right, #ff9966, #ff5e62);
            border: none;
            font-size: 18px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(255, 94, 98, 0.5);
        }

        .password-toggle {
            position: relative;
        }

        .password-toggle .toggle-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: rgba(255, 255, 255, 0.7);
        }

        .text-danger {
            font-size: 14px;
        }

        a {
            color: #ff9966;
            font-weight: 500;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

<div class="login-container">
    <h4>Welcome to SLSU-BH MS</h4>
    <p>Please sign-in to your account</p>

    <!-- Laravel Login Form -->
    <form id="formAuthentication" action="{{ route('authenticate') }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="Email Address" required>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3 password-toggle">
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Password" required>
            <span class="toggle-btn bx bx-hide" onclick="togglePassword()"></span>
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <p class="mt-3">
        New on our platform? <a href="{{ route('register') }}">Create an account</a>
    </p>
</div>

<!-- Scripts -->
<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script>
    function togglePassword() {
        let passwordField = document.getElementById("password");
        let toggleBtn = document.querySelector(".toggle-btn");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleBtn.classList.replace("bx-hide", "bx-show");
        } else {
            passwordField.type = "password";
            toggleBtn.classList.replace("bx-show", "bx-hide");
        }
    }
</script>

</body>
</html>
