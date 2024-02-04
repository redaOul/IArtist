-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 04, 2024 at 10:03 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `IArtist`
--

-- --------------------------------------------------------

--
-- Table structure for table `ARTISTE`
--

CREATE TABLE `ARTISTE` (
  `ARTISTEID` int(11) NOT NULL,
  `NOM` varchar(45) NOT NULL,
  `PHOTOP` varchar(255) DEFAULT './PROJET/Images/famous/artist/Unknown.png',
  `PHOTOC` varchar(255) NOT NULL DEFAULT './PROJET/Images/famous/artist/Unknown.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ARTISTE`
--

INSERT INTO `ARTISTE` (`ARTISTEID`, `NOM`, `PHOTOP`, `PHOTOC`) VALUES
(1, 'L. da Vinci', './PROJET/Images/famous/artist/1Leonardo-da-vinci-1024x1001.jpg', './PROJET/Images/famous/artist/1Leonardo-da-vinci-1024x1001.jpg'),
(2, 'V. van Gogh', './PROJET/Images/famous/artist/2download.jpg', './PROJET/Images/famous/artist/2download.jpg'),
(3, 'Michel-Ange', './PROJET/Images/famous/artist/3Michelangelo_Daniele_da_Volterra_(dettaglio).jpg', './PROJET/Images/famous/artist/3Michelangelo_Daniele_da_Volterra_(dettaglio).jpg'),
(4, 'Henri Matisse', './PROJET/Images/famous/artist/41136_henri_matisse_louis_aragon_gettyimages-615231628.jpg', './PROJET/Images/famous/artist/41136_henri_matisse_louis_aragon_gettyimages-615231628.jpg'),
(5, 'Rembrandt', './PROJET/Images/famous/artist/5Rembrandt.jpg', './PROJET/Images/famous/artist/5Rembrandt.jpg'),
(6, 'Raphaël', './PROJET/Images/famous/artist/6raphael..saint.sebastian.-1501-02-.jpg', './PROJET/Images/famous/artist/6raphael..saint.sebastian.-1501-02-.jpg'),
(7, 'Paul Gauguin', './PROJET/Images/famous/artist/7licensed-image.jpg', './PROJET/Images/famous/artist/7licensed-image.jpg'),
(8, 'Yayoi Kusama', './PROJET/Images/famous/artist/81200px-Yayoi_Kusama_cropped_1_Yayoi_Kusama_201611.jpg', './PROJET/Images/famous/artist/81200px-Yayoi_Kusama_cropped_1_Yayoi_Kusama_201611.jpg'),
(9, 'Auguste Renoir', './PROJET/Images/famous/artist/9licensed-image.jpg', './PROJET/Images/famous/artist/9licensed-image.jpg'),
(10, 'Johannes Vermeer', './PROJET/Images/famous/artist/10Cropped_version_of_Jan_Vermeer_van_Delft_002.jpg', './PROJET/Images/famous/artist/10Cropped_version_of_Jan_Vermeer_van_Delft_002.jpg'),
(11, 'Edvard Munch', './PROJET/Images/famous/artist/11download.png', './PROJET/Images/famous/artist/11download.png'),
(12, 'Frida Kahlo', './PROJET/Images/famous/artist/12Frida_Kahlo,_by_Guillermo_Kahlo.jpg', './PROJET/Images/famous/artist/12Frida_Kahlo,_by_Guillermo_Kahlo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `GENRES`
--

CREATE TABLE `GENRES` (
  `GENREID` int(11) NOT NULL,
  `GENRE` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `GENRES`
--

INSERT INTO `GENRES` (`GENREID`, `GENRE`) VALUES
(1, 'abstract'),
(2, 'decorative'),
(3, 'point-painting'),
(4, 'caricature'),
(5, 'cartoon'),
(6, 'realism'),
(7, 'sketch');

-- --------------------------------------------------------

--
-- Table structure for table `MESSAGES`
--

CREATE TABLE `MESSAGES` (
  `MESSAGEID` int(11) NOT NULL,
  `MESSAGE` varchar(2047) NOT NULL,
  `TEMPS` datetime NOT NULL DEFAULT current_timestamp(),
  `EXPEDITEURID` int(11) DEFAULT NULL,
  `DESTINATAIREID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `MESSAGES`
--

INSERT INTO `MESSAGES` (`MESSAGEID`, `MESSAGE`, `TEMPS`, `EXPEDITEURID`, `DESTINATAIREID`) VALUES
(32, 'hello ahmed how are you ?', '2021-09-21 22:29:06', 4, 9),
(33, 'i like your drawing !!', '2021-09-21 22:29:49', 4, 9),
(34, 'really !!', '2021-09-21 22:30:35', 9, 4),
(35, 'thank you its mean a lot', '2021-09-21 22:31:08', 9, 4),
(36, 'I also see your gallery its amazing', '2021-09-21 22:32:44', 9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `PEINTUREPOPULAIRE`
--

CREATE TABLE `PEINTUREPOPULAIRE` (
  `PEINTUREPOPULAIREID` int(11) NOT NULL,
  `DESTINATION` varchar(255) NOT NULL,
  `NOM` varchar(45) NOT NULL,
  `ARTISTEFK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `PEINTUREPOPULAIRE`
--

INSERT INTO `PEINTUREPOPULAIRE` (`PEINTUREPOPULAIREID`, `DESTINATION`, `NOM`, `ARTISTEFK`) VALUES
(1, './PROJET/Images/famous/drawing/1Ginevra-de-Benci-oil-panel-Leonardo-da.jpg', 'Ginevra de\' Benci', 1),
(2, './PROJET/Images/famous/drawing/11200px-Mona_Lisa,_by_Leonardo_da_Vinci,_from_C2RMF_retouched.jpg', 'mona lisa', 1),
(3, './PROJET/Images/famous/drawing/1Last-Supper-wall-painting-restoration-Leonardo-da-1999.jpg', 'Last Supper', 1),
(4, './PROJET/Images/famous/drawing/1Self-portrait-drawing-Leonardo-da-Vinci-Royal-Library.jpg', 'Self Portrait', 1),
(5, './PROJET/Images/famous/drawing/1Head-Woman-oil-earth-poplar-wood-lead.jpg', 'Head of a Woman', 1),
(6, './PROJET/Images/famous/drawing/1Lady-Ermine-oil-panel-Leonardo-da-Vinci.jpg', 'Lady with an Ermine', 1),
(7, './PROJET/Images/famous/drawing/11200px-Leonardo_Da_Vinci_-_Vergine_delle_Rocce_(Louvre).jpg', 'the virgin of the rocks', 1),
(8, './PROJET/Images/famous/drawing/1download.jpg', 'Salvator Mundi', 1),
(9, './PROJET/Images/famous/drawing/22560px-Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg', 'The Starry Night', 2),
(10, './PROJET/Images/famous/drawing/22048px-Van_Gogh_-Cafe_Terrace_at_Night.jpg', 'Café Terrace at Night', 2),
(11, './PROJET/Images/famous/drawing/2download.jpg', 'Wheatfield with Crows', 2),
(12, './PROJET/Images/famous/drawing/2Starry_Night_Over_the_Rhone.jpg', 'The Starry Night over the Rhone', 2),
(13, './PROJET/Images/famous/drawing/21200px-Irises-Vincent_van_Gogh.jpg', 'irises', 2),
(14, './PROJET/Images/famous/drawing/3Creación_de_Adán.jpg', 'The Creation of Adam', 3),
(15, './PROJET/Images/famous/drawing/3Michelangelo_Buonarroti_-_The_Torment_of_Saint_Anthony_-_Google_Art_Project.jpg', 'The Torment of Saint Anthony\r\n', 3),
(16, './PROJET/Images/famous/drawing/3hgfbdvzbdownload.jpg', 'Le Déluge', 3);

-- --------------------------------------------------------

--
-- Table structure for table `TABLEAU`
--

CREATE TABLE `TABLEAU` (
  `TABLEAUID` int(11) NOT NULL,
  `DESTINATION` varchar(255) NOT NULL,
  `NOM` varchar(45) NOT NULL,
  `TABDESCRIPTION` varchar(510) DEFAULT 'No description available',
  `TEMPS` datetime NOT NULL DEFAULT current_timestamp(),
  `UTILISATEURFK` int(11) DEFAULT NULL,
  `TYPEFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `TABLEAU`
--

INSERT INTO `TABLEAU` (`TABLEAUID`, `DESTINATION`, `NOM`, `TABDESCRIPTION`, `TEMPS`, `UTILISATEURFK`, `TYPEFK`) VALUES
(11, './PROJET/Images/Images/painting/pointillism-preview-400.png', 'D1', 'D1 FROM REDA', '2021-09-20 15:41:12', 4, 3),
(12, './PROJET/Images/Images/painting/images.png', 'D2', 'D2 FROM REDA', '2021-09-20 15:42:10', 4, 5),
(13, './PROJET/Images/Images/painting/images.jpg', 'D3', 'D3 FROM REDA', '2021-09-20 15:51:28', 4, 1),
(14, './PROJET/Images/Images/painting/images-5.jpg', 'D4', 'D4 FROM REDA', '2021-09-20 15:52:09', 4, 3),
(15, './PROJET/Images/Images/painting/images-4.jpg', 'D5', 'D5 FROM REDA', '2021-09-20 15:53:10', 4, 4),
(16, './PROJET/Images/Images/painting/images-3.jpg', 'D6', 'D6 FROM ANAS', '2021-09-20 15:56:04', 5, 4),
(17, './PROJET/Images/Images/painting/images-2.jpg', 'D7', 'D7 FROM ANAS', '2021-09-20 15:56:36', 5, 4),
(18, './PROJET/Images/Images/painting/download.jpg', 'D8', 'D8 FROM ANAS', '2021-09-20 15:58:01', 5, 5),
(19, './PROJET/Images/Images/painting/download-3.jpg', 'D9', 'D9 FROM ANAS', '2021-09-20 15:58:54', 5, 2),
(20, './PROJET/Images/Images/painting/086f1fa5987f6274d9f94b20732a53a0--stippling-art-shadow-of.jpg', 'D10', 'D10 FROM ANAS', '2021-09-20 16:02:29', 5, 3),
(21, './PROJET/Images/Images/painting/download-5.jpg', 'D11', 'D11 FROM AHMED', '2021-09-20 16:09:17', 9, 4),
(22, './PROJET/Images/Images/painting/download-4.jpg', 'D12', 'D12 FROM AHMED', '2021-09-20 16:10:11', 9, 4),
(23, './PROJET/Images/Images/painting/download-2.jpg', 'D13', 'D13 FROM AHMED', '2021-09-20 16:10:58', 9, 2),
(24, './PROJET/Images/Images/painting/download-1.jpg', 'D14', 'D14', '2021-09-20 16:11:27', 9, 5),
(25, './PROJET/Images/Images/painting/T06808_9.jpg', 'D16', 'D16 FROM ANAS', '2021-09-20 20:55:21', 5, 1),
(26, './PROJET/Images/Images/painting/T02319_9.jpg', 'D17', 'D17 FROM ANAS', '2021-09-20 20:55:46', 5, 1),
(27, './PROJET/Images/Images/painting/T00436_9.jpg', 'D15', 'D15 FROM AHMED', '2021-09-20 20:56:51', 9, 1),
(28, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.18.31.jpeg', 'Calm Girl', 'unfinished work but I would like to share with something pretty', '2021-09-26 22:33:29', 14, 6),
(29, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.18.30.jpeg', 'Bright eyes', 'a simple realism work that I shared with, I hope you like it', '2021-09-26 22:36:26', 14, 6),
(30, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.18.28 (1).jpeg', 'eyes details', 'Part of the drawing I\'m still working on', '2021-09-26 22:38:19', 14, 6),
(31, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.18.31 (2).jpeg', 'Strong personality', 'A drawing of a young woman whose features show that she is brave and strong', '2021-09-26 22:41:31', 14, 6),
(32, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.18.31 (1).jpeg', 'Kawtar in W&B', 'A drawing of the Moroccan comedian Kawtar Bamo', '2021-09-26 22:43:32', 14, 6),
(33, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.18.30 (1).jpeg', 'Girl & Summer', 'On the occasion of summer, I wanted to draw this girl who appears to be enjoying the summer atmosphere', '2021-09-26 22:45:53', 14, 6),
(34, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.18.29.jpeg', 'Gang Face', 'A drawing of a gang member that shows the details of the haircut and tattoos', '2021-09-26 22:49:04', 14, 6),
(35, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.18.28.jpeg', 'Radiant woman', '', '2021-09-26 22:57:10', 14, 6),
(36, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.18.21.jpeg', 'looking for hope', 'One of my most beautiful drawings, which I tried to put in many details', '2021-09-26 23:00:26', 14, 6),
(37, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.26.47.jpeg', 'Sonic', 'A quick drawing of Sonic, the fast and lovable character', '2021-09-26 23:11:22', 15, 5),
(38, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.27.32.jpeg', 'Goku', 'A drawing of the Goku character that I loved as a child with some additional elements', '2021-09-26 23:15:31', 15, 5),
(39, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.27.33.jpeg', 'Warrior', 'Cartoon character of a brave warrior holding his sword', '2021-09-26 23:34:20', 15, 5),
(40, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.27.38.jpeg', 'Dog Boxer', 'Everyone needs exercise', '2021-09-26 23:36:18', 15, 5),
(41, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.27.42 (1).jpeg', 'Luffy', 'Luffy is upset :(', '2021-09-26 23:41:05', 15, 5),
(42, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.27.51.jpeg', 'Sonic charachters', 'Sonic and Shadow in their full power', '2021-09-27 07:23:34', 15, 5),
(43, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.27.55.jpeg', 'Naruto Nine Tails', 'A simplified drawing of Naruto in the Nine-Tails mode', '2021-09-27 07:29:14', 15, 5),
(44, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-26 at 09.28.00.jpeg', 'Vegeta', 'I wanted to share with you the drawing that I am still working on, which is the character of Vegeta from the cartoon Dragon Ball Z', '2021-09-27 07:33:06', 15, 5),
(45, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-27 at 00.22.16.jpeg', 'Chess requires thinking', 'A drawing of a girl with a piece of chess pawn in her hands while she is in deep thought', '2021-09-27 08:05:13', 16, 5),
(46, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-27 at 00.22.15.jpeg', 'Love', '2 characters showing love for each other', '2021-09-27 10:06:33', 16, 5),
(47, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-27 at 00.22.15 (1).jpeg', 'Sharp eyes', 'a thick pencil sketch of a sharp-tempered girl', '2021-09-27 10:11:22', 16, 7),
(48, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-27 at 00.22.14.jpeg', '19th century women', 'simple sketch for a woman with clothes of 19th century', '2021-09-27 10:15:35', 16, 7),
(49, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-27 at 00.22.14 (3).jpeg', 'Cool & Pretty', 'modern young woman with cool haircut', '2021-09-27 10:17:15', 16, 6),
(50, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-27 at 00.22.14 (2).jpeg', 'Sly face', 'cartoon drawing for a sly character, i hope you like it', '2021-09-27 10:20:24', 16, 5),
(51, './PROJET/Images/Images/painting/WhatsApp Image 2021-09-27 at 00.22.14 (1).jpeg', 'Cruella', 'this is my attempt to draw the main character in the movie Cruella', '2021-09-27 10:22:59', 16, 7),
(53, './PROJET/Images/Images/painting/YOUSSART27-09-2021-1632737771WhatsApp Image 2021-09-27 at 00.22.13.jpeg', 'Stray face', 'this my last drawing, even if it\'s a sketch, I try to add more details to the character.', '2021-09-27 11:16:11', 16, 7),
(57, './PROJET/Images/Images/painting/Reda Oulemhour09-10-2021-1633806915WhatsApp Image 2021-09-26 at 09.27.54.jpeg', 'S character', 'character of Naruto ', '2021-10-09 20:15:15', 4, 7),
(58, './PROJET/Images/Images/painting/redouane kourchayin30-10-2021-1635603519WhatsApp Image 2021-09-28 at 17.23.13.jpeg', 'test', 'description', '2021-10-30 15:18:39', 21, 7);

-- --------------------------------------------------------

--
-- Table structure for table `UTILISATEUR`
--

CREATE TABLE `UTILISATEUR` (
  `UTILISATEURID` int(11) NOT NULL,
  `NOM` varchar(45) NOT NULL,
  `MOTDEPASSE` varchar(45) NOT NULL,
  `PHOTOP` varchar(255) DEFAULT './PROJET/Images/Images/photo-profil/Unknown.png',
  `PHOTOC` varchar(255) DEFAULT './PROJET/Images/Images/cover-profil/Unnamed.jpg',
  `BIO` varchar(510) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `UTILISATEUR`
--

INSERT INTO `UTILISATEUR` (`UTILISATEURID`, `NOM`, `MOTDEPASSE`, `PHOTOP`, `PHOTOC`, `BIO`) VALUES
(4, 'Reda Oulemhour', '1234', './PROJET/Images/Images/photo-profil/(256).jpg', './PROJET/Images/Images/cover-profil/(77).jpg', 'Hey guys, I\'m the one who created all this project for some summer homework, I hope you guys have fun while using my website!'),
(5, 'Anas Oulemhour', 'anas', './PROJET/Images/Images/photo-profil/Unknown.png', './PROJET/Images/Images/cover-profil/unnamed.jpg', NULL),
(9, 'Ahmed Mrabet', 'ahmed', './PROJET/Images/Images/photo-profil/(177).JPG', './PROJET/Images/Images/cover-profil/(6).JPG', ''),
(14, 'Yasser El-Hadraoui', 'yasser', './PROJET/Images/Images/photo-profil/WhatsApp Image 2021-09-26 at 20.55.10.jpeg', './PROJET/Images/Images/cover-profil/WhatsApp Image 2021-09-26 at 09.18.28 (1).jpeg', 'I\'m a painter who specializes more in realism painting, and this is my gallery, I hope you like it'),
(15, 'SYPHAXXY', 'qaz', './PROJET/Images/Images/photo-profil/WhatsApp Image 2021-09-26 at 20.59.28.jpeg', './PROJET/Images/Images/cover-profil/WhatsApp Image 2021-09-26 at 09.27.42 (1).jpeg', 'Hello, I\'m new here and this is my gallery. I like to draw cartoon characters more but I will try to publish drawings of many types.'),
(16, 'YOUSSART', 'wsx', './PROJET/Images/Images/photo-profil/WhatsApp Image 2021-09-27 at 00.22.19.jpeg', './PROJET/Images/Images/cover-profil/WhatsApp Image 2021-09-27 at 00.22.14 (3).jpeg', 'I love more sketching, but who knows ;) I can post other types of drawing'),
(17, 'ibo.drawing', 'edc', './PROJET/Images/Images/photo-profil/Unknown.png', './PROJET/Images/Images/cover-profil/Unnamed.jpg', NULL),
(21, 'redouan kourchayin', '1', './PROJET/Images/Images/photo-profil/Unknown.png', './PROJET/Images/Images/cover-profil/WhatsApp Image 2021-09-28 at 17.23.06.jpeg', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ARTISTE`
--
ALTER TABLE `ARTISTE`
  ADD PRIMARY KEY (`ARTISTEID`);

--
-- Indexes for table `GENRES`
--
ALTER TABLE `GENRES`
  ADD PRIMARY KEY (`GENREID`);

--
-- Indexes for table `MESSAGES`
--
ALTER TABLE `MESSAGES`
  ADD PRIMARY KEY (`MESSAGEID`),
  ADD KEY `EXPEDITEURID` (`EXPEDITEURID`),
  ADD KEY `DESTINATAIREID` (`DESTINATAIREID`);

--
-- Indexes for table `PEINTUREPOPULAIRE`
--
ALTER TABLE `PEINTUREPOPULAIRE`
  ADD PRIMARY KEY (`PEINTUREPOPULAIREID`),
  ADD KEY `ARTISTEFK` (`ARTISTEFK`);

--
-- Indexes for table `TABLEAU`
--
ALTER TABLE `TABLEAU`
  ADD PRIMARY KEY (`TABLEAUID`),
  ADD KEY `UTILISATEURFK` (`UTILISATEURFK`),
  ADD KEY `tableaugenre_idfk_5` (`TYPEFK`);

--
-- Indexes for table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  ADD PRIMARY KEY (`UTILISATEURID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ARTISTE`
--
ALTER TABLE `ARTISTE`
  MODIFY `ARTISTEID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `GENRES`
--
ALTER TABLE `GENRES`
  MODIFY `GENREID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `MESSAGES`
--
ALTER TABLE `MESSAGES`
  MODIFY `MESSAGEID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `PEINTUREPOPULAIRE`
--
ALTER TABLE `PEINTUREPOPULAIRE`
  MODIFY `PEINTUREPOPULAIREID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `TABLEAU`
--
ALTER TABLE `TABLEAU`
  MODIFY `TABLEAUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  MODIFY `UTILISATEURID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `MESSAGES`
--
ALTER TABLE `MESSAGES`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`EXPEDITEURID`) REFERENCES `UTILISATEUR` (`UTILISATEURID`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`DESTINATAIREID`) REFERENCES `UTILISATEUR` (`UTILISATEURID`);

--
-- Constraints for table `PEINTUREPOPULAIRE`
--
ALTER TABLE `PEINTUREPOPULAIRE`
  ADD CONSTRAINT `peinturepopulaire_ibfk_1` FOREIGN KEY (`ARTISTEFK`) REFERENCES `ARTISTE` (`ARTISTEID`);

--
-- Constraints for table `TABLEAU`
--
ALTER TABLE `TABLEAU`
  ADD CONSTRAINT `tableau_ibfk_1` FOREIGN KEY (`UTILISATEURFK`) REFERENCES `UTILISATEUR` (`UTILISATEURID`),
  ADD CONSTRAINT `tableaugenre_idfk_5` FOREIGN KEY (`TYPEFK`) REFERENCES `GENRES` (`GENREID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
