-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 08 Octobre 2025 à 08:18
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestionsimple`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idClient` int(11) NOT NULL,
  `nom` varchar(25) DEFAULT NULL,
  `postnom` varchar(25) DEFAULT NULL,
  `numero_telephone` text,
  `adresse` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`idClient`, `nom`, `postnom`, `numero_telephone`, `adresse`) VALUES
(9, 'Grace', 'vayisirirya', '0978259574', 'Butembo/av.walikale'),
(10, 'jospin', 'Muhindo', '+24999998766', 'Butembo');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `idproduit` int(11) NOT NULL,
  `nomproduit` varchar(50) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prixachat` double DEFAULT NULL,
  `prixvente` double DEFAULT NULL,
  `solde` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`idproduit`, `nomproduit`, `quantite`, `prixachat`, `prixvente`, `solde`) VALUES
(10, 'Ordinateur', 352, 1200, 1300, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

CREATE TABLE `transaction` (
  `idTransaction` int(11) NOT NULL,
  `idClient` int(11) DEFAULT NULL,
  `idproduit` int(11) DEFAULT NULL,
  `typeTransaction` varchar(20) DEFAULT NULL,
  `quantite` double DEFAULT NULL,
  `prixachat` double DEFAULT NULL,
  `prixVente` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `dateOperation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `transaction`
--

INSERT INTO `transaction` (`idTransaction`, `idClient`, `idproduit`, `typeTransaction`, `quantite`, `prixachat`, `prixVente`, `total`, `dateOperation`) VALUES
(2, 9, 10, 'depot', 1000, 100, 200, NULL, '2025-10-07'),
(4, 9, 10, 'depot', 40, 100, 120, NULL, '2025-10-07'),
(6, 9, 10, 'depot', 100, 1400, 1500, NULL, '2025-10-07'),
(8, 10, 10, 'depot', 100, 1200, 1300, NULL, '2025-10-07');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nomutilisateur` varchar(25) DEFAULT NULL,
  `role` varchar(25) DEFAULT NULL,
  `mdp` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nomutilisateur`, `role`, `mdp`) VALUES
(4, 'jospin', 'pdg', '$2y$10$.5LdH45F0nvsdWNet89.OeMg1LPov7EGaKFRlgB.ZPeNyG18Gtlwq'),
(5, 'grace', 'administrateur', '$2y$10$BxiPVhzsYScsedYSFgAuLOxYrBiODJOvmuLTCKXIqY.4akEeYC3oO');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idproduit`);

--
-- Index pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`idTransaction`),
  ADD KEY `idClient` (`idClient`),
  ADD KEY `idproduit` (`idproduit`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `idproduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `idTransaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`idproduit`) REFERENCES `produit` (`idproduit`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
