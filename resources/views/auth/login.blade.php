<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login - E-Learning SMA Tuna Bangsa</title>
  <meta content="Masuk ke portal E-Learning SMA Tuna Bangsa untuk Siswa, Guru, dan Administrator." name="description">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo 1.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo 1.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Font Awesome 6 & Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    :root {
      --sis-primary: #851624;
      --sis-primary-dark: #680e1a;
      --sis-primary-deep: #520b14;
      --sis-primary-light: #fbecee;
      --sis-gold: #c59b27;
      --sis-dark: #1b1e24;
      --sis-muted: #5e6573;
      --sis-border: #e2e8f0;
      --sis-font-serif: 'Playfair Display', Georgia, serif;
      --sis-font-sans: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: var(--sis-font-sans);
      color: var(--sis-dark);
      background: linear-gradient(135deg, #fbfaf8 0%, #f1ebe3 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px 16px;
      position: relative;
      overflow-x: hidden;
    }

    /* Background decorative circles */
    .bg-circle-1 {
      position: fixed;
      top: -120px;
      right: -100px;
      width: 420px;
      height: 420px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(133, 22, 36, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
      pointer-events: none;
    }

    .bg-circle-2 {
      position: fixed;
      bottom: -150px;
      left: -120px;
      width: 500px;
      height: 500px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(197, 155, 39, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
      pointer-events: none;
    }

    .login-container {
      width: 100%;
      max-width: 960px;
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 20px 48px rgba(0, 0, 0, 0.08);
      overflow: hidden;
      display: grid;
      grid-template-columns: 1fr 1.15fr;
      position: relative;
      z-index: 10;
      border: 1px solid var(--sis-border);
    }

    /* Left banner */
    .login-sidebar {
      background: linear-gradient(145deg, #851624 0%, #5a0b16 100%);
      color: #ffffff;
      padding: 48px 36px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: relative;
      overflow: hidden;
    }

    .sidebar-watermark {
      position: absolute;
      right: -30px;
      bottom: -30px;
      width: 220px;
      height: 220px;
      opacity: 0.12;
      pointer-events: none;
    }

    .sidebar-brand {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 24px;
    }

    .sidebar-brand img {
      width: 48px;
      height: 48px;
      object-fit: contain;
      filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
    }

    .sidebar-brand-text h2 {
      font-family: var(--sis-font-serif);
      font-size: 20px;
      font-weight: 800;
      letter-spacing: 0.5px;
      line-height: 1.1;
    }

    .sidebar-brand-text p {
      font-size: 10px;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: #ffd8df;
      font-weight: 700;
    }

    .sidebar-content h1 {
      font-family: var(--sis-font-serif);
      font-size: 32px;
      line-height: 1.25;
      font-weight: 800;
      margin-bottom: 14px;
    }

    .sidebar-content p {
      font-size: 13.5px;
      color: #ffd8df;
      line-height: 1.6;
      margin-bottom: 28px;
    }

    .sidebar-features {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .sidebar-feat-item {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 13px;
      color: #ffffff;
    }

    .sidebar-feat-item i {
      color: #ffd700;
      font-size: 14px;
      width: 18px;
    }

    .sidebar-footer {
      font-size: 11.5px;
      color: #e5b3bb;
      border-top: 1px solid rgba(255, 255, 255, 0.15);
      padding-top: 18px;
      margin-top: 30px;
    }

    /* Right form */
    .login-form-box {
      padding: 44px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .form-header {
      margin-bottom: 20px;
    }

    .form-header h2 {
      font-family: var(--sis-font-serif);
      font-size: 26px;
      font-weight: 800;
      color: #1a1e24;
      margin-bottom: 6px;
    }

    .form-header p {
      font-size: 13px;
      color: var(--sis-muted);
    }

    /* Input groups */
    .form-group {
      margin-bottom: 16px;
    }

    .form-label {
      display: block;
      font-size: 12px;
      font-weight: 700;
      color: #2b303a;
      margin-bottom: 6px;
    }

    .input-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }

    .input-icon {
      position: absolute;
      left: 14px;
      color: #8c95a3;
      font-size: 14px;
      pointer-events: none;
    }

    .form-input {
      width: 100%;
      padding: 11px 40px 11px 40px;
      border: 1px solid var(--sis-border);
      border-radius: 6px;
      font-size: 13.5px;
      font-family: inherit;
      color: #1a1e24;
      background: #fdfdfd;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-input:focus {
      border-color: var(--sis-primary);
      box-shadow: 0 0 0 3px rgba(133, 22, 36, 0.12);
      background: #ffffff;
    }

    .toggle-password {
      position: absolute;
      right: 14px;
      color: #8c95a3;
      font-size: 14px;
      cursor: pointer;
      border: none;
      background: transparent;
    }

    .toggle-password:hover {
      color: var(--sis-primary);
    }

    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 12px;
      margin-bottom: 22px;
    }

    .remember-wrap {
      display: flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      color: #4a5260;
    }

    .forgot-link {
      color: var(--sis-primary);
      font-weight: 600;
      text-decoration: none;
    }

    .forgot-link:hover {
      text-decoration: underline;
    }

    .btn-login-submit {
      width: 100%;
      background-color: var(--sis-primary);
      color: #ffffff;
      font-size: 13.5px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      padding: 13px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      box-shadow: 0 4px 14px rgba(133, 22, 36, 0.28);
      transition: all 0.25s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .btn-login-submit:hover {
      background-color: var(--sis-primary-dark);
      transform: translateY(-1px);
      box-shadow: 0 6px 18px rgba(133, 22, 36, 0.35);
    }

    .back-home-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 12.5px;
      font-weight: 600;
      color: var(--sis-muted);
      margin-top: 20px;
      text-decoration: none;
      align-self: center;
    }

    .back-home-link:hover {
      color: var(--sis-primary);
    }

    /* Alert error box */
    .alert-error-box {
      background: #fdf2f2;
      border-left: 4px solid #ef4444;
      color: #991b1b;
      padding: 10px 14px;
      border-radius: 4px;
      font-size: 12.5px;
      margin-bottom: 18px;
    }

    @media (max-width: 820px) {
      .login-container {
        grid-template-columns: 1fr;
      }
      .login-sidebar {
        display: none;
      }
      .login-form-box {
        padding: 36px 24px;
      }
    }
  </style>
</head>

<body>

  <div class="bg-circle-1"></div>
  <div class="bg-circle-2"></div>

  <div class="login-container">
    
    <!-- Left Sidebar Branding -->
    <div class="login-sidebar">
      <div>
        <div class="sidebar-brand">
          <img src="{{ asset('assets/img/logo 1.png') }}" alt="Logo SMA Tuna Bangsa">
          <div class="sidebar-brand-text">
            <h2>SMA TUNA BANGSA</h2>
            <p>E-Learning & LMS Portal</p>
          </div>
        </div>

        <div class="sidebar-content">
          <h1>Selamat Datang di Portal Pembelajaran Digital</h1>
          <p>
            Akses sistem Computer-Based Testing (CBT), tugas mandiri, bank materi, dan komunikasi akademik secara terpadu.
          </p>

          <div class="sidebar-features">
            <div class="sidebar-feat-item">
              <i class="fa-solid fa-circle-check"></i>
              <span>Ujian Online (CBT) & Pengumuman Nilai</span>
            </div>
            <div class="sidebar-feat-item">
              <i class="fa-solid fa-circle-check"></i>
              <span>Pengumpulan Tugas (Homework) Terjadwal</span>
            </div>
            <div class="sidebar-feat-item">
              <i class="fa-solid fa-circle-check"></i>
              <span>Ruang Kolaborasi Guru & Siswa 24/7</span>
            </div>
          </div>
        </div>
      </div>

      <div class="sidebar-footer">
        Jln Ujung Batam, Lhokseumawe, Aceh Utara<br>
        &copy; 2026 SMA Tuna Bangsa.
      </div>

      <!-- Watermark illustration -->
      <svg class="sidebar-watermark" viewBox="0 0 100 100" fill="none" stroke="#ffffff" stroke-width="1.5">
        <rect x="25" y="45" width="50" height="50" rx="2"/>
        <path d="M20 45L50 15L80 45H20Z"/>
        <circle cx="50" cy="35" r="5"/>
        <line x1="50" y1="32" x2="50" y2="35"/>
        <line x1="50" y1="35" x2="53" y2="35"/>
      </svg>
    </div>

    <!-- Right Login Form -->
    <div class="login-form-box">
      
      <div class="form-header">
        <h2>Masuk Akun</h2>
        <p>Silakan masukkan email dan kata sandi Anda</p>
      </div>



      @include('message')

      <form action="{{ url('login') }}" method="POST">
        @csrf

        <!-- Email Field -->
        <div class="form-group">
          <label class="form-label" for="email">Alamat Email</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-envelope input-icon"></i>
            <input type="email" id="email" name="email" class="form-input" placeholder="contoh: nama@gmail.com" required autofocus value="{{ old('email') }}">
          </div>
        </div>

        <!-- Password Field -->
        <div class="form-group">
          <label class="form-label" for="password">Kata Sandi</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-lock input-icon"></i>
            <input type="password" id="password" name="password" class="form-input" placeholder="Masukkan kata sandi akun" required>
            <button type="button" class="toggle-password" onclick="togglePasswordVisibility()" title="Lihat Kata Sandi">
              <i class="fa-solid fa-eye" id="toggleIcon"></i>
            </button>
          </div>
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="form-options">
          <label class="remember-wrap">
            <input type="checkbox" name="remember" id="rememberMe">
            <span>Ingat Saya</span>
          </label>
          <a href="{{ route('forgotpassword') }}" class="forgot-link">Lupa Password?</a>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-login-submit">
          <i class="fa-solid fa-right-to-bracket"></i> MASUK SEKARANG
        </button>
      </form>

      <a href="/" class="back-home-link">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
      </a>

    </div>

  </div>

  <script>
    function togglePasswordVisibility() {
      const pwd = document.getElementById('password');
      const icon = document.getElementById('toggleIcon');
      if (pwd.type === 'password') {
        pwd.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        pwd.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }
  </script>
</body>

</html>
