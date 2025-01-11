-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: meusite
-- ------------------------------------------------------
-- Server version	8.0.40

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
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Diversos');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `convidados`
--

DROP TABLE IF EXISTS `convidados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `convidados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` text COLLATE utf8mb4_general_ci,
  `telefone` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_pessoas` int DEFAULT NULL,
  `confirmado` varchar(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `convidados`
--

LOCK TABLES `convidados` WRITE;
/*!40000 ALTER TABLE `convidados` DISABLE KEYS */;
/*!40000 ALTER TABLE `convidados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotos`
--

DROP TABLE IF EXISTS `fotos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fotos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotos`
--

LOCK TABLES `fotos` WRITE;
/*!40000 ALTER TABLE `fotos` DISABLE KEYS */;
INSERT INTO `fotos` VALUES (1,'foto1.jpg'),(2,'foto2.jpg'),(3,'foto3.jpg');
/*!40000 ALTER TABLE `fotos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lista_presentes`
--

DROP TABLE IF EXISTS `lista_presentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lista_presentes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` text COLLATE utf8mb4_general_ci DEFAULT NULL,
  `valor` decimal(28,0) DEFAULT NULL,
  `link` text COLLATE utf8mb4_general_ci,
  `confirmacao` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagem` text COLLATE utf8mb4_general_ci,
  `codCategoria` int DEFAULT NULL,
  `nome_pessoa` text COLLATE utf8mb4_general_ci,
  `telefone` text COLLATE utf8mb4_general_ci,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lista_presentes`
--

LOCK TABLES `lista_presentes` WRITE;
/*!40000 ALTER TABLE `lista_presentes` DISABLE KEYS */;
INSERT INTO `lista_presentes` VALUES (1,'Smart TV 55\" QLED 4K TCL 55C655',2469,'https://www.casasbahia.com.br/smart-tv-55-qled-4k-tcl-55c655-com-processador-aipq-google-tv-hdr10-wi-fi-dual-band-bluetooth-integrado-google-assistente-dolby-vision-e-atmos-55066344/p/55066344?utm_medium=cpc&utm_source=GP_PLA&IdSku=55066344&idLojista=10037&tipoLojista=1P&gclsrc=aw.ds&&utm_campaign=gg_pmax_core_elte&gad_source=1&gclid=Cj0KCQiAu8W6BhC-ARIsACEQoDCjnPUhmyNNYfkHeQTATSyJLtibuJrF_2AyTUvTEi1m8nfYqGdT_zQaAsruEALw_wcB',NULL,'presente1.jpg',1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `lista_presentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensagens`
--

DROP TABLE IF EXISTS `mensagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mensagens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` text COLLATE utf8mb4_general_ci,
  `data` date DEFAULT NULL,
  `mensagem` text COLLATE utf8mb4_general_ci,
  `confirmacao` varchar(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefone` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensagens`
--

LOCK TABLES `mensagens` WRITE;
/*!40000 ALTER TABLE `mensagens` DISABLE KEYS */;
/*!40000 ALTER TABLE `mensagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meusite`
--

DROP TABLE IF EXISTS `meusite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meusite` (
  `id` int NOT NULL,
  `titulo` text COLLATE utf8mb4_general_ci,
  `video` text COLLATE utf8mb4_general_ci,
  `cabecalho_imagem` text COLLATE utf8mb4_general_ci,
  `titulo_banner` text COLLATE utf8mb4_general_ci,
  `data_casamento` date DEFAULT NULL,
  `section01_titulo` text COLLATE utf8mb4_general_ci,
  `section01_subtitulo` text COLLATE utf8mb4_general_ci,
  `section01_texto` text COLLATE utf8mb4_general_ci,
  `local_titulo` text COLLATE utf8mb4_general_ci,
  `local_subtitulo` text COLLATE utf8mb4_general_ci,
  `local_imagem` text COLLATE utf8mb4_general_ci,
  `local_local01_titulo` text COLLATE utf8mb4_general_ci,
  `local_local01_horario` text COLLATE utf8mb4_general_ci,
  `local_local01_texto` text COLLATE utf8mb4_general_ci,
  `local_local01_imagem` text COLLATE utf8mb4_general_ci,
  `local_local01_mapa` text COLLATE utf8mb4_general_ci,
  `noiva_nome` text COLLATE utf8mb4_general_ci,
  `noiva_desc` text COLLATE utf8mb4_general_ci,
  `noiva_img` text COLLATE utf8mb4_general_ci,
  `noivo_nome` text COLLATE utf8mb4_general_ci,
  `noivo_desc` text COLLATE utf8mb4_general_ci,
  `noivo_img` text COLLATE utf8mb4_general_ci,
  `mensagens_titulo` text COLLATE utf8mb4_general_ci,
  `mensagens_subtitulo` text COLLATE utf8mb4_general_ci,
  `mensagens_imagem` text COLLATE utf8mb4_general_ci,
  `mensagens_quantidade` int DEFAULT NULL,
  `presenca_titulo` text COLLATE utf8mb4_general_ci,
  `presenca_subtitulo` text COLLATE utf8mb4_general_ci,
  `presenca_aviso` text COLLATE utf8mb4_general_ci,
  `fotos_titulo` text COLLATE utf8mb4_general_ci,
  `fotos_subtitulo` text COLLATE utf8mb4_general_ci,
  `presentes_titulo` text COLLATE utf8mb4_general_ci,
  `presentes_subtitulo` text COLLATE utf8mb4_general_ci,
  `pix` text COLLATE utf8mb4_general_ci,
  `pix_img` text COLLATE utf8mb4_general_ci,
  `video_presente` text COLLATE utf8mb4_general_ci,
  `brand` text COLLATE utf8mb4_general_ci,
  `texto_presente` text COLLATE utf8mb4_general_ci,
  `local_local02_titulo` text COLLATE utf8mb4_general_ci,
  `local_local02_horario` text COLLATE utf8mb4_general_ci,
  `local_local02_texto` text COLLATE utf8mb4_general_ci,
  `local_local02_imagem` text COLLATE utf8mb4_general_ci,
  `local_local02_mapa` text COLLATE utf8mb4_general_ci,
  `locais` int DEFAULT NULL,
  `tem_lista` int DEFAULT NULL,
  `data_local02` date DEFAULT NULL,
  `data_local01` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meusite`
--

LOCK TABLES `meusite` WRITE;
/*!40000 ALTER TABLE `meusite` DISABLE KEYS */;
INSERT INTO `meusite` VALUES (1,'Jorge & Amanda',NULL,'cabecalho.jpg','Jorge & Amanda','2030-12-31','Vai ter casório sim!','E você é nosso convidado!','Abaixo segue opções para mensagens que desejar nos enviar, local, data, hora, lista de presentes e uma seção de fotos nossas. Esperamos que gostem de tudo o que estamos preparando para receber você!','Você vai no nosso casamento?','Segue abaixo os dados de local e hora para se planejar!','local.jpg','Cerimônia','19h','Quinta das Bromélias','local.jpg','Av. Dona Maria Franco Salgado, 838 - Jardim Atibaia (Sousas), Campinas - SP, 13106-290','Amanda','\"Eu sempre amei o Jorge, e sempre vou amar. Será um prazer celebrar com você o nosso casamento\"','noiva.jpg','Jorge','\"Eu sempre amei a Amanda, e sempre vou amar. Será um prazer celebrar com você o nosso casamento\"','noivo.jpg','Ei, que tal deixar uma mensagem pra gente?','Manda pra gente, e ela vai aparecer aqui depois, combinado?','mensagem.jpg',5,'Confirma a presença?','Para nos preparar para receber você, precisamos que nos confirme se poderá celebrar nosso casamento conosco!','Muito obrigado por confirmar. Nos vemos no casamento :-)','Seção de fotos','Que tal algumas fotos?','Caso deseje nos presentear, preparamos uma lista de presentes!','Sinta-se a vontade para escolher aquilo que for víavel para você. Caso não puder nos presentear, não tem problema. Nós entendemos. O que queremos é a sua presença, combinado?','Consultar noivos!',NULL,NULL,'Jorge & Amanda','Obrigado!','Festa','21h','Quinta das Bromélias','festa.jpg','Av. Dona Maria Franco Salgado, 838 - Jardim Atibaia (Sousas), Campinas - SP, 13106-290',2,1,'2030-12-31','2030-12-31');
/*!40000 ALTER TABLE `meusite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transferencia_valores`
--

DROP TABLE IF EXISTS `transferencia_valores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transferencia_valores` (
  `nome` text COLLATE utf8mb4_general_ci NOT NULL,
  `valor` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefone` varchar(14) COLLATE utf8mb4_general_ci NOT NULL,
  `confirmacao` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transferencia_valores`
--

LOCK TABLES `transferencia_valores` WRITE;
/*!40000 ALTER TABLE `transferencia_valores` DISABLE KEYS */;
/*!40000 ALTER TABLE `transferencia_valores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` char(32) COLLATE utf8mb4_general_ci NOT NULL,
  `permissao` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','admin@admin','21232f297a57a5a743894a0e4a801fc3','admin');
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

-- Dump completed on 2024-12-06 13:11:15
