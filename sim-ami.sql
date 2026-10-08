-- MySQL dump 10.13  Distrib 8.0.42, for macos15 (arm64)
--
-- Host: 127.0.0.1    Database: sim-ami
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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('spatie.permission.cache','a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:9:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:12:\"manage roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:18:\"manage permissions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:12:\"manage users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:16:\"manage documents\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:12:\"manage forms\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:12:\"view reports\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:13:\"manage stages\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:9:\"form.show\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:16:\"manage faculties\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"Admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:3:\"PJM\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:7:\"Auditee\";s:1:\"c\";s:3:\"web\";}}}',1791462496),('user_role_2','s:3:\"PJM\";',1791438713),('user_role_4','s:7:\"Auditee\";',1790939028),('user-2-is-online','b:1;',1791395633),('user-4-is-online','b:1;',1790895948);
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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `document_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_document_id_foreign` (`document_id`),
  CONSTRAINT `categories_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (3,3,'test_1_tab','2026-09-30 09:07:11','2026-09-30 09:07:11'),(5,5,'test_3_tab','2026-10-01 21:29:38','2026-10-01 21:29:38'),(8,8,'test_4_tab','2026-10-01 22:32:36','2026-10-01 22:32:36'),(12,12,'test_4_tab','2026-10-07 16:00:32','2026-10-07 16:00:32');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competencies`
--

DROP TABLE IF EXISTS `competencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `competencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `standard_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `competencies_standard_id_foreign` (`standard_id`),
  CONSTRAINT `competencies_standard_id_foreign` FOREIGN KEY (`standard_id`) REFERENCES `standards` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competencies`
--

LOCK TABLES `competencies` WRITE;
/*!40000 ALTER TABLE `competencies` DISABLE KEYS */;
INSERT INTO `competencies` VALUES (3,3,'test_1_kompetensi','2026-09-30 09:07:11','2026-09-30 09:07:11'),(4,3,'test_1.2_kompetensi','2026-09-30 09:07:11','2026-09-30 09:07:11'),(8,5,'test_3_kompetensi','2026-10-01 21:29:38','2026-10-01 21:29:38'),(9,5,'test_3.2_kompetensi','2026-10-01 21:29:38','2026-10-01 21:29:38'),(10,5,'test_3.3_kompetensi','2026-10-01 21:29:38','2026-10-01 21:29:38'),(17,8,'test_4_kompetensi','2026-10-01 22:32:36','2026-10-01 22:32:36'),(18,8,'test_4.2_kompetensi','2026-10-01 22:32:36','2026-10-01 22:32:36'),(19,8,'test_4.3_kompetensi','2026-10-01 22:32:36','2026-10-01 22:32:36'),(27,12,'test_4_kompetensi','2026-10-07 16:00:32','2026-10-07 16:00:32'),(28,12,'test_4.2_kompetensi','2026-10-07 16:00:32','2026-10-07 16:00:32'),(29,12,'test_4.3_kompetensi','2026-10-07 16:00:32','2026-10-07 16:00:32');
/*!40000 ALTER TABLE `competencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `faculty_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_name_unique` (`name`),
  UNIQUE KEY `departments_code_unique` (`code`),
  KEY `departments_faculty_id_foreign` (`faculty_id`),
  CONSTRAINT `departments_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,3,'Jurusan Matematika dan Teknologi Informasi','JMTI','2026-09-29 13:20:41','2026-10-07 13:12:11'),(2,1,'Jurusan Sains, Teknologi Pangan, dan Kemaritiman','JSTPK','2026-09-29 13:20:41','2026-10-07 13:13:25'),(3,2,'Jurusan Teknologi Industri dan Proses','JTIP','2026-09-29 13:20:41','2026-10-07 13:13:54'),(4,1,'Jurusan Teknik Sipil dan Perencanaan','JTSP','2026-09-29 13:20:41','2026-10-07 13:14:03'),(5,1,'Jurusan Ilmu Kebumian dan Lingkungan','JIKL','2026-09-29 13:20:41','2026-10-07 13:15:09');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `documents_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (3,'test_1_dokumen','2026-09-30 17:07:11','2026-09-30 09:07:11','2026-09-30 09:07:11'),(5,'test_3_dokumen','2026-10-02 05:29:38','2026-10-01 21:29:38','2026-10-01 21:29:38'),(8,'test_4_dokumen','2026-10-02 06:32:36','2026-10-01 22:32:36','2026-10-01 22:32:36'),(12,'test_5_dokumen','2026-10-08 00:00:32','2026-10-07 16:00:32','2026-10-07 16:00:32');
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculties`
--

DROP TABLE IF EXISTS `faculties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faculties` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `faculties_name_unique` (`name`),
  UNIQUE KEY `faculties_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculties`
--

LOCK TABLES `faculties` WRITE;
/*!40000 ALTER TABLE `faculties` DISABLE KEYS */;
INSERT INTO `faculties` VALUES (1,'Fakultas Pembangunan Berkelanjutan','FPB','2026-10-07 12:36:29','2026-10-07 12:36:29'),(2,'Fakultas Rekayasa dan Teknologi Industri','FRTI','2026-10-07 12:37:01','2026-10-07 12:37:01'),(3,'Fakultas Sains dan Teknologi Informasi','FSTI','2026-10-07 12:37:26','2026-10-07 12:37:26');
/*!40000 ALTER TABLE `faculties` ENABLE KEYS */;
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
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `form_accesses`
--

