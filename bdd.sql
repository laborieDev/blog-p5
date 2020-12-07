-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  lun. 07 déc. 2020 à 19:13
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `openclassrooms_p5`
--

-- --------------------------------------------------------

--
-- Structure de la table `blog_post`
--

CREATE TABLE `blog_post` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `extract` mediumtext NOT NULL,
  `content` longtext NOT NULL,
  `img` varchar(255) NOT NULL,
  `views` int(11) NOT NULL,
  `add_at` date NOT NULL,
  `last_edit_at` date NOT NULL,
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `blog_post`
--

INSERT INTO `blog_post` (`id`, `title`, `extract`, `content`, `img`, `views`, `add_at`, `last_edit_at`, `id_author`) VALUES
(1, 'Le parralax', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'bram-naus-n8Qb1ZAkK88-unsplash.jpg', 19, '2020-11-16', '2020-12-01', 1),
(3, 'Le disque dur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'bram-naus-n8Qb1ZAkK88-unsplash.jpg', 2, '2020-11-16', '2020-11-20', 1),
(4, 'Le mac', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'bram-naus-n8Qb1ZAkK88-unsplash.jpg', 3, '2020-11-16', '2020-11-16', 1),
(5, 'Le clavier', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'article-1.jpg', 0, '2020-11-16', '2020-11-16', 1),
(6, 'Le téléphone', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'bram-naus-n8Qb1ZAkK88-unsplash.jpg', 8, '2020-11-16', '2020-11-20', 1),
(7, 'L\'iMac', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'article-1.jpg', 0, '2020-11-16', '2020-11-16', 1),
(8, 'iPod', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'article-1.jpg', 1, '2020-11-16', '2020-11-20', 1),
(9, 'iPad', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'article-1.jpg', 11, '2020-11-16', '2020-12-07', 1),
(22, 'title_pages', '$date = date_create($comment->getAddAt());\n            $date = date_format($date,\"d.m.Y\");', '$date = date_create($comment->getAddAt());\n            $date = date_format($date,\"d.m.Y\");', ' demarche-title.jpg', 0, '2020-11-27', '2020-11-27', 1),
(23, 'Applications iOS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et neque vel tortor fringilla porttitor. Donec placerat suscipit metus non interdum. Vestibulum efficitur eget justo in egestas.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et neque vel tortor fringilla porttitor. Donec placerat suscipit metus non interdum. Vestibulum efficitur eget justo in egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et neque vel tortor fringilla porttitor. Donec placerat suscipit metus non interdum. Vestibulum efficitur eget justo in egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et neque vel tortor fringilla porttitor. Donec placerat suscipit metus non interdum. Vestibulum efficitur eget justo in egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et neque vel tortor fringilla porttitor. Donec placerat suscipit metus non interdum. Vestibulum efficitur eget justo in egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et neque vel tortor fringilla porttitor. Donec placerat suscipit metus non interdum. Vestibulum efficitur eget justo in egestas.', ' demarche-title.jpg', 7, '2020-11-27', '2020-12-07', 1),
(24, 'Article 32', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et neque vel tortor fringilla porttitor. Donec placerat suscipit metus non interdum. Vestibulum efficitur eget justo in egestas.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et neque vel tortor fringilla porttitor. Donec placerat suscipit metus non interdum. Vestibulum efficitur eget justo in egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et neque vel tortor fringilla porttitor. Donec placerat suscipit metus non interdum. Vestibulum efficitur eget justo in egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et neque vel tortor fringilla porttitor. Donec placerat suscipit metus non interdum. Vestibulum efficitur eget justo in egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et neque vel tortor fringilla porttitor. Donec placerat suscipit metus non interdum. Vestibulum efficitur eget justo in egestas.', ' demarche-title.jpg', 2, '2020-11-27', '2020-12-07', 1);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Mes travaux'),
(2, 'Veille technologique'),
(3, 'Veille juridique');

-- --------------------------------------------------------

--
-- Structure de la table `category_blog_post`
--

CREATE TABLE `category_blog_post` (
  `id_category` int(11) NOT NULL,
  `id_blog_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category_blog_post`
--

INSERT INTO `category_blog_post` (`id_category`, `id_blog_post`) VALUES
(1, 1),
(1, 3),
(2, 4),
(1, 5),
(1, 6),
(2, 7),
(2, 8),
(3, 9),
(1, 22),
(3, 22),
(1, 23),
(3, 23),
(3, 24);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `author_name` varchar(55) NOT NULL,
  `content` longtext NOT NULL,
  `comment_status` varchar(10) NOT NULL,
  `add_at` date NOT NULL,
  `id_blog_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `author_name`, `content`, `comment_status`, `add_at`, `id_blog_post`) VALUES
(2, 'Anna SALESSE', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur tortor lacus, ac bibendum sapien venenatis a. Suspendisse suscipit ipsum non lacus venenatis, nec sagittis nisl aliquam. Ut tempor gravida dui vitae suscipit. Vestibulum aliquet lobortis mi tempor rhoncus. Proin eget dolor sed tortor condimentum lacinia.', 'isValid', '2020-11-18', 1),
(3, 'Michelle BLIVE', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur tortor lacus, ac bibendum sapien venenatis a. Suspendisse suscipit ipsum non lacus venenatis, nec sagittis nisl aliquam. Ut tempor gravida dui vitae suscipit. Vestibulum aliquet lobortis mi tempor rhoncus. Proin eget dolor sed tortor condimentum lacinia.', 'isValid', '2020-11-18', 1),
(4, 'Paul DALON', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur tortor lacus, ac bibendum sapien venenatis a. Suspendisse suscipit ipsum non lacus venenatis, nec sagittis nisl aliquam. Ut tempor gravida dui vitae suscipit. Vestibulum aliquet lobortis mi tempor rhoncus. Proin eget dolor sed tortor condimentum lacinia.', 'isValid', '2020-11-18', 1),
(5, 'Anthony LABORIE', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur tortor lacus.', 'isReject', '2020-11-19', 1),
(8, 'Louane BELEMER', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'isReject', '2020-11-20', 6),
(9, 'Anthony LABORIE', 'Essai', 'isValid', '2020-11-20', 1),
(10, 'Bernard BVOL', 'Essai - Validé un commentaire depuis le dashboard', 'isValid', '2020-11-20', 1),
(11, 'rivelle.julie', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. ', 'isReject', '2020-12-01', 23),
(13, 'dupond.alex', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. ', 'isValid', '2020-12-01', 23),
(17, 'prade.paul', '\nAllo Essai NULL', 'isReject', '2020-12-02', 9),
(18, 'pouelle.amele', 'Anna ', 'isValid', '2020-12-02', 9),
(19, 'lemole.emilie', 'Brut', 'isValid', '2020-12-02', 9),
(20, 'dupond.alex', 'Essai', 'isReject', '2020-12-02', 9),
(21, 'pouelle.amele', 'Super Article ! ', 'isValid', '2020-12-07', 9),
(22, 'dupond.alex', 'Super Article !', 'waiting', '2020-12-07', 9);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `first_name` varchar(55) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(15) NOT NULL,
  `add_at` date NOT NULL,
  `user_type` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `last_name`, `first_name`, `email`, `password`, `add_at`, `user_type`) VALUES
(1, 'LABORIE', 'Anthony', 'acs.agl46@gmail.com', 'admin', '2020-11-16', 'admin'),
(3, 'MOURET', 'Antoine', 'a@a.fr', 'Essai0212', '2020-12-01', 'author');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_author` (`id_author`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category_blog_post`
--
ALTER TABLE `category_blog_post`
  ADD PRIMARY KEY (`id_category`,`id_blog_post`),
  ADD KEY `id_blog_post` (`id_blog_post`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_blog_post` (`id_blog_post`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `blog_post`
--
ALTER TABLE `blog_post`
  ADD CONSTRAINT `blog_post_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `category_blog_post`
--
ALTER TABLE `category_blog_post`
  ADD CONSTRAINT `category_blog_post_ibfk_1` FOREIGN KEY (`id_blog_post`) REFERENCES `blog_post` (`id`),
  ADD CONSTRAINT `category_blog_post_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_blog_post`) REFERENCES `blog_post` (`id`);
