-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2022 at 01:50 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopja`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`Name`, `Email`, `Message`) VALUES
('Bob', 'bob@bob.com', 'hello'),
('Bob', 'bob@bob.com', 'hello'),
('dlfkjsglkdj', 'sodkosf', 'spdofkd'),
('max', 'max@gmail.com', 'question'),
('fred', 'fred@gmail', 'message'),
('Alex', 'Alex@gmail', 'Message'),
('max', 'maxgmail', 'hi'),
('nnm', 'mmm', 'mmm'),
('mm', 'mm', 'mm'),
('max froggatt', 'Maximilian.Froggatt@gmail.com', 'hello'),
('ss', 'ss', 'message'),
('name', 'name@gmail.com', 'Message'),
('test Name', 'Test name@gmail.com', 'Message wanting a refund'),
('Maximilian', 'max@gmail.com', 'I want to message for a refund');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(6) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Postcode` varchar(50) NOT NULL,
  `countryregion` varchar(50) NOT NULL,
  `TownCity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `Username`, `Password`, `Email`, `Name`, `Address`, `Postcode`, `countryregion`, `TownCity`) VALUES
(27, 'd', '8277e0910d750195b448797616e091ad', 'd', 'd', 'd', 'd', '', 'd'),
(29, 'm', '6f8f57715090da2632453988d9a1501b', 'maxm@gmail', 'max froggatt', 'virgina water ', 'gu25 4rd', '', 'surrey'),
(30, ' d', '8277e0910d750195b448797616e091ad', 'd', 'd', 'd', 'd', '', 'd'),
(31, 'j', '363b122c528f54df4a0446b6bab05515', 'j', 'j', 'j', 'j', '', 'j'),
(32, 'p', '83878c91171338902e0fe0fb97a8c47a', 'p', 'p', 'p', 'p', '', 'p'),
(33, 'y', '415290769594460e2e485922904f345d', 'y', 'y', 'y', 'y', '', 'y'),
(34, '6', '1679091c5a880faf6fb5e6087eb1b2dc', 'h', 'h', 'h', 'h', '', 'h'),
(35, '1', 'c4ca4238a0b923820dcc509a6f75849b', '1', '1', '1', '1', '', '1'),
(36, 'q', '7694f4a66316e53c8cdd9d9954bd611d', 'q', 'q', 'q', 'q', '', 'q'),
(37, '4', 'a87ff679a2f3e71d9181a67b7542122c', '3', '3', '3', '3', '', '3'),
(38, 'max.f', '93515f7556fc42e5b9dc8aae7325d51b', 'maxgmail', 'max f', 'london road', 'gu27', '', 'surrey'),
(39, 'as', 'f970e2767d0cfe75876ea857f92e319b', 'as', 'as', 'as', 'as', 'as', 'as'),
(41, 'knkn', '9332256b50468e6c9c462f45f52600e4', 'nk', 'kn', 'kn', 'kn', 'nk', 'nkkk'),
(42, 'irinap', '092fd3914671e61bef39b7a32be18964', 'irina@gmail.com', 'Irina P', 'Bearwood road', 'RGERDCV ', 'Englande', 'Reading'),
(43, ' ', '7215ee9c7d9dc229d2921a40e899ec5f', ' ', ' ', ' ', ' ', '   ', ' '),
(44, 'hello', '5d41402abc4b2a76b9719d911017c592', 'maxmfroggatt@gmail.com', 'max', 'dddd', 'dddd', 'dddd', 'ddddd'),
(45, 'gg', '35ce1d4eb0f666cd136987d34f64aedc', 'gfbf', 'gfbg', 'fbf', 'gbf', 'gfb', 'b'),
(46, 'max', '2ffe4e77325d9a7152f7086ea7aa5114', 'max@gmail.com', 'max froggatt', 'London, West drive 17', 'GU32 4RT', 'Uk', 'England'),
(47, '11', '6512bd43d9caa6e02c990b0a82652dca', '11', '1', '1', '1', '1', '1'),
(48, 'klk', '961cf6495c8fcc44be688a7b462ab27b', 'klklk', 'klk', 'klklk', 'klklk', 'klklk', 'klklkl'),
(49, 'c c ', '5ba00498406981cd80a983d1349af8e1', 'c c ', 'c c', ' c c cdfc', 'sdcs', 'dsc', 'sdcsd'),
(50, 'h', '2510c39011c5be704182423e3a695e91', 'hhhhhhhhhh', 'hhhhhhh', 'hhhhhhhh', 'hhhhhhhh', 'hhhhhhhhh', 'hhhhhhh'),
(51, 'mmmm', 'c4efd5020cb49b9d3257ffa0fbccc0ae', 'mmm', 'mmm', 'mmm', 'mmm', 'mmm', 'London'),
(52, 'max1', '5f4dcc3b5aa765d61d8327deb882cf99', 'maxmfroggatt@gmail.com', 'max froggatt', 'surrey', 'gu25', 'england', 'london'),
(53, 'newaccount', '5f4dcc3b5aa765d61d8327deb882cf99', 'newaccount@gmail.com', 'max', 'surrey', 'gy25', 'england', 'london');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `CustomerID` int(50) NOT NULL,
  `OrderID` int(50) NOT NULL,
  `Orderdate` date NOT NULL DEFAULT current_timestamp(),
  `total` decimal(50,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`CustomerID`, `OrderID`, `Orderdate`, `total`) VALUES
(30, 1, '2022-03-28', '31'),
(29, 3, '2022-03-28', '30'),
(29, 4, '2022-03-28', '110'),
(29, 5, '2022-03-28', '243'),
(29, 6, '2022-03-28', '243'),
(29, 7, '2022-03-28', '243'),
(29, 8, '2022-03-28', '243'),
(29, 9, '2022-03-28', '243'),
(29, 10, '2022-03-28', '243'),
(29, 11, '2022-03-28', '243'),
(29, 12, '2022-03-28', '243'),
(29, 13, '2022-03-28', '243'),
(29, 14, '2022-03-28', '243'),
(29, 15, '2022-03-28', '243'),
(29, 16, '2022-03-28', '243'),
(29, 17, '2022-03-28', '243'),
(29, 18, '2022-03-28', '243'),
(29, 19, '2022-03-28', '243'),
(29, 20, '2022-03-28', '243'),
(29, 21, '2022-03-28', '243'),
(29, 22, '2022-03-28', '243'),
(29, 23, '2022-03-28', '243'),
(29, 24, '2022-03-28', '348'),
(29, 25, '2022-03-28', '453'),
(29, 26, '2022-03-29', '110'),
(29, 27, '2022-03-29', '110'),
(29, 28, '2022-03-29', '110'),
(29, 29, '2022-03-29', '110'),
(29, 30, '2022-03-29', '5'),
(29, 31, '2022-03-29', '5'),
(29, 32, '2022-03-29', '5'),
(29, 33, '2022-03-29', '5'),
(29, 34, '2022-03-29', '5'),
(29, 35, '2022-03-29', '5'),
(29, 36, '2022-03-29', '126'),
(29, 37, '2022-03-29', '367'),
(29, 38, '2022-03-29', '615'),
(29, 39, '2022-03-29', '615'),
(29, 40, '2022-03-29', '615'),
(29, 41, '2022-03-29', '615'),
(29, 42, '2022-03-29', '615'),
(29, 43, '2022-03-29', '615'),
(29, 44, '2022-03-29', '615'),
(29, 45, '2022-03-29', '587'),
(29, 46, '2022-03-29', '441'),
(29, 47, '2022-03-29', '441'),
(29, 48, '2022-03-29', '441'),
(29, 49, '2022-03-29', '441'),
(29, 50, '2022-03-29', '441'),
(29, 51, '2022-03-29', '441'),
(29, 52, '2022-03-29', '126'),
(29, 53, '2022-03-29', '126'),
(29, 54, '2022-03-29', '336'),
(29, 55, '2022-03-29', '320'),
(29, 56, '2022-03-29', '392'),
(29, 57, '2022-03-29', '392'),
(29, 58, '2022-03-29', '138'),
(29, 59, '2022-03-29', '138'),
(29, 60, '2022-03-29', '126'),
(29, 61, '2022-03-29', '247'),
(29, 62, '2022-03-29', '247'),
(29, 63, '2022-03-29', '247'),
(29, 64, '2022-03-29', '247'),
(29, 65, '2022-03-29', '5'),
(29, 66, '2022-03-29', '272'),
(29, 67, '2022-03-29', '272'),
(29, 68, '2022-03-29', '272'),
(29, 69, '2022-03-29', '272'),
(29, 70, '2022-03-29', '5'),
(29, 71, '2022-03-29', '5'),
(29, 72, '2022-03-29', '609'),
(29, 73, '2022-03-29', '138'),
(29, 74, '2022-03-29', '380'),
(29, 75, '2022-03-30', '336'),
(29, 76, '2022-03-30', '392'),
(29, 77, '2022-03-30', '320'),
(52, 78, '2022-05-04', '730'),
(29, 79, '2022-05-04', '405'),
(29, 80, '2022-05-04', '530');

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

CREATE TABLE `order_line` (
  `OrderlineID` int(11) NOT NULL,
  `OrderID` int(50) NOT NULL,
  `ItemID` int(50) NOT NULL,
  `Quantity` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_line`
