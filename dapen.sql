-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 15, 2025 at 06:42 AM
-- Server version: 11.7.2-MariaDB-log
-- PHP Version: 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dapen`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `action` varchar(50) NOT NULL,
  `reference_type` varchar(255) DEFAULT NULL,
  `reference_id` varchar(255) DEFAULT NULL,
  `old_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`old_values`)),
  `new_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`new_values`)),
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `reference_type`, `reference_id`, `old_values`, `new_values`, `description`, `created_at`, `updated_at`) VALUES
(99, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputras\"}', '{\"nama\":\"Andi Saputra\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:04:15', '2025-04-21 18:04:15'),
(100, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputras\"}', '{\"nama\":\"Andi Saputra\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:04:15', '2025-04-21 18:04:15'),
(101, '222249', 'updated', 'App\\Models\\Peserta', '199001152023020201', '{\"kabupaten\":\"Bones\"}', '{\"kabupaten\":\"Bone\"}', 'Mengubah data Peserta dengan ID 199001152023020201', '2025-04-21 18:10:27', '2025-04-21 18:10:27'),
(102, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputra\"}', '{\"nama\":\"Andi Saputraa\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:12:05', '2025-04-21 18:12:05'),
(103, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputra\"}', '{\"nama\":\"Andi Saputraa\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:12:05', '2025-04-21 18:12:05'),
(104, '222249', 'updated', 'App\\Models\\Peserta', '198911202010090101', '{\"kabupaten\":\"Bulukumba\"}', '{\"kabupaten\":\"Bulukumbas\"}', 'Mengubah data Peserta dengan ID 198911202010090101', '2025-04-21 18:12:15', '2025-04-21 18:12:15'),
(105, '222249', 'updated', 'App\\Models\\Peserta', '198911202010090101', '{\"kabupaten\":\"Bulukumba\"}', '{\"kabupaten\":\"Bulukumbas\"}', 'Mengubah data Peserta dengan ID 198911202010090101', '2025-04-21 18:12:15', '2025-04-21 18:12:15'),
(106, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputraa\"}', '{\"nama\":\"Andi Saputra\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:20:34', '2025-04-21 18:20:34'),
(107, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputraa\"}', '{\"nama\":\"Andi Saputra\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:20:34', '2025-04-21 18:20:34'),
(108, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputra\"}', '{\"nama\":\"Andi Saputras\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:22:27', '2025-04-21 18:22:27'),
(109, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputra\"}', '{\"nama\":\"Andi Saputras\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:22:27', '2025-04-21 18:22:27'),
(110, '222249', 'updated', 'App\\Models\\Peserta', '199503101987031201', '{\"nama\":\"Dina Marwah\"}', '{\"nama\":\"Dina Marwah Mantap\"}', 'Mengubah data Peserta dengan ID 199503101987031201', '2025-04-21 18:25:34', '2025-04-21 18:25:34'),
(111, '222249', 'updated', 'App\\Models\\Peserta', '199503101987031201', '{\"nama\":\"Dina Marwah\"}', '{\"nama\":\"Dina Marwah Mantap\"}', 'Mengubah data Peserta dengan ID 199503101987031201', '2025-04-21 18:25:34', '2025-04-21 18:25:34'),
(112, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"kode_pos\":\"90111\"}', '{\"kode_pos\":\"901113\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:27:32', '2025-04-21 18:27:32'),
(113, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputras\"}', '{\"nama\":\"Andi Saputra\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:28:29', '2025-04-21 18:28:29'),
(114, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputras\"}', '{\"nama\":\"Andi Saputra\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:28:29', '2025-04-21 18:28:29'),
(115, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"jenis_kelamin\":\"Laki-laki\"}', '{\"jenis_kelamin\":\"Perempuan\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:29:06', '2025-04-21 18:29:06'),
(116, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"jenis_kelamin\":\"Laki-laki\"}', '{\"jenis_kelamin\":\"Perempuan\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:29:06', '2025-04-21 18:29:06'),
(117, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"jenis_kelamin\":\"Perempuan\"}', '{\"jenis_kelamin\":\"Laki-laki\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:29:27', '2025-04-21 18:29:27'),
(118, '222249', 'updated', 'App\\Models\\Peserta', '199001152023020201', '{\"jenis_kelamin\":\"Laki-laki\"}', '{\"jenis_kelamin\":\"Perempuan\"}', 'Mengubah data Peserta dengan ID 199001152023020201', '2025-04-21 18:29:58', '2025-04-21 18:29:58'),
(119, '222249', 'updated', 'App\\Models\\Peserta', '199001152023020201', '{\"jenis_kelamin\":\"Laki-laki\"}', '{\"jenis_kelamin\":\"Perempuan\"}', 'Mengubah data Peserta dengan ID 199001152023020201', '2025-04-21 18:29:58', '2025-04-21 18:29:58'),
(120, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"kabupaten\":\"Gowa\"}', '{\"kabupaten\":\"Gowaaaaaaaa\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:32:32', '2025-04-21 18:32:32'),
(121, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"kabupaten\":\"Gowa\"}', '{\"kabupaten\":\"Gowaaaaaaaa\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:32:32', '2025-04-21 18:32:32'),
(122, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"kabupaten\":\"Gowaaaaaaaa\"}', '{\"kabupaten\":\"Gowa\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:36:02', '2025-04-21 18:36:02'),
(123, '222249', 'updated', 'App\\Models\\Peserta', '198911202010090101', '{\"nama\":\"Fahri Ramadhan\"}', '{\"nama\":\"Fahri Ramadhani\"}', 'Mengubah data Peserta dengan ID 198911202010090101', '2025-04-21 18:36:21', '2025-04-21 18:36:21'),
(124, '222249', 'updated', 'App\\Models\\Peserta', '198911202010090101', '{\"nama\":\"Fahri Ramadhan\"}', '{\"nama\":\"Fahri Ramadhani\"}', 'Mengubah data Peserta dengan ID 198911202010090101', '2025-04-21 18:36:21', '2025-04-21 18:36:21'),
(125, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputra\"}', '{\"nama\":\"Andi Saputraa\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:43:54', '2025-04-21 18:43:54'),
(126, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputraa\"}', '{\"nama\":\"Andi Saputraasssss\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:44:20', '2025-04-21 18:44:20'),
(127, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputraa\"}', '{\"nama\":\"Andi Saputraasssss\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:44:20', '2025-04-21 18:44:20'),
(128, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputraasssss\"}', '{\"nama\":\"Andi Saputra\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:46:15', '2025-04-21 18:46:15'),
(129, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputraasssss\"}', '{\"nama\":\"Andi Saputra\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:46:15', '2025-04-21 18:46:15'),
(130, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"kota\":\"Makassars\"}', '{\"kota\":\"Makassar\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:52:01', '2025-04-21 18:52:01'),
(131, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"kota\":\"Makassars\"}', '{\"kota\":\"Makassar\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:52:01', '2025-04-21 18:52:01'),
(132, '222249', 'created', 'App\\Models\\Keluarga', '9', NULL, '{\"nip\":\"198501012022011001\",\"nama\":\"Aco\",\"hubungan\":\"Anak\",\"pekerjaan\":\"-\",\"updated_at\":\"2025-04-22 10:53:00\",\"created_at\":\"2025-04-22 10:53:00\",\"id\":9}', 'Menambahkan data Keluarga dengan ID 198501012022011001', '2025-04-21 18:53:00', '2025-04-21 18:53:00'),
(133, '222249', 'deleted', 'App\\Models\\Keluarga', '6', '{\"nip\":\"199503101987031201\",\"id\":6,\"nama\":\"Melati Indah\",\"hubungan\":\"Anak\",\"jenis_kelamin\":\"Perempuan\",\"tanggal_lahir\":\"2010-10-10\",\"status_hidup\":\"Hidup\",\"pekerjaan\":\"Pelajar\",\"created_at\":\"2025-04-10 15:34:28\",\"updated_at\":\"2025-04-10 15:34:28\"}', NULL, 'Menghapus data Keluarga dengan ID 199503101987031201', '2025-04-21 18:53:39', '2025-04-21 18:53:39'),
(134, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputra\"}', '{\"nama\":\"Andi Saputras\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:54:05', '2025-04-21 18:54:05'),
(135, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputra\"}', '{\"nama\":\"Andi Saputras\"}', 'Mengubah data Peserta dengan ID 198501012022011001', '2025-04-21 18:54:05', '2025-04-21 18:54:05'),
(136, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-21 18:54:58', '2025-04-21 18:54:58'),
(137, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-04-21 19:06:57', '2025-04-21 19:06:57'),
(138, '222249', 'updated', 'App\\Models\\Cabang', '1', '{\"nama_cabang\":\"Cabang Makassar\",\"updated_at\":\"2025-04-13T23:49:54.000000Z\"}', '{\"nama_cabang\":\"Cabang Makassaraaa\",\"updated_at\":\"2025-04-22 11:07:14\"}', 'Mengubah data Cabang dengan ID ', '2025-04-21 19:07:14', '2025-04-21 19:07:14'),
(139, '222249', 'updated', 'App\\Models\\Cabang', '1', '{\"nama_cabang\":\"Cabang Makassaraaa\",\"updated_at\":\"2025-04-22T03:07:14.000000Z\"}', '{\"nama_cabang\":\"Cabang Makassar\",\"updated_at\":\"2025-04-22 11:08:54\"}', 'Mengubah data Cabang ', '2025-04-21 19:08:54', '2025-04-21 19:08:54'),
(140, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputras\"}', '{\"nama\":\"Andi Saputra\"}', 'Mengubah data Peserta 198501012022011001', '2025-04-21 19:09:27', '2025-04-21 19:09:27'),
(141, '222249', 'created', 'App\\Models\\Keluarga', '10', NULL, '{\"nip\":\"199503101987031201\",\"nama\":\"Michael\",\"hubungan\":\"Anak\",\"pekerjaan\":\"Pelajar\",\"updated_at\":\"2025-04-22 11:10:09\",\"created_at\":\"2025-04-22 11:10:09\",\"id\":10}', 'Menambahkan data Keluarga 199503101987031201', '2025-04-21 19:10:09', '2025-04-21 19:10:09'),
(142, '222249', 'updated', 'App\\Models\\Peserta', '199503101987031201', '{\"nama\":\"Dina Marwah Mantap\"}', '{\"nama\":\"Dina Marwah\"}', 'Mengubah data Peserta 199503101987031201', '2025-04-21 19:11:01', '2025-04-21 19:11:01'),
(143, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-21 19:11:30', '2025-04-21 19:11:30'),
(144, '1000001', 'login', NULL, NULL, NULL, NULL, 'Pengguna Michael Immanuel Manabung berhasil login sebagai operator', '2025-04-21 19:12:58', '2025-04-21 19:12:58'),
(145, '1000001', 'updated', 'App\\Models\\Peserta', '199001152023020201', '{\"cabang_id\":3}', '{\"cabang_id\":\"2\"}', 'Mengubah data Peserta 199001152023020201', '2025-04-21 19:13:28', '2025-04-21 19:13:28'),
(146, '1000001', 'updated', 'App\\Models\\Peserta', '199001152023020201', '{\"cabang_id\":3}', '{\"cabang_id\":\"2\"}', 'Mengubah data Peserta 199001152023020201', '2025-04-21 19:13:28', '2025-04-21 19:13:28'),
(147, '1000001', 'updated', 'App\\Models\\Peserta', '199001152023020201', '{\"cabang_id\":3}', '{\"cabang_id\":\"2\"}', 'Mengubah data Peserta 199001152023020201', '2025-04-21 19:13:28', '2025-04-21 19:13:28'),
(148, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-21 19:15:09', '2025-04-21 19:15:09'),
(149, '1000001', 'login', NULL, NULL, NULL, NULL, 'Pengguna Michael Immanuel Manabung berhasil login sebagai operator', '2025-04-21 19:20:24', '2025-04-21 19:20:24'),
(150, '234567', 'login', NULL, NULL, NULL, NULL, 'Pengguna supervisor berhasil login sebagai supervisor', '2025-04-21 21:21:19', '2025-04-21 21:21:19'),
(151, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-21 21:22:03', '2025-04-21 21:22:03'),
(152, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-21 22:10:30', '2025-04-21 22:10:30'),
(153, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-21 23:57:05', '2025-04-21 23:57:05'),
(154, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-22 00:34:55', '2025-04-22 00:34:55'),
(155, '123456', 'created', 'App\\Models\\Cabang', '7', NULL, '{\"nama_cabang\":\"Cabang Ablam\",\"alamat\":\"Abu bakar lambogo\",\"updated_at\":\"2025-04-22 16:38:48\",\"created_at\":\"2025-04-22 16:38:48\",\"id\":7}', 'Menambahkan data Cabang ', '2025-04-22 00:38:48', '2025-04-22 00:38:48'),
(156, '123456', 'created', 'App\\Models\\Cabang', '8', NULL, '{\"nama_cabang\":\"Cabang Ablam\",\"alamat\":\"Abu bakar lambogo\",\"updated_at\":\"2025-04-22 16:39:29\",\"created_at\":\"2025-04-22 16:39:29\",\"id\":8}', 'Menambahkan data Cabang ', '2025-04-22 00:39:29', '2025-04-22 00:39:29'),
(157, '123456', 'created', 'App\\Models\\Cabang', '9', NULL, '{\"nama_cabang\":\"Cabang Ablam\",\"alamat\":\"Abu bakar lambogo\",\"updated_at\":\"2025-04-22 16:40:39\",\"created_at\":\"2025-04-22 16:40:39\",\"id\":9}', 'Menambahkan data Cabang ', '2025-04-22 00:40:39', '2025-04-22 00:40:39'),
(158, '123456', 'created', 'App\\Models\\Cabang', '10', NULL, '{\"nama_cabang\":\"Cabang Ablam\",\"alamat\":\"Abu bakar lambogo\",\"updated_at\":\"2025-04-22 16:42:06\",\"created_at\":\"2025-04-22 16:42:06\",\"id\":10}', 'Menambahkan data Cabang ', '2025-04-22 00:42:06', '2025-04-22 00:42:06'),
(159, '123456', 'created', 'App\\Models\\Cabang', '11', NULL, '{\"nama_cabang\":\"Cabang Ablam\",\"alamat\":\"Abu bakar lambogo\",\"updated_at\":\"2025-04-22 16:43:10\",\"created_at\":\"2025-04-22 16:43:10\",\"id\":11}', 'Menambahkan data Cabang ', '2025-04-22 00:43:10', '2025-04-22 00:43:10'),
(160, '123456', 'deleted', 'App\\Models\\Cabang', '7', '{\"id\":7,\"nama_cabang\":\"Cabang Ablam\",\"alamat\":\"Abu bakar lambogo\",\"created_at\":\"2025-04-22 16:38:48\",\"updated_at\":\"2025-04-22 16:38:48\"}', NULL, 'Menghapus data Cabang ', '2025-04-22 00:44:29', '2025-04-22 00:44:29'),
(161, '123456', 'deleted', 'App\\Models\\Cabang', '11', '{\"id\":11,\"nama_cabang\":\"Cabang Ablam\",\"alamat\":\"Abu bakar lambogo\",\"created_at\":\"2025-04-22 16:43:10\",\"updated_at\":\"2025-04-22 16:43:10\"}', NULL, 'Menghapus data Cabang ', '2025-04-22 00:46:57', '2025-04-22 00:46:57'),
(162, '123456', 'deleted', 'App\\Models\\Cabang', '10', '{\"id\":10,\"nama_cabang\":\"Cabang Ablam\",\"alamat\":\"Abu bakar lambogo\",\"created_at\":\"2025-04-22 16:42:06\",\"updated_at\":\"2025-04-22 16:42:06\"}', NULL, 'Menghapus data Cabang ', '2025-04-22 00:47:02', '2025-04-22 00:47:02'),
(163, '123456', 'deleted', 'App\\Models\\Cabang', '9', '{\"id\":9,\"nama_cabang\":\"Cabang Ablam\",\"alamat\":\"Abu bakar lambogo\",\"created_at\":\"2025-04-22 16:40:39\",\"updated_at\":\"2025-04-22 16:40:39\"}', NULL, 'Menghapus data Cabang ', '2025-04-22 00:47:07', '2025-04-22 00:47:07'),
(164, '123456', 'deleted', 'App\\Models\\Cabang', '8', '{\"id\":8,\"nama_cabang\":\"Cabang Ablam\",\"alamat\":\"Abu bakar lambogo\",\"created_at\":\"2025-04-22 16:39:29\",\"updated_at\":\"2025-04-22 16:39:29\"}', NULL, 'Menghapus data Cabang ', '2025-04-22 00:47:28', '2025-04-22 00:47:28'),
(165, '123456', 'updated', 'App\\Models\\Cabang', '1', '{\"alamat\":\"Jl. Perintis Kemerdekaan No.123, Makassar\",\"updated_at\":\"2025-04-22T03:08:54.000000Z\"}', '{\"alamat\":\"Jl. Perintisss Kemerdekaan No.123, Makassar\",\"updated_at\":\"2025-04-22 16:48:11\"}', 'Mengubah data Cabang ', '2025-04-22 00:48:11', '2025-04-22 00:48:11'),
(166, '123456', 'updated', 'App\\Models\\Cabang', '1', '{\"alamat\":\"Jl. Perintisss Kemerdekaan No.123, Makassar\"}', '{\"alamat\":\"Jl. Perintis Kemerdekaan No.123, Makassar\"}', 'Mengubah data Cabang ', '2025-04-22 00:49:12', '2025-04-22 00:49:12'),
(167, '123456', 'created', 'App\\Models\\Cabang', '12', NULL, '{\"nama_cabang\":\"Cabang Ablam\",\"alamat\":\"Jl. Abu bakar lambogo\",\"id\":12}', 'Menambahkan data Cabang ', '2025-04-22 00:50:05', '2025-04-22 00:50:05'),
(168, '123456', 'deleted', 'App\\Models\\Cabang', '12', '{\"id\":12,\"nama_cabang\":\"Cabang Ablam\",\"alamat\":\"Jl. Abu bakar lambogo\",\"created_at\":\"2025-04-22 16:50:05\",\"updated_at\":\"2025-04-22 16:50:05\"}', NULL, 'Menghapus data Cabang ', '2025-04-22 00:55:57', '2025-04-22 00:55:57'),
(169, '123456', 'created', 'App\\Models\\Cabang', '13', NULL, '{\"nama_cabang\":\"Cabang Ablam\",\"alamat\":\"Jl. abu bakar\",\"id\":13}', 'Menambahkan data Cabang ', '2025-04-22 00:56:51', '2025-04-22 00:56:51'),
(170, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-04-22 00:57:56', '2025-04-22 00:57:56'),
(171, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputra\"}', '{\"nama\":\"Andi Saputras\"}', 'Mengubah data Peserta 198501012022011001', '2025-04-22 00:58:08', '2025-04-22 00:58:08'),
(172, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"nama\":\"Andi Saputra\"}', '{\"nama\":\"Andi Saputras\"}', 'Mengubah data Peserta 198501012022011001', '2025-04-22 00:58:08', '2025-04-22 00:58:08'),
(173, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-22 00:58:50', '2025-04-22 00:58:50'),
(174, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-22 15:55:57', '2025-04-22 15:55:57'),
(175, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-04-22 16:06:51', '2025-04-22 16:06:51'),
(176, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-22 16:18:46', '2025-04-22 16:18:46'),
(177, '123456', 'updated', 'App\\Models\\Cabang', '1', '{\"nama_cabang\":\"Cabang Makassar\"}', '{\"nama_cabang\":\"Cabang Makassarraaa\"}', 'Mengubah data Cabang ', '2025-04-22 16:19:07', '2025-04-22 16:19:07'),
(178, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-04-22 16:19:41', '2025-04-22 16:19:41'),
(179, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"cabang_id\":4}', '{\"cabang_id\":\"1\"}', 'Mengubah data Peserta 198501012022011001', '2025-04-22 16:19:54', '2025-04-22 16:19:54'),
(180, '222249', 'updated', 'App\\Models\\Peserta', '198501012022011001', '{\"cabang_id\":4}', '{\"cabang_id\":\"1\"}', 'Mengubah data Peserta 198501012022011001', '2025-04-22 16:19:54', '2025-04-22 16:19:54'),
(181, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-22 16:20:35', '2025-04-22 16:20:35'),
(182, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-22 16:26:00', '2025-04-22 16:26:00'),
(183, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-22 16:29:34', '2025-04-22 16:29:34'),
(184, '123456', 'created', 'App\\Models\\Cabang', '14', NULL, '{\"nama_cabang\":\"Cabang Makassar\",\"alamat\":\"xxx\",\"id\":14}', 'Menambahkan data Cabang ', '2025-04-22 16:54:51', '2025-04-22 16:54:51'),
(185, '123456', 'deleted', 'App\\Models\\Cabang', '14', '{\"id\":14,\"nama_cabang\":\"Cabang Makassar\",\"alamat\":\"xxx\",\"created_at\":\"2025-04-23 08:54:51\",\"updated_at\":\"2025-04-23 08:54:51\"}', NULL, 'Menghapus data Cabang ', '2025-04-22 16:54:55', '2025-04-22 16:54:55'),
(186, '123456', 'updated', 'App\\Models\\Cabang', '1', '{\"alamat\":\"Jl. Perintis Kemerdekaan No.123, Makassar\"}', '{\"alamat\":\"Jl. Perintis Kemerdekaan No.123, Makassaraa\"}', 'Mengubah data Cabang ', '2025-04-22 17:23:22', '2025-04-22 17:23:22'),
(187, '123456', 'updated', 'App\\Models\\Cabang', '1', '{\"alamat\":\"Jl. Perintis Kemerdekaan No.123, Makassaraa\"}', '{\"alamat\":\"Jl. Perintis Kemerdekaan No.123, Makassar\"}', 'Mengubah data Cabang ', '2025-04-22 17:24:38', '2025-04-22 17:24:38'),
(188, '123456', 'created', 'App\\Models\\Cabang', '15', NULL, '{\"nama_cabang\":\"Cabang Ablam\",\"alamat\":\"wwwwwww\",\"id\":15}', 'Menambahkan data Cabang ', '2025-04-22 17:25:44', '2025-04-22 17:25:44'),
(189, '123456', 'deleted', 'App\\Models\\Cabang', '15', '{\"id\":15,\"nama_cabang\":\"Cabang Ablam\",\"alamat\":\"wwwwwww\",\"created_at\":\"2025-04-23 09:25:44\",\"updated_at\":\"2025-04-23 09:25:44\"}', NULL, 'Menghapus data Cabang ', '2025-04-22 17:25:48', '2025-04-22 17:25:48'),
(190, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-04-22 17:26:36', '2025-04-22 17:26:36'),
(191, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-22 17:27:07', '2025-04-22 17:27:07'),
(192, '123456', 'updated', 'App\\Models\\Cabang', '1', '{\"nama_cabang\":\"Cabang Makassarraaa\"}', '{\"nama_cabang\":\"Cabang Makassar\"}', 'Mengubah data Cabang ', '2025-04-22 17:27:30', '2025-04-22 17:27:30'),
(193, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-04-22 17:27:47', '2025-04-22 17:27:47'),
(194, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-22 17:28:50', '2025-04-22 17:28:50'),
(195, '123456', 'deleted', 'App\\Models\\Cabang', '13', '{\"id\":13,\"nama_cabang\":\"Cabang Ablam\",\"alamat\":\"Jl. abu bakar\",\"created_at\":\"2025-04-22 16:56:51\",\"updated_at\":\"2025-04-22 16:56:51\"}', NULL, 'Menghapus data Cabang ', '2025-04-22 17:28:56', '2025-04-22 17:28:56'),
(196, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-04-22 17:29:09', '2025-04-22 17:29:09'),
(197, '222249', 'updated', 'App\\Models\\Peserta', '198911202010090101', '{\"cabang_id\":2}', '{\"cabang_id\":\"5\"}', 'Mengubah data Peserta 198911202010090101', '2025-04-22 17:29:30', '2025-04-22 17:29:30'),
(198, '222249', 'updated', 'App\\Models\\Peserta', '198911202010090101', '{\"cabang_id\":5}', '{\"cabang_id\":\"4\"}', 'Mengubah data Peserta 198911202010090101', '2025-04-22 17:29:47', '2025-04-22 17:29:47'),
(199, '222249', 'updated', 'App\\Models\\Peserta', '198911202010090101', '{\"cabang_id\":5}', '{\"cabang_id\":\"4\"}', 'Mengubah data Peserta 198911202010090101', '2025-04-22 17:29:47', '2025-04-22 17:29:47'),
(200, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-04-22 19:11:55', '2025-04-22 19:11:55'),
(201, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-22 19:36:18', '2025-04-22 19:36:18'),
(202, '234567', 'login', NULL, NULL, NULL, NULL, 'Pengguna supervisor berhasil login sebagai supervisor', '2025-04-22 20:41:59', '2025-04-22 20:41:59'),
(203, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-04-22 20:59:33', '2025-04-22 20:59:33'),
(204, '222249', 'created', 'App\\Models\\Peserta', '1000001', NULL, '{\"nip\":\"1000001\",\"nama\":\"Andi Saputra\",\"jenis_kelamin\":\"Laki-laki\",\"tempat_lahir\":\"Makassar\",\"tanggal_lahir\":\"2025-04-23 00:00:00\",\"status_pernikahan\":\"Janda\",\"no_sk\":\"SK-009\",\"cabang_id\":\"3\",\"tmk\":\"2025-04-23 00:00:00\",\"tpst\":\"2025-04-23 00:00:00\",\"golongan\":\"Direktur\",\"jabatan\":\"Staf Administrasi\",\"pendidikan\":\"S3\",\"jurusan\":\"TI\",\"phdp\":\"9000000\",\"akumulasi_ibhp\":\"450000000\",\"kode_ptkp\":\"46456\",\"kode_peserta\":\"PST009\",\"alamat\":\"ablam\",\"kelurahan\":\"tass\",\"kabupaten\":\"Gowa\",\"kota\":\"Makassar\",\"kode_pos\":\"75756\",\"telpon\":\"086436363645\"}', 'Menambahkan data Peserta 1000001', '2025-04-22 21:32:00', '2025-04-22 21:32:00'),
(205, '222249', 'created', 'App\\Models\\Keluarga', '11', NULL, '{\"nip\":\"1000001\",\"nama\":\"Andi Saputra\",\"hubungan\":\"Suami\",\"pekerjaan\":\"Polisi\",\"updated_at\":\"2025-04-23 13:32:41\",\"created_at\":\"2025-04-23 13:32:41\",\"id\":11}', 'Menambahkan data Keluarga 1000001', '2025-04-22 21:32:41', '2025-04-22 21:32:41'),
(206, '222249', 'created', 'App\\Models\\Keluarga', '12', NULL, '{\"nip\":\"1000001\",\"nama\":\"Michael\",\"hubungan\":\"Anak\",\"pekerjaan\":\"-\",\"updated_at\":\"2025-04-23 13:33:28\",\"created_at\":\"2025-04-23 13:33:28\",\"id\":12}', 'Menambahkan data Keluarga 1000001', '2025-04-22 21:33:28', '2025-04-22 21:33:28'),
(207, '222249', 'created', 'App\\Models\\Keluarga', '13', NULL, '{\"nip\":\"1000001\",\"nama\":\"fahri\",\"hubungan\":\"Istri\",\"pekerjaan\":\"Polisi\",\"updated_at\":\"2025-04-23 13:35:47\",\"created_at\":\"2025-04-23 13:35:47\",\"id\":13}', 'Menambahkan data Keluarga 1000001', '2025-04-22 21:35:47', '2025-04-22 21:35:47'),
(208, '222249', 'deleted', 'App\\Models\\Keluarga', '11', '{\"nip\":\"1000001\",\"id\":11,\"nama\":\"Andi Saputra\",\"hubungan\":\"Suami\",\"jenis_kelamin\":\"Laki-laki\",\"tanggal_lahir\":null,\"status_hidup\":\"Hidup\",\"pekerjaan\":\"Polisi\",\"created_at\":\"2025-04-23 13:32:41\",\"updated_at\":\"2025-04-23 13:32:41\"}', NULL, 'Menghapus data Keluarga 1000001', '2025-04-22 21:37:33', '2025-04-22 21:37:33'),
(209, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-22 21:38:01', '2025-04-22 21:38:01'),
(210, '1000001', 'login', NULL, NULL, NULL, NULL, 'Pengguna Michael Immanuel Manabung berhasil login sebagai operator', '2025-04-22 22:02:48', '2025-04-22 22:02:48'),
(211, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-22 22:04:16', '2025-04-22 22:04:16'),
(212, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-22 22:33:11', '2025-04-22 22:33:11'),
(213, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-04-22 22:42:23', '2025-04-22 22:42:23'),
(214, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-04-23 18:31:12', '2025-04-23 18:31:12'),
(215, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-23 18:31:40', '2025-04-23 18:31:40'),
(216, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-23 22:32:15', '2025-04-23 22:32:15'),
(217, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-04-24 18:51:46', '2025-04-24 18:51:46'),
(218, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-24 18:52:16', '2025-04-24 18:52:16'),
(219, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-24 23:11:20', '2025-04-24 23:11:20'),
(220, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-04-25 00:34:28', '2025-04-25 00:34:28'),
(221, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-27 21:06:53', '2025-04-27 21:06:53'),
(222, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai admin', '2025-04-27 22:02:37', '2025-04-27 22:02:37'),
(223, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai supervisor', '2025-04-27 22:03:24', '2025-04-27 22:03:24'),
(224, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-04-27 22:06:18', '2025-04-27 22:06:18'),
(225, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-04-29 16:09:03', '2025-04-29 16:09:03'),
(226, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-05-01 16:24:45', '2025-05-01 16:24:45'),
(227, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-05-06 17:04:24', '2025-05-06 17:04:24'),
(228, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-05-06 19:02:14', '2025-05-06 19:02:14'),
(229, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-05-06 19:11:41', '2025-05-06 19:11:41'),
(230, '222249', 'created', 'App\\Models\\Keluarga', '14', NULL, '{\"nip\":\"1000001\",\"nama\":\"Michael\",\"hubungan\":\"Anak\",\"pekerjaan\":\"Polisi\",\"updated_at\":\"2025-05-07 11:13:20\",\"created_at\":\"2025-05-07 11:13:20\",\"id\":14}', 'Menambahkan data Keluarga 1000001', '2025-05-06 19:13:20', '2025-05-06 19:13:20'),
(231, '222249', 'updated', 'App\\Models\\Peserta', '1000001', '{\"status_pernikahan\":\"Janda\",\"cabang_id\":3}', '{\"status_pernikahan\":\"Menikah\",\"cabang_id\":\"1\"}', 'Mengubah data Peserta 1000001', '2025-05-06 19:13:56', '2025-05-06 19:13:56'),
(232, '222249', 'updated', 'App\\Models\\Peserta', '1000001', '{\"status_pernikahan\":\"Janda\",\"cabang_id\":3}', '{\"status_pernikahan\":\"Menikah\",\"cabang_id\":\"1\"}', 'Mengubah data Peserta 1000001', '2025-05-06 19:13:56', '2025-05-06 19:13:56'),
(233, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-05-06 19:18:31', '2025-05-06 19:18:31'),
(234, '234567', 'login', NULL, NULL, NULL, NULL, 'Pengguna supervisor berhasil login sebagai supervisor', '2025-05-06 19:22:46', '2025-05-06 19:22:46'),
(235, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-05-06 20:39:28', '2025-05-06 20:39:28'),
(236, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-05-06 20:54:08', '2025-05-06 20:54:08'),
(237, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-05-06 20:54:25', '2025-05-06 20:54:25'),
(238, '234567', 'login', NULL, NULL, NULL, NULL, 'Pengguna supervisor berhasil login sebagai supervisor', '2025-05-08 18:55:00', '2025-05-08 18:55:00'),
(239, '234567', 'login', NULL, NULL, NULL, NULL, 'Pengguna supervisor berhasil login sebagai supervisor', '2025-05-08 21:33:52', '2025-05-08 21:33:52'),
(240, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-05-08 22:27:20', '2025-05-08 22:27:20'),
(241, '234567', 'login', NULL, NULL, NULL, NULL, 'Pengguna supervisor berhasil login sebagai supervisor', '2025-05-08 22:32:53', '2025-05-08 22:32:53'),
(242, '222249', 'login', NULL, NULL, NULL, NULL, 'Pengguna Reinhart berhasil login sebagai operator', '2025-05-14 18:36:33', '2025-05-14 18:36:33'),
(243, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-05-14 18:39:29', '2025-05-14 18:39:29'),
(244, '123456', 'login', NULL, NULL, NULL, NULL, 'Pengguna admin berhasil login sebagai admin', '2025-05-14 19:48:42', '2025-05-14 19:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `cabangs`
--

CREATE TABLE `cabangs` (
  `id` int(11) NOT NULL,
  `nama_cabang` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `cabangs`
--

INSERT INTO `cabangs` (`id`, `nama_cabang`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Cabang Makassar', 'Jl. Perintis Kemerdekaan No.123, Makassar', '2025-04-08 16:31:35', '2025-04-22 17:27:30'),
(2, 'Cabang Parepare', 'Jl. Bau Massepe No.45, Parepare', '2025-04-08 16:31:35', '2025-04-08 16:31:35'),
(3, 'Cabang Palopo', 'Jl. Andi Djemma No.10, Palopo', '2025-04-08 16:31:35', '2025-04-08 16:31:35'),
(4, 'Cabang Bulukumba', 'Jl. Dr. Sam Ratulangi No.5, Bulukumba', '2025-04-08 16:31:35', '2025-04-08 16:31:35'),
(5, 'Cabang Bone', 'Jl. Ahmad Yani No.7, Watampone', '2025-04-08 16:31:35', '2025-04-08 16:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_captcha_01ca2579e6de821b496ad16d5abb9981', 'a:4:{i:0;s:1:\"p\";i:1;s:1:\"q\";i:2;s:1:\"m\";i:3;s:1:\"q\";}', 1745377966),
('laravel_cache_captcha_02ec9b5b8d0d057016074db59d1e88db', 'a:4:{i:0;s:1:\"y\";i:1;s:1:\"r\";i:2;s:1:\"r\";i:3;s:1:\"f\";}', 1745548132),
('laravel_cache_captcha_0582b756b0cf9f7bae9af19f1d35b157', 'a:4:{i:0;s:1:\"e\";i:1;s:1:\"z\";i:2;s:1:\"t\";i:3;s:1:\"c\";}', 1745367993),
('laravel_cache_captcha_14c8e7c90ea65325707cb5a8acaeaa84', 'a:4:{i:0;s:1:\"q\";i:1;s:1:\"8\";i:2;s:1:\"3\";i:3;s:1:\"r\";}', 1746169672),
('laravel_cache_captcha_184ea2d40c064c724d0c21a96c80b392', 'a:4:{i:0;s:1:\"h\";i:1;s:1:\"r\";i:2;s:1:\"9\";i:3;s:1:\"p\";}', 1745548184),
('laravel_cache_captcha_1d0fa6a73db5f8135b150db0254247f1', 'a:4:{i:0;s:1:\"p\";i:1;s:1:\"m\";i:2;s:1:\"b\";i:3;s:1:\"n\";}', 1746413002),
('laravel_cache_captcha_2238ae96ecd4140b0258700e9bc9d8b8', 'a:4:{i:0;s:1:\"4\";i:1;s:1:\"7\";i:2;s:1:\"x\";i:3;s:1:\"t\";}', 1746587489),
('laravel_cache_captcha_24acdff3ea88f669e7400ba4ed7563ef', 'a:4:{i:0;s:1:\"g\";i:1;s:1:\"y\";i:2;s:1:\"q\";i:3;s:1:\"4\";}', 1745291249),
('laravel_cache_captcha_27eb86ed192c70c1cc97cc919f7713d2', 'a:4:{i:0;s:1:\"d\";i:1;s:1:\"e\";i:2;s:1:\"j\";i:3;s:1:\"q\";}', 1745282804),
('laravel_cache_captcha_28999e7f74d6a635c03a8f7f378d86b2', 'a:4:{i:0;s:1:\"7\";i:1;s:1:\"h\";i:2;s:1:\"a\";i:3;s:1:\"t\";}', 1746169674),
('laravel_cache_captcha_2b82baef399f2bae8ec0f8530f3b0e59', 'a:4:{i:0;s:1:\"2\";i:1;s:1:\"m\";i:2;s:1:\"9\";i:3;s:1:\"q\";}', 1746169504),
('laravel_cache_captcha_2cd3b88061ca5b59561cc0a649212492', 'a:4:{i:0;s:1:\"m\";i:1;s:1:\"r\";i:2;s:1:\"u\";i:3;s:1:\"y\";}', 1745304643),
('laravel_cache_captcha_31121b6d66859145af3d5f80bee4e825', 'a:4:{i:0;s:1:\"j\";i:1;s:1:\"n\";i:2;s:1:\"q\";i:3;s:1:\"b\";}', 1746412999),
('laravel_cache_captcha_333b2238f001caa09efac453d9d16c14', 'a:4:{i:0;s:1:\"n\";i:1;s:1:\"x\";i:2;s:1:\"h\";i:3;s:1:\"a\";}', 1745282177),
('laravel_cache_captcha_360b8d1e2433e3598d8284ce0b7d65df', 'a:4:{i:0;s:1:\"3\";i:1;s:1:\"h\";i:2;s:1:\"u\";i:3;s:1:\"e\";}', 1745816690),
('laravel_cache_captcha_3abe1871da3fd542d7ecd1b6dcc64399', 'a:4:{i:0;s:1:\"d\";i:1;s:1:\"j\";i:2;s:1:\"9\";i:3;s:1:\"a\";}', 1745384014),
('laravel_cache_captcha_3acc6b02e5c07d6854e7e30fe31906d5', 'a:4:{i:0;s:1:\"u\";i:1;s:1:\"r\";i:2;s:1:\"a\";i:3;s:1:\"j\";}', 1745471396),
('laravel_cache_captcha_3adffcd81749c5cbb181f80f6ee94f62', 'a:4:{i:0;s:1:\"y\";i:1;s:1:\"n\";i:2;s:1:\"h\";i:3;s:1:\"b\";}', 1745371773),
('laravel_cache_captcha_3b4737c176100d1631c745be04dc98ef', 'a:4:{i:0;s:1:\"f\";i:1;s:1:\"g\";i:2;s:1:\"d\";i:3;s:1:\"b\";}', 1745820423),
('laravel_cache_captcha_45f6b46915e9f06fd8642ad4e2122347', 'a:4:{i:0;s:1:\"y\";i:1;s:1:\"d\";i:2;s:1:\"p\";i:3;s:1:\"b\";}', 1746169501),
('laravel_cache_captcha_4ab0ef6715281e1d6471fed45a9d5edf', 'a:4:{i:0;s:1:\"j\";i:1;s:1:\"y\";i:2;s:1:\"8\";i:3;s:1:\"r\";}', 1745281746),
('laravel_cache_captcha_4d2bd3d1bb4f96c2bb47327cfb63be69', 'a:4:{i:0;s:1:\"j\";i:1;s:1:\"9\";i:2;s:1:\"b\";i:3;s:1:\"p\";}', 1745367996),
('laravel_cache_captcha_4fe7d361bfce3b76172c33303e172d25', 'a:4:{i:0;s:1:\"t\";i:1;s:1:\"3\";i:2;s:1:\"h\";i:3;s:1:\"f\";}', 1745312416),
('laravel_cache_captcha_5023148e35ef1e07293ffb2ea7ebd4d5', 'a:4:{i:0;s:1:\"u\";i:1;s:1:\"d\";i:2;s:1:\"b\";i:3;s:1:\"4\";}', 1746596623),
('laravel_cache_captcha_51895fcf6a6d9a71354d63f710838b14', 'a:4:{i:0;s:1:\"z\";i:1;s:1:\"p\";i:2;s:1:\"x\";i:3;s:1:\"2\";}', 1745548208),
('laravel_cache_captcha_56563b0b321e91ec5d34eface854dd63', 'a:4:{i:0;s:1:\"m\";i:1;s:1:\"g\";i:2;s:1:\"4\";i:3;s:1:\"q\";}', 1745816653),
('laravel_cache_captcha_56c0bb4bf29bb331fd7312dc2dc5498c', 'a:4:{i:0;s:1:\"m\";i:1;s:1:\"u\";i:2;s:1:\"g\";i:3;s:1:\"6\";}', 1745281519),
('laravel_cache_captcha_5a9b717822432ca9fc8a63ee580d52ef', 'a:4:{i:0;s:1:\"2\";i:1;s:1:\"q\";i:2;s:1:\"b\";i:3;s:1:\"y\";}', 1745816688),
('laravel_cache_captcha_5ab5c74950c97195c4aaa07e2f6adbb8', 'a:4:{i:0;s:1:\"c\";i:1;s:1:\"r\";i:2;s:1:\"f\";i:3;s:1:\"c\";}', 1745557569),
('laravel_cache_captcha_5b479e264b0e74056c59ff16839ec903', 'a:4:{i:0;s:1:\"q\";i:1;s:1:\"a\";i:2;s:1:\"u\";i:3;s:1:\"f\";}', 1745816687),
('laravel_cache_captcha_5b51042eb58ce5479ccefccd6edf9fa9', 'a:4:{i:0;s:1:\"n\";i:1;s:1:\"n\";i:2;s:1:\"b\";i:3;s:1:\"y\";}', 1745541451),
('laravel_cache_captcha_5ce7f6f751d9e5c6fe08c8f68d37f727', 'a:4:{i:0;s:1:\"x\";i:1;s:1:\"p\";i:2;s:1:\"q\";i:3;s:1:\"r\";}', 1746169855),
('laravel_cache_captcha_61e95bfd46debe6e56c43bc209a4444c', 'a:4:{i:0;s:1:\"h\";i:1;s:1:\"p\";i:2;s:1:\"y\";i:3;s:1:\"x\";}', 1746169500),
('laravel_cache_captcha_653b236b72874d4a2109ab986fc7336f', 'a:4:{i:0;s:1:\"a\";i:1;s:1:\"e\";i:2;s:1:\"f\";i:3;s:1:\"q\";}', 1746169847),
('laravel_cache_captcha_6c6f96108658bd786ee5202c42139d95', 'a:4:{i:0;s:1:\"p\";i:1;s:1:\"y\";i:2;s:1:\"2\";i:3;s:1:\"y\";}', 1746586849),
('laravel_cache_captcha_6d816d851a81e907c0c0fcf41abe5c09', 'a:4:{i:0;s:1:\"d\";i:1;s:1:\"n\";i:2;s:1:\"7\";i:3;s:1:\"j\";}', 1746145429),
('laravel_cache_captcha_707027cfdbf8b21f3ef6864b2e70fdc8', 'a:4:{i:0;s:1:\"8\";i:1;s:1:\"e\";i:2;s:1:\"g\";i:3;s:1:\"a\";}', 1745548390),
('laravel_cache_captcha_7628dc93a0e63f9123a09ee0e48dfcc3', 'a:4:{i:0;s:1:\"p\";i:1;s:1:\"m\";i:2;s:1:\"b\";i:3;s:1:\"a\";}', 1745384012),
('laravel_cache_captcha_7a433b379aa59c0f633ea99cf7bb8369', 'a:4:{i:0;s:1:\"n\";i:1;s:1:\"g\";i:2;s:1:\"j\";i:3;s:1:\"j\";}', 1745548174),
('laravel_cache_captcha_7a94ecee093f2af9d500be70da2194ae', 'a:4:{i:0;s:1:\"b\";i:1;s:1:\"r\";i:2;s:1:\"y\";i:3;s:1:\"c\";}', 1746169853),
('laravel_cache_captcha_7cc33655d82038029c6e083760e852e0', 'a:4:{i:0;s:1:\"p\";i:1;s:1:\"u\";i:2;s:1:\"j\";i:3;s:1:\"3\";}', 1745548183),
('laravel_cache_captcha_80b1262829eb96d34b813581b7b1ad27', 'a:4:{i:0;s:1:\"m\";i:1;s:1:\"x\";i:2;s:1:\"n\";i:3;s:1:\"d\";}', 1745548163),
('laravel_cache_captcha_829fc911cf9aac99c5c098c01da67e57', 'a:4:{i:0;s:1:\"e\";i:1;s:1:\"7\";i:2;s:1:\"h\";i:3;s:1:\"y\";}', 1745548393),
('laravel_cache_captcha_925f00011b1ddbc94c1194eeb60bf2fe', 'a:4:{i:0;s:1:\"8\";i:1;s:1:\"m\";i:2;s:1:\"8\";i:3;s:1:\"n\";}', 1745453963),
('laravel_cache_captcha_9325647fceff8f12c908ba98edc6c39d', 'a:4:{i:0;s:1:\"y\";i:1;s:1:\"a\";i:2;s:1:\"j\";i:3;s:1:\"u\";}', 1745547714),
('laravel_cache_captcha_93e5df62c3ae678ebb509ba2633927f1', 'a:4:{i:0;s:1:\"p\";i:1;s:1:\"8\";i:2;s:1:\"z\";i:3;s:1:\"h\";}', 1745310935),
('laravel_cache_captcha_98070d69c10d7707e17dc50d94f6a0df', 'a:4:{i:0;s:1:\"j\";i:1;s:1:\"8\";i:2;s:1:\"p\";i:3;s:1:\"u\";}', 1746586950),
('laravel_cache_captcha_9be4546619c1492fc7985468691458e8', 'a:4:{i:0;s:1:\"8\";i:1;s:1:\"6\";i:2;s:1:\"8\";i:3;s:1:\"e\";}', 1745282525),
('laravel_cache_captcha_9d07645ab51c8f10bdffe7ddad82a5e5', 'a:4:{i:0;s:1:\"y\";i:1;s:1:\"3\";i:2;s:1:\"y\";i:3;s:1:\"d\";}', 1746586952),
('laravel_cache_captcha_a398af063937b7d158ae3b1ca6f549a7', 'a:4:{i:0;s:1:\"n\";i:1;s:1:\"h\";i:2;s:1:\"t\";i:3;s:1:\"t\";}', 1745548202),
('laravel_cache_captcha_a8ff29e279d832c86e91fa953bb0f04d', 'a:4:{i:0;s:1:\"t\";i:1;s:1:\"6\";i:2;s:1:\"b\";i:3;s:1:\"q\";}', 1745548205),
('laravel_cache_captcha_a99c8a89200d1ea5a55cf7b9c00ffd0d', 'a:4:{i:0;s:1:\"p\";i:1;s:1:\"q\";i:2;s:1:\"b\";i:3;s:1:\"e\";}', 1746403859),
('laravel_cache_captcha_ab26709aeb609803c28e5677197ce9fd', 'a:4:{i:0;s:1:\"9\";i:1;s:1:\"q\";i:2;s:1:\"4\";i:3;s:1:\"g\";}', 1745366948),
('laravel_cache_captcha_ab76372640b45112d9124db0b79ebb4d', 'a:4:{i:0;s:1:\"3\";i:1;s:1:\"a\";i:2;s:1:\"j\";i:3;s:1:\"r\";}', 1745548198),
('laravel_cache_captcha_acc05e975143b27271dca4b9ab74f362', 'a:4:{i:0;s:1:\"j\";i:1;s:1:\"b\";i:2;s:1:\"8\";i:3;s:1:\"8\";}', 1745548203),
('laravel_cache_captcha_ad56e4ef9527468954a3019f0ab1f39f', 'a:4:{i:0;s:1:\"6\";i:1;s:1:\"y\";i:2;s:1:\"j\";i:3;s:1:\"j\";}', 1746587948),
('laravel_cache_captcha_ae779fe92959e5b708b3b85347688e69', 'a:4:{i:0;s:1:\"p\";i:1;s:1:\"e\";i:2;s:1:\"f\";i:3;s:1:\"d\";}', 1745390036),
('laravel_cache_captcha_b1324a1df437380884d4ca11eea86261', 'a:4:{i:0;s:1:\"f\";i:1;s:1:\"n\";i:2;s:1:\"r\";i:3;s:1:\"h\";}', 1746593728),
('laravel_cache_captcha_b6b94b9974c282d54466499d36942ec6', 'a:4:{i:0;s:1:\"q\";i:1;s:1:\"f\";i:2;s:1:\"u\";i:3;s:1:\"x\";}', 1746587002),
('laravel_cache_captcha_b6ca3257da4153a339af291bc44c354f', 'a:4:{i:0;s:1:\"z\";i:1;s:1:\"d\";i:2;s:1:\"2\";i:3;s:1:\"t\";}', 1745548201),
('laravel_cache_captcha_b86e02c4d72351c93afdf8fe613b31ec', 'a:4:{i:0;s:1:\"u\";i:1;s:1:\"n\";i:2;s:1:\"g\";i:3;s:1:\"e\";}', 1745221957),
('laravel_cache_captcha_b8e2b53673f6edf8b46165a4eb078ed5', 'a:4:{i:0;s:1:\"z\";i:1;s:1:\"p\";i:2;s:1:\"q\";i:3;s:1:\"3\";}', 1745384016),
('laravel_cache_captcha_ba953c09d47610c2d62edb178e895de6', 'a:4:{i:0;s:1:\"b\";i:1;s:1:\"c\";i:2;s:1:\"d\";i:3;s:1:\"t\";}', 1746169849),
('laravel_cache_captcha_bd85ca3bf88904ec4c6157afd1348310', 'a:4:{i:0;s:1:\"y\";i:1;s:1:\"n\";i:2;s:1:\"6\";i:3;s:1:\"n\";}', 1745384013),
('laravel_cache_captcha_c871f1d873873b496dd93c30e1867bdd', 'a:4:{i:0;s:1:\"n\";i:1;s:1:\"a\";i:2;s:1:\"e\";i:3;s:1:\"c\";}', 1745798510),
('laravel_cache_captcha_cc721432966f16e0f879d2931d442855', 'a:4:{i:0;s:1:\"n\";i:1;s:1:\"x\";i:2;s:1:\"e\";i:3;s:1:\"e\";}', 1745548199),
('laravel_cache_captcha_d0182fd543343184a82b4132af20d780', 'a:4:{i:0;s:1:\"b\";i:1;s:1:\"4\";i:2;s:1:\"n\";i:3;s:1:\"x\";}', 1746169851),
('laravel_cache_captcha_d11ca416fb48bf515bdcca65c7872a79', 'a:4:{i:0;s:1:\"u\";i:1;s:1:\"t\";i:2;s:1:\"6\";i:3;s:1:\"n\";}', 1745309031),
('laravel_cache_captcha_dfddd2fc6ff3701b5325d897ce8ea177', 'a:4:{i:0;s:1:\"h\";i:1;s:1:\"j\";i:2;s:1:\"f\";i:3;s:1:\"9\";}', 1745384018),
('laravel_cache_captcha_e365a51da3d675371dbbb3af31bfe7c0', 'a:4:{i:0;s:1:\"6\";i:1;s:1:\"j\";i:2;s:1:\"z\";i:3;s:1:\"e\";}', 1745280717),
('laravel_cache_captcha_e877b73dd703bd4973f5feb6d62075f9', 'a:4:{i:0;s:1:\"9\";i:1;s:1:\"2\";i:2;s:1:\"p\";i:3;s:1:\"y\";}', 1745282168),
('laravel_cache_captcha_e8e8eb781e6a0d6309275de41f8b408b', 'a:4:{i:0;s:1:\"d\";i:1;s:1:\"e\";i:2;s:1:\"a\";i:3;s:1:\"j\";}', 1745548175),
('laravel_cache_captcha_ea6dce292862c8fcb671a3f4bdd4191f', 'a:4:{i:0;s:1:\"j\";i:1;s:1:\"y\";i:2;s:1:\"q\";i:3;s:1:\"d\";}', 1745377946),
('laravel_cache_captcha_ec601c5c5d7cb152afed2461161a6be2', 'a:4:{i:0;s:1:\"e\";i:1;s:1:\"e\";i:2;s:1:\"c\";i:3;s:1:\"e\";}', 1746412593),
('laravel_cache_captcha_ed91677cacdc3a9102df075a85045808', 'a:4:{i:0;s:1:\"j\";i:1;s:1:\"e\";i:2;s:1:\"e\";i:3;s:1:\"b\";}', 1745476375),
('laravel_cache_captcha_eee8eedb38fa525a2cbc356cff8598b7', 'a:4:{i:0;s:1:\"h\";i:1;s:1:\"d\";i:2;s:1:\"z\";i:3;s:1:\"u\";}', 1745816689),
('laravel_cache_captcha_f00e832cd6299b6fa03e097b5aabd6b8', 'a:4:{i:0;s:1:\"h\";i:1;s:1:\"f\";i:2;s:1:\"d\";i:3;s:1:\"y\";}', 1746587000),
('laravel_cache_captcha_f2e7b40a63df9a11672c15c8a7536904', 'a:4:{i:0;s:1:\"b\";i:1;s:1:\"9\";i:2;s:1:\"q\";i:3;s:1:\"e\";}', 1745548206),
('laravel_cache_captcha_fbc2d3eda935df113d5d7cae13d7acb9', 'a:4:{i:0;s:1:\"h\";i:1;s:1:\"c\";i:2;s:1:\"r\";i:3;s:1:\"c\";}', 1746169852),
('laravel_cache_captcha_fdca2f2fee99448bf11757d56666ca89', 'a:4:{i:0;s:1:\"p\";i:1;s:1:\"y\";i:2;s:1:\"p\";i:3;s:1:\"u\";}', 1745383875),
('laravel_cache_captcha_fe22639505c26c4c8d28c3332980b5ad', 'a:4:{i:0;s:1:\"z\";i:1;s:1:\"3\";i:2;s:1:\"h\";i:3;s:1:\"c\";}', 1745478427);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keluargas`
--

