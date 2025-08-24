-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 24, 2025 at 03:38 AM
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
-- Database: `webbanbia`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `iduser` int(11) DEFAULT 0,
  `bill_name` varchar(255) DEFAULT NULL,
  `bill_address` varchar(255) DEFAULT NULL,
  `bill_tel` varchar(50) DEFAULT NULL,
  `bill_email` varchar(100) DEFAULT NULL,
  `bill_pttt` tinyint(1) DEFAULT 1 COMMENT '1: tiền mặt, 2: chuyển khoản, 3: Ship COD',
  `ngaydathang` varchar(50) DEFAULT NULL,
  `total` int(11) DEFAULT 0,
  `bill_status` tinyint(1) DEFAULT 0 COMMENT '0: Hàng mới, 1: Đang chờ, 2: Đang giao hàng, 3: Đã giao hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `iduser`, `bill_name`, `bill_address`, `bill_tel`, `bill_email`, `bill_pttt`, `ngaydathang`, `total`, `bill_status`) VALUES
(200, 92, 'NGUYỄN THÚY HUYỀN', 'TPCT', 'TPCT', 'TPCT@gmail.com', 2, '2025-08-08 14:45:49', 2560000, 0),
(201, 92, 'Lê Hoàng Khang', 'SDSD', '223', 'khangcmc103@gmail.com', 1, '2025-08-08 14:46:32', 3160000, 0),
(202, 92, 'Lê Hoàng Khang', 'CXCC', '07628354002', 'khangcmc103@gmail.com', 3, '2025-08-08 14:47:16', 320000, 0),
(203, 92, 'Lê Hoàng Khang', 'sdsd', '07628354001', 'khangcmc103@gmail.com', 3, '2025-08-08 14:50:56', 640000, 1),
(204, 92, 'Lê Hoàng Khang', 'sdsd', '07628354002', 'khangcmc103@gmail.com', 1, '2025-08-08 14:52:42', 640000, 0),
(206, 92, 'Lê Hoàng Khang', 'Đại thành ngã bảy HG', '07628354002', 'khangcmc103@gmail.com', 2, '2025-08-14 08:27:39', 1280000, 0),
(207, 92, 'Lê Hoàng Khang', 'Đại thành ngã bảy HG', '07628354002', 'khangcmc103@gmail.com', 1, '2025-08-17 15:45:57', 1000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `binhluan`
--

CREATE TABLE `binhluan` (
  `id` int(11) NOT NULL,
  `noidung` varchar(255) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idpro` int(11) NOT NULL,
  `ngaybinhluan` varchar(30) NOT NULL,
  `trangthai` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `binhluan`
--

INSERT INTO `binhluan` (`id`, `noidung`, `iduser`, `idpro`, `ngaybinhluan`, `trangthai`) VALUES
(169, 'ANH YÊU EM NHIỀU LẮM', 92, 86, '2025-08-11 08:26:22', 0),
(170, 'HI', 92, 86, '2025-08-11 08:26:48', 1),
(173, 'sdsd', 92, 86, '2025-08-17 16:53:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idpro` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `soluong` int(11) NOT NULL,
  `thanhtien` int(11) NOT NULL,
  `idbill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `iduser`, `idpro`, `img`, `name`, `price`, `soluong`, `thanhtien`, `idbill`) VALUES
(48, 53, 59, 'văn.jpg', 'vvv11', 12000000, 2, 24000000, 47),
(49, 53, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 48),
(50, 53, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 49),
(51, 53, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 50),
(52, 53, 59, 'văn.jpg', 'vvv11', 12000000, 2, 24000000, 50),
(53, 53, 58, 'heine.jpg', 'Lê chí tường', 500000, 3, 1500000, 50),
(54, 54, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 51),
(55, 54, 59, 'văn.jpg', 'vvv11', 12000000, 2, 24000000, 51),
(56, 54, 58, 'heine.jpg', 'Lê chí tường', 500000, 3, 1500000, 51),
(57, 54, 51, '3.png', 'Lê Hoàng Khang123', 45555, 4, 182220, 51),
(58, 54, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 52),
(59, 54, 59, 'văn.jpg', 'vvv11', 12000000, 2, 24000000, 52),
(60, 54, 58, 'heine.jpg', 'Lê chí tường', 500000, 3, 1500000, 52),
(61, 54, 51, '3.png', 'Lê Hoàng Khang123', 45555, 4, 182220, 52),
(62, 54, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 53),
(63, 54, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 54),
(64, 54, 59, 'văn.jpg', 'vvv11', 12000000, 2, 24000000, 54),
(65, 54, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 55),
(66, 54, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 56),
(67, 54, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 57),
(68, 54, 59, 'văn.jpg', 'vvv11', 12000000, 2, 24000000, 58),
(69, 54, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 59),
(70, 54, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 60),
(71, 54, 59, 'văn.jpg', 'vvv11', 12000000, 1, 12000000, 60),
(72, 54, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 61),
(73, 54, 60, 'heine.jpg', 'Tablet', 23000, 3, 69000, 62),
(74, 54, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 63),
(75, 54, 60, 'heine.jpg', 'Tablet', 23000, 5, 115000, 64),
(76, 54, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 65),
(77, 54, 59, 'văn.jpg', 'vvv11', 12000000, 2, 24000000, 66),
(78, 54, 59, 'văn.jpg', 'vvv11', 12000000, 2, 24000000, 67),
(79, 54, 60, 'heine.jpg', 'Tablet', 23000, 5, 115000, 68),
(80, 54, 58, 'heine.jpg', 'Lê chí tường', 500000, 4, 2000000, 69),
(81, 54, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 70),
(82, 54, 59, 'văn.jpg', 'vvv11', 12000000, 2, 24000000, 70),
(83, 54, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 71),
(84, 54, 59, 'văn.jpg', 'vvv11', 12000000, 1, 12000000, 72),
(85, 54, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 73),
(86, 54, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 74),
(87, 54, 59, 'văn.jpg', 'vvv11', 12000000, 3, 36000000, 75),
(88, 54, 58, 'heine.jpg', 'Lê chí tường', 500000, 4, 2000000, 76),
(89, 54, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 77),
(90, 54, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 78),
(91, 54, 58, 'heine.jpg', 'Lê chí tường', 500000, 2, 1000000, 78),
(92, 54, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 79),
(93, 54, 48, 'văn.jpg', 'Lê Hoàng Khang', 120000, 2, 240000, 79),
(94, 54, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 80),
(95, 54, 59, 'văn.jpg', 'vvv11', 12000000, 1, 12000000, 80),
(96, 54, 58, 'heine.jpg', 'Lê chí tường', 500000, 1, 500000, 80),
(97, 54, 51, '3.png', 'Lê Hoàng Khang123', 45555, 1, 45555, 80),
(98, 54, 48, 'văn.jpg', 'Lê Hoàng Khang', 120000, 1, 120000, 80),
(99, 54, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 81),
(100, 54, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 82),
(101, 54, 59, 'văn.jpg', 'vvv11', 12000000, 2, 24000000, 83),
(102, 54, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 83),
(103, 54, 59, 'văn.jpg', 'vvv11', 12000000, 10, 120000000, 84),
(104, 54, 58, 'heine.jpg', 'Lê chí tường', 500000, 1, 500000, 84),
(105, 54, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 85),
(106, 54, 59, 'văn.jpg', 'vvv11', 12000000, 2, 24000000, 85),
(107, 54, 51, '3.png', 'Lê Hoàng Khang123', 45555, 3, 136665, 85),
(108, 54, 58, 'heine.jpg', 'Lê chí tường', 500000, 1, 500000, 86),
(109, 54, 58, 'heine.jpg', 'Lê chí tường', 500000, 1, 500000, 87),
(110, 54, 59, 'văn.jpg', 'vvv11', 12000000, 10, 120000000, 88),
(111, 54, 48, 'văn.jpg', 'Lê Hoàng Khang', 120000, 16, 1920000, 89),
(112, 54, 58, 'heine.jpg', 'Lê chí tường', 500000, 20, 10000000, 90),
(113, 54, 59, 'văn.jpg', 'vvv11', 12000000, 2, 24000000, 91),
(114, 30, 59, 'văn.jpg', 'vvv11', 12000000, 1, 12000000, 92),
(115, 56, 59, 'văn.jpg', 'vvv11', 12000000, 2, 24000000, 93),
(116, 56, 58, 'heine.jpg', 'Lê chí tường', 500000, 1, 500000, 93),
(117, 56, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 94),
(118, 56, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 95),
(119, 56, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 96),
(120, 56, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 97),
(121, 56, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 98),
(122, 56, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 99),
(123, 56, 59, 'văn.jpg', 'vvv11', 12000000, 1, 12000000, 99),
(124, 56, 58, 'heine.jpg', 'Lê chí tường', 500000, 1, 500000, 99),
(125, 56, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 100),
(126, 56, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 101),
(127, 56, 59, 'văn.jpg', 'vvv11', 12000000, 1, 12000000, 101),
(128, 56, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 102),
(129, 56, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 103),
(130, 56, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 104),
(131, 56, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 105),
(132, 56, 51, '3.png', 'Lê Hoàng Khang123', 45555, 5, 227775, 106),
(133, 56, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 107),
(134, 56, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 108),
(135, 56, 59, 'văn.jpg', 'vvv11', 12000000, 5, 60000000, 109),
(136, 56, 60, 'heine.jpg', 'Tablet', 23000, 5, 115000, 110),
(137, 56, 51, '3.png', 'Lê Hoàng Khang123', 45555, 2, 91110, 111),
(138, 56, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 112),
(139, 0, 58, 'heine.jpg', 'Lê chí tường', 500000, 1, 500000, 113),
(140, 0, 60, 'heine.jpg', 'Tablet', 23000, 2, 46000, 113),
(141, 0, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 114),
(142, 0, 59, 'văn.jpg', 'vvv11', 12000000, 1, 12000000, 114),
(143, 57, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 0),
(144, 57, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 0),
(145, 57, 59, 'văn.jpg', 'vvv11', 12000000, 1, 12000000, 0),
(146, 57, 58, 'heine.jpg', 'Lê chí tường', 500000, 1, 500000, 0),
(147, 57, 51, '3.png', 'Lê Hoàng Khang123', 45555, 1, 45555, 0),
(148, 57, 48, 'văn.jpg', 'Lê Hoàng Khang', 120000, 1, 120000, 0),
(149, 57, 60, 'heine.jpg', 'Tablet', 23000, 1, 23000, 115),
(150, 71, 58, 'heine.jpg', 'Lê chí tường', 500000, 4, 2000000, 116),
(151, 71, 62, 'hi-removebg-preview.png', 'Lê Hoàng Khang', 4444444, 1, 4444444, 117),
(152, 71, 59, 'văn.jpg', 'vvv11', 12000000, 1, 12000000, 118),
(153, 71, 48, 'văn.jpg', 'Lê Hoàng Khang', 120000, 1, 120000, 119),
(154, 79, 62, 'hi-removebg-preview.png', 'Lê Hoàng Khang', 4444444, 2, 8888888, 120),
(155, 79, 51, '3.png', 'Lê Hoàng Khang123', 45555, 1, 45555, 120),
(156, 79, 60, 'hi-removebg-preview.png', 'Tablet', 23000, 1, 23000, 121),
(157, 79, 51, '3.png', 'Lê Hoàng Khang123', 45555, 1, 45555, 122),
(158, 79, 51, '3.png', 'Lê Hoàng Khang123', 45555, 1, 45555, 123),
(159, 79, 62, 'hi-removebg-preview.png', 'Lê Hoàng Khang', 4444444, 1, 4444444, 124),
(160, 79, 62, 'hi-removebg-preview.png', 'Lê Hoàng Khang', 4444444, 1, 4444444, 125),
(161, 79, 60, 'hi-removebg-preview.png', 'Tablet', 23000, 1, 23000, 126),
(162, 79, 62, 'hi-removebg-preview.png', 'Lê Hoàng Khang', 4444444, 1, 4444444, 127),
(163, 79, 62, 'hi-removebg-preview.png', 'Lê Hoàng Khang', 4444444, 1, 4444444, 128),
(164, 79, 62, 'hi-removebg-preview.png', 'Lê Hoàng Khang', 4444444, 1, 4444444, 129),
(165, 79, 62, 'hi-removebg-preview.png', 'Lê Hoàng Khang', 4444444, 1, 4444444, 130),
(166, 79, 60, 'hi-removebg-preview.png', 'Tablet', 23000, 1, 23000, 131),
(167, 79, 62, 'hi-removebg-preview.png', 'Lê Hoàng Khang', 4444444, 1, 4444444, 132),
(168, 79, 60, 'hi-removebg-preview.png', 'Tablet', 23000, 1, 23000, 132),
(169, 79, 62, 'hi-removebg-preview.png', 'Lê Hoàng Khang', 4444444, 1, 4444444, 133),
(170, 79, 62, 'hi-removebg-preview.png', 'Lê Hoàng Khang', 4444444, 1, 4444444, 134),
(171, 79, 51, '3.png', 'Lê Hoàng Khang123', 45555, 5, 227775, 135),
(172, 79, 48, 'văn.jpg', 'Lê Hoàng Khang', 120000, 5, 600000, 135),
(173, 79, 59, 'văn.jpg', 'vvv11', 12000000, 10, 120000000, 136),
(174, 79, 60, 'hi-removebg-preview.png', 'Tablet', 23000, 10, 230000, 137),
(175, 81, 62, 'hi-removebg-preview.png', 'Lê Hoàng Khang', 4444444, 1, 4444444, 138),
(176, 81, 63, 'logo_gioi_tre_vinh_cheo_corrected.png', 'Lê Hoàng Khang', 343434, 1, 343434, 139),
(177, 81, 64, '2.png', 'Nguyễn Thị Nùng', 12000, 1, 12000, 140),
(178, 81, 64, '2.png', 'Nguyễn Thị Nùng', 12000, 1, 12000, 141),
(179, 81, 66, 'logo_gioi_tre_vinh_cheo_final.png', 'Tablet', 2300000, 10, 23000000, 142),
(180, 81, 68, 'logo_gioi_tre_vinh_cheo_final.png', 'vvv11', 12000, 15, 180000, 143),
(181, 81, 66, 'logo_gioi_tre_vinh_cheo_final.png', 'Tablet', 2300000, 2, 4600000, 144),
(182, 81, 68, 'logo_gioi_tre_vinh_cheo_final.png', 'vvv11', 12000, 1, 12000, 145),
(183, 81, 68, 'logo_gioi_tre_vinh_cheo_final.png', 'vvv11', 12000, 1, 12000, 145),
(184, 81, 68, 'logo_gioi_tre_vinh_cheo_final.png', 'vvv11', 12000, 6, 72000, 145),
(185, 81, 64, '2.png', 'Nguyễn Thị Nùng', 12000, 1, 12000, 146),
(186, 81, 68, 'logo_gioi_tre_vinh_cheo_final.png', 'vvv11', 12000, 1, 12000, 147),
(187, 81, 66, 'logo_gioi_tre_vinh_cheo_final.png', 'Tablet', 2300000, 2, 4600000, 148),
(188, 81, 73, 'tải_xuống-removebg-preview.png', 'Lê Hoàng Khang1', 10000000, 1, 10000000, 149),
(189, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 1, 270000, 0),
(190, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 1, 270000, 150),
(191, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 1, 270000, 151),
(192, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 1, 270000, 152),
(193, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 1, 270000, 153),
(194, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 3, 810000, 153),
(195, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 5, 1350000, 154),
(196, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 1, 270000, 156),
(197, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 1, 270000, 157),
(198, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 10, 2700000, 158),
(199, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 1, 270000, 159),
(200, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 1, 270000, 160),
(201, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 1, 270000, 161),
(202, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 5, 1350000, 162),
(203, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 10, 2700000, 163),
(204, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 1, 270000, 164),
(205, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 3, 810000, 165),
(206, 82, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 20, 5400000, 166),
(207, 82, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 1, 270000, 166),
(208, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 1, 270000, 167),
(209, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 1, 270000, 168),
(210, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 270000, 40, 10800000, 169),
(211, 81, 77, '4.jpg', 'Tablet', 100000000, 1, 100000000, 170),
(212, 81, 77, '4.jpg', 'Tablet', 100000000, 1, 100000000, 170),
(213, 81, 77, '4.jpg', 'Tablet', 100000000, 1, 100000000, 171),
(214, 81, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 27000000, 1, 27000000, 172),
(215, 87, 77, '4.jpg', 'Tablet', 100000000, 3, 100000000, 173),
(216, 87, 77, '4.jpg', 'Tablet', 100000000, 10, 100000000, 174),
(217, 87, 77, '4.jpg', 'Tablet', 100000000, 1, 100000000, 175),
(218, 88, 75, '73-t_bia_sai_gon_lager_thung_24x330ml_3cd74034be1c4e138c7f65ae9c731b37_ac9eb2aca51d4fb498b8c93acd124769_1024x1024.jpg', 'Bia Sài Gòn Lager thùng 24x330ml', 27000000, 1, 27000000, 176),
(219, 88, 77, '4.jpg', 'Tablet', 100000000, 4, 100000000, 177),
(220, 88, 80, '111.jpg', 'BIA HƠI HÀ NỘI KEG 2 Lít', 500000, 5, 2500000, 178),
(221, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 1, 320000, 179),
(222, 88, 83, 'f804a8ca602620eb636700318cb4e29e-8091.jpg', ' Bia Hơi Hà Nội - Thùng 24 lon 500ML', 400000, 10, 4000000, 180),
(223, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 10, 640000, 181),
(224, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 2, 320000, 182),
(225, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 3, 640000, 183),
(226, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 6, 1600000, 184),
(227, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 3, 320000, 185),
(228, 88, 85, 'thiet-ke-chua-co-ten-5616.png', 'Bia Chai Hà Nội', 340000, 2, 340000, 185),
(229, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 30, 320000, 186),
(230, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 5, 640000, 187),
(231, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 14, 320000, 188),
(232, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 5, 320000, 189),
(233, 88, 84, '41cd07f8186fcd31947e-7900.jpg', ' BIA HƠI HÀ NỘI KEG 50 LÍT', 450000, 5, 450000, 189),
(234, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 3, 640000, 190),
(235, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 2, 640000, 191),
(236, 88, 85, 'thiet-ke-chua-co-ten-5616.png', 'Bia Chai Hà Nội', 340000, 6, 1700000, 192),
(237, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 2, 320000, 193),
(238, 88, 85, 'thiet-ke-chua-co-ten-5616.png', 'Bia Chai Hà Nội', 340000, 2, 340000, 193),
(239, 88, 83, 'f804a8ca602620eb636700318cb4e29e-8091.jpg', ' Bia Hơi Hà Nội - Thùng 24 lon 500ML', 400000, 2, 400000, 193),
(240, 88, 85, 'thiet-ke-chua-co-ten-5616.png', 'Bia Chai Hà Nội', 340000, 1, 340000, 194),
(241, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 2, 640000, 195),
(242, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 3, 640000, 196),
(243, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 2, 640000, 197),
(244, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 3, 640000, 198),
(245, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 3, 320000, 199),
(246, 88, 85, 'thiet-ke-chua-co-ten-5616.png', 'Bia Chai Hà Nội', 340000, 4, 680000, 199),
(247, 92, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 8, 1600000, 200),
(248, 92, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 8, 1600000, 201),
(249, 92, 82, 'ken1l-6625.png', 'Bia Tươi Hà Nội Keg 1 Lít', 300000, 2, 600000, 201),
(250, 92, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 1, 320000, 202),
(251, 92, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 2, 640000, 203),
(252, 92, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 2, 640000, 204),
(253, 92, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 2, 640000, 205),
(254, 92, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000, 4, 640000, 206),
(255, 92, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 1000000, 1, 1000000, 207);

-- --------------------------------------------------------

--
-- Table structure for table `cart_temp`
--

CREATE TABLE `cart_temp` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idpro` int(11) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `thanhtien` decimal(10,2) DEFAULT NULL,
  `added_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_temp`
--

INSERT INTO `cart_temp` (`id`, `iduser`, `idpro`, `img`, `name`, `price`, `soluong`, `thanhtien`, `added_at`) VALUES
(107, 88, 86, 'thiet-ke-chua-co-ten-1-6911.png', 'Bia Lon Hà Nội', 320000.00, 3, 320000.00, '2025-08-08 13:13:52'),
(108, 88, 85, 'thiet-ke-chua-co-ten-5616.png', 'Bia Chai Hà Nội', 340000.00, 4, 680000.00, '2025-08-08 13:14:16');

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`id`, `name`) VALUES
(83, 'Bia Hoegaarden Rosée'),
(84, 'Bia Hà Nội'),
(93, 'Bia Budweiser Sleek '),
(94, ' Bia Corona Extra');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double(10,2) DEFAULT 0.00,
  `img` varchar(255) DEFAULT NULL,
  `mota` text DEFAULT NULL,
  `luotxem` int(11) DEFAULT 0,
  `iddm` int(11) NOT NULL,
  `anhphu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id`, `name`, `price`, `img`, `mota`, `luotxem`, `iddm`, `anhphu`) VALUES
