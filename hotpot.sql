-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2024 at 04:12 AM
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
-- Database: `hotpot`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Ad_email` varchar(255) NOT NULL,
  `Ad_name` varchar(255) DEFAULT NULL,
  `Ad_password` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Ad_email`, `Ad_name`, `Ad_password`) VALUES
('tester3@gmail.com', 'Aaron Foo', '$2y$10$qkeHB0w/uPoaAKjOYb.vn.SKQl3ghwINybXJgsp3o8RauIoJZpYI6'),
('testing2@gmail.com', 'jon', '$2y$10$VZ4srUiQRVyUG2jZ/wQ7pefhdC6k7moYC6j..L7VfCKSRj7bsixhS');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_no` int(12) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `cus_email` varchar(255) NOT NULL,
  `people_no` int(12) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_no`, `package_name`, `cus_name`, `cus_email`, `people_no`, `date_time`) VALUES
(1037, 'COUPLE PACKAGE (OPTION 1)', 'Aaron Foo', 'testing1@gmail.com', 2, '2024-03-30 19:00:00'),
(1036, 'COUPLE PACKAGE (OPTION 2)', 'Aaron Foo', 'testing1@gmail.com', 2, '2024-04-04 18:59:00'),
(1035, 'FAMILY PACKAGE', 'Aaron', 'testing1@gmail.com', 6, '2024-03-28 18:58:00'),
(1031, 'GATHERING PACKAGE ', 'Aaron', 'testing1@gmail.com', 10, '2024-04-12 18:39:00'),
(1032, 'GATHERING PACKAGE ', 'Aaron', 'testing1@gmail.com', 10, '2024-04-12 18:39:00'),
(1028, 'COUPLE PACKAGE (OPTION 1)', 'aaron', 'tester2@gmail.com', 2, '2024-03-27 12:02:00'),
(1029, 'COUPLE PACKAGE (OPTION 1)', 'Aaron Foo', 'tester2@gmail.com', 2, '2029-02-12 12:02:00'),
(1030, 'COUPLE PACKAGE (OPTION 1)', 'Aaron Foo', 'tester2@gmail.com', 2, '2029-02-12 12:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_email` varchar(255) NOT NULL,
  `cus_phone_no` int(15) DEFAULT NULL,
  `cus_password` varchar(255) DEFAULT NULL,
  `cus_name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_email`, `cus_phone_no`, `cus_password`, `cus_name`) VALUES
('tester2@gmail.com', 123562335, '$2y$10$ulnYtIKYWZBjZAWGJOmWIuZPfAHcdDU7.nzibur/yBOv5bJZ9wxdW', 'Test2'),
('testing1@gmail.com', 1234567812, '$2y$10$BHXcwtPBGxg4uH9j2dg1N.eAcyy2wKPNzKWmv/e80khy34uE5MYnK', 'landon ');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(225) NOT NULL,
  `pax` int(11) NOT NULL,
  `food` varchar(225) NOT NULL,
  `room` enum('yes','no') NOT NULL,
  `price` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`package_id`, `package_name`, `pax`, `food`, `room`, `price`) VALUES
(1, 'FAMILY PACKAGE', 8, 'FREE FLOW MEAT (CHICKEN, BEEF, MUTTON) AND BUFFET ASSORTMENT', 'yes', 250),
(8, 'GATHERING PACKAGE', 10, 'FREE FLOW MEAT (CHICKEN, BEEF, MUTTON) AND BUFFET ASSORTMENTS', 'yes', 300),
(3, 'COUPLE PACKAGE (OPTION 1)', 4, 'FREE FLOW MEAT (CHICKEN, BEEF, MUTTON) AND BUFFET ASSORTMENT', 'no', 150),
(4, 'COUPLE PACKAGE (OPTION 2)', 2, 'FREE FLOW MEAT (CHICKEN, BEEF, MUTTON) OR BUFFET ASSORTMENT', 'no', 100),
(5, 'SINGLE PACKAGE (OPTION 1)', 1, 'FREE FLOW MEAT (CHICKEN, BEEF, MUTTON) AND BUFFET ASSORTMENT', 'no', 60),
(7, 'SINGLE PACKAGE (OPTION 2)', 1, 'FREE FLOW MEAT (CHICKEN, BEEF, MUTTON) OR BUFFET ASSORTMENTS', 'no', 50);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `receipt_no` int(12) NOT NULL,
  `pay_type` varchar(255) NOT NULL,
  `pay_total` int(12) NOT NULL DEFAULT 0,
  `completed` enum('Yes','No') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`receipt_no`, `pay_type`, `pay_total`, `completed`) VALUES
(1014, 'card', 0, 'No'),
(1015, 'card', 300, 'Yes'),
(1016, 'card', 300, 'No'),
(1017, 'ewallet', 300, 'No'),
(1018, 'ewallet', 300, 'No'),
(1019, 'card', 300, 'No'),
(1020, 'card', 300, 'No'),
(1021, 'ewallet', 300, 'No'),
(1022, 'card', 300, 'No'),
(1023, 'card', 300, 'No'),
(1024, 'ewallet', 300, 'No'),
(1025, 'ewallet', 300, 'No'),
(1026, 'card', 300, 'No'),
(1027, 'card', 300, 'No'),
(1028, 'card', 300, 'No'),
(1029, 'card', 300, 'No'),
(1030, 'ewallet', 300, 'No'),
(1031, 'card', 3000, 'No'),
(1032, 'card', 3000, 'No'),
(1033, 'card', 2000, 'Yes'),
(1034, 'card', 300, 'No'),
(1035, 'ewallet', 250, 'No'),
(1036, 'physical', 100, 'No'),
(1037, 'physical', 150, 'No');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Ad_email`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_no`),
  ADD KEY `package_name` (`package_name`),
  ADD KEY `cus_email` (`cus_email`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_email`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`receipt_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_no` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1038;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
