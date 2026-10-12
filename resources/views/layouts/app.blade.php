<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SMA Tuna Bangsa - E-Learning LMS</title>
  <meta content="Portal E-Learning SMA Tuna Bangsa - Sistem Manajemen Pembelajaran Terpadu" name="description">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo 1.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo 1.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">

  <!-- Font Awesome 6 & Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      /* Signature Luxury Crimson & Gold Palette */
      --lms-primary: #851624;
      --lms-primary-dark: #680e1a;
      --lms-primary-deep: #520b14;
      --lms-primary-light: #fbecee;
      --lms-gold: #c59b27;
      --lms-gold-light: #fef8e7;
      --lms-bg: #f8f6f2;
      --lms-card: #ffffff;
      --lms-dark: #1b1e24;
      --lms-muted: #64748b;
      --lms-border: #e9ecef;
      --lms-sidebar-w: 260px;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
      background-color: var(--lms-bg);
      color: var(--lms-dark);
      min-height: 100vh;
      display: flex;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    /* Layout Wrapper */
    .lms-layout {
      display: flex;
      width: 100%;
      min-height: 100vh;
    }

    /* Sidebar */
    .lms-sidebar {
      width: var(--lms-sidebar-w);
      background: #ffffff;
      border-right: 1px solid var(--lms-border);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      z-index: 1050;
      padding: 24px 16px;
      overflow-y: auto;
      transition: transform 0.3s ease;
    }

    .sidebar-brand {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 0 8px 22px 8px;
      border-bottom: 1px solid var(--lms-border);
      margin-bottom: 18px;
    }

    .sidebar-brand img {
      width: 42px;
      height: 42px;
      object-fit: contain;
    }

    .brand-title {
      font-size: 16px;
      font-weight: 800;
      color: var(--lms-dark);
      line-height: 1.15;
    }

    .brand-title span {
      color: var(--lms-primary);
    }

    .brand-badge {
      font-size: 9.5px;
      font-weight: 700;
      color: var(--lms-gold);
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    .sidebar-nav {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 5px;
      flex-grow: 1;
    }

    .nav-label {
      font-size: 10.5px;
      font-weight: 800;
      letter-spacing: 0.8px;
      color: #94a3b8;
      text-transform: uppercase;
      padding: 12px 14px 4px 14px;
    }

    .nav-item-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 14px;
      border-radius: 8px;
      font-size: 13.5px;
      font-weight: 600;
      color: #475569;
      transition: all 0.2s ease;
    }

    .nav-item-link i {
      font-size: 15px;
      width: 20px;
      text-align: center;
      color: #8c93a9;
      transition: color 0.2s ease;
    }

    .nav-item-link:hover {
      background-color: var(--lms-primary-light);
      color: var(--lms-primary);
    }

    .nav-item-link:hover i {
      color: var(--lms-primary);
    }

    .nav-item-link.active {
      background-color: var(--lms-primary-light);
      color: var(--lms-primary);
      font-weight: 800;
      border-left: 3px solid var(--lms-primary);
    }

    .nav-item-link.active i {
      color: var(--lms-primary);
    }

    .sidebar-bottom-card {
      background: linear-gradient(135deg, #fbecee 0%, #fef8e7 100%);
      border: 1px solid #ecc9cf;
      border-radius: 12px;
      padding: 14px;
      text-align: center;
      margin-top: 20px;
    }

    .sidebar-bottom-card h6 {
      font-size: 12.5px;
      font-weight: 800;
      color: var(--lms-primary);
      margin-bottom: 3px;
    }

    .sidebar-bottom-card p {
      font-size: 11px;
      color: #64748b;
      margin-bottom: 0;
    }

    /* Main Content Wrapper */
    .lms-main {
      margin-left: var(--lms-sidebar-w);
      width: calc(100% - var(--lms-sidebar-w));
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* Topbar Header */
    .lms-header {
      background: #ffffff;
      height: 72px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 32px;
      border-bottom: 1px solid var(--lms-border);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .header-search {
      position: relative;
      width: 320px;
    }

    .header-search input {
      width: 100%;
      background: #fbfaf8;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      padding: 9px 14px 9px 38px;
      font-size: 13px;
      outline: none;
      transition: all 0.2s;
    }

    .header-search input:focus {
      background: #ffffff;
      border-color: var(--lms-primary);
      box-shadow: 0 0 0 3px rgba(133, 22, 36, 0.12);
    }

    .header-search i {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 13px;
    }

    .header-actions {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .badge-live {
      background: var(--lms-primary-light);
      color: var(--lms-primary);
      font-size: 11.5px;
      font-weight: 800;
      padding: 6px 14px;
      border-radius: 20px;
      display: inline-flex;
      align-items: center;
      gap: 7px;
      cursor: pointer;
      transition: all 0.2s ease;
      border: 1px solid rgba(133, 22, 36, 0.15);
      user-select: none;
    }

    .badge-live:hover {
      background: #fbecee;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(133, 22, 36, 0.18);
    }

    .badge-live-dot {
      width: 6px;
      height: 6px;
      background: var(--lms-primary);
      border-radius: 50%;
      animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
      0% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.4; transform: scale(1.3); }
      100% { opacity: 1; transform: scale(1); }
    }

    .btn-header-icon {
      width: 38px;
      height: 38px;
      border-radius: 8px;
      background: #fbfaf8;
      border: 1px solid #e2e8f0;
      color: #475569;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.2s;
      position: relative;
    }

    .btn-header-icon:hover {
      background: var(--lms-primary-light);
      color: var(--lms-primary);
      border-color: #ecc9cf;
    }

    .notif-badge {
      position: absolute;
      top: 7px;
      right: 7px;
      width: 6px;
      height: 6px;
      background: var(--lms-primary);
      border-radius: 50%;
    }

    .user-profile-menu {
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      padding: 4px 8px;
      border-radius: 8px;
      transition: background 0.2s;
    }

    .user-profile-menu:hover {
      background: #fbfaf8;
    }

    .user-avatar-img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--lms-primary-light);
    }

    .user-name-title {
      font-size: 13.5px;
      font-weight: 700;
      color: var(--lms-dark);
      line-height: 1.2;
    }

    .user-role-badge {
      font-size: 11px;
      color: var(--lms-primary);
      font-weight: 700;
    }

    .mobile-menu-btn {
      display: none;
      background: none;
      border: none;
      font-size: 20px;
      color: var(--lms-dark);
      cursor: pointer;
    }

    .lms-content {
      padding: 28px 32px 40px 32px;
      flex-grow: 1;
    }

    /* ========================================================
       MODERN LMS DESIGN SYSTEM - TABLES & INTERFACES
    ======================================================== */
    /* Container Reset for LMS Content */
    .lms-content > .container,
    .lms-content .container {
      max-width: 100% !important;
      width: 100% !important;
      padding-left: 0 !important;
      padding-right: 0 !important;
      margin: 0 !important;
    }

    /* Cards */
    .card {
      background: #ffffff !important;
      border: 1px solid rgba(133, 22, 36, 0.08) !important;
      border-radius: 18px !important;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04) !important;
      overflow: hidden !important;
      margin-bottom: 26px !important;
    }

    .card-header {
      background: #ffffff !important;
      border-bottom: 1px solid #f1eeea !important;
      padding: 18px 26px !important;
      font-weight: 800 !important;
      font-size: 16px !important;
      color: var(--lms-dark) !important;
    }

    .card-header.bg-primary {
      background: linear-gradient(135deg, #851624 0%, #680e1a 100%) !important;
      color: #ffffff !important;
      border-bottom: 2px solid #c59b27 !important;
    }

    .card-title {
      color: var(--lms-primary) !important;
      font-weight: 800 !important;
    }

    /* Buttons */
    .btn-primary {
      background-color: var(--lms-primary) !important;
      border-color: var(--lms-primary) !important;
      color: #ffffff !important;
      border-radius: 10px !important;
      font-weight: 700 !important;
      font-size: 13px !important;
      padding: 9px 20px !important;
      box-shadow: 0 4px 14px rgba(133, 22, 36, 0.22) !important;
      transition: all 0.2s ease !important;
    }

    .btn-primary:hover, .btn-primary:focus {
      background-color: var(--lms-primary-dark) !important;
      border-color: var(--lms-primary-dark) !important;
      color: #ffffff !important;
      transform: translateY(-1px) !important;
      box-shadow: 0 6px 18px rgba(133, 22, 36, 0.32) !important;
    }

    .btn-danger {
      background-color: #dc2626 !important;
      border-color: #dc2626 !important;
      color: #ffffff !important;
      border-radius: 10px !important;
      font-weight: 700 !important;
      font-size: 13px !important;
      padding: 8px 16px !important;
      transition: all 0.2s ease !important;
    }

    .btn-danger:hover {
      background-color: #b91c1c !important;
      border-color: #b91c1c !important;
      transform: translateY(-1px) !important;
    }

    .btn-info {
      background-color: #c59b27 !important;
      border-color: #c59b27 !important;
      color: #ffffff !important;
      border-radius: 10px !important;
      font-weight: 700 !important;
      font-size: 13px !important;
      box-shadow: 0 4px 12px rgba(197, 155, 39, 0.2) !important;
    }

    .btn-info:hover {
      background-color: #a6811d !important;
      border-color: #a6811d !important;
      color: #ffffff !important;
      transform: translateY(-1px) !important;
    }

    .btn-warning {
      background-color: #d97706 !important;
      border-color: #d97706 !important;
      color: #ffffff !important;
      border-radius: 10px !important;
      font-weight: 700 !important;
    }

    .btn-success {
      background-color: #10b981 !important;
      border-color: #10b981 !important;
      color: #ffffff !important;
      border-radius: 10px !important;
      font-weight: 700 !important;
    }

    .btn-secondary {
      border-radius: 10px !important;
      font-weight: 600 !important;
    }

    /* Modern Table Framework Overrides */
    .table-responsive {
      border-radius: 14px !important;
      overflow: hidden !important;
      border: 1px solid #edf0f5 !important;
    }

    .table {
      width: 100% !important;
      border-collapse: separate !important;
      border-spacing: 0 !important;
      margin-bottom: 0 !important;
    }

    /* Kill harsh spreadsheet borders */
    .table, .table-bordered, .table-bordered th, .table-bordered td {
      border-left: none !important;
      border-right: none !important;
      border-top: none !important;
    }

    .table thead th, .thead-light th {
      background: #fbf8f5 !important;
      color: #680e1a !important;
      font-weight: 800 !important;
      font-size: 12px !important;
      text-transform: uppercase !important;
      letter-spacing: 0.8px !important;
      padding: 16px 20px !important;
      border-bottom: 2px solid #ecd8db !important;
      vertical-align: middle !important;
    }

    .table tbody tr td {
      padding: 16px 20px !important;
      vertical-align: middle !important;
      font-size: 13.5px !important;
      color: #334155 !important;
      border-bottom: 1px solid #f4eeea !important;
      background-color: #ffffff !important;
      transition: background-color 0.2s ease !important;
    }

    .table tbody tr:hover td {
      background-color: #fff8f8 !important;
    }

    .table-striped > tbody > tr:nth-of-type(odd) > td {
      background-color: #fdfcfb !important;
    }

    /* Modern LMS Class Utilities */
    .lms-avatar {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      object-fit: cover;
      border: 2px solid #fbecee;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .lms-avatar-placeholder {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      background: linear-gradient(135deg, #fbecee 0%, #fef8e7 100%);
      color: #851624;
      font-weight: 800;
      font-size: 15px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #ecd8db;
    }

    .btn-action-edit {
      background: #fbecee !important;
      color: #851624 !important;
      border: 1px solid #ecd8db !important;
      border-radius: 8px !important;
      padding: 6px 12px !important;
      font-size: 12.5px !important;
      font-weight: 700 !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 6px !important;
      transition: all 0.2s ease !important;
      text-decoration: none !important;
    }

    .btn-action-edit:hover {
      background: #851624 !important;
      color: #ffffff !important;
      border-color: #851624 !important;
      transform: translateY(-1px) !important;
      box-shadow: 0 4px 12px rgba(133, 22, 36, 0.25) !important;
    }

    .btn-action-delete {
      background: #fef2f2 !important;
      color: #dc2626 !important;
      border: 1px solid #fecaca !important;
      border-radius: 8px !important;
      padding: 6px 12px !important;
      font-size: 12.5px !important;
      font-weight: 700 !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 6px !important;
      transition: all 0.2s ease !important;
      cursor: pointer !important;
    }

    .btn-action-delete:hover {
      background: #dc2626 !important;
      color: #ffffff !important;
      border-color: #dc2626 !important;
      transform: translateY(-1px) !important;
      box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25) !important;
    }

    .btn-action-detail {
      background: #fef8e7 !important;
      color: #b8860b !important;
      border: 1px solid #f9e7be !important;
      border-radius: 8px !important;
      padding: 6px 12px !important;
      font-size: 12.5px !important;
      font-weight: 700 !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 6px !important;
      transition: all 0.2s ease !important;
      cursor: pointer !important;
    }

    .btn-action-detail:hover {
      background: #c59b27 !important;
      color: #ffffff !important;
      border-color: #c59b27 !important;
      transform: translateY(-1px) !important;
      box-shadow: 0 4px 12px rgba(197, 155, 39, 0.25) !important;
    }

    /* Forms */
    .form-control, .form-select {
      border-radius: 10px !important;
      border: 1px solid #cbd5e1 !important;
      padding: 10px 16px !important;
      font-size: 13.5px !important;
      color: var(--lms-dark) !important;
      background-color: #ffffff !important;
      transition: all 0.2s ease !important;
    }

    .form-control:focus, .form-select:focus {
      border-color: var(--lms-primary) !important;
      box-shadow: 0 0 0 4px rgba(133, 22, 36, 0.12) !important;
    }

    label {
      font-size: 13px !important;
      font-weight: 700 !important;
      color: #334155 !important;
      margin-bottom: 6px !important;
    }

    /* Modals */
    .modal-content {
      border-radius: 16px !important;
      border: 1px solid rgba(133, 22, 36, 0.15) !important;
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15) !important;
      overflow: hidden !important;
    }

    .modal-header {
      background: linear-gradient(135deg, #851624 0%, #680e1a 100%) !important;
      color: #ffffff !important;
      border-bottom: 2px solid #c59b27 !important;
      padding: 16px 24px !important;
    }

    .modal-header .modal-title {
      color: #ffffff !important;
      font-weight: 700 !important;
      font-size: 17px !important;
    }

    .modal-header .btn-close {
      filter: brightness(0) invert(1) !important;
    }

    /* Badges */
    .badge.bg-success {
      background-color: #ecfdf5 !important;
      color: #065f46 !important;
      border: 1px solid #a7f3d0 !important;
      font-weight: 700 !important;
      padding: 5px 12px !important;
      border-radius: 20px !important;
    }

    .badge.bg-danger {
      background-color: #fef2f2 !important;
      color: #991b1b !important;
      border: 1px solid #fecaca !important;
      font-weight: 700 !important;
      padding: 5px 12px !important;
      border-radius: 20px !important;
    }

    .badge.bg-primary {
      background-color: #fbecee !important;
      color: #851624 !important;
      border: 1px solid #ecc9cf !important;
      font-weight: 700 !important;
      padding: 5px 12px !important;
      border-radius: 20px !important;
    }

    .badge-success, .badge.badge-success, .badge.bg-success {
      background-color: #eef7ed !important;
      color: #1e7e34 !important;
      border: 1px solid #c3e6cb !important;
      font-weight: 700 !important;
      padding: 5px 12px !important;
      border-radius: 20px !important;
    }

    .badge-secondary, .badge.badge-secondary, .badge.bg-secondary {
      background-color: #f3f4f6 !important;
      color: #4b5563 !important;
      border: 1px solid #e5e7eb !important;
      font-weight: 700 !important;
      padding: 5px 12px !important;
      border-radius: 20px !important;
    }

    /* Alerts */
    .alert-success {
      background-color: #ecfdf5 !important;
      border: 1px solid #a7f3d0 !important;
      color: #065f46 !important;
      border-radius: 10px !important;
      font-weight: 600 !important;
    }

    .alert-danger {
      background-color: #fef2f2 !important;
      border: 1px solid #fecaca !important;
      color: #991b1b !important;
      border-radius: 10px !important;
      font-weight: 600 !important;
    }

    /* Modern Luxury Pagination */
    .pagination {
      margin-bottom: 0 !important;
      display: flex !important;
      flex-wrap: wrap !important;
      gap: 5px !important;
      align-items: center !important;
      list-style: none !important;
      padding-left: 0 !important;
    }

    .pagination svg {
      width: 15px !important;
      height: 15px !important;
      display: inline-block !important;
      vertical-align: middle !important;
    }

    .page-item .page-link {
      color: #4a060e !important;
      background-color: #ffffff !important;
      border: 1px solid #ebd8b0 !important;
      border-radius: 8px !important;
      padding: 6px 14px !important;
      font-size: 0.88rem !important;
      font-weight: 600 !important;
      transition: all 0.2s ease !important;
      text-decoration: none !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      line-height: 1.4 !important;
    }

    .page-item.active .page-link {
      background: linear-gradient(135deg, #851624, #4a060e) !important;
      border-color: #851624 !important;
      color: #ffffff !important;
      box-shadow: 0 2px 6px rgba(133, 22, 36, 0.3) !important;
    }

    .page-item .page-link:hover {
      background-color: #faf5ee !important;
      color: #851624 !important;
      border-color: #c59b27 !important;
    }

    .page-item.disabled .page-link {
      color: #a0aec0 !important;
      background-color: #f8fafc !important;
      border-color: #edf2f7 !important;
      cursor: not-allowed !important;
    }

    /* Hide redundant Tailwind & Bootstrap English wrapper text inside pagination */
    nav[role="navigation"] > div.d-none.flex-sm-fill,
    nav p.small.text-muted,
    nav .small.text-muted {
      display: none !important;
    }

    @media (max-width: 992px) {
      .lms-sidebar {
        transform: translateX(-100%);
      }
      .lms-sidebar.show {
        transform: translateX(0);
      }
      .lms-main {
        margin-left: 0;
        width: 100%;
      }
      .mobile-menu-btn {
        display: block;
      }
      .header-search {
        display: none;
      }
      .lms-content {
        padding: 20px 16px;
      }
      .lms-header {
        padding: 0 16px;
      }
    }
  </style>
</head>

<body>

  <div class="lms-layout">

    <!-- ==========================================
         SIDEBAR NAVIGATION
    ========================================== -->
    <aside class="lms-sidebar" id="sidebarMenu">
      <div>
        <!-- Brand Logo -->
        <a href="/" class="sidebar-brand">
          <img src="{{ asset('assets/img/logo 1.png') }}" alt="SMA Tuna Bangsa">
          <div>
            <div class="brand-title">Tuna<span>Bangsa</span></div>
            <div class="brand-badge">E-Learning LMS</div>
          </div>
        </a>

        <!-- Menu Navigation according to User Role -->
        <ul class="sidebar-nav">
          
          <div class="nav-label">Menu Utama</div>

          @if(Auth::user()->user_type == 1)
            <!-- ADMIN MENU -->
            <li>
              <a href="{{ route('admin.dashboard') }}" class="nav-item-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a href="/admin/student/list" class="nav-item-link {{ request()->is('admin/student*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-graduate"></i>
                <span>Data Siswa</span>
              </a>
            </li>
            <li>
              <a href="/admin/teacher/list" class="nav-item-link {{ request()->is('admin/teacher*') ? 'active' : '' }}">
                <i class="fa-solid fa-chalkboard-user"></i>
                <span>Data Guru</span>
              </a>
            </li>
            <li>
              <a href="/admin/class/list" class="nav-item-link {{ request()->is('admin/class*') ? 'active' : '' }}">
                <i class="fa-solid fa-school"></i>
                <span>Data Kelas</span>
              </a>
            </li>
            <li>
              <a href="/admin/subject/list" class="nav-item-link {{ request()->is('admin/subject*') ? 'active' : '' }}">
                <i class="fa-solid fa-book-bookmark"></i>
                <span>Mata Pelajaran</span>
              </a>
            </li>

            <div class="nav-label">Akademik & Sekolah</div>

            <li>
              <a href="/admin/academic_year/list" class="nav-item-link {{ request()->is('admin/academic_year*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-week"></i>
                <span>Tahun Ajaran & Semester</span>
              </a>
            </li>
            <li>
              <a href="/admin/room/list" class="nav-item-link {{ request()->is('admin/room*') ? 'active' : '' }}">
                <i class="fa-solid fa-door-open"></i>
                <span>Ruangan Sekolah</span>
              </a>
            </li>
            <li>
              <a href="/admin/extracurricular/list" class="nav-item-link {{ request()->is('admin/extracurricular*') ? 'active' : '' }}">
                <i class="fa-solid fa-award"></i>
                <span>Ekstrakurikuler</span>
              </a>
            </li>
            <li>
              <a href="/admin/assign_subject/list" class="nav-item-link {{ request()->is('admin/assign_subject*') ? 'active' : '' }}">
                <i class="fa-solid fa-layer-group"></i>
                <span>Kelas & Mapel</span>
              </a>
            </li>
            <li>
              <a href="/admin/assign_class_teacher/list" class="nav-item-link {{ request()->is('admin/assign_class_teacher*') ? 'active' : '' }}">
                <i class="fa-solid fa-users-gear"></i>
                <span>Penugasan Guru</span>
              </a>
            </li>
            <li>
              <a href="{{ route('admin.timetable.list') }}" class="nav-item-link {{ request()->is('admin/timetable*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Jadwal Pelajaran KBM</span>
              </a>
            </li>
            <li>
              <a href="/admin/materials/list" class="nav-item-link {{ request()->is('admin/materials*') ? 'active' : '' }}">
                <i class="fa-solid fa-book-open-reader"></i>
                <span>Bank Materi Belajar</span>
              </a>
            </li>
            <li>
              <a href="{{ route('admin.attendance.report') }}" class="nav-item-link {{ request()->is('admin/attendance*') ? 'active' : '' }}">
                <i class="fa-solid fa-clipboard-user"></i>
                <span>Rekap Presensi Siswa</span>
              </a>
            </li>
            <li>
              <a href="{{ route('admin.gradebook.report') }}" class="nav-item-link {{ request()->is('admin/gradebook*') ? 'active' : '' }}">
                <i class="fa-solid fa-graduation-cap"></i>
                <span>Buku Nilai & Leger</span>
              </a>
            </li>
            <li>
              <a href="{{ route('admin.homework.list') }}" class="nav-item-link {{ request()->is('admin/admin/homework*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-pen"></i>
                <span>Tugas / Homework</span>
              </a>
            </li>
            <li>
              <a href="{{ route('cbt.exams.list') }}" class="nav-item-link {{ request()->is('cbt/exams*') ? 'active' : '' }}">
                <i class="fa-solid fa-laptop-code"></i>
                <span>Ujian CBT & Kuis</span>
              </a>
            </li>
            <li>
              <a href="{{ route('cbt.questions.list') }}" class="nav-item-link {{ request()->is('cbt/questions*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-circle-question"></i>
                <span>Bank Soal CBT</span>
              </a>
            </li>
            <li>
              <a href="{{ route('admin.notice_board.list') }}" class="nav-item-link {{ request()->is('admin/notice_board*') ? 'active' : '' }}">
                <i class="fa-solid fa-bullhorn"></i>
                <span>Pengumuman Sekolah</span>
              </a>
            </li>
            <li>
              <a href="{{ route('admin.homeroom.report') }}" class="nav-item-link {{ request()->is('admin/homeroom*') ? 'active' : '' }}">
                <i class="fa-solid fa-id-card-clip"></i>
                <span>Rekap Bimbingan Siswa</span>
              </a>
            </li>
            <li>
              <a href="/admin/admin/list" class="nav-item-link {{ request()->is('admin/admin/list*') ? 'active' : '' }}">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Admin User</span>
              </a>
            </li>
            <li>
              <a href="{{ route('admin.activity_logs') }}" class="nav-item-link {{ request()->is('admin/activity_logs*') ? 'active' : '' }}">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>Jejak Audit Aktivitas</span>
              </a>
            </li>

          @elseif(Auth::user()->user_type == 2)
            <!-- TEACHER MENU -->
            <li>
              <a href="{{ route('teacher.dashboard') }}" class="nav-item-link {{ request()->is('teacher/dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a href="{{ route('teacher.myclasssubject') }}" class="nav-item-link {{ request()->is('teacher/my_class_subject*') ? 'active' : '' }}">
                <i class="fa-solid fa-chalkboard"></i>
                <span>Kelas & Mapel Saya</span>
              </a>
            </li>
            <li>
              <a href="{{ route('teacher.timetable') }}" class="nav-item-link {{ request()->is('teacher/my_timetable*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Jadwal Mengajar KBM</span>
              </a>
            </li>
            <li>
              <a href="{{ route('teacher.homeroom.index') }}" class="nav-item-link {{ request()->is('teacher/homeroom*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-shield"></i>
                <span>Kelas Binaan (Wali Kelas)</span>
              </a>
            </li>
            <li>
              <a href="{{ route('teacher.materials.list') }}" class="nav-item-link {{ request()->is('teacher/materials*') ? 'active' : '' }}">
                <i class="fa-solid fa-book-open-reader"></i>
                <span>Materi Pembelajaran</span>
              </a>
            </li>
            <li>
              <a href="{{ route('teacher.mystudent') }}" class="nav-item-link {{ request()->is('teacher/my_student*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-graduate"></i>
                <span>Siswa Bimbingan</span>
              </a>
            </li>
            <li>
              <a href="{{ route('teacher.my_extracurricular') }}" class="nav-item-link {{ request()->is('teacher/my_extracurricular*') ? 'active' : '' }}">
                <i class="fa-solid fa-award"></i>
                <span>Ekskul Binaan</span>
              </a>
            </li>

            <div class="nav-label">Evaluasi & Komunikasi</div>

            <li>
              <a href="{{ route('teacher.attendance.take') }}" class="nav-item-link {{ request()->is('teacher/attendance*') ? 'active' : '' }}">
                <i class="fa-solid fa-clipboard-user"></i>
                <span>Presensi & Kehadiran</span>
              </a>
            </li>
            <li>
              <a href="{{ route('teacher.gradebook.index') }}" class="nav-item-link {{ request()->is('teacher/gradebook*') ? 'active' : '' }}">
                <i class="fa-solid fa-graduation-cap"></i>
                <span>Buku Nilai & Asesmen</span>
              </a>
            </li>
            <li>
              <a href="{{ route('teacher.homework.list') }}" class="nav-item-link {{ request()->is('teacher/teacher/homework*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-pen"></i>
                <span>Tugas & Homework</span>
              </a>
            </li>
            <li>
              <a href="{{ route('teacher.notice_board.list') }}" class="nav-item-link {{ request()->is('teacher/notice_board*') ? 'active' : '' }}">
                <i class="fa-solid fa-bullhorn"></i>
                <span>Papan Pengumuman</span>
              </a>
            </li>
            <li>
              <a href="{{ route('cbt.exams.list') }}" class="nav-item-link {{ request()->is('cbt/exams*') ? 'active' : '' }}">
                <i class="fa-solid fa-laptop-code"></i>
                <span>Kelola Ujian CBT</span>
              </a>
            </li>
            <li>
              <a href="{{ route('cbt.questions.list') }}" class="nav-item-link {{ request()->is('cbt/questions*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-circle-question"></i>
                <span>Bank Soal Saya</span>
              </a>
            </li>
            <li>
              <a href="{{ route('discussion.index') }}" class="nav-item-link {{ request()->is('discussion*') ? 'active' : '' }}">
                <i class="fa-solid fa-comments"></i>
                <span>Forum Diskusi & Q&A</span>
              </a>
            </li>

          @elseif(Auth::user()->user_type == 3)
            <!-- STUDENT MENU -->
            <li>
              <a href="{{ route('student.dashboard') }}" class="nav-item-link {{ request()->is('student/dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a href="{{ url('student/my_subject') }}" class="nav-item-link {{ request()->is('student/my_subject*') ? 'active' : '' }}">
                <i class="fa-solid fa-book-open"></i>
                <span>Mata Pelajaran Saya</span>
              </a>
            </li>
            <li>
              <a href="{{ route('student.timetable') }}" class="nav-item-link {{ request()->is('student/my_timetable*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Jadwal Pelajaran KBM</span>
              </a>
            </li>
            <li>
              <a href="{{ route('student.materials.list') }}" class="nav-item-link {{ request()->is('student/materials*') ? 'active' : '' }}">
                <i class="fa-solid fa-book-open-reader"></i>
                <span>Materi Belajar</span>
              </a>
            </li>
            <li>
              <a href="{{ route('student.attendance.index') }}" class="nav-item-link {{ request()->is('student/my_attendance*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-check"></i>
                <span>Presensi Saya</span>
              </a>
            </li>
            <li>
              <a href="{{ route('student.report_card') }}" class="nav-item-link {{ request()->is('student/report_card*') ? 'active' : '' }}">
                <i class="fa-solid fa-graduation-cap"></i>
                <span>Rapor Digital Saya</span>
              </a>
            </li>
            <li>
              <a href="{{ route('student.guidance.index') }}" class="nav-item-link {{ request()->is('student/my_guidance*') ? 'active' : '' }}">
                <i class="fa-solid fa-award"></i>
                <span>Catatan Wali Kelas</span>
              </a>
            </li>
            <li>
              <a href="{{ route('student.notice_board.list') }}" class="nav-item-link {{ request()->is('student/notice_board*') ? 'active' : '' }}">
                <i class="fa-solid fa-bullhorn"></i>
                <span>Papan Pengumuman</span>
              </a>
            </li>
            <li>
              <a href="{{ route('student.my_extracurricular') }}" class="nav-item-link {{ request()->is('student/my_extracurricular*') ? 'active' : '' }}">
                <i class="fa-solid fa-trophy"></i>
                <span>Ekstrakurikuler</span>
              </a>
            </li>

            <div class="nav-label">Tugas & Evaluasi</div>

            <li>
              <a href="{{ route('student.homework.list') }}" class="nav-item-link {{ request()->is('student/student/homework/my_homework*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-circle-check"></i>
                <span>Tugas & Homework</span>
              </a>
            </li>
            <li>
              <a href="{{ route('student.my_submitted_homework.list') }}" class="nav-item-link {{ request()->is('student/student/homework/my_submitted_homework*') ? 'active' : '' }}">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>Riwayat Pengumpulan</span>
              </a>
            </li>
            <li>
              <a href="{{ route('cbt.student.list') }}" class="nav-item-link {{ request()->is('cbt/student*') ? 'active' : '' }}">
                <i class="fa-solid fa-laptop-code"></i>
                <span>Ruang Ujian & Kuis CBT</span>
              </a>
            </li>
            <li>
              <a href="{{ route('discussion.index') }}" class="nav-item-link {{ request()->is('discussion*') ? 'active' : '' }}">
                <i class="fa-solid fa-comments"></i>
                <span>Forum Diskusi & Q&A</span>
              </a>
            </li>

          @elseif(Auth::user()->user_type == 4)
            <!-- PARENT MENU (PRD Bab 3 & 11) -->
            <li>
              <a href="{{ route('parent.dashboard') }}" class="nav-item-link {{ request()->is('parent/dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard Anak</span>
              </a>
            </li>
            <li>
              <a href="{{ route('parent.my_student_grades') }}" class="nav-item-link {{ request()->is('parent/my_student_grades*') ? 'active' : '' }}">
                <i class="fa-solid fa-graduation-cap"></i>
                <span>Capaian Nilai & Rapor</span>
              </a>
            </li>
            <li>
              <a href="{{ route('parent.my_student_attendance') }}" class="nav-item-link {{ request()->is('parent/my_student_attendance*') ? 'active' : '' }}">
                <i class="fa-solid fa-clipboard-user"></i>
                <span>Presensi Kehadiran Anak</span>
              </a>
            </li>
            <li>
              <a href="{{ route('parent.my_student_timetable') }}" class="nav-item-link {{ request()->is('parent/my_student_timetable*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Jadwal Pelajaran KBM</span>
              </a>
            </li>
            <li>
              <a href="{{ route('parent.notice_board') }}" class="nav-item-link {{ request()->is('parent/notice_board*') ? 'active' : '' }}">
                <i class="fa-solid fa-bullhorn"></i>
                <span>Pengumuman Sekolah</span>
              </a>
            </li>
          @endif

          <div class="nav-label">Pengaturan</div>
          <li>
            <a href="{{ route('my_account') }}" class="nav-item-link {{ request()->is('my-account*') ? 'active' : '' }}">
              <i class="fa-solid fa-user-gear"></i>
              <span>Profil & Akun</span>
            </a>
          </li>

        </ul>
      </div>

      <!-- Bottom Widget -->
      <div class="sidebar-bottom-card">
        <h6>SMA Tuna Bangsa</h6>
        <p>E-Learning v2.4 • Aktif</p>
      </div>
    </aside>

    <!-- ==========================================
         MAIN AREA & TOPBAR
    ========================================== -->
    <div class="lms-main">
      
      <!-- Topbar Header -->
      <header class="lms-header">
        <div style="display: flex; align-items: center; gap: 14px;">
          <button class="mobile-menu-btn" onclick="toggleSidebar()"><i class="fa-solid fa-bars"></i></button>
          <div class="header-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Cari mata pelajaran, kelas, guru, tugas...">
          </div>
        </div>

        <div class="header-actions">
          <div class="badge-live" data-bs-toggle="modal" data-bs-target="#liveClassModal" title="Klik untuk Masuk atau Kelola Ruang Kelas Virtual">
            <span class="badge-live-dot"></span>
            <span>Live Class</span>
            <i class="fa-solid fa-video ms-1" style="font-size: 10px; opacity: 0.85;"></i>
          </div>

          @php
            $headerUnreadCount = Auth::check() ? \App\Models\InAppNotificationModel::getUnreadCount(Auth::id()) : 0;
            $headerRecentNotifs = Auth::check() ? \App\Models\InAppNotificationModel::getMyNotifications(Auth::id(), 5) : [];
          @endphp
          <div class="dropdown">
            <button class="btn-header-icon dropdown-toggle position-relative" data-bs-toggle="dropdown" aria-expanded="false" title="Pemberitahuan & Notifikasi" style="border: none; background: transparent; cursor: pointer;">
              <i class="fa-regular fa-bell"></i>
              @if($headerUnreadCount > 0)
                <span class="position-absolute translate-middle badge rounded-pill bg-danger" style="top: 8px; right: -2px; font-size: 0.65rem; padding: 3px 6px;">
                  {{ $headerUnreadCount }}
                </span>
              @endif
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 p-0" style="min-width: 320px; border-radius: 12px; overflow: hidden; z-index: 1050;">
              <li class="px-3 py-2 d-flex justify-content-between align-items-center text-white" style="background: linear-gradient(135deg, #851624, #4a060e);">
                <span class="fw-bold fs-7"><i class="fa-solid fa-bell me-1 text-warning"></i> Notifikasi Sistem</span>
                @if($headerUnreadCount > 0)
                  <form action="{{ route('notifications.mark_all_read') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-link text-white-50 p-0 fs-8 text-decoration-none" style="font-size: 0.72rem;">Tandai Dibaca</button>
                  </form>
                @endif
              </li>
              <div style="max-height: 280px; overflow-y: auto;">
                @forelse($headerRecentNotifs as $hNotif)
                  <li class="border-bottom">
                    <a class="dropdown-item py-2 px-3 {{ $hNotif->is_read ? 'text-muted' : 'bg-light' }}" href="{{ route('notifications.read_redirect', $hNotif->id) }}" style="white-space: normal;">
                      <div class="fw-bold fs-8 {{ $hNotif->is_read ? 'text-dark' : 'text-danger' }}">{{ $hNotif->title }}</div>
                      <small class="text-secondary d-block" style="font-size: 0.76rem; line-height: 1.3;">{{ Str::limit($hNotif->message, 70) }}</small>
                      <small class="text-muted" style="font-size: 0.68rem;"><i class="fa-regular fa-clock me-1"></i> {{ $hNotif->created_at->diffForHumans() }}</small>
                    </a>
                  </li>
                @empty
                  <li class="text-center py-4 text-muted fs-8">
                    <i class="fa-regular fa-bell-slash d-block mb-1 fs-5 opacity-50"></i>
                    Belum ada pemberitahuan baru
                  </li>
                @endforelse
              </div>
              <li class="p-2 text-center bg-white border-top">
                <a href="{{ route('notifications.index') }}" class="fs-8 fw-bold text-decoration-none" style="color: #851624;">
                  Lihat Semua Notifikasi <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
              </li>
            </ul>
          </div>

          <!-- User Profile Dropdown -->
          <div class="dropdown">
            <div class="user-profile-menu dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ !empty(Auth::user()->profile_pic) ? asset('upload/profile/'.Auth::user()->profile_pic) : asset('assets/img/team/team-4.jpg') }}" alt="Avatar" class="user-avatar-img" onerror="this.onerror=null;this.src='{{ asset('assets/img/team/team-1.jpg') }}';">
              <div class="user-info-text d-none d-md-block">
                <div class="user-name-title">{{ Auth::user()->name }}</div>
                <div class="user-role-badge">
                  @if(Auth::user()->user_type == 1) Administrator
                  @elseif(Auth::user()->user_type == 2) Guru Pengajar
                  @elseif(Auth::user()->user_type == 3) Siswa
                  @endif
                </div>
              </div>
            </div>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="min-width: 200px;">
              <li class="px-3 py-2 border-bottom">
                <div class="fw-bold fs-7">{{ Auth::user()->name }}</div>
                <small class="text-muted">{{ Auth::user()->email }}</small>
              </li>
              <li><a class="dropdown-item py-2" href="{{ route('my_account') }}"><i class="fa-regular fa-user me-2" style="color:var(--lms-primary);"></i> Profil Saya</a></li>
              <li><a class="dropdown-item py-2" href="/"><i class="fa-solid fa-globe me-2 text-info"></i> Ke Landing Page</a></li>
              <li><hr class="dropdown-divider my-1"></li>
              <li>
                <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
                <a class="dropdown-item py-2 text-danger" href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Logout
                </a>
              </li>
            </ul>
          </div>
        </div>
      </header>

      <!-- Page Content -->
      <main class="lms-content">
        @yield('container')
        @yield('content')
      </main>

    </div>

  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleSidebar() {
      document.getElementById('sidebarMenu').classList.toggle('show');
    }
  </script>

  @php
    $liveClassData = \Illuminate\Support\Facades\Cache::get('live_class_data', [
        'url' => 'https://meet.google.com/tunabangsa-kbm-live',
        'title' => 'KBM Daring SMA Tuna Bangsa - Ruang Kelas Virtual Utama',
        'teacher_name' => 'Bapak/Ibu Guru Pengampu',
        'updated_at' => 'Aktif Semester Ini',
        'is_active' => true,
    ]);
  @endphp

  <!-- Modal Live Class Virtual -->
  <div class="modal fade" id="liveClassModal" tabindex="-1" aria-labelledby="liveClassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
        
        <!-- Modal Header Crimson Tuna Bangsa -->
        <div class="modal-header border-0 p-4 text-white" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%);">
          <div class="d-flex align-items-center gap-3">
            <div style="width: 46px; height: 46px; border-radius: 12px; background: rgba(255, 215, 0, 0.2); border: 1px solid rgba(255, 215, 0, 0.4); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
              <i class="fa-solid fa-video text-warning"></i>
            </div>
            <div>
              <span class="badge bg-warning text-dark px-2 py-0.5 rounded-pill fw-bold" style="font-size: 10px;">
                TATAP MUKA VIRTUAL
              </span>
              <h5 class="modal-title fw-bold mb-0 text-white" id="liveClassModalLabel">Ruang Kelas Live Class</h5>
              <small class="text-white-50">SMA Swasta Tuna Bangsa</small>
            </div>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body p-4">
          <!-- Status Banner -->
          <div class="p-3 rounded-3 mb-4 d-flex align-items-center gap-3" style="background: #fdf2f4; border: 1px solid #f9d2d7;">
            <div class="badge-live-dot" style="width: 10px; height: 10px; flex-shrink: 0;"></div>
            <div>
              <div class="fw-bold" style="color: #851624; font-size: 13.5px;">{{ $liveClassData['title'] }}</div>
              <small class="text-muted d-block" style="font-size: 11px;">Dipandu oleh: <strong>{{ $liveClassData['teacher_name'] }}</strong> • {{ $liveClassData['updated_at'] }}</small>
            </div>
          </div>

          <!-- Join Button for All Users -->
          <div class="text-center mb-4">
            <a href="{{ $liveClassData['url'] }}" target="_blank" class="btn btn-lg w-100 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2" style="background: linear-gradient(135deg, #851624, #a31d2f); color: white; border-radius: 12px; padding: 13px;">
              <i class="fa-solid fa-video"></i>
              <span>Gabung Sekarang (Google Meet / Zoom)</span>
              <i class="fa-solid fa-arrow-up-right-from-square ms-1" style="font-size: 11px;"></i>
            </a>
            <small class="text-muted mt-2 d-block" style="font-size: 11px;">Tautan ruang: <span class="text-primary text-decoration-underline">{{ $liveClassData['url'] }}</span></small>
          </div>

          <!-- Tata Tertib Singkat -->
          <div class="p-3 rounded-3 mb-3 bg-light border" style="font-size: 12px; color: #475569;">
            <div class="fw-bold mb-1 text-dark"><i class="fa-solid fa-circle-info text-primary me-1"></i> Tata Tertib Kelas Daring:</div>
            <ul class="mb-0 ps-3">
              <li>Nyalakan kamera video dan gunakan seragam sekolah yang rapi.</li>
              <li>Matikan mikrofon (mute) saat guru sedang memaparkan materi.</li>
              <li>Gunakan fitur <em>Raise Hand</em> untuk bertanya atau berdiskusi.</li>
            </ul>
          </div>

          @if(Auth::check() && in_array(Auth::user()->user_type, [1, 2]))
            <!-- Form Pengaturan Link untuk Guru & Admin -->
            <hr class="my-3">
            <div class="accordion" id="accordionLiveClassSettings">
              <div class="accordion-item border-0">
                <h2 class="accordion-header" id="headingSettings">
                  <button class="accordion-button collapsed py-2 px-0 bg-transparent text-primary fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSettings" aria-expanded="false" aria-controls="collapseSettings" style="font-size: 12.5px;">
                    <i class="fa-solid fa-gear me-1"></i> Atur / Ganti Link Live Class (Khusus Guru & Admin)
                  </button>
                </h2>
                <div id="collapseSettings" class="accordion-collapse collapse" aria-labelledby="headingSettings" data-bs-parent="#accordionLiveClassSettings">
                  <div class="accordion-body px-0 pt-2 pb-0">
                    <form action="{{ route('live_class.update') }}" method="POST">
                      @csrf
                      <div class="mb-2">
                        <label class="form-label small fw-bold text-dark mb-1">Judul / Topik Pertemuan</label>
                        <input type="text" name="title" class="form-control form-control-sm" value="{{ $liveClassData['title'] }}" required placeholder="Contoh: KBM Fisika Bab 3 - Kelas XI MIPA 1">
                      </div>
                      <div class="mb-3">
                        <label class="form-label small fw-bold text-dark mb-1">Tautan URL Meet / Zoom</label>
                        <input type="url" name="url" class="form-control form-control-sm" value="{{ $liveClassData['url'] }}" required placeholder="https://meet.google.com/xxx-yyyy-zzz">
                      </div>
                      <button type="submit" class="btn btn-sm btn-dark w-100 fw-bold" style="border-radius: 8px;">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Simpan & Aktifkan Link Baru
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          @endif

        </div>

        <div class="modal-footer bg-light border-0 py-2 px-4">
          <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Tutup</button>
        </div>

      </div>
    </div>
  </div>
</body>

</html>