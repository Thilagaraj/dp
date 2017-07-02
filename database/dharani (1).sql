-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2017 at 06:37 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dharani`
--

-- --------------------------------------------------------

--
-- Table structure for table `dp_fields`
--

CREATE TABLE `dp_fields` (
  `id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_label` varchar(255) NOT NULL,
  `field_type` varchar(255) NOT NULL,
  `field_options` text NOT NULL,
  `field_desc` text NOT NULL,
  `field_status` tinyint(1) NOT NULL DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `modified_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dp_fields`
--

INSERT INTO `dp_fields` (`id`, `field_name`, `field_label`, `field_type`, `field_options`, `field_desc`, `field_status`, `date_created`, `is_deleted`, `modified_date`) VALUES
(3, 'test', 'test', 'text', '[]', 'test', 1, '2017-07-01 09:25:10', 1, '2017-07-01'),
(4, 'Qqwrqw', 'qweqwewqe', 'dropdown', '[{\"option_name\":\"ewewr\",\"option_value\":\"ewewr\",\"option_price\":\"12\"},{\"option_name\":\"test\",\"option_value\":\"test\",\"option_price\":\"23\"}]', 'ererew', 1, '2017-07-01 09:25:10', 1, '2017-07-01'),
(5, 'GSM & Board', 'GSM & Board', 'dropdown', '[{\"option_name\":\"90GSM - 2MM Thickness\",\"option_value\":\"90GSM - 2MM Thickness\",\"option_price\":\"120\"},{\"option_name\":\"90GSM - 5MM Thickness\",\"option_value\":\"90GSM - 5MM Thickness\",\"option_price\":\"150\"},{\"option_name\":\"100GSM - 3MM Thickness\",\"option_value\":\"100GSM - 3MM Thickness\",\"option_price\":\"200\"},{\"option_name\":\"100GSM - 5MM Thickness\",\"option_value\":\"100GSM - 5MM Thickness\",\"option_price\":\"250\"}]', 'Thickness and Board Combinations with prices', 1, '2017-07-01 11:37:40', 0, '0000-00-00'),
(6, 'Sides', 'Sides', 'dropdown', '[{\"option_name\":\"Single Sided\",\"option_value\":\"Single Sided\",\"option_price\":\"100\"},{\"option_name\":\"Double Sided\",\"option_value\":\"Double Sided\",\"option_price\":\"200\"}]', 'Print Sides', 1, '2017-07-01 11:38:32', 0, '0000-00-00'),
(7, 'Color', 'Color', 'dropdown', '[{\"option_name\":\"Single Color\",\"option_value\":\"Single Color\",\"option_price\":\"150\"},{\"option_name\":\"Multi Color\",\"option_value\":\"Multi Color\",\"option_price\":\"120\"}]', 'Color types Selection', 1, '2017-07-01 11:39:32', 0, '0000-00-00'),
(8, 'Sample Text', 'Sample Text', 'text', '[]', 'Sample Text', 1, '2017-07-01 13:39:24', 0, '0000-00-00'),
(9, 'Sample Number', 'Sample Number', 'number', '[]', 'Sample Number', 1, '2017-07-01 13:42:12', 0, '0000-00-00'),
(10, 'Sample Textarea', 'Sample Textarea', 'textarea', '[]', 'Sample Textarea', 1, '2017-07-01 13:42:34', 0, '0000-00-00'),
(11, 'Sample Price', 'Sample Price', 'price', '[]', 'Sample Price', 1, '2017-07-01 13:53:29', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `dp_orders`
--

CREATE TABLE `dp_orders` (
  `id` int(11) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `order_phone` varchar(255) NOT NULL,
  `order_email` varchar(255) NOT NULL,
  `order_address` text NOT NULL,
  `order_product` varchar(255) NOT NULL,
  `order_product_information` text NOT NULL,
  `order_custom_fields` text NOT NULL,
  `order_date` date NOT NULL,
  `order_delivery_date` date NOT NULL,
  `order_actual_delivered_date` date NOT NULL,
  `order_additional_info` text NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_amount` int(11) NOT NULL,
  `order_amount_paid` double NOT NULL,
  `order_amount_balance` double NOT NULL,
  `order_location` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dp_orders`
--

INSERT INTO `dp_orders` (`id`, `order_name`, `order_phone`, `order_email`, `order_address`, `order_product`, `order_product_information`, `order_custom_fields`, `order_date`, `order_delivery_date`, `order_actual_delivered_date`, `order_additional_info`, `order_quantity`, `order_amount`, `order_amount_paid`, `order_amount_balance`, `order_location`, `order_status`, `created_date`, `modified_date`, `is_deleted`) VALUES
(1, 'Thilagaraj', '9698120906', 'tk.thilagaraj@gmail.com', 'Test Address', '1', 'Tests Product info', '', '2017-06-18', '2017-06-08', '0000-00-00', 'Test Add Info', 123, 0, 0, 0, 'Sathyamanagalam', 'In Progress', '2017-06-18 13:40:50', '0000-00-00 00:00:00', 1),
(2, 'Thilagaraj', '9698120906', 'tk.thilagaraj@gmail.com', 'Test Address', '4', 'Tests Product info', '[{\"field_id\":5,\"field_value\":\"90GSM - 2MM Thickness\"},{\"field_id\":6,\"field_value\":\"Double Sided\"},{\"field_id\":7,\"field_value\":\"Single Color\"},{\"field_id\":8,\"field_value\":\"23\"},{\"field_id\":9,\"field_value\":\"12\"},{\"field_id\":11,\"field_value\":\"23\"}]', '2017-06-01', '2017-06-18', '0000-00-00', 'Test Add Infos', 123, 60639, 60000, 639, 'Sathyamanagalam', 'In Progress', '2017-06-18 13:54:22', '2017-07-01 00:00:00', 0),
(3, 'Thilagaraj', '9698120906', 'tk.thilagaraj@gmail.com', 'Test Address', '2', 'Tests Product info', '', '2017-06-18', '2017-06-08', '0000-00-00', 'Test Add Info', 123, 123, 0, 0, 'Sathyamanagalam', 'In Progress', '2017-06-18 13:55:44', '2017-07-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dp_products`
--

