-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: db_kdi
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('supplierportal-cache-356a192b7913b04c54574d18c28d46e6395428ab','i:1;',1792652052),('supplierportal-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer','i:1792652052;',1792652052);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
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
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
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
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
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
-- Table structure for table `m_menu`
--

DROP TABLE IF EXISTS `m_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_menu` (
  `idmnu` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nmmnu` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urlmnu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icnmnu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grpmnu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prnmnu` bigint unsigned DEFAULT NULL,
  `ordmnu` int NOT NULL DEFAULT '0',
  `crtby` bigint unsigned DEFAULT NULL,
  `crtdt` timestamp NULL DEFAULT NULL,
  `updby` bigint unsigned DEFAULT NULL,
  `upddt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idmnu`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_menu`
--

LOCK TABLES `m_menu` WRITE;
/*!40000 ALTER TABLE `m_menu` DISABLE KEYS */;
INSERT INTO `m_menu` VALUES (1,'Dashboard Utama','/das_dashboard_utama',NULL,'DAS',NULL,901,NULL,'2026-10-21 09:08:10',NULL,NULL),(2,'Menu','/set_menu',NULL,'SET',NULL,401,NULL,'2026-10-21 09:08:10',NULL,NULL),(3,'Role','/set_role',NULL,'SET',NULL,402,NULL,'2026-10-21 09:08:10',NULL,NULL),(4,'User','/set_user',NULL,'SET',NULL,403,NULL,'2026-10-21 09:08:10',NULL,NULL),(5,'Unit Of Measurements','/mst_uom',NULL,'MST',NULL,101,NULL,'2026-10-21 11:00:36',NULL,'2026-10-21 11:00:36'),(6,'Products','/mst_product',NULL,'MST',NULL,102,NULL,'2026-10-21 11:02:00',NULL,'2026-10-21 11:02:00'),(7,'Supplier','/mst_vendor',NULL,'MST',NULL,103,NULL,'2026-10-21 11:02:14',NULL,'2026-10-21 11:02:14'),(8,'Portal Supplier','/portal_supplier',NULL,'TRN',NULL,201,NULL,'2026-10-21 11:03:17',NULL,'2026-10-21 11:03:17'),(9,'Penawaran Supplier','/trn_offer',NULL,'TRN',NULL,202,NULL,'2026-10-21 11:03:34',NULL,'2026-10-21 11:03:34');
/*!40000 ALTER TABLE `m_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_param`
--

DROP TABLE IF EXISTS `m_param`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_param` (
  `idprm` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pidprm` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valprm` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valprm1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valprm2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valprm3` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dscprm` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seqprm` int NOT NULL DEFAULT '0',
  `crtby` bigint unsigned DEFAULT NULL,
  `crtdt` timestamp NULL DEFAULT NULL,
  `updby` bigint unsigned DEFAULT NULL,
  `upddt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idprm`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_param`
--

LOCK TABLES `m_param` WRITE;
/*!40000 ALTER TABLE `m_param` DISABLE KEYS */;
INSERT INTO `m_param` VALUES (1,'GRP_MNU','DAS','Monitor',NULL,NULL,'Dashboard',1,NULL,'2026-10-21 09:08:10',NULL,'2026-10-21 09:08:10'),(2,'GRP_MNU','MST','Layers',NULL,NULL,'Master Data',2,NULL,'2026-10-21 09:08:10',NULL,'2026-10-21 09:08:10'),(3,'GRP_MNU','TRN','ArrowRightLeft',NULL,NULL,'Transaction',3,NULL,'2026-10-21 09:08:10',NULL,'2026-10-21 09:08:10'),(4,'GRP_MNU','REP','Files',NULL,NULL,'Report',4,NULL,'2026-10-21 09:08:10',NULL,'2026-10-21 09:08:10'),(5,'GRP_MNU','SET','Settings',NULL,NULL,'Settings',5,NULL,'2026-10-21 09:08:10',NULL,'2026-10-21 09:08:10'),(6,'STS_TRN','1','New',NULL,NULL,'~',1,NULL,NULL,NULL,NULL),(7,'STS_TRN','2','On Review',NULL,NULL,'~',2,NULL,NULL,NULL,NULL),(8,'STS_TRN','3','Approve',NULL,NULL,'~',3,NULL,NULL,NULL,NULL),(9,'STS_TRN','99','Reject',NULL,NULL,'~',2,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `m_param` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_product`
--

DROP TABLE IF EXISTS `m_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_product` (
  `idprod` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nmprod` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `typprod` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'I',
  `iduom` bigint unsigned NOT NULL,
  `crtby` bigint unsigned DEFAULT NULL,
  `crtdt` timestamp NULL DEFAULT NULL,
  `updby` bigint unsigned DEFAULT NULL,
  `upddt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idprod`),
  KEY `m_product_iduom_foreign` (`iduom`),
  CONSTRAINT `m_product_iduom_foreign` FOREIGN KEY (`iduom`) REFERENCES `m_uom` (`iduom`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_product`
--

LOCK TABLES `m_product` WRITE;
/*!40000 ALTER TABLE `m_product` DISABLE KEYS */;
INSERT INTO `m_product` VALUES (1,'Sarung Tangan','I',3,NULL,'2026-10-21 11:56:52',NULL,'2026-10-21 12:00:30'),(2,'Kuarsa','I',1,NULL,'2026-10-21 17:09:21',NULL,'2026-10-21 17:09:21'),(3,'Kardus Packaging','I',2,NULL,'2026-10-21 18:22:54',NULL,'2026-10-21 22:04:32'),(4,'Palet','I',2,NULL,'2026-10-21 22:04:53',NULL,'2026-10-21 22:04:53'),(5,'Silika 01','I',4,NULL,'2026-10-21 22:27:49',NULL,'2026-10-21 22:27:49');
/*!40000 ALTER TABLE `m_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_rmenu`
--

DROP TABLE IF EXISTS `m_rmenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_rmenu` (
  `idrmn` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idrol` bigint unsigned NOT NULL,
  `idmnu` bigint unsigned NOT NULL,
  `viwrmn` tinyint(1) NOT NULL DEFAULT '1',
  `insrmn` tinyint(1) NOT NULL DEFAULT '1',
  `updrmn` tinyint(1) NOT NULL DEFAULT '1',
  `delrmn` tinyint(1) NOT NULL DEFAULT '1',
  `crtby` bigint unsigned DEFAULT NULL,
  `crtdt` timestamp NULL DEFAULT NULL,
  `updby` bigint unsigned DEFAULT NULL,
  `upddt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idrmn`),
  KEY `m_rmenu_idrol_foreign` (`idrol`),
  KEY `m_rmenu_idmnu_foreign` (`idmnu`),
  CONSTRAINT `m_rmenu_idmnu_foreign` FOREIGN KEY (`idmnu`) REFERENCES `m_menu` (`idmnu`) ON DELETE CASCADE,
  CONSTRAINT `m_rmenu_idrol_foreign` FOREIGN KEY (`idrol`) REFERENCES `m_role` (`idrol`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_rmenu`
--

LOCK TABLES `m_rmenu` WRITE;
/*!40000 ALTER TABLE `m_rmenu` DISABLE KEYS */;
INSERT INTO `m_rmenu` VALUES (1,1,1,0,1,1,1,NULL,NULL,NULL,NULL),(2,1,2,0,1,1,1,NULL,NULL,NULL,NULL),(3,1,3,0,1,1,1,NULL,NULL,NULL,NULL),(4,1,4,0,1,1,1,NULL,NULL,NULL,NULL),(5,1,5,1,1,1,1,NULL,NULL,NULL,NULL),(6,1,6,1,1,1,1,NULL,NULL,NULL,NULL),(7,1,7,1,1,1,1,NULL,NULL,NULL,NULL),(8,1,9,1,1,1,1,NULL,NULL,NULL,NULL),(9,1,8,1,1,1,1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `m_rmenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_role`
--

DROP TABLE IF EXISTS `m_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_role` (
  `idrol` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nmrol` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crtby` bigint unsigned DEFAULT NULL,
  `crtdt` timestamp NULL DEFAULT NULL,
  `updby` bigint unsigned DEFAULT NULL,
  `upddt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_role`
--

LOCK TABLES `m_role` WRITE;
/*!40000 ALTER TABLE `m_role` DISABLE KEYS */;
INSERT INTO `m_role` VALUES (1,'Superadmin',NULL,'2026-10-21 09:08:10',NULL,'2026-10-21 09:08:10');
/*!40000 ALTER TABLE `m_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_uom`
--

DROP TABLE IF EXISTS `m_uom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_uom` (
  `iduom` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nmuom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crtby` bigint unsigned DEFAULT NULL,
  `crtdt` timestamp NULL DEFAULT NULL,
  `updby` bigint unsigned DEFAULT NULL,
  `upddt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`iduom`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_uom`
--

LOCK TABLES `m_uom` WRITE;
/*!40000 ALTER TABLE `m_uom` DISABLE KEYS */;
INSERT INTO `m_uom` VALUES (1,'Kg',NULL,'2026-10-21 11:30:43',NULL,'2026-10-21 11:44:35'),(2,'Pcs',NULL,'2026-10-21 11:31:37',NULL,'2026-10-21 11:31:37'),(3,'Psg',NULL,'2026-10-21 12:00:24',NULL,'2026-10-21 12:00:24'),(4,'Ton',NULL,'2026-10-21 18:22:45',NULL,'2026-10-21 18:22:45');
/*!40000 ALTER TABLE `m_uom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_urole`
--

DROP TABLE IF EXISTS `m_urole`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_urole` (
  `idusrl` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idusr` bigint unsigned NOT NULL,
  `idrol` bigint unsigned NOT NULL,
  `crtby` bigint unsigned DEFAULT NULL,
  `crtdt` timestamp NULL DEFAULT NULL,
  `updby` bigint unsigned DEFAULT NULL,
  `upddt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idusrl`),
  KEY `m_urole_idusr_foreign` (`idusr`),
  KEY `m_urole_idrol_foreign` (`idrol`),
  CONSTRAINT `m_urole_idrol_foreign` FOREIGN KEY (`idrol`) REFERENCES `m_role` (`idrol`) ON DELETE CASCADE,
  CONSTRAINT `m_urole_idusr_foreign` FOREIGN KEY (`idusr`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_urole`
--

LOCK TABLES `m_urole` WRITE;
/*!40000 ALTER TABLE `m_urole` DISABLE KEYS */;
INSERT INTO `m_urole` VALUES (1,1,1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `m_urole` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_vendor`
--

DROP TABLE IF EXISTS `m_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m_vendor` (
  `idvend` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nmvend` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adrvend` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idvend`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_vendor`
--

LOCK TABLES `m_vendor` WRITE;
/*!40000 ALTER TABLE `m_vendor` DISABLE KEYS */;
INSERT INTO `m_vendor` VALUES (1,'PT ABC','Sidoarjo');
/*!40000 ALTER TABLE `m_vendor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_10_13_112450_create_m_role_table',1),(5,'2026_10_13_112504_create_m_menu_table',1),(6,'2026_10_13_112533_create_m_rmenu_table',1),(7,'2026_10_13_112540_create_m_urole_table',1),(8,'2026_10_13_112720_create_m_param_table',1),(9,'2026_10_21_172632_create_m_uom_table',2),(10,'2026_10_21_172644_create_m_product_table',2),(11,'2026_10_21_172648_create_m_vendor_table',2),(12,'2026_10_21_172704_create_t_offer_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `sessions` VALUES ('UtknRISuxuwxEy2sXeun96r4tPdlq372lgaOBrhr',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJ0UzFadk1PekRMTGRjNkV1SDRpNTU5NlBIUDhEdm1WZ1RoTzdVaEg2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3Rlcy1rZGkudGVzdFwvcG9ydGFsXC9jYXB0Y2hhP3Q9MTc5MjY1MjA2NiIsInJvdXRlIjoicG9ydGFsLmNhcHRjaGEifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJ1cmwiOltdLCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwicGFzc3dvcmRfaGFzaF93ZWIiOiI0ODgxODRlMDBhNWQ4ZjllYjYwZDAzNDhhYWM3MzBlZTg0Njg5NmNlOWZiZTkzZjRlZWNjYjc4NTVlMmNkMDYwIiwiY2FwdGNoYV9yZXN1bHQiOjEyLCJjYXB0Y2hhX2NvZGUiOiIzNDY2In0=',1792652067);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_offer`
--

DROP TABLE IF EXISTS `t_offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_offer` (
  `idofr` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idprod` bigint unsigned DEFAULT NULL,
  `idvend` bigint unsigned NOT NULL,
  `iduom` bigint unsigned DEFAULT NULL,
  `nmsales` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nosales` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` double NOT NULL,
  `ppn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `crtby` bigint unsigned DEFAULT NULL,
  `crtdt` timestamp NULL DEFAULT NULL,
  `updby` bigint unsigned DEFAULT NULL,
  `upddt` timestamp NULL DEFAULT NULL,
  `stsofr` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `stsmail` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `dtofr` date DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `exuom` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exprod` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idofr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_offer`
--

LOCK TABLES `t_offer` WRITE;
/*!40000 ALTER TABLE `t_offer` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Administrator','superadmin@mail.com',NULL,'$2y$12$CIhtC.rM7TEf.Ti7iSl2/evhFbgGmxF7GJjFE//JQRoF12Bmz.kWu','8ZvSZubsmQI83grrvQJpA1F9kgPgOLZSDUMWGpnqocsCQpiBhu214hgoaNn1','2026-10-21 09:08:10','2026-10-21 09:08:10');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_kdi'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-22 14:19:52
