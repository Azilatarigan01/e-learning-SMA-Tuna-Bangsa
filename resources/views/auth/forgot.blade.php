<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SMA Tuna Bangsa - Forgot Password Page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo 1.png" rel="icon">
  <link href="assets/img/logo 1.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  
  <style>
    body {
      background-image: url('assets/img/back.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .card {
      background: rgba(255, 255, 255, 0.9);
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card-body {
      position: relative;
      padding: 2rem;
    }
    .logo-img {
      width: 100px;
      margin-bottom: 20px;
    }
    .card-title {
      font-size: 30px;
      font-weight: 700;
      margin-bottom: 20px;
      color: #007bff;
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
      transition: background-color 0.3s;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    .form-control {
      border-radius: 10px;
    }
    .form-outline {
      position: relative;
    }
    .form-outline label {
      position: absolute;
      top: 10px;
      left: 15px;
      font-size: 14px;
      color: #495057;
      transition: all 0.3s;
    }
    .form-control:focus + label,
    .form-control:not(:placeholder-shown) + label {
      top: -10px;
      left: 10px;
      font-size: 12px;
      color: #007bff;
    }
    .form-check-label {
      font-size: 14px;
    }
    .link-text {
      font-size: 14px;
      color: #007bff;
    }
    .link-text:hover {
      text-decoration: underline;
    }
    .highlight {
      color: #ff4081;
    }
    .slogan {
      font-size: 18px;
      font-weight: 600;
      color: #333;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <!-- Section: Design Block -->
  <section>
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight">
            E-Learning Platform<br />
            <span class="text-primary">SMA Tuna Bangsa</span>
          </h1>
          <p class="slogan">
            Empowering Minds, Enriching Futures.
          </p>
          <p style="color: hsl(217, 10%, 50.8%)">
            Join us and unlock your full potential with top-notch education and a nurturing environment. <span class="highlight">Where dreams become reality and every student shines.</span>
          </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body text-center">
              @include('message')
              <img src="assets/img/logo.png" alt="Logo" class="logo-img">
              <h2 class="card-title">Forgot Password</h2>
              <form action="" method="post">
                {{ csrf_field() }}

                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="email" name="email" class="form-control" required placeholder=" " />
                  <label class="form-label" for="email">Email</label>
                </div>

                <!-- Submit button -->
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary btn-block mb-4">{{ __('Forgot') }}</button>
                </div>

                <!-- Register and Forgot Password buttons -->
                <div class="text-center">
                  <p>Don't have an account? <a href="{{ url('register') }}" class="link-text">Please register</a></p>
                  <p><a href="{{ url('login') }}" class="link-text">Login</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Section: Design Block -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>
