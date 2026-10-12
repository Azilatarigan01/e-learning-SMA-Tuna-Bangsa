@extends('layouts.app')

@section('container')
<style>
  .dashboard-grid {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 28px;
  }

  /* Hero Welcome Banner in Luxury Crimson Maroon */
  .welcome-banner {
    background: linear-gradient(135deg, #851624 0%, #680e1a 45%, #4a0d16 100%);
    border-radius: 20px;
    padding: 34px 38px;
    color: #ffffff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(133, 22, 36, 0.28);
    margin-bottom: 30px;
  }

  .banner-text-content {
    max-width: 58%;
    z-index: 2;
  }

  .banner-title {
    font-size: 26px;
    font-weight: 800;
    margin-bottom: 8px;
    letter-spacing: -0.3px;
    font-family: 'Playfair Display', Georgia, serif;
  }

  .banner-desc {
    font-size: 13.5px;
    color: #ffd8df;
    line-height: 1.5;
    margin-bottom: 22px;
  }

  .btn-banner-action {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(8px);
    color: #ffffff;
    font-size: 11.5px;
    font-weight: 800;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    padding: 10px 20px;
    border-radius: 30px;
    border: 1px solid rgba(255, 215, 0, 0.5);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
  }

  .btn-banner-action:hover {
    background: #ffffff;
    color: var(--lms-primary);
    border-color: #ffffff;
  }

  .banner-artwork {
    width: 220px;
    height: 140px;
    z-index: 2;
    filter: drop-shadow(0 15px 20px rgba(0,0,0,0.2));
  }

  .section-title-wrap {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
  }

  .section-heading-text {
    font-size: 18px;
    font-weight: 800;
    color: #1e1e2d;
  }

  .link-view-all {
    font-size: 11.5px;
    font-weight: 700;
    color: #a1a5b7;
    letter-spacing: 0.6px;
    text-transform: uppercase;
  }

  .link-view-all:hover {
    color: var(--lms-primary);
  }

  .courses-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 34px;
  }

  .course-card {
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #eef0f8;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .course-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(133, 22, 36, 0.12);
  }

  .course-thumb-box {
    height: 120px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .course-thumb-maroon {
    background: linear-gradient(135deg, #a72335 0%, #851624 100%);
  }

  .course-thumb-gold {
    background: linear-gradient(135deg, #d4af37 0%, #b8860b 100%);
  }

  .course-thumb-deep {
    background: linear-gradient(135deg, #851624 0%, #4a0d16 100%);
  }

  .course-card-body {
    padding: 16px 18px 20px 18px;
  }

  .course-instructor-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 12px;
  }

  .inst-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
  }

  .inst-name {
    font-size: 13px;
    font-weight: 700;
    color: #1e1e2d;
    line-height: 1.2;
  }

  .class-tag-badge {
    font-size: 10.5px;
    font-weight: 700;
    color: var(--lms-primary);
    background: var(--lms-primary-light);
    padding: 2px 8px;
    border-radius: 4px;
    margin-top: 2px;
    display: inline-block;
  }

  .course-metrics {
    display: flex;
    align-items: center;
    gap: 14px;
    font-size: 11.5px;
    color: #8c93a9;
    font-weight: 600;
    margin-bottom: 14px;
    padding-bottom: 12px;
    border-bottom: 1px dashed #eef0f8;
  }

  .course-metrics span {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .course-progress-info {
    display: flex;
    justify-content: space-between;
    font-size: 11px;
    font-weight: 700;
    color: #8c93a9;
    margin-bottom: 6px;
  }

  .course-progress-bar {
    height: 6px;
    border-radius: 10px;
    background: #edf0f8;
    overflow: hidden;
  }

  .schedule-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 24px;
    border: 1px solid #eef0f8;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
  }

  .schedule-grid-table {
    width: 100%;
    display: grid;
    grid-template-columns: 60px repeat(7, 1fr);
    gap: 8px;
    align-items: center;
  }

  .sched-head {
    font-size: 11.5px;
    font-weight: 700;
    color: #8c93a9;
    text-align: center;
    padding-bottom: 10px;
  }

  .sched-time {
    font-size: 11px;
    font-weight: 700;
    color: #8c93a9;
  }

  .sched-block {
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 11.5px;
    font-weight: 700;
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .block-yellow {
    background: #fff8e6;
    color: #b78103;
    border-left: 3px solid #c59b27;
    grid-column: span 3;
  }

  .block-maroon {
    background: #fbecee;
    color: #851624;
    border-left: 3px solid #851624;
    grid-column: span 2;
  }

  .block-gold {
    background: #fef8e7;
    color: #996515;
    border-left: 3px solid #c59b27;
    grid-column: span 3;
  }

  .right-widgets-col {
    display: flex;
    flex-direction: column;
    gap: 22px;
  }

  .widget-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 22px;
    border: 1px solid #eef0f8;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
  }

  .calendar-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
  }

  .calendar-head h6 {
    font-size: 14px;
    font-weight: 800;
    color: #1e1e2d;
    margin-bottom: 0;
  }

  .calendar-days-row {
    display: flex;
    justify-content: space-between;
    text-align: center;
  }

  .cal-day-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    padding: 8px 6px;
    border-radius: 12px;
    cursor: pointer;
  }

  .cal-day-name {
    font-size: 10px;
    font-weight: 700;
    color: #8c93a9;
  }

  .cal-day-num {
    font-size: 13px;
    font-weight: 800;
    color: #1e1e2d;
  }

  .cal-day-box.active {
    background: var(--lms-primary);
    box-shadow: 0 4px 12px rgba(133, 22, 36, 0.35);
  }

  .cal-day-box.active .cal-day-name,
  .cal-day-box.active .cal-day-num {
    color: #ffffff;
  }

  .growth-widget-body {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 10px;
  }

  .growth-info h6 {
    font-size: 13.5px;
    font-weight: 800;
    color: #1e1e2d;
    margin-bottom: 4px;
  }

  .growth-trend {
    font-size: 11.5px;
    color: var(--lms-primary);
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .donut-gauge {
    width: 60px;
    height: 60px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .donut-text {
    position: absolute;
    font-size: 12px;
    font-weight: 800;
    color: var(--lms-primary);
  }

  .homework-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
    padding: 12px 0;
    border-bottom: 1px solid #f4f5fa;
  }

  .hw-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .hw-title {
    font-size: 12.5px;
    font-weight: 700;
    color: #1e1e2d;
  }

  .hw-desc {
    font-size: 11px;
    color: #8c93a9;
  }

  .hw-progress-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 4px;
  }

  .hw-bar {
    flex-grow: 1;
    height: 5px;
    border-radius: 10px;
    background: #edf0f8;
    overflow: hidden;
  }

  .hw-pct {
    font-size: 11px;
    font-weight: 800;
    color: #8c93a9;
    width: 28px;
    text-align: right;
  }

  @media (max-width: 1200px) {
    .dashboard-grid { grid-template-columns: 1fr; }
  }

  @media (max-width: 768px) {
    .courses-grid { grid-template-columns: 1fr; }
    .banner-artwork { display: none; }
    .banner-text-content { max-width: 100%; }
  }
