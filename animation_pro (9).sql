-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 07, 2025 at 07:40 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `animation_pro`
--

-- --------------------------------------------------------

--
-- Table structure for table `audios`
--

CREATE TABLE `audios` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `audio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_pinned` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audios`
--

INSERT INTO `audios` (`id`, `image`, `audio`, `user_id`, `created_at`, `updated_at`, `is_pinned`) VALUES
(9, 'storage/images/1746604584_image.jpg', 'storage/audios/1746604584_audio.mp3', 23, '2025-05-07 02:56:24', '2025-05-07 02:56:24', 0),
(10, 'storage/images/1747397186_image.JPG', 'storage/audios/1747397186_audio.mp3', 32, '2025-05-16 07:06:26', '2025-05-16 07:06:26', 0),
(11, 'storage/images/1749548528_image.JPG', 'storage/audios/1749548528_audio.mp3', 24, '2025-06-10 04:42:08', '2025-06-10 04:42:08', 0),
(12, 'storage/images/1749562674_image.png', 'storage/audios/1749562674_audio.mp3', 24, '2025-06-10 08:37:54', '2025-06-10 08:37:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `audio_comments`
--

CREATE TABLE `audio_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `audio_id` bigint UNSIGNED NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audio_comments`
--

INSERT INTO `audio_comments` (`id`, `user_id`, `audio_id`, `comment`, `created_at`, `updated_at`) VALUES
(8, 23, 9, 'woowww', '2025-05-08 05:59:24', '2025-05-08 05:59:24'),
(9, 23, 9, 'owasome dear', '2025-05-31 07:08:05', '2025-05-31 07:08:05'),
(10, 23, 9, 'look good', '2025-06-10 02:46:41', '2025-06-10 02:46:41'),
(12, 24, 11, 'great', '2025-06-10 05:13:10', '2025-06-10 05:13:10'),
(13, 24, 9, 'good one', '2025-06-11 05:28:03', '2025-06-11 05:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `audio_comment_likes`
--

CREATE TABLE `audio_comment_likes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `audio_comment_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audio_comment_replies`
--