(82, 'Bia Tươi Hà Nội Keg 1 Lít', 300000.00, 'ken1l-6625.png', '<p>Sản phẩm Bia tươi&nbsp;H&agrave; Nội chiết trong keg 1l&iacute;t l&agrave; sản phẩm được Tổng c&ocirc;ng ty cổ phần Bia -Rượu - NGK H&agrave; Nội sản xuất v&agrave; đ&oacute;ng trong keg Inox c&oacute; dung t&iacute;ch 1 l&iacute;t.</p>\r\n\r\n<p>Nồng độ cồn 4.3%</p>\r\n\r\n<p>K&eacute;t nhựa 12 keg/12L</p>\r\n\r\n<p>Sản phẩm chỉ d&agrave;nh cho người tr&ecirc;n 18 tuổi.</p>\r\n', 8, 84, 'ken1l-6625.png|z6507013297386f643c6f8f14082dd3bde175c771517b4-3498.jpg'),
(83, ' Bia Hơi Hà Nội - Thùng 24 lon 500ML', 400000.00, 'f804a8ca602620eb636700318cb4e29e-8091.jpg', '<p>Th&ocirc;ng tin sản phẩm<br />\r\n&bull; Dung t&iacute;ch: 500ml/lon<br />\r\n&bull; Nồng độ cồn: 4.1 &plusmn; 0.4%<br />\r\n&bull; Th&agrave;nh phần: nước, mạch nha, gạo, đường, hoa Houblon<br />\r\n&bull; HSD: 5 th&aacute;ng kể từ ng&agrave;y sản xuất</p>\r\n\r\n<p>Bia Hơi H&agrave; Nội: Một n&eacute;t văn ho&aacute; H&agrave; Nội<br />\r\nBia Hơi H&agrave; Nội ra đời v&agrave; ph&aacute;t triển c&ugrave;ng những năm th&aacute;ng thăng trầm của Thủ Đ&ocirc; Ng&agrave;n Năm Văn Hiến. Đổi thay qua từng ng&agrave;y, những sản phẩm mới của Bia Hơi H&agrave; Nội đ&atilde; được ra mắt v&agrave; phổ cập tr&ecirc;n thị trường để n&eacute;t văn ho&aacute; n&agrave;y ng&agrave;y c&agrave;ng đẹp hơn, c&agrave;ng gần gũi với tất cả c&aacute;c thế hệ.</p>\r\n\r\n<p>Lưu &yacute; v&agrave; bảo quản<br />\r\n&bull; Sản phẩm d&agrave;nh cho người tr&ecirc;n 18 tuổi<br />\r\n&bull; Kh&ocirc;ng d&agrave;nh cho phụ nữ đang mang thai<br />\r\n&bull; Thưởng thức c&oacute; tr&aacute;ch nhiệm, đ&atilde; uống đồ uống c&oacute; cồn th&igrave; kh&ocirc;ng l&aacute;i xe<br />\r\n&bull; Ngon hơn khi uống lạnh (10-15̊C)<br />\r\n&bull; Bảo quản nơi kh&ocirc; r&aacute;o, sạch sẽ, tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng mặt trời (&lt;25̊C). Nếu mở lon phải d&ugrave;ng ngay hoặc bảo quản lạnh nếu muốn d&ugrave;ng l&acirc;u</p>\r\n\r\n<p>Lưu &yacute; v&agrave; bảo quản<br />\r\n&bull; Sản phẩm d&agrave;nh cho người tr&ecirc;n 18 tuổi<br />\r\n&bull; Kh&ocirc;ng d&agrave;nh cho phụ nữ đang mang thai<br />\r\n&bull; Thưởng thức c&oacute; tr&aacute;ch nhiệm, đ&atilde; uống đồ uống c&oacute; cồn th&igrave; kh&ocirc;ng l&aacute;i xe<br />\r\n&bull; Ngon hơn khi uống lạnh (10-15̊C)</p>\r\n\r\n<p><br />\r\n<strong><em>Lưu &yacute; v&agrave; bảo quản<br />\r\n&bull; Sản phẩm d&agrave;nh cho người tr&ecirc;n 18 tuổi<br />\r\n&bull; Kh&ocirc;ng d&agrave;nh cho phụ nữ đang mang thai<br />\r\n&bull; Thưởng thức c&oacute; tr&aacute;ch nhiệm, đ&atilde; uống đồ uống c&oacute; cồn th&igrave; kh&ocirc;ng l&aacute;i xe<br />\r\n&bull; Ngon hơn khi uống lạnh (10-15̊C)</em></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n', 38, 84, '3-5-8766.jpg|5-5-3953.jpg|f804a8ca602620eb636700318cb4e29e-8091.jpg'),
(84, ' BIA HƠI HÀ NỘI KEG 50 LÍT', 450000.00, '41cd07f8186fcd31947e-7900.jpg', '<ul>\r\n	<li>Sản phẩm Bia hơi H&agrave; Nội chiết trong keg 50l&iacute;t l&agrave; sản phẩm được Tổng c&ocirc;ng ty cổ phần Bia -Rượu - NGK H&agrave; Nội sản xuất v&agrave; đ&oacute;ng trong keg Inox c&oacute; dung t&iacute;ch 50 l&iacute;t.</li>\r\n	<li>Trọng lượng cả b&igrave; từ 63,5 kg &ndash; 65 kg.</li>\r\n	<li>Trọng lượng tịnh 50 kg +/- 0,5 kg.</li>\r\n	<li>- Nồng độ cồn 4.1%</li>\r\n	<li>Sản phẩm chỉ d&agrave;nh cho người tr&ecirc;n 18 tuổi.</li>\r\n</ul>\r\n', 3, 84, '1.jpg|2.jpg|3.jpg'),
(85, 'Bia Chai Hà Nội', 2000000.00, 'thiet-ke-chua-co-ten-5616.png', '<p>Đối với người y&ecirc;u bia trong nước, sản phẩm bia chai H&agrave; Nội l&agrave; một lựa chọn quen thuộc trong c&aacute;c cuộc tụ tập ăn uống, bất kể đ&oacute; l&agrave; b&ecirc;n m&acirc;m cơm gia đ&igrave;nh hay l&agrave; cuộc vui với bạn b&egrave;. Bia chai H&agrave; Nội được tin d&ugrave;ng kh&ocirc;ng chỉ bởi chất lượng ổn định, m&agrave; c&ograve;n v&igrave; đ&acirc;y l&agrave; một thương hiệu Việt uy t&iacute;n gắn liền với thủ đ&ocirc; H&agrave; Nội v&agrave; được bạn b&egrave; quốc tế biết đến rộng r&atilde;i.</p>\r\n\r\n<p>Được định hướng l&agrave; sản phẩm n&ograve;ng cốt của thương hiệu bia H&agrave; Nội n&oacute;i chung, bia chai H&agrave; Nội c&oacute; sản lượng h&agrave;ng năm chiếm đến 70% tổng sản lượng c&aacute;c sản phẩm của HABECO. Sở dĩ bia chai H&agrave; Nội c&oacute; được vị thế vững ch&atilde;i tr&ecirc;n thị trường c&aacute;c tỉnh v&agrave; th&agrave;nh phố ph&iacute;a Bắc l&agrave; bởi m&agrave;u bia v&agrave;ng s&aacute;ng trong vắt đầy thu h&uacute;t, lớp bọt bền, trắng mịn, vị đắng h&agrave;i ho&agrave;, &ecirc;m dịu, v&agrave; hậu vị lắng đọng.</p>\r\n\r\n<p>Tự tin với chất lượng v&agrave; sức mạnh thương hiệu của sản phẩm n&agrave;y, HABECO hiện đ&atilde; xuất khẩu bia chai H&agrave; Nội 450ml đi c&aacute;c thị trường Đ&agrave;i Loan, H&agrave;n Quốc, v&agrave; &Uacute;c.</p>\r\n\r\n<p>Bản tự c&ocirc;ng bố sản phẩm: Xem chi tiết tại đ&acirc;y</p>\r\n\r\n<p>Th&ocirc;ng b&aacute;o thay đổi nội dung bản tự c&ocirc;ng bố sản phẩm Bia H&agrave; Nội (Chai) 14-6-2022</p>\r\n\r\n<p>** Sản phẩm chỉ d&agrave;nh cho người tr&ecirc;n 18 tuổi.</p>\r\n', 60, 84, 'thiet-ke-chua-co-ten-5616.png'),
(86, 'Bia Lon Hà Nội', 1000000.00, 'thiet-ke-chua-co-ten-1-6911.png', '<p><em>Bia H&agrave; Nội</em>&nbsp;lon l&agrave; một trong những biểu tượng văn h&oacute;a đặc trưng của người d&acirc;n thủ đ&ocirc; H&agrave; Nội. Từ những năm đầu thế kỷ XX,&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;lon đ&atilde; trở th&agrave;nh một phần kh&ocirc;ng thể thiếu trong cuộc sống h&agrave;ng ng&agrave;y của nhiều người H&agrave; Nội. Với vị đặc trưng, hương vị quen thuộc v&agrave; gi&aacute; cả phải chăng,&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;lon đ&atilde; trở th&agrave;nh một biểu tượng của sự giản dị, th&acirc;n thuộc v&agrave; gắn kết cộng đồng người H&agrave; Nội.Trong b&agrave;i viết n&agrave;y, ch&uacute;ng ta sẽ c&ugrave;ng t&igrave;m hiểu về lịch sử ph&aacute;t triển, th&agrave;nh phần v&agrave; c&aacute;ch chế biến, cũng như vị đặc trưng của&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;lon - một n&eacute;t văn h&oacute;a đặc sắc của Thủ đ&ocirc;.</p>\r\n\r\n<h2><a href=\"https://habeco.com.vn/default.aspx?page=product&amp;do=group&amp;category_id=e40be494-9841-4779-81c1-bc3be47d9ada\"><strong>Lịch sử ph&aacute;t triển của&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;Lon</strong></a>1</h2>\r\n\r\n<h3><strong>1.1. Nguy&ecirc;n nh&acirc;n ra đời của&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;Lon</strong></h3>\r\n\r\n<p><em>Bia H&agrave; Nội</em>&nbsp;lon c&oacute; nguồn gốc từ sự giao lưu văn h&oacute;a giữa Việt Nam v&agrave; c&aacute;c nước ch&acirc;u &Acirc;u v&agrave;o thời kỳ thuộc địa. V&agrave;o những năm đầu thế kỷ XX, c&aacute;c nh&agrave; bu&ocirc;n v&agrave; qu&acirc;n đội người Ph&aacute;p đ&atilde; mang văn h&oacute;a bia của ch&acirc;u &Acirc;u đến Việt Nam, trong đ&oacute; c&oacute; H&agrave; Nội. Sự ra đời của c&aacute;c h&atilde;ng bia được xem l&agrave; tiền đề cho sự xuất hiện v&agrave; ph&aacute;t triển của&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;lon.</p>\r\n\r\n<p><em>Bia H&agrave; Nội</em>&nbsp;lon được sản xuất bởi những c&ocirc;ng ty bia lớn như Habeco, Halida v&agrave; c&aacute;c c&ocirc;ng ty địa phương kh&aacute;c. Với c&ocirc;ng nghệ hiện đại, nguồn nguy&ecirc;n liệu chất lượng v&agrave; kinh nghiệm sản xuất l&acirc;u đời, c&aacute;c h&atilde;ng bia đ&atilde; tạo ra những sản phẩm bia ngon, đ&aacute;p ứng nhu cầu ng&agrave;y c&agrave;ng tăng của người d&acirc;n H&agrave; Nội.</p>\r\n\r\n<h3><strong>1.2. Sự phổ biến v&agrave; ảnh hưởng của&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;Lon</strong></h3>\r\n\r\n<p><em>Bia H&agrave; Nội</em>&nbsp;lon nhanh ch&oacute;ng trở th&agrave;nh một phần kh&ocirc;ng thể thiếu trong cuộc sống h&agrave;ng ng&agrave;y của người d&acirc;n H&agrave; Nội. Từ những năm 1950,&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;lon đ&atilde; được phổ biến rộng r&atilde;i tại c&aacute;c qu&aacute;n h&agrave;ng, cơ sở kinh doanh ở thủ đ&ocirc;. Sự ra đời v&agrave; ph&aacute;t triển của c&aacute;c qu&aacute;n bia hơi đ&atilde; g&oacute;p phần đưa&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;lon trở th&agrave;nh một n&eacute;t văn h&oacute;a đặc trưng của người H&agrave; Nội.</p>\r\n\r\n<p>Kh&ocirc;ng chỉ l&agrave; một thức uống giải kh&aacute;t,&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;lon c&ograve;n l&agrave; một phần quan trọng trong c&aacute;c hoạt động x&atilde; hội, giao lưu v&agrave; kết nối cộng đồng của người H&agrave; Nội. Từ những cuộc gặp gỡ bạn b&egrave;, gia đ&igrave;nh đến c&aacute;c sự kiện văn h&oacute;a, thể thao,...&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;lon lu&ocirc;n hiện diện v&agrave; trở th&agrave;nh &quot;chất keo&quot; gắn kết mọi người lại với nhau.</p>\r\n\r\n<h3><strong>1.3. C&aacute;c giai đoạn ph&aacute;t triển của&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;Lon</strong></h3>\r\n\r\n<p>Qu&aacute; tr&igrave;nh ph&aacute;t triển của&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;lon c&oacute; thể chia th&agrave;nh c&aacute;c giai đoạn sau:</p>\r\n\r\n<ul>\r\n	<li>Giai đoạn 1 (từ đầu thế kỷ XX đến trước C&aacute;ch mạng th&aacute;ng T&aacute;m 1945):&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;lon được sản xuất v&agrave; ph&acirc;n phối bởi c&aacute;c c&ocirc;ng ty bia của người Ph&aacute;p, phục vụ chủ yếu cho người nước ngo&agrave;i sinh sống tại Việt Nam.</li>\r\n	<li>Giai đoạn 2 (từ 1945 đến 1986):&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;lon được sản xuất v&agrave; ph&acirc;n phối bởi c&aacute;c doanh nghiệp quốc doanh như Habeco, Halida, phục vụ nhu cầu của người d&acirc;n trong nước. Sản phẩm c&oacute; chất lượng ổn định v&agrave; gi&aacute; cả phải chăng.</li>\r\n	<li>Giai đoạn 3 (từ 1986 đến nay):&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;lon tiếp tục được sản xuất v&agrave; ph&acirc;n phối bởi c&aacute;c c&ocirc;ng ty bia lớn, đồng thời xuất hiện c&aacute;c thương hiệu bia địa phương kh&aacute;c. Chất lượng v&agrave; hương vị sản phẩm được cải thiện v&agrave; đa dạng hơn, đ&aacute;p ứng nhu cầu ng&agrave;y c&agrave;ng cao của người ti&ecirc;u d&ugrave;ng.</li>\r\n</ul>\r\n\r\n<p>Trong suốt qu&aacute; tr&igrave;nh ph&aacute;t triển,&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;lon lu&ocirc;n giữ vững vai tr&ograve; l&agrave; một biểu tượng văn h&oacute;a đặc trưng của người H&agrave; Nội, gắn liền với c&aacute;c hoạt động x&atilde; hội v&agrave; đời sống h&agrave;ng ng&agrave;y của người d&acirc;n thủ đ&ocirc;.</p>\r\n\r\n<h2><a href=\"https://biahoihanoi.vn/bia-lon-ha-noi\"><strong>Th&agrave;nh phần v&agrave; c&aacute;ch chế biến của&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;Lon</strong></a></h2>\r\n\r\n<h3><strong>2.1. Nguy&ecirc;n liệu ch&iacute;nh để sản xuất&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;Lon</strong></h3>\r\n\r\n<p><em>Bia H&agrave; Nội</em>&nbsp;lon được sản xuất từ những nguy&ecirc;n liệu ch&iacute;nh sau:</p>\r\n\r\n<ul>\r\n	<li>Malt: L&agrave; loại ngũ cốc được sấy kh&ocirc; v&agrave; mầm h&oacute;a, cung cấp nguồn tinh bột v&agrave; c&aacute;c enzyme cần thiết cho qu&aacute; tr&igrave;nh l&ecirc;n men.</li>\r\n	<li>Hoa bia (Hops): L&agrave; một loại c&acirc;y leo c&oacute; hoa, cung cấp c&aacute;c hợp chất tạo hương vị đắng v&agrave; bảo quản bia.</li>\r\n	<li>Nước: L&agrave; th&agrave;nh phần ch&iacute;nh, chiếm khoảng 90% th&agrave;nh phần của bia.</li>\r\n	<li>Men bia: L&agrave; vi sinh vật quan trọng, thực hiện qu&aacute; tr&igrave;nh l&ecirc;n men chuyển c&aacute;c chất dinh dưỡng th&agrave;nh ethanol v&agrave; CO2.</li>\r\n</ul>\r\n\r\n<p>Ngo&agrave;i ra, một số nguy&ecirc;n liệu phụ như đường, c&aacute;c loại hương liệu tự nhi&ecirc;n cũng được sử dụng để cải thiện hương vị v&agrave; m&agrave;u sắc của bia.</p>\r\n\r\n<h3><strong>2.2. Quy tr&igrave;nh chế biến&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;Lon</strong></h3>\r\n\r\n<p>Quy tr&igrave;nh sản xuất&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;lon bao gồm c&aacute;c bước ch&iacute;nh sau:</p>\r\n\r\n<ol>\r\n	<li>Ng&acirc;m v&agrave; nảy mầm malt: Qu&aacute; tr&igrave;nh n&agrave;y gi&uacute;p giải ph&oacute;ng c&aacute;c enzym cần thiết cho qu&aacute; tr&igrave;nh l&ecirc;n men.</li>\r\n	<li>Xay v&agrave; nấu: Malt được xay nhỏ v&agrave; ủ với nước n&oacute;ng để tạo ra dịch ngọt chứa tinh bột v&agrave; c&aacute;c chất dinh dưỡng.</li>\r\n	<li>Lọc v&agrave; nấu: Dịch ngọt được lọc v&agrave; nấu s&ocirc;i, sau đ&oacute; được l&agrave;m m&aacute;t nhanh.</li>\r\n	<li>Ủ men v&agrave; l&ecirc;n men: Men bia được th&ecirc;m v&agrave;o dịch ngọt, qu&aacute; tr&igrave;nh l&ecirc;n men diễn ra trong v&ograve;ng 7-10 ng&agrave;y.</li>\r\n	<li>Lọc, tiệt tr&ugrave;ng v&agrave; đ&oacute;ng chai: Sau khi l&ecirc;n men, bia được lọc sạch, tiệt tr&ugrave;ng v&agrave; đ&oacute;ng chai.</li>\r\n</ol>\r\n\r\n<p>Quy tr&igrave;nh sản xuất được kiểm so&aacute;t chặt chẽ, đảm bảo chất lượng v&agrave; hương vị ổn định của&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;lon.</p>\r\n\r\n<h3><strong>2.3. C&ocirc;ng dụng v&agrave; gi&aacute; trị dinh dưỡng của&nbsp;<em>Bia H&agrave; Nội</em>&nbsp;Lon</strong></h3>\r\n\r\n<p><em>Bia H&agrave; Nội</em>&nbsp;lon c&oacute; nhiều c&ocirc;ng dụng v&agrave; gi&aacute; trị dinh dưỡng sau:</p>\r\n\r\n<ul>\r\n	<li>Cung cấp c&aacute;c vitamin, kho&aacute;ng chất như vitamin B, sắt, canxi, phốt pho,... gi&uacute;p bổ sung dinh dưỡng.</li>\r\n	<li>Chứa ethanol với h&agrave;m lượng vừa phải, c&oacute; t&aacute;c dụng tăng cường ti&ecirc;u h&oacute;a v&agrave; k&iacute;ch th&iacute;ch ti&ecirc;u hũ.</li>\r\n	<li>Gi&uacute;p giảm căng thẳng, thư gi&atilde;n cơ bắp sau những ng&agrave;y l&agrave;m việc mệt mỏi.</li>\r\n	<li>Ph&ugrave; hợp với khẩu vị của người Việt, đặc biệt l&agrave; người H&agrave; Nội.</li>\r\n</ul>\r\n\r\n<p>Tuy nhi&ecirc;n, việc sử dụng bia cần phải vừa phải v&agrave; c&oacute; tr&aacute;ch nhiệm để đảm bảo sức khỏe.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 21, 84, 'thiet-ke-chua-co-ten-1-6911.png'),
(89, 'Bia Budweiser 0.0 Thùng 24 Lon 330ml Chính Hãng', 350000.00, 'master1.jpg', '<p><strong>D&Ograve;NG BIA C&Oacute; GI&Aacute; TRỊ THƯƠNG HIỆU CAO NHẤT THẾ GIỚI</strong></p>\r\n\r\n<ul>\r\n	<li>Budweiser &ndash; King of beers &ndash; l&agrave; thương hiệu bia Mỹ đứng đầu thế giới được sản xuất bằng loại mạch nha c&ugrave;ng với hoa bia thượng hạng của Hoa Kỳ v&agrave; Ch&acirc;u &Acirc;u.</li>\r\n	<li>Budweiser l&agrave; &quot;Xuất xứ từ Budweis&quot;, một thị trấn của Czeck t&ecirc;n l&agrave; Budejovice, nơi tạo ra c&ocirc;ng thức nguy&ecirc;n bản để nấu những mẻ bia Budweiser đầu ti&ecirc;n.</li>\r\n	<li>&quot;King of Beers&quot; lần đầu được sử dụng v&agrave;o năm 1898 để kỷ niệm 500 triệu chai Budweiser thượng hạng đầu ti&ecirc;n được sản xuất.</li>\r\n	<li>C&ocirc;ng nghệ ủ bia trong gỗ sồi suốt 3 tuần, gi&uacute;p l&agrave;m sạch men bia trong qu&aacute; tr&igrave;nh trưởng th&agrave;nh v&agrave; cho ra vị bia thơm ngon độc nhất. Bia được ủ với mạch nha tốt nhất, gạo, hoa bia v&agrave; sử dụng một loại men nguy&ecirc;n bản được giữ g&igrave;n từ hơn 140 năm về trước. C&oacute; lẽ hương vị tươi m&aacute;t của bia bắt nguồn từ th&agrave;nh phần gạo.</li>\r\n	<li>Men bia Budweiser được bảo quản trong hơn 139 năm nay tại Bỉ v&agrave; Saint Louis (Mỹ), được r&atilde; đ&ocirc;ng mỗi năm v&agrave; đem đi sử dụng ở tất cả nh&agrave; m&aacute;y AB InBev tr&ecirc;n to&agrave;n thế giới, để cho ra đời c&ugrave;ng một loại bia với hương vị thơm ngon giống nhau.</li>\r\n	<li>Nồng độ cồn Bia Budweiser 0.0% th&iacute;ch hợp cho nhiều đối tượng. Nhưng với tinh thần thưởng thức c&oacute; tr&aacute;ch nhiệm c&ugrave;ng Vua Bia n&ecirc;n ưu ti&ecirc;n tr&ecirc;n 18 tuổi.</li>\r\n</ul>\r\n', 62, 93, 'master2.jpg|master3.jpg'),
(90, 'Combo 2 Thùng 24 Lon 330ml - Tặng 1 Thùng Bia Hoegaarden Rosée 24 Chai 248ml', 1230000.00, '3-1-1t_hoe_white_lon_vb_awo_14.8_cd9bfe581ed6417bb240dd9ee7e753a9_master.jpg', '<ul>\r\n	<li>Được biết đến l&agrave; một trong số những d&ograve;ng bia Bỉ c&oacute; sản lượng b&aacute;n chạy nhất hiện nay. Hoegaarden White c&oacute; xuất ph&aacute;t điểm l&agrave; loại bia l&uacute;a m&igrave; thơm ngon v&agrave; th&uacute; vị.</li>\r\n	<li>Bia được ủ bằng những nguy&ecirc;n liệu hảo hạng nhất, bao gồm vỏ cam Curacao, một ch&uacute;t rau m&ugrave;i v&agrave; hỗn hợp l&uacute;a m&igrave; v&agrave; l&uacute;a mạch tạo n&ecirc;n m&ugrave;i vị tươi m&aacute;t phảng phất hương vị ngọt dịu. Nước bia Hoegaarden nhẹ nh&agrave;ng, lớp bọt bia d&agrave;y v&agrave; c&oacute; m&agrave;u trắng tự nhi&ecirc;n như m&acirc;y.</li>\r\n	<li>Hoegaarden sẽ l&agrave;m h&agrave;i l&ograve;ng từ những người mới bắt đầu uống bia đến những người s&agrave;nh bia nhất.</li>\r\n</ul>\r\n', 1, 83, 'tha__nh-pha____n_382f2c3f46774b4f93dcb14da4e394be_master.jpg|__a____c-__ie____m-no____i-ba____t_bc9a7ddb834c41e5b062e530805bcd41_master.jpg|2t_hoewhite_lon_330ml_0912cce3e358497bafb07b8107110e91_master.png'),
(91, 'Thùng 24 Lon 330ml Phiên Bản FIFA Club World Cup 2025 - Tặng 1 Nón Budweiser Phiên Bản Giới Hạn', 430000.00, 'stock_5_hcm_utc_vua_bia_d8eed04da9034e70b9f2b9129c6db733_master.png', '<h3>Tặng qu&agrave; theo khu vực</h3>\r\n\r\n<h3>Miền Nam: Tặng 1 N&oacute;n Budweiser phi&ecirc;n bản Giới hạn<br />\r\n&nbsp;</h3>\r\n\r\n<p>&bull; Loại bia: Lager</p>\r\n\r\n<p>&bull; Nồng độ cồn: 5.0%</p>\r\n\r\n<p>&bull; Dung t&iacute;ch: 330ml x 24 lon</p>\r\n\r\n<p>&bull; Xuất xứ: Mỹ</p>\r\n\r\n<p>&bull; Nơi sản xuất: Việt Nam</p>\r\n\r\n<p>&bull; Hạn sử dụng: 12 th&aacute;ng kể từ ng&agrave;y sản xuất (in tr&ecirc;n bao b&igrave;)</p>\r\n\r\n<p>&bull; Lưu &yacute;: Sản phẩm d&agrave;nh cho người tr&ecirc;n 18 tuổi v&agrave; kh&ocirc;ng d&agrave;nh cho phụ nữ mang thai. Thưởng thức c&oacute; tr&aacute;ch nhiệm, đ&atilde; uống đồ uống c&oacute; cồn th&igrave; kh&ocirc;ng l&aacute;i xe!</p>\r\n\r\n<p>&bull; Khu vực Ngoại Th&agrave;nh HCM, H&agrave; Nội: Ph&iacute; vận chuyển cộng th&ecirc;m 20.000đ.</p>\r\n\r\n<p>&bull; Thời gian dự kiến giao h&agrave;ng ở Hồ Ch&iacute; Minh v&agrave; H&agrave; Nội</p>\r\n\r\n<p><strong>D&Ograve;NG BIA C&Oacute; GI&Aacute; TRỊ THƯƠNG HIỆU CAO NHẤT THẾ GIỚI</strong></p>\r\n\r\n<ul>\r\n	<li>Budweiser &ndash; King of beers &ndash; l&agrave; thương hiệu bia Mỹ đứng đầu thế giới được sản xuất bằng loại mạch nha c&ugrave;ng với hoa bia thượng hạng của Hoa Kỳ v&agrave; Ch&acirc;u &Acirc;u.</li>\r\n	<li>Budweiser l&agrave; &quot;Xuất xứ từ Budweis&quot;, một thị trấn của Czeck t&ecirc;n l&agrave; Budejovice, nơi tạo ra c&ocirc;ng thức nguy&ecirc;n bản để nấu những mẻ bia Budweiser đầu ti&ecirc;n.</li>\r\n	<li>&quot;King of Beers&quot; lần đầu được sử dụng v&agrave;o năm 1898 để kỷ niệm 500 triệu chai Budweiser thượng hạng đầu ti&ecirc;n được sản xuất.</li>\r\n	<li>C&ocirc;ng nghệ ủ bia trong gỗ sồi suốt 3 tuần, gi&uacute;p l&agrave;m sạch men bia trong qu&aacute; tr&igrave;nh trưởng th&agrave;nh v&agrave; cho ra vị bia thơm ngon độc nhất. Bia được ủ với mạch nha tốt nhất, gạo, hoa bia v&agrave; sử dụng một loại men nguy&ecirc;n bản được giữ g&igrave;n từ hơn 140 năm về trước. C&oacute; lẽ hương vị tươi m&aacute;t của bia bắt nguồn từ th&agrave;nh phần gạo.</li>\r\n	<li>Men bia Budweiser được bảo quản trong hơn 139 năm nay tại Bỉ v&agrave; Saint Louis (Mỹ), được r&atilde; đ&ocirc;ng mỗi năm v&agrave; đem đi sử dụng ở tất cả nh&agrave; m&aacute;y AB InBev tr&ecirc;n to&agrave;n thế giới, để cho ra đời c&ugrave;ng một loại bia với hương vị thơm ngon giống nhau.</li>\r\n	<li>Nồng độ cồn Bia Budweiser 5.0% th&iacute;ch hợp cho nhiều đối tượng. Nhưng với tinh thần thưởng thức c&oacute; tr&aacute;ch nhiệm c&ugrave;ng Vua Bia n&ecirc;n ưu ti&ecirc;n tr&ecirc;n 18 tuổi.</li>\r\n</ul>\r\n\r\n<p><strong>GỢI &Yacute; M&Oacute;N NGON KẾT HỢP C&Ugrave;NG BUDWEISER</strong></p>\r\n\r\n<ul>\r\n	<li>Với chất bia kh&ocirc;ng qu&aacute; đắng mang ch&uacute;t vị tr&aacute;i c&acirc;y, Budweiser c&oacute; thể kết hợp với c&aacute;c m&oacute;n ăn mang vị nướng, b&eacute;o ngậy như Burger, beefsteak, v&agrave; sườn nướng. Khi thưởng thức chung ch&uacute;ng với nhau, c&aacute;c hương vị như được h&ograve;a quyện xen kẽ ch&uacute;t beo b&eacute;o của thịt sẽ h&ograve;a v&agrave;o vị ga của bia, vị men của hoa bia l&agrave;m cho thức ăn dễ ti&ecirc;u h&oacute;a kh&ocirc;ng bị đầy bụng cũng như sảng kho&aacute;i hơn.&nbsp;</li>\r\n</ul>\r\n\r\n<p><strong>HƯỚNG DẪN SỬ DỤNG</strong></p>\r\n\r\n<ul>\r\n	<li>Bia ngon nhất khi uống vị nguy&ecirc;n bản, v&agrave; được ướp lạnh dưới 3 độ.</li>\r\n	<li>R&oacute;t bia v&agrave;o ly, ch&uacute; &yacute; kh&ocirc;ng để miệng chai bia hay lon chạm v&agrave; ly. Khi r&oacute;t để ly nghi&ecirc;n xuống 45 độ, bia đổ hơn 2/3 th&igrave; để đi đứng l&ecirc;n v&agrave; r&oacute;t tiếp cho đến khi đầu ly (như vậy sẽ đảm bảo 3 phần bọt v&agrave; 7 phần bia).</li>\r\n</ul>\r\n\r\n<p><strong>HƯỚNG DẪN BẢO QUẢN</strong></p>\r\n\r\n<ul>\r\n	<li>Tr&aacute;nh &aacute;nh nắng mặt trời</li>\r\n	<li>Bảo quản nơi kh&ocirc; r&aacute;o</li>\r\n	<li>Tr&aacute;nh để đ&ocirc;ng đ&aacute;</li>\r\n</ul>\r\n', 2, 93, '2_0d2860b49a5944d28be7b8fe4343654e_master.png|3_afe0d4e9933948e595baf2ff7d4ecc8b_master.png|bud_ut_c_4a4f81aff4134cc08937c50d7db6292f_master.png'),
(92, 'Combo 2 Thùng 24 Lon 330ml - Tặng 1 Áo Thun Budweiser Phiên Bản Giới Hạn - QUÀ TẶNG KHÔNG BÁN', 800000.00, '2-2t_bud_sleek_vb_awo_14.8_205ee25e687f44e8ac9e0a0aa3e7d5fb_master.jpg', '<h3>Tặng</h3>\r\n\r\n<h3>1 &Aacute;o Thun Budweiser Phi&ecirc;n Bản Giới Hạn</h3>\r\n\r\n<p>Số lượng c&oacute; hạn!</p>\r\n\r\n<p>&bull; Loại bia: Lager</p>\r\n\r\n<p>&bull; Nồng độ cồn: 5.0%</p>\r\n\r\n<p>&bull; Dung t&iacute;ch: 330ml x 24 lon</p>\r\n\r\n<p>&bull; Xuất xứ: Mỹ</p>\r\n\r\n<p>&bull; Nơi sản xuất: Việt Nam</p>\r\n\r\n<p>&bull; Hạn sử dụng: 12 th&aacute;ng kể từ ng&agrave;y sản xuất (in tr&ecirc;n bao b&igrave;)</p>\r\n\r\n<p>&bull; Lưu &yacute;: Sản phẩm d&agrave;nh cho người tr&ecirc;n 18 tuổi v&agrave; kh&ocirc;ng d&agrave;nh cho phụ nữ mang thai. Thưởng thức c&oacute; tr&aacute;ch nhiệm, đ&atilde; uống đồ uống c&oacute; cồn th&igrave; kh&ocirc;ng l&aacute;i xe!</p>\r\n\r\n<p>&bull; Khu vực Ngoại Th&agrave;nh HCM, H&agrave; Nội: Ph&iacute; vận chuyển cộng th&ecirc;m 20.000đ.</p>\r\n\r\n<p>&bull; Thời gian dự kiến giao h&agrave;ng ở Hồ Ch&iacute; Minh v&agrave; H&agrave; Nội</p>\r\n\r\n<p><strong>D&Ograve;NG BIA C&Oacute; GI&Aacute; TRỊ THƯƠNG HIỆU CAO NHẤT THẾ GIỚI</strong></p>\r\n\r\n<ul>\r\n	<li>Budweiser &ndash; King of beers &ndash; l&agrave; thương hiệu bia Mỹ đứng đầu thế giới được sản xuất bằng loại mạch nha c&ugrave;ng với hoa bia thượng hạng của Hoa Kỳ v&agrave; Ch&acirc;u &Acirc;u.</li>\r\n	<li>Budweiser l&agrave; &quot;Xuất xứ từ Budweis&quot;, một thị trấn của Czeck t&ecirc;n l&agrave; Budejovice, nơi tạo ra c&ocirc;ng thức nguy&ecirc;n bản để nấu những mẻ bia Budweiser đầu ti&ecirc;n.</li>\r\n	<li>&quot;King of Beers&quot; lần đầu được sử dụng v&agrave;o năm 1898 để kỷ niệm 500 triệu chai Budweiser thượng hạng đầu ti&ecirc;n được sản xuất.</li>\r\n	<li>C&ocirc;ng nghệ ủ bia trong gỗ sồi suốt 3 tuần, gi&uacute;p l&agrave;m sạch men bia trong qu&aacute; tr&igrave;nh trưởng th&agrave;nh v&agrave; cho ra vị bia thơm ngon độc nhất. Bia được ủ với mạch nha tốt nhất, gạo, hoa bia v&agrave; sử dụng một loại men nguy&ecirc;n bản được giữ g&igrave;n từ hơn 140 năm về trước. C&oacute; lẽ hương vị tươi m&aacute;t của bia bắt nguồn từ th&agrave;nh phần gạo.</li>\r\n	<li>Men bia Budweiser được bảo quản trong hơn 139 năm nay tại Bỉ v&agrave; Saint Louis (Mỹ), được r&atilde; đ&ocirc;ng mỗi năm v&agrave; đem đi sử dụng ở tất cả nh&agrave; m&aacute;y AB InBev tr&ecirc;n to&agrave;n thế giới, để cho ra đời c&ugrave;ng một loại bia với hương vị thơm ngon giống nhau.</li>\r\n	<li>Nồng độ cồn Bia Budweiser 5.0% th&iacute;ch hợp cho nhiều đối tượng. Nhưng với tinh thần thưởng thức c&oacute; tr&aacute;ch nhiệm c&ugrave;ng Vua Bia n&ecirc;n ưu ti&ecirc;n tr&ecirc;n 18 tuổi.</li>\r\n</ul>\r\n\r\n<p><strong>GỢI &Yacute; M&Oacute;N NGON KẾT HỢP C&Ugrave;NG BUDWEISER</strong></p>\r\n\r\n<ul>\r\n	<li>Với chất bia kh&ocirc;ng qu&aacute; đắng mang ch&uacute;t vị tr&aacute;i c&acirc;y, Budweiser c&oacute; thể kết hợp với c&aacute;c m&oacute;n ăn mang vị nướng, b&eacute;o ngậy như Burger, beefsteak, v&agrave; sườn nướng. Khi thưởng thức chung ch&uacute;ng với nhau, c&aacute;c hương vị như được h&ograve;a quyện xen kẽ ch&uacute;t beo b&eacute;o của thịt sẽ h&ograve;a v&agrave;o vị ga của bia, vị men của hoa bia l&agrave;m cho thức ăn dễ ti&ecirc;u h&oacute;a kh&ocirc;ng bị đầy bụng cũng như sảng kho&aacute;i hơn.&nbsp;</li>\r\n</ul>\r\n\r\n<p><strong>HƯỚNG DẪN SỬ DỤNG</strong></p>\r\n\r\n<ul>\r\n	<li>Bia ngon nhất khi uống vị nguy&ecirc;n bản, v&agrave; được ướp lạnh dưới 3 độ.</li>\r\n	<li>R&oacute;t bia v&agrave;o ly, ch&uacute; &yacute; kh&ocirc;ng để miệng chai bia hay lon chạm v&agrave; ly. Khi r&oacute;t để ly nghi&ecirc;n xuống 45 độ, bia đổ hơn 2/3 th&igrave; để đi đứng l&ecirc;n v&agrave; r&oacute;t tiếp cho đến khi đầu ly (như vậy sẽ đảm bảo 3 phần bọt v&agrave; 7 phần bia).</li>\r\n</ul>\r\n\r\n<p><strong>HƯỚNG DẪN BẢO QUẢN</strong></p>\r\n\r\n<ul>\r\n	<li>Tr&aacute;nh &aacute;nh nắng mặt trời</li>\r\n	<li>Bảo quản nơi kh&ocirc; r&aacute;o</li>\r\n	<li>Tr&aacute;nh để đ&ocirc;ng đ&aacute;</li>\r\n</ul>\r\n', 0, 93, '2_b6d7e5fc3bed4e73a4f936d3544e6322_master.png|2_bud_sleek_24_lon_330ml_29a9897b17a14336aabe4dcec37d9108_master.png|3_2277cf7e57c742c79b2fd9ba10c976d3_master.png|4_d9230f8c41b44d708cc3320e55636cf5_master.png'),
(93, 'Bia Hoegaarden Rosée Thùng 24 Chai 248ml - Tặng Lốc 6 Chai Hoegaarden Rosée 248ml', 450000.00, '1-1t_hoe_rosee_chai_vb_awo_14.8_7848e2203c764d82810605e71cb4566f_master.jpg', '<p><strong>Tặng</strong></p>\r\n\r\n<h3>Lốc 6 Chai Hoegaarden Ros&eacute;e 248ml</h3>\r\n\r\n<p>Số lượng c&oacute; hạn!</p>\r\n\r\n<p>&bull; Loại bia: Ale</p>\r\n\r\n<p>&bull; Nồng độ cồn: 3%</p>\r\n\r\n<p>&bull; Dung t&iacute;ch: 248ml x 24 chai</p>\r\n\r\n<p>&bull; Xuất xứ: Bỉ</p>\r\n\r\n<p>&bull; Nơi sản xuất: Việt Nam</p>\r\n\r\n<p>&bull; Hạn sử dụng: 13 th&aacute;ng kể từ ng&agrave;y sản xuất (in tr&ecirc;n bao b&igrave;)</p>\r\n\r\n<p>&bull; Lưu &yacute;: Sản phẩm d&agrave;nh cho người tr&ecirc;n 18 tuổi v&agrave; kh&ocirc;ng d&agrave;nh cho phụ nữ mang thai. Thưởng thức c&oacute; tr&aacute;ch nhiệm, đ&atilde; uống đồ uống c&oacute; cồn th&igrave; kh&ocirc;ng l&aacute;i xe!</p>\r\n\r\n<p>&bull; Khu vực Ngoại Th&agrave;nh HCM, H&agrave; Nội: Ph&iacute; vận chuyển cộng th&ecirc;m 20.000đ.</p>\r\n\r\n<p>&bull; Thời gian dự kiến giao h&agrave;ng ở Hồ Ch&iacute; Minh v&agrave; H&agrave; Nội</p>\r\n\r\n<p><strong>CHƯƠNG TR&Igrave;NH FREESHIP NỘI TH&Agrave;NH TPHCM, ĐN, HN &Aacute;P DỤNG CHO ĐƠN H&Agrave;NG TRỊ GI&Aacute; TỪ&nbsp;400K&nbsp;TRỞ L&Ecirc;N</strong></p>\r\n\r\n<ul>\r\n	<li>Bia Hoegaarden Rosee l&agrave; th&agrave;nh vi&ecirc;n trong gia đ&igrave;nh bia Hoegaarden nổi tiếng từ Bỉ, Hoegaarden Rosee vẫn sử dụng những nguy&ecirc;n liệu ch&iacute;nh l&agrave; l&uacute;a m&igrave; c&ugrave;ng c&ocirc;ng nghệ l&ecirc;n men tự nhi&ecirc;n 2 lần, đem đến vị bia ho&agrave;n to&agrave;n ấn tượng cho bạn.</li>\r\n	<li>Đặc biệt, Hoegaarden Rosee với m&agrave;u hồng đặc trưng v&agrave; ấn tượng, hiếm c&oacute; loại bia n&agrave;o c&oacute; được. Với nồng độ cồn vừa phải (3%) c&ugrave;ng hương vị dịu nhẹ, ngọt ng&agrave;o từ d&acirc;u rừng &ndash; Hoegaarden Rosee l&agrave; loại thức uống ho&agrave;n hảo cho một bữa trưa h&egrave; n&oacute;ng nực v&agrave; cũng ch&iacute;nh l&agrave; m&oacute;n qu&agrave; tuyệt vời say đắm, chinh phục ph&aacute;i nữ s&agrave;nh bia.</li>\r\n</ul>\r\n', 1, 83, 'tha__nh-pha____n_e8713a873fbf494fac3f2dd83003e16c_master.jpg|__a____c-__ie____m-no____i-ba____t_663ab65ec49147f9ae40a3bda4b122f6_master.jpg|hoeros_e_chai_248ml_e2d4d3c16e834fabb1298541712e2f13_master.png|mo__n-a__n-ke____t-ho____p_8ed2bb216e3643a09db16725b3df89d5_master.jpg'),
(94, 'Bia Hoegaarden Rosée Combo 2 Thùng 24 Chai 248ml - Tặng 1 Thùng Bia Hoegaarden Rosée 24 Chai 248ml', 980000.00, '2-2t_hoe_rosee_chai_vb_awo_14.8_a58b551ecd3343f5826b9d7b693cd875_master.jpg', '<p><strong>Tặng</strong></p>\r\n\r\n<h3>1 Th&ugrave;ng Bia Hoegaarden Ros&eacute;e 24 Chai 248ml</h3>\r\n\r\n<p>Số lượng c&oacute; hạn!</p>\r\n\r\n<p>&bull; Loại bia: Ale</p>\r\n\r\n<p>&bull; Nồng độ cồn: 3%</p>\r\n\r\n<p>&bull; Dung t&iacute;ch: 248ml x 24 chai</p>\r\n\r\n<p>&bull; Xuất xứ: Bỉ</p>\r\n\r\n<p>&bull; Nơi sản xuất: Việt Nam</p>\r\n\r\n<p>&bull; Hạn sử dụng: 13 th&aacute;ng kể từ ng&agrave;y sản xuất (in tr&ecirc;n bao b&igrave;)</p>\r\n\r\n<p>&bull; Lưu &yacute;: Sản phẩm d&agrave;nh cho người tr&ecirc;n 18 tuổi v&agrave; kh&ocirc;ng d&agrave;nh cho phụ nữ mang thai. Thưởng thức c&oacute; tr&aacute;ch nhiệm, đ&atilde; uống đồ uống c&oacute; cồn th&igrave; kh&ocirc;ng l&aacute;i xe!</p>\r\n\r\n<p>&bull; Khu vực Ngoại Th&agrave;nh HCM, H&agrave; Nội: Ph&iacute; vận chuyển cộng th&ecirc;m 20.000đ.</p>\r\n\r\n<p>&bull; Thời gian dự kiến giao h&agrave;ng ở Hồ Ch&iacute; Minh v&agrave; H&agrave; Nội</p>\r\n\r\n<ul>\r\n	<li>Bia Hoegaarden Rosee l&agrave; th&agrave;nh vi&ecirc;n trong gia đ&igrave;nh bia Hoegaarden nổi tiếng từ Bỉ, Hoegaarden Rosee vẫn sử dụng những nguy&ecirc;n liệu ch&iacute;nh l&agrave; l&uacute;a m&igrave; c&ugrave;ng c&ocirc;ng nghệ l&ecirc;n men tự nhi&ecirc;n 2 lần, đem đến vị bia ho&agrave;n to&agrave;n ấn tượng cho bạn.</li>\r\n	<li>Đặc biệt, Hoegaarden Rosee với m&agrave;u hồng đặc trưng v&agrave; ấn tượng, hiếm c&oacute; loại bia n&agrave;o c&oacute; được. Với nồng độ cồn vừa phải (3%) c&ugrave;ng hương vị dịu nhẹ, ngọt ng&agrave;o từ d&acirc;u rừng &ndash; Hoegaarden Rosee l&agrave; loại thức uống ho&agrave;n hảo cho một bữa trưa h&egrave; n&oacute;ng nực v&agrave; cũng ch&iacute;nh l&agrave; m&oacute;n qu&agrave; tuyệt vời say đắm, chinh phục ph&aacute;i nữ s&agrave;nh bia.</li>\r\n</ul>\r\n', 0, 83, 'mo__n-a__n-ke____t-ho____p_8ed2bb216e3643a09db16725b3df89d5_master.jpg|tha__nh-pha____n_e8713a873fbf494fac3f2dd83003e16c_master.jpg|__a____c-__ie____m-no____i-ba____t_663ab65ec49147f9ae40a3bda4b122f6_master.jpg|2t_hoeros_e_chai_248ml_d2c95e5c310141a39efbec8aa332280f_master.png'),
(95, 'Bia Corona Extra Thùng 24 Chai 250ml - Tặng 2 ly Corona', 570000.00, '5-1t_corona_ow_250ml_vb_awo_14.8_c22ce597c43640798c5a8da84b8d944a_master.jpg', '<p><strong>Tặng</strong></p>\r\n\r\n<h3>2 Ly Thủy Tinh Corona Cao Cấp</h3>\r\n\r\n<p>Số lượng c&oacute; hạn!</p>\r\n\r\n<p>&bull; Loại bia: Lager</p>\r\n\r\n<p>&bull; Nồng độ cồn: 4.5%</p>\r\n\r\n<p>&bull; Dung t&iacute;ch: 250ml x 24 chai</p>\r\n\r\n<p>&bull; Hạn sử dụng: 12 th&aacute;ng kể từ ng&agrave;y sản xuất (in tr&ecirc;n bao b&igrave;)</p>\r\n\r\n<p>&bull; Lưu &yacute;: Sản phẩm d&agrave;nh cho người tr&ecirc;n 18 tuổi v&agrave; kh&ocirc;ng d&agrave;nh cho phụ nữ mang thai. Thưởng thức c&oacute; tr&aacute;ch nhiệm, đ&atilde; uống đồ uống c&oacute; cồn th&igrave; kh&ocirc;ng l&aacute;i xe!</p>\r\n\r\n<p>&bull; Khu vực Ngoại Th&agrave;nh HCM, H&agrave; Nội: Ph&iacute; vận chuyển cộng th&ecirc;m 20.000đ.</p>\r\n\r\n<p>&bull; Thời gian dự kiến giao h&agrave;ng ở Hồ Ch&iacute; Minh v&agrave; H&agrave; Nội</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Xuất xứ: Mexico<br />\r\n	Sản xuất: Trung Quốc</p>\r\n	</li>\r\n	<li>\r\n	<p>Bia Corona hay c&ograve;n được gọi l&agrave; Corona Extra Beer l&agrave; một trong những d&ograve;ng bia được uống phổ biến trong m&ugrave;a h&egrave;, c&oacute; ngồn gốc từ Mexico từ năm 1925, được ph&acirc;n phối rộng r&atilde;i tại Ch&acirc;u Mỹ. Bia corona mang hương thơm tequila, loại hương liệu chiết xuất từ c&acirc;y Blue Avage. Bia m&agrave;u v&agrave;ng rơm được đ&oacute;ng trong chai thủy tinh trong suốt rất tinh khiết v&agrave; bắt mắt.</p>\r\n	</li>\r\n	<li>\r\n	<p>Bia Corona Extra c&ograve;n được biết đến rộng r&atilde;i l&agrave; nh&agrave; t&agrave;i trợ quan trọng nhất trong chiến dịch bảo vệ v&agrave; l&agrave;m sạch b&atilde;i biển c&ugrave;ng với Parley.</p>\r\n	</li>\r\n	<li>\r\n	<p>Thưởng thức Corona Extra ướp lạnh với một l&aacute;t chanh v&agrave; &iacute;t muối ở th&agrave;nh miệng chai kết hợp c&ugrave;ng c&aacute;c m&oacute;n đồ nướng như b&iacute;t-tết, g&agrave; nướng, c&agrave;ng gi&uacute;p hương vị của bia th&ecirc;m đậm đ&agrave; v&agrave; hấp dẫn hơn bao giờ hết. Với thiết kế kiểu d&aacute;ng th&ugrave;ng 24 chai tiện lợi, sang trọng, sản phẩm th&iacute;ch hợp d&ugrave;ng cho c&aacute;c dịp lễ Tết, l&agrave;m qu&agrave; tặng hay d&ugrave;ng trong c&aacute;c bữa tiệc, tụ họp bạn b&egrave;.</p>\r\n	</li>\r\n</ul>\r\n', 1, 94, 'tha_cnh-pha_e_cn_4d607a3c57314c8c8632ae3f2325fe4d_master.png|_ea_u_ac-_eie_e_em-no_e_ei-ba_u_et_71ff5a6f1b164e74af01026d3a0280e2_master.png|corona_250ml_6f82923d57e742819395fede5fcf1b42_master.png|main-image_f8db2912eb7843eb8a283a0d050ff68d_master.png|mo_un-a_an-ke_e_ut-ho___up_1d5442a7cca2424ab4c4345e1cb65cbe_master.png'),
(96, 'Bia Corona Extra Combo 6 Thùng 24 Chai 250ml - Tặng 1 Thùng Đá Corona 15L', 3400000.00, '6-2t_corona_ow_250ml_vb_awo_14.8_a14103dcc2c141769752016ba7ab5355_master.jpg', '<h3>Tặng</h3>\r\n\r\n<h3>1 Th&ugrave;ng Đ&aacute; Corona 15L</h3>\r\n\r\n<p>Số lượng c&oacute; hạn!</p>\r\n\r\n<p>&bull; Loại bia: Lager</p>\r\n\r\n<p>&bull; Nồng độ cồn: 4.5%</p>\r\n\r\n<p>&bull; Dung t&iacute;ch: 250ml x 24 chai</p>\r\n\r\n<p>&bull; Hạn sử dụng: 12 th&aacute;ng kể từ ng&agrave;y sản xuất (in tr&ecirc;n bao b&igrave;)</p>\r\n\r\n<p>&bull; Lưu &yacute;: Sản phẩm d&agrave;nh cho người tr&ecirc;n 18 tuổi v&agrave; kh&ocirc;ng d&agrave;nh cho phụ nữ mang thai. Thưởng thức c&oacute; tr&aacute;ch nhiệm, đ&atilde; uống đồ uống c&oacute; cồn th&igrave; kh&ocirc;ng l&aacute;i xe!</p>\r\n\r\n<p>&bull; Khu vực Ngoại Th&agrave;nh HCM, H&agrave; Nội: Ph&iacute; vận chuyển cộng th&ecirc;m 20.000đ.</p>\r\n\r\n<p>&bull; Thời gian dự kiến giao h&agrave;ng ở Hồ Ch&iacute; Minh v&agrave; H&agrave; Nội</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Xuất xứ: Mexico<br />\r\n	Sản xuất: Trung Quốc</p>\r\n	</li>\r\n	<li>\r\n	<p>Bia Corona hay c&ograve;n được gọi l&agrave; Corona Extra Beer l&agrave; một trong những d&ograve;ng bia được uống phổ biến trong m&ugrave;a h&egrave;, c&oacute; ngồn gốc từ Mexico từ năm 1925, được ph&acirc;n phối rộng r&atilde;i tại Ch&acirc;u Mỹ. Bia corona mang hương thơm tequila, loại hương liệu chiết xuất từ c&acirc;y Blue Avage. Bia m&agrave;u v&agrave;ng rơm được đ&oacute;ng trong chai thủy tinh trong suốt rất tinh khiết v&agrave; bắt mắt.</p>\r\n	</li>\r\n	<li>\r\n	<p>Bia Corona Extra c&ograve;n được biết đến rộng r&atilde;i l&agrave; nh&agrave; t&agrave;i trợ quan trọng nhất trong chiến dịch bảo vệ v&agrave; l&agrave;m sạch b&atilde;i biển c&ugrave;ng với Parley.</p>\r\n	</li>\r\n	<li>\r\n	<p>Thưởng thức Corona Extra ướp lạnh với một l&aacute;t chanh v&agrave; &iacute;t muối ở th&agrave;nh miệng chai kết hợp c&ugrave;ng c&aacute;c m&oacute;n đồ nướng như b&iacute;t-tết, g&agrave; nướng, c&agrave;ng gi&uacute;p hương vị của bia th&ecirc;m đậm đ&agrave; v&agrave; hấp dẫn hơn bao giờ hết. Với thiết kế kiểu d&aacute;ng th&ugrave;ng 24 chai tiện lợi, sang trọng, sản phẩm th&iacute;ch hợp d&ugrave;ng cho c&aacute;c dịp lễ Tết, l&agrave;m qu&agrave; tặng hay d&ugrave;ng trong c&aacute;c bữa tiệc, tụ họp bạn b&egrave;.</p>\r\n	</li>\r\n</ul>\r\n', 1, 94, '_ea_u_ac-_eie_e_em-no_e_ei-ba_u_et_71ff5a6f1b164e74af01026d3a0280e2_master.png|corona_250ml_6f82923d57e742819395fede5fcf1b42_master.png|main-image_f8db2912eb7843eb8a283a0d050ff68d_master.png|mo_un-a_an-ke_e_ut-ho___up_1d5442a7cca2424ab4c4345e1cb65cbe_master.png|tha_cnh-pha_e_cn_4d607a3c57314c8c8632ae3f2325fe4d_master.png');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `user`, `password`, `fullname`, `email`, `address`, `tel`, `role`) VALUES
(87, 'Admin', 'e99c6c35a43161674acf77da22c4b61a', 'Admin', 'Admin@gmail.com', 'vv', '076283544', 1),
(92, 'lehoangkhang', 'e99c6c35a43161674acf77da22c4b61a', 'Lê Hoàng Khang', 'khangcmc103@gmail.com', 'Đại thành ngã bảy HG sss', '07628354002', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bill_user` (`iduser`);

--
-- Indexes for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_temp`
--
ALTER TABLE `cart_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lk_iddm_danhmuc` (`iddm`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT for table `cart_temp`
--
ALTER TABLE `cart_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
