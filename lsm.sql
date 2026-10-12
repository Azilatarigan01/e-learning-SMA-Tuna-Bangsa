-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jun 2024 pada 17.29
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lsm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `assignments_date` date DEFAULT NULL,
  `submission_date` date DEFAULT NULL,
  `document_file` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `assignments`
--

INSERT INTO `assignments` (`id`, `class_id`, `subject_id`, `assignments_date`, `submission_date`, `document_file`, `description`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(7, 10, 3, '2024-06-06', '2024-06-03', 'LAPORAN WEB2 KELOMPOK 2 REVISIIIIIIIIII.docx', 'dikerjakan yaa....', 0, 1, '2024-06-05 07:42:42', '2024-06-05 07:42:42'),
(9, 3, 3, '2024-06-04', '2024-06-06', 'Juknis Voly Putri 2024.docx', 'hh', 0, 1, '2024-06-05 07:50:27', '2024-06-05 07:50:27'),
(12, 14, 5, '2024-06-12', '2024-06-18', 'dfd level 0.docx', 'kenapa???', 0, 1, '2024-06-05 11:11:30', '2024-06-05 11:11:30'),
(14, 9, 6, '2024-06-20', '2024-06-28', 'dfd level 0.docx', 'y', 0, 1, '2024-06-05 11:29:53', '2024-06-05 11:29:53'),
(15, 5, 5, '2024-06-06', '2024-06-07', 'dfd level 0.docx', 'ya allah bantuu', 0, 22, '2024-06-07 11:52:06', '2024-06-07 11:52:06'),
(16, 5, 5, '2024-06-07', '2024-06-14', 'JUKNIS_VOLI_ISSCOM_2024[1][1].docx', 'ya allah pliss kali ini stidknya beri aku pentunjuk ya allah banyak lagi yang mau kukerjain ya allah', 0, 22, '2024-06-07 11:56:12', '2024-06-07 11:56:12'),
(17, 5, 5, '2024-06-07', '2024-06-14', 'dfd level 0.docx', 'ya allah tolong :(', 0, 22, '2024-06-07 11:57:49', '2024-06-07 11:57:49'),
(18, 5, 5, '2024-06-07', '2024-06-12', 'CV JUWITA SAHARANI.pdf', 'bismillah', 0, 22, '2024-06-07 12:03:57', '2024-06-07 17:26:43'),
(19, 5, 5, '2024-05-31', '2024-06-07', 'CV JUWITA.pdf', 'puspa', 0, 22, '2024-06-07 12:07:45', '2024-06-07 17:27:33'),
(20, 5, 5, '2024-05-31', '2024-06-07', 'CV JUWITA.pdf', 'bismillah', 0, 22, '2024-06-07 12:15:39', '2024-06-07 12:15:39'),
(21, 5, 5, '2024-05-31', '2024-06-07', 'CV JUWITA.pdf', 'yyyy', 0, 22, '2024-06-07 12:16:29', '2024-06-07 12:16:29'),
(23, 5, 5, '2024-06-14', '2024-06-21', 'CV JUWITA.pdf', 'pliss', 0, 22, '2024-06-07 12:34:34', '2024-06-07 12:34:34'),
(24, 5, 5, '2024-06-12', '2024-06-07', 'CV JUWITA.pdf', 'nnti', 0, 22, '2024-06-07 12:35:30', '2024-06-08 19:24:39'),
(25, 5, 5, '2024-06-27', '2024-06-28', 'Dfd.docx', 'hari ini', 0, 22, '2024-06-07 12:44:12', '2024-06-07 17:29:51'),
(28, 8, 3, '2024-06-11', '2024-06-12', 'SURAT LAMARAN KERJA.docx', 'oke ges', 0, 1, '2024-06-08 14:06:44', '2024-06-08 14:06:44'),
(29, 8, 3, '2024-06-09', '2024-06-10', 'CV JUWITA.pdf', '66666', 0, 1, '2024-06-08 17:34:25', '2024-06-08 17:34:25'),
(30, 5, 5, '2024-06-09', '2024-06-10', 'PENGELUARAN IMPS SEHAT & RUJAK PARTY.docx', 'ya allah makasii', 0, 22, '2024-06-09 04:05:17', '2024-06-09 04:05:17'),
(31, 5, 5, '2024-06-10', '2024-06-11', 'VOUCHER TELKOMSEL.docx', 'kok ?', 0, 22, '2024-06-09 04:06:03', '2024-06-09 04:06:03'),
(32, 8, 8, '2024-06-03', '2024-06-11', 'CV JUWITA.docx', 'ii', 0, 22, '2024-06-09 05:03:22', '2024-06-09 05:03:22'),
(33, 8, 8, '2024-06-13', '2024-06-11', 'CV JUWITA.pdf', 'bhs indo', 0, 22, '2024-06-09 05:18:11', '2024-06-09 05:18:11'),
(34, 5, 5, '2024-05-29', '2024-06-19', 'CV JUWITA.pdf', 'nnn', 0, 22, '2024-06-09 05:35:16', '2024-06-09 05:35:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `assign_class_teacher`
--

CREATE TABLE `assign_class_teacher` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0:active, 1:inactive',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `assign_class_teacher`
--

INSERT INTO `assign_class_teacher` (`id`, `class_id`, `teacher_id`, `status`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 8, 25, 0, 0, 1, '2024-06-01 06:13:47', '2024-06-01 06:13:47'),
(2, 8, 24, 0, 0, 1, '2024-06-01 06:13:47', '2024-06-01 06:13:47'),
(3, 5, 24, 0, 0, 1, '2024-06-01 06:29:19', '2024-06-10 06:28:44'),
(4, 5, 26, 0, 0, 1, '2024-06-01 06:29:19', '2024-06-10 06:28:35'),
(5, 5, 22, 0, 0, 1, '2024-06-01 06:29:19', '2024-06-01 06:29:19'),
(7, 9, 22, 1, 0, 1, '2024-06-03 07:09:09', '2024-06-03 07:46:50'),
(8, 8, 22, 1, 0, 1, '2024-06-09 04:44:12', '2024-06-09 05:19:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:active , 1:inactive',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:not , 1:yes',
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `class`
--

INSERT INTO `class` (`id`, `name`, `status`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'X IPA', 0, 0, 1, '2024-05-26 03:33:02', '2024-06-09 10:40:38'),
(2, 'XI IPA', 0, 0, 1, '2024-05-25 11:56:58', '2024-06-09 10:40:30'),
(3, 'XII IPA', 0, 0, 1, '2024-05-25 11:56:19', '2024-06-09 10:40:20'),
(4, 'X IPS', 0, 0, 1, '2024-05-26 03:34:26', '2024-06-09 10:40:59'),
(5, 'XI IPS', 0, 0, 1, '2024-05-26 03:35:14', '2024-06-09 10:41:12'),
(6, 'XII IPS', 0, 0, 1, '2024-05-26 03:35:46', '2024-06-09 10:41:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `class_subject`
--

CREATE TABLE `class_subject` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `class_subject`
--

INSERT INTO `class_subject` (`id`, `class_id`, `subject_id`, `created_by`, `is_delete`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 0, 0, '2024-06-09 10:45:20', '2024-06-09 10:45:20'),
(2, 1, 4, 1, 0, 0, '2024-06-09 10:45:20', '2024-06-09 10:45:20'),
(3, 2, 5, 1, 0, 0, '2024-06-09 10:45:34', '2024-06-09 10:45:34'),
(4, 2, 6, 1, 0, 0, '2024-06-09 10:45:34', '2024-06-09 10:45:34'),
(5, 3, 7, 1, 0, 0, '2024-06-09 10:45:50', '2024-06-09 10:45:50'),
(6, 4, 5, 1, 0, 0, '2024-06-09 10:46:02', '2024-06-09 10:46:02'),
(7, 5, 7, 1, 0, 0, '2024-06-09 10:46:14', '2024-06-09 10:46:14'),
(8, 6, 3, 1, 0, 0, '2024-06-09 10:46:25', '2024-06-09 10:46:25'),
(36, 5, 4, 1, 0, 0, '2024-06-09 10:50:53', '2024-06-09 10:50:53'),
(37, 3, 2, 1, 0, 0, '2024-06-09 10:51:16', '2024-06-09 10:51:16'),
(38, 1, 1, 1, 0, 0, '2024-06-10 04:19:19', '2024-06-10 04:19:19'),
(39, 5, 5, 1, 0, 0, '2024-06-10 06:28:18', '2024-06-10 06:28:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `note` varchar(2000) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `exam`
--

INSERT INTO `exam` (`id`, `name`, `note`, `created_by`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Ujian Tengah Semester', 'Tahun Ajaran 2023/2024', 1, 0, '2024-06-05 10:44:16', '2024-06-05 12:00:53'),
(2, 'Ujian Akhir Semester', 'Tahun Ajaran 2023/2024', 1, 0, '2024-06-05 12:01:21', '2024-06-05 12:01:36'),
(7, 'UJian Tengah Semester', 'Tahun 2024/2025', 1, 1, '2024-06-10 14:40:07', '2024-06-10 14:40:07'),
(8, 'UJian Akhir Semester', 'Tahun 2024/2025', 1, 1, '2024-06-10 14:40:33', '2024-06-10 14:40:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `exam_schedule`
--

CREATE TABLE `exam_schedule` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `start_time` varchar(25) DEFAULT NULL,
  `end_time` varchar(25) DEFAULT NULL,
  `room_number` varchar(25) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_up` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `exam_schedule`
--

INSERT INTO `exam_schedule` (`id`, `exam_id`, `class_id`, `subject_id`, `exam_date`, `start_time`, `end_time`, `room_number`, `created_at`, `created_up`, `updated_at`) VALUES
(1, 2, 2, 5, '2024-07-03', '00:08', '00:09', '1', '2024-06-07 12:12:30', NULL, '2024-06-07 12:12:30'),
(2, 1, 5, 5, '2024-06-11', '09:00', '09:45', '2', '2024-06-07 12:13:56', NULL, '2024-06-07 12:18:13'),
(3, 1, 5, 4, '2024-06-27', '10:40', '11:15', '3', '2024-06-07 12:18:55', NULL, '2024-06-07 12:18:55'),
(14, 2, 5, 5, '2024-06-21', '08:00', '09:00', '1', '2024-06-07 14:48:52', NULL, '2024-06-07 14:48:52'),
(15, 2, 5, 4, '2024-06-21', '08:00', '09:00', '2', '2024-06-07 14:48:52', NULL, '2024-06-07 14:48:52'),
(16, 2, 6, 4, '2024-06-14', '09:00', '10:00', '6', '2024-06-07 14:49:23', NULL, '2024-06-07 14:49:23'),
(27, 1, 4, 5, '2024-05-08', '08:00', '09:00', 'XI IPS', '2024-06-08 01:35:00', NULL, '2024-06-08 01:35:00'),
(28, 1, 4, 4, '2024-05-08', '09:10', '10:20', 'XI IPS', '2024-06-08 01:35:00', NULL, '2024-06-08 01:35:00'),
(29, 1, 4, 3, '2024-05-08', '10:40', '11:40', 'XI IPS', '2024-06-08 01:35:00', NULL, '2024-06-08 01:35:00'),
(30, 1, 4, 2, '2024-05-09', '08:00', '09:00', 'XI IPS', '2024-06-08 01:35:00', NULL, '2024-06-08 01:35:00'),
(31, 1, 4, 1, '2024-05-09', '09:10', '10:10', 'XI IPS', '2024-06-08 01:35:00', NULL, '2024-06-08 01:35:00'),
(32, 2, 4, 5, '2024-06-03', '09:00', '10:00', 'XI IPS', '2024-06-08 01:35:33', NULL, '2024-06-08 01:35:33'),
(33, 2, 4, 4, '2024-06-03', '10:00', '11:00', 'XI IPS', '2024-06-08 01:35:33', NULL, '2024-06-08 01:35:33'),
(34, 2, 4, 3, '2024-06-04', '08:00', '09:00', 'XI IPS', '2024-06-08 01:35:33', NULL, '2024-06-08 01:35:33'),
(35, 2, 4, 2, '2024-06-04', '09:00', '10:00', 'XI IPS', '2024-06-08 01:35:33', NULL, '2024-06-08 01:35:33'),
(36, 2, 4, 1, '2024-06-04', '09:00', '10:00', 'XI IPS', '2024-06-08 01:35:33', NULL, '2024-06-08 01:35:33'),
(37, 2, 1, 1, '2024-06-10', '21:42', '23:41', '1', '2024-06-10 14:41:26', NULL, '2024-06-10 14:41:26'),
(38, 2, 1, 4, '2024-06-10', '09:00', '10:00', '3', '2024-06-10 14:41:26', NULL, '2024-06-10 14:41:26'),
(39, 2, 1, 3, '2024-06-11', '09:00', '10:00', '2', '2024-06-10 14:41:26', NULL, '2024-06-10 14:41:26'),
(40, 2, 3, 2, '2024-06-11', '12:41', '13:44', '3', '2024-06-10 14:42:07', NULL, '2024-06-10 14:42:07'),
(41, 1, 3, 2, '2024-06-10', '12:42', '12:42', '1', '2024-06-10 14:42:30', NULL, '2024-06-10 14:42:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `homework_date` date DEFAULT NULL,
  `submission_date` date DEFAULT NULL,
  `document_file` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `homework`
--

INSERT INTO `homework` (`id`, `class_id`, `subject_id`, `homework_date`, `submission_date`, `document_file`, `description`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(4, 1, 4, '2024-06-09', '2024-06-10', 'CV JUWITA.pdf', 'bismillahhh', 0, 1, '2024-06-09 10:53:17', '2024-06-09 15:13:05'),
(5, 1, 4, '2024-06-07', '2024-06-10', NULL, 'bismillah', 1, 1, '2024-06-09 14:58:51', '2024-06-09 17:09:16'),
(6, 1, 4, '2024-06-07', '2024-06-11', NULL, 'bismillah', 1, 1, '2024-06-09 15:04:07', '2024-06-09 17:09:21'),
(7, 1, 4, '2024-06-09', '2024-06-10', NULL, 'bismillahhh', 1, 1, '2024-06-09 15:05:20', '2024-06-09 17:09:26'),
(8, 3, 2, '2024-06-10', '2024-06-11', 'RPL_JuwitaSaharani_A1.pdf', 'uuuu', 0, 1, '2024-06-09 17:17:04', '2024-06-09 17:17:19'),
(9, 5, 4, '2024-06-10', '2024-06-10', 'CV JUWITA SAHARANI.pdf', 'hlo', 0, 22, '2024-06-09 19:21:10', '2024-06-09 19:36:48'),
(10, 5, 4, '2024-06-11', '2024-06-12', 'dfd level 0.docx', 'uuuuuii', 0, 22, '2024-06-10 03:10:00', '2024-06-10 06:14:40'),
(11, 5, 5, '2024-06-10', '2024-06-11', 'CV JUWITA.docx', 'pp', 0, 1, '2024-06-10 08:12:41', '2024-06-10 08:12:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `homework_submit`
--

CREATE TABLE `homework_submit` (
  `id` int(11) NOT NULL,
  `homework_id` int(255) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `document_file` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `homework_submit`
--

INSERT INTO `homework_submit` (`id`, `homework_id`, `student_id`, `description`, `document_file`, `created_at`, `updated_at`) VALUES
(1, 4, 20, 'ini ya buu', 'Dfd.docx', '2024-06-10 05:51:40', '2024-06-10 05:51:40'),
(2, 4, 19, 'ini ya buu', 'Dfd.docx', '2024-06-10 05:52:04', '2024-06-10 05:52:04'),
(3, 4, 19, 'ini ya ibu', 'Dfd.docx', '2024-06-10 05:53:24', '2024-06-10 05:53:24'),
(4, 10, 33, 'uda', 'CV JUWITA.pdf', '2024-06-10 06:22:17', '2024-06-10 06:22:17'),
(5, 11, 27, 'udh buu', 'dfd level 0.docx', '2024-06-10 09:15:20', '2024-06-10 09:15:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_15_065732_add_nis_nip_and_role_to_users_table', 1),
(6, '2024_06_10_152132_create_assign_class_teacher_table', 0),
(7, '2024_06_10_152132_create_assignments_table', 0),
(8, '2024_06_10_152132_create_class_table', 0),
(9, '2024_06_10_152132_create_class_subject_table', 0),
(10, '2024_06_10_152132_create_exam_table', 0),
(11, '2024_06_10_152132_create_exam_schedule_table', 0),
(12, '2024_06_10_152132_create_failed_jobs_table', 0),
(13, '2024_06_10_152132_create_homework_table', 0),
(14, '2024_06_10_152132_create_homework_submit_table', 0),
(15, '2024_06_10_152132_create_password_resets_table', 0),
(16, '2024_06_10_152132_create_personal_access_tokens_table', 0),
(17, '2024_06_10_152132_create_subject_table', 0),
(18, '2024_06_10_152132_create_users_table', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:active, 1:inactive',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:not, 1:yes',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `subject`
--

INSERT INTO `subject` (`id`, `name`, `type`, `created_by`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Bahasa Indonesia', 'Teori', 1, 0, 0, '2024-05-25 10:59:35', '2024-05-25 10:59:35'),
(2, 'Bahasa Inggris', 'Teori', 1, 0, 0, '2024-05-25 12:39:45', '2024-05-25 12:39:45'),
(3, 'Matematika', 'Teori', 1, 0, 0, '2024-05-25 12:39:56', '2024-05-25 12:39:56'),
(4, 'Kewarganegaraan', 'Teori', 1, 0, 0, '2024-05-25 12:40:06', '2024-05-25 12:40:06'),
(5, 'Agama', 'Teori', 1, 0, 0, '2024-05-25 12:40:22', '2024-05-25 12:40:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1:admin, 2:teacher, 3:student',
  `admission_number` varchar(255) DEFAULT NULL,
  `roll_number` varchar(255) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `marital_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:single, 1:married',
  `address` text DEFAULT NULL,
  `profile_pic` varchar(100) DEFAULT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:not deleted, 1:deleted',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:active, 1:inactive',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `email_verified_at`, `password`, `user_type`, `admission_number`, `roll_number`, `class_id`, `gender`, `date_of_birth`, `religion`, `mobile_number`, `admission_date`, `marital_status`, `address`, `profile_pic`, `is_delete`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'nn', 'admin@gmail.com', NULL, '$2y$10$samBIfBnCEtIu8qkInjP8OUFqb9Ou0WB.CrSjsMpDho8GEf5iJuR.', 1, NULL, NULL, NULL, 'Laki-Laki', '2024-05-29', NULL, '082172812609', NULL, 0, 'Blang Maneh', NULL, 0, 0, 'xF6IXOhZaUm2HYl54y9nlZtx1LRqk6PoIp92KTtSgUXzva6utc6hEC57I2im', '2024-05-18 02:55:27', '2024-05-28 23:11:12'),
(8, 'juwita', NULL, 'juwita@gmail.com', NULL, '$2y$10$uMW20tXP1PEL4FUpWcjMD.awJ5iPl.ufYLMJ5hUImDID3ZY2vsv/m', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', NULL, 0, 0, NULL, '2024-05-19 02:00:13', '2024-05-19 02:00:13'),
(19, 'juwitaaa', 'Saharani', 'juwitasaharani@gmail.com', NULL, '$2y$10$dhDAkkQkYiMsCy.A81fX8elHODqfRtIXZDRVlH9w0CjxKkyL/nAI2', 3, '02', '04', 1, 'Perempuan', '2005-04-29', 'Islam', '082172812661', '2024-05-26', 0, 'Blang Maneh', '1716961962.jpg', 0, 0, NULL, '2024-05-26 08:03:41', '2024-06-07 11:04:12'),
(20, 'juwita', 'Saharani', 'aabb@gmail.com', NULL, '$2y$10$08z7jub2cEja2pk6FVJVMelbJaDsOzv3GR6RHmRMVms9SCZSrP6km', 3, '02', '04', 2, 'Laki-Laki', '2024-05-22', 'Islam', '082172812663', '2024-05-26', 0, '', '1716739789.jpg', 0, 0, NULL, '2024-05-26 09:09:49', '2024-05-26 09:09:49'),
(22, 'Nur', 'Azila', 'nurazila@gmail.com', NULL, '$2y$10$wK9SeZBJqE5zPq/R08GiTukeRl3BZyT8zFkB3B0iZecWg5CzCIFo2', 2, NULL, NULL, NULL, 'Perempuan', '2024-05-01', '', '08867553235', '2024-05-27', 0, 'Blang Maneh', '1716814623.jpg', 0, 0, 'slnxK9PSLTvqiKIX8N4J1S6v2sNDwm7QjXLwvcPCM6MbAr9hflBJ1gVDr0wP', '2024-05-27 05:57:03', '2024-06-10 07:35:52'),
(24, 'Juwita', 'Saharani', 'juju@gmail.com', NULL, '$2y$10$Q1Unjc5Suz3HSsolOpL9cubCi/bBO4uzI.TZMy.FMi49Rd0G1NvIS', 2, NULL, NULL, NULL, 'Perempuan', '2024-01-30', NULL, '082172812657', '2024-06-01', 0, 'aceh', '1717220383.png', 0, 0, NULL, '2024-05-31 22:39:43', '2024-05-31 22:39:43'),
(25, 'Dimas', 'saputra', 'dimas@gmail.com', NULL, '$2y$10$r6qG/RsJqD7WmYPUf8tPgu/lpLzNArg1HKBPiOu7g/FOAJTzTcizG', 2, NULL, NULL, NULL, 'Laki-Laki', '2024-05-26', '', '082165457890', '2024-06-01', 0, 'Lhok', '1717220477.jpg', 0, 0, NULL, '2024-05-31 22:41:17', '2024-06-10 07:35:24'),
(26, 'Teacher', 'azila', 'azilatarigannnnn@gmail.com', NULL, '$2y$10$6mMC8l.pgO/lYEWwW05.DOHHgspavlfIfGTbUEJjQrSWDJkX6M8me', 2, NULL, NULL, NULL, 'Perempuan', '2024-05-26', '', '082172812689', '2024-06-02', 0, 'Blang Maneh', '1717328385.jpg', 0, 0, NULL, '2024-06-02 04:39:45', '2024-06-09 23:30:03'),
(27, 'jujuuuu', 'uuu', 'jujuuuu@gmail.com', NULL, '$2y$10$Fcga8nWt1i7nXMaJR/KoFupwnGAu6cLL8w8aSUVCEd4vJx7IBL/le', 3, '03', '03', 5, 'Perempuan', '2024-05-26', 'Islam', '0821728126097', '2024-06-03', 0, NULL, '1717399998.png', 0, 0, NULL, '2024-06-03 00:33:18', '2024-06-10 07:33:50'),
(28, 'Nur Azila', 'Tarigan', 'azilaaaatarigan@gmail.com', NULL, '$2y$10$s4cbk6BvhZ44fan7hq.k7.MXjXcnhclhgifeVwSnEwpMdr9HEmJm.', 3, '11', '12', 5, 'Perempuan', '2024-05-26', 'Islam', '08217900989', '2024-06-03', 0, NULL, '1718029973.jpg', 0, 0, NULL, '2024-06-03 00:40:11', '2024-06-10 07:32:53'),
(32, 'azila', NULL, 'tarigan@gmail.com', NULL, '$2y$10$6/5rQT7mc86vJNiToNz1kedFCA3CTmzkcIbNJevUOeVqDHt4iDkQm', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, '2024-06-04 01:29:48', '2024-06-04 01:29:48'),
(33, 'Juwitaaaa', 'saharani', 'juwitasaharaniiiii@gmail.com', NULL, '$2y$10$AOmJb5tdQODItt46fu0Kfug6GEWBFIHl5u27/4uUy0Sm6peTChSE.', 3, '08', '3', 5, 'Perempuan', '2024-05-26', 'Islam', '087755256787', '2024-06-04', 0, NULL, '1717496621.jpg', 0, 0, NULL, '2024-06-04 03:23:41', '2024-06-10 07:32:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `assign_class_teacher`
--
ALTER TABLE `assign_class_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `class_subject`
--
ALTER TABLE `class_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `homework_submit`
--
ALTER TABLE `homework_submit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `assign_class_teacher`
--
ALTER TABLE `assign_class_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `class_subject`
--
ALTER TABLE `class_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `exam_schedule`
--
ALTER TABLE `exam_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `homework_submit`
--
ALTER TABLE `homework_submit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
