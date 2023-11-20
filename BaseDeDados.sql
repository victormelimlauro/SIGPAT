-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: aula01tiagoas
-- ------------------------------------------------------
-- Server version	8.0.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `inventarios`
--

DROP TABLE IF EXISTS `inventarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventarios` (
  `cod_inventario` int NOT NULL AUTO_INCREMENT,
  `nome_inventario` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`cod_inventario`),
  UNIQUE KEY `nome_inventario_UNIQUE` (`nome_inventario`),
  UNIQUE KEY `cod_inventario_UNIQUE` (`cod_inventario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventarios`
--

LOCK TABLES `inventarios` WRITE;
/*!40000 ALTER TABLE `inventarios` DISABLE KEYS */;
INSERT INTO `inventarios` VALUES (2,'TESTE juam'),(1,'TESTE VITAO');
/*!40000 ALTER TABLE `inventarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens`
--

DROP TABLE IF EXISTS `itens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `itens` (
  `cod_item` int NOT NULL AUTO_INCREMENT,
  `numpat_item` int NOT NULL,
  `cod_local` int NOT NULL,
  `nome_item` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `preco_item` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`cod_item`),
  UNIQUE KEY `numpat_item_UNIQUE` (`numpat_item`),
  KEY `fk_itens_locais_idx` (`cod_local`),
  CONSTRAINT `fk_itens_locais` FOREIGN KEY (`cod_local`) REFERENCES `locais` (`cod_local`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens`
--

LOCK TABLES `itens` WRITE;
/*!40000 ALTER TABLE `itens` DISABLE KEYS */;
INSERT INTO `itens` VALUES (1,55,37,'Cadeira Gamer v2',400.00),(3,848,1,'Computador',5000.00),(4,408,37,'Notebook Dell',1500.00),(5,660,1,'Balança',100.00),(6,501,10,'Cadeira Presidente',500.00),(8,101,40,'Notebook',5000.00),(11,555,1,'Computador Aple',5000.00),(12,554,1,'Cadeira do vovo',19.00),(13,102,1,'Mesa cozinha',100.00);
/*!40000 ALTER TABLE `itens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locais`
--

DROP TABLE IF EXISTS `locais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locais` (
  `cod_local` int NOT NULL AUTO_INCREMENT,
  `nome_local` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`cod_local`),
  UNIQUE KEY `idx_locais_cod_local` (`cod_local`),
  UNIQUE KEY `nome_local_UNIQUE` (`nome_local`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locais`
--

LOCK TABLES `locais` WRITE;
/*!40000 ALTER TABLE `locais` DISABLE KEYS */;
INSERT INTO `locais` VALUES (14,' Compras  Deise'),(17,' Compras José'),(18,' Compras Victor '),(16,' Contabilidade  APAE'),(26,' Escola'),(30,' Escola Senac'),(37,' Estimulação Precoce '),(41,' Telemarketing'),(42,' Teste vitaoooo'),(1,'Comercial Vendas '),(6,'Faturamento'),(4,'Financeiro     '),(32,'Lab de informática  '),(10,'Marketing Metrocamp'),(36,'Recepçao'),(27,'Recepção  Metrocamp '),(40,'Sala da Aline '),(25,'Serviço social');
/*!40000 ALTER TABLE `locais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operacoes_inventarios`
--

DROP TABLE IF EXISTS `operacoes_inventarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `operacoes_inventarios` (
  `cod_operacoes_inventarios` int NOT NULL AUTO_INCREMENT,
  `cod_local` int NOT NULL,
  `cod_inventario` int NOT NULL,
  `numpat_item` int NOT NULL,
  `cod_usuario` int NOT NULL,
  PRIMARY KEY (`cod_operacoes_inventarios`),
  KEY `fk_usuarios_operacoes_inventarios_idx` (`cod_usuario`),
  KEY `fk_inventarios_operacoes_inventarios_idx` (`cod_inventario`),
  KEY `fk_itens_operacoes_inventarios_idx` (`numpat_item`),
  KEY `fk_locais_operacoes_inventarios_idx` (`cod_local`),
  CONSTRAINT `fk_inventarios_op_inventarios` FOREIGN KEY (`cod_inventario`) REFERENCES `inventarios` (`cod_inventario`) ON DELETE RESTRICT,
  CONSTRAINT `fk_itens_op_inventarios` FOREIGN KEY (`numpat_item`) REFERENCES `itens` (`numpat_item`) ON DELETE RESTRICT,
  CONSTRAINT `fk_locais_op_inventarios` FOREIGN KEY (`cod_local`) REFERENCES `locais` (`cod_local`) ON DELETE RESTRICT,
  CONSTRAINT `fk_usuarios_op_inventarios` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operacoes_inventarios`
--

LOCK TABLES `operacoes_inventarios` WRITE;
/*!40000 ALTER TABLE `operacoes_inventarios` DISABLE KEYS */;
INSERT INTO `operacoes_inventarios` VALUES (88,1,1,55,1);
/*!40000 ALTER TABLE `operacoes_inventarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `cod_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `senha` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`cod_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Victor Melim Lauro','victor','40bd001563085fc35165329ea1ff5c5ecbdbbeef');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-09-18  3:47:39
