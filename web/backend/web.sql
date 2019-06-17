-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bdproject
-- ------------------------------------------------------
-- Server version	5.6.38

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `favoritos`
--

DROP TABLE IF EXISTS `favoritos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favoritos` (
  `idproject` varchar(45) NOT NULL,
  `IDuser` varchar(45) NOT NULL,
  PRIMARY KEY (`idproject`,`IDuser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favoritos`
--

LOCK TABLES `favoritos` WRITE;
/*!40000 ALTER TABLE `favoritos` DISABLE KEYS */;
INSERT INTO `favoritos` VALUES ('187','User02'),('193','User02');
/*!40000 ALTER TABLE `favoritos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `idproject` int(11) NOT NULL AUTO_INCREMENT,
  `ProName` varchar(45) DEFAULT NULL,
  `ProType` varchar(45) DEFAULT NULL,
  `ProDesc` varchar(200) DEFAULT NULL,
  `Mail` varchar(45) DEFAULT NULL,
  `ProDateIni` varchar(45) DEFAULT NULL,
  `ProPrice` int(45) DEFAULT NULL,
  `ProDonate` int(45) DEFAULT '0',
  `Curr` varchar(45) DEFAULT NULL,
  `ProImg` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idproject`)
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (187,'Andiamo','tecno','Web de viajes por todo el mundo.','ruben@gmail.com','2019/01/25',80000,4200,'€','http://localhost/framework/FW_PHP_OO_MVC_AJS/web/frontend/assets/images/pic01.jpg'),(193,'CARDOR','tecno','Web de coches de todo tipo.','juanan@gmail.com','2019/01/25',10000,8000,'€','http://localhost/framework/FW_PHP_OO_MVC_AJS/web/frontend/assets/images/pic01.jpg');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop`
--

DROP TABLE IF EXISTS `shop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop` (
  `idshop` int(11) NOT NULL AUTO_INCREMENT,
  `idproject` int(45) DEFAULT NULL,
  `proName` varchar(45) DEFAULT NULL,
  `user` varchar(45) DEFAULT NULL,
  `oldD` varchar(45) DEFAULT NULL,
  `newD` varchar(45) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idshop`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop`
--

LOCK TABLES `shop` WRITE;
/*!40000 ALTER TABLE `shop` DISABLE KEYS */;
INSERT INTO `shop` VALUES (15,187,'Andiamo','Admin01','80000','0','2019-03-09 18:58:25','500'),(16,197,'DDArt01','Admin01','90000','30000','2019-03-09 18:58:25','30500'),(17,187,'Andiamo','Admin01','80000','0','2019-03-09 18:59:56','500'),(18,197,'DDArt01','Admin01','90000','30000','2019-03-09 18:59:56','30500'),(19,187,'Andiamo','Admin01','0','500','2019-03-09 19:02:34','500'),(20,197,'DDArt01','Admin01','30000','500','2019-03-09 19:02:34','30500'),(21,187,'Andiamo','Admin01','0','500','2019-03-09 19:05:35','500'),(22,197,'DDArt01','Admin01','30000','500','2019-03-09 19:05:36','30500'),(23,197,'DDArt01','Admin01','30000','100','2019-03-09 19:10:00','30100'),(24,197,'DDArt01','User01','30000','500','2019-03-09 19:27:35','30500'),(25,197,'DDArt01','User01','30000','500','2019-03-09 19:29:25','30500'),(26,187,'Andiamo','User01','0','500','2019-03-09 19:31:47','500'),(27,187,'Andiamo','User01','500','100','2019-03-09 19:32:24','600'),(28,199,'DDTec01','Admin01','11000','100','2019-03-10 15:25:57','11100'),(29,191,'TWD','Admin01','0','500','2019-03-10 15:27:08','500'),(30,197,'DDArt01','Admin01','30500','100','2019-03-11 19:28:02','30600'),(31,187,'Andiamo','Admin01','600','500','2019-03-11 19:28:31','1100'),(32,199,'DDTec01','Admin01','11100','500','2019-03-11 20:13:06','11600'),(33,197,'DDArt01','Admin01','30600','100','2019-03-11 20:13:06','30700'),(34,197,'DDArt01','Admin01','30700','50000','2019-03-11 20:17:24','80700'),(35,187,'Andiamo','Admin01','1100','3000','2019-03-11 20:20:42','4100'),(36,197,'DDArt01','Admin01','80700','5','2019-03-11 20:41:37','80705'),(37,197,'DDArt01','Admin01','80705','555','2019-03-11 20:43:49','81260'),(38,197,'DDArt01','Admin01','81260','500','2019-03-11 20:47:56','81760'),(39,187,'Andiamo','Admin01','4100','100','2019-03-11 20:53:03','4200'),(40,197,'DDArt01','User01','81760','100','2019-03-26 18:41:12','81860'),(41,197,'DDArt01','Adrian','81860','500','2019-03-26 18:42:24','82360');
/*!40000 ALTER TABLE `shop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_project`
--

DROP TABLE IF EXISTS `user_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_project` (
  `idproject` varchar(45) NOT NULL,
  `IDuser` varchar(45) NOT NULL,
  PRIMARY KEY (`idproject`,`IDuser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_project`
--

LOCK TABLES `user_project` WRITE;
/*!40000 ALTER TABLE `user_project` DISABLE KEYS */;
INSERT INTO `user_project` VALUES ('187','User02'),('193','User02');
/*!40000 ALTER TABLE `user_project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `IDuser` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` longtext,
  `type` tinyint(1) NOT NULL,
  `avatar` longtext NOT NULL,
  `activate` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(100) NOT NULL,
  `token_log` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`IDuser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('AdrianGF','AdrianGF','gramaferre@gmail.com','$2y$12$AQkiCmVhXkyysCiXW3ACaOFfAJal26JcAfmqsUtYFTUURGrUW/xEy',0,'http://localhost/framework/FW_PHP_OO_MVC_AJS/web/backend/media/flowers.png',1,'d0a9ceb9f1bfbb88adef','eyJ0eXAiOiJKV1QiLCAiYWxnIjoiSFMyNTYifQ.MzYwMCIsDQoJCSJuYW1lIjpBZHJpYW5HRg0KCQl9.QIKExacZUlMXfUearQPG9zZsgBioeWrY_nNr3Ujpqv0'),('User02','User02','adriangf69@gmail.com','$2y$12$zmOnhNNqC1R2QR6Kcqt.XuFCnw59rMhkmHoXJjwGxhzJt2zH25P4.',1,'http://localhost/framework/FW_PHP_OO_MVC_AJS/web/backend/media/flowers.png',1,'2f53e483cbc227288aaf','eyJ0eXAiOiJKV1QiLCAiYWxnIjoiSFMyNTYifQ.MzYwMCIsDQoJCSJuYW1lIjpVc2VyMDINCgkJfQ.4Ce7mrS-xzzk_xl1KUJcgvdQ24-l-265dglf0jgXaAU');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_info`
--

DROP TABLE IF EXISTS `users_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_info` (
  `IDuser` varchar(100) NOT NULL,
  `Name` varchar(80) DEFAULT 'Empty',
  `Surname1` varchar(80) DEFAULT 'Empty',
  `Surname2` varchar(80) DEFAULT 'Empty',
  `Birthday` varchar(20) DEFAULT 'Empty',
  `Country` varchar(45) DEFAULT 'Empty',
  `Province` varchar(45) DEFAULT 'Empty',
  `City` varchar(45) DEFAULT 'Empty',
  PRIMARY KEY (`IDuser`),
  CONSTRAINT `IDuser` FOREIGN KEY (`IDuser`) REFERENCES `users` (`IDuser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_info`
--

LOCK TABLES `users_info` WRITE;
/*!40000 ALTER TABLE `users_info` DISABLE KEYS */;
INSERT INTO `users_info` VALUES ('AdrianGF','Adrian','Gramage','Ferrero','06/30/1998','Spain','Valencia','Ontinyent'),('User02','Adrian','Gramage','Ferrero','06/04/2019','Bahamas','','');
/*!40000 ALTER TABLE `users_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-17 18:51:55
