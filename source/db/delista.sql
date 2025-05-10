-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2025 at 05:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `delista`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `phone`, `password`) VALUES
(1, 'geeksrahul', 'geeksrahulofficial@gmail.com', '9714302979', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `description`, `image`) VALUES
(5, 'Dell', 'Laptop Brand', '1742023094_Remote Jobs Hiring Now_ Find Legit Work From Home Jobs _ FlexJobs.jpg'),
(6, 'LENOVO', 'Laptop Brand', '1742023257_Lenovo Logo PNG Vector, Icon (4096 x 4096) Free download.jpg'),
(7, 'Hikvision', 'CCTV Survillence Brand', '1742023269_Hikvision logo in vector _EPS, .SVG, .CDR formats - Brandlogos.net'),
(8, 'Secureye', 'Networking | CCTV Survillence Brand', '1742023332_Upload your PowerPoint Presentation.jpg'),
(9, 'Dauha', 'CCTV Survillence Brand', '1742023353_Dahua Technology logo in vector _EPS, .AI, .PDF formats - Brandlogos.net'),
(10, 'HP', 'Laptop Brand', '1742023404_Automatic Ink Reorder Eligible HP Printers.jpg'),
(11, 'ASUS', 'Laptop Brand', '1742035739_ASUS WebStorage.jpg'),
(12, 'Brother', 'High Quality Printers', '1742035832_Brother.jpg'),
(13, 'Canon', 'Printers Brand', '1742035851_CANON Logo.jpg'),
(14, 'Epson', 'Printers Brand', '1742035866_1942, Epson, Suwa, Nagano Japan #Epson (L507).jpg'),
(15, 'JBL ', 'Sound Brand', '1742036056_04da0a27-3960-497f-beb4-eeaf3b147bd8.jpg'),
(16, 'CP Plus', 'CCTV Survillence Brand', '1742038084_CP PLUS.jpg'),
(17, 'SONY', 'SONY', '1742038132_Sony Font and Sony Logo.jpg'),
(18, 'Logitech', 'Logitech', '1742038179_Logitech Logo PNG Vector (EPS) Free Download.jpg'),
(19, 'RAPOO', 'Keyboard Mouse Brand', '1742044334_Rapoo Logo Vector _ VectorSeek.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `brand_view`
-- (See below for the actual view)
--
CREATE TABLE `brand_view` (
`id` int(11)
,`name` varchar(100)
,`price` decimal(10,2)
,`stock` int(11)
,`category` varchar(100)
,`brand` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT 1,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`) VALUES
(1, 'PC', 'Computer components such as RAM, SSDs, graphics cards, etc.', 'pc.jpg'),
(2, 'Laptops', 'Different brands of laptops for personal and professional use', 'laptop.jpg'),
(3, 'Printers', 'Inkjet and laser printers for home and office use', 'printers.jpg'),
(5, 'Speakers', 'Audio speakers and sound systems', 'speakers.jpg'),
(6, 'CCTV Surveillance', 'CCTV cameras and security surveillance systems', 'cctv.jpg\r\n'),
(8, 'Networking', 'Routers, modems, and networking equipment', 'networking.jpg\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('Pending','Processing','Shipped','Delivered','Cancelled') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_price`, `status`) VALUES
(42, 14, 13499.90, 'Cancelled'),
(43, 14, 1200.00, 'Cancelled'),
(44, 14, 300.00, 'Cancelled'),
(45, 14, 3000.00, 'Pending'),
(46, 14, 8999.95, 'Pending'),
(47, 14, 7499.05, 'Pending'),
(48, 14, 9499.95, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` > 0),
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(22, 42, 29, 10, 1199.99),
(23, 42, 67, 5, 300),
(24, 43, 65, 4, 300),
(25, 44, 62, 1, 300),
(26, 45, 67, 10, 300),
(27, 46, 10, 5, 1799.99),
(28, 47, 30, 5, 1499.81),
(29, 48, 32, 5, 1899.99);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category_id`, `image`, `brand_id`) VALUES
(9, 'Lenovo Legion 5', 'Gaming laptop with AMD Ryzen 7 and RTX 3070.', 1399.99, 6, 6, 'Lenovo Legion 5 15 Gaming Laptop.jpg', 6),
(10, 'Asus ROG Zephyrus', 'Ultra-thin gaming laptop with RTX 3080.', 1799.99, 4, 2, '633ead8c-9e43-4121-9796-e2b179f3c336.jpg', 11),
(13, 'Canon PIXMA G2020', 'Ink tank color printer for home and office use.', 179.99, 12, 3, 'Máy In Canon Pixma G2020.jpg', 13),
(14, 'Epson EcoTank L3150', 'Wireless all-in-one ink tank printer.', 199.99, 15, 3, 'Impressora Multifuncional Epson EcoTank L3250 Wi-fi _ Shopee Brasil.jpg', 14),
(15, 'Brother HL-L2351DW', 'Wireless monochrome laser printer.', 159.99, 10, 3, 'Brother HL-L6310DW Enterprise Monochrome Laser Printer with Low-Cost Printing, WirelessNetworking, and Large Paper Capacity, Works with Alexa.jpg', 12),
(19, 'JBL Flip 6', 'Portable Bluetooth speaker with deep bass.', 129.99, 20, 5, 'Buy JBL Flip 6 Portable Bluetooth Speaker - Black _ Currys.jpg', 15),
(20, 'Bose SoundLink Revolve', '360-degree sound portable speaker.', 199.99, 10, 5, 'Bose Soundlink Revolve Ii _ 2_ Gen Tragbares Lautsprechersystem - Schwarz B.jpg', 5),
(21, 'Sony SRS-XB43', 'Wireless Bluetooth speaker with extra bass.', 149.99, 15, 5, 'SONY SRS-XG300の口コミ・評価、レビュー、SRS-XB43との比較・違い.jpg', 17),
(22, 'Logitech Z623', 'THX-certified 2.1 speaker system.', 129.99, 10, 5, 'Logitech Z623 Pc-lautsprecher (2_1, 200 Watt).jpg', 18),
(24, 'Hikvision 2MP Bullet Camera', 'Full HD 1080p CCTV camera.', 59.99, 25, 6, '2MP COLORVU BULLET CAMERA 4-IN-1 2_8MM 20M IR  HILOOK BY HIKVISION THC-B129-M.jpg', 7),
(25, 'Dahua 4K Dome Camera', 'Ultra HD 4K security camera.', 129.99, 10, 6, '(eBay) Dahua 4K 8MP Varifocal 5X zoom Dome IP Camera IPC-HDBW2831R-ZAS-S2 Audio Alarm.jpg', 9),
(26, 'CP Plus 8 Channel DVR', 'DVR system with 8 channels for surveillance.', 199.99, 8, 6, 'CP PLUS Wired 8 Channel HD DVR 1080p, Outdoor Camera 2_4 MP 5Pcs, 1 TB Hard Disk, Full Combo Set.jpg', 16),
(27, 'Premium Gaming PC', 'Premium Quality Gaming PC | i5-12th Generation Processor | 16Gb Ram | 512Gb NVME | 128Gb Graphic Card ', 50000.00, 10, 1, '1742305390_Custom Black NZXT Gaming PC.jpg', 0),
(29, 'Apple MacBook Air M2', 'Apple MacBook Air with M2 chip, 8GB RAM, 256GB SSD, and a 13.6-inch Retina display.', 1199.99, 12, 2, 'apple_mac_book_air.jpg', 2),
(30, 'HP Spectre x360', 'HP Spectre x360 14-inch 2-in-1 laptop with Intel Core i7, 16GB RAM, and 1TB SSD.', 1499.81, 13, 2, '0a4c2a72-875e-4c39-bf2b-18228787b860.jpg', 6),
(31, 'Lenovo ThinkPad X1 Carbon', 'Lenovo ThinkPad X1 Carbon Gen 10 with Intel Core i7, 16GB RAM, and 512GB SSD.', 1799.99, 5, 2, 'ThinkPad X1 Carbon Gen 12 review_ wont win any new converts.jpg', 4),
(32, 'ASUS ROG Zephyrus G14', 'ASUS ROG Zephyrus G14 gaming laptop with AMD Ryzen 9, 32GB RAM, and RTX 4060.', 1899.99, 7, 2, 'ASUS ROG Zephyrus G14 2022 Review.jpg', 5),
(33, 'Acer Predator Helios 300', 'Acer Predator Helios 300 gaming laptop with Intel Core i7, 16GB RAM, and RTX 3060.', 1299.99, 9, 2, 'images/products/acer_predator_helios_300.jpg', 6),
(34, 'MSI Stealth 15M', 'MSI Stealth 15M ultra-thin gaming laptop with Intel Core i7, 16GB RAM, and RTX 3070.', 1399.99, 6, 2, 'images/products/msi_stealth_15m.jpg', 7),
(35, 'Razer Blade 15', 'Razer Blade 15 gaming laptop with Intel Core i9, 32GB RAM, and RTX 4080.', 2499.99, 4, 2, 'images/products/razer_blade_15.jpg', 8),
(36, 'Microsoft Surface Laptop 5', 'Microsoft Surface Laptop 5 with Intel Core i7, 16GB RAM, and 512GB SSD.', 1399.99, 10, 2, 'images/products/surface_laptop_5.jpg', 9),
(37, 'Samsung Galaxy Book3 Pro', 'Samsung Galaxy Book3 Pro with Intel Core i7, 16GB RAM, and AMOLED display.', 1299.99, 11, 2, 'images/products/galaxy_book3_pro.jpg', 10),
(52, 'Dell XPS 15', 'Dell XPS 15 with Intel Core i7, 16GB RAM, 512GB SSD, and NVIDIA RTX 3050.', 1599.99, 10, 2, 'images/products/dell_xps_15.jpg', 1),
(53, 'Apple MacBook Air M2', 'Apple MacBook Air with M2 chip, 8GB RAM, 256GB SSD, and a 13.6-inch Retina display.', 1199.99, 12, 2, 'images/products/macbook_air_m2.jpg', 2),
(54, 'HP Spectre x360', 'HP Spectre x360 14-inch 2-in-1 laptop with Intel Core i7, 16GB RAM, and 1TB SSD.', 1499.99, 8, 2, 'images/products/hp_spectre_x360.jpg', 3),
(55, 'Lenovo ThinkPad X1 Carbon', 'Lenovo ThinkPad X1 Carbon Gen 10 with Intel Core i7, 16GB RAM, and 512GB SSD.', 1799.99, 5, 2, 'images/products/thinkpad_x1_carbon.jpg', 4),
(56, 'ASUS ROG Zephyrus G14', 'ASUS ROG Zephyrus G14 gaming laptop with AMD Ryzen 9, 32GB RAM, and RTX 4060.', 1899.99, 7, 2, 'images/products/asus_rog_zephyrus_g14.jpg', 5),
(57, 'Acer Predator Helios 300', 'Acer Predator Helios 300 gaming laptop with Intel Core i7, 16GB RAM, and RTX 3060.', 1299.99, 9, 2, 'images/products/acer_predator_helios_300.jpg', 6),
(58, 'MSI Stealth 15M', 'MSI Stealth 15M ultra-thin gaming laptop with Intel Core i7, 16GB RAM, and RTX 3070.', 1399.99, 6, 2, 'images/products/msi_stealth_15m.jpg', 7),
(59, 'Razer Blade 15', 'Razer Blade 15 gaming laptop with Intel Core i9, 32GB RAM, and RTX 4080.', 2499.99, 4, 2, 'images/products/razer_blade_15.jpg', 8),
(60, 'Microsoft Surface Laptop 5', 'Microsoft Surface Laptop 5 with Intel Core i7, 16GB RAM, and 512GB SSD.', 1399.99, 10, 2, 'images/products/surface_laptop_5.jpg', 9),
(61, 'Samsung Galaxy Book3 Pro', 'Samsung Galaxy Book3 Pro with Intel Core i7, 16GB RAM, and AMOLED display.', 1299.99, 11, 2, 'images/products/galaxy_book3_pro.jpg', 10),
(62, 'Gaming PC Build', 'Gaming PC Build', 300.00, 10, 1, 'Gaming PC Build.jpg', 1),
(64, 'Pc black gamer', 'Pc black gamer aquário', 300.00, 10, 1, 'Pc black gamer aquário.jpg', 1),
(65, 'Pc black gamer', 'Pc black gamer aquário', 300.00, 10, 1, 'Hyte Y60 Dream Build w_ Display Mod.jpg', 1),
(66, 'Pc black gamer', 'Pc black gamer aquário', 300.00, 10, 1, 'download.jpg', 1),
(67, 'Pc black gamer', 'Pc black gamer aquário', 300.00, 10, 1, '0187fee9-7082-4618-b33a-eac23605254d.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `address`, `city`) VALUES
(6, 'Alice Johnson', 'alice@example.com', '9876543212', 'password123', '789 Pine Avenue', 'Chicago'),
(7, 'Bob Williams', 'bob@example.com', '9876543213', 'password123', '321 Maple Lane', 'Houston'),
(8, 'Charlie Brown', 'charlie@example.com', '9876543214', 'password123', '654 Oak Drive', 'Phoenix'),
(9, 'David Miller', 'david@example.com', '9876543215', 'password123', '987 Cedar Road', 'Philadelphia'),
(10, 'Emily Davis', 'emily@example.com', '9876543216', 'password123', '147 Birch Street', 'San Antonio'),
(11, 'Frank Wilson', 'frank@example.com', '9876543217', 'password123', '258 Spruce Avenue', 'San Diego'),
(12, 'Grace Lee', 'grace@example.com', '9876543218', 'password123', '369 Redwood Blvd', 'Dallas'),
(13, 'Henry Adams', 'henry@example.com', '9876543219', 'password123', '741 Walnut Street', 'San Jose'),
(14, 'Rahul', 'geeksrahulofficial@gmail.com', '9714302979', '123', 'Navajapa TK Vadi', 'Mahuva 364290');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_product`
-- (See below for the actual view)
--
CREATE TABLE `view_product` (
`id` int(11)
,`name` varchar(100)
,`price` decimal(10,2)
,`stock` int(11)
,`description` text
,`image` varchar(255)
,`category` varchar(100)
,`brand` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `brand_view`
--
DROP TABLE IF EXISTS `brand_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `brand_view`  AS SELECT `p`.`id` AS `id`, `p`.`name` AS `name`, `p`.`price` AS `price`, `p`.`stock` AS `stock`, (select `c`.`name` AS `category_name` from `categories` `c` where `c`.`id` = `p`.`category_id`) AS `category`, (select `b`.`name` AS `brand_name` from `brands` `b` where `b`.`id` = `p`.`brand_id`) AS `brand` FROM `products` AS `p` ;

-- --------------------------------------------------------

--
-- Structure for view `view_product`
--
DROP TABLE IF EXISTS `view_product`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_product`  AS SELECT `p`.`id` AS `id`, `p`.`name` AS `name`, `p`.`price` AS `price`, `p`.`stock` AS `stock`, `p`.`description` AS `description`, `p`.`image` AS `image`, (select `c`.`name` from `categories` `c` where `c`.`id` = `p`.`category_id`) AS `category`, (select `b`.`name` from `brands` `b` where `b`.`id` = `p`.`brand_id`) AS `brand` FROM `products` AS `p` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