--

INSERT INTO `order_line` (`OrderlineID`, `OrderID`, `ItemID`, `Quantity`) VALUES
(1, 53, 1, 1),
(2, 54, 1, 1),
(3, 55, 2, 1),
(4, 55, 5, 1),
(5, 56, 1, 1),
(6, 56, 0, 1),
(7, 57, 1, 1),
(8, 57, 0, 1),
(23, 58, 0, 1),
(25, 59, 0, 1),
(27, 60, 1, 1),
(28, 61, 1, 2),
(29, 62, 1, 2),
(30, 63, 1, 2),
(31, 64, 1, 2),
(32, 66, 0, 2),
(33, 67, 0, 2),
(34, 68, 0, 2),
(35, 69, 0, 2),
(46, 72, 1, 5),
(49, 73, 0, 1),
(50, 74, 0, 1),
(51, 74, 1, 1),
(52, 75, 1, 1),
(53, 75, 2, 1),
(54, 76, 1, 1),
(55, 76, 0, 1),
(56, 77, 10, 1),
(57, 77, 8, 1),
(58, 78, 1, 6),
(59, 79, 0, 3),
(60, 80, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ItemID` int(50) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `Price` decimal(7,2) NOT NULL,
  `Stock` int(50) NOT NULL,
  `Size` varchar(50) NOT NULL,
  `Colour` varchar(50) NOT NULL,
  `Brand` varchar(50) NOT NULL,
  `Image` varchar(100) NOT NULL,
  `Condition` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ItemID`, `ItemName`, `Price`, `Stock`, `Size`, `Colour`, `Brand`, `Image`, `Condition`) VALUES
