-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: siperkuliahan
-- ------------------------------------------------------
-- Server version	8.0.42

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
-- Table structure for table `attendance_list_details`
--

DROP TABLE IF EXISTS `attendance_list_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendance_list_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `attendance_list_id` bigint unsigned NOT NULL,
  `meeting_order` int NOT NULL,
  `course_status` tinyint NOT NULL COMMENT '1=sesuai jadwal, 2= pertukaran, 3= pengganti, 4= tambahan',
  `start_hour` int DEFAULT NULL,
  `end_hour` int DEFAULT NULL,
  `sum_attendance_students` int DEFAULT NULL,
  `sum_late_students` int DEFAULT NULL,
  `has_acc_student` tinyint(1) NOT NULL DEFAULT '1',
  `has_acc_lecturer` tinyint(1) NOT NULL DEFAULT '1',
  `student_id` bigint unsigned DEFAULT NULL,
  `date_acc_student` datetime DEFAULT NULL,
  `date_acc_lecturer` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendance_list_details_attendance_list_id_foreign` (`attendance_list_id`),
  KEY `attendance_list_details_student_id_foreign` (`student_id`),
  CONSTRAINT `attendance_list_details_attendance_list_id_foreign` FOREIGN KEY (`attendance_list_id`) REFERENCES `attendance_lists` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attendance_list_details_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance_list_details`
--

LOCK TABLES `attendance_list_details` WRITE;
/*!40000 ALTER TABLE `attendance_list_details` DISABLE KEYS */;
INSERT INTO `attendance_list_details` VALUES (1,1,1,1,3,4,8,1,2,2,8,'2025-06-25 14:51:26','2025-06-25 14:49:23','2025-06-25 07:42:20','2025-06-25 07:51:26'),(2,1,2,2,2,4,8,0,2,2,8,'2025-06-25 14:51:29','2025-06-25 14:49:43','2025-06-25 07:42:38','2025-06-25 07:51:29'),(3,2,1,1,1,2,1,1,2,2,9,'2025-06-26 07:29:56','2025-06-26 07:27:01','2025-06-26 00:26:16','2025-06-26 00:29:56'),(4,2,2,1,3,4,1,0,2,2,9,'2025-06-26 07:33:43','2025-06-26 07:33:29','2025-06-26 00:33:07','2025-06-26 00:33:43'),(5,3,1,1,1,2,1,0,2,2,19,'2025-06-26 07:52:50','2025-06-26 07:52:34','2025-06-26 00:50:27','2025-06-26 00:52:50'),(6,3,2,1,5,6,1,0,2,2,19,'2025-06-26 07:54:11','2025-06-26 07:53:51','2025-06-26 00:53:45','2025-06-26 00:54:11'),(12,5,1,1,1,8,6,0,2,2,8,'2025-07-02 07:56:43','2025-06-29 04:58:48','2025-06-28 21:58:32','2025-07-02 00:56:43'),(13,5,2,1,1,8,6,0,2,2,8,'2025-07-02 07:56:48','2025-06-29 04:59:17','2025-06-28 21:59:07','2025-07-02 00:56:48'),(14,5,3,3,1,8,6,0,2,2,8,'2025-07-02 07:56:53','2025-06-29 04:59:48','2025-06-28 21:59:37','2025-07-02 00:56:53'),(15,5,4,1,1,4,6,0,2,2,8,'2025-07-02 07:56:59','2025-06-29 05:00:17','2025-06-28 22:00:06','2025-07-02 00:56:59'),(16,5,5,1,1,7,7,0,2,2,8,'2025-07-02 07:57:15','2025-06-29 05:18:48','2025-06-28 22:18:35','2025-07-02 00:57:15'),(17,5,6,2,4,5,8,0,1,2,NULL,NULL,'2025-07-02 07:53:08','2025-07-02 00:52:38','2025-07-02 00:53:08'),(18,7,1,1,1,2,13,1,2,2,24,'2025-07-18 03:02:34','2025-07-18 03:00:33','2025-07-17 19:59:56','2025-07-17 20:02:34'),(19,7,2,1,4,5,13,0,2,2,24,'2025-07-18 03:04:05','2025-07-18 03:03:55','2025-07-17 20:03:47','2025-07-17 20:04:05');
/*!40000 ALTER TABLE `attendance_list_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance_list_students`
--

DROP TABLE IF EXISTS `attendance_list_students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendance_list_students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `attendance_list_detail_id` bigint unsigned NOT NULL,
  `student_id` bigint unsigned NOT NULL,
  `attendance_student` tinyint NOT NULL COMMENT '1:hadir, 2:telat, 3:sakit, 4:izin, 5: bolos',
  `minutes_late` int DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendance_list_students_attendance_list_detail_id_foreign` (`attendance_list_detail_id`),
  KEY `attendance_list_students_student_id_foreign` (`student_id`),
  CONSTRAINT `attendance_list_students_attendance_list_detail_id_foreign` FOREIGN KEY (`attendance_list_detail_id`) REFERENCES `attendance_list_details` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attendance_list_students_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance_list_students`
--

