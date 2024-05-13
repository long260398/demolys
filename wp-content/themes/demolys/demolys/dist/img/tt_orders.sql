-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20230329.d5c6b427ba
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 12, 2024 at 11:38 AM
-- Server version: 5.5.68-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peridb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tt_orders`
--

CREATE TABLE `tt_orders` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` varchar(255) DEFAULT NULL,
  `street` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `order_code` varchar(20) DEFAULT NULL COMMENT 'Mã đơn hàng',
  `transaction_code` text,
  `data_product` text,
  `delivery_information` text COMMENT 'Thông tin nhận hàng',
  `price` int(11) DEFAULT NULL COMMENT 'Tổng số tiền ban đầu',
  `transport_fee` int(11) DEFAULT NULL COMMENT 'Phí giao hàng',
  `discount_price` int(11) DEFAULT NULL COMMENT 'Số tiền giảm giá',
  `code_voucher` varchar(50) DEFAULT NULL COMMENT 'Mã giảm giá nếu có',
  `data_voucher` text,
  `price_payment` int(11) DEFAULT NULL COMMENT 'Tổng số tiền cần thanh toán',
  `hang_vanchuyen` int(11) DEFAULT '1' COMMENT 'Hãng vận chuyển, 1: Express delivery, 2: Bưu điện, 3: Giao hàng tiết kiệm\r\n',
  `payment_method` int(11) DEFAULT NULL COMMENT '1: Thanh toán với thẻ, 2: Thanh toán khi nhận hàng, 3: Thành toán bằng chuyển khoản',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT 'Trạng thái thanh toán, 1: Chưa thanh toán, 2: Đã thanh toán, 3: Hủy, 4: Đang xử lý',
  `error_payment` text,
  `status_transport` int(11) NOT NULL DEFAULT '1' COMMENT 'Trạng thái giao hàng: 1: Chờ xác nhận 2: Chờ lấy hàng, 3: Đang giao hàng, 4: Đã giao hàng, 5: Đã hủy',
  `time_order` int(11) DEFAULT NULL COMMENT 'Thời gian đặt hàng',
  `time_delivery` int(11) DEFAULT NULL COMMENT 'Thời gian giao hàng',
  `user_refer_code` varchar(50) DEFAULT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tt_orders`
--
ALTER TABLE `tt_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tt_orders`
--
ALTER TABLE `tt_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
