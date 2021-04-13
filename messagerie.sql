-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 13 avr. 2021 à 12:11
-- Version du serveur :  10.4.16-MariaDB
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `messagerie`
--

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `titre` text NOT NULL,
  `id_destinataire` int(11) NOT NULL,
  `id_expediteur` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_message` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `titre`, `id_destinataire`, `id_expediteur`, `message`, `date_message`) VALUES
(1, 'exam', 3, 2, 'slm', '0000-00-00 00:00:00'),
(2, 'test', 3, 4, 'lskdvjbg', '2021-03-21 11:41:44'),
(3, 'developpement', 2, 5, 'vous developpez en php?good ', '2021-03-21 12:13:01'),
(4, 'test', 3, 5, 'cc', '2021-03-21 12:14:19'),
(5, 'aazerty', 5, 5, 'message', '2021-03-21 12:15:33'),
(6, 'permission', 3, 6, 'hellohellohello\'hellohello', '2021-03-23 18:12:59'),
(7, 'rendez vous', 3, 1, 'hello', '2021-03-26 23:13:07');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `photo`) VALUES
(1, 'assmougue', '123456789', 'asmae.assmougue@gmail.com', 'inconnu.jpg'),
(2, 'fatima', '123456789', 'asmae.assmougue@gmail.com', 'inconnu.jpg'),
(3, 'latifa', '123456789', 'meriemr729@gmail.com', 'inconnu.jpg'),
(4, 'mahmoud', '123', 'mahmoud@gmail.com', 'mahmoud.jpg'),
(5, 'maryam', '123456789', 'asmouguekhadija@gmail.com', 'inconnu.jpg'),
(6, 'oumaira', '123456789', 'ilham@gmail.com', 'oumaira.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `id_destinataire` (`id_destinataire`),
  ADD KEY `id_expediteur` (`id_expediteur`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`id_destinataire`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`id_expediteur`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
