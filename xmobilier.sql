-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 30 avr. 2022 à 16:26
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `xmobilier`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
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
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`admin_id`, `ad_nom`, `ad_pseudo`, `ad_contact`, `ad_email`, `ad_password`, `ad_created`) VALUES
(1, 'Fabien Brou', 'admin', '010504774183', 'admin@gmail.com', '0c7540eb7e65b553ec1ba6b20de79608', '2022-04-28 20:50:28');

-- --------------------------------------------------------

--
-- Structure de la table `customers`
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

--
-- Déchargement des données de la table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_nom`, `cust_prenoms`, `cust_pseudo`, `cust_contact`, `cust_email`, `cust_password`, `cust_photo`, `cust_created`) VALUES
(1, 'brou', 'k', 'fabie', '01521488', 'fabienbrou99@gmail.com', '8082b382bea4c85367617e7271768276', '$2y$10$ereemEkQdNtARgMkKYOg5jTia2Wlp593RhGItauPuCYlqSD.2Gpexels-jack-winbow-1559486.jpg', '2022-04-28 17:51:28');

-- --------------------------------------------------------

--
-- Structure de la table `proprietes`
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
-- Déchargement des données de la table `proprietes`
--

INSERT INTO `proprietes` (`prop_id`, `titre`, `nb_piece`, `nb_chambre`, `nb_douche`, `nb_wc`, `addresse`, `superficie`, `type`, `prix`, `Description`, `image`, `nom_proprio`, `contact_proprio`, `email_proprio`, `customer_id`, `vue`, `prop_created`, `enable`) VALUES
(5, 'natus alias quis totam et cum.', 3, 2, 3, 4, 'aéroport félix houphouët boigny, abidjan, côte d\'ivoire', 127, 'vendre', 634, 'zczc', '$2y$10$gIdiCkuzwnO1kXNamK0TH.SI14WdcKRRI9UqQyquXt7tiDEDZdFKpexels-chloe-1043471.jpg', 'sonny heller', '0297488435', 'your.email+fakedata67496@gmail.com', NULL, 1, '2022-04-30 10:24:17', 1),
(6, 'laborum eaque reprehenderit est sed', 441, 593, 386, 421, '975 hartmann corners', 597, 'location', 195, 'hic qui cumque non et vitae voluptas. nemo eius saepe omnis. provident eaque a sequi architecto exercitationem illo molestiae. provident eum eius eveniet ab dignissimos dolores.', '$2y$10$PBANXAJVCm.sR9XCo58lORf.L5miUE34yLSmI9YeMXb0qQhgUSlapexels-photomix-company-101808.jpg', 'eileen prosacco', '2896064000', 'your.email+fakedata97405@gmail.com', NULL, 0, '2022-04-30 10:27:16', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`),
  ADD UNIQUE KEY `cust_pseudo` (`cust_pseudo`),
  ADD UNIQUE KEY `cust_email` (`cust_email`);

--
-- Index pour la table `proprietes`
--
ALTER TABLE `proprietes`
  ADD PRIMARY KEY (`prop_id`),
  ADD UNIQUE KEY `addresse` (`addresse`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `proprietes`
--
ALTER TABLE `proprietes`
  MODIFY `prop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `proprietes`
--
ALTER TABLE `proprietes`
  ADD CONSTRAINT `proprietes_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
