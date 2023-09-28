# ************************************************************
# Sequel Ace SQL dump
# Version 20050
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 11.0.3-MariaDB-1:11.0.3+maria~ubu2204)
# Database: collection
# Generation Time: 2023-09-28 11:44:13 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table genre
# ------------------------------------------------------------

DROP TABLE IF EXISTS `genre`;

CREATE TABLE `genre` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;

INSERT INTO `genre` (`id`, `name`)
VALUES
	(1,'Soul'),
	(2,'Funk'),
	(3,'Pop'),
	(4,'Rock'),
	(5,'Metal'),
	(6,'Hip-Hop'),
	(7,'Jazz'),
	(8,'Country');

/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table records
# ------------------------------------------------------------

DROP TABLE IF EXISTS `records`;

CREATE TABLE `records` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `album_name` varchar(50) NOT NULL,
  `artist_name` varchar(50) NOT NULL,
  `genre_id` int(50) NOT NULL,
  `release_year` year(4) NOT NULL,
  `score` tinyint(11) NOT NULL,
  `img` varchar(200) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `records` WRITE;
/*!40000 ALTER TABLE `records` DISABLE KEYS */;

INSERT INTO `records` (`id`, `album_name`, `artist_name`, `genre_id`, `release_year`, `score`, `img`, `deleted`)
VALUES
	(1,'Maggot Brain','Funkadelic',2,'1970',9,'https://www.billboard.com/wp-content/uploads/2022/03/46.-Funkadelic-%E2%80%98Maggot-Brain-1971-album-art-billboard-1240.jpg',0),
	(2,'Stankonia','OutKast',6,'2000',10,'https://www.billboard.com/wp-content/uploads/2023/07/outkast-stankonia-cover-2000-billboard-1240.jpg',0),
	(3,'Goodbey Yellow Brick Road','Elton John',3,'1973',7,'https://www.billboard.com/wp-content/uploads/2023/07/elton-john-goodbye-yellow-brick-road-cover-1973-billboard-1240.jpg',0),
	(4,'Elephant','The White Stripes',4,'2003',7,'https://www.billboard.com/wp-content/uploads/2023/07/the-white-stripes-elephant-cover-2003-billboard-1240.jpg',0),
	(5,'Master of Puppets','Metallica',5,'1986',10,'https://www.billboard.com/wp-content/uploads/2022/03/35.-Metallica-%E2%80%98Master-of-Puppets-1986-album-art-billboard-1240.jpg',0),
	(6,'Bad Bunny','Un Verano Sin Ti',3,'2022',6,'https://www.billboard.com/wp-content/uploads/2023/07/Bad-Bunny-Un-Verano-Sin-Ti-album-art-billboard-1240.jpg',0),
	(7,'The Gambler','Kenny Rogers',8,'1978',8,'https://www.billboard.com/wp-content/uploads/2023/07/kenny-rogers-the-gambler-1978-billboard-1240.jpg',0),
	(8,'The Low End Theory','A Tribe Called Quest',6,'1991',9,'https://www.billboard.com/wp-content/uploads/2023/07/a-tribe-called-quest-the-low-end-theory-cover-1991-billboard-1240.jpg',0),
	(9,'Abbey Road','The Beatles',3,'1969',9,'https://www.billboard.com/wp-content/uploads/2022/03/2.-The-Beatles-%E2%80%98Abbey-Road-1969-album-art-billboard-1240.jpg',0),
	(10,'Blue Kentucky Girl','Emmylou Harris',8,'1979',6,'https://www.billboard.com/wp-content/uploads/2023/07/emmylou-harris-blue-kentucky-girl-1987-billboard-1240.jpg',0),
	(11,'The Slider','T. Rex',4,'1972',5,'https://www.billboard.com/wp-content/uploads/2023/07/t-rex-the-slider-1972-billboard-1240.jpg',0),
	(12,'London Callin','The Clash',4,'1979',9,'https://www.billboard.com/wp-content/uploads/2022/03/16.-The-Clash-%E2%80%98London-Calling-1979-album-art-billboard-1240.jpg',0),
	(13,'The Dark Side of the Moon','Pink Floyd',4,'1973',8,'https://www.billboard.com/wp-content/uploads/2022/03/6.-Pink-Floyd-%E2%80%98Dark-Side-of-the-Moon-1973-album-art-billboard-1240.jpg',0),
	(14,'To Pimp a Butterfly','Kendrick Lamar',6,'2015',9,'https://www.billboard.com/wp-content/uploads/2022/03/13.-Kendrick-Lamar-To-Pimp-a-Butterfly-2015-album-art-billboard-1240.jpg',0),
	(15,'Horses','Patti Smith',3,'1975',5,'https://www.billboard.com/wp-content/uploads/2022/03/3.-Patti-Smith-%E2%80%98Horses-1975-album-art-billboard-1240.jpg',0),
	(16,'Ramones','Ramones',4,'1976',6,'https://www.billboard.com/wp-content/uploads/2023/07/ramones-cover-1976-billboard-1240.jpg',0),
	(17,'One Nation Under a Groove','Funkadelic',2,'1978',7,'https://www.billboard.com/wp-content/uploads/2023/07/funkadelic-one-nation-under-a-groove-1978-billboard-1240.jpg',0),
	(18,'The Dreaming','Kate Bush',3,'1982',8,'https://www.billboard.com/wp-content/uploads/2023/07/kate-bush-the-dreaming-cover-1982-billboard-1240.jpg',0),
	(19,'Killers',' Iron Maiden',5,'1981',5,'https://www.billboard.com/wp-content/uploads/2023/07/iron-maiden-killers-1981-billboard-1240.jpg',0),
	(20,'Rio','Duran Duran',3,'1982',5,'https://www.billboard.com/wp-content/uploads/2022/03/21.-Duran-Duran-%E2%80%98Rio-1982-album-art-billboard-1240.jpg',0),
	(22,'Illmatic','Nas',6,'1994',8,'https://www.billboard.com/wp-content/uploads/2022/03/15.-Nas-%E2%80%98Illmatic-1994-album-art-billboard-1240.jpg',0),
	(23,'Young, Gifted and Black','Aretha Franklin',1,'1972',9,'https://www.billboard.com/wp-content/uploads/2023/07/aretha-franklin-young-gifted-black-1972-billboard-1240.jpg',0),
	(24,'First Take','Roberta Flack',1,'1969',7,'https://www.billboard.com/wp-content/uploads/2023/07/roberta-flack-first-take-cover-1969-billboard-1240.jpg',0),
	(30,'Surrealistic Pillow','Jefferson Airplane',4,'1967',7,'https://www.rollingstone.com/wp-content/uploads/2020/09/R1344-471-Jefferson-Airplane-Surrealistic-Pillow.jpg',0),
	(31,'The Gilded Palace of Sin','The Flying Burrito Brothers',3,'1969',4,'https://www.rollingstone.com/wp-content/uploads/2020/09/R1344-462-Flying-Burrito-Brothers-The-Gilded-Palace-of-Sin.jpg',0),
	(32,'Risqué','Chic',2,'1979',7,'https://www.rollingstone.com/wp-content/uploads/2020/09/R1344-414-Chic-Risque.jpg',0),
	(33,'Ace of Spades','Motörhead',5,'1980',7,'https://www.rollingstone.com/wp-content/uploads/2020/09/R1344-408-Motorhead-Ace-of-Spades.jpg',0),
	(34,'Run-D.M.C.','Run-DMC',6,'1983',7,'https://www.rollingstone.com/wp-content/uploads/2020/09/R1344-378-Run-DMC-Run-DMC.jpg',0),
	(35,'Parliament','Mothership Connection',2,'1975',6,'https://www.rollingstone.com/wp-content/uploads/2020/09/R1344-363-Parliament-Funk-MOTHER-SHIP.jpg',0),
	(36,'Elvis Presley','Elvis Presley',4,'1956',7,'https://www.rollingstone.com/wp-content/uploads/2020/09/R1344-332-Elvis-Presley-Elvis-Presley.jpg',0),
	(37,'The Definitive Collection','ABBA',3,'1980',8,'https://www.rollingstone.com/wp-content/uploads/2020/09/R1344-303-ABBA-The-Definitive-Collection.jpg?w',0);

/*!40000 ALTER TABLE `records` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