</style>

<div class="dashboard-grid">
  
  <!-- Left Main Column -->
  <div>
    
    <!-- Hero Welcome Banner -->
    <div class="welcome-banner">
      <div class="banner-text-content">
        <h1 class="banner-title">Welcome back, {{ Auth::user()->name }}!</h1>
        <p class="banner-desc">
          Panel Guru Pengajar SMA Tuna Bangsa. Kelola materi pembelajaran, bagikan tugas homework, dan periksa lembar ujian siswa bimbingan Anda.
        </p>
        <a href="{{ route('teacher.homework.list') }}" class="btn-banner-action">
          <span>Kelola Tugas Siswa</span>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>

      <!-- 3D Books Illustration -->
      <svg class="banner-artwork" viewBox="0 0 240 160" fill="none">
        <g transform="translate(10, 50)">
          <path d="M40 50L180 20L210 40L70 70Z" fill="#10b981"/>
          <path d="M40 50L70 70V85L40 65Z" fill="#047857"/>
          <path d="M70 70L210 40V55L70 85Z" fill="#059669"/>
          <path d="M70 70L210 40L210 48L70 78Z" fill="#ffffff" opacity="0.9"/>
          <path d="M120 48V72L128 66L136 72V45" fill="#ffd700"/>
        </g>
        <g transform="translate(25, 0)">
          <path d="M40 50L180 20L210 40L70 70Z" fill="#3b82f6"/>
          <path d="M40 50L70 70V85L40 65Z" fill="#1d4ed8"/>
          <path d="M70 70L210 40V55L70 85Z" fill="#2563eb"/>
          <path d="M70 70L210 40L210 48L70 78Z" fill="#ffffff" opacity="0.9"/>
          <path d="M140 42V66L148 60L156 66V39" fill="#ffffff"/>
        </g>
      </svg>
    </div>

    <!-- Section: Your Courses -->
    <div class="section-title-wrap">
      <h2 class="section-heading-text">Kelas & Mata Pelajaran Diampu</h2>
      <a href="{{ route('teacher.myclasssubject') }}" class="link-view-all">Lihat Semua <i class="fa-solid fa-angle-right"></i></a>
    </div>

    <div class="courses-grid">
      
      <!-- Card 1 -->
      <div class="course-card">
        <div class="course-thumb-box course-thumb-maroon">
          <svg width="70" height="70" viewBox="0 0 100 100" fill="none">
            <polygon points="50,20 90,40 50,60 10,40" fill="#ffffff"/>
            <path d="M30 48V70C30 80 70 80 70 70V48" fill="#ffffff" opacity="0.9"/>
            <path d="M85 40V75L80 78" stroke="#ffd700" stroke-width="3" stroke-linecap="round"/>
          </svg>
        </div>
        <div class="course-card-body">
          <div class="course-instructor-wrap">
            <img src="{{ !empty(Auth::user()->profile_pic) ? asset('upload/profile/'.Auth::user()->profile_pic) : asset('assets/img/team/team-4.jpg') }}" alt="Guru" class="inst-avatar">
            <div>
              <div class="inst-name">Kelas Bimbingan MIPA</div>
              <span class="class-tag-badge">Kelas X & XI MIPA</span>
            </div>
          </div>
          <div class="course-metrics">
            <span><i class="fa-solid fa-book-open"></i> 24 Sesi</span>
            <span><i class="fa-solid fa-clock"></i> 48 Jam</span>
            <span><i class="fa-solid fa-users"></i> 72 Siswa</span>
          </div>
          <div class="course-progress-info">
            <span>Koreksi Tugas: 80%</span>
            <span>16/20 Selesai</span>
          </div>
          <div class="course-progress-bar">
            <div style="background:#851624; height:100%; width:80%;"></div>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="course-card">
        <div class="course-thumb-box course-thumb-gold">
          <svg width="70" height="70" viewBox="0 0 100 100" fill="none">
            <rect x="25" y="30" width="50" height="15" rx="3" fill="#ffffff"/>
            <rect x="20" y="45" width="60" height="15" rx="3" fill="#ffffff" opacity="0.9"/>
            <circle cx="50" cy="22" r="8" fill="#851624"/>
          </svg>
        </div>
        <div class="course-card-body">
          <div class="course-instructor-wrap">
            <img src="{{ asset('assets/img/team/team-1.jpg') }}" alt="Guru" class="inst-avatar">
            <div>
              <div class="inst-name">Ujian CBT Terjadwal</div>
              <span class="class-tag-badge" style="color:#b8860b; background:#fef8e7;">Semester Ganjil</span>
            </div>
          </div>
          <div class="course-metrics">
            <span><i class="fa-solid fa-laptop-code"></i> CBT Exam</span>
            <span><i class="fa-solid fa-file-shield"></i> Terenkripsi</span>
            <span><i class="fa-solid fa-users"></i> 140 Siswa</span>
          </div>
          <div class="course-progress-info">
            <span>Kesiapan Bank Soal: 95%</span>
            <span>45/50 Soal</span>
          </div>
          <div class="course-progress-bar">
            <div style="background:#c59b27; height:100%; width:95%;"></div>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="course-card">
        <div class="course-thumb-box course-thumb-deep">
          <svg width="70" height="70" viewBox="0 0 100 100" fill="none">
            <circle cx="50" cy="50" r="30" fill="#ffffff"/>
            <polygon points="50,30 56,43 70,43 59,52 63,65 50,56 37,65 41,52 30,43 44,43" fill="#c59b27"/>
          </svg>
        </div>
        <div class="course-card-body">
          <div class="course-instructor-wrap">
            <img src="{{ asset('assets/img/team/team-2.jpg') }}" alt="Guru" class="inst-avatar">
            <div>
              <div class="inst-name">Tugas Mandiri (Homework)</div>
              <span class="class-tag-badge" style="color:#851624; background:#fbecee;">Evaluasi Aktif</span>
            </div>
          </div>
          <div class="course-metrics">
            <span><i class="fa-solid fa-file-pen"></i> 8 Tugas</span>
            <span><i class="fa-solid fa-clock"></i> 7 Hari</span>
            <span><i class="fa-solid fa-users"></i> 85 Siswa</span>
          </div>
          <div class="course-progress-info">
            <span>Terkumpul: 88%</span>
            <span>75/85 Siswa</span>
          </div>
          <div class="course-progress-bar">
            <div style="background:#851624; height:100%; width:88%;"></div>
          </div>
        </div>
      </div>

    </div>

    <!-- Section: My Schedule -->
    <div class="schedule-card">
      <div class="section-title-wrap mb-3">
        <h2 class="section-heading-text" style="font-size: 16px;">Jadwal Mengajar Guru</h2>
        <a href="{{ route('teacher.my_exam_timetable') }}" class="link-view-all">Lihat Jadwal Lengkap <i class="fa-solid fa-calendar-days"></i></a>
      </div>

      <div class="schedule-grid-table">
        <div class="sched-head">Jam</div>
        <div class="sched-head">Sen</div>
        <div class="sched-head">Sel</div>
        <div class="sched-head">Rab</div>
        <div class="sched-head">Kam</div>
        <div class="sched-head">Jum</div>
        <div class="sched-head">Sab</div>
        <div class="sched-head">Min</div>

        <div class="sched-time">08:00</div>
        <div class="sched-block block-maroon">Mengajar Kelas X MIPA 1</div>
        <div></div>
        <div class="sched-block block-yellow">Sesi Konsultasi Tugas</div>
        <div></div>

        <div class="sched-time">10:00</div>
        <div></div>
        <div class="sched-block block-gold">Mengajar Kelas XI MIPA 1</div>
        <div></div>
        <div class="sched-block block-maroon">Pengawas Ujian CBT</div>

        <div class="sched-time">13:00</div>
        <div class="sched-block block-yellow">Koreksi Lembar Siswa</div>
        <div></div>
        <div></div>
        <div class="sched-block block-gold">Rapat Kurikulum</div>
      </div>
    </div>

  </div>

  <!-- Right Widgets Column -->
  <div class="right-widgets-col">
    
    <!-- Widget 1: Interactive Mini Calendar -->
    <div class="widget-card">
      <div class="calendar-head">
        <button class="btn btn-sm btn-light border-0 p-1"><i class="fa-solid fa-chevron-left"></i></button>
        <h6>Oktober 2026</h6>
        <button class="btn btn-sm btn-light border-0 p-1"><i class="fa-solid fa-chevron-right"></i></button>
      </div>

      <div class="calendar-days-row">
        <div class="cal-day-box">
          <span class="cal-day-name">Rab</span>
          <span class="cal-day-num">07</span>
        </div>
        <div class="cal-day-box">
          <span class="cal-day-name">Kam</span>
          <span class="cal-day-num">08</span>
        </div>
        <div class="cal-day-box">
          <span class="cal-day-name">Jum</span>
          <span class="cal-day-num">09</span>
        </div>
        <div class="cal-day-box">
          <span class="cal-day-name">Sab</span>
          <span class="cal-day-num">10</span>
        </div>
        <div class="cal-day-box active">
          <span class="cal-day-name">Min</span>
          <span class="cal-day-num">11</span>
        </div>
      </div>
    </div>

    <!-- Widget 2: Kinerja Penilaian Gauge -->
    <div class="widget-card">
      <div class="growth-widget-body">
        <div class="growth-info">
          <h6>Tugas Dinilai</h6>
          <div class="growth-trend">
            <i class="fa-solid fa-check-double"></i>
            <span>92% Siswa Tuntas</span>
          </div>
        </div>

        <div class="donut-gauge">
          <svg width="60" height="60" viewBox="0 0 36 36">
            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#edf0f8" stroke-width="3.8"/>
            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#851624" stroke-dasharray="92, 100" stroke-width="3.8" stroke-linecap="round"/>
          </svg>
          <div class="donut-text" style="color:#851624;">92%</div>
        </div>
      </div>
    </div>

    <!-- Widget 3: Homework Submissions to Review -->
    <div class="widget-card">
      <div class="section-title-wrap mb-2">
        <h6 class="section-heading-text" style="font-size: 14px;">Pengumpulan Tugas Siswa</h6>
        <i class="fa-solid fa-ellipsis-vertical text-muted"></i>
      </div>

      <div class="homework-item">
        <div class="hw-top">
          <span class="hw-title">Tugas Bab 3: Ringkasan Materi</span>
          <a href="{{ route('teacher.homework.list') }}" class="text-muted"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
        </div>
        <p class="hw-desc">32 Siswa telah mengumpulkan tugas</p>
        <div class="hw-progress-wrap">
          <div class="hw-bar">
            <div style="background:#851624; height:100%; width:90%;"></div>
          </div>
          <span class="hw-pct" style="color:#851624;">90%</span>
        </div>
      </div>

      <div class="homework-item">
        <div class="hw-top">
          <span class="hw-title">Ujian CBT Simulasi 1</span>
          <a href="{{ route('teacher.my_exam_timetable') }}" class="text-muted"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
        </div>
        <p class="hw-desc">Lembar jawaban siap dikoreksi</p>
        <div class="hw-progress-wrap">
          <div class="hw-bar">
            <div style="background:#c59b27; height:100%; width:100%;"></div>
          </div>
          <span class="hw-pct" style="color:#c59b27;">100%</span>
        </div>
      </div>

      <div class="homework-item">
        <div class="hw-top">
          <span class="hw-title">Latihan Soal Mandiri</span>
          <a href="{{ route('teacher.homework.list') }}" class="text-muted"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
        </div>
        <p class="hw-desc">24 Siswa telah mengumpulkan</p>
        <div class="hw-progress-wrap">
          <div class="hw-bar">
            <div style="background:#851624; height:100%; width:75%;"></div>
          </div>
          <span class="hw-pct" style="color:#851624;">75%</span>
        </div>
      </div>

    </div>

  </div>

</div>
@endsection
