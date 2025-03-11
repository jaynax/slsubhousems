<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Welcome to SLSUBHMS</title>
  <meta name="description" content="Find the perfect boarding house with SLSUBHMS.">
  <meta name="keywords" content="boarding house, SLSU, SLSUBHMS, lodging, rent">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  
  <!-- Custom Styles -->
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }

    .welcome-section {
      text-align: center;
      color: white;
      margin-bottom: 20px;
    }

    .welcome-section h1 {
      font-size: 32px;
      font-weight: 700;
      animation: fadeIn 1s ease-in-out;
    }

    .welcome-section p {
      font-size: 18px;
      font-weight: 400;
      max-width: 500px;
      margin: 10px auto;
      line-height: 1.6;
    }

    .login-section {
      background: rgba(255, 255, 255, 0.15);
      border-radius: 12px;
      backdrop-filter: blur(10px);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      padding: 40px;
      width: 100%;
      max-width: 400px;
      text-align: center;
      animation: fadeIn 1s ease-in-out;
    }

    .login-form h2 {
      color: #fff;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .login-btn, .btn-register {
      background: linear-gradient(to right, #ff9966, #ff5e62);
      border: none;
      font-size: 18px;
      font-weight: 500;
      transition: all 0.3s ease;
      color: white;
      padding: 12px;
      border-radius: 50px;
      width: 100%;
      margin: 10px 0;
      text-decoration: none;
    }

    .login-btn:hover, .btn-register:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 10px rgba(255, 94, 98, 0.5);
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

    /* Responsive Footer */
    .footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      padding: 15px 0;
      text-align: center;
      color: white;
      font-size: 14px;
      font-weight: 500;
      box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.2);
    }

    .footer-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
    }

    .social-links {
      display: flex;
      gap: 15px;
    }

    .social-icon {
      color: white;
      font-size: 20px;
      transition: transform 0.3s, color 0.3s;
    }

    .social-icon:hover {
      transform: scale(1.2);
      color: #ff9966;
    }

    @media (max-width: 768px) {
      .footer {
        font-size: 12px;
        padding: 10px 0;
      }

      .social-icon {
        font-size: 18px;
      }
    }
  </style>
</head>

<body class="antialiased">
  <div class="welcome-section">
    <h1>Welcome to SLSUBHMS</h1>
    <p>Discover the best boarding houses near SLSU! Find a place that suits your needs and enjoy a comfortable stay.</p>
  </div>

  <div class="login-section">
    <div class="login-form">
      <h2>Get Started</h2>
      @if (Route::has('login'))
        <div>
          @auth
            <a href="{{ url('/dashboard') }}" class="login-btn">Home</a>
          @else
            <a href="{{ route('login') }}" class="login-btn">Log in</a>
            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="btn-register">Register</a>
            @endif
          @endauth
        </div>
      @endif
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-container">
      <p>&copy; {{ date('Y') }} SLSUBHMS. All rights reserved.</p>
      <div class="social-links">
        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
      </div>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
