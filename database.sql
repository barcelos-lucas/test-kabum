-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: test_kabum
-- ------------------------------------------------------
-- Server version	8.0.41

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `rg` (`rg`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Lucas Barcelos','1998-09-04','05317820189','62.727.282-4','19999791812'),(4,'usuario_teste7','1990-05-15','00123456789','MG-12.345.678','(31) 98765-4321'),(14,'Alícia Marli Cecília Costa','1995-02-20','75684215890','115640770','17998897979'),(15,'Vicente Heitor Nunes','1996-02-05','51045095834','447589453','11998309849'),(16,'Marina Melissa Drumond','1996-01-13','27864224857','373893899','11983172527'),(17,'Severino Cardoso Carlos','2000-01-12','64779913810','122643367','11983172527'),(18,'Emanuel Bernardo da Silva','2000-02-21','38879152831','355328641','11984840216'),(19,'Sérgio Kauê Corte Real','1996-01-01','55379941869','419382021','19994730888');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enderecos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` char(2) NOT NULL,
  `cep` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  CONSTRAINT `enderecos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enderecos`
--

LOCK TABLES `enderecos` WRITE;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
INSERT INTO `enderecos` VALUES (1,1,'Rua 20 mp','437','','Mãe preta','Rio claro','SP','13506-190'),(2,4,'Rua das Flores','100','Apto 10','Centro','Belo Horizonte','MG','30130-000'),(7,14,'Rua Kazuo Igarashi','138','','Residencial Quinta do Golfe','São José do Rio Preto','SP','15093320'),(8,15,'Rua Himalaia','350','','Vila Divina Pastora','São Paulo','SP','03265080'),(9,16,'Rua Espírito Santo','280','','Vila Boa Vista','Barueri','SP','06411110'),(10,17,'Rua 22 MP','338','','Parque Mãe Preta','Rio Claro','SP','13506192'),(13,17,'Rua 50','10','','MP','Rio claro','PI','13506-190'),(14,17,'Rua 50','10','','MP','Rio claro','PI','13506-190'),(15,17,'Rua 50','10','','MP','Rio claro','PI','13506-190'),(17,17,'Rua 20 MP','3333','','Mãe preta','Rio Claro','AC','13506-190'),(18,17,'Rua 20 MP','3333','','Mãe preta','Rio Claro','AC','13506-190'),(19,17,'Rua 20 MP','3333','','Mãe preta','Rio Claro','AC','13506-190'),(20,17,'Rua 20 MP','3333','','Mãe preta','Rio Claro','AC','13506-190'),(21,17,'Rua 20 MP','3333','','Mãe preta','Rio Claro','AC','13506-190'),(22,17,'Rua 20 MP','3333','','Mãe preta','Rio Claro','AC','13506-190'),(23,17,'Rua 20 MP','3333','','Mãe preta','Rio Claro','AC','13506-190'),(24,17,'Rua 20 MP','437','','Mãe preta','Rio Claro','AC','13506-190'),(25,17,'Rua 20 MP','437','','Mãe preta','Rio Claro','AC','13506-190'),(28,18,'Rua Martim Silveira','','','Jordanópolis','São Bernardo do Campo','SP','09894040'),(29,19,'Rua Ferdinando Mollon','331','','Jardim Geriva','Santa Bárbara D\'Oeste','SP','13456368'),(30,19,'Rua P 8','777','','Vila Paulista','Rio Claro','SP','13506872');
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cargo` enum('admin','usuario') DEFAULT 'usuario',
  `status` enum('ativo','inativo') DEFAULT 'ativo',
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_usuario` (`nome_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'usuario_teste','teste@exemplo.com','$2y$10$fJXfG8N4L/SeHLeN60qkwu7sh2JXC.KkM9dcSQd0.y1eEIgIWslVi','usuario','ativo','2025-02-25 22:30:22','2025-02-25 22:30:22'),(4,'usuario_teste1','teste1@exemplo.com','$2y$10$XXLTV0X3AWNOVsXf5kgqR.4rt4.gPf6VSEVV7fKHu5HptwB77Cfzy','admin','inativo','2025-02-25 22:48:09','2025-02-25 22:48:09'),(7,'usuario_teste2','teste2@exemplo.com','$2y$10$1.Bl6niZL7AZla3z6zDQ1.ZF6xc4Nht14P/92snC8B0ePFjecpqii','admin','inativo','2025-02-25 23:37:28','2025-02-25 23:37:28'),(12,'usuario_teste4','teste@exemplo.com4','$2y$10$7qgf.XinpNSvoH9ralNBGezJFdU.gHcZR8UApdX7/LVPZ9Kpsbnp.','usuario','ativo','2025-02-25 23:53:19','2025-02-25 23:53:19'),(15,'usuario_teste5','teste5@exemplo.com','$2y$10$hv//sjzyJVQVUvfXXQvYEOuA4GXrETnRW9htWyukta16zYrbxoll6','admin','ativo','2025-02-26 00:02:49','2025-02-27 12:21:30');
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

-- Dump completed on 2025-02-27 11:33:13
