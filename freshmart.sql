-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2021 at 11:13 AM
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
-- Database: `freshmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` decimal(10,0) NOT NULL,
  `product_image` varchar(30) NOT NULL,
  `product_rating` int(11) NOT NULL,
  `product_description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `shop_id`, `product_name`, `product_price`, `product_image`, `product_rating`, `product_description`) VALUES
(1, 1, 'Fresh Organic Grapes', '100', 'toothpaste.jpg', 4, 'Grapes are right out of farm in our local area. It is organic, tasty and rich in nutrients. '),
(2, 1, 'Laptop', '60000', 'laptop.jpg', 3, 'This is a good laptop.'),
(3, 1, 'mouse', '40', 'mouse.jpg', 1, ''),
(4, 1, 'Pen', '30', 'pen.jpg', 2, ''),
(6, 1, 'Local Farm Eggs', '300', 'egg1.jpg', 5, 'Fresh raw chicken egg right out of chicken right now. Please buy it. We need this'),
(7, 0, 'Cooked Steak', '200', 'meat1.jpg', 4, 'This piece of meat is work of art, cooked by top rated chef of Clerkhudderfaxs sub-urb'),
(8, 0, 'Lobsters Indiana Crab', '900', 'sea4.jpg', 3, 'Fresh seafood right out of sea into the plate, ready to be served. '),
(9, 0, 'Red Tomatoes', '50', 'veg4.jpg', 5, 'Right out of hukleberrys farm out to you.'),
(10, 1, 'Strawberries (Alpine Alexandria)', '400', 'veg2.jpg', 5, 'This is the most expensive type of strawberry. So, eat it, sit back and relax.'),
(11, 0, 'Steak Meat Uncooked', '500', 'meat2.jpg', 4, ''),
(13, 0, '1', '0', 'this', 23, 'asdfsdafsdf');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL,
  `shop_name` varchar(50) NOT NULL,
  `shop_address` varchar(50) NOT NULL,
  `trader_id` int(11) NOT NULL,
  `no_of_staff` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `shop_name`, `shop_address`, `trader_id`, `no_of_staff`) VALUES
(1, 'Chandra Ashik Mill', 'Khaireni', 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `user_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `user_type`) VALUES
(1, 'abiral', 'abiral12', 'customer'),
(2, 'abis', 'abis12', 'customer'),
(3, 'ashik', 'ashik12', 'trader');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`),
  ADD KEY `trader_id` (`trader_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `shop_ibfk_1` FOREIGN KEY (`trader_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