CREATE TABLE `audio_comment_replies` (
  `id` bigint UNSIGNED NOT NULL,
  `comment_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `reply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audio_interactions`
--

CREATE TABLE `audio_interactions` (
  `id` bigint UNSIGNED NOT NULL,
  `audio_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `like` int NOT NULL DEFAULT '0',
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audio_interactions`
--

INSERT INTO `audio_interactions` (`id`, `audio_id`, `user_id`, `like`, `comment`, `created_at`, `updated_at`) VALUES
(21, 9, 23, 1, '0', '2025-05-07 02:57:25', '2025-06-17 07:23:49'),
(23, 9, 24, 0, '0', '2025-05-09 07:32:22', '2025-06-17 03:36:25'),
(25, 9, 32, 0, '0', '2025-05-16 06:55:07', '2025-05-16 06:55:09'),
(27, 10, 24, 1, '0', '2025-05-20 02:10:06', '2025-05-20 02:10:06'),
(30, 11, 24, 1, '0', '2025-06-10 04:42:43', '2025-06-10 04:42:43'),
(31, 12, 24, 1, '0', '2025-06-10 09:03:25', '2025-06-10 09:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `audio_pins`
--

CREATE TABLE `audio_pins` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `audio_id` bigint UNSIGNED NOT NULL,
  `is_pinned` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audio_pins`
--

INSERT INTO `audio_pins` (`id`, `user_id`, `audio_id`, `is_pinned`, `created_at`, `updated_at`) VALUES
(1, 23, 9, 0, '2025-05-08 03:08:08', '2025-05-31 06:40:08'),
(8, 32, 9, 1, '2025-05-16 07:08:40', '2025-05-16 07:08:40'),
(12, 23, 10, 0, '2025-05-31 06:40:18', '2025-05-31 06:40:20');

-- --------------------------------------------------------

--
-- Table structure for table `call_logs`
--

CREATE TABLE `call_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `caller_id` bigint UNSIGNED NOT NULL,
  `receiver_id` bigint UNSIGNED NOT NULL,
  `call_type` enum('audio','video') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'missed',
  `duration` int DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `ended_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `call_logs`
--

INSERT INTO `call_logs` (`id`, `caller_id`, `receiver_id`, `call_type`, `status`, `duration`, `started_at`, `ended_at`, `created_at`, `updated_at`) VALUES
(121, 23, 11, 'audio', 'completed', 23, '2025-07-01 14:52:17', '2025-07-01 14:53:15', '2025-07-01 14:52:17', '2025-07-01 14:53:15'),
(122, 23, 11, 'video', 'initiated', NULL, '2025-07-01 14:57:22', NULL, '2025-07-01 14:57:22', '2025-07-01 14:57:22'),
(123, 23, 11, 'audio', 'initiated', NULL, '2025-07-01 15:07:23', NULL, '2025-07-01 15:07:23', '2025-07-01 15:07:23'),
(124, 23, 11, 'audio', 'missed', 9, '2025-07-01 15:08:39', '2025-07-01 15:08:48', '2025-07-01 15:08:39', '2025-07-01 15:08:48'),
(125, 24, 11, 'audio', 'initiated', NULL, '2025-07-01 15:22:12', NULL, '2025-07-01 15:22:12', '2025-07-01 15:22:12'),
(126, 24, 11, 'audio', 'initiated', NULL, '2025-07-01 15:27:17', NULL, '2025-07-01 15:27:17', '2025-07-01 15:27:17'),
(127, 24, 23, 'video', 'initiated', NULL, '2025-07-02 00:43:12', NULL, '2025-07-02 00:43:12', '2025-07-02 00:43:12'),
(128, 24, 23, 'video', 'initiated', NULL, '2025-07-02 00:44:59', NULL, '2025-07-02 00:44:59', '2025-07-02 00:44:59'),
(129, 24, 23, 'video', 'answered', NULL, '2025-07-02 01:00:59', NULL, '2025-07-02 01:00:59', '2025-07-02 01:01:36'),
(130, 24, 23, 'audio', 'missed', 12, '2025-07-02 01:03:08', '2025-07-02 01:03:20', '2025-07-02 01:03:08', '2025-07-02 01:03:20'),
(131, 24, 23, 'video', 'initiated', NULL, '2025-07-02 01:10:16', NULL, '2025-07-02 01:10:16', '2025-07-02 01:10:16'),
(132, 24, 23, 'video', 'initiated', NULL, '2025-07-02 01:13:49', NULL, '2025-07-02 01:13:49', '2025-07-02 01:13:49'),
(133, 24, 23, 'video', 'initiated', NULL, '2025-07-02 01:14:11', NULL, '2025-07-02 01:14:11', '2025-07-02 01:14:11'),
(134, 24, 23, 'video', 'initiated', NULL, '2025-07-02 01:15:10', NULL, '2025-07-02 01:15:10', '2025-07-02 01:15:10'),
(135, 24, 23, 'video', 'initiated', NULL, '2025-07-02 01:17:20', NULL, '2025-07-02 01:17:20', '2025-07-02 01:17:20'),
(136, 24, 23, 'video', 'initiated', NULL, '2025-07-02 01:18:19', NULL, '2025-07-02 01:18:19', '2025-07-02 01:18:19'),
(137, 24, 23, 'video', 'initiated', NULL, '2025-07-02 01:25:12', NULL, '2025-07-02 01:25:12', '2025-07-02 01:25:12'),
(138, 24, 23, 'audio', 'initiated', NULL, '2025-07-02 01:49:57', NULL, '2025-07-02 01:49:57', '2025-07-02 01:49:57'),
(139, 24, 23, 'audio', 'initiated', NULL, '2025-07-02 01:53:24', NULL, '2025-07-02 01:53:24', '2025-07-02 01:53:24'),
(140, 24, 23, 'video', 'initiated', NULL, '2025-07-02 01:54:34', NULL, '2025-07-02 01:54:34', '2025-07-02 01:54:34'),
(141, 24, 23, 'audio', 'initiated', NULL, '2025-07-02 02:06:38', NULL, '2025-07-02 02:06:38', '2025-07-02 02:06:38'),
(142, 24, 23, 'video', 'initiated', NULL, '2025-07-02 02:08:59', NULL, '2025-07-02 02:08:59', '2025-07-02 02:08:59'),
(143, 24, 23, 'audio', 'initiated', NULL, '2025-07-02 02:20:00', NULL, '2025-07-02 02:20:00', '2025-07-02 02:20:00'),
(144, 24, 23, 'video', 'initiated', NULL, '2025-07-02 02:20:38', NULL, '2025-07-02 02:20:38', '2025-07-02 02:20:38'),
(145, 23, 24, 'audio', 'initiated', NULL, '2025-07-02 02:47:02', NULL, '2025-07-02 02:47:02', '2025-07-02 02:47:02'),
(146, 23, 24, 'audio', 'initiated', NULL, '2025-07-02 02:57:40', NULL, '2025-07-02 02:57:40', '2025-07-02 02:57:40'),
(147, 23, 24, 'audio', 'initiated', NULL, '2025-07-02 03:01:51', NULL, '2025-07-02 03:01:51', '2025-07-02 03:01:51'),
(148, 23, 24, 'audio', 'initiated', NULL, '2025-07-02 03:07:12', NULL, '2025-07-02 03:07:12', '2025-07-02 03:07:12'),
(149, 23, 24, 'audio', 'initiated', NULL, '2025-07-02 03:13:29', NULL, '2025-07-02 03:13:29', '2025-07-02 03:13:29'),
(150, 23, 24, 'audio', 'answered', NULL, '2025-07-02 03:42:42', NULL, '2025-07-02 03:42:42', '2025-07-02 03:44:33'),
(151, 23, 24, 'video', 'initiated', NULL, '2025-07-02 04:03:57', NULL, '2025-07-02 04:03:57', '2025-07-02 04:03:57'),
(152, 23, 24, 'video', 'initiated', NULL, '2025-07-02 04:07:03', NULL, '2025-07-02 04:07:03', '2025-07-02 04:07:03'),
(153, 11, 23, 'video', 'initiated', NULL, '2025-07-02 04:29:22', NULL, '2025-07-02 04:29:22', '2025-07-02 04:29:22'),
(154, 11, 23, 'audio', 'missed', 18, '2025-07-02 04:29:54', '2025-07-02 04:30:12', '2025-07-02 04:29:54', '2025-07-02 04:30:12'),
(155, 11, 23, 'audio', 'initiated', NULL, '2025-07-02 04:30:27', NULL, '2025-07-02 04:30:27', '2025-07-02 04:30:27'),
(156, 11, 23, 'audio', 'completed', 25, '2025-07-02 04:31:07', '2025-07-02 04:31:33', '2025-07-02 04:31:07', '2025-07-02 04:31:33'),
(157, 11, 24, 'audio', 'missed', 1, '2025-07-02 04:31:53', '2025-07-02 04:31:58', '2025-07-02 04:31:53', '2025-07-02 04:31:58'),
(158, 11, 23, 'audio', 'completed', 15, '2025-07-02 04:32:14', '2025-07-02 04:32:39', '2025-07-02 04:32:14', '2025-07-02 04:32:39'),
(159, 11, 24, 'audio', 'missed', 4, '2025-07-02 04:40:43', '2025-07-02 04:40:47', '2025-07-02 04:40:43', '2025-07-02 04:40:47'),
(160, 11, 23, 'audio', 'completed', 71, '2025-07-02 04:41:33', '2025-07-02 04:43:00', '2025-07-02 04:41:33', '2025-07-02 04:43:00'),
(161, 11, 23, 'audio', 'completed', 26, '2025-07-02 04:43:19', '2025-07-02 04:43:45', '2025-07-02 04:43:19', '2025-07-02 04:43:45'),
(162, 11, 23, 'audio', 'completed', 23, '2025-07-02 04:46:55', '2025-07-02 04:47:41', '2025-07-02 04:46:55', '2025-07-02 04:47:41'),
(163, 11, 23, 'audio', 'completed', 16, '2025-07-02 04:51:06', '2025-07-02 04:51:41', '2025-07-02 04:51:06', '2025-07-02 04:51:41'),
(164, 23, 11, 'audio', 'completed', 59, '2025-07-02 05:06:38', '2025-07-02 05:07:37', '2025-07-02 05:06:38', '2025-07-02 05:07:37'),
(165, 11, 23, 'audio', 'completed', 53, '2025-07-02 05:25:52', '2025-07-02 05:27:11', '2025-07-02 05:25:52', '2025-07-02 05:27:11'),
(166, 23, 24, 'audio', 'answered', NULL, '2025-07-02 05:40:55', NULL, '2025-07-02 05:40:55', '2025-07-02 05:41:31'),
(167, 24, 23, 'audio', 'initiated', NULL, '2025-07-02 06:30:52', NULL, '2025-07-02 06:30:52', '2025-07-02 06:30:52'),
(168, 24, 23, 'audio', 'answered', NULL, '2025-07-02 06:32:21', NULL, '2025-07-02 06:32:21', '2025-07-02 06:32:45'),
(169, 24, 23, 'audio', 'initiated', NULL, '2025-07-02 06:40:53', NULL, '2025-07-02 06:40:53', '2025-07-02 06:40:53'),
(170, 24, 23, 'audio', 'initiated', NULL, '2025-07-02 06:42:37', NULL, '2025-07-02 06:42:37', '2025-07-02 06:42:37'),
(171, 23, 24, 'audio', 'initiated', NULL, '2025-07-02 06:59:12', NULL, '2025-07-02 06:59:12', '2025-07-02 06:59:12'),
(172, 23, 24, 'audio', 'answered', NULL, '2025-07-02 07:02:40', NULL, '2025-07-02 07:02:40', '2025-07-02 07:03:15'),
(173, 24, 23, 'audio', 'initiated', NULL, '2025-07-02 07:05:22', NULL, '2025-07-02 07:05:22', '2025-07-02 07:05:22'),
(174, 24, 11, 'audio', 'initiated', NULL, '2025-07-02 07:20:01', NULL, '2025-07-02 07:20:01', '2025-07-02 07:20:01'),
(175, 23, 11, 'audio', 'initiated', NULL, '2025-07-02 07:24:02', NULL, '2025-07-02 07:24:02', '2025-07-02 07:24:02'),
(176, 23, 11, 'audio', 'initiated', NULL, '2025-07-02 07:24:14', NULL, '2025-07-02 07:24:14', '2025-07-02 07:24:14'),
(177, 23, 11, 'audio', 'initiated', NULL, '2025-07-02 07:25:23', NULL, '2025-07-02 07:25:23', '2025-07-02 07:25:23'),
(178, 23, 11, 'audio', 'initiated', NULL, '2025-07-02 07:40:06', NULL, '2025-07-02 07:40:06', '2025-07-02 07:40:06'),
(179, 23, 11, 'audio', 'initiated', NULL, '2025-07-02 07:40:42', NULL, '2025-07-02 07:40:42', '2025-07-02 07:40:42'),
(180, 23, 11, 'audio', 'initiated', NULL, '2025-07-02 07:41:46', NULL, '2025-07-02 07:41:46', '2025-07-02 07:41:46'),
(181, 24, 11, 'audio', 'initiated', NULL, '2025-07-02 13:48:49', NULL, '2025-07-02 13:48:49', '2025-07-02 13:48:49'),
(182, 24, 11, 'audio', 'initiated', NULL, '2025-07-02 13:50:02', NULL, '2025-07-02 13:50:02', '2025-07-02 13:50:02'),
(183, 24, 11, 'video', 'initiated', NULL, '2025-07-02 13:52:26', NULL, '2025-07-02 13:52:26', '2025-07-02 13:52:26'),
(184, 24, 11, 'video', 'answered', NULL, '2025-07-02 14:08:57', NULL, '2025-07-02 14:08:57', '2025-07-02 14:09:33'),
(185, 24, 11, 'audio', 'answered', NULL, '2025-07-02 14:10:40', NULL, '2025-07-02 14:10:40', '2025-07-02 14:11:07'),
(186, 24, 11, 'audio', 'initiated', NULL, '2025-07-02 14:13:10', NULL, '2025-07-02 14:13:10', '2025-07-02 14:13:10'),
(187, 24, 11, 'video', 'answered', NULL, '2025-07-02 14:14:24', NULL, '2025-07-02 14:14:24', '2025-07-02 14:15:33'),
(188, 24, 11, 'audio', 'answered', NULL, '2025-07-02 14:35:35', NULL, '2025-07-02 14:35:35', '2025-07-02 14:36:03'),
(189, 24, 11, 'audio', 'initiated', NULL, '2025-07-02 14:36:45', NULL, '2025-07-02 14:36:45', '2025-07-02 14:36:45'),
(190, 24, 11, 'audio', 'answered', NULL, '2025-07-02 15:12:13', NULL, '2025-07-02 15:12:13', '2025-07-02 15:12:34'),
(191, 24, 11, 'audio', 'initiated', NULL, '2025-07-02 15:14:23', NULL, '2025-07-02 15:14:23', '2025-07-02 15:14:23'),
(192, 24, 23, 'audio', 'initiated', NULL, '2025-07-02 15:36:25', NULL, '2025-07-02 15:36:25', '2025-07-02 15:36:25'),
(193, 24, 23, 'audio', 'initiated', NULL, '2025-07-02 15:37:01', NULL, '2025-07-02 15:37:01', '2025-07-02 15:37:01'),
(194, 24, 11, 'audio', 'initiated', NULL, '2025-07-02 15:37:07', NULL, '2025-07-02 15:37:07', '2025-07-02 15:37:07'),
(195, 24, 11, 'audio', 'initiated', NULL, '2025-07-02 15:37:51', NULL, '2025-07-02 15:37:51', '2025-07-02 15:37:51'),
(196, 24, 11, 'video', 'initiated', NULL, '2025-07-02 15:39:29', NULL, '2025-07-02 15:39:29', '2025-07-02 15:39:29'),
(197, 24, 11, 'audio', 'initiated', NULL, '2025-07-02 15:45:10', NULL, '2025-07-02 15:45:10', '2025-07-02 15:45:10'),
(198, 24, 11, 'audio', 'initiated', NULL, '2025-07-02 15:53:56', NULL, '2025-07-02 15:53:56', '2025-07-02 15:53:56'),
(199, 24, 11, 'audio', 'missed', 12, '2025-07-02 16:00:23', '2025-07-02 16:00:36', '2025-07-02 16:00:23', '2025-07-02 16:00:36'),
(200, 24, 23, 'audio', 'missed', 63, '2025-07-03 06:41:59', '2025-07-03 06:43:02', '2025-07-03 06:41:59', '2025-07-03 06:43:02'),
(201, 24, 23, 'audio', 'missed', 20, '2025-07-03 06:45:39', '2025-07-03 06:45:59', '2025-07-03 06:45:39', '2025-07-03 06:45:59'),
(202, 24, 23, 'audio', 'completed', 21, '2025-07-03 06:46:39', '2025-07-03 06:47:16', '2025-07-03 06:46:39', '2025-07-03 06:47:16'),
(203, 24, 23, 'video', 'initiated', NULL, '2025-07-03 06:49:13', NULL, '2025-07-03 06:49:13', '2025-07-03 06:49:13'),
(204, 24, 23, 'video', 'initiated', NULL, '2025-07-03 06:56:43', NULL, '2025-07-03 06:56:43', '2025-07-03 06:56:43'),
(205, 24, 23, 'video', 'initiated', NULL, '2025-07-03 07:41:51', NULL, '2025-07-03 07:41:51', '2025-07-03 07:41:51'),
(206, 24, 23, 'video', 'initiated', NULL, '2025-07-03 07:48:11', NULL, '2025-07-03 07:48:11', '2025-07-03 07:48:11'),
(207, 24, 23, 'video', 'initiated', NULL, '2025-07-03 07:50:11', NULL, '2025-07-03 07:50:11', '2025-07-03 07:50:11'),
(208, 24, 23, 'video', 'initiated', NULL, '2025-07-03 08:02:53', NULL, '2025-07-03 08:02:53', '2025-07-03 08:02:53'),
(209, 24, 23, 'audio', 'missed', 42, '2025-07-03 08:21:33', '2025-07-03 08:22:11', '2025-07-03 08:21:33', '2025-07-03 08:22:11'),
(210, 24, 11, 'audio', 'missed', 15, '2025-07-03 08:33:55', '2025-07-03 08:34:09', '2025-07-03 08:33:55', '2025-07-03 08:34:09'),
(211, 24, 11, 'audio', 'missed', 31, '2025-07-03 08:35:11', '2025-07-03 08:35:42', '2025-07-03 08:35:11', '2025-07-03 08:35:42'),
(212, 11, 24, 'audio', 'missed', 15, '2025-07-03 08:39:31', '2025-07-03 08:39:46', '2025-07-03 08:39:31', '2025-07-03 08:39:46'),
(213, 23, 24, 'audio', 'completed', 79, '2025-07-05 17:04:46', '2025-07-05 17:05:57', '2025-07-05 17:04:46', '2025-07-05 17:05:57'),
(214, 24, 23, 'audio', 'missed', 19, '2025-07-05 17:08:11', '2025-07-05 17:08:30', '2025-07-05 17:08:11', '2025-07-05 17:08:30'),
(215, 24, 23, 'video', 'completed', 39, '2025-07-05 17:08:54', '2025-07-05 17:10:07', '2025-07-05 17:08:54', '2025-07-05 17:10:07'),
(216, 23, 24, 'video', 'missed', 2, '2025-07-05 17:10:26', '2025-07-05 17:10:31', '2025-07-05 17:10:26', '2025-07-05 17:10:31'),
(217, 24, 23, 'video', 'missed', 1, '2025-07-05 17:20:51', '2025-07-05 17:20:55', '2025-07-05 17:20:51', '2025-07-05 17:20:55'),
(218, 24, 11, 'video', 'answered', NULL, '2025-07-05 17:21:36', NULL, '2025-07-05 17:21:36', '2025-07-05 17:21:57'),
(219, 24, 11, 'video', 'missed', 12, '2025-07-05 17:22:43', '2025-07-05 17:22:55', '2025-07-05 17:22:43', '2025-07-05 17:22:55'),
(220, 24, 11, 'video', 'missed', 50, '2025-07-05 17:23:14', '2025-07-05 17:24:04', '2025-07-05 17:23:14', '2025-07-05 17:24:04'),
(221, 11, 24, 'video', 'answered', NULL, '2025-07-05 17:25:35', NULL, '2025-07-05 17:25:35', '2025-07-05 17:26:22'),
(222, 11, 24, 'video', 'initiated', NULL, '2025-07-05 17:28:52', NULL, '2025-07-05 17:28:52', '2025-07-05 17:28:52'),
(223, 24, 11, 'video', 'completed', 69, '2025-07-05 17:29:48', '2025-07-05 17:30:58', '2025-07-05 17:29:48', '2025-07-05 17:30:58'),
(224, 24, 11, 'audio', 'completed', 37, '2025-07-05 17:33:30', '2025-07-05 17:34:37', '2025-07-05 17:33:30', '2025-07-05 17:34:37'),
(225, 24, 11, 'audio', 'completed', 62, '2025-07-05 17:39:03', '2025-07-05 17:40:05', '2025-07-05 17:39:03', '2025-07-05 17:40:05'),
(226, 24, 11, 'audio', 'missed', 14, '2025-07-05 17:40:34', '2025-07-05 17:40:48', '2025-07-05 17:40:34', '2025-07-05 17:40:48'),
(227, 24, 11, 'audio', 'completed', 88, '2025-07-05 17:41:02', '2025-07-05 17:42:30', '2025-07-05 17:41:02', '2025-07-05 17:42:30'),
(228, 11, 24, 'audio', 'completed', 24, '2025-07-05 17:43:01', '2025-07-05 17:43:50', '2025-07-05 17:43:01', '2025-07-05 17:43:50'),
(229, 11, 23, 'audio', 'completed', 30, '2025-07-05 17:47:35', '2025-07-05 17:48:35', '2025-07-05 17:47:35', '2025-07-05 17:48:35'),
(230, 11, 23, 'video', 'completed', 58, '2025-07-05 17:49:07', '2025-07-05 17:50:06', '2025-07-05 17:49:07', '2025-07-05 17:50:06'),
(231, 24, 11, 'audio', 'missed', 27, '2025-07-06 15:47:11', '2025-07-06 15:47:33', '2025-07-06 15:47:11', '2025-07-06 15:47:33'),
(232, 24, 11, 'audio', 'missed', 9, '2025-07-06 15:47:45', '2025-07-06 15:47:54', '2025-07-06 15:47:45', '2025-07-06 15:47:54'),
(233, 24, 11, 'audio', 'completed', 23, '2025-07-06 15:48:06', '2025-07-06 15:48:30', '2025-07-06 15:48:06', '2025-07-06 15:48:30'),
(234, 24, 11, 'video', 'initiated', NULL, '2025-07-06 15:49:18', NULL, '2025-07-06 15:49:18', '2025-07-06 15:49:18'),
(235, 24, 11, 'video', 'answered', NULL, '2025-07-06 15:50:39', NULL, '2025-07-06 15:50:39', '2025-07-06 15:50:53'),
(236, 24, 11, 'video', 'initiated', NULL, '2025-07-06 15:54:54', NULL, '2025-07-06 15:54:54', '2025-07-06 15:54:54'),
(237, 11, 24, 'video', 'initiated', NULL, '2025-07-06 16:01:37', NULL, '2025-07-06 16:01:37', '2025-07-06 16:01:37'),
(238, 11, 24, 'video', 'initiated', NULL, '2025-07-06 16:04:16', NULL, '2025-07-06 16:04:16', '2025-07-06 16:04:16'),
(239, 23, 11, 'video', 'initiated', NULL, '2025-07-06 16:12:15', NULL, '2025-07-06 16:12:15', '2025-07-06 16:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `comment_likes`
--

CREATE TABLE `comment_likes` (
  `id` bigint UNSIGNED NOT NULL,
  `comment_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment_likes`
--

INSERT INTO `comment_likes` (`id`, `comment_id`, `user_id`, `created_at`, `updated_at`) VALUES
(8, 11, 24, '2025-04-25 12:37:02', '2025-04-25 12:37:02'),
(22, 16, 24, '2025-04-25 14:17:05', '2025-04-25 14:17:05'),
(23, 14, 24, '2025-04-25 14:29:09', '2025-04-25 14:29:09'),
(36, 13, 23, '2025-04-26 13:44:17', '2025-04-26 13:44:17'),
(37, 11, 25, '2025-04-29 04:01:48', '2025-04-29 04:01:48');

-- --------------------------------------------------------

--
-- Table structure for table `comment_replies`
--

CREATE TABLE `comment_replies` (
  `id` bigint UNSIGNED NOT NULL,
  `comment_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `reply_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment_replies`
--

INSERT INTO `comment_replies` (`id`, `comment_id`, `user_id`, `reply_text`, `created_at`, `updated_at`) VALUES
(1, 13, 23, 'thnks', '2025-04-24 05:13:32', '2025-04-24 05:13:32'),
(2, 13, 23, 'well said', '2025-04-24 07:57:35', '2025-04-24 07:57:35'),
(5, 13, 23, 'wow great', '2025-04-24 08:30:08', '2025-04-24 08:30:08'),
(6, 11, 24, 'thanks buddy', '2025-04-24 08:33:06', '2025-04-24 08:33:06'),
(7, 14, 24, 'love ittt', '2025-04-24 08:40:46', '2025-04-24 08:40:46'),
(8, 11, 24, 'it\'ss good', '2025-04-24 08:55:49', '2025-04-24 08:55:49'),
(9, 13, 23, 'okkkkkk', '2025-04-24 09:05:57', '2025-04-24 09:05:57'),
(11, 16, 11, 'me to love animals', '2025-04-24 11:09:51', '2025-04-24 11:09:51'),
(12, 16, 11, 'me to love animals', '2025-04-24 11:09:51', '2025-04-24 11:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `video_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `video_id`, `created_at`, `updated_at`) VALUES
(12, 25, 8, '2025-04-29 03:56:10', '2025-04-29 03:56:10'),
(15, 23, 11, '2025-05-01 02:34:47', '2025-05-01 02:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `friendships`
--

CREATE TABLE `friendships` (
  `id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `receiver_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','accepted','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friendships`
--

INSERT INTO `friendships` (`id`, `sender_id`, `receiver_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 23, 24, 'accepted', '2025-05-14 05:47:15', '2025-05-14 06:38:08'),
(3, 23, 32, 'accepted', '2025-05-14 07:44:46', '2025-05-22 05:13:34'),
(6, 24, 11, 'accepted', '2025-06-06 04:53:08', '2025-06-06 05:10:17');

-- --------------------------------------------------------

--
-- Table structure for table `like_stills`
--

CREATE TABLE `like_stills` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `still_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `like_stills`
--

INSERT INTO `like_stills` (`id`, `user_id`, `still_id`, `created_at`, `updated_at`) VALUES
(47, 24, 43, '2025-06-14 00:52:22', '2025-06-14 00:52:22'),
(52, 24, 45, '2025-06-14 04:58:05', '2025-06-14 04:58:05'),
(53, 23, 46, '2025-06-14 05:20:52', '2025-06-14 05:20:52'),
(54, 23, 47, '2025-06-17 08:04:08', '2025-06-17 08:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `like_text_frame`
--

CREATE TABLE `like_text_frame` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `text_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `like_text_frame`
--

INSERT INTO `like_text_frame` (`id`, `user_id`, `text_id`, `created_at`, `updated_at`) VALUES
(19, 23, 91, '2025-06-14 07:03:31', '2025-06-14 07:03:31'),
(20, 23, 90, '2025-06-16 23:54:40', '2025-06-16 23:54:40'),
(21, 23, 93, '2025-06-17 02:39:16', '2025-06-17 02:39:16'),
(23, 24, 93, '2025-06-17 03:36:42', '2025-06-17 03:36:42'),
(25, 24, 96, '2025-06-17 07:55:51', '2025-06-17 07:55:51'),
(26, 23, 97, '2025-06-17 07:57:14', '2025-06-17 07:57:14'),
(27, 23, 98, '2025-06-17 08:06:24', '2025-06-17 08:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `receiver_id` bigint UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`, `updated_at`) VALUES
(37, 11, 24, 'hi dear', '2025-05-26 07:00:10', '2025-05-26 07:00:10'),
(38, 24, 11, 'hi my dear', '2025-05-26 07:00:23', '2025-05-26 07:00:23'),
(39, 24, 11, 'hi', '2025-05-26 07:10:34', '2025-05-26 07:10:34'),
(40, 11, 24, 'g kese ho', '2025-05-26 07:11:23', '2025-05-26 07:11:23'),
(41, 24, 11, 'men theak ap kese ho ?', '2025-05-26 07:11:40', '2025-05-26 07:11:40'),
(42, 11, 24, 'men bhe theak hun', '2025-05-26 07:33:50', '2025-05-26 07:33:50'),
(43, 24, 11, 'kahan ho kia kr rhe ho ?', '2025-05-26 07:34:09', '2025-05-26 07:34:09'),
(44, 24, 11, 'hello', '2025-05-26 08:21:08', '2025-05-26 08:21:08'),
(45, 11, 24, 'where are you', '2025-05-26 08:21:24', '2025-05-26 08:21:24'),
(46, 24, 11, 'i am at home', '2025-05-26 08:21:39', '2025-05-26 08:21:39'),
(47, 11, 24, 'oky', '2025-05-26 08:21:47', '2025-05-26 08:21:47'),
(48, 24, 11, 'hhhh', '2025-05-26 09:13:55', '2025-05-26 09:13:55'),
(49, 23, 24, 'hi atif', '2025-05-26 09:15:42', '2025-05-26 09:15:42'),
(50, 24, 23, 'hi siraj', '2025-05-26 09:17:09', '2025-05-26 09:17:09'),
(51, 23, 24, 'hello how are you', '2025-05-26 09:28:06', '2025-05-26 09:28:06'),
(52, 24, 11, 'han', '2025-05-26 09:51:53', '2025-05-26 09:51:53'),
(53, 11, 24, 'kia', '2025-05-26 09:54:11', '2025-05-26 09:54:11'),
(54, 11, 23, 'hello', '2025-05-27 00:59:00', '2025-05-27 00:59:00'),
(55, 23, 11, 'yes', '2025-05-27 00:59:32', '2025-05-27 00:59:32'),
(56, 11, 23, 'good morning', '2025-05-27 01:00:22', '2025-05-27 01:00:22'),
(57, 23, 11, 'Good morning bro', '2025-05-27 01:00:46', '2025-05-27 01:00:46'),
(58, 11, 23, 'how is going your life bro', '2025-05-27 01:17:02', '2025-05-27 01:17:02'),
(59, 23, 11, 'ahh it going good', '2025-05-27 01:26:17', '2025-05-27 01:26:17'),
(60, 24, 23, 'men theak hun siraj', '2025-05-27 05:25:36', '2025-05-27 05:25:36'),
(61, 24, 23, 'bohat acha laga sun ke', '2025-05-27 05:56:27', '2025-05-27 05:56:27'),
(62, 23, 24, 'shukriya bhai', '2025-05-27 05:58:33', '2025-05-27 05:58:33'),
(63, 24, 23, 'hi', '2025-05-27 06:40:38', '2025-05-27 06:40:38'),
(64, 24, 11, 'hi there', '2025-05-28 02:38:00', '2025-05-28 02:38:00'),
(65, 11, 24, 'han dear', '2025-05-28 02:39:05', '2025-05-28 02:39:05'),
(66, 24, 11, 'kahan hp', '2025-05-28 03:07:05', '2025-05-28 03:07:05'),
(67, 11, 24, 'hi there', '2025-05-28 06:21:54', '2025-05-28 06:21:54'),
(68, 24, 11, 'hello dear', '2025-05-28 06:22:11', '2025-05-28 06:22:11'),
(69, 11, 24, 'how are you', '2025-05-28 06:22:32', '2025-05-28 06:22:32'),
(70, 24, 11, 'hi', '2025-05-28 07:31:34', '2025-05-28 07:31:34'),
(71, 11, 24, 'h r u', '2025-05-28 07:32:00', '2025-05-28 07:32:00'),
(72, 24, 11, 'kahan ho', '2025-05-28 07:32:07', '2025-05-28 07:32:07'),
(73, 23, 24, 'hi this is 29/5/25', '2025-05-29 06:40:24', '2025-05-29 06:40:24'),
(74, 23, 11, 'hello dear', '2025-05-29 07:06:48', '2025-05-29 07:06:48'),
(75, 23, 11, 'check this now', '2025-05-29 07:12:42', '2025-05-29 07:12:42'),
(76, 11, 23, 'oky dear', '2025-05-30 00:27:10', '2025-05-30 00:27:10'),
(77, 23, 11, 'hello', '2025-05-30 00:44:37', '2025-05-30 00:44:37'),
(78, 11, 23, 'good morning', '2025-05-30 00:49:54', '2025-05-30 00:49:54'),
(79, 24, 23, 'yeah checked', '2025-05-30 01:43:14', '2025-05-30 01:43:14'),
(80, 11, 24, 'men ghr', '2025-05-30 01:44:28', '2025-05-30 01:44:28'),
(81, 24, 11, 'acha ok', '2025-05-30 01:46:56', '2025-05-30 01:46:56'),
(82, 24, 11, 'what are you doing ?', '2025-05-30 05:12:58', '2025-05-30 05:12:58'),
(83, 11, 24, 'nothing just doing my job', '2025-05-30 05:13:50', '2025-05-30 05:13:50'),
(84, 24, 11, 'oh that\'s great', '2025-05-30 05:15:38', '2025-05-30 05:15:38'),
(85, 11, 24, 'what about you ?', '2025-05-30 05:16:07', '2025-05-30 05:16:07'),
(86, 24, 11, 'yeah me also now a days too much busy here', '2025-05-30 05:25:32', '2025-05-30 05:25:32'),
(87, 23, 24, 'hey', '2025-06-05 05:16:16', '2025-06-05 05:16:16'),
(88, 23, 24, 'hello', '2025-06-05 05:23:51', '2025-06-05 05:23:51'),
(89, 23, 24, 'hello', '2025-06-05 05:24:02', '2025-06-05 05:24:02'),
(90, 23, 24, 'hello', '2025-06-05 05:24:03', '2025-06-05 05:24:03'),
(91, 23, 24, 'hello', '2025-06-05 05:24:04', '2025-06-05 05:24:04'),
(92, 23, 24, 'hello', '2025-06-05 05:24:05', '2025-06-05 05:24:05'),
(93, 23, 24, 'hello', '2025-06-05 05:24:06', '2025-06-05 05:24:06'),
(94, 23, 24, 'hello', '2025-06-05 05:24:09', '2025-06-05 05:24:09'),
(95, 23, 24, 'hello', '2025-06-05 05:24:10', '2025-06-05 05:24:10'),
(96, 23, 24, 'hello', '2025-06-05 05:24:12', '2025-06-05 05:24:12'),
(97, 23, 24, 'hello', '2025-06-05 05:24:13', '2025-06-05 05:24:13'),
(98, 23, 24, 'hello', '2025-06-05 05:24:14', '2025-06-05 05:24:14'),
(99, 23, 24, 'hello', '2025-06-05 05:24:15', '2025-06-05 05:24:15'),
(100, 23, 24, 'hello', '2025-06-05 05:24:15', '2025-06-05 05:24:15'),
(101, 23, 24, 'hello', '2025-06-05 05:24:16', '2025-06-05 05:24:16'),
(102, 23, 24, 'hello', '2025-06-05 05:24:17', '2025-06-05 05:24:17'),
(103, 23, 24, 'hello', '2025-06-05 05:24:17', '2025-06-05 05:24:17'),
(104, 23, 24, 'hello', '2025-06-05 05:24:18', '2025-06-05 05:24:18'),
(105, 23, 24, 'hello', '2025-06-05 05:24:18', '2025-06-05 05:24:18'),
(106, 23, 24, 'hello', '2025-06-05 05:24:19', '2025-06-05 05:24:19'),
(107, 24, 23, 'yes', '2025-06-05 05:36:18', '2025-06-05 05:36:18'),
(108, 23, 24, 'hi there', '2025-06-05 06:02:19', '2025-06-05 06:02:19'),
(109, 24, 23, 'yes', '2025-06-05 06:02:47', '2025-06-05 06:02:47'),
(110, 23, 11, 'hello', '2025-06-28 01:38:39', '2025-06-28 01:38:39'),
(111, 11, 23, 'how  are you bro', '2025-06-28 01:43:41', '2025-06-28 01:43:41'),
(112, 11, 23, 'i m good bro', '2025-06-28 02:02:13', '2025-06-28 02:02:13'),
(113, 23, 11, 'hi', '2025-06-28 02:03:17', '2025-06-28 02:03:17'),
(114, 11, 23, 'HEY CHECK NOW', '2025-06-28 02:27:42', '2025-06-28 02:27:42'),
(115, 24, 23, 'hello', '2025-06-28 06:47:49', '2025-06-28 06:47:49'),
(116, 23, 24, 'yes', '2025-06-28 06:49:01', '2025-06-28 06:49:01'),
(117, 11, 24, 'hi', '2025-06-28 08:39:22', '2025-06-28 08:39:22'),
(118, 24, 11, 'hello tester', '2025-06-28 13:51:23', '2025-06-28 13:51:23'),
(119, 11, 24, 'yes it is working', '2025-06-29 04:22:42', '2025-06-29 04:22:42'),
(120, 23, 11, 'hello', '2025-07-01 03:10:15', '2025-07-01 03:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_04_08_121110_create_videos_table', 2),
(7, '2025_04_08_134610_add_cover_image_to_users_table', 3),
(10, '2025_04_18_073234_create_audios_table', 5),
(11, '2025_04_18_122931_create_stills_table', 6),
(12, '2025_04_19_122213_create_text_in_frame_table', 7),
(13, '2025_04_17_122547_create_video_likes_table', 8),
(15, '2025_04_22_080000_create_video_comments_table', 9),
(17, '2025_04_24_085422_create__comment_reply_table', 10),
(18, '2025_04_25_123935_create_comment_likes_table', 11),
(19, '2025_04_26_181026_create_favourites_table', 12),
(20, '2025_04_28_093746_add_profile_picture_to_users_table', 13),
(21, '2025_05_01_145944_create_audio_interactions_table', 14),
(25, '2025_05_04_191255_create_audio_comments_table', 18),
(26, '2025_05_04_193844_create_audio_comment_replies_table', 19),
(30, '2025_05_05_062149_create_audio_comment_likes_table', 20),
(31, '2025_05_07_091032_add_is_pinned_to_audios_table', 21),
(32, '2025_05_07_102111_create__like_stills_table', 22),
(33, '2025_05_07_114528_create_still_comments_table', 23),
(34, '2025_05_07_124148_add_is_pinned_to_stills_table', 24),
(35, '2025_05_08_062334_create_audio_pins_table', 25),
(36, '2025_05_08_062505_create_still_pins_table', 26),
(37, '2025_05_08_062646_create_text_pins_table', 27),
(38, '2025_05_08_114501_create_like_text_frame_table', 28),
(39, '2025_05_08_114751_create_text_frame_comments_table', 29),
(40, '2025_05_09_145858_add_username_to_users_table', 30),
(41, '2025_05_13_061552_add_id_card_to_users_table', 31),
(42, '2025_05_14_075433_create_friendships_table', 32),
(43, '2025_05_15_081643_add_privacy_to_users_table', 33),
(44, '2025_05_23_064313_create_messages_table', 34),
(45, '2025_05_30_130007_add_new_profile_fields_to_users_table', 35),
(46, '2025_06_04_121737_create_calls_data_table', 36),
(47, '2025_06_13_082821_add_description_to_stills_table', 37),
(48, '2025_06_18_205047_create_calls_table', 38),
(49, '2025_06_26_111553_create_video_call_recordings_table', 39),
(50, '2025_06_27_080426_add_ringtone_to_users_table', 40),
(51, '2025_06_28_082456_create_call_logs_table', 41),
(52, '2025_07_03_174159_add_is_live_to_users_table', 42),
(53, '2025_07_04_102130_create_live_streamings_table', 43),
(54, '2025_07_05_105353_create_notifications_table', 44);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('04d29e1f-dfa9-47ff-a388-0102ee0fbe6d', 'App\\Notifications\\ViewerJoinedNotification', 'App\\Models\\User', 24, '{\"message\":\"atif raza has joined your stream.\"}', NULL, '2025-07-05 16:06:07', '2025-07-05 16:06:07'),
('0e191692-83d7-4d4a-baca-061444205d27', 'App\\Notifications\\ViewerJoinedNotification', 'App\\Models\\User', 11, '{\"message\":\"Test User has joined your stream.\"}', NULL, '2025-07-05 06:49:01', '2025-07-05 06:49:01'),
('19b5e248-a07b-4b92-a48e-9d8d7deece6d', 'App\\Notifications\\ViewerJoinedNotification', 'App\\Models\\User', 24, '{\"message\":\"atif raza has joined your stream.\"}', NULL, '2025-07-05 16:31:58', '2025-07-05 16:31:58'),
('22fe2533-aedd-4c97-8976-44bcb05e31ad', 'App\\Notifications\\ViewerJoinedNotification', 'App\\Models\\User', 24, '{\"message\":\"atif raza has joined your stream.\"}', NULL, '2025-07-05 16:08:44', '2025-07-05 16:08:44'),
('44da0c3a-4e24-4c6a-9f44-44f65fba7f12', 'App\\Notifications\\ViewerJoinedNotification', 'App\\Models\\User', 24, '{\"message\":\"atif raza has joined your stream.\"}', NULL, '2025-07-05 16:38:44', '2025-07-05 16:38:44'),
('61bd8514-b7dd-463e-ad0b-34a4bb0132ea', 'App\\Notifications\\ViewerJoinedNotification', 'App\\Models\\User', 24, '{\"message\":\"atif raza has joined your stream.\"}', NULL, '2025-07-05 16:54:49', '2025-07-05 16:54:49'),
('629aa998-3cb8-4831-9555-0da1307e432b', 'App\\Notifications\\ViewerJoinedNotification', 'App\\Models\\User', 11, '{\"message\":\"Test User has joined your stream.\"}', NULL, '2025-07-05 06:46:32', '2025-07-05 06:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stills`
--

CREATE TABLE `stills` (
  `id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `frame_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_pinned` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stills`
--

INSERT INTO `stills` (`id`, `image_path`, `frame_path`, `description`, `user_id`, `created_at`, `updated_at`, `is_pinned`) VALUES
(43, 'uploads/1749818108_image1.jpg', NULL, '<p><strong>Testing FlipBook For Stills</strong></p>\r\n\r\n<h3><var>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt excepturi aperiam corporis autem fugiat maxime cupiditate? Expedita laboriosam doloribus molestiae obcaecati! Natus neque quod sit eius alias voluptatum obcaecati laudantium.</var></h3>', 23, '2025-06-13 07:35:08', '2025-06-13 07:35:08', 0),
(45, 'uploads/1749893797_image3.jpg', NULL, '<h2><em><strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis provident exercitationem quo architecto quas est distinctio quia magnam commodi! Quo ad blanditiis deserunt vel velit rerum ratione optio id placeat?Lorem ipsum dolor sit amet consectetur adipisicing elit. deserunt vel velit rerum ratione optio id placeat?</strong></em></h2>', 24, '2025-06-14 04:36:37', '2025-06-14 04:36:37', 0),
(46, 'uploads/1749895241_image2.jpg', NULL, '<h2>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque esse consequuntur voluptates velit id voluptatem earum ullam, tenetur quas, voluptas quis, odio maxime. Facere quam iste hic minima! Sunt, doloribus?Lorem ipsum dolor sit amet consectetur, adipisicing elit. ?</h2>', 24, '2025-06-14 05:00:41', '2025-06-14 05:00:41', 0),
(47, 'uploads/1750164035_image5.jpg', NULL, '<h2><strong>Test Text Section</strong><br />\nLorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, in natus impedit quas exercitationem, voluptatibus cum sit expedita labore tempora suscipit nostrum repellat unde eos harum, esse est vero iure!&nbsp; &nbsp; Lorem ipsum dolor sit amet consectetur adipisicing elit.</h2>', 24, '2025-06-17 07:40:35', '2025-06-17 07:40:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `still_comments`
--

CREATE TABLE `still_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `still_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `still_comments`
--

INSERT INTO `still_comments` (`id`, `still_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(11, 43, 23, 'looks good', '2025-06-14 04:26:49', '2025-06-14 04:26:49'),
(12, 45, 24, 'new stills design looks goood', '2025-06-14 04:58:25', '2025-06-14 04:58:25'),
(13, 45, 23, 'good one atif', '2025-06-14 05:12:12', '2025-06-14 05:12:12'),
(14, 46, 24, 'good one', '2025-06-18 00:32:06', '2025-06-18 00:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `still_pins`
--

CREATE TABLE `still_pins` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `still_id` bigint UNSIGNED NOT NULL,
  `is_pinned` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `still_pins`
--

INSERT INTO `still_pins` (`id`, `user_id`, `still_id`, `is_pinned`, `created_at`, `updated_at`) VALUES
(8, 24, 43, 0, '2025-06-14 00:20:10', '2025-06-18 00:30:34'),
(10, 23, 43, 0, '2025-06-14 02:03:15', '2025-06-17 07:37:12'),
(11, 23, 45, 0, '2025-06-17 07:36:46', '2025-06-17 07:36:55'),
(12, 24, 45, 0, '2025-06-17 23:54:40', '2025-06-17 23:55:19'),
(13, 24, 46, 1, '2025-06-17 23:54:45', '2025-06-18 00:30:40');

-- --------------------------------------------------------

--
-- Table structure for table `text_frame_comments`
--

CREATE TABLE `text_frame_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `text_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `text_frame_comments`
--

INSERT INTO `text_frame_comments` (`id`, `text_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(8, 91, 23, 'new text design', '2025-06-17 02:29:46', '2025-06-17 02:29:46'),
(9, 93, 23, 'great', '2025-06-17 02:53:56', '2025-06-17 02:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `text_in_frame`
--

CREATE TABLE `text_in_frame` (
  `id` bigint UNSIGNED NOT NULL,
  `text_in_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `text_in_frame`
--

INSERT INTO `text_in_frame` (`id`, `text_in_image`, `user_id`, `created_at`, `updated_at`) VALUES
(90, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, aperiam? Similique corrupti eaque excepturi soluta at pariatur vitae, enim, voluptatibus suscipit in neque rem dolor ex, dolorum ab. Beatae, minus!Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, aperiam? Similique corrupti eaque excepturi soluta at pariatur vitae, enim, voluptatibus suscipit in neque rem dolor ex, dolorum ab. Beatae, minus!Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, aperiam? Similique corrupti eaque excepturi soluta at pariatur vitae, enim, voluptatibus suscipit in neque rem dolor ex, dolorum ab. Beatae, minus!</p>', 23, '2025-06-14 06:15:51', '2025-06-14 06:15:51'),
(91, '<p><em><strong>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reiciendis exercitationem, id officia, non aliquid cupiditate laboriosam minima architecto saepe voluptates doloribus veniam facilis debitis sit dignissimos voluptatem consequatur! Non, tenetur.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reiciendis exercitationem, id officia, non aliquid cupiditate laboriosam minima architecto saepe voluptates doloribus veniam facilis debitis sit dignissimos voluptatem consequatur! Non, tenetur.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reiciendis exercitationem, id officia, non aliquid cupiditate laboriosam minima architecto saepe voluptates doloribus veniam facilis debitis sit dignissimos voluptatem consequatur! Non, tenetur.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reiciendis exercitationem, id officia, non aliquid cupiditate laboriosam minima architecto saepe voluptates doloribus veniam facilis debitis sit dignissimos voluptatem consequatur! Non, tenetur.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reiciendis exercitationem, id officia, non aliquid cupiditate laboriosam minima architecto saepe voluptates doloribus veniam facilis debitis sit dignissimos voluptatem consequatur! Non, tenetur.</strong></em></p>', 23, '2025-06-14 06:39:06', '2025-06-14 06:39:06'),
(93, '<p><em><strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum rem expedita, cumque animi nesciunt sint libero ab, quo obcaecati accusamus perferendis fugiat error quia provident doloremque ducimus voluptatem non dolor!Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum rem expedita, cumque animi nesciunt sint libero ab, quo obcaecati accusamus perferendis fugiat error quia provident doloremque ducimus voluptatem non dolor!Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum rem expedita, cumque animi nesciunt sint libero ab, quo obcaecati accusamus perferendis fugiat error quia provident doloremque ducimus voluptatem non dolor!</strong></em></p>', 23, '2025-06-17 02:37:09', '2025-06-17 02:37:09'),
(96, '<p><strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum neque molestiae dolorum, consequatur eligendi veritatis, temporibus at dolore laudantium, optio nobis sapiente similique. Aperiam vero alias ex. Blanditiis, nostrum perspiciatis.Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum neque molestiae dolorum, consequatur eligendi veritatis, temporibus at dolore laudantium, optio nobis sapiente similique. Aperiam vero alias ex. Blanditiis, nostrum perspiciatis.Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum neque molestiae dolorum, consequatur eligendi veritatis, temporibus at dolore laudantium, optio nobis sapiente similique. Aperiam vero alias ex. Blanditiis, nostrum perspiciatis.Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum neque molestiae dolorum, consequatur eligendi veritatis, temporibus at dolore laudantium, optio nobis sapiente similique. Aperiam vero alias ex. Blanditiis, nostrum perspiciatis.</strong></p>', 24, '2025-06-17 07:55:35', '2025-06-17 07:55:35'),
(97, '<h2><strong>Test Text Section</strong></h2>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum neque molestiae dolorum, consequatur eligendi veritatis, temporibus at dolore laudantium, optio nobis sapiente similique. Aperiam vero alias ex. Blanditiis, nostrum perspiciatis.Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum neque molestiae dolorum, consequatur eligendi veritatis, temporibus at dolore laudantium, optio nobis sapiente similique. Aperiam vero alias ex. Blanditiis, nostrum perspiciatis.Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum neque molestiae dolorum, consequatur eligendi veritatis, temporibus at dolore laudantium, optio nobis sapiente similique. Aperiam vero alias ex. Blanditiis, nostrum perspiciatis.Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum neque molestiae dolorum, consequatur eligendi veritatis, temporibus at dolore laudantium, optio nobis sapiente similique. Aperiam vero alias ex. Blanditiis, nostrum perspiciatis.</p>', 24, '2025-06-17 07:56:30', '2025-06-17 07:56:30'),
(98, '<p><em><strong>Text FlipBook</strong></em></p>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum neque molestiae dolorum, consequatur eligendi veritatis, temporibus at dolore laudantium, optio nobis sapiente similique. Aperiam vero alias ex. Blanditiis, nostrum perspiciatis.Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum neque molestiae dolorum, consequatur eligendi veritatis, temporibus at dolore laudantium, optio nobis sapiente similique. Aperiam vero alias ex. Blanditiis, nostrum perspiciatis.Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum neque molestiae dolorum, consequatur eligendi veritatis, temporibus at dolore laudantium, optio nobis sapiente similique. Aperiam vero alias ex. Blanditiis, nostrum perspiciatis.Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum neque molestiae dolorum, consequatur eligendi veritatis, temporibus at dolore laudantium, optio nobis sapiente similique. Aperiam vero alias ex. Blanditiis, nostrum perspiciatis.</p>', 24, '2025-06-17 07:57:47', '2025-06-17 07:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `text_pins`
--

CREATE TABLE `text_pins` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `text_id` bigint UNSIGNED NOT NULL,
  `is_pinned` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `text_pins`
--

INSERT INTO `text_pins` (`id`, `user_id`, `text_id`, `is_pinned`, `created_at`, `updated_at`) VALUES
(10, 23, 91, 0, '2025-06-14 07:05:10', '2025-06-17 07:36:32'),
(11, 23, 90, 0, '2025-06-14 07:05:37', '2025-06-16 23:54:46'),
(12, 24, 97, 0, '2025-06-18 00:32:27', '2025-06-18 01:09:26'),
(13, 24, 98, 0, '2025-06-18 01:34:19', '2025-06-18 01:34:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cover_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy_setting` enum('friends','nobody','everyone') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'everyone',
  `workplace` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Pensacola` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `loves` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_town` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favorite_song` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ringtone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_live` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `profile_picture`, `id_card`, `remember_token`, `created_at`, `updated_at`, `cover_image`, `privacy_setting`, `workplace`, `school`, `Pensacola`, `dob`, `loves`, `home_town`, `current_city`, `favorite_song`, `employer`, `job_title`, `ringtone`, `is_live`) VALUES
(1, 'Miss Jordane Thiel', '', 'daniel.gabriella@example.org', '2025-02-18 08:24:11', '$2y$12$ozX2uku2rO.KfQW.DgFTYOp9TT0RXXxZXBJcrjD8C5cs3xy3Ah0Du', NULL, NULL, 'NdQGxGbz6V', '2025-02-18 08:24:12', '2025-02-18 08:24:12', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 'Jovani Dickens PhD', '', 'freida.hand@example.net', '2025-02-18 08:24:12', '$2y$12$ozX2uku2rO.KfQW.DgFTYOp9TT0RXXxZXBJcrjD8C5cs3xy3Ah0Du', NULL, NULL, '7PbZaAlaRp', '2025-02-18 08:24:12', '2025-02-18 08:24:12', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(3, 'Miss Nicolette Windler IV', '', 'dannie76@example.org', '2025-02-18 08:24:12', '$2y$12$ozX2uku2rO.KfQW.DgFTYOp9TT0RXXxZXBJcrjD8C5cs3xy3Ah0Du', NULL, NULL, 'niVvfD2TvN', '2025-02-18 08:24:12', '2025-02-18 08:24:12', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(4, 'Philip Hudson', '', 'qcorwin@example.org', '2025-02-18 08:24:12', '$2y$12$ozX2uku2rO.KfQW.DgFTYOp9TT0RXXxZXBJcrjD8C5cs3xy3Ah0Du', NULL, NULL, 's3Sbco507H', '2025-02-18 08:24:12', '2025-02-18 08:24:12', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(5, 'Ruben Veum', '', 'orion72@example.com', '2025-02-18 08:24:12', '$2y$12$ozX2uku2rO.KfQW.DgFTYOp9TT0RXXxZXBJcrjD8C5cs3xy3Ah0Du', NULL, NULL, 'ZD2grXytz3', '2025-02-18 08:24:12', '2025-02-18 08:24:12', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(6, 'Alanis Predovic', '', 'qklocko@example.org', '2025-02-18 08:24:12', '$2y$12$ozX2uku2rO.KfQW.DgFTYOp9TT0RXXxZXBJcrjD8C5cs3xy3Ah0Du', NULL, NULL, 'ZtcAK9ZkuC', '2025-02-18 08:24:12', '2025-02-18 08:24:12', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(7, 'Prof. Thad Pfeffer', '', 'johnny.bosco@example.com', '2025-02-18 08:24:12', '$2y$12$ozX2uku2rO.KfQW.DgFTYOp9TT0RXXxZXBJcrjD8C5cs3xy3Ah0Du', NULL, NULL, 'z5yiKuiczm', '2025-02-18 08:24:12', '2025-02-18 08:24:12', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(8, 'Alfreda Wilderman III', '', 'aryanna95@example.com', '2025-02-18 08:24:12', '$2y$12$ozX2uku2rO.KfQW.DgFTYOp9TT0RXXxZXBJcrjD8C5cs3xy3Ah0Du', NULL, NULL, 'GysNwVr77I', '2025-02-18 08:24:12', '2025-02-18 08:24:12', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(9, 'Pablo Harris', '', 'allie83@example.com', '2025-02-18 08:24:12', '$2y$12$ozX2uku2rO.KfQW.DgFTYOp9TT0RXXxZXBJcrjD8C5cs3xy3Ah0Du', NULL, NULL, 'DOtJaKQyab', '2025-02-18 08:24:12', '2025-02-18 08:24:12', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(10, 'Randi Gutmann', '', 'koch.delpha@example.com', '2025-02-18 08:24:12', '$2y$12$ozX2uku2rO.KfQW.DgFTYOp9TT0RXXxZXBJcrjD8C5cs3xy3Ah0Du', NULL, NULL, 'yB3pdKQOB5', '2025-02-18 08:24:12', '2025-02-18 08:24:12', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(11, 'Test User', 'TestUser', 'test@example.com', '2025-02-18 08:24:12', '$2y$12$aU0Ynjxv3.j0tsmATQY0XuhT.qKOi2xjO0qR/s4.5IGl555N5ODHa', 'assets/profile_pictures/1745929727_Snapchat-1588735601.jpg', NULL, 'gbU7w9jbE7En3d8NgSOSe9Bhgnm6Tt0UmwATzvYWmd6KZHMDDxfHSYU3HpEA', '2025-02-18 08:24:12', '2025-07-02 14:12:21', 'storage/cover_images/1744888379_image5.jpg', 'everyone', 'GMG Solution', 'Oxford Uni', 'XYZ', '2025-05-30', 'Novels', 'karachi', 'Hyderabad', 'Pal Pal jeena', 'Aatif', 'Web Developer', 'vivo-y12-ringtone.mp3', 0),
(12, 'Khadim Hussain', '', 'khadimgmgsolutions@gmail.com', NULL, '$2y$12$xjMQRrG9yrn.i3lJzwuxZOFVcHT0BYrBBI.Mx8DzVXrPyVlKGkM1u', NULL, NULL, NULL, '2025-02-18 08:33:35', '2025-02-18 08:33:35', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(13, 'Khadim Hussain', '', '123Khadimhussain786@gmail.com', NULL, '$2y$12$W5tgwPtzxssoo6nWykvDU.wV5HfFvdIheNwtjCJOXTn2Fd/N7/8qO', NULL, NULL, NULL, '2025-02-18 08:54:31', '2025-02-18 08:54:31', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(14, 'Khadim Hussain', '', 'hafiz@gmail.com', NULL, '$2y$12$Us698z9QRA.2NBegYerU3.m96GJ1a0A5v9aQzgGBTft67wkZ3Wh72', NULL, NULL, NULL, '2025-02-20 03:32:21', '2025-02-20 03:32:21', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(15, 'jp', '', 'jpjeswani@gmail.com', NULL, '$2y$12$7W9UVUExkBH1iR5dUntqDOfU2SVN1/Ih8KsE8oOpXAKDsjzUtt/CC', NULL, NULL, NULL, '2025-02-20 09:06:17', '2025-02-20 09:06:17', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(16, 'Jay Parkash', '', 'jpjeswani12@gmail.com', NULL, '$2y$12$wjeWltmcGu1V.KhmUGGmPO5zCj0l3wjpygv9TBZsvn1MV0bgJLDvS', NULL, NULL, NULL, '2025-02-20 11:05:38', '2025-02-20 11:05:38', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(17, 'Waqar Ahmad', '', 'GETFORMIN1MG@GMAIL.COM', NULL, '$2y$12$wFeAudaSr4RQFGYYRUFPfupv1uO5CXWbxjNiaR61O1cli13qNUKte', NULL, NULL, NULL, '2025-02-20 15:05:56', '2025-02-20 15:05:56', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(18, 'Jay Parkash', '', 'babubhaiya@gmail.com', NULL, '$2y$12$sE35KtvA/cEEbFjh7kd.0eK7713gVyLls/xKdULkgLYebhXjvGOIm', NULL, NULL, NULL, '2025-02-20 15:53:52', '2025-02-20 15:53:52', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(19, 'Rick', '', 'codifyservices1@gmail.com', NULL, '$2y$12$rclC.M/INQ7VmuVPZGaS6OWXPLm6MPHLmwAmCX39/wfSxkDNkWsqa', NULL, NULL, NULL, '2025-02-20 17:36:55', '2025-02-20 17:36:55', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(20, 'Rick', '', 'rickappleyard@gmail.com', NULL, '$2y$12$mWcKBu2Yj.OUPJC6.oWMs.01fiWrWlX3Mg1dqIMH8Tph2JqcEYzxm', NULL, NULL, NULL, '2025-02-24 19:48:29', '2025-02-24 19:48:29', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(21, 'Jay Parkash', '', 'tahakumar05@gmail.com', NULL, '$2y$12$d3aWpQ7cEKj/jzfOX/WPwO0XiE8omyeVWdpPEAuyld4NFKaycsY6m', NULL, NULL, NULL, '2025-02-25 07:25:23', '2025-02-25 07:25:23', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(22, 'Rick', '', 'rappleyard@beaubox.com', NULL, '$2y$12$QGObnI4ZaJ93ctHU9.Mim.CJkPL8LxcdRi1IilTLq6Hi7ztxDbG4q', NULL, NULL, NULL, '2025-02-25 22:33:37', '2025-02-25 22:33:37', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(23, 'siraj umrani', 'SIRAAJ', 'siraj@gmail.com', NULL, '$2y$12$agBBgqNPublpIJRc0qobc.o09m9M3WQvL9RuSclG3lhIHS7AKxH3q', 'assets/profile_pictures/1747482525_BeautyPlus_20190221162215356_save.jpg', 'assets/ID_Card_Images/1747131584_68231cc059441.JPG', NULL, '2025-03-21 05:43:37', '2025-07-04 06:42:59', 'storage/cover_images/1749199065_image1.jpg', 'everyone', 'oxford university', 'Becanhouse', 'nill', '2005-01-17', 'movies', 'Matiari', 'Hyderabad', 'Jhool', 'Private', 'Laravel Developer', 'arash-broken-angel.mp3', 1),
(24, 'atif raza', 'atifraza', 'atifrazait@gmail.com', NULL, '$2y$12$r2ueTZHWwYuiVyN4B7r5y.YzOApEbLdqKHIWuJQ5ogBTH6WNeBlxy', 'assets/profile_pictures/1745914057_atif.png', NULL, 'slcLyrSiaxGJHFRLehxIN5rWQpkazaXmVNpezfjC9OI2kxH5mqDknsk5gLR6', '2025-04-17 05:26:19', '2025-07-04 01:46:53', 'storage/cover_images/1745913389_image1.jpg', 'friends', 'gmg solution', 'City School', NULL, NULL, 'programming', 'Hyderabad', 'qasimabad', 'pal pal', 'developer', NULL, 'someone-is-calling-you.mp3', 0),
(25, 'Testing user', '', 'test@gmail.com', NULL, '$2y$12$uyl9rtkeKpMzmT0lb7XSJ.YCThQZnOCP3oa77.X0wF8x6JdzkVs3a', NULL, NULL, NULL, '2025-04-28 04:40:58', '2025-04-28 04:40:58', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(26, 'Amir jan', '', 'amir12@gmail.com', NULL, '$2y$12$1mQsdr6peR3Btg9BENI7I.n3.z.U1cxGGXEWazBlwATRwV7av2kIu', NULL, NULL, NULL, '2025-04-28 04:54:40', '2025-04-28 04:54:40', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(27, 'sindu', '', 'sindhu@gmail.com', NULL, '$2y$12$uKyAbCm0rtBQpvvGBNKT.uRRM0htnUc5hUX/fRg3KTH8ZAPMCoQbe', NULL, NULL, NULL, '2025-04-28 04:58:06', '2025-04-28 04:58:06', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(28, 'test picture', '', 'test12@gmail.com', NULL, '$2y$12$33qu8e4cWnC8lXh1UkFC1e2JE9ELaVw1lLWoaWXjgm4aGXnuCTECC', NULL, NULL, NULL, '2025-04-28 05:00:19', '2025-04-28 05:00:19', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(29, 'ali raza', '', 'aliraza@gmail.com', NULL, '$2y$12$jY4B.UgK9qm/N.jHP2ASWOl40jLiB1Y/kQYhWOXUk4U.xITsCDkj6', 'assets/profile_pictures/1745928434_bg_white.jpeg', NULL, 'iKWArHM5L880F954Yih2973708h8aRsEvJ6JxIJQD8vsTViiP7b4Sthb4Z87', '2025-04-28 05:07:37', '2025-04-29 09:58:48', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(30, 'testusers', '', 'testusers@gmail.com', NULL, '$2y$12$lhoyzgsgxe0IBRI8.XO18u.q/xtBTs2kTNJvU/wKjgM0TRw4ikiOO', 'assets/profile_pictures/1746436398_BeautyPlus_20190310153855293_save.jpg', NULL, NULL, '2025-05-05 04:03:24', '2025-05-05 04:13:18', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(31, 'testinguser', '', 'testinguser@gmail.com', NULL, '$2y$12$TmumwKigYTHQGNrvDZ3R8eSldwCaVbcQ1K5Uo.TPimk8eMjS1ebaW', 'assets/profile_pictures/1746436443_BeautyPlus_20190310154109871_save.jpg', NULL, NULL, '2025-05-05 04:14:03', '2025-05-05 04:14:03', NULL, 'everyone', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(32, 'ahsan ali', 'ahsanraza', 'ahsanraza@gmail.com', NULL, '$2y$12$Gd8Oll79MD8K7MmTnEFPEeb0DyGNXT6P/0m6pYMxkWYS8i.aNqBK2', 'assets/profile_pictures/1746804788_IMG-20190317-WA0013.jpg', NULL, NULL, '2025-05-09 10:33:08', '2025-05-15 04:44:40', NULL, 'nobody', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `user_id`, `title`, `video_path`, `created_at`, `updated_at`) VALUES
(6, 23, 'animation love', 'storage/videos/1744142257_SampleVideo_1280x720_1mb.mp4', '2025-04-08 14:57:37', '2025-04-08 14:57:37'),
(7, 23, 'animals animation', 'storage/videos/1744144052_SampleVideo_1280x720_2mb.mp4', '2025-04-08 15:27:32', '2025-04-08 15:27:32'),
(8, 23, 'testing videos', 'storage/videos/1744144070_SampleVideo_1280x720_5mb.mp4', '2025-04-08 15:27:50', '2025-04-08 15:27:50'),
(11, 24, 'amir motivational', 'storage/videos/1744888214_YouTube Tips Make Shorts Longer Than 15 Seconds - vidIQ (720p, h264).mp4', '2025-04-17 06:10:14', '2025-04-17 06:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `video_call_recordings`
--

CREATE TABLE `video_call_recordings` (
  `id` bigint UNSIGNED NOT NULL,
  `caller_id` bigint UNSIGNED NOT NULL,
  `receiver_id` bigint UNSIGNED NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_call_recordings`
--

INSERT INTO `video_call_recordings` (`id`, `caller_id`, `receiver_id`, `file_path`, `duration`, `created_at`, `updated_at`) VALUES
(1, 23, 24, 'recordings/lSBUTBgM60xqSOLKwSpUMIHWrq4nbrc0tnBWX1av.webm', 6, '2025-06-26 07:32:31', '2025-06-26 07:32:31'),
(2, 23, 24, 'recordings/2wwCNozEEOajLZmgoMJ0vGTTiNE8UbnURAeOGseZ.webm', 11, '2025-06-26 07:37:56', '2025-06-26 07:37:56'),
(3, 24, 23, 'recordings/NHEXlKBxWhkWItCe6gzgLLT98SO62wliKqULXF7U.webm', 9, '2025-06-26 07:46:17', '2025-06-26 07:46:17'),
(4, 24, 23, 'recordings/cyaLWIchMw4nznWKP6TUCJGgSESmak5WPRSyM6iX.webm', 14, '2025-06-26 07:54:47', '2025-06-26 07:54:47'),
(5, 24, 23, 'recordings/O6Bwra0tBr2YGvR2IISxFJDnlqWES5r8fzMHL0sf.webm', 11, '2025-06-26 08:13:46', '2025-06-26 08:13:46'),
(6, 23, 24, 'recordings/SCTaVc5Ui0EbS02hb7YeRCGBqARSWdztUL6AygZz.webm', 8, '2025-06-26 08:13:58', '2025-06-26 08:13:58'),
(7, 23, 24, 'recordings/9KJjZD3k0M9NYHmhwWHd4LAAEebUqzuVzPdUTsTO.webm', 8, '2025-06-26 08:38:14', '2025-06-26 08:38:14'),
(8, 23, 24, 'recordings/cOZWmkp0C3P4P2giQstkXcNUuBNFAhEqmGlWKtuQ.webm', 9, '2025-06-26 08:40:25', '2025-06-26 08:40:25'),
(9, 24, 23, 'recordings/xIPC0P42kvYX454Ek84iRMy0bgMXZUdURV63Jj6o.webm', 6, '2025-06-26 08:51:31', '2025-06-26 08:51:31'),
(10, 24, 23, 'recordings/Kcf3eZ7b00OG9kFpoGoARyGZEXkDLk26ODcGqqBd.webm', 33, '2025-06-26 09:27:59', '2025-06-26 09:27:59'),
(11, 23, 24, 'recordings/sKyFBbJ65ju1UuU7VLFNoA4fJZdOjy5nKbIsNzXZ.webm', 37, '2025-06-26 09:32:56', '2025-06-26 09:32:56'),
(12, 23, 24, 'recordings/TpNUXJfzoMoEuaqmQrUzKLFBCxcZlxMq3jBDbiBF.webm', 10, '2025-06-27 00:56:15', '2025-06-27 00:56:15'),
(13, 23, 24, 'recordings/aMOvOpFa5u1momYncbGMJ3Ka6n9T0InQ58UoL8Wo.webm', 131, '2025-06-27 01:02:17', '2025-06-27 01:02:17'),
(14, 23, 24, 'recordings/dAaxHWb6qG7UuhAPpmYwbXIvVd5KUFN3qJ9on2ZR.webm', 11, '2025-06-27 01:10:11', '2025-06-27 01:10:11'),
(15, 23, 24, 'recordings/iHJCdXTSS1Wpk0eI1OXVp3aw0oVsZPcGr7DLAyEE.webm', 21, '2025-06-27 01:13:16', '2025-06-27 01:13:16'),
(16, 23, 24, 'recordings/IY8ZZPHZcJzpY4Ok5O6De2mcOFaBVXYftQTolkup.webm', 63, '2025-06-27 01:16:21', '2025-06-27 01:16:21'),
(17, 23, 24, 'recordings/hNwoKXiF25k9HGSenieuPUbv9K8ONDudSwVR6S7L.webm', 10, '2025-06-27 01:32:15', '2025-06-27 01:32:15'),
(18, 24, 23, 'recordings/sEnvLADsmuWC9g8QExO4DouTlB8XWgetUSuJCM08.webm', 13, '2025-06-27 13:37:27', '2025-06-27 13:37:27'),
(19, 23, 24, 'recordings/2KYYq6D3l75aNN2Sege4tPxQHBS6FB0l6PjVnRQI.webm', 16, '2025-06-29 05:47:05', '2025-06-29 05:47:05'),
(20, 23, 24, 'recordings/8gXwmZ0tAjnWizn560T0thdGrr4GC360MDjF3yru.webm', 12, '2025-06-30 00:59:29', '2025-06-30 00:59:29'),
(21, 23, 24, 'recordings/L7m3Kc2XUgDMTsput6PCYmgE35sYQYXH5wzflh5V.webm', 14, '2025-06-30 01:24:57', '2025-06-30 01:24:57'),
(22, 23, 24, 'recording/call_68623ad8741c65.72469055.webm', 12, '2025-06-30 02:20:56', '2025-06-30 02:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `video_comments`
--

CREATE TABLE `video_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `video_id` bigint UNSIGNED NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_comments`
--

INSERT INTO `video_comments` (`id`, `user_id`, `video_id`, `comment`, `created_at`, `updated_at`) VALUES
(11, 24, 8, 'wow great animation', '2025-04-22 09:04:27', '2025-04-22 09:04:27'),
(13, 23, 11, 'very informative', '2025-04-23 03:21:36', '2025-04-23 03:21:36'),
(14, 24, 6, 'that\'s cool', '2025-04-23 08:56:50', '2025-04-23 08:56:50'),
(16, 24, 7, 'i love animals', '2025-04-24 11:03:36', '2025-04-24 11:03:36'),
(17, 25, 11, 'good one', '2025-04-29 05:09:34', '2025-04-29 05:09:34'),
(18, 24, 8, 'i love this', '2025-04-29 05:13:19', '2025-04-29 05:13:19');

-- --------------------------------------------------------

--
-- Table structure for table `video_likes`
--

CREATE TABLE `video_likes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `video_id` bigint UNSIGNED NOT NULL,
  `like` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_likes`
--

INSERT INTO `video_likes` (`id`, `user_id`, `video_id`, `like`, `created_at`, `updated_at`) VALUES
(10, 24, 7, 0, '2025-04-23 08:22:50', '2025-04-23 08:22:50'),
(11, 11, 7, 0, '2025-04-23 08:25:09', '2025-04-23 08:25:09'),
(12, 24, 6, 0, '2025-04-23 08:25:43', '2025-04-23 08:25:43'),
(26, 23, 11, 0, '2025-04-26 11:10:09', '2025-04-26 11:10:09'),
(30, 25, 8, 0, '2025-04-29 03:56:15', '2025-04-29 03:56:15'),
(32, 25, 11, 0, '2025-04-29 05:22:28', '2025-04-29 05:22:28'),
(35, 24, 8, 0, '2025-05-01 06:03:58', '2025-05-01 06:03:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audios`
--
ALTER TABLE `audios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audios_user_id_foreign` (`user_id`);

--
-- Indexes for table `audio_comments`
--
ALTER TABLE `audio_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audio_comments_user_id_foreign` (`user_id`),
  ADD KEY `audio_comments_audio_id_foreign` (`audio_id`);

--
-- Indexes for table `audio_comment_likes`
--
ALTER TABLE `audio_comment_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audio_comment_likes_user_id_foreign` (`user_id`),
  ADD KEY `audio_comment_likes_audio_comment_id_foreign` (`audio_comment_id`);

--
-- Indexes for table `audio_comment_replies`
--
ALTER TABLE `audio_comment_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audio_comment_replies_comment_id_foreign` (`comment_id`),
  ADD KEY `audio_comment_replies_user_id_foreign` (`user_id`);

--
-- Indexes for table `audio_interactions`
--
ALTER TABLE `audio_interactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audio_interactions_audio_id_foreign` (`audio_id`),
  ADD KEY `audio_interactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `audio_pins`
--
ALTER TABLE `audio_pins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audio_pins_user_id_foreign` (`user_id`),
  ADD KEY `audio_pins_audio_id_foreign` (`audio_id`);

--
-- Indexes for table `call_logs`
--
ALTER TABLE `call_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `call_logs_caller_id_foreign` (`caller_id`),
  ADD KEY `call_logs_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_likes_comment_id_foreign` (`comment_id`),
  ADD KEY `comment_likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_replies_comment_id_foreign` (`comment_id`),
  ADD KEY `comment_replies_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourites_user_id_foreign` (`user_id`),
  ADD KEY `favourites_video_id_foreign` (`video_id`);

--
-- Indexes for table `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friendships_sender_id_foreign` (`sender_id`),
  ADD KEY `friendships_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `like_stills`
--
ALTER TABLE `like_stills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `like_stills_user_id_foreign` (`user_id`),
  ADD KEY `like_stills_still_id_foreign` (`still_id`);

--
-- Indexes for table `like_text_frame`
--
ALTER TABLE `like_text_frame`
  ADD PRIMARY KEY (`id`),
  ADD KEY `like_text_frame_user_id_foreign` (`user_id`),
  ADD KEY `like_text_frame_text_id_foreign` (`text_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `stills`
--
ALTER TABLE `stills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stills_user_id_foreign` (`user_id`);

--
-- Indexes for table `still_comments`
--
ALTER TABLE `still_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `still_comments_still_id_foreign` (`still_id`),
  ADD KEY `still_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `still_pins`
--
ALTER TABLE `still_pins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `still_pins_user_id_foreign` (`user_id`),
  ADD KEY `still_pins_still_id_foreign` (`still_id`);

--
-- Indexes for table `text_frame_comments`
--
ALTER TABLE `text_frame_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `text_frame_comments_text_id_foreign` (`text_id`),
  ADD KEY `text_frame_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `text_in_frame`
--
ALTER TABLE `text_in_frame`
  ADD PRIMARY KEY (`id`),
  ADD KEY `text_in_frame_user_id_foreign` (`user_id`);

--
-- Indexes for table `text_pins`
--
ALTER TABLE `text_pins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `text_pins_user_id_foreign` (`user_id`),
  ADD KEY `text_pins_text_id_foreign` (`text_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_user_id_foreign` (`user_id`);

--
-- Indexes for table `video_call_recordings`
--
ALTER TABLE `video_call_recordings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_comments`
--
ALTER TABLE `video_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_comments_user_id_foreign` (`user_id`),
  ADD KEY `video_comments_video_id_foreign` (`video_id`);

--
-- Indexes for table `video_likes`
--
ALTER TABLE `video_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_likes_user_id_foreign` (`user_id`),
  ADD KEY `video_likes_video_id_foreign` (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audios`
--
ALTER TABLE `audios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `audio_comments`
--
ALTER TABLE `audio_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `audio_comment_likes`
--
ALTER TABLE `audio_comment_likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `audio_comment_replies`
--
ALTER TABLE `audio_comment_replies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `audio_interactions`
--
ALTER TABLE `audio_interactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `audio_pins`
--
ALTER TABLE `audio_pins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `call_logs`
--
ALTER TABLE `call_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `comment_likes`
--
ALTER TABLE `comment_likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `friendships`
--
ALTER TABLE `friendships`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `like_stills`
--
ALTER TABLE `like_stills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `like_text_frame`
--
ALTER TABLE `like_text_frame`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stills`
--
ALTER TABLE `stills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `still_comments`
--
ALTER TABLE `still_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `still_pins`
--
ALTER TABLE `still_pins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `text_frame_comments`
--
ALTER TABLE `text_frame_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `text_in_frame`
--
ALTER TABLE `text_in_frame`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `text_pins`
--
ALTER TABLE `text_pins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `video_call_recordings`
--
ALTER TABLE `video_call_recordings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `video_comments`
--
ALTER TABLE `video_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `video_likes`
--
ALTER TABLE `video_likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audios`
--
ALTER TABLE `audios`
  ADD CONSTRAINT `audios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `audio_comments`
--
ALTER TABLE `audio_comments`
  ADD CONSTRAINT `audio_comments_audio_id_foreign` FOREIGN KEY (`audio_id`) REFERENCES `audios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `audio_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `audio_comment_likes`
--
ALTER TABLE `audio_comment_likes`
  ADD CONSTRAINT `audio_comment_likes_audio_comment_id_foreign` FOREIGN KEY (`audio_comment_id`) REFERENCES `audio_comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `audio_comment_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `audio_comment_replies`
--
ALTER TABLE `audio_comment_replies`
  ADD CONSTRAINT `audio_comment_replies_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `audio_comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `audio_comment_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `audio_interactions`
--
ALTER TABLE `audio_interactions`
  ADD CONSTRAINT `audio_interactions_audio_id_foreign` FOREIGN KEY (`audio_id`) REFERENCES `audios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `audio_interactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `audio_pins`
--
ALTER TABLE `audio_pins`
  ADD CONSTRAINT `audio_pins_audio_id_foreign` FOREIGN KEY (`audio_id`) REFERENCES `audios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `audio_pins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `call_logs`
--
ALTER TABLE `call_logs`
  ADD CONSTRAINT `call_logs_caller_id_foreign` FOREIGN KEY (`caller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `call_logs_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD CONSTRAINT `comment_likes_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `video_comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD CONSTRAINT `comment_replies_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `video_comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourites_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `friendships`
--
ALTER TABLE `friendships`
  ADD CONSTRAINT `friendships_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friendships_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `like_stills`
--
ALTER TABLE `like_stills`
  ADD CONSTRAINT `like_stills_still_id_foreign` FOREIGN KEY (`still_id`) REFERENCES `stills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `like_stills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `like_text_frame`
--
ALTER TABLE `like_text_frame`
  ADD CONSTRAINT `like_text_frame_text_id_foreign` FOREIGN KEY (`text_id`) REFERENCES `text_in_frame` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `like_text_frame_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stills`
--
ALTER TABLE `stills`
  ADD CONSTRAINT `stills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `still_comments`
--
ALTER TABLE `still_comments`
  ADD CONSTRAINT `still_comments_still_id_foreign` FOREIGN KEY (`still_id`) REFERENCES `stills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `still_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `still_pins`
--
ALTER TABLE `still_pins`
  ADD CONSTRAINT `still_pins_still_id_foreign` FOREIGN KEY (`still_id`) REFERENCES `stills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `still_pins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `text_frame_comments`
--
ALTER TABLE `text_frame_comments`
  ADD CONSTRAINT `text_frame_comments_text_id_foreign` FOREIGN KEY (`text_id`) REFERENCES `text_in_frame` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `text_frame_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `text_in_frame`
--
ALTER TABLE `text_in_frame`
  ADD CONSTRAINT `text_in_frame_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `text_pins`
--
ALTER TABLE `text_pins`
  ADD CONSTRAINT `text_pins_text_id_foreign` FOREIGN KEY (`text_id`) REFERENCES `text_in_frame` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `text_pins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `video_comments`
--
ALTER TABLE `video_comments`
  ADD CONSTRAINT `video_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `video_comments_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `video_likes`
--
ALTER TABLE `video_likes`
  ADD CONSTRAINT `video_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `video_likes_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
