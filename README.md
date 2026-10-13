# 🎓 LMS SMA Tuna Bangsa (E-Learning & Sistem Informasi Akademik)

[![Laravel](https://img.shields.io/badge/Laravel-9.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/AdminLTE-3-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)](https://adminlte.io/)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

**LMS SMA Tuna Bangsa** adalah platform Learning Management System (LMS) dan Sistem Informasi Akademik sekolah berbasis web yang dibangun menggunakan **Laravel 9** dan **MySQL/MariaDB**. Aplikasi ini dirancang untuk mendigitalkan seluruh proses kegiatan belajar-mengajar, administrasi sekolah, penilaian, ujian online (CBT), hingga pemantauan perkembangan siswa oleh orang tua secara real-time.

---

## 🌟 Fitur Utama Berdasarkan Role

Aplikasi ini memiliki sistem otentikasi multi-role dengan hak akses yang terisolasi dan spesifik:

### 1. 🛡️ Administrator (Admin)
- **Dashboard Eksekutif**: Statistik total siswa, guru, kelas, mata pelajaran, serta grafik aktivitas.
- **Manajemen Pengguna**: Kelola akun Admin, Guru, Siswa, dan Orang Tua.
- **Manajemen Akademik**: Tahun ajaran, ruang kelas, pembagian kelas, mata pelajaran, dan alokasi guru mata pelajaran.
- **Jadwal & Ruangan**: Penjadwalan pelajaran mingguan dan jadwal ujian.
- **Papan Pengumuman**: Publikasi pengumuman sekolah untuk guru, siswa, maupun umum.
- **Monitoring & Master Leger**: Akses rekapitulasi nilai dan presensi seluruh kelas.

### 2. 👨‍🏫 Guru (Teacher)
- **Dashboard Guru**: Ringkasan kelas yang diampu, tugas masuk, dan jadwal mengajar hari ini.
- **Materi & Tugas Pembelajaran**: Upload materi belajar (PDF, modul, tautan) dan penugasan (Homework & Assignment).
- **Koreksi & Penilaian Tugas**: Periksa jawaban tugas siswa dan berikan umpan balik/nilai.
- **Presensi Harian Siswa**: Input kehadiran siswa (Hadir, Sakit, Izin, Alpa) per pertemuan.
- **Buku Nilai (Gradebook)**: Input nilai tugas, UH, UTS, dan UAS.
- **Wali Kelas**: Cetak E-Rapor siswa dan Cetak Master Leger Nilai kelas binaan.
- **Bank Soal & CBT**: Buat bank soal dan publikasikan ujian online.

### 3. 👩‍🎓 Siswa (Student)
- **Dashboard Siswa**: Informasi tugas yang belum dikerjakan, pengumuman terbaru, dan jadwal pelajaran.
- **Akses Materi Belajar**: Akses dan unduh materi pelajaran dari guru.
- **Pengumpulan Tugas**: Kirim tugas dan pantau status serta nilai yang didapat.
- **Ujian Online (CBT)**: Mengikuti ujian berbasis komputer dengan antarmuka interaktif, timer otomatis, dan hasil langsung.
- **E-Rapor Digital**: Melihat nilai semester dan rapor secara mandiri.
- **Jadwal & Presensi**: Melihat jadwal pelajaran mingguan dan rekap kehadiran pribadi.
- **Ekstrakurikuler**: Pendaftaran dan pantau kegiatan ekskul yang diikuti.

### 4. 👨‍👩‍👧 Orang Tua / Wali (Parent)
- **Dashboard Orang Tua**: Ringkasan data akademik anak yang terhubung.
- **Monitoring Nilai**: Pantau nilai tugas, ujian, dan rapor akademik anak.
- **Monitoring Kehadiran**: Pantau catatan absensi anak secara berkala.
- **Jadwal Pelajaran**: Cek jadwal pelajaran dan kegiatan anak di sekolah.
- **Konseling & Catatan Sikap**: Akses informasi bimbingan konseling dan catatan perkembangan karakter siswa.

---

## 🖥️ Kredensial Akun Demo (Testing)

Semua akun demo di bawah menggunakan password bawaan yang sama:

> **Password untuk semua akun:** `123456`

| Role | Nama | Email | Password |
| :--- | :--- | :--- | :--- |
| **Admin** | Administrator | `admin@gmail.com` | `123456` |
| **Guru** | Teacher SMA Tuna Bangsa | `teacher@gmail.com` | `123456` |
| **Guru** | Budi Santoso | `budisantoso@gmail.com` | `123456` |
| **Siswa** | Nur Azila Tarigan | `nazila@gmail.com` | `123456` |
| **Siswa** | Arya | `arya@gmail.com` | `123456` |
| **Orang Tua** | Bapak Hendra Kusuma | `parent@gmail.com` | `123456` |

---

## 💻 Kebutuhan Sistem (Prerequisites)

- **PHP**: Versi `>= 8.0.2` (Direkomendasikan PHP 8.2)
- **Web Server**: Apache / Nginx (atau bawaan PHP CLI / XAMPP)
- **Database**: MySQL `>= 5.7` atau MariaDB `>= 10.3`
- **Composer**: Versi 2.x
- **Node.js & NPM**: Versi `>= 16.x` (opsional untuk bundling aset)

---

## 🚀 Panduan Instalasi & Menjalankan Lokal

### 1. Clone Repositori
```bash
git clone https://github.com/Azilatarigan01/e-learning-SMA-Tuna-Bangsa.git
cd e-learning-SMA-Tuna-Bangsa
```

### 2. Install Dependensi PHP
```bash
composer install
```

### 3. Konfigurasi Environment (`.env`)
Salin file `.env.example` ke `.env`:
```bash
cp .env.example .env
```
Generate application key:
```bash
php artisan key:generate
```

Sesuaikan konfigurasi database pada file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=web2
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Setup Database
Pastikan layanan MySQL di XAMPP / MariaDB sudah berjalan. Buat database baru bernama `web2`, lalu:

**Pilihan A (Menggunakan database dump `web2.sql` yang sudah lengkap):**
```bash
mysql -u root -p web2 < web2.sql
```

**Pilihan B (Menggunakan migration Laravel):**
```bash
php artisan migrate
```

### 5. Buat Symbolic Link Storage (Untuk Upload Dokumen/Foto)
```bash
php artisan storage:link
```

### 6. Jalankan Server Pengembangan
```bash
php artisan serve
```

Aplikasi sekarang dapat diakses melalui browser di:
👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)** atau **[http://localhost:8000](http://localhost:8000)**

---

## 📁 Struktur Direktori Utama

```
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Controller untuk Admin, Teacher, Student, Parent, CBT, dll.
│   │   └── Middleware/         # Middleware otentikasi role (Admin, Teacher, Student, Parent)
│   └── Models/                 # Model Eloquent (User, Class, Subject, CBT, Attendance, dll.)
├── config/                     # File konfigurasi aplikasi Laravel
├── database/
│   ├── migrations/             # Skema migrasi database
│   └── seeders/                # Database seeder
├── public/                     # Public root (aset CSS, JS, upload, logo)
├── resources/
│   └── views/                  # Tampilan antarmuka Blade template
│       ├── admin/              # Halaman panel Administrator
│       ├── teacher/            # Halaman panel Guru
│       ├── student/            # Halaman panel Siswa
│       ├── parent/             # Halaman panel Orang Tua
│       ├── cbt/                # Modul Ujian Online CBT
│       ├── auth/               # Halaman Login & Registrasi
│       └── layouts/            # Layout utama & navigasi
├── routes/
│   ├── web.php                 # Rute utama aplikasi
│   └── api.php                 # Rute REST API
├── vercel.json                 # Konfigurasi deployment ke Vercel Serverless
└── web2.sql                    # SQL dump data awal sistem
```

---

## ☁️ Deployment ke Vercel

Proyek ini telah dilengkapi dengan berkas [vercel.json](file:///c:/Users/Nur%20Azila%20Tarigan/Documents/FILE%20KULIAH/SEM%203/WEB%202/LMS/vercel.json) dan konfigurasi serverless PHP runtime (`vercel-php@0.7.1`). Untuk mendeploy ke Vercel:
1. Hubungkan repositori GitHub ini dengan akun Vercel.
2. Tambahkan variabel environment (`APP_KEY`, `APP_URL`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) pada dashboard Vercel.
3. Deploy branch `main`.

---

## 👥 Pengembang

- **Pengembang:** Azila Tarigan ([@Azilatarigan01](https://github.com/Azilatarigan01))
- **Mata Kuliah:** Web Programming 2 (Semester 3)
- **Institusi:** SMA Tuna Bangsa Learning Management System Project

---

## 📄 Lisensi

Proyek ini dikembangkan untuk keperluan akademik dan didistribusikan di bawah lisensi [MIT License](LICENSE).
