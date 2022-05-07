-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 07 mai 2022 à 17:26
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
-- Structure de la table `contact`
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
(4, 'brou', 'kouadio stéphane-fabien', 'fabien', '0153148864', 'fabienbrou99@gmail.com', '8ef8fb3af588a3830f68a04b1753dffe', '$2y$10$VmYpgt2BofIlYTdh5YhIK.mZ9xm3It2ptmn5n8ZUAQiSPNQrsLZ.pexels-cottonbro-4067753.jpg', '2022-05-07 10:06:48');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
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
  `lu` tinyint(1) DEFAULT 0,
  `identifier` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `nom`, `contact`, `email`, `message`, `propriete_id`, `proprio_email`, `date`, `lu`, `identifier`) VALUES
(39, 'essoh penuel', '0153148864', 'tyra@mailinator.com', 'je voudrais acheter cette maison', 33, 'kalbert@gmail.com', '2022-05-07 10:24:32', 1, 0),
(40, 'essoh penuel', '+1 (326) 289-3563', 'tyra@mailinator.com', 'je veux la louer', 34, 'fabienbrou99@gmail.com', '2022-05-07 10:29:21', 1, 1),
(41, 'brou kouadio stéphane-fabien', '0153148864', 'fabienbrou99@gmail.com', 'JE SUIS INTERRESSER PAR CETTE PROPRIETE', 33, 'kalbert@gmail.com', '2022-05-07 10:40:27', 1, 0);

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
(33, 'maison en bordure de mer', 5, 3, 2, 2, 'cocody angré, abidjan, côte d\'ivoire', 300, 'vendre', 200000, 'maison en bordure de mer avec 3 chambres bien aérées.\r\nla propriété existe depuis 1930, elle subit beaucoup de rénovation dans le but de convenir aux besoins de tous. c\'est une maison moderne.', '$2y$10$4.v1C8lc8IfYeffVANd.T15ujJb2eWyQx5CW8L.M5gOpmxEZkGpexels-pixabay-53610.jpg', 'koffi albert', '0101020308', 'kalbert@gmail.com', NULL, 6, '2022-05-07 09:58:31', 1),
(34, 'belle maison', 3, 1, 2, 2, 'abidjan yopougon, abidjan, côte d\'ivoire', 200, 'location', 120000, 'belle maison moderne', '$2y$10$iKimwUPheulp7gHRVTXHfOQzQ1UWQvxSMtt0wcOaSKMdCjdBcpPmpexels-expect-best-323780.jpg', 'brou kouadio stéphane-fabien', '0153148864', 'fabienbrou99@gmail.com', 4, 3, '2022-05-07 10:26:58', 1),
(36, 'maison de mon papa', 7, 3, 3, 2, 'resto-agboville continue, béoumi, côte d\'ivoire', 200, 'vendre', 2300000, 'belle maison bien situéé.', '$2y$10$42eqW7FP2sSDKmqZdySgq.7HWmaUIMDkAiU4K9Wx.x6FnEftJCpexels-sebastian-sørensen-731082.jpg', 'quibusdam id minim', '12016683317', 'jofywyti@mailinator.com', NULL, 0, '2022-05-07 14:52:23', 1),
(37, 'dolorum quia cumque', 42, 75, 1, 35, 'treichville, avenue 22, abidjan, côte d\'ivoire', 11, 'vendre', 45, 'veniam voluptatem u', '$2y$10$e6z55VBtErKSyU2gzWtCauNNVxuaEshjYjcdoMPYihTtPBDBv2wh2pexels-vj-von-art-8069214.jpg', 'deserunt nisi cupida', '12681666988', 'tikige@mailinator.com', NULL, 0, '2022-05-07 14:53:04', 1),
(38, 'mollit quo et sint n', 40, 97, 56, 72, 'près du musée, bondoukou, côte d\'ivoire', 65, 'location', 83, 'voluptas sed qui dol', '$2y$10$g2ZLQeV0hNvYQci89d1ubORraKllkLLg8C6xfV4CJfJM8dsABhcgSpexels-anna-zhilina-7525110.jpg', 'unde numquam aliqua', '18175461412', 'qyjepyr@mailinator.com', NULL, 0, '2022-05-07 14:53:24', 1),
(39, 'ab fugiat et officii', 34, 16, 65, 86, 'angré 8ème tranche, abidjan, côte d\'ivoire', 34, 'vendre', 21, 'ut modi quidem quis', '$2y$10$xXMncq2dEZz7Evy2JveuO.1TPj0CM0j5RJ.GH6xH.2QK1awwG2pexels-binyamin-mellish-106399.jpg', 'eu consequatur incid', '19774273088', 'devywehewe@mailinator.com', NULL, 0, '2022-05-07 14:53:47', 1),
(40, 'ipsa sit ut volupt', 27, 67, 26, 27, 'abobo pk18, abidjan', 68, 'location', 99, 'cillum ut sunt ad lo', '$2y$10$ljxZef.Bd6EmTs.LG.2EVeenxUE1.JESSu4LkQ6al1xU6qAQxrWBGpexels-expect-best-323775.jpg', 'ut accusamus quis vo', '13751113738', 'zadosopeja@mailinator.com', NULL, 0, '2022-05-07 14:55:38', 1),
(41, 'cumque consequuntur', 33, 74, 32, 74, 'abidjan mall, abidjan, côte d\'ivoire', 88, 'location', 93000, 'dolorum molestiae qu', '$2y$10$vxNzQo.OESJgI2uRT86aKeb1eX5qVbjLbo76aaSQ5B8ngCnXgvcDypexels-pixabay-53610.jpg', 'nostrud assumenda de', '12369785782', 'dejij@mailinator.com', NULL, 0, '2022-05-07 14:56:07', 1),
(42, 'fugiat ipsa omnis', 21, 26, 64, 1, 'koumassi campement, abidjan, côte d\'ivoire', 34, 'vendre', 31, 'quo et optio et adi', '$2y$10$GbhzhQ3pHM7shR2Ca2KtKepJDSym31ogk83Y4HnMw2ggqNmLm91dGpexels-frans-van-heerden-1438832.jpg', 'occaecat et dicta te', '19544285505', 'jedygox@mailinator.com', NULL, 0, '2022-05-07 14:56:28', 1),
(43, 'explicabo qui volup', 19, 23, 63, 14, 'blockhauss, a 2, abidjan, côte d\'ivoire', 101, 'vendre', 330000, 'enim iusto ex aliqui', '$2y$10$4bn17qhwxTzniTEHctK.4e7fzNlp2AWxQNdeXetuYdFrSnbk3MzBWpexels-pixabay-259588.jpg', 'reprehenderit dolor', '16397826418', 'wezilyv@mailinator.com', NULL, 0, '2022-05-07 14:57:08', 1),
(44, 'et unde rem illo vol', 34, 46, 41, 41, 'tribunal de 1ère instance abidjan-plateau, boulevard angoulvant, abidjan, côte d\'ivoire', 914, 'vendre', 880000, 'distinctio ut id su', '$2y$10$oo6nUTE8jFZK7rdDXyJPCuNUGi9BVNOa32o7kYb9wGCeyvXVDW8b6pexels-scott-webb-1022936.jpg', 'modi officia pariatu', '18124355788', 'hikypyg@mailinator.com', NULL, 1, '2022-05-07 14:57:44', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`),
  ADD UNIQUE KEY `cust_pseudo` (`cust_pseudo`),
  ADD UNIQUE KEY `cust_email` (`cust_email`),
  ADD KEY `cust_email_2` (`cust_email`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propriete_id` (`propriete_id`),
  ADD KEY `messages_ibfk_2` (`proprio_email`);

--
-- Index pour la table `proprietes`
--
ALTER TABLE `proprietes`
  ADD PRIMARY KEY (`prop_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `addresse_2` (`addresse`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `proprietes`
--
ALTER TABLE `proprietes`
  MODIFY `prop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`propriete_id`) REFERENCES `proprietes` (`prop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `proprietes`
--
ALTER TABLE `proprietes`
  ADD CONSTRAINT `proprietes_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
