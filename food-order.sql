-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2022 at 04:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(4, 'pham tuan hai', 'haituan', '123456'),
(7, 'dinh van long', 'longvan', '123456'),
(8, 'le van xuan', 'xuanle', '123456'),
(9, 'pham nhat hoang', 'hoangnhat', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(16, 'banh mi', 'Food_Category_588.jpg', 'No', 'Yes'),
(17, 'pizza', 'Food_Category_231.jpg', 'Yes', 'Yes'),
(18, 'xiu cao', 'Food_Category_962.jpg', 'Yes', 'Yes'),
(20, 'trai cay', 'Food_Category_17.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(4, 'bun cha dad', 'bun cha hang manh ha noi', '20.00', 'Food-Name-3505.jpg', 16, 'Yes', 'Yes'),
(5, 'banh mi cha', 'ngon bo re chat luong hang dau', '15.00', 'Food_Name_288.jpg', 18, 'Yes', 'Yes'),
(6, 'pizza hai san', 'tuoi ngon an toan suc khoe', '20.00', 'Food_Name_2987.jpg', 17, 'Yes', 'Yes'),
(7, 'ha cao tom', 'xuat xu trung quoc', '25.00', 'Food_Name_9944.jpg', 16, 'Yes', 'Yes'),
(8, 'banh mi thit', 'sieu cay dac biet', '16.00', 'Food_Name_7829.jpg', 16, 'Yes', 'Yes'),
(9, 'pizza basic', 'xuat xu tu y', '34.00', 'Food_Name_6781.jpg', 16, 'Yes', 'Yes'),
(10, 'bun ca', 'noi tieng ha thanh', '23.00', 'Food_Name_336.jpg', 16, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(2, 'bun ca', '23.00', 1, '23.00', '2022-06-13 11:00:18', 'Delivered', 'john dang', '0336235773', 'john@gmail.com', 'quan 1 , hcm city'),
(3, 'bun ca', '23.00', 1, '23.00', '2022-06-13 11:00:56', 'Delivered', 'angletest', '0336235773', 'angle@gmail.com', 'tu liem , ha noi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
