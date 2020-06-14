-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cp236
-- ------------------------------------------------------
-- Server version	10.3.22-MariaDB-1:10.3.22+maria~stretch

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `catalog`
--

DROP TABLE IF EXISTS `catalog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CodSt` int(11) NOT NULL,
  `Sesiune` varchar(50) NOT NULL,
  `IP` int(11) DEFAULT NULL,
  `BD` int(11) DEFAULT NULL,
  `PAW` int(11) DEFAULT NULL,
  `PLF` int(11) DEFAULT NULL,
  `POO` int(11) DEFAULT NULL,
  `AM` int(11) DEFAULT NULL,
  `LFT` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `CodSt` (`CodSt`),
  CONSTRAINT `catalog_ibfk_1` FOREIGN KEY (`CodSt`) REFERENCES `student` (`CodSt`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalog`
--

LOCK TABLES `catalog` WRITE;
/*!40000 ALTER TABLE `catalog` DISABLE KEYS */;
INSERT INTO `catalog` VALUES (1,1,'vara',1,1,1,1,1,1,1),(2,2,'vara',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `catalog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domeniu`
--

DROP TABLE IF EXISTS `domeniu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domeniu` (
  `CodD` int(11) NOT NULL AUTO_INCREMENT,
  `DenD` varchar(50) NOT NULL,
  `CodF` int(11) NOT NULL,
  PRIMARY KEY (`CodD`),
  KEY `CodF` (`CodF`),
  CONSTRAINT `domeniu_ibfk_1` FOREIGN KEY (`CodF`) REFERENCES `facultate` (`CodF`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domeniu`
--

LOCK TABLES `domeniu` WRITE;
/*!40000 ALTER TABLE `domeniu` DISABLE KEYS */;
INSERT INTO `domeniu` VALUES (1,'CTI',1);
/*!40000 ALTER TABLE `domeniu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facultate`
--

DROP TABLE IF EXISTS `facultate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facultate` (
  `CodF` int(11) NOT NULL AUTO_INCREMENT,
  `DenF` varchar(50) NOT NULL,
  `Locatie` varchar(50) NOT NULL,
  PRIMARY KEY (`CodF`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facultate`
--

LOCK TABLES `facultate` WRITE;
/*!40000 ALTER TABLE `facultate` DISABLE KEYS */;
INSERT INTO `facultate` VALUES (1,'Calculatoare','Galati');
/*!40000 ALTER TABLE `facultate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inmatriculare`
--

DROP TABLE IF EXISTS `inmatriculare`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inmatriculare` (
  `CodM` int(11) NOT NULL AUTO_INCREMENT,
  `An` int(11) NOT NULL,
  `Grupa` varchar(50) NOT NULL,
  `Medie` varchar(50) NOT NULL,
  `Bursa` tinyint(1) DEFAULT NULL,
  `FormaInv` varchar(50) NOT NULL,
  `CodSt` int(11) NOT NULL,
  `CodS` int(11) NOT NULL,
  PRIMARY KEY (`CodM`),
  KEY `CodSt` (`CodSt`),
  KEY `CodS` (`CodS`),
  CONSTRAINT `inmatriculare_ibfk_1` FOREIGN KEY (`CodSt`) REFERENCES `student` (`CodSt`),
  CONSTRAINT `inmatriculare_ibfk_2` FOREIGN KEY (`CodS`) REFERENCES `specializare` (`CodS`)
) ENGINE=InnoDB AUTO_INCREMENT=12939 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inmatriculare`
--

LOCK TABLES `inmatriculare` WRITE;
/*!40000 ALTER TABLE `inmatriculare` DISABLE KEYS */;
INSERT INTO `inmatriculare` VALUES (1,3,'22c31','10',1,'freceventa',1,1),(2,4,'22c31','10',1,'freceventa',2,1),(3,2,'22c22','6',1,'frecventa',3,1),(4,4,'33c21','8',0,'frecventa',4,1),(5,1,'11cc11','9',1,'frecventa',5,1);
/*!40000 ALTER TABLE `inmatriculare` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `table_row` int(11) NOT NULL,
  `command` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'alex','users',1,'delete','2020-05-02 23:39:33'),(2,'alex','inmatriculare',1,'modify','2020-06-05 12:25:48'),(3,'alex','inmatriculare',6,'add','2020-06-05 12:26:38'),(4,'alex','inmatriculare',6,'add','2020-06-05 12:27:16'),(5,'alex','inmatriculare',6,'delete','2020-06-05 12:27:30');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specializare`
--

DROP TABLE IF EXISTS `specializare`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specializare` (
  `CodS` int(11) NOT NULL AUTO_INCREMENT,
  `DenS` varchar(50) NOT NULL,
  `CodD` int(11) NOT NULL,
  PRIMARY KEY (`CodS`),
  KEY `CodD` (`CodD`),
  CONSTRAINT `specializare_ibfk_1` FOREIGN KEY (`CodD`) REFERENCES `domeniu` (`CodD`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specializare`
--

LOCK TABLES `specializare` WRITE;
/*!40000 ALTER TABLE `specializare` DISABLE KEYS */;
INSERT INTO `specializare` VALUES (1,'Inginer IT',1);
/*!40000 ALTER TABLE `specializare` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `CodSt` int(11) NOT NULL AUTO_INCREMENT,
  `Nume` varchar(50) NOT NULL,
  `Prenume` varchar(50) NOT NULL,
  `Cetatenie` varchar(50) NOT NULL,
  `DataN` date NOT NULL,
  PRIMARY KEY (`CodSt`)
) ENGINE=InnoDB AUTO_INCREMENT=12939 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'Ghoerghe','Mihaita','rom','1998-03-17'),(2,'Stratulat-Diaconu','Adriana','roman','1998-06-26'),(3,'Baluta','Andrei','roman','1998-01-22'),(4,'Tabacaru','Andra','roman','1997-07-21'),(5,'Stalin','Joseph','rus','1976-08-22');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `role` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'student','$2y$10$PY6JhuqDyDbBXrB0QSyZbe6MgORZZWI3kbkFk54VwLPKrh/aRCfMe','2020-05-03 00:31:41','Student'),(2,'profesor','$2y$10$q9D/u1.dvbHRr54zw.Hs9OW2P4tfPH.VgBznbtyvEYOr9qoQc/wp2','2020-05-03 00:31:53','Profesor'),(3,'secretar','$2y$10$dVhk8YWRBELY9PzcgbbbSOP5wm245v1ZgyTTAVZ.yhlCXvXWGRU/i','2020-05-03 00:32:07','Secretar'),(5,'alex','$2y$10$UkuWc5gWlEhY/siwXgvzlOeLC8KUX.VlFBeOK58GaDsQStYu8QwD6','2020-05-02 23:04:02','Admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'cp236'
--

--
-- Dumping routines for database 'cp236'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-15  2:00:32
