-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 03, 2018 at 06:28 AM
-- Server version: 5.6.40
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klmexpre_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--


--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `name`, `bus_no`, `co_id`, `features`, `seats_count`) VALUES
(2, 'Abood bus 0066', 'BN9483483', 2, 'TV,AC,CHARGE,DRINKS,TOILET,WIFI', 62),
(3, 'Abood 002', 'BN232323', 2, 'TV,AC,WIFI', 58),
(4, 'Abood 003', 'BN232326', 2, 'TV,AC', 58),
(5, 'Abood 004', 'BN989899', 2, 'AC,TV,DRINKS,CHARGE', 60),
(6, 'Abood 005', 'BN546778', 2, 'TV,AC,DRINKS', 56),
(7, 'Abood 006', 'BN656567', 2, 'AC', 64),
(8, 'Abood 007', 'BN654345', 2, 'AC', 54),
(9, 'Abood 008', 'BN5656', 2, 'TV,AC', 60),
(10, 'Abood 009', 'BN768', 2, 'TV', 54),
(11, 'Hood 001', 'HD123', 10, 'TV,AC', 58),
(12, 'Hood 002', 'HD456', 10, 'TV, AC, WIFI', 58),
(13, 'Hood 003', 'HD874', 10, 'TV,AC,DRINKS', 58),
(14, 'Hood 004', 'HD090', 10, 'TV', 56),
(15, 'Hood 005', 'HD567', 10, '', 45),
(16, 'Dar Express 001', 'TZ 365 AFE', 4, 'TV,AC,WIFI,CHARGE,DRINKS', 45),
(17, 'Dar Express 002', 'TZ 485 JSH', 4, 'TV,AC,WIFI', 59),
(18, 'Dar Express 003', 'TZ 425 SHB', 4, 'TV,AC', 37),
(19, 'Dar Express 004', 'TZ 524 FDS', 4, 'TV,DRINKS', 60),
(20, 'Dar Express 005', 'TZ 065 DEG', 4, 'TV,AC,CHARGE,DRINKS', 64);

-- --------------------------------------------------------

--
-- Table structure for table `bus_features`
--



INSERT INTO `bus_features` (`id`, `amenities`) VALUES
(1, 'TV'),
(2, 'AC'),
(3, 'CHARGE'),
(4, 'DRINKS'),
(5, 'TOILET'),
(6, 'WIFI'),
(7, 'TV,AC,CHARGE,DRINKS,TOILET,WIFI');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--


-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `logo`) VALUES
(2, 'Abood Bus LTD', 'abood.jpg'),
(3, 'Kilimanjaro Express', 'klm.jpg'),
(4, 'Dar Express', 'darxps.jpg'),
(5, 'Dar Lux', 'dar_lux.jpg'),
(6, 'Kimbinyiko Coach', 'Kimbinyiko.jpg'),
(7, 'New Force', 'newforce.jpg'),
(8, 'Lakrome', 'lakrome.jpg'),
(9, 'Princes Muro', 'princesmuro.jpg'),
(10, 'Hood', 'hood.jpg'),
(11, 'Lim', 'lim.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`) VALUES
(1, 'Dar Es Salaam'),
(2, 'Morogoro'),
(5, 'Arusha'),
(6, 'Dodoma'),
(7, 'Geita'),
(8, 'Iringa'),
(9, 'Bukoba'),
(10, 'Mpanda'),
(11, 'Kigoma'),
(12, 'Moshi'),
(13, 'Lindi'),
(14, 'Babati'),
(15, 'Musoma'),
(16, 'Mbeya'),
(18, 'Mtwara'),
(19, 'Mwanza'),
(20, 'Njombe'),
(21, 'Kibaha'),
(22, 'Sumbawanga'),
(23, 'Songea'),
(24, 'Shinyanga'),
(25, 'Bariadi'),
(26, 'Singida'),
(27, 'Vwawa'),
(28, 'Tabora'),
(29, 'Tanga');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--
--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `r1`, `r2`, `bus_id`, `dep_date`) VALUES
(2, 1, 2, 2, '2018-09-02 08:18:00'),
(3, 1, 2, 3, '2018-09-02 12:00:00'),
(4, 1, 2, 4, '2018-09-02 11:00:00'),
(15, 5, 16, 11, '2018-09-03 06:00:00'),
(16, 5, 16, 14, '2018-09-03 06:00:00'),
(17, 1, 5, 16, '2018-09-03 05:30:00'),
(18, 5, 1, 17, '2018-09-03 06:00:00'),
(19, 1, 5, 18, '2018-09-03 07:30:00'),
(20, 1, 5, 19, '2018-09-02 05:30:00'),
(21, 5, 1, 20, '2018-09-02 07:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `sno`) VALUES
(1, 'A01'),
(2, 'A02'),
(3, 'A03'),
(4, 'A04'),
(5, 'A05'),
(6, 'A06'),
(7, 'A07'),
(8, 'A08'),
(9, 'A09'),
(10, 'A10'),
(11, 'A11'),
(12, 'A12'),
(13, 'A13'),
(14, 'A14'),
(15, 'A15'),
(16, 'A16'),
(17, 'A17'),
(18, 'A18'),
(19, 'A19'),
(20, 'A20'),
(21, 'A01'),
(22, 'A01'),
(23, 'A01'),
(24, 'A01'),
(25, 'A01'),
(26, 'A01'),
(27, 'A01'),
(28, 'A01'),
(29, 'A01'),
(30, 'A01'),
(31, 'A01'),
(32, 'A01'),
(33, 'A01'),
(34, 'A01'),
(35, 'A01'),
(36, 'A01'),
(37, 'A01'),
(38, 'A01'),
(39, 'A01'),
(40, 'A01'),
(41, 'A01'),
(42, 'A01'),
(43, 'A01'),
(44, 'A01'),
(45, 'A01'),
(46, 'A01'),
(47, 'A01'),
(48, 'A01'),
(49, 'A01'),
(50, 'A01'),
(51, 'A01'),
(52, 'A01'),
(53, 'A01'),
(54, 'A01'),
(55, 'A01'),
(56, 'A01'),
(57, 'A01'),
(58, 'A01'),
(59, 'A01'),
(60, 'A01'),
(61, 'A01'),
(62, 'A01');

-- --------------------------------------------------------

--
-- Table structure for table `seat_costs`
--
--
-- Dumping data for table `seat_costs`
--

INSERT INTO `seat_costs` (`id`, `cost`, `seat_id`, `bus_id`, `co_id`) VALUES
(3, 40000, 2, 2, 2),
(4, 41000, 3, 2, 2),
(5, 33000, 46, 16, 4),
(6, 36000, 28, 16, 4),
(7, 25000, 50, 16, 4);

-- --------------------------------------------------------

--
-- Table structure for table `seat_status`
--
-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--
--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `tno`, `ticket`, `qr`, `checkin`, `t_time`, `bus_id`, `route_id`, `user_id`, `seat_id`) VALUES
(2, 'TN09439394', 'dkjndsfm dnfmns fm,dsnfkjdjflksdjfdlfjsdfdsfds', 'dsfdsfkldsjgfkdlgjldshfdlksfjsdolfdsfds', '0', '2018-09-02 02:12:37', 2, 2, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fname`, `lname`, `email`, `phone_number`, `age`, `password`, `co_id`, `birth_date`, `priv`, `gender`) VALUES
(3, 'reddeath', 'red', 'death', 'frank@frank.com', 73923929, '2018-09-02', '0af84d7020627af78b304171880bd627c5a3a7b4', 2, '2018-09-02 10:15:33', 'admin', 'm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--