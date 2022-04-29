-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2022 at 02:38 PM
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
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int(11) NOT NULL,
  `cust_nom` varchar(100) NOT NULL,
  `cust_prenoms` varchar(100) NOT NULL,
  `cust_pseudo` varchar(100) NOT NULL,
  `cust_contact` varchar(20) NOT NULL,
  `cust_email` varchar(100) DEFAULT NULL,
  `cust_password` text NOT NULL,
  `cust_photo` text DEFAULT NULL,
  `cust_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_nom`, `cust_prenoms`, `cust_pseudo`, `cust_contact`, `cust_email`, `cust_password`, `cust_photo`, `cust_created`) VALUES
(1, 'brou', 'kouadio fabien', 'fabien', '0152148864', 'fabienbrou99@gmail.com', 'b2dd7d8e6f1722a1e23a101e890c77f0', NULL, '2022-04-28 17:51:28'),
(2, 'sit voluptate sed', 'officia iste anim au', 'dolor ut eligendi ex', '', 'tyfinywa@mailinator.com', '3bf7f9ce3190e8b37595e7c8133cc090', NULL, '2022-04-28 19:25:10');

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
  `customer_id` int(11) DEFAULT NULL,
  `vue` int(11) NOT NULL DEFAULT 0,
  `prop_created` datetime DEFAULT current_timestamp(),
  `enable` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proprietes`
--

INSERT INTO `proprietes` (`prop_id`, `titre`, `nb_piece`, `nb_chambre`, `nb_douche`, `nb_wc`, `addresse`, `superficie`, `type`, `prix`, `Description`, `image`, `nom_proprio`, `contact_proprio`, `customer_id`, `vue`, `prop_created`, `enable`) VALUES
(1, 'Grande Maison Bleue', 3, 1, 1, 2, 'earum quis doloremqu', 2000, 'location', 760000, 'dolorem temporibus b', '$2y$10$w0f0LZgDNlefZCAvynYOipD6vbvqxLwaDgqPZeTp1QxU.qJX7C.lucia-macedo-z9FST1uGqlc-unsplash.jpg', 'eius tempora perfere', '+1 (644) 721-7192', NULL, 0, '2022-04-28 22:35:04', 1),
(2, 'Petite Prairie', 18, 12, 11, 12, 'eos commodo aut vero', 60, 'location', 99999000, 'voluptatum dolore ra', '$2y$10$MOfFPxOCCyimR5z2FhPgOxa0pFyGW9TWFNh.r6lBoiShKMuGmcR6DJI_0026.jpg', 'dolorem assumenda es', '+1 (848) 295-5903', NULL, 3, '2022-04-28 22:43:55', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`),
  ADD UNIQUE KEY `cust_pseudo` (`cust_pseudo`),
  ADD UNIQUE KEY `cust_email` (`cust_email`);

--
-- Indexes for table `proprietes`
--
ALTER TABLE `proprietes`
  ADD PRIMARY KEY (`prop_id`),
  ADD UNIQUE KEY `addresse` (`addresse`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `proprietes`
--
ALTER TABLE `proprietes`
  MODIFY `prop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