(0, 'Bape Baby Milo Hoodie', '126.99', 4, 'Extra Large', 'Grey', 'Bape', 'bath.jpg', 'New Condition'),
(1, 'Bape Camo Full-zip Hoodie', '115.00', 3, 'Large', 'Grey', 'Bape', 'lape.jpg', 'New Condition '),
(2, 'Chrome Hearts Zip Hoodie', '100.00', 5, 'Large', 'Black', 'Chrome Hearts', 'werrrr.jpg', 'New Condition'),
(3, 'Christian Dior Trotter Monogram Messenger Bag', '100.00', 2, 'One-Size', 'Beige', 'Dior', 'werrr.jpg', 'New Condition'),
(5, 'Evisu Denim Jeans', '100.00', 4, 'Medium', 'Denim/Red', 'Evisu', 'werr.jpg', 'New Condition'),
(6, 'Billionaire Boys Club Diamond Dollars Hoodie', '100.00', 5, 'Small', 'Grey', 'Billionaire Boys Club', 'werrrrr.jpg', 'New Condition'),
(7, 'Bape Bapesta Small Logo Sweatshirt', '100.00', 4, 'Medium', 'Brown', 'Bape', 'werrrrrr.jpg', 'New Condition'),
(8, 'Bape Camo College Full-zip Hoodie', '100.00', 1, 'Extra Large', 'Red', 'Bape', 'Bappe.jpg', 'New Condition'),
(9, 'Bape Bapesta Store Special', '100.00', 3, 'Medium', 'White', 'Bape', 'Baper.jpg', 'New Condition'),
(10, 'Bape Plaid Check Hoodie', '100.00', 6, 'Extra Small', 'Pink', 'Bape', 'bapppe.jpg', 'New Condition'),
(11, 'Chrome Hearts Cross Logo Hoodie', '100.00', 1, 'Large', 'Grey', 'Chrome Hearts', 'crh.jpg', 'New Condition'),
(13, 'Bape Tribal Camo Sweatshirt', '100.00', 10, 'Large', 'Green', 'Bape', 'tribal.jpg', 'New Condition'),
(14, 'Prada Nylon Messenger Bag', '100.00', 1, 'One-Size', 'Red', 'Prada', 'prada.jpg', 'New Condition'),
(15, 'Bape Ape Head Hoodie', '100.00', 5, 'Small', 'Grey', 'Bape', 'ig.jpg', 'New Condition'),
(21, 'Comme Des Garçons Homme Sweater', '95.00', 2, 'Medium', 'Grey', 'Comme Des Garçons', 'live.jpg', 'New Condition'),
(23, 'Bape Star Logo Full-zip Hoodie', '100.00', 3, 'Extra Large', 'Black', 'Bape', 'lop.jpg', 'New Condition'),
(24, 'Prada Nylon Strap Messenger', '80.00', 5, 'One-Size', 'Khaki', 'Prada', 'baggi.jpg', 'New Condition'),
(25, 'Comme Des Garçons Sweatshirt', '100.00', 1, 'Large', 'Black', 'Comme Des Garçons', 'coo.jpg', 'New Condition'),
(26, 'Comme Des Garçons Homme Tee', '65.00', 4, 'Small', 'White', 'Comme Des Garçons', 'cdp.jpg', 'New Condition'),
(28, 'Vintage Billionaire Boys Club Running Dog Jeans', '100.00', 1, 'Extra Large', 'Denim', 'Billionaire Boys Club', 'rd.jpg', 'Used'),
(29, 'Bape Neon Camo Hoodie', '100.00', 3, 'Small', 'Pink', 'Bape', 'pik.jpg', 'New Condition'),
(30, 'Christian Dior Mosaic Tee', '65.00', 8, 'Large', 'Black', 'Christian Dior', 'tet.jpg', 'New Condition'),
(31, 'Comme Des Garçons Homme Stripped Tee', '50.00', 2, 'Medium', 'Grey', 'Comme Des Garçons', 'cfg.jpg', 'New Condition'),
(32, 'Vintage Chrome Hearts CH Trucker Cap', '100.00', 1, 'One-Size', 'Black', 'Chrome Hearts', 'vinn.jpg', 'Used'),
(33, 'Evisu Multipocket Selvedge Denim', '100.00', 4, 'Large', 'Denim', 'Evisu', 'evy.jpg', 'New Condition');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`OrderlineID`),
  ADD KEY `ItemID` (`ItemID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ItemID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `OrderlineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ItemID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`);

--
-- Constraints for table `order_line`
--
ALTER TABLE `order_line`
  ADD CONSTRAINT `order_line_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `products` (`ItemID`),
  ADD CONSTRAINT `order_line_ibfk_2` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
