-- MySQL dump 10.14  Distrib 5.5.50-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: dbideias
-- ------------------------------------------------------
-- Server version	5.5.50-MariaDB

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
-- Current Database: `dbideias`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `dbideias` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `dbideias`;

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  `descricao` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area`
--

LOCK TABLES `area` WRITE;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
INSERT INTO `area` VALUES (1,'Suporte','Área responsável pelo suporte técnico'),(2,'Administração','Área responsável pela administração'),(3,'Financeiro','Área respons ável pelas finanças'),(4,'Comercial','Área responsável pelas compras e vendas'),(5,'Desenvolvimento','Área responsável pelo desenvolvimento de softwares');
/*!40000 ALTER TABLE `area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ideia`
--

DROP TABLE IF EXISTS `ideia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ideia` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `area` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_ideia_1_idx` (`area`),
  KEY `fk_usuario_idx` (`usuario`),
  CONSTRAINT `fk_area` FOREIGN KEY (`area`) REFERENCES `area` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ideia`
--

LOCK TABLES `ideia` WRITE;
/*!40000 ALTER TABLE `ideia` DISABLE KEYS */;
INSERT INTO `ideia` VALUES (2,'nova ideia','hueheuheuheu',3,31,'Nova','2016-10-23 20:31:09'),(3,'huehueheu','sdcndlk\r\n',1,31,'Nova','2016-10-23 20:43:16'),(5,'dssksd','kjncsdkn ',4,32,'Aceita','2016-10-23 23:45:14');
/*!40000 ALTER TABLE `ideia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `premio`
--

DROP TABLE IF EXISTS `premio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `premio` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) DEFAULT NULL,
  `pontos` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `premio`
--

LOCK TABLES `premio` WRITE;
/*!40000 ALTER TABLE `premio` DISABLE KEYS */;
INSERT INTO `premio` VALUES (2,'Tv 42 polegadas',10000),(3,'Microondas',400),(4,'SmartPhone',1000),(5,'Notebook',5000),(6,'Bicicleta',200),(7,'Monitor 21\"',1000),(8,' Mochila',60),(9,'Skate',50),(10,'Agenda',10),(12,'Batedeira',140);
/*!40000 ALTER TABLE `premio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(62) DEFAULT NULL,
  `isadmin` tinyint(1) DEFAULT NULL,
  `area` int(10) DEFAULT NULL,
  `pontos` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fk_usuario_2_idx` (`area`),
  CONSTRAINT `fk_usuario_2` FOREIGN KEY (`area`) REFERENCES `area` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (31,'admin','Admin','$2y$10$O4xZuXN1DdUA2hDvAKqrQ.3agYutqG/CjxB.nlM7/NYB4mRWMrUYO',1,5,'0'),(32,'operador','operador','$2y$10$dIvpL8jCj0MVY3pagIHzC.nvW49CQs1cLXsKdYPbTisznPgnRvt9C',0,1,'1'),(39,'guilherme','Guilherme','$2y$10$Hv4kJggIkNy3Ch/vFpvmT.6R9V0ZPgGJl2rpgwUHhpHQeJyxEHvZ6',1,5,'1000');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-24  9:33:17