LOCK TABLES `attendance_list_students` WRITE;
/*!40000 ALTER TABLE `attendance_list_students` DISABLE KEYS */;
INSERT INTO `attendance_list_students` VALUES (1,1,1,2,NULL,NULL,'2025-06-25 07:43:05','2025-06-25 07:49:23'),(2,2,1,1,NULL,NULL,'2025-06-25 07:43:19','2025-06-25 07:43:19'),(3,1,2,1,NULL,NULL,'2025-06-25 07:49:23','2025-06-25 07:49:23'),(4,1,3,1,NULL,NULL,'2025-06-25 07:49:23','2025-06-25 07:49:23'),(5,1,4,1,NULL,NULL,'2025-06-25 07:49:23','2025-06-25 07:49:23'),(6,1,5,1,NULL,NULL,'2025-06-25 07:49:23','2025-06-25 07:49:23'),(7,1,6,1,NULL,NULL,'2025-06-25 07:49:23','2025-06-25 07:49:23'),(8,1,7,1,NULL,NULL,'2025-06-25 07:49:23','2025-06-25 07:49:23'),(9,1,8,1,NULL,NULL,'2025-06-25 07:49:23','2025-06-25 07:49:23'),(10,2,2,1,NULL,NULL,'2025-06-25 07:49:43','2025-06-25 07:49:43'),(11,2,3,1,NULL,NULL,'2025-06-25 07:49:43','2025-06-25 07:49:43'),(12,2,4,1,NULL,NULL,'2025-06-25 07:49:43','2025-06-25 07:49:43'),(13,2,5,1,NULL,NULL,'2025-06-25 07:49:43','2025-06-25 07:49:43'),(14,2,6,1,NULL,NULL,'2025-06-25 07:49:43','2025-06-25 07:49:43'),(15,2,7,1,NULL,NULL,'2025-06-25 07:49:43','2025-06-25 07:49:43'),(16,2,8,1,NULL,NULL,'2025-06-25 07:49:43','2025-06-25 07:49:43'),(17,3,9,2,5,NULL,'2025-06-26 00:27:01','2025-06-26 00:27:01'),(18,4,9,1,NULL,NULL,'2025-06-26 00:33:29','2025-06-26 00:33:29'),(19,5,19,1,NULL,NULL,'2025-06-26 00:52:34','2025-06-26 00:52:34'),(20,6,19,1,NULL,NULL,'2025-06-26 00:53:51','2025-06-26 00:53:51'),(21,12,1,1,NULL,NULL,'2025-06-28 21:58:48','2025-06-28 21:58:48'),(22,12,2,5,NULL,NULL,'2025-06-28 21:58:48','2025-06-28 21:58:48'),(23,12,3,5,NULL,NULL,'2025-06-28 21:58:48','2025-06-28 21:58:48'),(24,12,4,1,NULL,NULL,'2025-06-28 21:58:48','2025-06-28 21:58:48'),(25,12,5,1,NULL,NULL,'2025-06-28 21:58:48','2025-06-28 21:58:48'),(26,12,6,1,NULL,NULL,'2025-06-28 21:58:48','2025-06-28 21:58:48'),(27,12,7,1,NULL,NULL,'2025-06-28 21:58:48','2025-06-28 21:58:48'),(28,12,8,1,NULL,NULL,'2025-06-28 21:58:48','2025-06-28 21:58:48'),(29,13,1,5,NULL,NULL,'2025-06-28 21:59:17','2025-06-28 21:59:17'),(30,13,2,5,NULL,NULL,'2025-06-28 21:59:17','2025-06-28 21:59:17'),(31,13,3,1,NULL,NULL,'2025-06-28 21:59:17','2025-06-28 21:59:17'),(32,13,4,1,NULL,NULL,'2025-06-28 21:59:17','2025-06-28 21:59:17'),(33,13,5,1,NULL,NULL,'2025-06-28 21:59:17','2025-06-28 21:59:17'),(34,13,6,1,NULL,NULL,'2025-06-28 21:59:17','2025-06-28 21:59:17'),(35,13,7,1,NULL,NULL,'2025-06-28 21:59:17','2025-06-28 21:59:17'),(36,13,8,1,NULL,NULL,'2025-06-28 21:59:17','2025-06-28 21:59:17'),(37,14,1,5,NULL,NULL,'2025-06-28 21:59:48','2025-06-28 21:59:48'),(38,14,2,5,NULL,NULL,'2025-06-28 21:59:48','2025-06-28 21:59:48'),(39,14,3,1,NULL,NULL,'2025-06-28 21:59:48','2025-06-28 21:59:48'),(40,14,4,1,NULL,NULL,'2025-06-28 21:59:48','2025-06-28 21:59:48'),(41,14,5,1,NULL,NULL,'2025-06-28 21:59:48','2025-06-28 21:59:48'),(42,14,6,1,NULL,NULL,'2025-06-28 21:59:48','2025-06-28 21:59:48'),(43,14,7,1,NULL,NULL,'2025-06-28 21:59:48','2025-06-28 21:59:48'),(44,14,8,1,NULL,NULL,'2025-06-28 21:59:48','2025-06-28 21:59:48'),(45,15,1,5,NULL,NULL,'2025-06-28 22:00:17','2025-06-28 22:00:17'),(46,15,2,5,NULL,NULL,'2025-06-28 22:00:17','2025-06-28 22:00:17'),(47,15,3,1,NULL,NULL,'2025-06-28 22:00:17','2025-06-28 22:00:17'),(48,15,4,1,NULL,NULL,'2025-06-28 22:00:17','2025-06-28 22:00:17'),(49,15,5,1,NULL,NULL,'2025-06-28 22:00:17','2025-06-28 22:00:17'),(50,15,6,1,NULL,NULL,'2025-06-28 22:00:17','2025-06-28 22:00:17'),(51,15,7,1,NULL,NULL,'2025-06-28 22:00:17','2025-06-28 22:00:17'),(52,15,8,1,NULL,NULL,'2025-06-28 22:00:17','2025-06-28 22:00:17'),(53,16,1,1,NULL,NULL,'2025-06-28 22:18:48','2025-06-28 22:18:48'),(54,16,2,5,NULL,NULL,'2025-06-28 22:18:48','2025-06-28 22:18:48'),(55,16,3,1,NULL,NULL,'2025-06-28 22:18:48','2025-06-28 22:18:48'),(56,16,4,1,NULL,NULL,'2025-06-28 22:18:48','2025-06-28 22:18:48'),(57,16,5,1,NULL,NULL,'2025-06-28 22:18:48','2025-06-28 22:18:48'),(58,16,6,1,NULL,NULL,'2025-06-28 22:18:48','2025-06-28 22:18:48'),(59,16,7,1,NULL,NULL,'2025-06-28 22:18:48','2025-06-28 22:18:48'),(60,16,8,1,NULL,NULL,'2025-06-28 22:18:48','2025-06-28 22:18:48'),(61,17,1,1,NULL,NULL,'2025-07-02 00:53:08','2025-07-02 00:53:08'),(62,17,2,1,NULL,NULL,'2025-07-02 00:53:08','2025-07-02 00:53:08'),(63,17,3,1,NULL,NULL,'2025-07-02 00:53:08','2025-07-02 00:53:08'),(64,17,4,1,NULL,NULL,'2025-07-02 00:53:08','2025-07-02 00:53:08'),(65,17,5,1,NULL,NULL,'2025-07-02 00:53:08','2025-07-02 00:53:08'),(66,17,6,1,NULL,NULL,'2025-07-02 00:53:08','2025-07-02 00:53:08'),(67,17,7,1,NULL,NULL,'2025-07-02 00:53:08','2025-07-02 00:53:08'),(68,17,8,1,NULL,NULL,'2025-07-02 00:53:08','2025-07-02 00:53:08'),(69,18,1,1,NULL,NULL,'2025-07-17 20:00:33','2025-07-17 20:00:33'),(70,18,2,1,NULL,NULL,'2025-07-17 20:00:33','2025-07-17 20:00:33'),(71,18,3,2,5,NULL,'2025-07-17 20:00:33','2025-07-17 20:00:33'),(72,18,4,1,NULL,NULL,'2025-07-17 20:00:33','2025-07-17 20:00:33'),(73,18,5,1,NULL,NULL,'2025-07-17 20:00:33','2025-07-17 20:00:33'),(74,18,6,1,NULL,NULL,'2025-07-17 20:00:33','2025-07-17 20:00:33'),(75,18,7,1,NULL,NULL,'2025-07-17 20:00:33','2025-07-17 20:00:33'),(76,18,8,1,NULL,NULL,'2025-07-17 20:00:33','2025-07-17 20:00:33'),(77,18,20,1,NULL,NULL,'2025-07-17 20:00:33','2025-07-17 20:00:33'),(78,18,21,1,NULL,NULL,'2025-07-17 20:00:33','2025-07-17 20:00:33'),(79,18,22,1,NULL,NULL,'2025-07-17 20:00:33','2025-07-17 20:00:33'),(80,18,23,1,NULL,NULL,'2025-07-17 20:00:33','2025-07-17 20:00:33'),(81,18,24,1,NULL,NULL,'2025-07-17 20:00:33','2025-07-17 20:00:33'),(82,19,1,1,NULL,NULL,'2025-07-17 20:03:55','2025-07-17 20:03:55'),(83,19,2,1,NULL,NULL,'2025-07-17 20:03:55','2025-07-17 20:03:55'),(84,19,3,1,NULL,NULL,'2025-07-17 20:03:55','2025-07-17 20:03:55'),(85,19,4,1,NULL,NULL,'2025-07-17 20:03:55','2025-07-17 20:03:55'),(86,19,5,1,NULL,NULL,'2025-07-17 20:03:55','2025-07-17 20:03:55'),(87,19,6,1,NULL,NULL,'2025-07-17 20:03:55','2025-07-17 20:03:55'),(88,19,7,1,NULL,NULL,'2025-07-17 20:03:55','2025-07-17 20:03:55'),(89,19,8,1,NULL,NULL,'2025-07-17 20:03:55','2025-07-17 20:03:55'),(90,19,20,1,NULL,NULL,'2025-07-17 20:03:55','2025-07-17 20:03:55'),(91,19,21,1,NULL,NULL,'2025-07-17 20:03:55','2025-07-17 20:03:55'),(92,19,22,1,NULL,NULL,'2025-07-17 20:03:55','2025-07-17 20:03:55'),(93,19,23,1,NULL,NULL,'2025-07-17 20:03:55','2025-07-17 20:03:55'),(94,19,24,1,NULL,NULL,'2025-07-17 20:03:55','2025-07-17 20:03:55');
/*!40000 ALTER TABLE `attendance_list_students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance_lists`
--

DROP TABLE IF EXISTS `attendance_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendance_lists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code_al` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lecturer_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `student_class_id` bigint unsigned NOT NULL,
  `has_finished` tinyint NOT NULL DEFAULT '1',
  `date_finished` datetime DEFAULT NULL,
  `has_acc_kajur` tinyint NOT NULL DEFAULT '1',
  `date_acc_kajur` datetime DEFAULT NULL,
  `lecturer_kajur_id` bigint unsigned DEFAULT NULL,
  `periode_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendance_lists_lecturer_id_foreign` (`lecturer_id`),
  KEY `attendance_lists_course_id_foreign` (`course_id`),
  KEY `attendance_lists_student_class_id_foreign` (`student_class_id`),
  KEY `attendance_lists_lecturer_kajur_id_foreign` (`lecturer_kajur_id`),
  KEY `attendance_lists_periode_id_foreign` (`periode_id`),
  CONSTRAINT `attendance_lists_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attendance_lists_lecturer_id_foreign` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attendance_lists_lecturer_kajur_id_foreign` FOREIGN KEY (`lecturer_kajur_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attendance_lists_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periodes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attendance_lists_student_class_id_foreign` FOREIGN KEY (`student_class_id`) REFERENCES `student_classes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance_lists`
--

LOCK TABLES `attendance_lists` WRITE;
/*!40000 ALTER TABLE `attendance_lists` DISABLE KEYS */;
INSERT INTO `attendance_lists` VALUES (1,'6883760a-2908-4983-a461-96383d9380e9',1,5,5,2,'2025-06-25 14:55:21',2,'2025-06-25 14:55:44',1,8,'2025-06-25 05:40:33','2025-06-25 07:55:44'),(2,'d069e447-8648-4359-a723-34f68b349ba4',2,6,4,2,'2025-06-26 07:34:06',2,'2025-06-26 07:34:26',1,7,'2025-06-26 00:24:35','2025-06-26 00:34:26'),(3,'70818a89-ee39-41df-be1f-0fcca62bf30c',1,6,6,2,'2025-06-26 07:54:30',2,'2025-06-26 07:55:47',3,7,'2025-06-26 00:49:48','2025-06-26 00:55:47'),(5,'8a66f5f5-42d0-4ddc-b440-3a269a0b14d8',3,1,5,1,NULL,1,NULL,NULL,8,'2025-06-28 21:55:48','2025-06-28 21:58:03'),(7,'028e4f10-0450-4770-8290-686f33fb51e9',2,4,5,2,'2025-07-18 03:04:34',2,'2025-07-18 03:06:13',3,8,'2025-07-17 19:57:45','2025-07-17 20:06:13');
/*!40000 ALTER TABLE `attendance_lists` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Table structure for table `course_classes`
--

DROP TABLE IF EXISTS `course_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_classes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_class_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_classes_student_class_id_foreign` (`student_class_id`),
  KEY `course_classes_course_id_foreign` (`course_id`),
  CONSTRAINT `course_classes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `course_classes_student_class_id_foreign` FOREIGN KEY (`student_class_id`) REFERENCES `student_classes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_classes`
--

LOCK TABLES `course_classes` WRITE;
/*!40000 ALTER TABLE `course_classes` DISABLE KEYS */;
INSERT INTO `course_classes` VALUES (1,1,2,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(2,1,3,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(3,1,4,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(4,2,2,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(5,2,3,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(6,3,2,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(7,3,3,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(8,3,6,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(9,4,1,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(10,4,2,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(11,4,5,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(12,4,6,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(13,5,1,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(14,5,3,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(15,5,4,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(16,5,5,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(17,6,1,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(18,6,2,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(19,6,5,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(20,6,6,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(21,7,1,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(22,7,6,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(23,8,3,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(24,8,5,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(25,8,6,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(26,9,1,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(27,9,2,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(28,9,4,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(29,9,5,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(30,10,1,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(31,10,4,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(32,10,5,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(33,11,1,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(34,11,2,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(35,11,3,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(36,11,5,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(37,12,3,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(38,12,4,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(39,12,5,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(40,13,1,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(41,13,3,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(42,13,6,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49');
/*!40000 ALTER TABLE `course_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_lecturers`
--

DROP TABLE IF EXISTS `course_lecturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_lecturers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lecturer_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_lecturers_lecturer_id_foreign` (`lecturer_id`),
  KEY `course_lecturers_course_id_foreign` (`course_id`),
  CONSTRAINT `course_lecturers_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `course_lecturers_lecturer_id_foreign` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_lecturers`
--

LOCK TABLES `course_lecturers` WRITE;
/*!40000 ALTER TABLE `course_lecturers` DISABLE KEYS */;
INSERT INTO `course_lecturers` VALUES (1,1,3,'2025-06-26 00:41:08','2025-06-25 05:39:17','2025-06-26 00:41:08'),(2,1,4,'2025-06-26 00:41:08','2025-06-25 05:39:17','2025-06-26 00:41:08'),(3,1,5,'2025-06-26 00:41:08','2025-06-25 05:39:17','2025-06-26 00:41:08'),(4,1,6,'2025-06-26 00:41:08','2025-06-25 05:39:17','2025-06-26 00:41:08'),(5,2,3,'2025-06-25 07:52:50','2025-06-25 05:40:07','2025-06-25 07:52:50'),(6,2,4,'2025-06-25 07:52:50','2025-06-25 05:40:07','2025-06-25 07:52:50'),(7,2,5,'2025-06-25 07:52:50','2025-06-25 05:40:07','2025-06-25 07:52:50'),(8,2,6,'2025-06-25 07:52:50','2025-06-25 05:40:07','2025-06-25 07:52:50'),(9,2,3,NULL,'2025-06-25 07:52:50','2025-06-25 07:52:50'),(10,2,4,NULL,'2025-06-25 07:52:50','2025-06-25 07:52:50'),(11,2,5,NULL,'2025-06-25 07:52:50','2025-06-25 07:52:50'),(12,2,6,NULL,'2025-06-25 07:52:50','2025-06-25 07:52:50'),(13,1,3,NULL,'2025-06-26 00:41:08','2025-06-26 00:41:08'),(14,1,4,NULL,'2025-06-26 00:41:08','2025-06-26 00:41:08'),(15,1,5,NULL,'2025-06-26 00:41:08','2025-06-26 00:41:08'),(16,1,6,NULL,'2025-06-26 00:41:08','2025-06-26 00:41:08'),(17,3,3,'2025-06-28 21:55:08','2025-06-26 00:42:22','2025-06-28 21:55:08'),(18,3,1,NULL,'2025-06-28 21:55:08','2025-06-28 21:55:08'),(19,3,2,NULL,'2025-06-28 21:55:08','2025-06-28 21:55:08'),(20,3,3,NULL,'2025-06-28 21:55:08','2025-06-28 21:55:08'),(21,3,4,NULL,'2025-06-28 21:55:08','2025-06-28 21:55:08'),(22,3,5,NULL,'2025-06-28 21:55:08','2025-06-28 21:55:08'),(23,3,6,NULL,'2025-06-28 21:55:08','2025-06-28 21:55:08');
/*!40000 ALTER TABLE `course_lecturers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sks` int NOT NULL,
  `hours` int NOT NULL,
  `meeting` double DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'TBBTSX','praktikum','Pemrograman Web',2,30,6,NULL,'2025-06-25 05:36:49','2025-07-02 00:51:10'),(2,'DIN6GT','teori','Algoritma dan Struktur Data',3,24,4,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(3,'61EMRR','teori','Basis Data',3,24,12,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(4,'H34HRK','teori','Jaringan Komputer',3,24,2,NULL,'2025-06-25 05:36:49','2025-07-17 19:39:49'),(5,'YFFSW2','teori','Kecerdasan Buatan',2,16,2,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(6,'MXR2Q0','praktikum','Pemrograman Mobile',2,16,2,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
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
-- Table structure for table `jadwal`
--

DROP TABLE IF EXISTS `jadwal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwal` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `prodi_id` bigint unsigned DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jadwal_prodi_id_foreign` (`prodi_id`),
  CONSTRAINT `jadwal_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `study_programs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal`
--

LOCK TABLES `jadwal` WRITE;
/*!40000 ALTER TABLE `jadwal` DISABLE KEYS */;
INSERT INTO `jadwal` VALUES (1,1,'1750922353-Template-Import-Mahasiswa.xlsx','2025-06-26 00:19:15','2025-06-26 00:19:15');
/*!40000 ALTER TABLE `jadwal` ENABLE KEYS */;
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
-- Table structure for table `journal_details`
--

DROP TABLE IF EXISTS `journal_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `journal_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `journal_id` bigint unsigned NOT NULL,
  `attendance_list_detail_id` bigint unsigned NOT NULL,
  `material_course` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `learning_methods` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_acc_student` tinyint NOT NULL DEFAULT '1',
  `has_acc_lecturer` tinyint NOT NULL DEFAULT '1',
  `has_acc_kaprodi` tinyint NOT NULL DEFAULT '1',
  `student_id` bigint unsigned DEFAULT NULL,
  `lecturer_kaprodi_id` bigint unsigned DEFAULT NULL,
  `date_acc_student` datetime DEFAULT NULL,
  `date_acc_lecturer` datetime DEFAULT NULL,
  `date_acc_kaprodi` datetime DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `journal_details_journal_id_foreign` (`journal_id`),
  KEY `journal_details_attendance_list_detail_id_foreign` (`attendance_list_detail_id`),
  KEY `journal_details_student_id_foreign` (`student_id`),
  KEY `journal_details_lecturer_kaprodi_id_foreign` (`lecturer_kaprodi_id`),
  CONSTRAINT `journal_details_attendance_list_detail_id_foreign` FOREIGN KEY (`attendance_list_detail_id`) REFERENCES `attendance_list_details` (`id`) ON DELETE CASCADE,
  CONSTRAINT `journal_details_journal_id_foreign` FOREIGN KEY (`journal_id`) REFERENCES `journals` (`id`) ON DELETE CASCADE,
  CONSTRAINT `journal_details_lecturer_kaprodi_id_foreign` FOREIGN KEY (`lecturer_kaprodi_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `journal_details_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journal_details`
--

LOCK TABLES `journal_details` WRITE;
/*!40000 ALTER TABLE `journal_details` DISABLE KEYS */;
INSERT INTO `journal_details` VALUES (1,1,1,'hsbcjhds','Offline',2,2,2,8,2,'2025-06-25 14:51:26','2025-06-25 14:49:23','2025-06-25 14:53:43',NULL,'2025-06-25 07:42:20','2025-06-25 07:53:43'),(2,1,2,'ncjdsf85734','Online',2,2,2,8,2,'2025-06-25 14:51:29','2025-06-25 14:49:43','2025-06-25 14:53:43',NULL,'2025-06-25 07:42:38','2025-06-25 07:53:43'),(3,2,3,'Belajar kotlin','Offline',2,2,2,9,2,'2025-06-26 07:29:56','2025-06-26 07:27:01','2025-06-26 07:32:27',NULL,'2025-06-26 00:26:16','2025-06-26 00:32:27'),(4,2,4,'Belajar Mobile','Offline',2,2,2,9,2,'2025-06-26 07:33:43','2025-06-26 07:33:29','2025-06-26 07:33:50',NULL,'2025-06-26 00:33:07','2025-06-26 00:33:50'),(5,3,5,'Belajar','Offline',2,2,2,19,1,'2025-06-26 07:52:50','2025-06-26 07:52:34','2025-06-26 07:53:10',NULL,'2025-06-26 00:50:27','2025-06-26 00:53:10'),(6,3,6,'Belajar MVC','Offline',2,2,2,19,1,'2025-06-26 07:54:11','2025-06-26 07:53:51','2025-06-26 07:54:17',NULL,'2025-06-26 00:53:45','2025-06-26 00:54:17'),(12,5,12,'Belajar','Offline',2,2,1,8,NULL,'2025-07-02 07:56:43','2025-06-29 04:58:48',NULL,NULL,'2025-06-28 21:58:32','2025-07-02 00:56:43'),(13,5,13,'Belajar MVC','Offline',2,2,1,8,NULL,'2025-07-02 07:56:48','2025-06-29 04:59:17',NULL,NULL,'2025-06-28 21:59:07','2025-07-02 00:56:48'),(14,5,14,'Belajar MVC','Offline',2,2,1,8,NULL,'2025-07-02 07:56:53','2025-06-29 04:59:48',NULL,NULL,'2025-06-28 21:59:37','2025-07-02 00:56:53'),(15,5,15,'Belajar MVC','Offline',2,2,1,8,NULL,'2025-07-02 07:56:59','2025-06-29 05:00:17',NULL,NULL,'2025-06-28 22:00:06','2025-07-02 00:56:59'),(16,5,16,'Belajar MVC','Offline',2,2,1,8,NULL,'2025-07-02 07:57:15','2025-06-29 05:18:48',NULL,NULL,'2025-06-28 22:18:35','2025-07-02 00:57:15'),(17,5,17,'Bebas','Offline',1,2,1,NULL,NULL,NULL,'2025-07-02 07:53:08',NULL,NULL,'2025-07-02 00:52:39','2025-07-02 00:53:08'),(18,7,18,'Belajar Routing','Offline',2,2,2,24,2,'2025-07-18 03:02:34','2025-07-18 03:00:33','2025-07-18 03:04:17',NULL,'2025-07-17 19:59:56','2025-07-17 20:04:17'),(19,7,19,'Belajar MVC','Offline',2,2,2,24,2,'2025-07-18 03:04:05','2025-07-18 03:03:55','2025-07-18 03:04:17',NULL,'2025-07-17 20:03:47','2025-07-17 20:04:17');
/*!40000 ALTER TABLE `journal_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `journals`
--

DROP TABLE IF EXISTS `journals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `journals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `attendance_list_id` bigint unsigned NOT NULL,
  `has_finished` tinyint NOT NULL DEFAULT '1',
  `has_acc_kajur` tinyint NOT NULL DEFAULT '1',
  `lecturer_kajur_id` bigint unsigned DEFAULT NULL,
  `date_finished` datetime DEFAULT NULL,
  `date_acc_kajur` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `journals_attendance_list_id_foreign` (`attendance_list_id`),
  KEY `journals_lecturer_kajur_id_foreign` (`lecturer_kajur_id`),
  CONSTRAINT `journals_attendance_list_id_foreign` FOREIGN KEY (`attendance_list_id`) REFERENCES `attendance_lists` (`id`) ON DELETE CASCADE,
  CONSTRAINT `journals_lecturer_kajur_id_foreign` FOREIGN KEY (`lecturer_kajur_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journals`
--

LOCK TABLES `journals` WRITE;
/*!40000 ALTER TABLE `journals` DISABLE KEYS */;
INSERT INTO `journals` VALUES (1,1,2,2,1,'2025-06-25 14:55:21','2025-06-25 14:55:44','2025-06-25 05:40:33','2025-06-25 07:55:44'),(2,2,2,2,1,'2025-06-26 07:34:06','2025-06-26 07:34:26','2025-06-26 00:24:35','2025-06-26 00:34:26'),(3,3,2,2,3,'2025-06-26 07:54:30','2025-06-26 07:55:47','2025-06-26 00:49:48','2025-06-26 00:55:47'),(5,5,1,1,NULL,NULL,NULL,'2025-06-28 21:55:48','2025-06-28 21:55:48'),(7,7,2,2,3,'2025-07-18 03:04:34','2025-07-18 03:06:13','2025-07-17 19:57:45','2025-07-17 20:06:13');
/*!40000 ALTER TABLE `journals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lecturers`
--

DROP TABLE IF EXISTS `lecturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lecturers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nidn` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `position_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lecturers_user_id_foreign` (`user_id`),
  KEY `lecturers_position_id_foreign` (`position_id`),
  CONSTRAINT `lecturers_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lecturers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lecturers`
--

LOCK TABLES `lecturers` WRITE;
/*!40000 ALTER TABLE `lecturers` DISABLE KEYS */;
INSERT INTO `lecturers` VALUES (1,'joko','94583857843','Jalan','signatures/jdPgqpSwjwn3gKeJRpcQny2RyE2Ow7zEmKk0JvGL.jpg','08744765','948327435',2,3,NULL,'2025-06-25 05:39:17','2025-06-26 00:41:07'),(2,'Rahmat','074335468','Jalan','signatures/z5QoInKwxzZj82OTlO9igAEWAGxJgChMDPnoQzJP.jpg','9947647654','948389567',3,2,NULL,'2025-06-25 05:40:07','2025-06-26 00:35:49'),(3,'Annas','088233642596','Lingkar timur',NULL,'4756783567','645865867967',22,1,NULL,'2025-06-26 00:42:22','2025-06-26 00:42:22');
/*!40000 ALTER TABLE `lecturers` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_07_29_163322_create_study_programs_table',1),(5,'2024_07_29_163522_create_student_classes_table',1),(6,'2024_07_29_163609_create_positions_table',1),(7,'2024_07_29_163623_create_courses_table',1),(8,'2024_07_29_163638_create_students_table',1),(9,'2024_07_29_163650_create_lecturers_table',1),(10,'2024_07_30_142717_create_course_lecturers_table',1),(11,'2024_07_30_144221_create_course_classes_table',1),(12,'2024_07_30_163726_create_periodes_table',1),(13,'2024_07_30_163727_create_attendence_lists_table',1),(14,'2024_07_30_163736_create_attendence_list_details_table',1),(15,'2024_07_30_163737_create_attendence_list_students',1),(16,'2024_07_30_164958_create_permission_tables',1),(17,'2024_09_08_043544_create_journal',1),(18,'2024_09_08_043913_create_journal_detail',1),(19,'2025_05_22_145519_create_jadwal',1);
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
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2),(2,'App\\Models\\User',3),(3,'App\\Models\\User',4),(3,'App\\Models\\User',5),(3,'App\\Models\\User',6),(3,'App\\Models\\User',7),(3,'App\\Models\\User',8),(3,'App\\Models\\User',9),(3,'App\\Models\\User',10),(3,'App\\Models\\User',11),(3,'App\\Models\\User',12),(3,'App\\Models\\User',13),(3,'App\\Models\\User',14),(3,'App\\Models\\User',15),(3,'App\\Models\\User',16),(3,'App\\Models\\User',17),(3,'App\\Models\\User',18),(3,'App\\Models\\User',19),(3,'App\\Models\\User',20),(3,'App\\Models\\User',21),(2,'App\\Models\\User',22),(3,'App\\Models\\User',23),(3,'App\\Models\\User',24),(3,'App\\Models\\User',25),(3,'App\\Models\\User',26),(3,'App\\Models\\User',27),(3,'App\\Models\\User',28);
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
-- Table structure for table `periodes`
--

DROP TABLE IF EXISTS `periodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periodes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tahun` int NOT NULL,
  `tahun_akademik` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `tanggal_batas_awal` date NOT NULL,
  `tanggal_batas_akhir` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodes`
--

LOCK TABLES `periodes` WRITE;
/*!40000 ALTER TABLE `periodes` DISABLE KEYS */;
INSERT INTO `periodes` VALUES (1,2022,'2022/2023','Ganjil',0,'2022-07-01','2022-12-31','2025-06-25 05:36:49','2025-06-26 00:19:18'),(2,2022,'2022/2023','Genap',0,'2023-01-01','2023-06-30','2025-06-25 05:36:49','2025-06-26 00:19:18'),(3,2023,'2023/2024','Ganjil',0,'2023-07-01','2023-12-31','2025-06-25 05:36:49','2025-06-26 00:19:18'),(4,2023,'2023/2024','Genap',0,'2024-01-01','2024-06-30','2025-06-25 05:36:49','2025-06-26 00:19:18'),(5,2024,'2024/2025','Ganjil',0,'2024-07-01','2024-12-31','2025-06-25 05:36:49','2025-06-26 00:19:18'),(6,2024,'2024/2025','Genap',0,'2025-01-01','2025-06-30','2025-06-25 05:36:49','2025-07-17 19:47:23'),(7,2025,'2025/2026','Ganjil',1,'2025-07-01','2025-12-31','2025-06-25 05:36:49','2025-06-25 05:36:49'),(8,2025,'2025/2026','Genap',1,'2026-01-01','2026-06-30','2025-06-25 05:36:49','2025-06-25 05:36:49'),(9,2026,'2026/2027','Ganjil',1,'2026-01-01','2026-08-31','2025-06-26 00:19:53','2025-06-26 00:19:53');
/*!40000 ALTER TABLE `periodes` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `positions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `positions_prodi_id_foreign` (`prodi_id`),
  CONSTRAINT `positions_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `study_programs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` VALUES (1,'Kepala Jurusan',NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(2,'Koordinator Program Studi',1,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(3,'Koordinator Program Studi',2,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(4,'Koordinator Program Studi',3,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(5,'Koordinator Program Studi',4,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(6,'Koordinator Program Studi',5,'2025-06-25 05:36:49','2025-06-25 05:36:49');
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'super_admin','web','2025-06-25 05:36:49','2025-06-25 05:36:49'),(2,'dosen','web','2025-06-25 05:36:49','2025-06-25 05:36:49'),(3,'mahasiswa','web','2025-06-25 05:36:49','2025-06-25 05:36:49');
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
INSERT INTO `sessions` VALUES ('8GqyVUs7yU8lyEKHcurZPjuZ22PCIC6yR7mQcHli',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVTR6YXFON1QzY1lqdWNMZVNxZzNTNWhmUnRJdmQwY2h6M1JXQ2JieiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kb2t1bWVuLXBlcmt1bGlhaGFuL2RhZnRhci9kYWZ0YXItaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1753106018),('Cg6sANszoG6ZtdERhtTw1dlv4sIeeITmQRmoZ26L',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY1FybjZ0dTFRbVdvSmJQdU1WV1ZWOVVudnRpT01TT3FPYUVDWFdUNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kL2Rva3VtZW4tcGVya3VsaWFoYW4vZGV0YWlscy83Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9',1752807878),('Lf9FZU6ZGSkMfd0eunm65ucFg9O11tWnESh5rxvv',22,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMmNtVDgzZWdYOElpeHpZSFRRZnFTaGNQNm9oa3gyVERTZHpXMjJKeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kL2RhZnRhci1wZXJzZXR1anVhbi1kb2t1bWVuL2RldGFpbC83Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjI7fQ==',1752807974),('Y0JUT2vWisP9lFcQ5mLGCF2C9R57jU5ZmaNiKrvj',28,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVzhPRmhZaFRXQlphcG50WnJZQk50SUR6MGowWHRxd3NXM1RvNE5PdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tL2Rva3VtZW4tcGVya3VsaWFoYW4vZGV0YWlscy83Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjg7fQ==',1752807846),('ytrWTHz1uVJybY1o0fsWED31ShH1fJjmc2lheauK',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNGNHTzVYa0ZFZGhieXNiM3hsMEZTb1h6d09oVURudWN5YVh2QUJqRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=',1752808070);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_classes`
--

DROP TABLE IF EXISTS `student_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_classes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_year` int NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=tidak aktif, 1 aktif',
  `study_program_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_classes_code_unique` (`code`),
  KEY `student_classes_study_program_id_foreign` (`study_program_id`),
  CONSTRAINT `student_classes_study_program_id_foreign` FOREIGN KEY (`study_program_id`) REFERENCES `study_programs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_classes`
--

LOCK TABLES `student_classes` WRITE;
/*!40000 ALTER TABLE `student_classes` DISABLE KEYS */;
INSERT INTO `student_classes` VALUES (1,'A','TIA2022','1',2022,1,1,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(2,'B','TIB2022','1',2022,1,1,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(3,'A','TIA2023','1',2023,1,1,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(4,'B','TIB2023','1',2023,1,1,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(5,'C','TIC2023','1',2023,1,1,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(6,'A','ALKSA2022','1',2022,1,2,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(7,'A','RKSA2022','1',2022,1,3,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(8,'B','RKSB2022','1',2022,1,3,NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(9,'C','RKSC2022','3',2022,1,3,NULL,'2025-06-25 05:36:49','2025-06-26 00:20:15'),(10,'A','TRMA2023','2',2023,1,4,NULL,'2025-06-25 05:36:49','2025-06-26 00:20:15'),(11,'B','TRMB2023','2',2023,1,4,NULL,'2025-06-25 05:36:49','2025-06-26 00:20:15'),(12,'A','RPLA2023','2',2023,1,5,NULL,'2025-06-25 05:36:49','2025-06-26 00:20:15'),(13,'B','RPLB2023','2',2023,1,5,NULL,'2025-06-25 05:36:49','2025-06-26 00:20:15');
/*!40000 ALTER TABLE `student_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nim` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `student_class_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_nim_unique` (`nim`),
  KEY `students_user_id_foreign` (`user_id`),
  KEY `students_student_class_id_foreign` (`student_class_id`),
  CONSTRAINT `students_student_class_id_foreign` FOREIGN KEY (`student_class_id`) REFERENCES `student_classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'90909','Joko','jalan',NULL,'098760',4,5,NULL,'2025-06-25 07:19:41','2025-06-25 07:19:41'),(2,'22010202','Adisa1','Jalan Kenanga',NULL,'865735578',5,5,NULL,'2025-06-25 07:47:37','2025-06-25 07:47:37'),(3,'22010203','Adisa2','Jalan jalan',NULL,'865735578',6,5,NULL,'2025-06-25 07:47:38','2025-06-25 07:47:38'),(4,'22010204','Adisa3','Jalan jalan',NULL,'865735578',7,5,NULL,'2025-06-25 07:47:38','2025-06-25 07:47:38'),(5,'22010205','Adisa4','Jalan jalan',NULL,'865735578',8,5,NULL,'2025-06-25 07:47:39','2025-06-25 07:47:39'),(6,'22010206','Adisa5','Jalan jalan',NULL,'865735578',9,5,NULL,'2025-06-25 07:47:39','2025-06-25 07:47:39'),(7,'22010207','Adisa6','Jalan jalan',NULL,'865735578',10,5,NULL,'2025-06-25 07:47:39','2025-06-25 07:47:39'),(8,'22010208','Adisa7','Jalan jalan',NULL,'865735578',11,5,NULL,'2025-06-25 07:47:40','2025-06-25 07:47:40'),(9,'22010209','Adisa8','Jalan jalan','signatures/yNNQVvLxwWJuniV4fxH9iA9D6SJcQA0WR5EiGcHq.jpg','865735578',12,4,NULL,'2025-06-25 07:47:40','2025-06-26 00:29:00'),(10,'22010219','Adisa18','Jalan jalan',NULL,'865735578',13,3,NULL,'2025-06-25 07:47:41','2025-06-25 07:47:41'),(11,'22010220','Adisa19','Jalan jalan',NULL,'865735578',14,3,NULL,'2025-06-25 07:47:41','2025-06-25 07:47:41'),(12,'22010221','Adisa20','Jalan jalan',NULL,'865735578',15,3,NULL,'2025-06-25 07:47:41','2025-06-25 07:47:41'),(13,'22010222','Adisa21','Jalan jalan',NULL,'865735578',16,3,NULL,'2025-06-25 07:47:42','2025-06-25 07:47:42'),(14,'22010223','Adisa22','Jalan jalan',NULL,'865735578',17,3,NULL,'2025-06-25 07:47:42','2025-06-25 07:47:42'),(15,'22010224','Adisa23','Jalan jalan',NULL,'865735578',18,3,NULL,'2025-06-25 07:47:43','2025-06-25 07:47:43'),(16,'22010225','Adisa24','Jalan jalan',NULL,'865735578',19,3,NULL,'2025-06-25 07:47:43','2025-06-25 07:47:43'),(17,'22010226','Adisa25','Jalan jalan',NULL,'865735578',20,3,NULL,'2025-06-25 07:47:43','2025-06-25 07:47:43'),(18,'22010227','Adisa26','Jalan jalan',NULL,'865735578',21,3,NULL,'2025-06-25 07:47:44','2025-06-25 07:47:44'),(19,'22010283','Adisa100','Lingkar timur',NULL,'088233642596',23,6,NULL,'2025-06-26 00:51:54','2025-06-26 00:51:54'),(20,'76545787','Adisaa','Jl kangkung',NULL,'087556787654',24,5,NULL,'2025-07-17 19:55:41','2025-07-17 19:55:41'),(21,'76545788','Adisaa2','Jl kangkung',NULL,'87556787655',25,5,NULL,'2025-07-17 19:55:41','2025-07-17 19:55:41'),(22,'76545789','Adisaa3','Jl kangkung',NULL,'87556787656',26,5,NULL,'2025-07-17 19:55:41','2025-07-17 19:55:41'),(23,'76545790','Adisaa4','Jl kangkung',NULL,'87556787657',27,5,NULL,'2025-07-17 19:55:42','2025-07-17 19:55:42'),(24,'76545791','Adisaa5','Jl kangkung',NULL,'87556787658',28,5,NULL,'2025-07-17 19:55:42','2025-07-17 19:55:42');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `study_programs`
--

DROP TABLE IF EXISTS `study_programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `study_programs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jenjang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brief` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `study_programs`
--

LOCK TABLES `study_programs` WRITE;
/*!40000 ALTER TABLE `study_programs` DISABLE KEYS */;
INSERT INTO `study_programs` VALUES (1,'D3','Teknik Informatika','TI','2025-06-25 05:36:49','2025-06-25 05:36:49'),(2,'D4','Akuntansi Lembaga Keuangan Syariah','ALKS','2025-06-25 05:36:49','2025-06-25 05:36:49'),(3,'D4','Rekayasa Keamanan Siber','RKS','2025-06-25 05:36:49','2025-06-25 05:36:49'),(4,'D4','Teknologi Rekayasa Multimedia','TRM','2025-06-25 05:36:49','2025-06-25 05:36:49'),(5,'D4','Rekayasa Perangkat Lunak','RPL','2025-06-25 05:36:49','2025-06-25 05:36:49');
/*!40000 ALTER TABLE `study_programs` ENABLE KEYS */;
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
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Adisa L',NULL,'adisa@admin.com',NULL,'$2y$12$VFX23D8MfbKB3W9v8hHSRe85Xqfp7nNt4CjP9BLUk947MHdCLlyoy',NULL,'2025-06-25 05:36:49','2025-06-25 05:36:49'),(2,'08744765',NULL,'08744765@pnc.ac.id',NULL,'$2y$12$UTk.Q8DApHCwf4/l/MFcv.gJILQ1c.zOeH0J4qj3TMdT0E3BtY0xW',NULL,'2025-06-25 05:39:17','2025-06-26 00:41:08'),(3,'Rahmat',NULL,'9947647654@pnc.ac.id',NULL,'$2y$12$bWFmXX7zJiEb8XBII7Vnpu39gWbyeb.OB4wZYH30rufHeexjgmNyS',NULL,'2025-06-25 05:40:07','2025-07-17 19:45:14'),(4,'09753836',NULL,'09753836@pnc.ac.id',NULL,'$2y$12$WunzbNErJvF28p87zPIybO1xJQwU3xqCfpZbeJY.FMGYiRahKf1A6',NULL,'2025-06-25 07:19:41','2025-06-25 07:19:41'),(5,'Adisa1',' ','22010202@pnc.ac.id',NULL,'$2y$12$JxcHtBhhwhfDpWboVOmwhe1FdLnsENKyvTYHftufdLpzLyG6GvOnm',NULL,'2025-06-25 07:47:37','2025-07-02 03:47:26'),(6,'Adisa2',' ','22010203@pnc.ac.id',NULL,'$2y$12$tfzH3Dx0otcW0OQW2Lm1luwR/x60yB75LFl7t8b6eYsHYvQdnMJdG',NULL,'2025-06-25 07:47:38','2025-06-25 07:47:38'),(7,'Adisa3',' ','22010204@pnc.ac.id',NULL,'$2y$12$sLCO3y2cCUXV9qRhIZzLau.LyEnsZUpqPSgWCHpOfuGtqKhlzZq7G',NULL,'2025-06-25 07:47:38','2025-06-25 07:47:38'),(8,'Adisa4',' ','22010205@pnc.ac.id',NULL,'$2y$12$9LWut1d2acU07dfXDMkFzeOKmtvulsvGXI1HXFpDaJ6AUFdenKCG.',NULL,'2025-06-25 07:47:39','2025-06-25 07:47:39'),(9,'Adisa5',' ','22010206@pnc.ac.id',NULL,'$2y$12$XPQxEN7x7NXJBrbwVVxBy.XwR9FLL7DRbls/SgC8n9vYH6e94bJbG',NULL,'2025-06-25 07:47:39','2025-06-25 07:47:39'),(10,'Adisa6',' ','22010207@pnc.ac.id',NULL,'$2y$12$DWGVPmzrtlYiooGHdEsmPeb365wIWaVN.8UmVQ8Yz7pzuG8w6qXOq',NULL,'2025-06-25 07:47:39','2025-07-02 01:09:02'),(11,'Adisa7',' ','22010208@pnc.ac.id',NULL,'$2y$12$3c5jRD727yTmhYcQD9BdOuUYZy/9RpNuacU8.cqceNTIgtUaQjGVq',NULL,'2025-06-25 07:47:40','2025-07-02 00:56:25'),(12,'Adisa8',' ','22010209@pnc.ac.id',NULL,'$2y$12$.I5ypJ9niqdloHlCroYbvO8FFAsd4LFgnXl/aW9KdQXA8NnLc49Gy',NULL,'2025-06-25 07:47:40','2025-06-25 07:47:40'),(13,'Adisa18',' ','22010219@pnc.ac.id',NULL,'$2y$12$YstxiNRKqoPhXRfapd2WoO/9tggrrH/QaEHEYfNM.bE4025JLY9l.',NULL,'2025-06-25 07:47:41','2025-06-25 07:47:41'),(14,'Adisa19',' ','22010220@pnc.ac.id',NULL,'$2y$12$3nOnAan7BrlOQOq5/8OaW.PDdTDVqQ6nsRq5MDkwWrQgXsK3DwgjS',NULL,'2025-06-25 07:47:41','2025-06-25 07:47:41'),(15,'Adisa20',' ','22010221@pnc.ac.id',NULL,'$2y$12$d8rah1cox6rYyqW4St2jGOxwKOUcYbQBNwyqu8j7NwSmm819Dyroq',NULL,'2025-06-25 07:47:41','2025-06-25 07:47:41'),(16,'Adisa21',' ','22010222@pnc.ac.id',NULL,'$2y$12$Olkuwm459ke/W85NAbWDbOxJ1EsGj3CcF8Ap8BgnLIbmbQCerHaya',NULL,'2025-06-25 07:47:42','2025-06-25 07:47:42'),(17,'Adisa22',' ','22010223@pnc.ac.id',NULL,'$2y$12$K4d8h.OOts9zCqt8mjxzZeHRBpIeWCfR0XjsdhCL.3MKpFrneZIQ6',NULL,'2025-06-25 07:47:42','2025-06-25 07:47:42'),(18,'Adisa23',' ','22010224@pnc.ac.id',NULL,'$2y$12$uS.7H1rYuF7ZGU6ahGCsE.3blZH1qVGOHn0FltbnTrscM/a35S9bG',NULL,'2025-06-25 07:47:43','2025-06-25 07:47:43'),(19,'Adisa24',' ','22010225@pnc.ac.id',NULL,'$2y$12$WWC42TxUw065KsYEROlTUu2HFDl9n5uurQ9ZzCq.vtX5b1Z8ZHDzq',NULL,'2025-06-25 07:47:43','2025-06-28 23:43:10'),(20,'Adisa25',' ','22010226@pnc.ac.id',NULL,'$2y$12$Z7OncrYMOKm5BrqsEB.dBuJuEzizkdHkBkT5703iDho23GipyPqT6',NULL,'2025-06-25 07:47:43','2025-06-29 00:00:46'),(21,'Adisa26',' ','22010227@pnc.ac.id',NULL,'$2y$12$I31p.sLZjrCH0k0NLkUv6O3AWOfSGoF1sSQIIRox2.AWgPP0lufgK',NULL,'2025-06-25 07:47:44','2025-07-02 02:08:34'),(22,'4756783567',NULL,'4756783567@pnc.ac.id',NULL,'$2y$12$OptX1QN8lpNrTbrbFS6JmevRiVFrd.FZ5ifO/MNRUbAvOmKbmv0zq',NULL,'2025-06-26 00:42:22','2025-07-02 00:49:49'),(23,'22010283',NULL,'22010283@pnc.ac.id',NULL,'$2y$12$9y/DbFODJHs95Ox2k1L6FOu07nanjonyuqPNXtzCgvUsoHMHE1RgK',NULL,'2025-06-26 00:51:54','2025-06-26 01:12:13'),(24,'Adisaa',' ','76545787@pnc.ac.id',NULL,'$2y$12$py9VZC4X7fhSaLzU6sHPIulKRImsMbZT5nFP2GtfEjouO3NkVgdFa',NULL,'2025-07-17 19:55:41','2025-07-17 19:55:41'),(25,'Adisaa2',' ','76545788@pnc.ac.id',NULL,'$2y$12$Bqk9OE/9zykhNSVL0DkD9ecqwYaZ/KYj/q980axbe3mEr9MueIXE2',NULL,'2025-07-17 19:55:41','2025-07-17 19:55:41'),(26,'Adisaa3',' ','76545789@pnc.ac.id',NULL,'$2y$12$Hh45sL5wAYe5BLaGM0/zK.8k4Frqa3BXh7qP5sebVOge/gt/O0qTq',NULL,'2025-07-17 19:55:41','2025-07-17 19:55:41'),(27,'Adisaa4',' ','76545790@pnc.ac.id',NULL,'$2y$12$3q2Y1Uc/fTOjIXtj9giS6Oz/GKrdk/BsIthzmmQ6Ttq0GG9O6TZU2',NULL,'2025-07-17 19:55:42','2025-07-17 19:55:42'),(28,'Adisaa5',' ','76545791@pnc.ac.id',NULL,'$2y$12$l8os33zasHHum8fxld2FH.3D78W2FUiD5RAFpdlZoLwWBFJqVWDaK',NULL,'2025-07-17 19:55:42','2025-07-17 20:02:06');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'siperkuliahan'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-04 19:17:02
