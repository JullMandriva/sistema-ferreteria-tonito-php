CREATE DATABASE  IF NOT EXISTS `ferreteria_tonito` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ferreteria_tonito`;
-- MySQL dump 10.13  Distrib 8.0.44, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: ferreteria_tonito
-- ------------------------------------------------------
-- Server version	8.0.44

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_cambios`
--

DROP TABLE IF EXISTS `historial_cambios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historial_cambios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) NOT NULL,
  `accion` varchar(255) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `detalles` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_cambios`
--

LOCK TABLES `historial_cambios` WRITE;
/*!40000 ALTER TABLE `historial_cambios` DISABLE KEYS */;
INSERT INTO `historial_cambios` VALUES (1,'Jull Gonzales','EDITAR','Aspiradora / Sopladora 20LT metálica - Uyustools','Stock: 3 -> 6','2025-12-04 14:53:27','2025-12-04 14:53:27'),(2,'Jull Gonzales','EDITAR','Taladro percutor 810W 1/2\" - Makute','Stock: 6 -> 8','2025-12-04 14:53:59','2025-12-04 14:53:59'),(3,'Jull Gonzales','EDITAR','Aspiradora / Sopladora 20LT metálica - Uyustools','Stock: 6 -> 7','2025-12-04 14:55:14','2025-12-04 14:55:14'),(4,'Jull Gonzales','CREAR','Combo Taladro 76N.m + Atornillador de impacto + Sopladora 20V - Total','Stock inicial: 10 | Precio: S/. 439','2025-12-04 15:36:46','2025-12-04 15:36:46'),(5,'Jull Gonzales','EDITAR','Taladro Percutor 166 Nm + 2 Baterías 5 Ah y 1 Cargador 20v - Total','Nombre cambiado','2025-12-04 15:37:07','2025-12-04 15:37:07'),(6,'Jull Gonzales','CREAR','2','Stock inicial: 2 | Precio: S/. 2','2025-12-04 18:20:42','2025-12-04 18:20:42'),(7,'Jull Gonzales','CREAR','4545','Stock inicial: 4545 | Precio: S/. 54545','2025-12-04 18:33:20','2025-12-04 18:33:20'),(8,'Jull Gonzales','CREAR','212','Stock inicial: 22 | Precio: S/. 1212','2025-12-04 19:39:46','2025-12-04 19:39:46'),(9,'Jull Gonzales','ELIMINAR','212','El producto fue eliminado permanentemente.','2025-12-04 19:55:26','2025-12-04 19:55:26'),(10,'Jull Gonzales','ELIMINAR','4545','El producto fue eliminado permanentemente.','2025-12-04 19:55:31','2025-12-04 19:55:31'),(11,'Jull Gonzales','ELIMINAR','2','El producto fue eliminado permanentemente.','2025-12-04 19:55:59','2025-12-04 19:55:59'),(12,'Jull Gonzales','CREAR','hola','Stock inicial: 1 | Precio: S/. 1','2025-12-04 20:05:17','2025-12-04 20:05:17'),(13,'Jull Gonzales','CREAR','hola que tal','Stock inicial: 1 | Precio: S/. 19','2025-12-04 20:05:51','2025-12-04 20:05:51'),(14,'Jull Gonzales','ELIMINAR','hola que tal','El producto fue eliminado permanentemente.','2025-12-04 20:05:56','2025-12-04 20:05:56'),(15,'Jull Gonzales','ELIMINAR','hola','El producto fue eliminado permanentemente.','2025-12-04 20:06:00','2025-12-04 20:06:00'),(16,'Martín Callupe','EDITAR','Combo Taladro 76N.m + Atornillador de impacto + Sopladora 20V - Total','Ubicación: Sin asignar -> A-01-03','2025-12-04 21:03:53','2025-12-04 21:03:53'),(17,'Martín Callupe','EDITAR','Combo Taladro 76N.m + Atornillador de impacto + Sopladora 20V - Total','Ubicación: A-01-03 -> A-01-04','2025-12-04 21:04:08','2025-12-04 21:04:08'),(18,'Mario Apaza','EDITAR','Aspiradora / Sopladora 20LT metálica - Uyustools','Ubicación: Sin asignar -> A-02-01','2025-12-04 21:06:37','2025-12-04 21:06:37');
/*!40000 ALTER TABLE `historial_cambios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_11_28_230154_create_products_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `precio` decimal(8,2) NOT NULL,
  `cantidad` int NOT NULL,
  `codigo_sku` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productos_codigo_sku_unique` (`codigo_sku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `precio` decimal(8,2) NOT NULL,
  `cantidad` int NOT NULL,
  `codigo_sku` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubicacion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productos_codigo_sku_unique` (`codigo_sku`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (9,'Taladro 52N.m 20V - Wadfow','Marca	Wadfow\r\nAjustes de par	22 + 1 + 1\r\nVelocidad nominal	0-500 / 0-2000 RPM \r\nFrecuencia de impacto	30000 BPM\r\nTorque	52 Nm\r\nCapacidad de portabrocas	13mm\r\nRosca del eje	M14\r\nIncluye:\r\nBatería	2 Baterías 20V / 2.0A.h.\r\nCargador	Sí\r\nMaletín	Maletín plástico\r\nAccesorios	3 brocas para mampostería\r\n1 pieza de broca Cr-V',229.00,10,'TAWAD1111',NULL,'2025-12-02 21:48:34','2025-12-02 21:48:34'),(10,'Taladro 650W - Wadfow','Marca	Wadfow\r\nVoltaje	220-240V~50/60Hz\r\nPotencia	650W\r\nVelocidad sin carga	 0-3000 rpm\r\nCapacidad máxima de perforación	13 mm',79.00,9,'TAWAD1112',NULL,'2025-12-02 21:49:43','2025-12-02 21:49:43'),(11,'Taladro 52N.m 20V con batería y cargador - Wadfow','Marca	Wadfow\r\nVoltaje	20 V\r\nVelocidad sin carga	0-500/0-2000 rpm\r\nFrecuencia máxima de impacto	30000 lpm\r\nPar máximo	52 Nm\r\nRosca del eje	M14\r\nIncluye	1 Batería \r\n1 Cargador\r\n3 brocas para mampostería\r\n1 pieza de broca Cr-V',169.00,12,'TAWAD1113',NULL,'2025-12-02 21:50:21','2025-12-02 21:50:21'),(12,'Taladro rotación 1600W 5/8\" - Makute','Marca	Makute\r\nVoltaje	220 - 240V\r\nFrecuencia	50/60 Hz\r\nRevoluciones	1000 r/min\r\nPotencia	1600 w\r\nDiámetro de disco	13/16mm / 5\" - 8\"\r\nCantidad de pack	5pcs',189.00,13,'TAMAK2221',NULL,'2025-12-02 21:51:43','2025-12-02 21:51:43'),(14,'Taladro percutor 1020W 1/2\" - Makute','Marca	Makute\r\nVoltaje	220 - 240V\r\nFrecuencia	50/60 Hz\r\nRevoluciones	0-3200 r/min\r\nPotencia	1020 w\r\nDiámetro de disco	13mm / 1/2\"\r\nCantidad de pack	5pcs',132.00,21,'TAMAK2222',NULL,'2025-12-02 22:27:16','2025-12-02 22:27:16'),(16,'Taladro percutor 810W 1/2\" - Makute','Marca	Makute\r\nVoltaje	220 - 240V\r\nFrecuencia	50/60 Hz\r\nRevoluciones	0-2800 r/min\r\nPotencia	810 w\r\nDiámetro de disco	13mm / 1/2\"\r\nCantidad de pack	5pcs',100.00,11,'TAMAK2223',NULL,'2025-12-03 04:21:55','2025-12-03 04:21:55'),(17,'Taladro percutor 810W 1/2\" - Makute','Marca	Makute\r\nVoltaje	220 - 240V\r\nFrecuencia	50/60 Hz\r\nRevoluciones	0-2800 r/min\r\nPotencia	810 w\r\nDiámetro de disco	13mm / 1/2\"\r\nCantidad de pack	10pcs',95.00,8,'TAMAK2224',NULL,'2025-12-03 04:22:51','2025-12-04 14:53:59'),(18,'Taladro percutor 710w - DongCheng','Marca	Dong Cheng\r\nPotencia	710w\r\nBroquero	1/2” (13mm)\r\nVelocidad	3000 RPM\r\nImpacto	45000 RPM\r\nPeso	2 Kg\r\nCapacidad\r\nde perforado	Acero - 13mm\r\nConcreto - 16mm\r\nMadera - 30mm\r\nUso continuo	6 a 8 horas',159.00,7,'TADON3333',NULL,'2025-12-03 04:23:51','2025-12-03 04:23:51'),(19,'Taladro percutor 780w - Makute','Marca	Makute\r\nModos	Normal / Percutor\r\nBroquero	Metálico de 13mm\r\nPotencia	780w\r\nMotor	Con escobillas / Incluye carbones\r\nVelocidad	0-3000 RPM',99.00,3,'TAMAK2225',NULL,'2025-12-03 04:24:45','2025-12-03 04:24:45'),(20,'Taladro percutor 720w - Uyustools','Marca	Uyustools\r\nModos	Normal / Percutor\r\nBroquero	Broquero de 13mm\r\nPotencia	750w\r\nMotor	Con escobillas / Incluye carbones\r\nVelocidad	2700 RPM',119.00,3,'TAUYU4000',NULL,'2025-12-03 04:25:38','2025-12-03 04:25:38'),(26,'Taladro 52N.m 20V - Wadfow','Marca	Wadfow\r\nAjustes de par	22 + 1 + 1\r\nVelocidad nominal	0-500 / 0-2000 RPM \r\nFrecuencia de impacto	30000 BPM\r\nTorque	52 Nm\r\nCapacidad de portabrocas	13mm\r\nRosca del eje	M14 /\r\nIncluye\r\nBatería	2 Baterías 20V / 2.0A.h.\r\nCargador	Sí\r\nMaletín	Maletín plástico\r\nAccesorios	3 brocas para mampostería\r\n1 pieza de broca Cr-V',229.00,12,'TAWAD1114',NULL,'2025-12-03 05:45:59','2025-12-03 05:47:18'),(27,'Taladro Percutor 166 Nm + 2 Baterías 5 Ah y 1 Cargador 20v - Total','Marca Total\r\nMotor	Sin escobillas de carbón\r\nVoltaje	20V\r\nN° Revoluciones	0-500/0-2100\r\nTasa máxima de impacto	31,500 IPM\r\nPar máximo	166 Nm\r\nTamaño del sobre	13 mm\r\nCorriente de carga	 220–240 V ~ 50/60 Hz\r\n\r\n\r\nIncluye\r\nBatería	2 baterias 5Ah / 20v\r\nCargador	Si\r\nMaletín	   Si',659.00,4,'TATOT7777',NULL,'2025-12-03 06:15:33','2025-12-04 15:37:07'),(28,'Taladro 52N.m 20V con batería y cargador - Wadfow','Marca	Wadfow\r\nVoltaje	20 V\r\nVelocidad sin carga	0-500/0-2000 rpm\r\nFrecuencia máxima de impacto	30000 lpm\r\nPar máximo	52 Nm\r\nRosca del eje	M14\r\nIncluye	1 Batería \r\n1 Cargador\r\n3 brocas para mampostería\r\n1 pieza de broca Cr-V',169.00,8,'TAWAD1115',NULL,'2025-12-03 06:16:47','2025-12-03 06:16:47'),(29,'Aspiradora / Sopladora 30LT metálica - Uyustools','Marca	Uyustools\r\nMotor / Potencia	1200w (1.5HP)\r\nContenedor	Metálica de 30L\r\nCaudal de aire	1.7m / min\r\nPresión laboral	8 Bar\r\nProtección	IP54\r\nMotor	Con bobinas de aluminio\r\nIncluye	1 Filtro EPA\r\n1 Filtro esponja\r\n1 Boquilla esquinera\r\n1 Boquilla escoba\r\n2 Extensiones\r\n1 Manguera flexible\r\n4 Ruedas',269.00,4,'ASUYU3220',NULL,'2025-12-03 06:18:24','2025-12-03 06:34:10'),(30,'Aspiradora / Sopladora 20LT metálica - Uyustools','Marca	Uyustools\r\nMotor / Potencia	1200w (1.5HP)\r\nContenedor	Metálica de 20L\r\nCaudal de aire	1.7m / min\r\nPresión laboral	8 Bar\r\nProtección	IP54\r\nMotor	Con bobinas de aluminio\r\nIncluye	1 Filtro EPA\r\n1 Filtro esponja\r\n1 Boquilla esquinera\r\n1 Boquilla escoba\r\n2 Extensiones\r\n1 Manguera flexible\r\n4 Ruedas',239.00,7,'ASUYU3221','A-02-01','2025-12-03 06:19:38','2025-12-04 21:06:37'),(31,'Combo Taladro 76N.m + Atornillador de impacto + Sopladora 20V - Total','Marca	Total\r\nBatería	20v - 2.0 A.h.\r\nBroquero	Metálico | 13mm (1/2”)\r\nFrecuencia de impacto máx.	30000 BPM\r\nVelocidad Nominal\r\nNivel 1\r\nNivel 2	-\r\n0-500 RPM\r\n0-2000 RPM\r\nMáximo torque	76 N.m\r\nAjuste de torque	20+1+1\r\nVelocidades	2\r\n\r\n\r\nLlave de impacto 285N.m\r\n\r\nMarca	Total\r\nBatería	20v - 2.0 A.h.\r\nBroquero hexagonal	1/4\" (6.35mm)\r\nFrecuencia de impacto máx.	29000 BPM\r\nVelocidad Nominal\r\nNivel 1\r\nNivel 2	-\r\n0-1600 RPM\r\n0-1900 RPM\r\n0-2600 RPM\r\nMáximo torque	285 N.m\r\nAjuste de torque	20+1+1\r\n\r\n\r\nSopladora\r\n\r\nVelocidad nominal	1800 RPM\r\nMáximo volumen de aire	2.7 m3/min',439.00,10,'TATOT1234','A-01-04','2025-12-04 15:36:46','2025-12-04 21:04:08');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('595LBg4cFJtrdc4UoOu5LxrcuflAzYlNkToMY886',4,'172.18.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTUU1alFGWFpEU1RFS09yRHBma1lNZWdnZllLNXNkRHdEc1lGZElVWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9',1764884545),('LsHClYnXbmZREsCN9DFQZNn1YemNHbDQwDYR0so0',3,'172.18.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUmhjaGxQaVd1cVdMMW4wMWtQTjhwZXIyeTdLWDFmNlpBTGN6U0RtbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly9kYW55ZWxsZS11bnBhY2lmaWVkLWthcmlzLm5ncm9rLWZyZWUuZGV2L2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czo5OiJkYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=',1764882398),('oHfrrx9YFx6wFuS1TA0Z4VKmd0n6IjiwYowvGs3O',NULL,'172.18.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVG9vS0Vxd3lRQTdwWnFBakV2WXNZVWFyeXB2dHUzNllpYWNYY2cyUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9kYW55ZWxsZS11bnBhY2lmaWVkLWthcmlzLm5ncm9rLWZyZWUuZGV2IjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1764854351),('RAv5X1y2K7XfPd7Y9Namkmq8gmgydsBxZOjL9nkD',2,'172.18.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRkFEWGZrcWswUVh0dGpIamRRMU4wMVdYd3d3d3BGeHhwN0lBRDU4ZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9',1764862683);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Jesús Rodríguez','jrodriguez','rodriguezjesas6@autonoma.edu.pe',NULL,'$2y$12$xJjKdo1zluqfkPWkIKUqfe3kBiu7flAC2ILKSFYqziW8GqXaLkMOy',NULL,'2025-12-02 20:36:48','2025-12-02 20:36:48'),(2,'Jull Gonzales','jgonzales','gonzalesjulde2@autonoma.edu.pe',NULL,'$2y$12$kVLh5mbe8gt34HLYUTO6CeYvj6BBH/qcKic.oV2SFnlrktYZhlcDG',NULL,'2025-12-02 20:36:48','2025-12-02 20:36:48'),(3,'Mario Apaza','mapaza','mapazad@autonoma.edu.pe',NULL,'$2y$12$aP67yX.kNSvM80nvHNLvHe3qXmiL5tX1Nw9b93qYPrTXmYLTqj9oi',NULL,'2025-12-02 20:36:49','2025-12-02 20:36:49'),(4,'Martín Callupe','mcallupe','martinserna021@gmail.com',NULL,'$2y$12$gbO.LY.gw8z1XIUTnos2nuzok9dj5mBU5ICusoeqdZKvQhWXaVqji',NULL,'2025-12-02 20:36:50','2025-12-02 20:36:50');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-04 16:52:18
