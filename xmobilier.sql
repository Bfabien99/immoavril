-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2022 at 06:35 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xmobilier`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `ad_nom` varchar(100) NOT NULL,
  `ad_pseudo` varchar(100) NOT NULL,
  `ad_contact` varchar(20) NOT NULL,
  `ad_email` varchar(100) NOT NULL,
  `ad_password` text NOT NULL,
  `ad_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `ad_nom`, `ad_pseudo`, `ad_contact`, `ad_email`, `ad_password`, `ad_created`) VALUES
(1, 'Fabien Brou', 'admin', '010504774183', 'admin@gmail.com', '0c7540eb7e65b553ec1ba6b20de79608', '2022-04-28 20:50:28');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `lu` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int(11) NOT NULL,
  `cust_nom` varchar(100) DEFAULT NULL,
  `cust_prenoms` varchar(100) DEFAULT NULL,
  `cust_pseudo` varchar(100) DEFAULT NULL,
  `cust_contact` varchar(20) DEFAULT NULL,
  `cust_email` varchar(100) DEFAULT NULL,
  `cust_password` text DEFAULT NULL,
  `cust_photo` text DEFAULT NULL,
  `cust_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text DEFAULT 'JE SUIS INTERRESER PAR CETTE PROPRIETE',
  `propriete_id` int(11) NOT NULL,
  `proprio_email` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `lu` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `proprietes`
--

CREATE TABLE `proprietes` (
  `prop_id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `nb_piece` int(11) NOT NULL,
  `nb_chambre` int(11) NOT NULL,
  `nb_douche` int(11) NOT NULL,
  `nb_wc` int(11) NOT NULL,
  `addresse` varchar(255) NOT NULL,
  `superficie` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL,
  `Description` text NOT NULL,
  `image` text NOT NULL,
  `nom_proprio` varchar(100) NOT NULL,
  `contact_proprio` varchar(20) NOT NULL,
  `email_proprio` varchar(100) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `vue` int(11) NOT NULL DEFAULT 0,
  `prop_created` datetime DEFAULT current_timestamp(),
  `enable` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`),
  ADD UNIQUE KEY `cust_pseudo` (`cust_pseudo`),
  ADD UNIQUE KEY `cust_email` (`cust_email`),
  ADD KEY `cust_email_2` (`cust_email`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propriete_id` (`propriete_id`),
  ADD KEY `messages_ibfk_2` (`proprio_email`);

--
-- Indexes for table `proprietes`
--
ALTER TABLE `proprietes`
  ADD PRIMARY KEY (`prop_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `addresse_2` (`addresse`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `proprietes`
--
ALTER TABLE `proprietes`
  MODIFY `prop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`propriete_id`) REFERENCES `proprietes` (`prop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proprietes`
--
ALTER TABLE `proprietes`
  ADD CONSTRAINT `proprietes_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
