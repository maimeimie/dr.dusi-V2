-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 02:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dusi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `chronic_diseases`
--

CREATE TABLE `chronic_diseases` (
  `disease_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `disease_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chronic_diseases`
--

INSERT INTO `chronic_diseases` (`disease_id`, `session_id`, `disease_name`) VALUES
(1, 6, 'โรคความดันโลหิตสูง'),
(2, 7, 'โรคความดันโลหิตสูง'),
(3, 8, 'โรคความดันโลหิตสูง'),
(4, 25, 'โรคความดันโลหิตสูง'),
(5, 26, 'โรคความดันโลหิตสูง'),
(6, 27, 'โรคข้ออักเสบ'),
(7, 32, 'โรคความดันโลหิตสูง'),
(8, 33, 'โรคข้ออักเสบ'),
(9, 35, 'มะเร็งปอด'),
(10, 36, 'โรคความดันโลหิตสูง'),
(11, 37, 'มะเร็งปอด'),
(12, 38, 'โรคข้ออักเสบ'),
(13, 39, 'โรคข้ออักเสบ'),
(14, 40, 'โรคความดันโลหิตสูง'),
(15, 41, 'โรคกระดูกพรุน'),
(16, 42, 'โรคเบาหวาน'),
(17, 43, 'มะเร็งปอด'),
(18, 44, 'มะเร็งปอด'),
(19, 45, 'โรคความดันโลหิตสูง'),
(20, 46, 'โรคเบาหวาน'),
(21, 48, 'มะเร็งปอด'),
(22, 49, 'มะเร็งปอด'),
(23, 50, 'โรคเบาหวาน'),
(24, 51, 'มะเร็งปอด');

-- --------------------------------------------------------

--
-- Table structure for table `risks`
--

CREATE TABLE `risks` (
  `risk_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `risk_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `risks`
--

INSERT INTO `risks` (`risk_id`, `session_id`, `risk_name`) VALUES
(1, 21, 'สูบบุหรี่'),
(2, 22, 'สูบบุหรี่'),
(3, 26, 'ดื่มแอลกอฮอลล์'),
(4, 27, 'สูบบุหรี่'),
(5, 32, 'สูบบุหรี่'),
(6, 33, 'ดื่มแอลกอฮอลล์'),
(7, 34, 'สูบบุหรี่'),
(8, 38, 'ดื่มแอลกอฮอลล์'),
(9, 39, 'ดื่มแอลกอฮอลล์'),
(10, 40, 'สูบบุหรี่'),
(11, 41, 'ดื่มแอลกอฮอลล์'),
(12, 43, 'ดื่มแอลกอฮอลล์'),
(13, 44, 'ดื่มแอลกอฮอลล์'),
(14, 45, 'ดื่มแอลกอฮอลล์'),
(15, 49, 'สูบบุหรี่'),
(16, 50, 'ดื่มแอลกอฮอลล์'),
(17, 51, 'ดื่มแอลกอฮอลล์');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 1, '2024-11-19 16:43:03', '2024-11-19 16:43:03'),
(5, 1, '2024-11-19 16:43:13', '2024-11-19 16:43:13'),
(6, 2, '2024-11-19 16:47:38', '2024-11-19 16:47:38'),
(7, 2, '2024-11-19 16:48:03', '2024-11-19 16:48:03'),
(8, 2, '2024-11-19 16:50:24', '2024-11-19 16:50:24'),
(9, 2, '2024-11-19 16:50:32', '2024-11-19 16:50:32'),
(10, 2, '2024-11-19 20:33:41', '2024-11-19 20:33:41'),
(11, 2, '2024-11-19 20:33:51', '2024-11-19 20:33:51'),
(12, 1, '2024-11-19 20:35:27', '2024-11-19 20:35:27'),
(13, 1, '2024-11-19 20:37:34', '2024-11-19 20:37:34'),
(14, 1, '2024-11-19 20:37:48', '2024-11-19 20:37:48'),
(15, 1, '2024-11-19 20:41:43', '2024-11-19 20:41:43'),
(16, 1, '2024-11-19 20:49:21', '2024-11-19 20:49:21'),
(17, 1, '2024-11-19 20:49:25', '2024-11-19 20:49:25'),
(18, 1, '2024-11-19 20:49:45', '2024-11-19 20:49:45'),
(19, 1, '2024-11-19 20:49:50', '2024-11-19 20:49:50'),
(20, 2, '2024-11-19 20:50:26', '2024-11-19 20:50:26'),
(21, 2, '2024-11-19 20:54:47', '2024-11-19 20:54:47'),
(22, 2, '2024-11-19 20:55:21', '2024-11-19 20:55:21'),
(23, 2, '2024-11-19 20:55:35', '2024-11-19 20:55:35'),
(24, 2, '2024-11-19 20:59:06', '2024-11-19 20:59:06'),
(25, 2, '2024-11-19 21:10:47', '2024-11-19 21:10:47'),
(26, 2, '2024-11-19 21:12:18', '2024-11-19 21:12:18'),
(27, 2, '2024-11-19 21:16:40', '2024-11-19 21:16:40'),
(28, 2, '2024-11-19 21:19:41', '2024-11-19 21:19:41'),
(29, 2, '2024-11-19 21:21:09', '2024-11-19 21:21:09'),
(30, 2, '2024-11-19 21:21:48', '2024-11-19 21:21:48'),
(31, 2, '2024-11-19 21:22:17', '2024-11-19 21:22:17'),
(32, 2, '2024-11-19 22:35:48', '2024-11-19 22:35:48'),
(33, 2, '2024-11-19 22:45:37', '2024-11-19 22:45:37'),
(34, 2, '2024-11-19 23:01:57', '2024-11-19 23:01:57'),
(35, 1, '2024-11-19 23:17:31', '2024-11-19 23:17:31'),
(36, 2, '2024-11-19 23:35:16', '2024-11-19 23:35:16'),
(37, 2, '2024-11-19 23:37:43', '2024-11-19 23:37:43'),
(38, 2, '2024-11-20 02:09:06', '2024-11-20 02:09:06'),
(39, 2, '2024-11-20 02:09:36', '2024-11-20 02:09:36'),
(40, 2, '2024-11-20 02:30:14', '2024-11-20 02:30:14'),
(41, 2, '2024-11-20 03:00:32', '2024-11-20 03:00:32'),
(42, 1, '2024-11-20 03:11:53', '2024-11-20 03:11:53'),
(43, 2, '2024-11-20 04:06:15', '2024-11-20 04:06:15'),
(44, 1, '2024-11-20 04:08:48', '2024-11-20 04:08:48'),
(45, 1, '2024-11-20 04:12:22', '2024-11-20 04:12:22'),
(46, 1, '2024-11-20 04:40:58', '2024-11-20 04:40:58'),
(47, 1, '2024-11-20 04:42:52', '2024-11-20 04:42:52'),
(48, 4, '2024-11-20 04:58:28', '2024-11-20 04:58:28'),
(49, 1, '2024-11-20 05:08:22', '2024-11-20 05:08:22'),
(50, 1, '2024-11-20 05:13:28', '2024-11-20 05:13:28'),
(51, 1, '2024-11-20 13:42:08', '2024-11-20 13:42:08');

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `symptom_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `symptom_type` varchar(50) DEFAULT NULL,
  `symptom_name` varchar(255) DEFAULT NULL,
  `severity_level` int(11) DEFAULT NULL,
  `severity_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`symptom_id`, `session_id`, `symptom_type`, `symptom_name`, `severity_level`, `severity_description`) VALUES
(1, 4, 'general', 'ท้องผูก', 1, 'ระดับเล็กน้อย'),
(2, 5, 'breathing', 'ไอ', 1, 'ระดับเล็กน้อย'),
(3, 5, 'general', 'คลื่นไส้', 1, 'ระดับเล็กน้อย'),
(4, 6, 'general', 'นอนไม่หลับ', 1, 'ระดับเล็กน้อย'),
(5, 7, 'general', 'นอนไม่หลับ', 1, 'ระดับเล็กน้อย'),
(6, 8, 'general', 'นอนไม่หลับ', 1, 'ระดับเล็กน้อย'),
(7, 9, 'general', 'ท้องผูก', 1, 'ระดับเล็กน้อย'),
(8, 10, 'general', 'ท้องผูก', 1, 'ระดับเล็กน้อย'),
(9, 11, 'general', 'นอนไม่หลับ', 1, 'ระดับเล็กน้อย'),
(10, 13, 'general', 'คลื่นไส้', 1, 'ระดับเล็กน้อย'),
(11, 15, 'breathing', 'หอบเหนื่อย', 6, 'ระดับสูง'),
(12, 15, 'nervous-system', 'แขนขาอ่อนแรงด้านใดด้านหนึ่ง', 5, 'ระดับปานกลาง'),
(13, 15, 'general', 'คลื่นไส้', 5, 'ระดับปานกลาง'),
(14, 16, 'general', 'นอนไม่หลับ', 1, 'ระดับเล็กน้อย'),
(15, 17, 'general', 'นอนไม่หลับ', 1, 'ระดับเล็กน้อย'),
(16, 18, 'general', 'นอนไม่หลับ', 1, 'ระดับเล็กน้อย'),
(17, 19, 'general', 'นอนไม่หลับ', 1, 'ระดับเล็กน้อย'),
(18, 21, 'general', 'ปวดข้างศีรษะแถวขมับ', 1, 'ระดับเล็กน้อย'),
(19, 21, 'general', 'นอนไม่หลับ', 1, 'ระดับเล็กน้อย'),
(20, 22, 'general', 'ปวดข้างศีรษะแถวขมับ', 1, 'ระดับเล็กน้อย'),
(21, 22, 'general', 'นอนไม่หลับ', 1, 'ระดับเล็กน้อย'),
(22, 23, 'general', 'ท้องผูก', 1, 'ระดับเล็กน้อย'),
(23, 24, 'general', 'นอนไม่หลับ', 1, 'ระดับเล็กน้อย'),
(24, 26, 'breathing', 'น้ำมูก', 1, 'ระดับเล็กน้อย'),
(25, 26, 'nervous-system', 'ชาหรือตึงในส่วนใดส่วนหนึ่งของร่างกาย', 1, 'ระดับเล็กน้อย'),
(26, 26, 'general', 'ปวดบริเวณหน้าผาก', 1, 'ระดับเล็กน้อย'),
(27, 26, 'general', 'คลื่นไส้', 1, 'ระดับเล็กน้อย'),
(28, 27, 'breathing', 'น้ำมูก', 1, 'ระดับเล็กน้อย'),
(29, 27, 'nervous-system', 'ชาหรือตึงในส่วนใดส่วนหนึ่งของร่างกาย', 1, 'ระดับเล็กน้อย'),
(30, 27, 'general', 'ปวดข้างศีรษะแถวขมับ', 1, 'ระดับเล็กน้อย'),
(31, 27, 'general', 'คลื่นไส้', 1, 'ระดับเล็กน้อย'),
(32, 32, 'breathing', 'น้ำมูก', 1, 'ระดับเล็กน้อย'),
(33, 32, 'general', 'ปวดข้างศีรษะแถวขมับ', 1, 'ระดับเล็กน้อย'),
(34, 32, 'general', 'คลื่นไส้', 1, 'ระดับเล็กน้อย'),
(35, 33, 'breathing', 'ไอเป็นเลือด', 4, 'ระดับปานกลาง'),
(36, 33, 'nervous-system', 'มองเห็นภาพซ้อน หรือมองไม่ชัด', 10, 'ระดับรุนแรงมาก'),
(37, 33, 'general', 'ปวดบริเวณหน้าผาก', 1, 'ระดับเล็กน้อย'),
(38, 33, 'general', 'ท้องผูก', 5, 'ระดับปานกลาง'),
(39, 34, 'general', 'ปวดบริเวณท้ายทอยและต้นคอ', 10, 'ระดับรุนแรงมาก'),
(40, 34, 'general', 'นอนไม่หลับ', 7, 'ระดับสูง'),
(41, 35, 'nervous-system', 'ใบหน้าเบี้ยวหรือปากตกข้างเดียว', 1, 'ระดับเล็กน้อย'),
(42, 36, 'nervous-system', 'มองเห็นภาพซ้อน หรือมองไม่ชัด', 1, 'ระดับเล็กน้อย'),
(43, 36, 'general', 'ปวดข้างศีรษะแถวขมับ', 1, 'ระดับเล็กน้อย'),
(44, 37, 'nervous-system', 'แขนขาอ่อนแรงด้านใดด้านหนึ่ง', 1, 'ระดับเล็กน้อย'),
(45, 37, 'general', 'ปวดข้างศีรษะแถวขมับ', 1, 'ระดับเล็กน้อย'),
(46, 37, 'general', 'นอนไม่หลับ', 1, 'ระดับเล็กน้อย'),
(47, 38, 'general', 'ปวดบริเวณคอและส่วนฐานของกะโหลกท้ายทอย', 1, 'ระดับเล็กน้อย'),
(48, 39, 'general', 'ปวดบริเวณคอและส่วนฐานของกะโหลกท้ายทอย', 1, 'ระดับเล็กน้อย'),
(49, 40, 'breathing', 'น้ำมูก', 1, 'ระดับเล็กน้อย'),
(50, 40, 'nervous-system', 'ชาหรือตึงในส่วนใดส่วนหนึ่งของร่างกาย', 1, 'ระดับเล็กน้อย'),
(51, 40, 'general', 'ปวดบริเวณท้ายทอยและต้นคอ', 1, 'ระดับเล็กน้อย'),
(52, 40, 'general', 'คลื่นไส้', 1, 'ระดับเล็กน้อย'),
(53, 41, 'breathing', 'น้ำมูก', 1, 'ระดับเล็กน้อย'),
(54, 41, 'general', 'ปวดบริเวณหน้าผาก', 1, 'ระดับเล็กน้อย'),
(55, 41, 'general', 'ท้องเสีย', 1, 'ระดับเล็กน้อย'),
(56, 42, 'general', 'ปวดเฉพาะรอบตา', 1, 'ระดับเล็กน้อย'),
(57, 42, 'general', 'ท้องเสีย', 1, 'ระดับเล็กน้อย'),
(58, 43, 'breathing', 'ไอเป็นเลือด', 1, 'ระดับเล็กน้อย'),
(59, 43, 'nervous-system', 'ใบหน้าเบี้ยวหรือปากตกข้างเดียว', 1, 'ระดับเล็กน้อย'),
(60, 43, 'general', 'ปวดบนกลางศีรษะ', 1, 'ระดับเล็กน้อย'),
(61, 43, 'general', 'เวียนหัว', 1, 'ระดับเล็กน้อย'),
(62, 44, 'nervous-system', 'มองเห็นภาพซ้อน หรือมองไม่ชัด', 1, 'ระดับเล็กน้อย'),
(63, 44, 'general', 'ปวดบริเวณหน้าผาก', 1, 'ระดับเล็กน้อย'),
(64, 44, 'general', 'เวียนหัว', 1, 'ระดับเล็กน้อย'),
(65, 45, 'breathing', 'หอบเหนื่อย', 1, 'ระดับเล็กน้อย'),
(66, 45, 'general', 'ปวดบนกลางศีรษะ', 1, 'ระดับเล็กน้อย'),
(67, 45, 'general', 'คลื่นไส้', 1, 'ระดับเล็กน้อย'),
(68, 46, 'breathing', 'น้ำมูก', 1, 'ระดับเล็กน้อย'),
(69, 46, 'general', 'ปวดบริเวณหน้าผาก', 1, 'ระดับเล็กน้อย'),
(70, 46, 'general', 'เวียนหัว', 1, 'ระดับเล็กน้อย'),
(71, 47, 'nervous-system', 'ชาหรือตึงในส่วนใดส่วนหนึ่งของร่างกาย', 10, 'ระดับรุนแรงมาก'),
(72, 48, 'general', 'ปวดบริเวณคอและส่วนฐานของกะโหลกท้ายทอย', 1, 'ระดับเล็กน้อย'),
(73, 48, 'general', 'คลื่นไส้', 6, 'ระดับสูง'),
(74, 49, 'breathing', 'ไอ', 1, 'ระดับเล็กน้อย'),
(75, 49, 'nervous-system', 'มองเห็นภาพซ้อน หรือมองไม่ชัด', 1, 'ระดับเล็กน้อย'),
(76, 49, 'general', 'ปวดบริเวณหน้าผาก', 1, 'ระดับเล็กน้อย'),
(77, 49, 'general', 'ท้องผูก', 1, 'ระดับเล็กน้อย'),
(78, 50, 'breathing', 'น้ำมูก', 1, 'ระดับเล็กน้อย'),
(79, 50, 'general', 'ปวดบริเวณหน้าผาก', 1, 'ระดับเล็กน้อย'),
(80, 50, 'general', 'คลื่นไส้', 1, 'ระดับเล็กน้อย'),
(81, 51, 'breathing', 'ไอเป็นเลือด', 1, 'ระดับเล็กน้อย'),
(82, 51, 'nervous-system', 'ชาหรือตึงในส่วนใดส่วนหนึ่งของร่างกาย', 1, 'ระดับเล็กน้อย'),
(83, 51, 'general', 'ปวดบริเวณหน้าผาก', 1, 'ระดับเล็กน้อย'),
(84, 51, 'general', 'คลื่นไส้', 1, 'ระดับเล็กน้อย');

-- --------------------------------------------------------

--
-- Table structure for table `temperatures`
--

CREATE TABLE `temperatures` (
  `temperature_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `temperature_range` varchar(50) DEFAULT NULL,
  `duration` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temperatures`
--

INSERT INTO `temperatures` (`temperature_id`, `session_id`, `temperature_range`, `duration`) VALUES
(1, 4, NULL, NULL),
(2, 5, NULL, NULL),
(3, 6, NULL, NULL),
(4, 7, NULL, NULL),
(5, 8, NULL, NULL),
(6, 9, NULL, NULL),
(7, 10, NULL, NULL),
(8, 11, NULL, NULL),
(9, 12, NULL, NULL),
(10, 13, NULL, NULL),
(11, 14, NULL, NULL),
(12, 15, NULL, NULL),
(13, 16, NULL, NULL),
(14, 17, NULL, NULL),
(15, 18, NULL, NULL),
(16, 19, NULL, NULL),
(17, 20, NULL, NULL),
(18, 21, NULL, NULL),
(19, 22, NULL, NULL),
(20, 23, NULL, NULL),
(21, 24, NULL, NULL),
(22, 25, NULL, NULL),
(23, 26, NULL, NULL),
(24, 27, NULL, NULL),
(25, 28, NULL, NULL),
(26, 29, NULL, NULL),
(27, 30, NULL, NULL),
(28, 31, NULL, NULL),
(29, 32, NULL, NULL),
(30, 33, NULL, NULL),
(31, 34, NULL, NULL),
(32, 35, NULL, NULL),
(33, 36, NULL, NULL),
(34, 37, NULL, NULL),
(35, 38, NULL, NULL),
(36, 39, NULL, NULL),
(37, 40, NULL, NULL),
(38, 41, NULL, NULL),
(39, 42, NULL, NULL),
(40, 43, NULL, NULL),
(41, 44, '37.6°C - 38.2°C', '1_day'),
(42, 45, '36.5°C - 37.5°C', '1_day'),
(43, 46, '37.6°C - 38.2°C', '2_days'),
(44, 47, '37.6°C - 38.2°C', 'more_than_3_days'),
(45, 48, 'มากกว่า 40°C', 'more_than_3_days'),
(46, 49, '37.6°C - 38.2°C', '1_day'),
(47, 50, '37.6°C - 38.2°C', '1_day'),
(48, 51, '36.5°C - 37.5°C', '1_day');

-- --------------------------------------------------------

--
-- Table structure for table `users_dusi`
--

CREATE TABLE `users_dusi` (
  `user_id` int(11) NOT NULL,
  `name_title` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `registration_date` date DEFAULT curdate(),
  `identification` char(13) NOT NULL,
  `sex` enum('ชาย','หญิง') NOT NULL,
  `id_card` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_dusi`
--

INSERT INTO `users_dusi` (`user_id`, `name_title`, `name`, `surname`, `birthday`, `registration_date`, `identification`, `sex`, `id_card`) VALUES
(1, 'นางสาว', 'ภักดี', 'รักษาดี', '2024-10-01', '2024-11-19', '1234567891231', 'หญิง', '00000001'),
(2, 'เด็กชาย', 'ใส่ใจ', 'รักษาดี', '2024-10-02', '2024-11-19', '1234567891233', 'ชาย', '00000003'),
(3, 'นาย', 'ดุสิต', 'รักษาดี', '2024-10-04', '2024-11-19', '1234567891230', 'ชาย', '00000000'),
(4, 'นางสาว', 'สุขภาพ', 'รักษาดี', '2024-10-07', '2024-11-19', '1234567891234', 'หญิง', '00000004'),
(5, 'เด็กหญิง', 'สุภาพ', 'รักษาดี', '2024-10-16', '2024-11-19', '1234567891232', 'หญิง', '00000002'),
(6, 'นาย', 'ต้นไม้', 'รักษาดี', '2556-05-15', '2024-11-20', '0001110002223', 'หญิง', '20110826');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chronic_diseases`
--
ALTER TABLE `chronic_diseases`
  ADD PRIMARY KEY (`disease_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `risks`
--
ALTER TABLE `risks`
  ADD PRIMARY KEY (`risk_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`symptom_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `temperatures`
--
ALTER TABLE `temperatures`
  ADD PRIMARY KEY (`temperature_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `users_dusi`
--
ALTER TABLE `users_dusi`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `identification` (`identification`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chronic_diseases`
--
ALTER TABLE `chronic_diseases`
  MODIFY `disease_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `risks`
--
ALTER TABLE `risks`
  MODIFY `risk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `symptom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `temperatures`
--
ALTER TABLE `temperatures`
  MODIFY `temperature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users_dusi`
--
ALTER TABLE `users_dusi`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chronic_diseases`
--
ALTER TABLE `chronic_diseases`
  ADD CONSTRAINT `chronic_diseases_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`session_id`) ON DELETE CASCADE;

--
-- Constraints for table `risks`
--
ALTER TABLE `risks`
  ADD CONSTRAINT `risks_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`session_id`) ON DELETE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_dusi` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD CONSTRAINT `symptoms_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`session_id`) ON DELETE CASCADE;

--
-- Constraints for table `temperatures`
--
ALTER TABLE `temperatures`
  ADD CONSTRAINT `temperatures_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`session_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
