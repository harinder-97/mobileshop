-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2021 at 01:23 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ck_mstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `web_cart`
--

CREATE TABLE `web_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `porder` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_cart`
--

INSERT INTO `web_cart` (`id`, `user_id`, `product_id`, `product_name`, `product_price`, `qty`, `updated_on`, `porder`) VALUES
(8, 1, 2, 'oppo1.2', 600, 3, '2021-03-03 17:00:43', 1),
(9, 1, 2, 'oppo1.2', 200, 1, '2021-03-03 17:02:11', 1),
(10, 1, 1, 'oppo1.1', 1200, 1, '2021-03-03 17:09:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `web_category`
--

CREATE TABLE `web_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `_update` datetime NOT NULL,
  `_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_category`
--

INSERT INTO `web_category` (`id`, `category_name`, `_update`, `_status`) VALUES
(1, 'oppo1', '2021-02-15 19:32:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `web_checkout`
--

CREATE TABLE `web_checkout` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_checkout`
--

INSERT INTO `web_checkout` (`id`, `user_id`, `product_id`, `product_price`, `product_qty`, `updated_on`) VALUES
(7, 1, 2, '600', 3, '2021-03-03 17:00:54'),
(8, 1, 2, '200', 1, '2021-03-03 17:07:34'),
(9, 1, 1, '1200', 1, '2021-03-03 17:09:58');

-- --------------------------------------------------------

--
-- Table structure for table `web_contacus`
--

CREATE TABLE `web_contacus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `web_customers`
--

CREATE TABLE `web_customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` longtext NOT NULL,
  `phone_no` varchar(200) NOT NULL,
  `updated_on` datetime NOT NULL,
  `_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_customers`
--

INSERT INTO `web_customers` (`id`, `first_name`, `last_name`, `email`, `password`, `address`, `phone_no`, `updated_on`, `_status`) VALUES
(1, 'test', 'user', 'testuser@gmail.com', '5d9c68c6c50ed3d02a2fcf54f63993b6', 'mhghew ehgjekhge', '9807980999', '2021-02-18 00:21:19', 1),
(2, 'test', 'user1', 'testuser1@gmail.com', '41da76f0fc3ec62a6939e634bfb6a342', 'H.No.12345, Canada', '9807980999', '2021-02-18 00:21:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `web_productpics`
--

CREATE TABLE `web_productpics` (
  `id` int(11) NOT NULL,
  `pid` varchar(255) NOT NULL,
  `_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_productpics`
--

INSERT INTO `web_productpics` (`id`, `pid`, `_img`) VALUES
(1, '1', '1613397789.0oppo_f17.jpg'),
(2, '2', '1613397789.0oppo_f17.jpg'),
(3, '1', '1614674972.0oppo_f17_back.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `web_products`
--

CREATE TABLE `web_products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_details` longtext NOT NULL,
  `is_featured` tinyint(4) NOT NULL,
  `price` varchar(100) NOT NULL,
  `created_on` date NOT NULL,
  `updated_on` datetime NOT NULL,
  `_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_products`
--

INSERT INTO `web_products` (`id`, `product_name`, `product_category`, `product_details`, `is_featured`, `price`, `created_on`, `updated_on`, `_status`) VALUES
(1, 'oppo1.1', 1, 'oppo 1 is coming now!', 0, '1200', '2021-02-15', '2021-03-02 14:19:31', 0),
(2, 'oppo1.2', 1, 'oppo 2 is coming now!', 0, '200', '2021-02-15', '2021-02-15 19:33:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `web_sale`
--

CREATE TABLE `web_sale` (
  `id` int(11) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `updated_on` datetime NOT NULL,
  `_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_sale`
--

INSERT INTO `web_sale` (`id`, `product_category`, `product_id`, `product_price`, `discount`, `updated_on`, `_status`) VALUES
(1, '1', '1', ' 1200', '10', '2021-03-03 17:15:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `web_usermaster`
--

CREATE TABLE `web_usermaster` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address` longtext NOT NULL,
  `createdon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_usermaster`
--

INSERT INTO `web_usermaster` (`id`, `username`, `password`, `email`, `mobile`, `address`, `createdon`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin@gmail.com', '5767687879878', 'admin address', '2021-01-28 13:45:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `web_cart`
--
ALTER TABLE `web_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_category`
--
ALTER TABLE `web_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_checkout`
--
ALTER TABLE `web_checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_contacus`
--
ALTER TABLE `web_contacus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_customers`
--
ALTER TABLE `web_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_productpics`
--
ALTER TABLE `web_productpics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_products`
--
ALTER TABLE `web_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_sale`
--
ALTER TABLE `web_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_usermaster`
--
ALTER TABLE `web_usermaster`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `web_cart`
--
ALTER TABLE `web_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `web_category`
--
ALTER TABLE `web_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `web_checkout`
--
ALTER TABLE `web_checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `web_contacus`
--
ALTER TABLE `web_contacus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `web_customers`
--
ALTER TABLE `web_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `web_productpics`
--
ALTER TABLE `web_productpics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `web_products`
--
ALTER TABLE `web_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `web_sale`
--
ALTER TABLE `web_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `web_usermaster`
--
ALTER TABLE `web_usermaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
