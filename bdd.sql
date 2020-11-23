-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 20, 2020 at 04:29 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `openclassrooms_p5`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
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
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`id`, `title`, `extract`, `content`, `img`, `views`, `add_at`, `last_edit_at`, `id_author`) VALUES
(1, 'Le parralax', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'bram-naus-n8Qb1ZAkK88-unsplash.jpg', 18, '2020-11-16', '2020-11-20', 1),
(2, 'Le smartphone', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'article-1.jpg', 10, '2020-11-16', '2020-11-20', 1),
(3, 'Le disque dur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'bram-naus-n8Qb1ZAkK88-unsplash.jpg', 2, '2020-11-16', '2020-11-20', 1),
(4, 'Le mac', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'bram-naus-n8Qb1ZAkK88-unsplash.jpg', 3, '2020-11-16', '2020-11-16', 1),
(5, 'Le clavier', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'article-1.jpg', 0, '2020-11-16', '2020-11-16', 1),
(6, 'Le téléphone', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'bram-naus-n8Qb1ZAkK88-unsplash.jpg', 8, '2020-11-16', '2020-11-20', 1),
(7, 'L\'iMac', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'article-1.jpg', 0, '2020-11-16', '2020-11-16', 1),
(8, 'iPod', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'article-1.jpg', 1, '2020-11-16', '2020-11-20', 1),
(9, 'iPad', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce in ultrices orci. Fusce quam augue, ultrices sit amet massa vitae, porta suscipit lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'article-1.jpg', 2, '2020-11-16', '2020-11-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Mes travaux'),
(2, 'Veille technologique'),
(3, 'Veille juridique');

-- --------------------------------------------------------

--
-- Table structure for table `category_blog_post`
--

CREATE TABLE `category_blog_post` (
  `id_category` int(11) NOT NULL,
  `id_blog_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_blog_post`
--

INSERT INTO `category_blog_post` (`id_category`, `id_blog_post`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(1, 5),
(1, 6),
(2, 7),
(2, 8),
(3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
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
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `author_name`, `content`, `comment_status`, `add_at`, `id_blog_post`) VALUES
(1, 'Michel BLANE', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur tortor lacus, ac bibendum sapien venenatis a. Suspendisse suscipit ipsum non lacus venenatis, nec sagittis nisl aliquam. Ut tempor gravida dui vitae suscipit. Vestibulum aliquet lobortis mi tempor rhoncus. Proin eget dolor sed tortor condimentum lacinia.', 'isValid', '2020-11-18', 1),
(2, 'Anna SALESSE', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur tortor lacus, ac bibendum sapien venenatis a. Suspendisse suscipit ipsum non lacus venenatis, nec sagittis nisl aliquam. Ut tempor gravida dui vitae suscipit. Vestibulum aliquet lobortis mi tempor rhoncus. Proin eget dolor sed tortor condimentum lacinia.', 'isValid', '2020-11-18', 1),
(3, 'Michelle BLIVE', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur tortor lacus, ac bibendum sapien venenatis a. Suspendisse suscipit ipsum non lacus venenatis, nec sagittis nisl aliquam. Ut tempor gravida dui vitae suscipit. Vestibulum aliquet lobortis mi tempor rhoncus. Proin eget dolor sed tortor condimentum lacinia.', 'isValid', '2020-11-18', 1),
(4, 'Paul DALON', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur tortor lacus, ac bibendum sapien venenatis a. Suspendisse suscipit ipsum non lacus venenatis, nec sagittis nisl aliquam. Ut tempor gravida dui vitae suscipit. Vestibulum aliquet lobortis mi tempor rhoncus. Proin eget dolor sed tortor condimentum lacinia.', 'waiting', '2020-11-18', 1),
(5, 'Anthony LABORIE', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur tortor lacus.', 'isReject', '2020-11-19', 1),
(6, 'Michel BOLURET', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur tortor lacus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur tortor lacus !', 'isValid', '2020-11-19', 2),
(7, 'Lemole Emilie', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur tortor lacusLorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur tortor lacus.', 'waiting', '2020-11-19', 2),
(8, 'Louane BELEMER', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc fringilla tellus eu sapien placerat, sed sollicitudin dolor aliquam.', 'isReject', '2020-11-20', 6),
(9, 'Anthony LABORIE', 'Essai', 'isValid', '2020-11-20', 1),
(10, 'Bernard BVOL', 'Essai - Validé un commentaire depuis le dashboard', 'isValid', '2020-11-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `last_name`, `first_name`, `email`, `password`, `add_at`, `user_type`) VALUES
(1, 'LABORIE', 'Anthony', 'acs.agl46@gmail.com', 'admin', '2020-11-16', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_author` (`id_author`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_blog_post`
--
ALTER TABLE `category_blog_post`
  ADD PRIMARY KEY (`id_category`,`id_blog_post`),
  ADD KEY `id_blog_post` (`id_blog_post`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_blog_post` (`id_blog_post`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD CONSTRAINT `blog_post_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `user` (`id`);

--
-- Constraints for table `category_blog_post`
--
ALTER TABLE `category_blog_post`
  ADD CONSTRAINT `category_blog_post_ibfk_1` FOREIGN KEY (`id_blog_post`) REFERENCES `blog_post` (`id`),
  ADD CONSTRAINT `category_blog_post_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_blog_post`) REFERENCES `blog_post` (`id`);
