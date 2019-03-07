-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 04, 2019 at 10:47 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'devops'),
(2, 'ops'),
(3, 'dev'),
(4, 'digi');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(32) DEFAULT NULL,
  `content` text,
  `category` int(11) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `dt` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `category`, `author`, `dt`) VALUES
(1, 'Qu\'est-ce que le Lorem Ipsum?', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.\n\nLe Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.\n\nLe Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', 2, 1, '04/03/2019 10:41:30'),
(2, 'Où puis-je m\'en procurer?', 'On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L\'avantage du Lorem Ipsum sur un texte générique comme \'Du texte. Du texte. Du texte.\' est qu\'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour \'Lorem Ipsum\' vous conduira vers de nombreux sites qui n\'en sont encore qu\'à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d\'y rajouter de petits clins d\'oeil, voire des phrases embarassantes).\n\nOn sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L\'avantage du Lorem Ipsum sur un texte générique comme \'Du texte. Du texte. Du texte.\' est qu\'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour \'Lorem Ipsum\' vous conduira vers de nombreux sites qui n\'en sont encore qu\'à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d\'y rajouter de petits clins d\'oeil, voire des phrases embarassantes).', 4, 1, '04/03/2019 10:42:15'),
(3, 'D\'où vient-il?', 'Plusieurs variations de Lorem Ipsum peuvent être trouvées ici ou là, mais la majeure partie d\'entre elles a été altérée par l\'addition d\'humour ou de mots aléatoires qui ne ressemblent pas une seconde à du texte standard. Si vous voulez utiliser un passage du Lorem Ipsum, vous devez être sûr qu\'il n\'y a rien d\'embarrassant caché dans le texte. Tous les générateurs de Lorem Ipsum sur Internet tendent à reproduire le même extrait sans fin, ce qui fait de lipsum.com le seul vrai générateur de Lorem Ipsum. Iil utilise un dictionnaire de plus de 200 mots latins, en combinaison de plusieurs structures de phrases, pour générer un Lorem Ipsum irréprochable. Le Lorem Ipsum ainsi obtenu ne contient aucune répétition, ni ne contient des mots farfelus, ou des touches d\'humour.\n\nPlusieurs variations de Lorem Ipsum peuvent être trouvées ici ou là, mais la majeure partie d\'entre elles a été altérée par l\'addition d\'humour ou de mots aléatoires qui ne ressemblent pas une seconde à du texte standard. Si vous voulez utiliser un passage du Lorem Ipsum, vous devez être sûr qu\'il n\'y a rien d\'embarrassant caché dans le texte. Tous les générateurs de Lorem Ipsum sur Internet tendent à reproduire le même extrait sans fin, ce qui fait de lipsum.com le seul vrai générateur de Lorem Ipsum. Iil utilise un dictionnaire de plus de 200 mots latins, en combinaison de plusieurs structures de phrases, pour générer un Lorem Ipsum irréprochable. Le Lorem Ipsum ainsi obtenu ne contient aucune répétition, ni ne contient des mots farfelus, ou des touches d\'humour.', 1, 1, '04/03/2019 10:42:58'),
(4, 'MacOS, le meilleur OS ?', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus erat tellus, hendrerit feugiat iaculis ac, lobortis eu enim. Vestibulum risus lorem, dignissim sit amet aliquet id, mollis sed justo. Aenean rutrum ultricies placerat. Cras leo sapien, ornare quis ultricies sit amet, cursus condimentum felis. Donec ac mi ante. Donec in enim eget nisi laoreet pulvinar vel tempus dolor. Suspendisse dignissim ut augue at porttitor. Quisque malesuada, ante vitae rhoncus placerat, urna dolor ornare massa, ut fringilla lectus dolor a tellus. Suspendisse potenti. Aenean nec eleifend lacus, sit amet sollicitudin elit.\n\nFusce ornare felis vel sapien convallis, sodales fermentum dui imperdiet. Proin id arcu laoreet, consectetur felis quis, porta sem. Nulla imperdiet orci turpis, eu interdum augue cursus a. In et elementum eros. Mauris euismod lacus leo, vel iaculis ligula eleifend sed. Aenean ultricies ante in justo rhoncus volutpat. Aenean et maximus libero. Proin non dui convallis, pulvinar sem vel, hendrerit enim. Nam nec consectetur libero. Donec tristique at metus at tristique. Nulla posuere, eros sed porta malesuada, lorem diam porta sapien, ut tempus neque nibh eu sapien. Etiam quis lectus ac erat consectetur sollicitudin. Pellentesque tristique erat arcu, ut sodales sem lacinia et. Aliquam ornare lectus eu elit ultricies scelerisque. Duis fermentum ante pellentesque massa lacinia, ultricies facilisis sem condimentum. Vestibulum vel consectetur sem. ', 3, 1, '04/03/2019 10:44:29'),
(5, 'Bientot adobe sur linux ?', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus erat tellus, hendrerit feugiat iaculis ac, lobortis eu enim. Vestibulum risus lorem, dignissim sit amet aliquet id, mollis sed justo. Aenean rutrum ultricies placerat. Cras leo sapien, ornare quis ultricies sit amet, cursus condimentum felis. Donec ac mi ante. Donec in enim eget nisi laoreet pulvinar vel tempus dolor. Suspendisse dignissim ut augue at porttitor. Quisque malesuada, ante vitae rhoncus placerat, urna dolor ornare massa, ut fringilla lectus dolor a tellus. Suspendisse potenti. Aenean nec eleifend lacus, sit amet sollicitudin elit.\n\nFusce ornare felis vel sapien convallis, sodales fermentum dui imperdiet. Proin id arcu laoreet, consectetur felis quis, porta sem. Nulla imperdiet orci turpis, eu interdum augue cursus a. In et elementum eros. Mauris euismod lacus leo, vel iaculis ligula eleifend sed. Aenean ultricies ante in justo rhoncus volutpat. Aenean et maximus libero. Proin non dui convallis, pulvinar sem vel, hendrerit enim. Nam nec consectetur libero. Donec tristique at metus at tristique. Nulla posuere, eros sed porta malesuada, lorem diam porta sapien, ut tempus neque nibh eu sapien. Etiam quis lectus ac erat consectetur sollicitudin. Pellentesque tristique erat arcu, ut sodales sem lacinia et. Aliquam ornare lectus eu elit ultricies scelerisque. Duis fermentum ante pellentesque massa lacinia, ultricies facilisis sem condimentum. Vestibulum vel consectetur sem. ', 2, 1, '04/03/2019 10:45:12'),
(6, 'Tesla, toujours aussi rapide ?', ' Maecenas volutpat accumsan purus, et molestie lectus ullamcorper in. Curabitur lorem lacus, ultrices a lobortis eget, maximus in eros. Aenean turpis tortor, aliquam eu felis sed, sodales aliquet nibh. Integer fermentum risus et tempor congue. Aliquam hendrerit sollicitudin eros id tempor. Suspendisse quis urna vel est egestas ultrices nec vitae quam. Etiam commodo cursus ante, sed efficitur lectus tristique ut.\n\nDonec ullamcorper cursus ante auctor luctus. Duis feugiat lacus cursus tellus feugiat, in vestibulum metus auctor. Nulla nisl sapien, mollis eu porta in, tincidunt id dolor. Integer et augue lorem. Maecenas feugiat lorem et augue tincidunt, eu ultricies turpis feugiat. Mauris volutpat, augue a pellentesque cursus, eros mi sodales tortor, sit amet tempor risus arcu ut ipsum. Maecenas eget dui sed mi tempor sollicitudin non non erat. Curabitur tempus sem eget risus eleifend, at volutpat neque egestas. Morbi sed molestie nunc, sed mattis neque. Phasellus vulputate eros eget nibh pulvinar, vel volutpat dui consequat. Nullam dignissim mi et purus imperdiet, ut fermentum elit elementum. ', 1, 1, '04/03/2019 10:45:49'),
(7, 'Les OPS future chommeur ?', ' Maecenas volutpat accumsan purus, et molestie lectus ullamcorper in. Curabitur lorem lacus, ultrices a lobortis eget, maximus in eros. Aenean turpis tortor, aliquam eu felis sed, sodales aliquet nibh. Integer fermentum risus et tempor congue. Aliquam hendrerit sollicitudin eros id tempor. Suspendisse quis urna vel est egestas ultrices nec vitae quam. Etiam commodo cursus ante, sed efficitur lectus tristique ut.\n\nMauris volutpat, augue a pellentesque cursus, eros mi sodales tortor, sit amet tempor risus arcu ut ipsum. Maecenas eget dui sed mi tempor sollicitudin non non erat. Curabitur tempus sem eget risus eleifend, at volutpat neque egestas. Morbi sed molestie nunc, sed mattis neque. Phasellus vulputate eros eget nibh pulvinar, vel volutpat dui consequat. Nullam dignissim mi et purus imperdiet, ut fermentum elit elementum. ', 2, 1, '04/03/2019 10:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `post_id` int(11) NOT NULL,
  `tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`post_id`, `tag`) VALUES
(1, 1),
(2, 1),
(3, 1),
(3, 2),
(3, 1),
(4, 1),
(5, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 6),
(7, 6),
(7, 1),
(7, 3),
(7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `url` varchar(32) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `url`, `name`) VALUES
(1, NULL, 'symfony'),
(2, NULL, 'photoshop'),
(3, NULL, 'google'),
(4, NULL, 'apple'),
(5, NULL, ''),
(6, NULL, 'tesla');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(128) DEFAULT NULL,
  `job` varchar(560) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'ROLE_USER'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `job`, `password`, `role`) VALUES
(1, 'Admin', 'administrateur du site', '$2y$10$wpGMI29A7zpfO/eehMIzeepsud8PROZXhjXk15MgPmkl/fGb9.PI6', 'ROLE_ADMIN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie` (`category`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `categorie` (`tag`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`author`) REFERENCES `users` (`id`);

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `post_tag_ibfk_2` FOREIGN KEY (`tag`) REFERENCES `tag` (`id`);
