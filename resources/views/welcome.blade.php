<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>E-Learning SMA Tuna Bangsa - Empowering Minds, Enriching Futures</title>
  <meta content="Platform E-Learning dan Ujian CBT Online SMA Tuna Bangsa Lhokseumawe. Sistem pembelajaran digital terpadu untuk siswa dan guru." name="description">
  <meta content="SMA Tuna Bangsa, E-Learning, LMS, Ujian Online, CBT, Homework, Lhokseumawe" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo 1.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo 1.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;0,900;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
      --sis-gold-light: #fef8e7;
      --sis-dark: #1b1e24;
      --sis-muted: #5e6573;
      --sis-light-bg: #f8f6f2;
      --sis-card-border: #e9ecef;
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
      background-color: #ffffff;
      line-height: 1.6;
      overflow-x: hidden;
    }

    a {
      text-decoration: none;
      color: inherit;
      transition: all 0.25s ease;
    }

    img {
      max-width: 100%;
      height: auto;
      display: block;
    }

    .container {
      width: 100%;
      max-width: 1260px;
      margin-left: auto;
      margin-right: auto;
      padding-left: 20px;
      padding-right: 20px;
    }

    /* ========================================================
       1. TOP BAR
    ======================================================== */
    .top-bar {
      background-color: var(--sis-primary-dark);
      color: #ffffff;
      font-size: 12.5px;
      padding: 8px 0;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .top-bar .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
    }

    .top-info {
      display: flex;
      align-items: center;
      gap: 20px;
      flex-wrap: wrap;
    }

    .top-info span {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      opacity: 0.95;
    }

    .top-info i {
      font-size: 12px;
      color: #ffd8df;
    }

    .top-links {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .top-links a {
      color: #ffffff;
      opacity: 0.92;
      font-weight: 500;
    }

    .top-links a:hover {
      opacity: 1;
      text-decoration: underline;
    }

    .top-links .divider {
      opacity: 0.35;
    }

    .top-socials {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      margin-left: 6px;
    }

    .top-socials a {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.15);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      transition: background 0.2s;
    }

    .top-socials a:hover {
      background: #ffffff;
      color: var(--sis-primary);
    }

    /* ========================================================
       2. MAIN HEADER & NAVBAR
    ======================================================== */
    .site-header {
      background-color: #ffffff;
      box-shadow: 0 2px 14px rgba(0, 0, 0, 0.06);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .nav-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 84px;
    }

    .brand-logo {
      display: flex;
      align-items: center;
      gap: 14px;
      cursor: pointer;
    }

    .brand-img-logo {
      width: 52px;
      height: 52px;
      object-fit: contain;
    }

    .brand-text {
      display: flex;
      flex-direction: column;
    }

    .brand-title {
      font-family: var(--sis-font-serif);
      font-size: 24px;
      font-weight: 800;
      color: var(--sis-primary);
      letter-spacing: 0.5px;
      line-height: 1.1;
    }

    .brand-subtitle {
      font-size: 10px;
      letter-spacing: 1.8px;
      font-weight: 700;
      color: #333842;
      text-transform: uppercase;
      margin-top: 2px;
    }

    .brand-tagline {
      font-size: 10px;
      color: #8c7355;
      font-style: italic;
      font-weight: 500;
    }

    .nav-menu {
      display: flex;
      align-items: center;
      gap: 24px;
      list-style: none;
    }

    .nav-item {
      position: relative;
    }

    .nav-link {
      font-size: 13.5px;
      font-weight: 700;
      color: #2b303a;
      letter-spacing: 0.3px;
      padding: 10px 0;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    .nav-link i.fa-chevron-down {
      font-size: 9px;
      color: #7a8290;
      transition: transform 0.2s;
    }

    .nav-link:hover, .nav-link.active {
      color: var(--sis-primary);
    }

    .nav-link.active::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 3px;
      background-color: var(--sis-primary);
      border-radius: 2px;
    }

    .dropdown-menu {
      position: absolute;
      top: 100%;
      left: 0;
      background: #ffffff;
      min-width: 220px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
      border-radius: 6px;
      padding: 8px 0;
      opacity: 0;
      visibility: hidden;
      transform: translateY(10px);
      transition: all 0.25s ease;
      z-index: 999;
      list-style: none;
      border: 1px solid #edf0f5;
    }

    .nav-item:hover .dropdown-menu {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    .dropdown-menu li a {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 9px 18px;
      font-size: 13px;
      font-weight: 500;
      color: #3b4252;
    }

    .dropdown-menu li a i {
      color: var(--sis-primary);
      font-size: 12px;
      width: 16px;
    }

    .dropdown-menu li a:hover {
      background: var(--sis-primary-light);
      color: var(--sis-primary);
      padding-left: 22px;
    }

    .header-actions {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .btn-login-header {
      background-color: var(--sis-primary);
      color: #ffffff;
      font-size: 13px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.6px;
      padding: 10px 22px;
      border-radius: 4px;
      border: none;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 4px 12px rgba(133, 22, 36, 0.25);
      transition: all 0.25s ease;
    }

    .btn-login-header:hover {
      background-color: var(--sis-primary-dark);
      transform: translateY(-1px);
      color: #ffffff;
    }

    .btn-search {
      background: transparent;
      border: none;
      font-size: 16px;
      color: #2b303a;
      cursor: pointer;
      padding: 8px;
      transition: color 0.2s;
    }

    .btn-search:hover {
      color: var(--sis-primary);
    }

    .mobile-toggle {
      display: none;
      background: none;
      border: none;
      font-size: 24px;
      color: var(--sis-dark);
      cursor: pointer;
    }

    /* ========================================================
       3. HERO SECTION
    ======================================================== */
    .hero-section {
      background: linear-gradient(135deg, #fcfbf9 0%, #f4efe9 100%);
      padding: 46px 0 38px 0;
      position: relative;
      overflow: hidden;
    }

    .hero-grid {
      display: grid;
      grid-template-columns: 1.15fr 0.95fr 0.9fr;
      align-items: center;
      gap: 28px;
    }

    .hero-content {
      padding-right: 10px;
    }

    .hero-kicker {
      font-size: 11.5px;
      font-weight: 800;
      letter-spacing: 1.8px;
      text-transform: uppercase;
      color: #434955;
      margin-bottom: 12px;
      display: inline-block;
    }

    .hero-title {
      font-family: var(--sis-font-serif);
      font-size: 50px;
      line-height: 1.12;
      font-weight: 800;
      color: #1e2229;
      margin-bottom: 18px;
    }

    .hero-title .text-maroon {
      color: var(--sis-primary);
    }

    .hero-description {
      font-size: 15.5px;
      color: var(--sis-muted);
      line-height: 1.6;
      margin-bottom: 26px;
      max-width: 440px;
    }

    .hero-buttons {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 32px;
      flex-wrap: wrap;
    }

    .btn-hero-primary {
      background-color: var(--sis-primary);
      color: #ffffff;
      font-size: 12.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.6px;
      padding: 12px 22px;
      border-radius: 4px;
      box-shadow: 0 4px 14px rgba(133, 22, 36, 0.28);
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-hero-primary:hover {
      background-color: var(--sis-primary-dark);
      color: #ffffff;
    }

    .btn-hero-secondary {
      background-color: #ffffff;
      color: var(--sis-primary);
      font-size: 12.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.6px;
      padding: 11px 22px;
      border-radius: 4px;
      border: 1.5px solid var(--sis-primary);
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .btn-hero-secondary:hover {
      background-color: var(--sis-primary);
      color: #ffffff;
    }

    .hero-features-row {
      display: flex;
      align-items: flex-start;
      gap: 16px;
      border-top: 1px solid rgba(0, 0, 0, 0.08);
      padding-top: 22px;
    }

    .hero-feature-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      flex: 1;
    }

    .hero-feature-icon {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      border: 1.5px solid #c9939b;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--sis-primary);
      font-size: 14px;
      margin-bottom: 8px;
      background: rgba(255, 255, 255, 0.85);
    }

    .hero-feature-item span {
      font-size: 10.5px;
      font-weight: 600;
      color: #3b4252;
      line-height: 1.3;
    }

    /* Hero Center Image */
    .hero-image-wrap {
      position: relative;
      text-align: center;
    }

    .hero-image-wrap img {
      border-radius: 12px;
      box-shadow: 0 14px 34px rgba(0, 0, 0, 0.12);
      width: 100%;
      max-height: 480px;
      object-fit: cover;
    }

    .hero-badge-overlay {
      position: absolute;
      bottom: 22px;
      right: 18px;
      background: var(--sis-primary-dark);
      color: #ffd8df;
      padding: 8px 14px;
      border-radius: 6px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.8px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
    }

    /* Hero LMS Fast Login / Enquire Card */
    .lms-login-card {
      background: #ffffff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 16px 36px rgba(0, 0, 0, 0.1);
      border: 1px solid #edf0f5;
    }

    .lms-card-header {
      background-color: var(--sis-primary);
      color: #ffffff;
      padding: 18px 22px;
      text-align: left;
    }

    .lms-card-header h3 {
      font-size: 16px;
      font-weight: 800;
      letter-spacing: 0.8px;
      text-transform: uppercase;
      margin-bottom: 3px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .lms-card-header p {
      font-size: 12px;
      opacity: 0.9;
    }

    .lms-card-body {
      padding: 22px;
      display: flex;
      flex-direction: column;
      gap: 13px;
    }

    .form-control-sis {
      width: 100%;
      padding: 10px 14px;
      border: 1px solid #d5dbe4;
      border-radius: 5px;
      font-size: 13px;
      font-family: inherit;
      color: #2b303a;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
      background-color: #fbfcfd;
    }

    .form-control-sis:focus {
      border-color: var(--sis-primary);
      box-shadow: 0 0 0 3px rgba(133, 22, 36, 0.12);
      background-color: #ffffff;
    }

    .btn-submit-lms {
      background-color: var(--sis-primary);
      color: #ffffff;
      font-size: 13px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      padding: 12px 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 4px;
      transition: all 0.25s ease;
      box-shadow: 0 4px 12px rgba(133, 22, 36, 0.25);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .btn-submit-lms:hover {
      background-color: var(--sis-primary-dark);
      transform: translateY(-1px);
    }

    .lms-links-extra {
      display: flex;
      justify-content: space-between;
      font-size: 11.5px;
      color: var(--sis-muted);
      margin-top: 2px;
    }

    .lms-links-extra a {
      color: var(--sis-primary);
      font-weight: 600;
    }

    .lms-links-extra a:hover {
      text-decoration: underline;
    }

    /* ========================================================
       4. SECTION: TENTANG KAMI & VISI MISI
    ======================================================== */
    .welcome-section {
      padding: 70px 0;
      background: #ffffff;
    }

    .welcome-grid {
      display: grid;
      grid-template-columns: 0.88fr 1fr 0.92fr;
      align-items: center;
      gap: 36px;
    }

    .welcome-img-card {
      position: relative;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
    }

    .welcome-img-card img {
      width: 100%;
      height: 330px;
      object-fit: cover;
    }

    .welcome-text {
      padding-right: 10px;
    }

    .section-kicker {
      font-size: 12px;
      font-weight: 800;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: var(--sis-primary);
      margin-bottom: 8px;
      display: block;
    }

    .section-heading {
      font-family: var(--sis-font-serif);
      font-size: 32px;
      font-weight: 800;
      color: #1a1e24;
      line-height: 1.25;
      margin-bottom: 16px;
    }

    .welcome-text p {
      font-size: 14px;
      color: var(--sis-muted);
      line-height: 1.7;
      margin-bottom: 16px;
    }

    .vision-mission-box {
      background: #fbf9f6;
      border-left: 3px solid var(--sis-primary);
      padding: 12px 16px;
      border-radius: 0 6px 6px 0;
      margin-bottom: 22px;
    }

    .vision-mission-box h5 {
      font-size: 13px;
      font-weight: 700;
      color: var(--sis-primary);
      margin-bottom: 4px;
    }

    .vision-mission-box p {
      font-size: 12.5px;
      margin-bottom: 0;
      color: #4b5260;
    }

    .btn-outline-sis {
      display: inline-block;
      font-size: 12.5px;
      font-weight: 700;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      padding: 10px 22px;
      border: 1.5px solid #2b303a;
      border-radius: 4px;
      color: #2b303a;
      background: transparent;
      transition: all 0.25s ease;
    }

    .btn-outline-sis:hover {
      background-color: var(--sis-primary);
      border-color: var(--sis-primary);
      color: #ffffff;
    }

    .stats-grid-welcome {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px 24px;
    }

    .stat-badge-item {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .stat-badge-icon {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      border: 1.5px solid #deb5bb;
      background: var(--sis-primary-light);
      color: var(--sis-primary);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
    }

    .stat-badge-content h4 {
      font-size: 20px;
      font-weight: 800;
      color: #1c2027;
      line-height: 1.1;
      margin-bottom: 3px;
    }

    .stat-badge-content p {
      font-size: 11.5px;
      color: #555c68;
      font-weight: 600;
      line-height: 1.3;
    }

    /* ========================================================
       5. SECTION: FITUR & MODUL E-LEARNING
    ======================================================== */
    .programs-section {
      padding: 60px 0 70px 0;
      background: #fafaf8;
    }

    .section-header-center {
      text-align: center;
      margin-bottom: 44px;
    }

    .programs-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 20px;
    }

    .program-card {
      background: #ffffff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
      border: 1px solid var(--sis-card-border);
      display: flex;
      flex-direction: column;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .program-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 28px rgba(133, 22, 36, 0.12);
    }

    .program-thumb-wrap {
      position: relative;
      height: 160px;
      overflow: hidden;
    }

    .program-thumb-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.35s ease;
    }

    .program-card:hover .program-thumb-wrap img {
      transform: scale(1.05);
    }

    .program-circle-icon {
      position: absolute;
      top: 10px;
      left: 10px;
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: var(--sis-primary);
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .program-body {
      padding: 18px 16px;
      display: flex;
      flex-direction: column;
      flex-grow: 1;
    }

    .program-body h3 {
      font-size: 15.5px;
      font-weight: 800;
      color: #1a1e24;
      margin-bottom: 4px;
    }

    .program-punchline {
      font-size: 11.5px;
      font-weight: 700;
      color: var(--sis-primary);
      margin-bottom: 8px;
    }

    .program-desc {
      font-size: 12px;
      color: var(--sis-muted);
      line-height: 1.5;
      margin-bottom: 16px;
      flex-grow: 1;
    }

    .program-link {
      font-size: 11px;
      font-weight: 800;
      color: var(--sis-primary);
      letter-spacing: 0.5px;
      text-transform: uppercase;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    .program-link:hover {
      color: var(--sis-primary-dark);
      gap: 8px;
    }

    /* ========================================================
       6. CRIMSON STATS HIGHLIGHT BAR
    ======================================================== */
    .crimson-stats-bar {
      background-color: var(--sis-primary);
      color: #ffffff;
      padding: 34px 0;
    }

    .crimson-stats-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      align-items: center;
      text-align: center;
      gap: 20px;
    }

    .crimson-stat-box {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 14px;
      border-right: 1px solid rgba(255, 255, 255, 0.15);
      padding-right: 15px;
    }

    .crimson-stat-box:last-child {
      border-right: none;
      padding-right: 0;
    }

    .crimson-stat-icon {
      font-size: 26px;
      color: #ffd8df;
    }

    .crimson-stat-info {
      text-align: left;
    }

    .crimson-stat-info h3 {
      font-size: 22px;
      font-weight: 800;
      line-height: 1.1;
      margin-bottom: 2px;
    }

    .crimson-stat-info p {
      font-size: 11px;
      font-weight: 600;
      color: #ffccd4;
      text-transform: capitalize;
    }

    /* ========================================================
       7. SECTION: DEWAN GURU & PENGAJAR
    ======================================================== */
    .teachers-section {
      padding: 65px 0 75px 0;
      background: #ffffff;
    }

    .teachers-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
    }

    .teacher-card {
      background: #ffffff;
      border-radius: 10px;
      overflow: hidden;
      border: 1px solid #edf0f5;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      text-align: center;
    }

    .teacher-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 14px 28px rgba(133, 22, 36, 0.14);
      border-color: #e5b3bb;
    }

    .teacher-img-wrap {
      position: relative;
      height: 240px;
      overflow: hidden;
      background: #f1f3f7;
    }

    .teacher-img-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.35s ease;
    }

    .teacher-card:hover .teacher-img-wrap img {
      transform: scale(1.06);
    }

    .teacher-socials {
      position: absolute;
      bottom: -40px;
      left: 0;
      width: 100%;
      display: flex;
      justify-content: center;
      gap: 8px;
      padding: 8px 0;
      background: rgba(133, 22, 36, 0.88);
      backdrop-filter: blur(4px);
      transition: bottom 0.3s ease;
    }

    .teacher-card:hover .teacher-socials {
      bottom: 0;
    }

    .teacher-socials a {
      color: #ffffff;
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.2);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
    }

    .teacher-socials a:hover {
      background: #ffffff;
      color: var(--sis-primary);
    }

    .teacher-info {
      padding: 18px 16px;
    }

    .teacher-info h4 {
      font-size: 15px;
      font-weight: 800;
      color: #1a1e24;
      margin-bottom: 4px;
    }

    .teacher-badge {
      display: inline-block;
      font-size: 11px;
      font-weight: 700;
      color: var(--sis-primary);
      background: var(--sis-primary-light);
      padding: 3px 10px;
      border-radius: 20px;
      margin-bottom: 8px;
    }

    .teacher-role {
      font-size: 12px;
      color: var(--sis-muted);
    }

    /* ========================================================
       8. SECTION: FASILITAS & KEGIATAN UNGGULAN
    ======================================================== */
    .activities-section {
      padding: 60px 0 70px 0;
      background: #fbfaf8;
    }

    .activities-grid {
      display: grid;
      grid-template-columns: repeat(6, 1fr);
      gap: 16px;
    }

    .activity-card {
      position: relative;
      border-radius: 8px;
      overflow: hidden;
      height: 170px;
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
      cursor: pointer;
    }

    .activity-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.35s ease;
    }

    .activity-card:hover img {
      transform: scale(1.08);
    }

    .activity-overlay-tag {
      position: absolute;
      bottom: 8px;
      left: 8px;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(4px);
      padding: 5px 10px;
      border-radius: 4px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .activity-overlay-tag i {
      font-size: 11px;
      color: var(--sis-primary);
    }

    .activity-overlay-tag span {
      font-size: 11px;
      font-weight: 700;
      color: #22262d;
    }

    /* ========================================================
       9. SECTION: BOTTOM 3-COLUMN HIGHLIGHTS
    ======================================================== */
    .bottom-triplet-section {
      padding: 40px 0 65px 0;
      background: #ffffff;
    }

    .triplet-grid {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 24px;
    }

    /* Card 1: Testimoni */
    .parents-card {
      background: #ffffff;
      border-radius: 10px;
      padding: 26px;
      border: 1px solid var(--sis-card-border);
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
      display: flex;
      flex-direction: column;
    }

    .card-label-small {
      font-size: 13.5px;
      font-weight: 800;
      letter-spacing: 0.6px;
      text-transform: uppercase;
      color: #252a32;
      margin-bottom: 16px;
    }

    .quote-icon {
      font-size: 28px;
      color: var(--sis-primary);
      margin-bottom: 6px;
      line-height: 1;
    }

    .testimonial-text {
      font-size: 13px;
      color: var(--sis-muted);
      line-height: 1.6;
      margin-bottom: 20px;
      font-style: italic;
      flex-grow: 1;
    }

    .testimonial-author-wrap {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 14px;
    }

    .author-avatar {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--sis-primary-light);
    }

    .author-info h4 {
      font-size: 13px;
      font-weight: 700;
      color: #1e2229;
      line-height: 1.2;
    }

    .author-info p {
      font-size: 11px;
      color: #727a88;
    }

    .star-rating {
      color: #f59e0b;
      font-size: 11px;
      margin-top: 2px;
    }

    .slider-dots {
      display: flex;
      gap: 6px;
    }

    .slider-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: #d3d7de;
      cursor: pointer;
    }

    .slider-dot.active {
      background: var(--sis-primary);
      width: 14px;
      border-radius: 3px;
    }

    /* Card 2: Pengumuman & Jadwal */
    .announcements-card {
      background: #ffffff;
      border-radius: 10px;
      padding: 26px;
      border: 1px solid var(--sis-card-border);
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
      position: relative;
      overflow: hidden;
    }

    .announcements-list {
      display: flex;
      flex-direction: column;
      gap: 14px;
      position: relative;
      z-index: 2;
    }

    .announcement-item {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .date-badge {
      width: 44px;
      height: 44px;
      border-radius: 6px;
      overflow: hidden;
      border: 1px solid #d5a5ac;
      text-align: center;
      flex-shrink: 0;
      background: #ffffff;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .date-badge-month {
      background: var(--sis-primary);
      color: #ffffff;
      font-size: 8.5px;
      font-weight: 800;
      text-transform: uppercase;
      padding: 2px 0;
      line-height: 1;
    }

    .date-badge-day {
      font-size: 16px;
      font-weight: 800;
      color: #1a1e24;
      line-height: 1.4;
    }

    .announcement-info h4 {
      font-size: 12px;
      font-weight: 700;
      color: #22262d;
      line-height: 1.3;
      margin-bottom: 2px;
    }

    .announcement-info a {
      font-size: 10.5px;
      font-weight: 700;
      color: var(--sis-primary);
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }

    .announcement-info a:hover {
      text-decoration: underline;
    }

    .megaphone-bg-art {
      position: absolute;
      right: 10px;
      bottom: 12px;
      width: 86px;
      height: 86px;
      opacity: 0.92;
      pointer-events: none;
    }

    /* Card 3: Ruang Ujian CBT / E-Learning */
    .tour-card {
      background: linear-gradient(145deg, #851624 0%, #680e1a 100%);
      border-radius: 10px;
      padding: 28px;
      color: #ffffff;
      box-shadow: 0 8px 24px rgba(133, 22, 36, 0.28);
      position: relative;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .tour-card-content {
      position: relative;
      z-index: 2;
    }

    .tour-card h3 {
      font-size: 15px;
      font-weight: 800;
      letter-spacing: 0.6px;
      text-transform: uppercase;
      margin-bottom: 10px;
    }

    .tour-card p {
      font-size: 13px;
      color: #ffd8df;
      line-height: 1.5;
      margin-bottom: 26px;
      max-width: 240px;
    }

    .btn-book-tour {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: #ffffff;
      color: var(--sis-primary);
      font-size: 12.5px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.6px;
      padding: 11px 20px;
      border-radius: 4px;
      transition: all 0.25s ease;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      border: none;
      cursor: pointer;
    }

    .btn-book-tour:hover {
      background: #fbf2f4;
      transform: translateY(-2px);
    }

    .tour-watermark {
      position: absolute;
      right: -10px;
      bottom: -15px;
      width: 140px;
      height: 140px;
      opacity: 0.15;
      pointer-events: none;
    }

    /* ========================================================
       10. FOOTER
    ======================================================== */
    .site-footer {
      background-color: var(--sis-primary-dark);
      color: #ffffff;
      padding-top: 54px;
    }

    .footer-grid {
      display: grid;
      grid-template-columns: 1.3fr 0.85fr 0.85fr 0.85fr 1.1fr 1.15fr;
      gap: 26px;
      padding-bottom: 44px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.12);
    }

    .footer-brand .brand-title {
      color: #ffffff;
      font-size: 20px;
    }

    .footer-brand .brand-subtitle {
      color: #ffd8df;
    }

    .footer-brand p {
      font-size: 12px;
      color: #ffd8df;
      margin: 14px 0 18px 0;
      line-height: 1.6;
    }

    .footer-social-links {
      display: flex;
      gap: 10px;
    }

    .footer-social-links a {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.12);
      color: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      transition: all 0.2s;
    }

    .footer-social-links a:hover {
      background: #ffffff;
      color: var(--sis-primary);
    }

    .footer-col h4 {
      font-size: 13px;
      font-weight: 800;
      letter-spacing: 0.8px;
      text-transform: uppercase;
      color: #ffffff;
      margin-bottom: 16px;
    }

    .footer-nav-list {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 9px;
    }

    .footer-nav-list li a {
      font-size: 12px;
      color: #ffd8df;
      transition: color 0.2s;
    }

    .footer-nav-list li a:hover {
      color: #ffffff;
      text-decoration: underline;
    }

    .footer-contact-info {
      display: flex;
      flex-direction: column;
      gap: 11px;
    }

    .contact-item {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      font-size: 12px;
      color: #ffd8df;
      line-height: 1.45;
    }

    .contact-item i {
      font-size: 13px;
      color: #ffffff;
      margin-top: 2px;
    }

    .newsletter-form {
      margin-top: 12px;
    }

    .newsletter-form p {
      font-size: 12px;
      color: #ffd8df;
      margin-bottom: 10px;
      line-height: 1.4;
    }

    .newsletter-input-group {
      display: flex;
      background: #ffffff;
      border-radius: 4px;
      overflow: hidden;
      padding: 3px;
    }

    .newsletter-input-group input {
      border: none;
      outline: none;
      padding: 8px 12px;
      font-size: 12px;
      width: 100%;
      font-family: inherit;
      color: #1a1e24;
    }

    .newsletter-input-group button {
      background: var(--sis-primary);
      color: #ffffff;
      border: none;
      padding: 8px 14px;
      cursor: pointer;
      border-radius: 3px;
      font-size: 13px;
      transition: background 0.2s;
    }

    .newsletter-input-group button:hover {
      background: var(--sis-primary-dark);
    }

    .footer-bottom-bar {
      padding: 18px 0;
      background-color: var(--sis-primary-deep);
      font-size: 11.5px;
      color: #e5b3bb;
    }

    .footer-bottom-bar .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
    }

    .footer-legal-links {
      display: flex;
      gap: 16px;
    }

    .footer-legal-links a {
      color: #e5b3bb;
    }

    .footer-legal-links a:hover {
      color: #ffffff;
      text-decoration: underline;
    }

    /* Modal for campus tour / search */
    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(3px);
      z-index: 2000;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .modal-box {
      background: #ffffff;
      width: 100%;
      max-width: 480px;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
    }

    .toast-msg {
      position: fixed;
      bottom: 24px;
      right: 24px;
      background: #1b1e24;
      color: #ffffff;
      padding: 14px 22px;
      border-radius: 6px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
      z-index: 3000;
      display: none;
      font-size: 13px;
      border-left: 4px solid #10b981;
    }

    /* Responsive */
    @media (max-width: 1150px) {
      .programs-grid {
        grid-template-columns: repeat(3, 1fr);
      }
      .teachers-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      .activities-grid {
        grid-template-columns: repeat(3, 1fr);
      }
      .footer-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media (max-width: 992px) {
      .hero-grid {
        grid-template-columns: 1fr;
      }
      .hero-title {
        font-size: 40px;
      }
      .welcome-grid {
        grid-template-columns: 1fr;
      }
      .triplet-grid {
        grid-template-columns: 1fr;
      }
      .crimson-stats-grid {
        grid-template-columns: repeat(3, 1fr);
      }
      .nav-menu {
        display: none;
      }
      .mobile-toggle {
        display: block;
      }
    }

    @media (max-width: 650px) {
      .programs-grid {
        grid-template-columns: 1fr;
      }
      .teachers-grid {
        grid-template-columns: 1fr;
      }
      .activities-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      .crimson-stats-grid {
        grid-template-columns: 1fr 1fr;
      }
      .footer-grid {
        grid-template-columns: 1fr;
      }
      .top-bar .container {
        justify-content: center;
        text-align: center;
      }
      .hero-title {
        font-size: 32px;
      }
    }
  </style>
</head>

<body>

  <!-- ========================================================
       1. TOP BAR
  ======================================================== -->
  <div class="top-bar">
    <div class="container">
      <div class="top-info">
        <span><i class="fa-solid fa-location-dot"></i> Jln Ujung Batam, Lhokseumawe, Aceh Utara</span>
        <span><i class="fa-solid fa-phone"></i> +62 821 7281 2663</span>
        <span><i class="fa-solid fa-envelope"></i> smatnbangsa@gmail.com</span>
      </div>
      <div class="top-links">
        <a href="{{ route('login') }}"><i class="fa-solid fa-graduation-cap me-1"></i> Portal Siswa</a>
        <span class="divider">|</span>
        <a href="{{ route('login') }}"><i class="fa-solid fa-chalkboard-user me-1"></i> Portal Guru</a>
        <span class="divider">|</span>
        <a href="{{ route('login') }}"><i class="fa-solid fa-shield-halved me-1"></i> Admin</a>
        <div class="top-socials">
          <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" aria-label="Youtube"><i class="fa-brands fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- ========================================================
       2. SITE HEADER & NAVIGATION
  ======================================================== -->
  <header class="site-header">
    <div class="container">
      <div class="nav-wrapper">
        <!-- Logo Asli SMA Tuna Bangsa -->
        <a href="/" class="brand-logo">
          <img src="{{ asset('assets/img/logo 1.png') }}" alt="Logo SMA Tuna Bangsa" class="brand-img-logo">
          <div class="brand-text">
            <span class="brand-title">SMA TUNA BANGSA</span>
            <span class="brand-subtitle">PORTAL E-LEARNING & LMS</span>
            <span class="brand-tagline">Empowering Minds, Enriching Futures</span>
          </div>
        </a>

        <!-- Menu links -->
        <ul class="nav-menu">
          <li class="nav-item"><a href="/" class="nav-link active">BERANDA</a></li>
          <li class="nav-item">
            <a href="#tentangkami" class="nav-link">TENTANG KAMI <i class="fa-solid fa-chevron-down"></i></a>
            <ul class="dropdown-menu">
              <li><a href="#tentangkami"><i class="fa-solid fa-school"></i> Profil Sekolah</a></li>
              <li><a href="#tentangkami"><i class="fa-solid fa-bullseye"></i> Visi & Misi</a></li>
              <li><a href="#fasilitas"><i class="fa-solid fa-landmark"></i> Fasilitas Kampus</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#elearning" class="nav-link">E-LEARNING <i class="fa-solid fa-chevron-down"></i></a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('login') }}"><i class="fa-solid fa-laptop-code"></i> Ujian Online (CBT Exam)</a></li>
              <li><a href="{{ route('login') }}"><i class="fa-solid fa-book-open"></i> Tugas & Homework</a></li>
              <li><a href="{{ route('login') }}"><i class="fa-solid fa-layer-group"></i> Modul & Mata Pelajaran</a></li>
              <li><a href="{{ route('login') }}"><i class="fa-solid fa-calendar-days"></i> Jadwal Ujian</a></li>
            </ul>
          </li>
          <li class="nav-item"><a href="#pengajar" class="nav-link">PENGAJAR</a></li>
          <li class="nav-item"><a href="#fasilitas" class="nav-link">FASILITAS</a></li>
          <li class="nav-item"><a href="#kontak" class="nav-link">KONTAK</a></li>
        </ul>

        <!-- Action Buttons -->
        <div class="header-actions">
          <a href="{{ route('login') }}" class="btn-login-header">
            <i class="fa-solid fa-right-to-bracket"></i> LOGIN LMS
          </a>
          <button class="btn-search" onclick="toggleSearch()" title="Pencarian"><i class="fa-solid fa-magnifying-glass"></i></button>
          <button class="mobile-toggle" onclick="toggleMobileMenu()"><i class="fa-solid fa-bars"></i></button>
        </div>
      </div>
    </div>
  </header>

  <!-- ========================================================
       3. HERO SECTION
  ======================================================== -->
  <section class="hero-section" id="hero">
    <div class="container">
      <div class="hero-grid">
        
        <!-- Left Hero Content -->
        <div class="hero-content">
          <span class="hero-kicker">PORTAL E-LEARNING SMA TUNA BANGSA</span>
          <h1 class="hero-title">
            Belajar. Tumbuh.<br>
            <span class="text-maroon">Berprestasi.</span>
          </h1>
          <p class="hero-description">
            Empowering Minds, Enriching Futures. Platform pembelajaran terpadu, pelaksanaan ujian berbasis komputer (CBT), dan manajemen akademik modern.
          </p>

          <div class="hero-buttons">
            <a href="{{ route('login') }}" class="btn-hero-primary">
              <i class="fa-solid fa-user-graduate"></i> MASUK E-LEARNING
            </a>
            <a href="#elearning" class="btn-hero-secondary">
              <i class="fa-solid fa-compass"></i> FITUR UNGGULAN
            </a>
          </div>

          <!-- 5 Icon Strip -->
          <div class="hero-features-row">
            <div class="hero-feature-item">
              <div class="hero-feature-icon"><i class="fa-solid fa-laptop-file"></i></div>
              <span>Ujian Online<br>(CBT Exam)</span>
            </div>
            <div class="hero-feature-item">
              <div class="hero-feature-icon"><i class="fa-solid fa-book-open-reader"></i></div>
              <span>Tugas &<br>Homework</span>
            </div>
            <div class="hero-feature-item">
              <div class="hero-feature-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
              <span>Guru<br>Profesional</span>
            </div>
            <div class="hero-feature-item">
              <div class="hero-feature-icon"><i class="fa-solid fa-calendar-check"></i></div>
              <span>Jadwal<br>Terstruktur</span>
            </div>
            <div class="hero-feature-item">
              <div class="hero-feature-icon"><i class="fa-solid fa-award"></i></div>
              <span>Penilaian<br>Objektif</span>
            </div>
          </div>
        </div>

        <!-- Center Children Image -->
        <div class="hero-image-wrap">
          <img src="{{ asset('assets/img/student.jpg') }}" alt="Siswa SMA Tuna Bangsa Belajar Digital" onerror="this.onerror=null;this.src='{{ asset('assets/img/sunshine/hero_students.jpg') }}';">
          <div class="hero-badge-overlay">
            <i class="fa-solid fa-shield-halved me-1"></i> LMS AKTIF • CBT EXAM READY
          </div>
        </div>

        <!-- Right Quick Login / Akses LMS Card -->
        <div class="lms-login-card" id="login-box">
          <div class="lms-card-header">
            <h3><i class="fa-solid fa-id-card-clip"></i> AKSES CEPAT LMS</h3>
            <p>Masuk ke portal Siswa, Guru, atau Administrator</p>
          </div>
          <form class="lms-card-body" method="POST" action="{{ url('login') }}">
            @csrf
            <div>
              <input type="email" name="email" class="form-control-sis" placeholder="Alamat Email Akun" required>
            </div>
            <div>
              <input type="password" name="password" class="form-control-sis" placeholder="Kata Sandi / Password" required>
            </div>
            <button type="submit" class="btn-submit-lms">
              <i class="fa-solid fa-right-to-bracket"></i> MASUK SEKARANG
            </button>
            <div class="lms-links-extra">
              <a href="{{ route('forgotpassword') }}"><i class="fa-solid fa-key me-1"></i> Lupa Password?</a>
              <a href="{{ route('login') }}"><i class="fa-solid fa-circle-question me-1"></i> Panduan Login</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </section>

  <!-- ========================================================
       4. SECTION: TENTANG KAMI & VISI MISI
  ======================================================== -->
  <section class="welcome-section" id="tentangkami">
    <div class="container">
      <div class="welcome-grid">
        
        <!-- School Photo -->
        <div class="welcome-img-card">
          <img src="{{ asset('assets/img/sunshine/school_building.jpg') }}" alt="Gedung Kampus SMA Tuna Bangsa">
        </div>

        <!-- Welcome Text -->
        <div class="welcome-text">
          <span class="section-kicker">TENTANG KAMI</span>
          <h2 class="section-heading">SMA Tuna Bangsa</h2>
          <p>
            SMA Tuna Bangsa adalah sebuah lembaga pendidikan yang berkomitmen untuk memberikan pendidikan berkualitas kepada siswa-siswinya melalui pengajaran interaktif dan sistem manajemen pembelajaran digital terpadu.
          </p>

          <div class="vision-mission-box">
            <h5><i class="fa-solid fa-eye me-1"></i> Visi</h5>
            <p>Menjadi lembaga pendidikan yang menghasilkan individu yang berintegritas, berdaya saing, dan berwawasan global.</p>
          </div>

          <div class="vision-mission-box">
            <h5><i class="fa-solid fa-bullseye me-1"></i> Misi</h5>
            <p>Memberikan pendidikan berkualitas tinggi, mengembangkan potensi akademik & karakter moral, serta menyediakan lingkungan belajar inklusif berbasis teknologi.</p>
          </div>

          <a href="#pengajar" class="btn-outline-sis">KENAL LEBIH DEKAT</a>
        </div>

        <!-- Stats Badges 2x3 Grid (Data Asli SMA Tuna Bangsa) -->
        <div class="stats-grid-welcome">
          <div class="stat-badge-item">
            <div class="stat-badge-icon"><i class="fa-solid fa-user-graduate"></i></div>
            <div class="stat-badge-content">
              <h4>7.805</h4>
              <p>Lulusan Berprestasi</p>
            </div>
          </div>

          <div class="stat-badge-item">
            <div class="stat-badge-icon"><i class="fa-solid fa-trophy"></i></div>
            <div class="stat-badge-content">
              <h4>120+</h4>
              <p>Prestasi Akademik</p>
            </div>
          </div>

          <div class="stat-badge-item">
            <div class="stat-badge-icon"><i class="fa-solid fa-users"></i></div>
            <div class="stat-badge-content">
              <h4>1.463</h4>
              <p>Siswa Aktif</p>
            </div>
          </div>

          <div class="stat-badge-item">
            <div class="stat-badge-icon"><i class="fa-solid fa-building-columns"></i></div>
            <div class="stat-badge-content">
              <h4>20+</h4>
              <p>Fasilitas Unggulan</p>
            </div>
          </div>

          <div class="stat-badge-item">
            <div class="stat-badge-icon"><i class="fa-solid fa-laptop-code"></i></div>
            <div class="stat-badge-content">
              <h4>100%</h4>
              <p>Ujian Online CBT</p>
            </div>
          </div>

          <div class="stat-badge-item">
            <div class="stat-badge-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
            <div class="stat-badge-content">
              <h4>50+</h4>
              <p>Guru & Pembimbing</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ========================================================
       5. SECTION: MODUL & FITUR E-LEARNING
  ======================================================== -->
  <section class="programs-section" id="elearning">
    <div class="container">
      <div class="section-header-center">
        <span class="section-kicker">MODUL SISTEM PEMBELAJARAN</span>
        <h2 class="section-heading">Fitur Lengkap E-Learning & LMS</h2>
      </div>

      <div class="programs-grid">
        
        <!-- Card 1: Ujian Online (Examinations) -->
        <div class="program-card">
          <div class="program-thumb-wrap">
            <img src="{{ asset('assets/img/penilaian.jpg') }}" alt="Ujian Online CBT" onerror="this.onerror=null;this.src='{{ asset('assets/img/sunshine/prog_high.jpg') }}';">
            <div class="program-circle-icon"><i class="fa-solid fa-laptop-code"></i></div>
          </div>
          <div class="program-body">
            <h3>Ujian Online (Exam)</h3>
            <div class="program-punchline">CBT. Terjadwal. Real-Time.</div>
            <p class="program-desc">Sistem ujian berbasis komputer untuk UTS, UAS, dan Try Out dengan penilaian otomatis dan bank soal terenkripsi.</p>
            <a href="{{ route('login') }}" class="program-link">MASUK UJIAN <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>

        <!-- Card 2: Tugas & Homework -->
        <div class="program-card">
          <div class="program-thumb-wrap">
            <img src="{{ asset('assets/img/tugas.jpg') }}" alt="Tugas & Homework" onerror="this.onerror=null;this.src='{{ asset('assets/img/sunshine/prog_primary.jpg') }}';">
            <div class="program-circle-icon"><i class="fa-solid fa-file-pen"></i></div>
          </div>
          <div class="program-body">
            <h3>Tugas & Homework</h3>
            <div class="program-punchline">Unggah. Review. Nilai.</div>
            <p class="program-desc">Pengumpulan tugas digital siswa tepat waktu dengan feedback interaktif dan rekapitulasi penilaian oleh guru.</p>
            <a href="{{ route('login') }}" class="program-link">SUBMIT TUGAS <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>

        <!-- Card 3: Mata Pelajaran & Modul -->
        <div class="program-card">
          <div class="program-thumb-wrap">
            <img src="{{ asset('assets/img/mapel.jpg') }}" alt="Mata Pelajaran & Materi" onerror="this.onerror=null;this.src='{{ asset('assets/img/sunshine/prog_middle.jpg') }}';">
            <div class="program-circle-icon"><i class="fa-solid fa-book-open"></i></div>
          </div>
          <div class="program-body">
            <h3>Materi & Mapel</h3>
            <div class="program-punchline">Akses Bahan Ajar 24/7</div>
            <p class="program-desc">Distribusi materi pembelajaran, modul PDF, silabus, dan bahan pengayaan digital untuk seluruh mata pelajaran.</p>
            <a href="{{ route('login') }}" class="program-link">LIHAT MATERI <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>

        <!-- Card 4: Jadwal Ujian & Pelajaran -->
        <div class="program-card">
          <div class="program-thumb-wrap">
            <img src="{{ asset('assets/img/kelas.jpg') }}" alt="Jadwal Kelas & Ujian" onerror="this.onerror=null;this.src='{{ asset('assets/img/sunshine/prog_preprimary.jpg') }}';">
            <div class="program-circle-icon"><i class="fa-solid fa-calendar-days"></i></div>
          </div>
          <div class="program-body">
            <h3>Jadwal Terpadu</h3>
            <div class="program-punchline">Terstruktur & Akurat</div>
            <p class="program-desc">Informasi jadwal pelajaran harian, jadwal pengawas ujian, dan kalender pendidikan sekolah yang selalu terupdate.</p>
            <a href="{{ route('login') }}" class="program-link">CEK JADWAL <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>

        <!-- Card 5: Portal Pengajar & Siswa -->
        <div class="program-card">
          <div class="program-thumb-wrap">
            <img src="{{ asset('assets/img/guru.jpg') }}" alt="Portal Guru & Siswa" onerror="this.onerror=null;this.src='{{ asset('assets/img/sunshine/prog_senior.jpg') }}';">
            <div class="program-circle-icon"><i class="fa-solid fa-users-gear"></i></div>
          </div>
          <div class="program-body">
            <h3>Manajemen Kelas</h3>
            <div class="program-punchline">Bimbingan & Rekapitulasi</div>
            <p class="program-desc">Fitur khusus guru untuk mengelola pembagian kelas, penugasan mata pelajaran, absensi, dan penilaian portofolio.</p>
            <a href="{{ route('login') }}" class="program-link">AKSES PORTAL <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ========================================================
       6. CRIMSON STATS HIGHLIGHT BAR
  ======================================================== -->
  <section class="crimson-stats-bar">
    <div class="container">
      <div class="crimson-stats-grid">
        
        <div class="crimson-stat-box">
          <div class="crimson-stat-icon"><i class="fa-solid fa-graduation-cap"></i></div>
          <div class="crimson-stat-info">
            <h3>7.805+</h3>
            <p>Lulusan Sukses</p>
          </div>
        </div>

        <div class="crimson-stat-box">
          <div class="crimson-stat-icon"><i class="fa-solid fa-users"></i></div>
          <div class="crimson-stat-info">
            <h3>1.463+</h3>
            <p>Siswa Aktif E-Learning</p>
          </div>
        </div>

        <div class="crimson-stat-box">
          <div class="crimson-stat-icon"><i class="fa-solid fa-medal"></i></div>
          <div class="crimson-stat-info">
            <h3>120+</h3>
            <p>Prestasi Diraih</p>
          </div>
        </div>

        <div class="crimson-stat-box">
          <div class="crimson-stat-icon"><i class="fa-solid fa-network-wired"></i></div>
          <div class="crimson-stat-info">
            <h3>20+</h3>
            <p>Lab & Fasilitas</p>
          </div>
        </div>

        <div class="crimson-stat-box">
          <div class="crimson-stat-icon"><i class="fa-solid fa-display"></i></div>
          <div class="crimson-stat-info">
            <h3>100%</h3>
            <p>CBT & Pembelajaran Digital</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ========================================================
       7. SECTION: DEWAN GURU & PENGAJAR (DATA ASLI)
  ======================================================== -->
  <section class="teachers-section" id="pengajar">
    <div class="container">
      <div class="section-header-center">
        <span class="section-kicker">TENAGA PENDIDIK</span>
        <h2 class="section-heading">Guru-Guru SMA Tuna Bangsa</h2>
      </div>

      <div class="teachers-grid">
        
        <!-- Guru 1: Andhika Syaputra Manurung -->
        <div class="teacher-card">
          <div class="teacher-img-wrap">
            <img src="{{ asset('assets/img/team/team-1.jpg') }}" alt="Andhika Syaputra Manurung">
            <div class="teacher-socials">
              <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
          </div>
          <div class="teacher-info">
            <h4>Andhika Syaputra Manurung</h4>
            <span class="teacher-badge">Kepala Sekolah / Guru Fisika</span>
            <p class="teacher-role">Memimpin transformasi pembelajaran digital SMA Tuna Bangsa.</p>
          </div>
        </div>

        <!-- Guru 2: Juwita Saharani -->
        <div class="teacher-card">
          <div class="teacher-img-wrap">
            <img src="{{ asset('assets/img/team/team-2.jpg') }}" alt="Juwita Saharani">
            <div class="teacher-socials">
              <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
          </div>
          <div class="teacher-info">
            <h4>Juwita Saharani</h4>
            <span class="teacher-badge">Wakil Kepala Sekolah / Guru Kimia</span>
            <p class="teacher-role">Koordinator kurikulum akademik & evaluasi pembelajaran.</p>
          </div>
        </div>

        <!-- Guru 3: Dimas -->
        <div class="teacher-card">
          <div class="teacher-img-wrap">
            <img src="{{ asset('assets/img/team/team-3.jpg') }}" alt="Dimas">
            <div class="teacher-socials">
              <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
          </div>
          <div class="teacher-info">
            <h4>Dimas</h4>
            <span class="teacher-badge">Guru Pembimbing & Konseling</span>
            <p class="teacher-role">Membimbing pengembangan minat, bakat, dan karakter siswa.</p>
          </div>
        </div>

        <!-- Guru 4: Nur Azila Tarigan -->
        <div class="teacher-card">
          <div class="teacher-img-wrap">
            <img src="{{ asset('assets/img/team/team-4.jpg') }}" alt="Nur Azila Tarigan">
            <div class="teacher-socials">
              <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
          </div>
          <div class="teacher-info">
            <h4>Nur Azila Tarigan</h4>
            <span class="teacher-badge">Guru Bahasa Indonesia & Agama</span>
            <p class="teacher-role">Pendidik bahasa dan nilai moral kebangsaan siswa.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ========================================================
       8. SECTION: FASILITAS & KEGIATAN UNGGULAN
  ======================================================== -->
  <section class="activities-section" id="fasilitas">
    <div class="container">
      <div class="section-header-center">
        <span class="section-kicker">LINGKUNGAN PEMBELAJARAN</span>
        <h2 class="section-heading">Fasilitas & Kegiatan Siswa</h2>
      </div>

      <div class="activities-grid">
        
        <!-- Activity 1: Lab Komputer CBT -->
        <div class="activity-card">
          <img src="{{ asset('assets/img/sunshine/prog_senior.jpg') }}" alt="Lab Komputer CBT">
          <div class="activity-overlay-tag">
            <i class="fa-solid fa-desktop"></i>
            <span>Lab Komputer CBT</span>
          </div>
        </div>

        <!-- Activity 2: Praktikum Sains -->
        <div class="activity-card">
          <img src="{{ asset('assets/img/sunshine/prog_middle.jpg') }}" alt="Laboratorium Sains">
          <div class="activity-overlay-tag">
            <i class="fa-solid fa-flask-vial"></i>
            <span>Lab Sains & Riset</span>
          </div>
        </div>

        <!-- Activity 3: Perpustakaan Digital -->
        <div class="activity-card">
          <img src="{{ asset('assets/img/sunshine/prog_high.jpg') }}" alt="Perpustakaan Digital">
          <div class="activity-overlay-tag">
            <i class="fa-solid fa-book-bookmark"></i>
            <span>Perpustakaan Digital</span>
          </div>
        </div>

        <!-- Activity 4: Olahraga & Seni -->
        <div class="activity-card">
          <img src="{{ asset('assets/img/sunshine/act_sports.jpg') }}" alt="Olahraga & Prestasi">
          <div class="activity-overlay-tag">
            <i class="fa-solid fa-futbol"></i>
            <span>Olahraga & Prestasi</span>
          </div>
        </div>

        <!-- Activity 5: Seni Budaya & Musik -->
        <div class="activity-card">
          <img src="{{ asset('assets/img/sunshine/act_music.jpg') }}" alt="Seni Budaya">
          <div class="activity-overlay-tag">
            <i class="fa-solid fa-guitar"></i>
            <span>Seni & Budaya</span>
          </div>
        </div>

        <!-- Activity 6: Pramuka & Kepemimpinan -->
        <div class="activity-card">
          <img src="{{ asset('assets/img/sunshine/act_lifeskills.jpg') }}" alt="Pramuka & Karakter">
          <div class="activity-overlay-tag">
            <i class="fa-solid fa-campground"></i>
            <span>Bina Karakter</span>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ========================================================
       9. SECTION: BOTTOM 3-COLUMN HIGHLIGHTS
  ======================================================== -->
  <section class="bottom-triplet-section">
    <div class="container">
      <div class="triplet-grid">
        
        <!-- Column 1: Testimoni Siswa & Wali Murid -->
        <div class="parents-card">
          <h3 class="card-label-small">KATA MEREKA TENTANG E-LEARNING</h3>
          <div class="quote-icon"><i class="fa-solid fa-quote-left"></i></div>
          <p class="testimonial-text">
            "Sistem E-Learning SMA Tuna Bangsa sangat membantu proses pembelajaran. Ujian CBT transparan, materi mudah diakses, dan tugas dapat dikumpulkan kapan saja dengan praktis."
          </p>

          <div class="testimonial-author-wrap">
            <img src="{{ asset('assets/img/sunshine/parent_priya.jpg') }}" alt="Wali Murid" class="author-avatar">
            <div class="author-info">
              <h4>Rahmawati, S.Pd</h4>
              <p>Wali Murid Kelas XI MIPA</p>
              <div class="star-rating">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
              </div>
            </div>
          </div>

          <div class="slider-dots">
            <span class="slider-dot active"></span>
            <span class="slider-dot"></span>
            <span class="slider-dot"></span>
          </div>
        </div>

        <!-- Column 2: Pengumuman & Agenda Akademik -->
        <div class="announcements-card">
          <h3 class="card-label-small">PENGUMUMAN & AGENDA TERBARU</h3>

          <div class="announcements-list">
            <!-- Item 1 -->
            <div class="announcement-item">
              <div class="date-badge">
                <div class="date-badge-month">MEI</div>
                <div class="date-badge-day">20</div>
              </div>
              <div class="announcement-info">
                <h4>Pelaksanaan Ujian Akhir Semester (UAS) Berbasis Komputer</h4>
                <a href="{{ route('login') }}">Cek Ruang CBT <i class="fa-solid fa-arrow-right"></i></a>
              </div>
            </div>

            <!-- Item 2 -->
            <div class="announcement-item">
              <div class="date-badge">
                <div class="date-badge-month">MEI</div>
                <div class="date-badge-day">15</div>
              </div>
              <div class="announcement-info">
                <h4>Batas Akhir Pengumpulan Tugas & Homework Semester</h4>
                <a href="{{ route('login') }}">Kirim Tugas Sekarang <i class="fa-solid fa-arrow-right"></i></a>
              </div>
            </div>

            <!-- Item 3 -->
            <div class="announcement-item">
              <div class="date-badge">
                <div class="date-badge-month">MEI</div>
                <div class="date-badge-day">10</div>
              </div>
              <div class="announcement-info">
                <h4>Simulasi Ujian CBT & Pembagian Kartu Peserta</h4>
                <a href="{{ route('login') }}">Lihat Jadwal <i class="fa-solid fa-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <!-- Megaphone Vector Art -->
          <svg class="megaphone-bg-art" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M72 45L40 28V62L72 45Z" fill="#e9ecef" stroke="#851624" stroke-width="3"/>
            <path d="M72 45C72 40 76 34 82 34C88 34 92 40 92 45C92 50 88 56 82 56C76 56 72 50 72 45Z" fill="#851624"/>
            <path d="M40 38H28C25 38 22 41 22 44V46C22 49 25 52 28 52H40V38Z" fill="#851624"/>
            <path d="M34 52L28 72H20L26 52H34Z" fill="#495057"/>
            <circle cx="82" cy="45" r="4" fill="#ffd700"/>
          </svg>
        </div>

        <!-- Column 3: Ruang Ujian Online CBT -->
        <div class="tour-card">
          <!-- Watermark -->
          <svg class="tour-watermark" viewBox="0 0 100 100" fill="none" stroke="#ffffff" stroke-width="1.5">
            <rect x="25" y="45" width="50" height="50" rx="2"/>
            <path d="M20 45L50 15L80 45H20Z"/>
            <circle cx="50" cy="35" r="5"/>
            <line x1="50" y1="32" x2="50" y2="35"/>
            <line x1="50" y1="35" x2="53" y2="35"/>
          </svg>

          <div class="tour-card-content">
            <h3>RUANG UJIAN ONLINE (CBT)</h3>
            <p>Silakan login untuk mengikuti ujian online, melihat jadwal, dan mengunduh kartu ujian.</p>
          </div>

          <div>
            <a href="{{ route('login') }}" class="btn-book-tour">
              MASUK RUANG UJIAN <i class="fa-solid fa-laptop-code"></i>
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ========================================================
       10. FOOTER
  ======================================================== -->
  <footer class="site-footer" id="kontak">
    <div class="container">
      <div class="footer-grid">
        
        <!-- Col 1: Brand Info Asli SMA Tuna Bangsa -->
        <div class="footer-col footer-brand">
          <div class="brand-logo mb-2">
            <img src="{{ asset('assets/img/logo 1.png') }}" alt="Logo SMA Tuna Bangsa" style="width: 44px; height: 44px; object-fit: contain;">
            <div class="brand-text">
              <span class="brand-title">SMA TUNA BANGSA</span>
              <span class="brand-subtitle">PORTAL E-LEARNING</span>
            </div>
          </div>
          <p>
            Membentuk generasi berprestasi, berintegritas, dan berwawasan global melalui pendidikan digital berkualitas tinggi.
          </p>
          <div class="footer-social-links">
            <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" aria-label="Youtube"><i class="fa-brands fa-youtube"></i></a>
            <a href="#" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
          </div>
        </div>

        <!-- Col 2: NAVIGASI CEPAT -->
        <div class="footer-col">
          <h4>NAVIGASI</h4>
          <ul class="footer-nav-list">
            <li><a href="#hero">Beranda</a></li>
            <li><a href="#tentangkami">Tentang Kami</a></li>
            <li><a href="#elearning">Fitur E-Learning</a></li>
            <li><a href="#pengajar">Dewan Guru</a></li>
            <li><a href="#fasilitas">Fasilitas</a></li>
            <li><a href="#kontak">Hubungi Kami</a></li>
          </ul>
        </div>

        <!-- Col 3: FITUR E-LEARNING -->
        <div class="footer-col">
          <h4>E-LEARNING</h4>
          <ul class="footer-nav-list">
            <li><a href="{{ route('login') }}">Ujian Online (CBT)</a></li>
            <li><a href="{{ route('login') }}">Tugas & Homework</a></li>
            <li><a href="{{ route('login') }}">Mata Pelajaran</a></li>
            <li><a href="{{ route('login') }}">Jadwal Pelajaran</a></li>
            <li><a href="{{ route('login') }}">Rekap Nilai</a></li>
          </ul>
        </div>

        <!-- Col 4: PORTAL AKUN -->
        <div class="footer-col">
          <h4>PORTAL AKUN</h4>
          <ul class="footer-nav-list">
            <li><a href="{{ route('login') }}">Login Siswa</a></li>
            <li><a href="{{ route('login') }}">Login Guru</a></li>
            <li><a href="{{ route('login') }}">Login Administrator</a></li>
            <li><a href="{{ route('forgotpassword') }}">Lupa Password</a></li>
          </ul>
        </div>

        <!-- Col 5: KONTAK RESMI SMA TUNA BANGSA -->
        <div class="footer-col">
          <h4>KONTAK SEKOLAH</h4>
          <div class="footer-contact-info">
            <div class="contact-item">
              <i class="fa-solid fa-location-dot"></i>
              <span>Jln Ujung Batam,<br>Lhokseumawe, Aceh Utara, Indonesia</span>
            </div>
            <div class="contact-item">
              <i class="fa-solid fa-phone"></i>
              <span>+62 821 7281 2663</span>
            </div>
            <div class="contact-item">
              <i class="fa-solid fa-envelope"></i>
              <span>smatnbangsa@gmail.com</span>
            </div>
          </div>
        </div>

        <!-- Col 6: NEWSLETTER -->
        <div class="footer-col">
          <h4>INFORMASI SEKOLAH</h4>
          <div class="newsletter-form">
            <p>Dapatkan informasi terbaru mengenai agenda ujian & kegiatan sekolah.</p>
            <form class="newsletter-input-group" onsubmit="handleNewsletter(event)">
              <input type="email" placeholder="Masukkan email Anda" required>
              <button type="submit" aria-label="Langganan"><i class="fa-solid fa-arrow-right"></i></button>
            </form>
          </div>
        </div>

      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="footer-bottom-bar">
      <div class="container">
        <div>
          &copy; 2026 SMA Tuna Bangsa. All Rights Reserved. Designed for E-Learning & LMS.
        </div>
        <div class="footer-legal-links">
          <a href="#">Kebijakan Privasi</a>
          <span>|</span>
          <a href="#">Syarat & Ketentuan</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- ========================================================
       MODALS & NOTIFIKASI
  ======================================================== -->
  <!-- Search Modal -->
  <div class="modal-overlay" id="searchModal" onclick="closeModalOnBg(event, 'searchModal')">
    <div class="modal-box" style="padding: 24px;">
      <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <h4 style="font-size:16px; font-weight:800; color:var(--sis-primary);">Cari di SMA Tuna Bangsa</h4>
        <button onclick="toggleSearch()" style="background:none; border:none; font-size:20px; cursor:pointer;">&times;</button>
      </div>
      <div class="newsletter-input-group" style="border:1px solid #d5dbe4;">
        <input type="text" id="searchInput" placeholder="Cari mata pelajaran, guru, ujian, pengumuman..." style="padding:12px;">
        <button type="button" onclick="executeSearch()"><i class="fa-solid fa-magnifying-glass"></i></button>
      </div>
    </div>
  </div>

  <!-- Notification Toast -->
  <div class="toast-msg" id="toastMsg">
    <span id="toastText">Pesan berhasil dikirim.</span>
  </div>

  <!-- JavaScript Interactions -->
  <script>
    function showToast(message) {
      const toast = document.getElementById('toastMsg');
      const text = document.getElementById('toastText');
      text.innerText = message;
      toast.style.display = 'block';
      setTimeout(() => {
        toast.style.display = 'none';
      }, 4000);
    }

    function handleNewsletter(e) {
      e.preventDefault();
      showToast('Terima kasih telah berlangganan info E-Learning SMA Tuna Bangsa!');
      e.target.reset();
    }

    function toggleSearch() {
      const modal = document.getElementById('searchModal');
      const isShown = modal.style.display === 'flex';
      modal.style.display = isShown ? 'none' : 'flex';
      if (!isShown) {
        setTimeout(() => document.getElementById('searchInput').focus(), 100);
      }
    }

    function executeSearch() {
      const q = document.getElementById('searchInput').value;
      if (q) {
        toggleSearch();
        showToast('Mencari materi/informasi: ' + q);
      }
    }

    function closeModalOnBg(e, modalId) {
      if (e.target.id === modalId) {
        document.getElementById(modalId).style.display = 'none';
      }
    }

    function toggleMobileMenu() {
      const menu = document.querySelector('.nav-menu');
      if (menu.style.display === 'flex') {
        menu.style.display = 'none';
      } else {
        menu.style.display = 'flex';
        menu.style.flexDirection = 'column';
        menu.style.position = 'absolute';
        menu.style.top = '84px';
        menu.style.left = '0';
        menu.style.width = '100%';
        menu.style.background = '#ffffff';
        menu.style.padding = '20px';
        menu.style.boxShadow = '0 10px 20px rgba(0,0,0,0.1)';
      }
    }
  </script>
</body>

</html>