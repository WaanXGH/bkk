-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 02:48 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bkk_pjbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `lokers`
--

CREATE TABLE `lokers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `detail_s` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `max_pelamar` int(11) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gaji_terendah` bigint(230) DEFAULT NULL,
  `gaji_tertinggi` bigint(230) DEFAULT NULL,
  `jobdesk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokers`
--

INSERT INTO `lokers` (`id`, `gambar`, `judul`, `detail_s`, `detail`, `max_pelamar`, `tanggal_mulai`, `tanggal_selesai`, `created_at`, `updated_at`, `gaji_terendah`, `gaji_tertinggi`, `jobdesk`) VALUES
(4, 'MrVpxYCGGVgZiWUdE5yACesII4TZ3a-metaV2hhdHNBcHAgSW1hZ2UgMjAyNS0wMi0wNCBhdCAwOS4zMi4xNC5qcGVn-.jpeg', 'testEXample', '<p>dibutuhkan beberapa tenaga kerja sebagai OB</p>', '<p>ajschsdjcachbdchbdsjcbdshcdsbvkjsdbvnsdbvjdsbvndsbvndsbvndsbvndsvbdsnvbdsv</p>', 20, '2025-02-07', '2025-02-09', '2025-02-06 20:21:34', '2025-02-06 20:21:34', 0, 0, ''),
(38, 'images/lokers/ywUmbKjWHgMV0DeQh9npycEwbhZaQcpzkLlLxUEW.png', 'PT Shinto Kogyo Tbk', '<p>dibutukan untuk bagian Operator</p>', '<ol><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>tinnggi badan harus 160cm</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>bersedia bekerja lembur</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>maksimal usia 25 thn</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>minimal pengalaman 1 tahun</li></ol>', 1, '2025-04-11', '2025-04-30', '2025-04-10 23:35:57', '2025-04-12 02:53:37', 5000000, 9000000, 'Operator'),
(39, 'loker-photos/2025-04-12_11-43-53image-removebg-preview (1).png', 'PT BRIDGESTONE TIRE INDONESIA TBK', '<p>Mengoperasikan komputer dengan baik untuk mendukung tugas harian.</p>', '<ol><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Maksimal Umur 25 tahun</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Lulusan Smk semua jurusan</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>dapat mengoperasikan Microsoft</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Sehat Jasmani dan Rohani</li></ol>', 5, '2025-04-12', '2025-04-30', '2025-04-12 04:43:53', '2025-04-12 04:43:53', 4000000, 5000000, 'IT Support');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(13, '2024_11_26_012715_create_lokers_table', 1),
(29, '2014_10_12_000000_create_users_table', 3),
(34, '2025_01_20_021625_create_relasis_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `queue_applicant`
--

CREATE TABLE `queue_applicant` (
  `id_pelamar` bigint(20) UNSIGNED NOT NULL,
  `id_lowongan` bigint(20) UNSIGNED NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `NIK` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `file_cv` varchar(255) DEFAULT NULL,
  `surat_lamaran` text DEFAULT NULL,
  `status` enum('menunggu','diproses','diterima','ditolak') NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `queue_applicant`
--

INSERT INTO `queue_applicant` (`id_pelamar`, `id_lowongan`, `id`, `nama_lengkap`, `email`, `NIK`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `no_hp`, `file_cv`, `surat_lamaran`, `status`, `created_at`, `updated_at`) VALUES
(13, 38, 1, 'user', 'usert@gmail.com', '4234234234', 'jakarta', '2025-04-12', 'sccscsc', NULL, '8779322342', 'aplicant-cv/2025-04-12_07-57-34_KAI.jpg', NULL, 'diterima', '2025-04-12 00:57:34', '2025-04-12 09:24:06'),
(13, 38, 2, 'user', 'usert@gmail.com', '12312313123', 'jakarta', '2025-04-12', 'sadasdadad', NULL, '12312321313', 'aplicant-cv/2025-04-12_09-39-23_Najwan raihan Azhari (3)_page-0001.jpg', NULL, 'ditolak', '2025-04-12 02:39:23', '2025-04-12 09:23:37'),
(11, 39, 3, 'Najwan raihan Azhari', 'najwan@test', '1122334454', 'Update', '2025-04-01', 'Update alamat 3', NULL, '5544332213', 'aplicant-cv/2025-04-13_10-10-03_CV (2).jpg', NULL, 'menunggu', '2025-04-13 03:10:03', '2025-04-13 05:42:49');

-- --------------------------------------------------------

--
-- Table structure for table `relasi`
--

CREATE TABLE `relasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_p` varchar(255) NOT NULL,
  `image_p` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `relasi`
--

INSERT INTO `relasi` (`id`, `nama_p`, `image_p`, `created_at`, `updated_at`, `remember_token`, `deleted_at`) VALUES
(7, 'PT. Mayora Indah.Tbk', 'relasi-photos/2025-04-10_03-06-59image-removebg-preview (2).png', '2025-04-09 20:06:59', '2025-04-09 20:06:59', NULL, NULL),
(8, 'PT. Bridgestone Tire Indonesia .Tbk', 'relasi-photos/2025-04-10_03-08-57image-removebg-preview (1).png', '2025-04-09 20:08:57', '2025-04-09 20:08:57', NULL, NULL),
(9, 'PT Shinto Kogyo Indonesia', 'relasi-photos/2025-04-10_03-09-41shinto.png', '2025-04-09 20:09:41', '2025-04-10 19:25:56', NULL, NULL),
(10, 'PT Astra Honda Motor', 'relasi-photos/2025-04-10_03-10-43AHM.jpg', '2025-04-09 20:10:43', '2025-04-09 20:10:43', NULL, NULL),
(11, 'PT ASTRA INTERNATIONAL.TBK', 'relasi-photos/2025-04-12_02-21-24Astra.png', '2025-04-11 19:21:24', '2025-04-11 19:21:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Operator','User') NOT NULL DEFAULT 'User',
  `tinggi_badan` varchar(255) DEFAULT NULL,
  `NIK` varchar(255) DEFAULT NULL,
  `nomor_telepon` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `gambar`, `nama`, `email`, `password`, `role`, `tinggi_badan`, `NIK`, `nomor_telepon`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'bimbim setia satria', 'test@traspac.id', '$2y$12$BPdxuLvY2ceU9UPN.htXDOw.20XY5BrfNadfwKEJqQASIsrUdIBFG', 'User', NULL, NULL, NULL, NULL, '2025-02-09 18:39:41', '2025-02-09 18:39:41', NULL),
(2, NULL, 'bimbim setia satria', 'dev123@yahoo.com', '$2y$12$j7iNsBGSblNNogVLFz7iuOVoT2IlKMC6LhcZldejH2tr2/Mo3aEla', 'User', NULL, NULL, NULL, NULL, '2025-02-09 18:43:31', '2025-03-13 11:50:09', '2025-03-13 11:50:09'),
(6, NULL, 'success', 'testalert431@gmail.com', '$2y$12$OBTfh6jM7BRkCObSdDHLXON/RLnzgPxeKMgul.QfQWbw7qCjE6qwK', 'User', NULL, NULL, NULL, NULL, '2025-02-14 02:21:12', '2025-02-14 02:21:12', NULL),
(7, NULL, 'user new test', 'usernew@gmail.com', '$2y$12$wgbvQ2vVyXh/rvfH1TlzouskYyi82WUvg.uQ6PmZl172NcUYRxtF6', 'User', NULL, NULL, NULL, NULL, '2025-02-17 17:02:14', '2025-02-17 17:02:14', NULL),
(8, NULL, 'Fitroh Novianto Widiatmoko', 'fitrohnoviantowidi@gmail.com', '$2y$12$s1GJLXgHJoV4T4xutOulcuxjZPdAhXvwZdNcEALl8scOb28h/AZ/2', 'User', NULL, NULL, NULL, NULL, '2025-02-17 17:47:55', '2025-02-17 17:47:55', NULL),
(9, NULL, 'balqis', 'balqis@gmail.com', '$2y$12$KghKZWvuDZa2bPN9EU0Nou/X8Kv2MPJ3L7GsNyiPJtNt/Mq17cnjK', 'User', NULL, NULL, NULL, NULL, '2025-02-24 17:17:28', '2025-02-24 17:17:28', NULL),
(10, NULL, 'admin', 'adminbaru@example.id', '$2y$12$9ubtvPibfCY5BpGbO/Vrw.iLYfzQj4ZOk0HtDM5rtSnajLCBo/4Ge', 'Admin', NULL, NULL, NULL, NULL, '2025-04-07 21:03:38', '2025-04-07 21:03:38', NULL),
(11, NULL, 'najwan', 'najwan@test', '$2y$12$SNrIBCLeXje3GkXduitZm.RL9COD7OoEMkPNoq6wF/5jHKjTnSbpm', 'User', NULL, '132123123131', NULL, NULL, '2025-04-09 09:08:34', '2025-04-13 03:10:03', NULL),
(12, NULL, 'user', 'usertest@gmail.com', '$2y$12$AJaTuiF4s.N8xwzjeKf/auK.zVGd32CZBHDVi/Bb1GzTZh33y1Dcy', 'User', NULL, NULL, NULL, NULL, '2025-04-11 23:46:54', '2025-04-11 23:46:54', NULL),
(13, NULL, 'user', 'usert@gmail.com', '$2y$12$jjjX6SuwonNmaTFQXOtC.eibF.sqcnEGn/zuGemXi/v06MU9xfZcu', 'User', NULL, NULL, NULL, NULL, '2025-04-11 23:47:45', '2025-04-11 23:47:45', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lokers`
--
ALTER TABLE `lokers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queue_applicant`
--
ALTER TABLE `queue_applicant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `queue_applicant_id_pelamar_foreign` (`id_pelamar`);

--
-- Indexes for table `relasi`
--
ALTER TABLE `relasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lokers`
--
ALTER TABLE `lokers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `queue_applicant`
--
ALTER TABLE `queue_applicant`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `relasi`
--
ALTER TABLE `relasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `queue_applicant`
--
ALTER TABLE `queue_applicant`
  ADD CONSTRAINT `queue_applicant_id_pelamar_foreign` FOREIGN KEY (`id_pelamar`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