DROP TABLE IF EXISTS `form_accesses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form_accesses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `form_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `form_accesses_form_id_foreign` (`form_id`),
  KEY `form_accesses_user_id_foreign` (`user_id`),
  CONSTRAINT `form_accesses_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `form_accesses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_accesses`
--

LOCK TABLES `form_accesses` WRITE;
/*!40000 ALTER TABLE `form_accesses` DISABLE KEYS */;
INSERT INTO `form_accesses` VALUES (5,3,4,'Chief','2026-10-01 21:04:25','2026-10-01 21:04:25'),(6,3,5,'PIC','2026-10-01 21:04:25','2026-10-01 21:04:25'),(7,3,6,'Leader','2026-10-01 21:04:25','2026-10-01 21:04:25'),(8,3,7,'Member','2026-10-01 21:04:25','2026-10-01 21:04:25'),(9,4,4,'Chief','2026-10-01 21:30:23','2026-10-01 21:30:23'),(10,4,5,'PIC','2026-10-01 21:30:23','2026-10-01 21:30:23'),(11,4,6,'Leader','2026-10-01 21:30:23','2026-10-01 21:30:23'),(12,4,7,'Member','2026-10-01 21:30:23','2026-10-01 21:30:23'),(17,6,4,'Chief','2026-10-01 22:36:31','2026-10-01 22:36:31'),(18,6,5,'PIC','2026-10-01 22:36:31','2026-10-01 22:36:31'),(19,6,6,'Leader','2026-10-01 22:36:31','2026-10-01 22:36:31'),(20,6,7,'Member','2026-10-01 22:36:31','2026-10-01 22:36:31'),(21,7,4,'Chief','2026-10-07 16:05:22','2026-10-07 16:05:22'),(22,7,5,'PIC','2026-10-07 16:05:22','2026-10-07 16:05:22'),(23,7,6,'Leader','2026-10-07 16:05:22','2026-10-07 16:05:22'),(24,7,7,'Member','2026-10-07 16:05:22','2026-10-07 16:05:22');
/*!40000 ALTER TABLE `form_accesses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_audits`
--

DROP TABLE IF EXISTS `form_audits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form_audits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `form_id` bigint unsigned NOT NULL,
  `indicator_id` bigint unsigned NOT NULL,
  `submission_status` bigint unsigned DEFAULT NULL,
  `validation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assessment_status` bigint unsigned DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `feedback` tinyint(1) DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `validation_status` bigint unsigned DEFAULT NULL,
  `conclusion` text COLLATE utf8mb4_unicode_ci,
  `planning` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `form_audits_form_id_foreign` (`form_id`),
  KEY `form_audits_indicator_id_foreign` (`indicator_id`),
  CONSTRAINT `form_audits_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `form_audits_indicator_id_foreign` FOREIGN KEY (`indicator_id`) REFERENCES `indicators` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_audits`
