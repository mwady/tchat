-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 22 déc. 2019 à 12:52
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tchat`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `user_sender_id` int(11) NOT NULL,
  `added_in` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`message_id`, `message`, `to_user_id`, `user_sender_id`, `added_in`) VALUES
(1, 'Bonjour cava?', 2, 1, '2019-12-21 18:55:43'),
(2, 'Bien merci', 1, 2, '2019-12-21 18:56:29'),
(3, 'et toi?', 1, 2, '2019-12-21 18:56:29'),
(4, 'Hey Ronaldo', 3, 1, '2019-12-21 22:42:09'),
(5, 'Hey Mehdi, How are you?', 1, 3, '2019-12-21 23:34:05'),
(7, 'aussi', 2, 1, '2019-12-22 00:34:14'),
(8, 'Fine thanks', 3, 1, '2019-12-22 00:35:08'),
(17, ':)', 3, 1, '2019-12-22 00:50:06'),
(18, 'Lorem ipsum dolor', 3, 2, '2019-12-22 01:24:10'),
(19, 'Salut', 4, 1, '2019-12-22 10:44:04'),
(20, 'So', 2, 1, '2019-12-22 11:25:19'),
(21, '??', 4, 1, '2019-12-22 11:38:01');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_connected` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `avatar`, `password`, `is_connected`) VALUES
(1, 'Mehdi wady', 'elmehdiwady@gmail.com', 'mwady', '0', 'ab4f63f9ac65152575886860dde480a1', b'0'),
(2, 'Imane Baha', 'imane.b@gmail.com', 'imane', '1576947853.png', 'ab4f63f9ac65152575886860dde480a1', b'0'),
(3, 'Mark junior', 'r.junior@gmail.com', 'mark', '1576948132.png', 'ab4f63f9ac65152575886860dde480a1', b'0'),
(4, 'Sabrine Wy', 'sabrine.wy@hotmail.com', 'sabrine', '1576974462.jpg', 'ab4f63f9ac65152575886860dde480a1', b'0'),
(5, 'WADY Walid', 'walid.wady@gmail.com', 'walid', '0', 'ab4f63f9ac65152575886860dde480a1', b'0');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
