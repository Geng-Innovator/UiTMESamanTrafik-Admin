-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2018 at 06:01 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uitm_e_saman_trafik`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `pekerja_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `pekerja_id`, `created_at`, `updated_at`) VALUES
(1, '1', '2018-04-17 20:00:02', '2018-04-17 20:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `kenderaan`
--

CREATE TABLE `kenderaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_kenderaan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kenderaan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_kenderaan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kesalahan`
--

CREATE TABLE `kesalahan` (
  `id` int(10) UNSIGNED NOT NULL,
  `laporan_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kesalahan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(10) UNSIGNED NOT NULL,
  `staf_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `polis_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pelajar_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_laporan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imej_staf` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imej_polis` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laporan_staf` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laporan_polis` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_siri_pelekat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kenderaan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lookup_fakulti`
--

CREATE TABLE `lookup_fakulti` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lookup_fakulti`
--

INSERT INTO `lookup_fakulti` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'FSKM', '2018-04-17 19:59:56', '2018-04-17 19:59:56'),
(2, 'FKM', '2018-04-17 19:59:56', '2018-04-17 19:59:56'),
(3, 'FSG', '2018-04-17 19:59:56', '2018-04-17 19:59:56'),
(4, 'FSPU', '2018-04-17 19:59:56', '2018-04-17 19:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `lookup_jabatan`
--

CREATE TABLE `lookup_jabatan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lookup_jabatan`
--

INSERT INTO `lookup_jabatan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'JABATAN 1', '2018-04-17 19:59:56', '2018-04-17 19:59:56'),
(2, 'JABATAN 2', '2018-04-17 19:59:56', '2018-04-17 19:59:56'),
(3, 'JABATAN 3', '2018-04-17 19:59:56', '2018-04-17 19:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `lookup_jawatan`
--

CREATE TABLE `lookup_jawatan` (
  `id` int(10) UNSIGNED NOT NULL,
  `gred` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lookup_jawatan`
--

INSERT INTO `lookup_jawatan` (`id`, `gred`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'GRED 1', 'JAWATAN 1', '2018-04-17 19:59:56', '2018-04-17 19:59:56'),
(2, 'GRED 2', 'JAWATAN 2', '2018-04-17 19:59:56', '2018-04-17 19:59:56'),
(3, 'GRED 3', 'JAWATAN 3', '2018-04-17 19:59:57', '2018-04-17 19:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `lookup_jenis_kenderaan`
--

CREATE TABLE `lookup_jenis_kenderaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lookup_jenis_kenderaan`
--

INSERT INTO `lookup_jenis_kenderaan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'MOTORSIKAL', '2018-04-17 19:59:57', '2018-04-17 19:59:57'),
(2, 'KERETA', '2018-04-17 19:59:57', '2018-04-17 19:59:57'),
(3, 'BAS', '2018-04-17 19:59:57', '2018-04-17 19:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `lookup_jenis_kesalahan`
--

CREATE TABLE `lookup_jenis_kesalahan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lookup_jenis_kesalahan`
--

INSERT INTO `lookup_jenis_kesalahan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'MELETAK DI TEMPAT LARANGAN/DIKHASKAN', '2018-04-17 19:59:57', '2018-04-17 19:59:57'),
(2, 'MELETAK DILUAR PETAK/PETAK KUNING', '2018-04-17 19:59:57', '2018-04-17 19:59:57'),
(3, 'MENGHALANG LALUAN', '2018-04-17 19:59:57', '2018-04-17 19:59:57'),
(4, 'TIADA LESEN MEMANDU/TAMAT TEMPOH', '2018-04-17 19:59:57', '2018-04-17 19:59:57'),
(5, 'LESEN (L) MEMBAWA PEMBONCENG', '2018-04-17 19:59:57', '2018-04-17 19:59:57'),
(6, 'TIADA CUKAI JALAN YANG SAH/TAMAT TEMPOH', '2018-04-17 19:59:58', '2018-04-17 19:59:58'),
(7, 'MELANGAR JALAN SEHALA/DILARANG MASUK', '2018-04-17 19:59:58', '2018-04-17 19:59:58'),
(8, 'TIDAK MEMAKAI TOPI KELEDAR PENUNGGANG/PEMBONCENG', '2018-04-17 19:59:58', '2018-04-17 19:59:58'),
(9, 'TIADA PELEKAT UITM TERKINI', '2018-04-17 19:59:58', '2018-04-17 19:59:58'),
(10, 'MELETAK DI KORIDOR/LALUAN PEJALAN KAKI', '2018-04-17 19:59:58', '2018-04-17 19:59:58'),
(11, 'KENDERAAN DIKUNCI', '2018-04-17 19:59:59', '2018-04-17 19:59:59'),
(12, 'LAIN-LAIN (NYATAKAN DI BAHAGIAN PENERANGAN)', '2018-04-17 19:59:59', '2018-04-17 19:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `lookup_jenis_pekerja`
--

CREATE TABLE `lookup_jenis_pekerja` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lookup_jenis_pekerja`
--

INSERT INTO `lookup_jenis_pekerja` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', '2018-04-17 19:59:59', '2018-04-17 19:59:59'),
(2, 'STAF', '2018-04-17 19:59:59', '2018-04-17 19:59:59'),
(3, 'POLIS', '2018-04-17 19:59:59', '2018-04-17 19:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `lookup_kolej`
--

CREATE TABLE `lookup_kolej` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lookup_kolej`
--

INSERT INTO `lookup_kolej` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'DELIMA', '2018-04-17 19:59:59', '2018-04-17 19:59:59'),
(2, 'PERINDU', '2018-04-17 19:59:59', '2018-04-17 19:59:59'),
(3, 'MAWAR', '2018-04-17 19:59:59', '2018-04-17 19:59:59'),
(4, 'KENANGA', '2018-04-17 20:00:00', '2018-04-17 20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `lookup_kursus`
--

CREATE TABLE `lookup_kursus` (
  `id` int(10) UNSIGNED NOT NULL,
  `kod` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lookup_kursus`
--

INSERT INTO `lookup_kursus` (`id`, `kod`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'CS230', 'IJAZAH SARJANA MUDA SAINS KOMPUTER DAN MATEMATIK', '2018-04-17 20:00:00', '2018-04-17 20:00:00'),
(2, 'CS253', 'IJAZAH SARJANA MUDA SAINS KOMPUTER DAN MATEMATIK (MULTIMEDIA)', '2018-04-17 20:00:00', '2018-04-17 20:00:00'),
(3, 'CS249', 'IJAZAH SARJANA MUDA SAIN MATEMATIK', '2018-04-17 20:00:00', '2018-04-17 20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `lookup_pos`
--

CREATE TABLE `lookup_pos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lookup_pos`
--

INSERT INTO `lookup_pos` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'PINTU UTAMA', '2018-04-17 20:00:00', '2018-04-17 20:00:00'),
(2, 'PINTU BELAKANG', '2018-04-17 20:00:00', '2018-04-17 20:00:00'),
(3, 'PINTU SEKSYEN 2', '2018-04-17 20:00:00', '2018-04-17 20:00:00'),
(4, 'PINTU SEKSYEN 7', '2018-04-17 20:00:01', '2018-04-17 20:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `lookup_status_kenderaan`
--

CREATE TABLE `lookup_status_kenderaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lookup_status_kenderaan`
--

INSERT INTO `lookup_status_kenderaan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'DISAMAN', '2018-04-17 20:00:01', '2018-04-17 20:00:01'),
(2, 'DIKUNCI', '2018-04-17 20:00:01', '2018-04-17 20:00:01'),
(3, 'TIADA TINDAKAN', '2018-04-17 20:00:01', '2018-04-17 20:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `lookup_status_laporan`
--

CREATE TABLE `lookup_status_laporan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lookup_status_laporan`
--

INSERT INTO `lookup_status_laporan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'DILAPORKAN', '2018-04-17 20:00:01', '2018-04-17 20:00:01'),
(2, 'DIJADUALKAN', '2018-04-17 20:00:02', '2018-04-17 20:00:02'),
(3, 'DIKUATKUASAKAN', '2018-04-17 20:00:02', '2018-04-17 20:00:02'),
(4, 'DITUTUP', '2018-04-17 20:00:02', '2018-04-17 20:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(221, '2014_10_12_000000_create_pekerja_table', 1),
(222, '2014_10_12_100000_create_password_resets_table', 1),
(223, '2018_02_27_021235_create_staf_table', 1),
(224, '2018_02_27_021420_create_admin_table', 1),
(225, '2018_02_27_021438_create_polis_table', 1),
(226, '2018_02_27_021456_create_laporan_table', 1),
(227, '2018_02_27_021514_create_kenderaan_table', 1),
(228, '2018_02_27_021531_create_kesalahan_table', 1),
(229, '2018_02_27_021550_create_pelajar_table', 1),
(230, '2018_02_27_021608_create_lookup_jabatan_table', 1),
(231, '2018_02_27_021626_create_lookup_jawatan_table', 1),
(232, '2018_02_27_021645_create_lookup_jenis_pekerja_table', 1),
(233, '2018_02_27_021702_create_lookup_pos_table', 1),
(234, '2018_02_27_021721_create_lookup_status_laporan_table', 1),
(235, '2018_02_27_021736_create_lookup_status_kenderaan_table', 1),
(236, '2018_02_27_021753_create_lookup_jenis_kenderaan_table', 1),
(237, '2018_02_27_021810_create_lookup_kursus_table', 1),
(238, '2018_02_27_021827_create_lookup_kolej_table', 1),
(239, '2018_02_27_021842_create_lookup_fakulti_table', 1),
(240, '2018_02_27_021900_create_lookup_jenis_kesalahan_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pekerja`
--

CREATE TABLE `pekerja` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_pekerja` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_ic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_tel_hp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_tel_pej` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pekerja` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_pertama` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pekerja`
--

INSERT INTO `pekerja` (`id`, `no_pekerja`, `password`, `nama`, `emel`, `no_ic`, `no_tel_hp`, `no_tel_pej`, `jawatan`, `jenis_pekerja`, `log_pertama`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'K1', '$2y$10$reZuIQLdkWJcHLAK42Jo8ur3.qjj6xlcev4UibfbHWbHfH.Qaurta', 'Admin', 'admin@gmail.com', '1', '1', '1', '1', '1', 1, NULL, '2018-04-17 20:00:02', '2018-04-17 20:00:02'),
(2, 'K2', '$2y$10$36ML71E/D/x4lxxqvwfvieFRzpAaA8xd8UXECoxLH1GvcDtR8FVbe', 'Nadzmi', 'nadzmi@gmail.com', '950811026191', '01110849181', '044911376', '2', '2', 1, NULL, '2018-04-17 20:00:02', '2018-04-17 20:00:02'),
(3, 'K3', '$2y$10$ryfFQRG8rrKM3.S6Awb1ou4BmEfZ8mhktgzs/y4q/ym0QtOdETH1S', 'Syahir', 'syahir@gmail.com', '940221074373', '0183726472', '06377285', '3', '3', 1, NULL, '2018-04-17 20:00:03', '2018-04-17 20:00:03');

-- --------------------------------------------------------

--
-- Table structure for table `pelajar`
--

CREATE TABLE `pelajar` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_pelajar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kursus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakulti` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kolej` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `polis`
--

CREATE TABLE `polis` (
  `id` int(10) UNSIGNED NOT NULL,
  `pekerja_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pos` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `polis`
--

INSERT INTO `polis` (`id`, `pekerja_id`, `pos`, `created_at`, `updated_at`) VALUES
(1, '3', '3', '2018-04-17 20:00:03', '2018-04-17 20:00:03');

-- --------------------------------------------------------

--
-- Table structure for table `staf`
--

CREATE TABLE `staf` (
  `id` int(10) UNSIGNED NOT NULL,
  `pekerja_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staf`
--

INSERT INTO `staf` (`id`, `pekerja_id`, `jabatan`, `created_at`, `updated_at`) VALUES
(1, '2', '2', '2018-04-17 20:00:02', '2018-04-17 20:00:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kenderaan`
--
ALTER TABLE `kenderaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kesalahan`
--
ALTER TABLE `kesalahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookup_fakulti`
--
ALTER TABLE `lookup_fakulti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookup_jabatan`
--
ALTER TABLE `lookup_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookup_jawatan`
--
ALTER TABLE `lookup_jawatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookup_jenis_kenderaan`
--
ALTER TABLE `lookup_jenis_kenderaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookup_jenis_kesalahan`
--
ALTER TABLE `lookup_jenis_kesalahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookup_jenis_pekerja`
--
ALTER TABLE `lookup_jenis_pekerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookup_kolej`
--
ALTER TABLE `lookup_kolej`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookup_kursus`
--
ALTER TABLE `lookup_kursus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookup_pos`
--
ALTER TABLE `lookup_pos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookup_status_kenderaan`
--
ALTER TABLE `lookup_status_kenderaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookup_status_laporan`
--
ALTER TABLE `lookup_status_laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pekerja`
--
ALTER TABLE `pekerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelajar`
--
ALTER TABLE `pelajar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polis`
--
ALTER TABLE `polis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staf`
--
ALTER TABLE `staf`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kenderaan`
--
ALTER TABLE `kenderaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kesalahan`
--
ALTER TABLE `kesalahan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lookup_fakulti`
--
ALTER TABLE `lookup_fakulti`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `lookup_jabatan`
--
ALTER TABLE `lookup_jabatan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lookup_jawatan`
--
ALTER TABLE `lookup_jawatan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lookup_jenis_kenderaan`
--
ALTER TABLE `lookup_jenis_kenderaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lookup_jenis_kesalahan`
--
ALTER TABLE `lookup_jenis_kesalahan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `lookup_jenis_pekerja`
--
ALTER TABLE `lookup_jenis_pekerja`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lookup_kolej`
--
ALTER TABLE `lookup_kolej`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `lookup_kursus`
--
ALTER TABLE `lookup_kursus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lookup_pos`
--
ALTER TABLE `lookup_pos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `lookup_status_kenderaan`
--
ALTER TABLE `lookup_status_kenderaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lookup_status_laporan`
--
ALTER TABLE `lookup_status_laporan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;
--
-- AUTO_INCREMENT for table `pekerja`
--
ALTER TABLE `pekerja`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pelajar`
--
ALTER TABLE `pelajar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `polis`
--
ALTER TABLE `polis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `staf`
--
ALTER TABLE `staf`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
