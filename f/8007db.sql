-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2026 at 04:00 PM
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
-- Database: `8007db`
--
CREATE DATABASE IF NOT EXISTS `8007db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_thai_520_w2;
USE `8007db`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_thai_520_w2;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'กระเป๋าเป้', 'กระเป๋าเป้เดินป่า กระเป๋า Daypack สำหรับเดินทาง', '2026-08-08 11:08:34'),
(2, 'เครื่องแต่งกาย', 'เสื้อกันฝน เสื้อกันลม รองเท้าเดินป่า และเครื่องแต่งกายอื่นๆ', '2026-08-08 11:08:34'),
(3, 'อุปกรณ์เดินป่าและส่องสว่าง', 'ไม้พยุงเดินป่า ไฟฉายคาดหัว ไฟฉายแคมป์ปิ้ง', '2026-08-08 11:08:34'),
(4, 'อุปกรณ์เอาตัวรอด', 'มีดอเนกประสงค์ ชุดปฐมพยาบาล อุปกรณ์ยังชีพ', '2026-08-08 11:08:34'),
(5, 'อุปกรณ์ทำครัว', 'เตาแก๊สพกพา ชุดหม้อสนาม แก้วน้ำ', '2026-08-08 11:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_thai_520_w2;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `sku`, `name`, `description`, `price`, `stock_quantity`, `image_url`, `created_at`) VALUES
(1, 1, 'BP-001', 'กระเป๋าเป้เดินป่า Trekking 50L', 'กระเป๋าเป้ความจุ 50 ลิตร มีโครงหลังระบายอากาศ พร้อม Rain cover', 2590.00, 15, '1.jpg', '2026-08-08 11:08:34'),
(2, 1, 'BP-002', 'กระเป๋าเป้ Daypack 20L', 'กระเป๋าเป้น้ำหนักเบา สำหรับเดินป่าระยะสั้นหรือใช้ในชีวิตประจำวัน', 890.00, 30, '2.jpg', '2026-08-08 11:08:34'),
(3, 2, 'CL-001', 'เสื้อแจ็คเก็ตกันน้ำกันลม (Waterproof)', 'เสื้อแจ็คเก็ตเคลือบสารกันน้ำ น้ำหนักเบา พับเก็บง่าย', 1290.00, 20, '3.jpg', '2026-08-08 11:08:34'),
(4, 2, 'CL-002', 'รองเท้าเดินป่าหุ้มข้อ (Trekking Shoes)', 'รองเท้าเดินป่าพื้นยางกันลื่น หุ้มข้อป้องกันข้อเท้าพลิก', 3450.00, 10, '4.jpg', '2026-08-08 11:08:34'),
(5, 3, 'EQ-001', 'ไม้พยุงเดินป่า อลูมิเนียม (Trekking Pole)', 'ไม้โพลเดินป่า ปรับระดับได้ 3 ท่อน ซับแรงกระแทกได้ดี', 450.00, 50, '5.jpg', '2026-08-08 11:08:34'),
(6, 3, 'EQ-002', 'ไฟฉายคาดหัว 500 Lumens', 'ไฟฉายคาดหัวชาร์จ USB สว่าง 500 ลูเมน กันน้ำระดับ IPX4', 690.00, 40, '6.jpg', '2026-08-08 11:08:34'),
(7, 3, 'EQ-003', 'ตะเกียง LED แคมป์ปิ้ง', 'ตะเกียงตั้งโต๊ะหรือแขวนในเต็นท์ แสงสีวอร์มไวท์ แบตเตอรี่อึด', 550.00, 25, '7.jpg', '2026-08-08 11:08:34'),
(8, 4, 'SV-001', 'มีดพับอเนกประสงค์ 12-in-1', 'มีดพับสแตนเลส พร้อมเลื่อย ที่เปิดขวด และไขควงในตัว', 790.00, 20, '8.jpg', '2026-08-08 11:08:34'),
(9, 4, 'SV-002', 'ชุดปฐมพยาบาลฉุกเฉิน (First Aid Kit)', 'กระเป๋ายาพกพาพร้อมอุปกรณ์ทำแผลพื้นฐานสำหรับเดินป่า', 350.00, 35, '9.jpg', '2026-08-08 11:08:34'),
(10, 4, 'SV-003', 'เครื่องกรองน้ำพกพา', 'หลอดกรองน้ำฉุกเฉิน กรองแบคทีเรียได้ 99.9% ใช้ดื่มน้ำจากแหล่งน้ำธรรมชาติ', 990.00, 15, '10.jpg', '2026-08-08 11:08:34'),
(11, 5, 'CK-001', 'เตาแก๊สปิกนิกพกพา หัวแมงมุม', 'เตาแก๊สขนาดเล็ก พับเก็บได้ ให้ไฟแรง ทนลม', 450.00, 40, '11.jpg', '2026-08-08 11:08:34'),
(12, 5, 'CK-002', 'ชุดหม้อสนามอลูมิเนียม สำหรับ 2-3 คน', 'ชุดหม้อ กระทะ กาน้ำ น้ำหนักเบา ซ้อนเก็บได้ประหยัดพื้นที่', 890.00, 25, '12.jpg', '2026-08-08 11:08:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