CREATE TABLE `dp_products` (
  `id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `product_description` text NOT NULL,
  `product_parent` int(11) NOT NULL DEFAULT '0',
  `product_fields` text NOT NULL,
  `product_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dp_products`
--

INSERT INTO `dp_products` (`id`, `product_name`, `product_description`, `product_parent`, `product_fields`, `product_status`, `created_date`, `modified_date`, `is_deleted`) VALUES
(1, 'Visiting Cards', 'Visiting Cards', 0, '7,6,5', 1, '2017-06-18 15:49:49', '2017-07-01', 0),
(2, 'Calendars', 'Calendars', 0, '8,6,5', 1, '2017-06-18 15:50:19', '2017-07-01', 0),
(3, 'ewwer', 'werwe', 0, '4', 1, '2017-07-01 11:26:10', '2017-07-01', 1),
(4, 'Inivitation', 'Inivitation Cards', 0, '11,9,8,7,6,5', 1, '2017-07-01 11:41:49', '2017-07-01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dp_users`
--

CREATE TABLE `dp_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dp_users`
--

INSERT INTO `dp_users` (`id`, `name`, `mobile`, `email`, `password`, `avatar`, `created_date`, `is_active`) VALUES
(1, 'Admin', '9698120906', 'admin@gmail.com', 'admin@123', 'assets/portraits/5.jpg', '2017-06-02 13:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dp_fields`
--
ALTER TABLE `dp_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_orders`
--
ALTER TABLE `dp_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_products`
--
ALTER TABLE `dp_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dp_users`
--
ALTER TABLE `dp_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dp_fields`
--
ALTER TABLE `dp_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `dp_orders`
--
ALTER TABLE `dp_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `dp_products`
--
ALTER TABLE `dp_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `dp_users`
--
ALTER TABLE `dp_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
