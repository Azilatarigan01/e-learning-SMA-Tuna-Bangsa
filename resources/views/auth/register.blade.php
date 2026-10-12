<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SMA Tuna Bangsa - Register Page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- Section: Design Block -->
  <section>
    <!-- Jumbotron -->
    <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
      <div class="container">
        <div class="row gx-lg-5 align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <h1 class="my-5 display-3 fw-bold ls-tight">
              E Learning <br />
              <span class="text-primary">SMA Tuna Bangsa</span>
            </h1>
            <p style="color: hsl(217, 10%, 50.8%)">
              Empowering Minds
            </p>
          </div>

          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="card">
              <div class="card-body py-5 px-md-5">
                <form action="{{ url('register') }}" method="post">
                  {{ csrf_field() }}
                  
                  <!-- Full Name input -->
                  <div class="form-outline mb-4">
                    <input type="text" id="full_name" name="full_name" class="form-control" />
                    <label class="form-label" for="full_name">Full Name</label>
                  </div>

                  <!-- NIS/NIP/Email input -->
                  <div class="form-outline mb-4">
                    <input type="text" id="nis_nip_email" name="email" class="form-control" />
                    <label class="form-label" for="nis_nip_email">NIS/NIP/Email</label>
                  </div>
          
                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" />
                    <label class="form-label" for="password">Password</label>
                  </div>

                  <!-- Confirm Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" />
                    <label class="form-label" for="confirm_password">Confirm Password</label>
                  </div>
          
                  <!-- Submit button -->
                  <button type="submit" class="btn btn-primary btn-block mb-4">{{ ('Register') }}</button>
          
                  <!-- Login buttons -->
                  <div class="text-center">
                    <p>Already have an account? <a href="{{ url('login') }}">Login here</a></p>
                  </div>
                </form>
              </div>
            </div>
          </div>
          
    <!-- Jumbotron -->
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
