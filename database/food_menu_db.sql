-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2025 at 07:03 PM
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
-- Database: `food_menu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `tbl_menu_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`tbl_menu_id`, `image`, `name`, `description`, `price`) VALUES
(4, './images/menudo.jpg', 'Menudo', 'A hearty tomato-based stew with pork, liver, potatoes, and carrots, often enjoyed during family gatherings and celebrations.', 80),
(5, './images/dinuguan.jpg', 'Dinuguan', 'A rich, savory stew made from pork and pig\'s blood, seasoned with garlic, vinegar, and chili, offering a unique combination of tangy and spicy flavors.', 75),
(6, './images/bicol.jpg', 'Bicol Express', 'A spicy stew from the Bicol region made with pork, shrimp paste, and coconut milk, infused with the heat of chili peppers.', 85),
(7, './images/nilaga.jpg', 'Nilaga', 'A comforting soup featuring beef or pork boiled with vegetables like cabbage, potatoes, and corn, flavored with peppercorns and fish sauce.', 120),
(10, './images/dumpling.jpg', 'Soup Dumpling', 'Steamed dumplings filled with savory meat and rich broth, bursting with warm, delicious flavor in every bite.', 75),
(11, './images/bc3bdc77ec3929f07079006fe8e503b2.jpg', 'Caramel Machiato', 'dibuat oleh al khansa', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `order_type` enum('dine_in','takeaway','delivery') NOT NULL,
  `table_number` int(11) DEFAULT NULL,
  `delivery_address` text DEFAULT NULL,
  `status` enum('pending','confirmed','preparing','ready','completed','cancelled') NOT NULL DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `special_instructions` text DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `customer_name`, `customer_phone`, `customer_email`, `order_type`, `table_number`, `delivery_address`, `status`, `total_amount`, `order_date`, `special_instructions`, `table_id`) VALUES
(1, 'Reynard Aydin', '08111041407', 'aydin.workboard@gmail.com', 'dine_in', 2, NULL, 'cancelled', 80.00, '2025-10-19 22:00:39', '', NULL),
(2, 'Reynard Aydin', '08111041407', 'aydin.workboard@gmail.com', 'dine_in', 1, NULL, 'pending', 75.00, '2025-10-19 22:01:04', '', NULL),
(3, 'Reynard Aydin', '08111041407', 'aydin.workboard@gmail.com', 'dine_in', 1, NULL, 'preparing', 80.00, '2025-10-19 22:07:42', '', NULL),
(4, 'Reynard Aydin', '08111041407', 'aydin.workboard@gmail.com', 'dine_in', 1, NULL, 'completed', 160.00, '2025-10-19 22:09:14', '', NULL),
(5, 'khansa', '1231231', '1231', 'dine_in', 4, NULL, 'completed', 155.00, '2025-10-19 22:16:27', '', NULL),
(6, 'jamal', 'as', 'as', 'dine_in', NULL, NULL, 'confirmed', 80.00, '2025-10-19 22:59:42', '', 0),
(7, 'Laura', '08111041407', 'aydin.workboard@gmail.com', 'dine_in', NULL, NULL, 'preparing', 100.00, '2025-10-19 23:52:25', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_items`
--

CREATE TABLE `tbl_order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `item_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_items`
--

INSERT INTO `tbl_order_items` (`order_item_id`, `order_id`, `menu_id`, `quantity`, `price`, `item_total`) VALUES
(1, 1, 4, 1, 80.00, 80.00),
(2, 2, 5, 1, 75.00, 75.00),
(3, 3, 4, 1, 80.00, 80.00),
(4, 4, 4, 2, 80.00, 160.00),
(5, 5, 4, 1, 80.00, 80.00),
(6, 5, 5, 1, 75.00, 75.00),
(7, 6, 4, 1, 80.00, 80.00),
(8, 7, 11, 1, 100.00, 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_method` enum('cash','card','online') NOT NULL,
  `payment_status` enum('pending','completed','failed','refunded') NOT NULL DEFAULT 'pending',
  `amount` decimal(10,2) NOT NULL,
  `payment_date` datetime DEFAULT current_timestamp(),
  `transaction_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`payment_id`, `order_id`, `payment_method`, `payment_status`, `amount`, `payment_date`, `transaction_id`) VALUES
(1, 1, 'cash', 'pending', 80.00, '2025-10-19 22:00:39', NULL),
(2, 2, 'cash', 'pending', 75.00, '2025-10-19 22:01:04', NULL),
(3, 3, 'cash', 'pending', 80.00, '2025-10-19 22:07:42', NULL),
(4, 4, 'cash', 'pending', 160.00, '2025-10-19 22:09:14', NULL),
(5, 5, 'cash', 'pending', 155.00, '2025-10-19 22:16:27', NULL),
(6, 6, 'cash', 'pending', 80.00, '2025-10-19 22:59:42', NULL),
(7, 7, 'cash', 'pending', 100.00, '2025-10-19 23:52:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tables`
--

CREATE TABLE `tbl_tables` (
  `table_id` int(11) NOT NULL,
  `table_number` varchar(10) NOT NULL,
  `capacity` int(11) NOT NULL,
  `status` enum('available','occupied','reserved','cleaning') NOT NULL DEFAULT 'available',
  `location` varchar(50) DEFAULT 'Main Hall',
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_tables`
--

INSERT INTO `tbl_tables` (`table_id`, `table_number`, `capacity`, `status`, `location`, `description`) VALUES
(1, 'T1', 4, 'available', 'Main Hall', 'Window side table'),
(2, 'T2', 2, 'available', 'Main Hall', 'Cozy corner table'),
(3, 'T3', 6, 'available', 'Main Hall', 'Family table'),
(4, 'T4', 4, 'available', 'Garden', 'Outdoor seating'),
(5, 'T5', 8, 'available', 'Private Room', 'VIP table');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`tbl_menu_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_order_items`
--
ALTER TABLE `tbl_order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `tbl_tables`
--
ALTER TABLE `tbl_tables`
  ADD PRIMARY KEY (`table_id`),
  ADD UNIQUE KEY `table_number` (`table_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `tbl_menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_order_items`
--
ALTER TABLE `tbl_order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_tables`
--
ALTER TABLE `tbl_tables`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_order_items`
--
ALTER TABLE `tbl_order_items`
  ADD CONSTRAINT `tbl_order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_order_items_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `tbl_menu` (`tbl_menu_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD CONSTRAINT `tbl_payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_orders` (`order_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