--

LOCK TABLES `form_audits` WRITE;
/*!40000 ALTER TABLE `form_audits` DISABLE KEYS */;
INSERT INTO `form_audits` VALUES (3,2,3,2,'0.5','test.com',NULL,NULL,NULL,NULL,NULL,NULL,'test','2026-10-01 02:19:26','2026-10-01 07:59:41'),(4,2,4,3,'Yes','test.com',NULL,NULL,NULL,NULL,NULL,NULL,'test','2026-10-01 02:19:26','2026-10-01 07:59:47'),(5,3,3,3,'8.5','https://www.test.com',NULL,NULL,NULL,NULL,NULL,NULL,'test planning','2026-10-01 21:04:25','2026-10-01 21:15:59'),(6,3,4,2,'Yes','https://www.test.com',NULL,NULL,NULL,NULL,NULL,NULL,'test planning','2026-10-01 21:04:25','2026-10-01 21:16:06'),(7,4,8,2,'5.5','test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-01 21:30:23','2026-10-01 21:31:05'),(8,4,9,3,'Yes','test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-01 21:30:23','2026-10-01 21:30:57'),(9,4,10,3,'cukup','test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-01 21:30:23','2026-10-01 21:30:49'),(13,6,17,3,'4.5','https://www.test.com',NULL,NULL,NULL,NULL,NULL,NULL,'test plan','2026-10-01 22:36:31','2026-10-01 22:51:20'),(14,6,18,4,'Yes','https://www.test.com',NULL,NULL,NULL,NULL,NULL,NULL,'test plan','2026-10-01 22:36:31','2026-10-01 22:51:26'),(15,6,19,3,'cukup','https://www.test.com',NULL,NULL,NULL,NULL,NULL,NULL,'test plan','2026-10-01 22:36:31','2026-10-01 22:51:32'),(16,7,26,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-07 16:05:22','2026-10-07 16:05:22'),(17,7,27,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-07 16:05:22','2026-10-07 16:05:22'),(18,7,28,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-07 16:05:22','2026-10-07 16:05:22');
/*!40000 ALTER TABLE `form_audits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_times`
--

DROP TABLE IF EXISTS `form_times`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form_times` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `form_id` bigint unsigned DEFAULT NULL,
  `submission_time` datetime DEFAULT NULL,
  `submission_deadline` datetime DEFAULT NULL,
  `submission_extended` tinyint(1) NOT NULL DEFAULT '0',
  `assessment_time` datetime DEFAULT NULL,
  `assessment_deadline` datetime DEFAULT NULL,
  `assessment_extended` tinyint(1) NOT NULL DEFAULT '0',
  `feedback_time` datetime DEFAULT NULL,
  `feedback_deadline` datetime DEFAULT NULL,
  `feedback_extended` tinyint(1) NOT NULL DEFAULT '0',
  `validation_time` datetime DEFAULT NULL,
  `validation_deadline` datetime DEFAULT NULL,
  `validation_extended` tinyint(1) NOT NULL DEFAULT '0',
  `meeting_time` datetime DEFAULT NULL,
  `meeting_deadline` datetime DEFAULT NULL,
  `meeting_extended` tinyint(1) NOT NULL DEFAULT '0',
  `planning_time` datetime DEFAULT NULL,
  `planning_deadline` datetime DEFAULT NULL,
  `planning_extended` tinyint(1) NOT NULL DEFAULT '0',
  `signing_time` datetime DEFAULT NULL,
  `signing_deadline` datetime DEFAULT NULL,
  `signing_extended` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `form_times_form_id_foreign` (`form_id`),
  CONSTRAINT `form_times_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_times`
--

LOCK TABLES `form_times` WRITE;
/*!40000 ALTER TABLE `form_times` DISABLE KEYS */;
INSERT INTO `form_times` VALUES (1,2,'2026-10-01 15:45:14',NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,'2026-10-01 16:39:23',NULL,0,'2026-10-01 20:21:11',NULL,0,'2026-10-01 06:46:36','2026-10-01 12:21:11'),(2,3,'2026-10-02 05:13:57',NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,'2026-10-02 05:16:08',NULL,0,'2026-10-02 05:17:12',NULL,0,'2026-10-01 21:13:57','2026-10-01 21:17:12'),(3,4,'2026-10-02 05:31:07',NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,'2026-10-01 21:31:07','2026-10-01 21:31:07'),(5,6,'2026-10-02 06:50:25',NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,NULL,NULL,0,'2026-10-02 06:51:51',NULL,0,'2026-10-02 06:56:00',NULL,0,'2026-10-01 22:50:25','2026-10-01 22:56:00');
/*!40000 ALTER TABLE `form_times` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `document_id` bigint unsigned NOT NULL,
  `unit_id` bigint unsigned NOT NULL,
  `stage_id` bigint unsigned NOT NULL,
  `meeting` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_time` datetime DEFAULT NULL,
  `meeting_verification` tinyint(1) DEFAULT NULL,
  `verification_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signing_verification` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forms_document_id_foreign` (`document_id`),
  CONSTRAINT `forms_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms`
--

LOCK TABLES `forms` WRITE;
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` VALUES (2,3,16,8,NULL,NULL,NULL,NULL,'signing/0GyD8Wr42StwNGmf3YazUJ0Gd6PE6x1yMI3qP9rK.pdf',1,'2026-10-01 02:19:26','2026-10-01 12:21:38'),(3,3,16,8,NULL,NULL,NULL,NULL,'signing/lhJn8Ro4imJ0NUxXEFKtbC7UgqDjp2VDBed5gIZ8.pdf',1,'2026-10-01 21:04:25','2026-10-01 21:17:28'),(4,5,16,6,NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-01 21:30:23','2026-10-01 21:31:07'),(6,8,16,8,NULL,NULL,NULL,NULL,'signing/24CWrdanjzcvyU2v1YDpgIN5YsaJzq7YcOxaxuKM.pdf',1,'2026-10-01 22:36:31','2026-10-01 22:56:46'),(7,12,16,1,NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-07 16:05:22','2026-10-07 16:05:22');
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indicators`
--

DROP TABLE IF EXISTS `indicators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `indicators` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `competency_id` bigint unsigned NOT NULL,
  `assessment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate_option` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percentage_option` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activity_category` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `participant` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activity_year` year DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indicators_competency_id_foreign` (`competency_id`),
  CONSTRAINT `indicators_competency_id_foreign` FOREIGN KEY (`competency_id`) REFERENCES `competencies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indicators`
--

LOCK TABLES `indicators` WRITE;
/*!40000 ALTER TABLE `indicators` DISABLE KEYS */;
INSERT INTO `indicators` VALUES (3,3,'test_1_indikator','A.1','Decimal',NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-30 09:07:11','2026-09-30 09:07:11'),(4,4,'test_1.2_indikator','A.2','Option',NULL,NULL,NULL,NULL,NULL,NULL,'2026-09-30 09:07:11','2026-09-30 09:07:11'),(8,8,'test_3_indikator','A.1','Decimal',NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-01 21:29:38','2026-10-01 21:29:38'),(9,9,'test_3.2_indikator','A.2','Option',NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-01 21:29:38','2026-10-01 21:29:38'),(10,10,'Tingkat Keterlibatan Mahasiswa dalam Penelitian tingkat Program Studi','A.3','Rate','researcher_satisfaction',NULL,NULL,NULL,NULL,NULL,'2026-10-01 21:29:38','2026-10-01 21:29:38'),(17,17,'test_4_indikator','A.1','Decimal',NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-01 22:32:36','2026-10-01 22:32:36'),(18,18,'test_4.2_indikator','A.2','Option',NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-01 22:32:36','2026-10-01 22:32:36'),(19,19,'Tingkat kepuasan peneliti terhadap akses pembiayaan penelitian tingkat institut','A.3','Rate','researcherSatisfaction',NULL,NULL,NULL,NULL,NULL,'2026-10-01 22:32:36','2026-10-01 22:32:36'),(26,27,'test_4_indikator','A.1','Decimal',NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-07 16:00:32','2026-10-07 16:00:32'),(27,28,'test_4.2_indikator','A.2','Option',NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-07 16:00:32','2026-10-07 16:00:32'),(28,29,'Tingkat kepuasan peneliti terhadap akses pembiayaan penelitian tingkat institut','A.3','Percentage',NULL,'percentage-1',NULL,'penelitian','mahasiswa',2026,'2026-10-07 16:00:32','2026-10-07 16:00:32');
/*!40000 ALTER TABLE `indicators` ENABLE KEYS */;
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
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_06_18_043838_create_permission_tables',1),(5,'2024_06_19_061434_create_faculties_table',1),(6,'2024_06_19_061444_create_departments_table',1),(7,'2024_06_19_061454_create_units_table',1),(8,'2024_06_19_062338_create_stages_table',1),(9,'2024_06_19_062340_create_statuses_table',1),(10,'2024_06_19_083435_create_documents_table',1),(11,'2024_06_19_083436_create_categories_table',1),(12,'2024_06_19_083549_create_standards_table',1),(13,'2024_06_19_083733_create_competencies_table',1),(14,'2024_06_19_084129_create_indicators_table',1),(15,'2024_08_08_194700_create_forms_table',1),(16,'2024_08_08_194701_create_form_accesses_table',1),(17,'2024_08_08_195444_create_form_audits_table',1),(18,'2024_10_22_234603_create_form_times_table',1),(19,'2026_09_29_232857_add_is_active_to_stages_table',2),(20,'2026_09_29_234259_add_order_to_stages_table',3),(21,'2026_10_07_000001_fix_faculty_department_unit_relations',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2),(3,'App\\Models\\User',2),(4,'App\\Models\\User',2),(3,'App\\Models\\User',4),(3,'App\\Models\\User',5),(4,'App\\Models\\User',6),(4,'App\\Models\\User',7);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
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
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'manage roles','web','2026-09-29 13:20:41','2026-09-29 13:20:41'),(2,'manage permissions','web','2026-09-29 13:20:41','2026-09-29 13:20:41'),(3,'manage users','web','2026-09-29 13:20:41','2026-09-29 13:20:41'),(4,'manage documents','web','2026-09-29 13:20:41','2026-09-29 13:20:41'),(5,'manage forms','web','2026-09-29 13:20:41','2026-09-29 13:20:41'),(6,'view reports','web','2026-09-29 13:20:41','2026-09-29 13:20:41'),(7,'manage stages','web','2026-09-29 15:41:28','2026-09-29 15:41:28'),(8,'form.show','web','2026-10-01 05:25:46','2026-10-01 05:25:46'),(9,'manage faculties','web','2026-10-07 12:28:09','2026-10-07 12:28:09');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(4,2),(5,2),(6,2),(7,2),(9,2),(8,3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','web','2026-09-29 13:20:41','2026-09-29 13:20:41'),(2,'PJM','web','2026-09-29 13:20:41','2026-09-29 13:20:41'),(3,'Auditee','web','2026-09-29 13:20:41','2026-09-29 13:20:41'),(4,'Auditor','web','2026-09-29 13:20:41','2026-09-29 13:20:41');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('PuVuaXHq5kj51eGkzxkwPVonyHqOGfhZ0eLt9wdD',2,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOFJwWDJndUk2RzVYY1kyUVZDRlJDekdzVHR5TnFSSkg5bms4N1JUbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mb3Jtcy83L3N1Ym1pc3Npb24iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=',1791393960);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stages`
--

DROP TABLE IF EXISTS `stages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint NOT NULL,
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stages`
--

LOCK TABLES `stages` WRITE;
/*!40000 ALTER TABLE `stages` DISABLE KEYS */;
INSERT INTO `stages` VALUES (1,'Submission','Tahap pengumpulan bukti ketercapaian indikator oleh Audite.',1,0,'2026-09-29 13:20:41','2026-10-01 12:35:42'),(2,'Assessment','Tahap penilaian ketercapaian indikator oleh Auditor.',0,0,'2026-09-29 13:20:41','2026-10-01 22:26:22'),(3,'Feedback','Tahap umpan balik Audite terhadap penilaian Auditor.',0,0,'2026-09-29 13:20:41','2026-10-01 22:26:38'),(4,'Validation','Tahap validasi ketercapaian indikator berdasarkan kesepakatan bersama saat verifikasi lapangan.',0,0,'2026-09-29 13:20:41','2026-10-01 22:26:37'),(5,'Meeting','Tahap pengumpulan Berita Acara RTM dengan verifikasi PJM.',0,0,'2026-09-29 13:20:41','2026-10-01 22:26:40'),(6,'Planning','Tahap perencanaan tindak lanjut indikator yang belum memenuhi oleh Audite.',1,0,'2026-09-29 13:20:41','2026-10-01 07:15:58'),(7,'Signing','Tahap pengumpulan Laporan Audit yang telah ditandatangani.',1,0,'2026-09-29 13:20:41','2026-10-01 07:15:58'),(8,'Outcome','Kegiatan Audit Mutu Internal berhasil dilaksanakan.',1,0,'2026-09-29 13:20:41','2026-10-07 07:03:42');
/*!40000 ALTER TABLE `stages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `standards`
--

DROP TABLE IF EXISTS `standards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `standards` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `standards_category_id_foreign` (`category_id`),
  CONSTRAINT `standards_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `standards`
--

LOCK TABLES `standards` WRITE;
/*!40000 ALTER TABLE `standards` DISABLE KEYS */;
INSERT INTO `standards` VALUES (3,3,'test_1_standar','2026-09-30 09:07:11','2026-09-30 09:07:11'),(5,5,'test_3_standar','2026-10-01 21:29:38','2026-10-01 21:29:38'),(8,8,'test_3_standar','2026-10-01 22:32:36','2026-10-01 22:32:36'),(12,12,'test_3_standar','2026-10-07 16:00:32','2026-10-07 16:00:32');
/*!40000 ALTER TABLE `standards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuses`
--

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` VALUES (1,'Nonconformity','2026-09-29 13:20:41','2026-09-29 13:20:41'),(2,'Not Fulfilled','2026-09-29 13:20:41','2026-09-29 13:20:41'),(3,'Fulfilled','2026-09-29 13:20:41','2026-09-29 13:20:41'),(4,'Exceeded','2026-09-29 13:20:41','2026-09-29 13:20:41');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `units` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `units_name_unique` (`name`),
  UNIQUE KEY `units_code_unique` (`code`),
  KEY `units_department_id_foreign` (`department_id`),
  CONSTRAINT `units_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,1,'Jurusan Matematika dan Teknologi Informasi','JMTI','2026-09-29 13:20:41','2026-10-07 16:02:52'),(2,2,'Jurusan Sains, Teknologi Pangan, Dan Kemaritiman','JSTPK','2026-09-29 13:20:41','2026-10-07 16:03:02'),(3,3,'Jurusan Teknologi Industri Dan Proses','JTIP','2026-09-29 13:20:41','2026-10-07 16:03:08'),(4,4,'Jurusan Teknik Sipil Dan Perencanaan','JTSP','2026-09-29 13:20:41','2026-10-07 16:03:13'),(5,5,'Jurusan Ilmu Kebumian Dan Lingkungan','JIKL','2026-09-29 13:20:41','2026-10-07 16:03:23'),(6,5,'Fisika','1','2026-09-29 13:20:41','2026-10-07 13:17:26'),(7,1,'Matematika','2','2026-09-29 13:20:41','2026-09-29 13:20:41'),(8,3,'Teknik Mesin','3','2026-09-29 13:20:41','2026-09-29 13:20:41'),(9,3,'Teknik Elektro','4','2026-09-29 13:20:41','2026-09-29 13:20:41'),(10,3,'Teknik Kimia','5','2026-09-29 13:20:41','2026-09-29 13:20:41'),(11,5,'Teknik Material dan Metalurgi','6','2026-09-29 13:20:41','2026-09-29 13:20:41'),(12,4,'Teknik Sipil','7','2026-09-29 13:20:41','2026-09-29 13:20:41'),(13,4,'Perencanaan Wilayah dan Kota','8','2026-09-29 13:20:41','2026-09-29 13:20:41'),(14,2,'Teknik Perkapalan','9','2026-09-29 13:20:41','2026-09-29 13:20:41'),(15,1,'Sistem Informasi','10','2026-09-29 13:20:41','2026-09-29 13:20:41'),(16,1,'Informatika','11','2026-09-29 13:20:41','2026-09-29 13:20:41'),(17,3,'Teknik Industri','12','2026-09-29 13:20:41','2026-09-29 13:20:41'),(18,5,'Teknik Lingkungan','13','2026-09-29 13:20:41','2026-09-29 13:20:41'),(19,2,'Teknik Kelautan','14','2026-09-29 13:20:41','2026-09-29 13:20:41'),(20,2,'Teknik Pangan','15','2026-09-29 13:20:41','2026-09-29 13:20:41'),(21,1,'Ilmu Aktuaria','16','2026-09-29 13:20:41','2026-09-29 13:20:41'),(22,1,'Statistika','17','2026-09-29 13:20:41','2026-09-29 13:20:41'),(23,1,'Bisnis Digital','18','2026-09-29 13:20:41','2026-09-29 13:20:41'),(24,4,'Arsitektur','19','2026-09-29 13:20:41','2026-09-29 13:20:41'),(25,3,'Rekayasa Keselamatan','20','2026-09-29 13:20:41','2026-09-29 13:20:41'),(26,3,'Teknik Logistik','21','2026-09-29 13:20:41','2026-09-29 13:20:41'),(27,4,'Desain Komunikasi Visual','22','2026-09-29 13:20:41','2026-09-29 13:20:41');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
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
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_contact_unique` (`contact`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','admin','admin@admin.itk.ac.id','082266951934',NULL,'$2y$12$gEkBDnCG2VW4MKytVvIxCOmiy6wmipeZPkHgGB8fb5SfI8ZWY8Nhe','2026-10-07 12:34:33',NULL,'2026-09-29 13:20:41','2026-10-07 12:34:33'),(2,'test-PJM','yoga_tiara','pjm@pjm.itk.ac.id','082266951933',NULL,'$2y$12$GyhCv8Pl/aiiCyFco9jkNOQ4/xLoMkri/Ay6LuVRqo2cOyWLeRdte','2026-10-07 17:51:53',NULL,'2026-09-29 13:20:41','2026-10-07 17:51:53'),(4,'Bowo Nugroho, S.Kom., M.Eng.','199008312020121002','bowo.nugroho@lecturer.itk.ac.id','082266951936',NULL,'$2y$12$dMpvNZsQpOmdM8J/m0f1ZOR7Lt7vF0T.CKUeBI2nSDdsugIYz5pTe','2026-10-01 23:03:48',NULL,'2026-10-01 20:52:03','2026-10-01 23:03:48'),(5,'Nur Fajri Azhar  S.Kom., M.Kom.','199205182019031015','fajri@lecturer.itk.ac.id',NULL,NULL,NULL,NULL,NULL,'2026-10-01 21:04:25','2026-10-01 21:04:25'),(6,'Darmansyah, S.Si., M.T.I','198704282022031002','darmansyah@lecturer.itk.ac.id',NULL,NULL,NULL,NULL,NULL,'2026-10-01 21:04:25','2026-10-01 21:04:25'),(7,'Muchammad Chandra Cahyo Utomo, S. Kom., M. Kom.','199202202019031013','ccahyo@lecturer.itk.ac.id',NULL,NULL,NULL,NULL,NULL,'2026-10-01 21:04:25','2026-10-01 21:04:25');
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

-- Dump completed on 2026-10-08  2:00:15