CREATE TABLE `keluargas` (
  `nip` varchar(20) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `hubungan` enum('Istri','Suami','Anak','Orang Tua','Saudara') NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `status_hidup` enum('Hidup','Meninggal') DEFAULT 'Hidup',
  `pekerjaan` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `keluargas`
--

INSERT INTO `keluargas` (`nip`, `id`, `nama`, `hubungan`, `jenis_kelamin`, `tanggal_lahir`, `status_hidup`, `pekerjaan`, `created_at`, `updated_at`) VALUES
('198501012022011001', 1, 'Sri Wulandari', 'Istri', 'Perempuan', '1980-05-14', 'Hidup', 'Ibu Rumah Tangga', '2025-04-09 23:34:28', '2025-04-09 23:34:28'),
('198911202010090101', 3, 'Putri Aisyah', 'Anak', 'Perempuan', '2008-08-23', 'Hidup', 'Pelajar', '2025-04-09 23:34:28', '2025-04-09 23:34:28'),
('199001152023020201', 4, 'Rina Marlina', 'Istri', 'Perempuan', '1984-09-09', 'Hidup', 'Karyawan Swasta', '2025-04-09 23:34:28', '2025-04-09 23:34:28'),
('199001152023020201', 5, 'Farhan Hakim', 'Anak', 'Laki-laki', '2012-12-30', 'Hidup', 'Pelajar', '2025-04-09 23:34:28', '2025-04-09 23:34:28'),
('199503101987031201', 7, 'Michael', 'Orang Tua', 'Laki-laki', NULL, 'Hidup', 'PNS', '2025-04-20 22:57:44', '2025-04-20 22:57:44'),
('198501012022011001', 9, 'Aco', 'Anak', 'Laki-laki', NULL, 'Hidup', '-', '2025-04-21 18:53:00', '2025-04-21 18:53:00'),
('199503101987031201', 10, 'Michael', 'Anak', 'Laki-laki', NULL, 'Hidup', 'Pelajar', '2025-04-21 19:10:09', '2025-04-21 19:10:09'),
('1000001', 12, 'Michael', 'Anak', 'Laki-laki', NULL, 'Hidup', '-', '2025-04-22 21:33:28', '2025-04-22 21:33:28'),
('1000001', 13, 'fahri', 'Istri', 'Laki-laki', NULL, 'Hidup', 'Polisi', '2025-04-22 21:35:47', '2025-04-22 21:35:47'),
('1000001', 14, 'Michael', 'Anak', 'Laki-laki', NULL, 'Hidup', 'Polisi', '2025-05-06 19:13:20', '2025-05-06 19:13:20');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_14_070851_create_nilai_sekarang_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_sekarang`
--

CREATE TABLE `nilai_sekarang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usia` tinyint(3) UNSIGNED NOT NULL,
  `nilai_sekarang` decimal(10,6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_sekarang`
--

INSERT INTO `nilai_sekarang` (`id`, `usia`, `nilai_sekarang`, `created_at`, `updated_at`) VALUES
(1, 55, '1.000000', NULL, NULL),
(2, 54, '0.959940', NULL, NULL),
(3, 53, '0.886310', NULL, NULL),
(4, 52, '0.818870', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pesertas`
--

CREATE TABLE `pesertas` (
  `nip` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_sk` varchar(50) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tmk` date DEFAULT NULL,
  `tpst` date DEFAULT NULL,
  `kode_peserta` varchar(20) DEFAULT NULL,
  `status_pernikahan` enum('Lajang','Menikah','Duda','Janda') NOT NULL,
  `kode_ptkp` varchar(10) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kelurahan` varchar(50) DEFAULT NULL,
  `kabupaten` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `telpon` varchar(20) DEFAULT NULL,
  `pendidikan` varchar(50) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `golongan` enum('Karyawan','Direktur') NOT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `phdp` decimal(15,2) DEFAULT NULL,
  `akumulasi_ibhp` decimal(15,2) DEFAULT NULL,
  `cabang_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `pesertas`
--

INSERT INTO `pesertas` (`nip`, `nama`, `no_sk`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `tmk`, `tpst`, `kode_peserta`, `status_pernikahan`, `kode_ptkp`, `alamat`, `kelurahan`, `kabupaten`, `kota`, `kode_pos`, `telpon`, `pendidikan`, `jurusan`, `golongan`, `jabatan`, `phdp`, `akumulasi_ibhp`, `cabang_id`, `created_at`, `updated_at`) VALUES
('1000001', 'Andi Saputra', 'SK-009', 'Laki-laki', 'Makassar', '2025-04-23', '2025-04-23', '2025-04-23', 'PST009', 'Menikah', '46456', 'ablam', 'tass', 'Gowa', 'Makassar', '75756', '086436363645', 'S3', 'TI', 'Direktur', 'Staf Administrasi', '9000000.00', '450000000.00', 1, NULL, NULL),
('198501012022011001', 'Andi Saputras', 'SK-001', 'Laki-laki', 'Makassar', '1989-11-20', '2010-09-01', '2040-09-01', 'PST001', 'Menikah', 'PTKP01', 'Jl. Andalas No.10', '90231', 'Gowa', 'Makassar', '901113', '082112345678', 'S1', 'Manajemen', 'Karyawan', 'Manager', '9800000.00', '290000000.00', 1, NULL, '2025-04-20 14:16:39'),
('198911202010090101', 'Fahri Ramadhani', 'SK-005', 'Laki-laki', 'Bulukumba', '1989-11-20', '2010-09-01', '2040-09-01', 'PST005', 'Menikah', 'PTKP02', 'Jl. Perintis Kemerdekaan No.88', '90235', 'Bulukumbas', 'Makassar', '90555', '087788899900', 'S1', 'Teknik Informatika', 'Karyawan', 'IT Support', '7000000.00', '230000000.00', 4, NULL, '2025-04-20 13:48:42'),
('199001152023020201', 'Siti Aminah', 'SK-002', 'Perempuan', 'Bone', '1990-01-15', '2023-02-01', '2048-02-01', 'PST002', 'Menikah', 'PTKP02', 'Jl. Veteran Selatan No.5', '90232', 'Bone', 'Makassars', '90222', '082233344455', 'S2', 'Akuntansi', 'Karyawan', 'Akuntan', '8500000.00', '320000000.00', 2, NULL, '2025-04-20 14:28:15'),
('199503101987031201', 'Dina Marwah', 'SK-004', 'Perempuan', 'Palopo', '1995-03-10', '2021-03-12', '2045-03-12', 'PST004', 'Menikah', 'PTKP01', 'Jl. Cendrawasih No.7', '90234', 'Luwu', 'Palopos', '90444', '085266778899', 'D3', 'Sekretaris', 'Karyawan', 'Staf Administrasi', '9000000.00', '210000000.00', 5, NULL, '2025-04-20 14:26:28'),
('234567', 'anton', 'SK-0011', 'Laki-laki', 'jogjakarta', '2025-06-06', '2025-05-02', '2025-06-07', '3242', 'Lajang', '23432', 'DGFDGDFG', 'Bakung', 'MAKASSAR', 'GOWA', '121212', '908908908908', 'S1', 'SDASDASDAD', 'Direktur', 'IT', '134324234.00', '243234234.00', 3, '2025-05-08 22:32:07', '2025-05-08 22:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `ptkp`
--

CREATE TABLE `ptkp` (
  `id` int(11) NOT NULL,
  `kode_ptkp` varchar(20) NOT NULL,
  `nilai_ptkp` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `ptkp`
--

INSERT INTO `ptkp` (`id`, `kode_ptkp`, `nilai_ptkp`, `created_at`, `updated_at`) VALUES
(1, 'D0', '54000000.00', NULL, '2025-05-14 22:30:10'),
(2, 'D1', '58500000.00', '2025-05-14 22:10:44', '2025-05-14 22:10:44'),
(3, 'D2', '63000000.00', '2025-05-14 22:12:20', '2025-05-14 22:12:20'),
(4, 'D3', '67500000.00', '2025-05-14 22:24:50', '2025-05-14 22:24:50'),
(5, 'J0', '54000000.00', '2025-05-14 22:25:29', '2025-05-14 22:25:29'),
(6, 'J1', '58500000.00', '2025-05-14 22:25:50', '2025-05-14 22:25:50'),
(7, 'J2', '63000000.00', '2025-05-14 22:26:10', '2025-05-14 22:26:10'),
(8, 'J3', '67500000.00', '2025-05-14 22:26:29', '2025-05-14 22:26:29'),
(9, 'K0', '58500000.00', '2025-05-14 22:26:57', '2025-05-14 22:26:57'),
(10, 'K1', '63000000.00', '2025-05-14 22:27:25', '2025-05-14 22:27:25'),
(11, 'K2', '67500000.00', '2025-05-14 22:27:50', '2025-05-14 22:27:50'),
(12, 'K3', '72000000.00', '2025-05-14 22:28:11', '2025-05-14 22:28:11'),
(13, 'TK', '54000000.00', '2025-05-14 22:28:37', '2025-05-14 22:28:37'),
(15, '0', '0.00', '2025-05-14 22:29:48', '2025-05-14 22:29:48');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5UbYp46ZLDTVkdFojSiOjcr2uT9Y87AwpWHNrBmE', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR3RRb1dLZkVoTG1yT3BaZ0RLeWlxRk51NTZCbTQ1STlBbEJ1Z0FGWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9rZXBlc2VydGFhbi1kYXBlbi50ZXN0L2FkbWluL3BhcmFtZXRlci9wdGtwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1747291145);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','supervisor','operator') NOT NULL,
  `login_attempts` int(11) DEFAULT 0,
  `blocked_until` datetime DEFAULT NULL,
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nip`, `name`, `password`, `role`, `login_attempts`, `blocked_until`, `is_blocked`, `created_at`, `updated_at`) VALUES
(1, '123456', 'admin', '$2y$12$83sY/jLkrGQ6CJpzPAmJM.CuhE5sKm3R1OSeJ4yYZ/S8PGqQlvoZy', 'admin', 0, NULL, 0, '2025-03-25 16:48:35', '2025-04-27 21:06:53'),
(2, '234567', 'supervisor', '$2y$12$ePMgBCBohV7wORY1n4t3qe0.xjVwVGtiqL9n69jr2OANFp/lgKszi', 'supervisor', 0, NULL, 0, '2025-03-25 16:48:35', '2025-04-08 22:09:24'),
(3, '345678', 'operator', '$2y$12$/Ge6YiDTqJjS6r5DlWsj/uM/Y0P4hs4gFpVxpMnDNI/83bySfgBnO', 'operator', 0, NULL, 0, '2025-03-25 16:48:35', '2025-04-08 22:09:31'),
(4, '1000001', 'Michael Immanuel Manabung', '$2y$12$wuhdp5NIsDooD598wxD9NOCWUJtB.652pp8cMyta9QXpJ2YON40aG', 'operator', 0, NULL, 0, '2025-04-06 15:52:18', '2025-04-22 22:02:05'),
(5, '222249', 'Reinhart', '$2y$12$SM9598mkR07THnlNt1jucOmMDKfRWTFE7CURkL/zZqfyBsSqChlIe', 'operator', 0, NULL, 0, '2025-04-07 11:28:34', '2025-04-27 22:03:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cabangs`
--
ALTER TABLE `cabangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keluargas`
--
ALTER TABLE `keluargas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_sekarang`
--
ALTER TABLE `nilai_sekarang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesertas`
--
ALTER TABLE `pesertas`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `kode_peserta` (`kode_peserta`),
  ADD KEY `fk_cabang` (`cabang_id`);

--
-- Indexes for table `ptkp`
--
ALTER TABLE `ptkp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `is_blocked` (`is_blocked`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `cabangs`
--
ALTER TABLE `cabangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keluargas`
--
ALTER TABLE `keluargas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai_sekarang`
--
ALTER TABLE `nilai_sekarang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ptkp`
--
ALTER TABLE `ptkp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keluargas`
--
ALTER TABLE `keluargas`
  ADD CONSTRAINT `keluargas_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pesertas` (`nip`) ON DELETE CASCADE;

--
-- Constraints for table `pesertas`
--
ALTER TABLE `pesertas`
  ADD CONSTRAINT `fk_cabang` FOREIGN KEY (`cabang_id`) REFERENCES `cabangs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
