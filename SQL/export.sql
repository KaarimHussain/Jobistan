-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: job_website
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `ai_image_detection`
--

DROP TABLE IF EXISTS `ai_image_detection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ai_image_detection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `detection_result` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `ai_image_detection_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ai_image_detection`
--

LOCK TABLES `ai_image_detection` WRITE;
/*!40000 ALTER TABLE `ai_image_detection` DISABLE KEYS */;
/*!40000 ALTER TABLE `ai_image_detection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `analytics`
--

DROP TABLE IF EXISTS `analytics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `analytics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `metric_name` varchar(255) NOT NULL,
  `metric_value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `analytics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `analytics`
--

LOCK TABLES `analytics` WRITE;
/*!40000 ALTER TABLE `analytics` DISABLE KEYS */;
/*!40000 ALTER TABLE `analytics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_seeker_id` int(11) NOT NULL,
  `job_listing_id` int(11) NOT NULL,
  `status` enum('applied','viewed','interviewing','hired','rejected') DEFAULT 'applied',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `job_seeker_id` (`job_seeker_id`),
  KEY `job_listing_id` (`job_listing_id`),
  CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`job_seeker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`job_listing_id`) REFERENCES `job_listings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applied_jobs`
--

DROP TABLE IF EXISTS `applied_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applied_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `applied_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `job_id` (`job_id`),
  CONSTRAINT `applied_jobs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `applied_jobs_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job_listings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applied_jobs`
--

LOCK TABLES `applied_jobs` WRITE;
/*!40000 ALTER TABLE `applied_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `applied_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup_applications`
--

DROP TABLE IF EXISTS `backup_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `backup_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_seeker_id` int(11) NOT NULL,
  `job_listing_id` int(11) NOT NULL,
  `status` enum('applied','viewed','interviewing','hired','rejected') DEFAULT 'applied',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `job_seeker_id` (`job_seeker_id`),
  KEY `job_listing_id` (`job_listing_id`),
  CONSTRAINT `backup_applications_ibfk_2` FOREIGN KEY (`job_listing_id`) REFERENCES `job_listings` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_applications`
--

LOCK TABLES `backup_applications` WRITE;
/*!40000 ALTER TABLE `backup_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `backup_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup_companies_applied_jobs`
--

DROP TABLE IF EXISTS `backup_companies_applied_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `backup_companies_applied_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `employers_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_companies_applied_jobs`
--

LOCK TABLES `backup_companies_applied_jobs` WRITE;
/*!40000 ALTER TABLE `backup_companies_applied_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `backup_companies_applied_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup_employer_profiles`
--

DROP TABLE IF EXISTS `backup_employer_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `backup_employer_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_description` text DEFAULT NULL,
  `company_culture` text DEFAULT NULL,
  `company_benefits` text DEFAULT NULL,
  `company_logo` longblob DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_employer_profiles`
--

LOCK TABLES `backup_employer_profiles` WRITE;
/*!40000 ALTER TABLE `backup_employer_profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `backup_employer_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup_external_user_resume`
--

DROP TABLE IF EXISTS `backup_external_user_resume`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `backup_external_user_resume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_experience` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_external_user_resume`
--

LOCK TABLES `backup_external_user_resume` WRITE;
/*!40000 ALTER TABLE `backup_external_user_resume` DISABLE KEYS */;
/*!40000 ALTER TABLE `backup_external_user_resume` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup_messages`
--

DROP TABLE IF EXISTS `backup_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `backup_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `messages` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_messages`
--

LOCK TABLES `backup_messages` WRITE;
/*!40000 ALTER TABLE `backup_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `backup_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup_profiles`
--

DROP TABLE IF EXISTS `backup_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `backup_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_picture` longblob DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_profiles`
--

LOCK TABLES `backup_profiles` WRITE;
/*!40000 ALTER TABLE `backup_profiles` DISABLE KEYS */;
INSERT INTO `backup_profiles` VALUES (2,2,'Asim','03173009130','abc Karachi',_binary 'UserUploads/3.png','2024-08-06 10:30:37','2024-08-06 10:32:10'),(8,4,'Kaarim Hussain','03173009130','Surjani Town Karachi',_binary 'UserUploads/WhatsApp Image 2023-10-16 at 19.55.57_56b08e1c.jpg','2024-08-06 10:37:24','2024-08-06 10:56:50');
/*!40000 ALTER TABLE `backup_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup_resume_data`
--

DROP TABLE IF EXISTS `backup_resume_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `backup_resume_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `education` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_resume_data`
--

LOCK TABLES `backup_resume_data` WRITE;
/*!40000 ALTER TABLE `backup_resume_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `backup_resume_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup_user_work_experience`
--

DROP TABLE IF EXISTS `backup_user_work_experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `backup_user_work_experience` (
  `work_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL DEFAULT 'Undefined',
  `work_description` text DEFAULT NULL,
  `company_start_date` date NOT NULL,
  `company_end_date` date NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`work_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_user_work_experience`
--

LOCK TABLES `backup_user_work_experience` WRITE;
/*!40000 ALTER TABLE `backup_user_work_experience` DISABLE KEYS */;
/*!40000 ALTER TABLE `backup_user_work_experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup_workers_resume`
--

DROP TABLE IF EXISTS `backup_workers_resume`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `backup_workers_resume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `resume_file` longblob NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_workers_resume`
--

LOCK TABLES `backup_workers_resume` WRITE;
/*!40000 ALTER TABLE `backup_workers_resume` DISABLE KEYS */;
INSERT INTO `backup_workers_resume` VALUES (4,4,_binary './UserResume/Kaarim Hussain_Resume.pdf',1);
/*!40000 ALTER TABLE `backup_workers_resume` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `community_post`
--

DROP TABLE IF EXISTS `community_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `community_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_content` text NOT NULL,
  `post_image` longblob DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `community_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `community_post`
--

LOCK TABLES `community_post` WRITE;
/*!40000 ALTER TABLE `community_post` DISABLE KEYS */;
INSERT INTO `community_post` VALUES (1,'What will be the mostly used programming Languages that are used by Developer in upcoming years\r\n\r\nNEXT.JS\r\nGO\r\nRUST\r\nJAVASCRIPT\r\nAI/ML',NULL,5,'2024-08-06 13:25:04'),(2,'Chuss na Maro',NULL,6,'2024-08-08 21:53:22'),(3,'The Community &amp; The Inbox Page are completed and are ready to Run\r\n\r\nCheck them out',_binary './CommunityPostImage/pexels-sulimansallehi-1704488.jpg',6,'2024-08-11 12:09:23'),(4,'Hey Guys New Here\r\nHow it&#039;s going on\r\nAny React Developer -&gt; connect here',NULL,11,'2024-08-11 17:37:08'),(5,'HI THERE',_binary './CommunityPostImage/bg3.png',12,'2024-08-13 10:18:19'),(6,'Checking Order by',NULL,5,'2024-08-14 12:00:01'),(7,'WE ARE PLEASED TO ANNOUNCE THAT Aptech North Nazimabad HAS SUCCESSFULLY HIRED owais khan AFTER CLEARING THE INTERVIEW. WE ARE LOOKING FORWARD FOR MANY MORE',_binary './Resources/JOBISTANLOGO/hired_image.png',6,'2024-08-15 19:42:41'),(8,'WE ARE PLEASED TO ANNOUNCE THAT Aptech North Nazimabad HAS SUCCESSFULLY HIRED Muhammad Kaarim Hussain AFTER CLEARING THE INTERVIEW. WE ARE LOOKING FORWARD FOR MANY MORE',_binary './Resources/JOBISTANLOGO/hired_image.png',6,'2024-08-15 23:30:36');
/*!40000 ALTER TABLE `community_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `community_post_comments`
--

DROP TABLE IF EXISTS `community_post_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `community_post_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `community_post_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `community_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `community_post_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `community_post_comments`
--

LOCK TABLES `community_post_comments` WRITE;
/*!40000 ALTER TABLE `community_post_comments` DISABLE KEYS */;
INSERT INTO `community_post_comments` VALUES (1,1,6,'well if we see in the upcoming state it will be difficult to say that these will stay on the market ','2024-08-08 18:59:36'),(2,2,6,'What are you?','2024-08-11 11:58:15'),(3,3,9,'hey is that my profile Picture?','2024-08-11 12:16:07'),(4,3,6,'Yes it is. Do what you can','2024-08-11 12:17:35'),(5,4,5,'Let\'s Talk','2024-08-11 21:43:00'),(6,5,12,'WOW','2024-08-13 10:19:01'),(7,5,12,'O','2024-08-13 10:19:12');
/*!40000 ALTER TABLE `community_post_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `community_post_likes`
--

DROP TABLE IF EXISTS `community_post_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `community_post_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `like_type` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `community_post_likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `community_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `community_post_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `community_post_likes`
--

LOCK TABLES `community_post_likes` WRITE;
/*!40000 ALTER TABLE `community_post_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `community_post_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies_applied_jobs`
--

DROP TABLE IF EXISTS `companies_applied_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `companies_applied_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `employers_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `job_id` (`job_id`),
  KEY `employers_id` (`employers_id`),
  KEY `companies_applied_jobs_ibfk_1` (`users_id`),
  CONSTRAINT `companies_applied_jobs_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `companies_applied_jobs_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job_listings` (`id`),
  CONSTRAINT `companies_applied_jobs_ibfk_3` FOREIGN KEY (`employers_id`) REFERENCES `employer_profiles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies_applied_jobs`
--

LOCK TABLES `companies_applied_jobs` WRITE;
/*!40000 ALTER TABLE `companies_applied_jobs` DISABLE KEYS */;
INSERT INTO `companies_applied_jobs` VALUES (1,5,4,2,'2024-08-09 00:26:08'),(2,5,3,2,'2024-08-09 02:38:45'),(3,5,4,2,'2024-08-09 02:38:48'),(4,5,6,2,'2024-08-10 03:21:50'),(5,5,6,2,'2024-08-10 03:21:50'),(6,5,3,2,'2024-08-10 03:24:06'),(7,5,7,4,'2024-08-10 13:11:44'),(8,9,4,2,'2024-08-11 02:12:51'),(9,10,7,4,'2024-08-11 22:20:56'),(10,5,4,2,'2024-08-13 13:17:05'),(11,12,3,2,'2024-08-13 15:07:14'),(12,5,3,2,'2024-08-16 00:02:28'),(13,5,3,2,'2024-08-16 00:56:35'),(14,5,3,2,'2024-08-16 01:08:16'),(15,5,4,2,'2024-08-16 01:08:19'),(16,5,3,2,'2024-08-16 02:31:55'),(17,5,3,2,'2024-08-16 02:58:01'),(18,9,4,2,'2024-08-16 10:16:57'),(19,5,3,2,'2024-08-16 10:19:12'),(20,5,4,2,'2024-08-16 10:19:15'),(21,15,3,2,'2024-08-16 10:22:35');
/*!40000 ALTER TABLE `companies_applied_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_support`
--

DROP TABLE IF EXISTS `contact_support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(300) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_support`
--

LOCK TABLES `contact_support` WRITE;
/*!40000 ALTER TABLE `contact_support` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_support` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employer_profiles`
--

DROP TABLE IF EXISTS `employer_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employer_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_description` text DEFAULT NULL,
  `company_culture` text DEFAULT NULL,
  `company_benefits` text DEFAULT NULL,
  `actions` enum('rejected','pending','approved') NOT NULL DEFAULT 'pending',
  `company_logo` longblob DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `employer_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employer_profiles`
--

LOCK TABLES `employer_profiles` WRITE;
/*!40000 ALTER TABLE `employer_profiles` DISABLE KEYS */;
INSERT INTO `employer_profiles` VALUES (2,6,'Aptech North Nazimabad','Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quae sint perferendis mollitia? Ipsa consequuntur rem repellat voluptatibus. Ullam ex earum quos beatae odit cum eaque sint non in totam.','Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quae sint perferendis mollitia? Ipsa consequuntur rem repellat voluptatibus. Ullam ex earum quos beatae odit cum eaque sint non in totam.','Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem quae sint perferendis mollitia? Ipsa consequuntur rem repellat voluptatibus. Ullam ex earum quos beatae odit cum eaque sint non in totam.','approved',_binary 'UserUploads/1.png'),(3,7,'Mashallah Milk Shop','            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio incidunt corrupti atque suscipit, at soluta facere alias molestias accusantium cupiditate, ipsum dignissimos? Nihil ipsa, ut fuga omnis nemo consequuntur perferendis?','            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio incidunt corrupti atque suscipit, at soluta facere alias molestias accusantium cupiditate, ipsum dignissimos? Nihil ipsa, ut fuga omnis nemo consequuntur perferendis?','            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio incidunt corrupti atque suscipit, at soluta facere alias molestias accusantium cupiditate, ipsum dignissimos? Nihil ipsa, ut fuga omnis nemo consequuntur perferendis?','approved',_binary 'UserUploads/meshback.png'),(4,8,'lab 11 3rd floor','18 good  student','education','education','approved',_binary 'UserUploads/cropped-1920-1080-1350518.jpeg'),(5,13,'CHIPS AND DIPS','DIPS','CHIPS','health','approved',_binary 'UserUploads/cropped-1920-1080-1356925.png'),(6,16,'Jensen Home Decor','aosdkoasdko','Decoration','aoskdoasdoasdkoaskdoasodkasodoas','approved',_binary 'UserUploads/google.png');
/*!40000 ALTER TABLE `employer_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `external_user_resume`
--

DROP TABLE IF EXISTS `external_user_resume`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `external_user_resume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_experience` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `external_user_resume_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `external_user_resume`
--

LOCK TABLES `external_user_resume` WRITE;
/*!40000 ALTER TABLE `external_user_resume` DISABLE KEYS */;
INSERT INTO `external_user_resume` VALUES (1,5,'Rust Developer','5'),(2,5,'Web Developer','10');
/*!40000 ALTER TABLE `external_user_resume` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hired_history`
--

DROP TABLE IF EXISTS `hired_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hired_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `hired_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `job_id` (`job_id`),
  KEY `emp_id` (`emp_id`),
  CONSTRAINT `hired_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `hired_history_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job_listings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `hired_history_ibfk_3` FOREIGN KEY (`emp_id`) REFERENCES `employer_profiles` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hired_history`
--

LOCK TABLES `hired_history` WRITE;
/*!40000 ALTER TABLE `hired_history` DISABLE KEYS */;
INSERT INTO `hired_history` VALUES (1,5,3,6,'2024-08-16 04:30:36');
/*!40000 ALTER TABLE `hired_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interview_schedules`
--

DROP TABLE IF EXISTS `interview_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `interview_schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_seeker_id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `job_listing_id` int(11) NOT NULL,
  `interview_date` datetime NOT NULL,
  `status` enum('scheduled','completed','cancelled') DEFAULT 'scheduled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `job_seeker_id` (`job_seeker_id`),
  KEY `employer_id` (`employer_id`),
  KEY `job_listing_id` (`job_listing_id`),
  CONSTRAINT `interview_schedules_ibfk_1` FOREIGN KEY (`job_seeker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `interview_schedules_ibfk_2` FOREIGN KEY (`employer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `interview_schedules_ibfk_3` FOREIGN KEY (`job_listing_id`) REFERENCES `job_listings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interview_schedules`
--

LOCK TABLES `interview_schedules` WRITE;
/*!40000 ALTER TABLE `interview_schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `interview_schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_alerts`
--

DROP TABLE IF EXISTS `job_alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_seeker_id` int(11) NOT NULL,
  `alert_criteria` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `job_seeker_id` (`job_seeker_id`),
  CONSTRAINT `job_alerts_ibfk_1` FOREIGN KEY (`job_seeker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_alerts`
--

LOCK TABLES `job_alerts` WRITE;
/*!40000 ALTER TABLE `job_alerts` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_alerts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_listings`
--

DROP TABLE IF EXISTS `job_listings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employer_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `requirements` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `job_type` enum('full-time','part-time','remote','contract','intern') DEFAULT NULL,
  `experience_level` varchar(255) DEFAULT NULL,
  `salary_range` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `employer_id` (`employer_id`),
  CONSTRAINT `job_listings_ibfk_1` FOREIGN KEY (`employer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_listings`
--

LOCK TABLES `job_listings` WRITE;
/*!40000 ALTER TABLE `job_listings` DISABLE KEYS */;
INSERT INTO `job_listings` VALUES (3,6,'Database Manager','As a Database Manager, you\'ll play a crucial role in maintaining and optimizing the data systems that drive business operations. Your expertise in database management ensures that our systems are secure, scalable, and efficient. You\'ll be responsible for designing, implementing, and managing databases that support business needs, ensuring data integrity, and providing access to critical information in a timely manner.','Educational Background: Bachelor\'s degree in Computer Science, Information Technology, or a related field. Advanced certifications in database management or related technologies are a plus.  Experience: Minimum of 5 years of experience in database management, with a strong background in SQL, NoSQL, and data modeling. Experience with cloud-based databases is preferred.  Technical Skills:  Proficiency in database technologies like MySQL, PostgreSQL, Oracle, or MongoDB. Experience in database design, optimization, and maintenance. Knowledge of data security best practices and compliance standards (e.g., GDPR). Familiarity with backup and recovery processes. Understanding of database scaling and performance tuning. Analytical Skills: Strong problem-solving skills, with the ability to analyze complex data systems and recommend improvements.  Communication Skills: Excellent verbal and written communication skills, with the ability to convey complex technical concepts to non-technical stakeholders.  Leadership Abilities: Proven track record of leading database teams and managing multiple projects simultaneously.  Attention to Detail: High attention to detail and accuracy in managing and monitoring database performance.  Adaptability: Ability to work in a fast-paced environment, with a willingness to learn and adapt to new technologies and processes.  Team Collaboration: Experience working in cross-functional teams and collaborating with IT, development, and business teams.','Karachi','remote','2+ Years','300000','Database, Manager, Engineer, DB, Software Engineer','2024-08-08 17:34:45'),(4,6,'Full Stack Game Developer','As a Full Stack Game Developer, you\'ll be at the forefront of creating immersive gaming experiences. You\'ll be responsible for both front-end and back-end development, ensuring that games are not only visually appealing but also technically sound. Your role involves collaborating with designers, artists, and other developers to build seamless and engaging gameplay, from server architecture to user interfaces. If you have a passion for game development and a knack for solving complex technical challenges, this role is for you.','Educational Background: Bachelor\'s degree in Computer Science, Game Development, or a related field. Advanced certifications in game development or relevant technologies are a plus.\r\n\r\nExperience:\r\n\r\nMinimum of 3 years of experience in game development.\r\nProven track record in both front-end and back-end development for games.\r\nExperience with game engines like Unity, Unreal Engine, or Godot.\r\nTechnical Skills:\r\n\r\nProficiency in programming languages such as C#, C++, JavaScript, and Python.\r\nStrong understanding of game design principles, physics, and AI programming.\r\nExperience with multiplayer networking, APIs, and server-side scripting.\r\nKnowledge of front-end technologies like HTML5, CSS3, and WebGL.\r\nFamiliarity with databases, cloud services, and version control systems (e.g., Git).\r\nCreative Skills: Ability to translate creative concepts into functional and engaging game mechanics.\r\n\r\nProblem-Solving: Strong analytical and problem-solving skills, with the ability to debug complex issues across different platforms.\r\n\r\nCommunication Skills: Excellent communication skills for effective collaboration with designers, artists, and other team members.\r\n\r\nAdaptability: Ability to work in a fast-paced environment, staying up-to-date with the latest game development trends and technologies.\r\n\r\nTeam Collaboration: Experience working in a collaborative team environment, with a focus on delivering high-quality games within project timelines.\r\n\r\nPortfolio: A portfolio showcasing previous game development projects, including links to playable games or code samples.','Gujranwala','part-time','5+ Years','50000','Game Development, Coding, Programming, Fun, Problem Solving','2024-08-08 17:46:14'),(6,6,'Senior Sweeper','Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempora eum veritatis quisquam veniam similique ullam enim porro. Dolorum voluptas deserunt porro, temporibus doloremque maiores ipsa consectetur reiciendis nulla fuga provident.','Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempora eum veritatis quisquam veniam similique ullam enim porro. Dolorum voluptas deserunt porro, temporibus doloremque maiores ipsa consectetur reiciendis nulla fuga provident.','Islamabad','remote','less_1','30000','Sweeper, Jobs, Opportunity, Greater','2024-08-09 22:12:35'),(7,8,'Senior web developer','should be able to have strong problem solving','2+ year of experiance is required','Karachi','full-time','3','90000','web_developer , front_end developer , bootstrap ','2024-08-10 08:10:41'),(8,13,'jet engine mantanece','should be able to work','html,csss,csasjkadhashd','Karachi','remote','3','50000','helper','2024-08-13 10:28:10');
/*!40000 ALTER TABLE `job_listings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `messages` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,5,9,'CQ7cr4wWnWvVZbUu9LLCtnw=','2024-08-11 15:42:15'),(2,5,9,'ABqO2qoelTm9T7hnxL+DsjMjNTQ=','2024-08-11 15:42:30'),(3,12,9,'KQY=','2024-08-13 10:03:39'),(4,5,14,'CSql','2024-08-15 08:08:50');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `notification_type` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `message_from` varchar(255) NOT NULL DEFAULT 'System',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,5,'OK','Your Additional Information has been registered',1,'2024-08-06 13:22:31','System'),(2,5,'OK','Your Main Profession has been updated',1,'2024-08-06 13:22:31','System'),(3,5,'OK','Your Description has been updated',1,'2024-08-06 13:22:31','System'),(4,5,'OK','Your Hobbies have been updated',1,'2024-08-06 13:22:31','System'),(5,5,'OK','Your Interests have been updated',1,'2024-08-06 13:22:31','System'),(6,5,'OK','Your Post was successfully Uploaded!',1,'2024-08-06 13:25:04','System'),(7,6,'OK','Job Post has been created successfully!',1,'2024-08-06 22:20:58','System'),(8,5,'OK','Your Company Logo has been updated successfully',1,'2024-08-07 11:08:54','System'),(9,5,'OK','Successfully saved job post',1,'2024-08-07 11:13:15','System'),(10,6,'OK','Your Password has been changed!',1,'2024-08-07 18:47:26','System'),(11,6,'OK','Your Job Updation was successful',1,'2024-08-07 19:10:10','System'),(12,6,'OK','Your Job Post has been deleted Successfully',1,'2024-08-07 19:39:40','System'),(13,6,'OK','Job Post has been created successfully!',1,'2024-08-07 19:41:48','System'),(14,6,'OK','Your Job Updation was successful',1,'2024-08-07 19:42:33','System'),(15,6,'OK','Your Job Post has been deleted Successfully',1,'2024-08-07 19:43:03','System'),(16,6,'OK','Job Post has been created successfully!',1,'2024-08-08 17:34:45','System'),(17,6,'OK','Job Post has been created successfully!',1,'2024-08-08 17:46:14','System'),(18,5,'OK','Successfully Applied to the Job',1,'2024-08-08 19:26:08','System'),(19,6,'OK','The Interview has been Scheduled',1,'2024-08-08 20:52:06','System'),(20,6,'OK','The Interview has been Scheduled',1,'2024-08-08 21:19:05','System'),(21,5,'OK','Selected User has been deleted Successfully',1,'2024-08-08 21:33:04','System'),(22,5,'OK','Selected User has been deleted Successfully',1,'2024-08-08 21:37:47','System'),(23,5,'OK','Successfully Applied to the Job',1,'2024-08-08 21:38:45','System'),(24,5,'OK','Successfully Applied to the Job',1,'2024-08-08 21:38:48','System'),(25,6,'OK','The Interview has been Scheduled',1,'2024-08-08 21:42:23','System'),(26,5,'OK','Selected User has been deleted Successfully',1,'2024-08-08 21:42:36','System'),(27,6,'OK','Selected User has been deleted Successfully',1,'2024-08-08 21:47:31','System'),(28,6,'OK','Your Post was successfully Uploaded!',1,'2024-08-08 21:53:22','System'),(29,5,'OK','Successfully saved job post',1,'2024-08-09 21:05:02','System'),(30,5,'OK','Successfully saved job post',1,'2024-08-09 21:05:02','System'),(31,5,'OK','Successfully Removed Saved job post',1,'2024-08-09 21:05:10','System'),(32,5,'OK','Successfully Removed Saved job post',1,'2024-08-09 21:05:13','System'),(33,5,'OK','Successfully Removed Saved job post',1,'2024-08-09 21:05:16','System'),(34,5,'OK','Successfully Removed Saved job post',1,'2024-08-09 21:05:16','System'),(35,5,'OK','Successfully saved job post',1,'2024-08-09 21:08:39','System'),(36,5,'OK','Successfully saved job post',1,'2024-08-09 21:10:32','System'),(37,6,'OK','Job Post has been created successfully!',1,'2024-08-09 21:25:24','System'),(38,5,'OK','Successfully saved job post',1,'2024-08-09 21:25:53','System'),(39,5,'OK','Successfully saved job post',1,'2024-08-09 21:25:53','System'),(40,5,'OK','Successfully saved job post',1,'2024-08-09 21:27:13','System'),(41,5,'OK','Successfully saved job post',1,'2024-08-09 21:27:21','System'),(42,5,'OK','Successfully saved job post',1,'2024-08-09 21:27:25','System'),(43,6,'OK','Your Job Post has been deleted Successfully',1,'2024-08-09 21:54:19','System'),(44,6,'OK','Job Post has been created successfully!',1,'2024-08-09 22:12:35','System'),(45,5,'OK','Successfully saved job post',1,'2024-08-09 22:13:02','System'),(46,5,'OK','Successfully Applied to the Job',1,'2024-08-09 22:21:50','System'),(47,5,'OK','Successfully Applied to the Job',1,'2024-08-09 22:21:50','System'),(48,5,'OK','Successfully Applied to the Job',0,'2024-08-09 22:24:06','System'),(49,8,'OK','Job Post has been created successfully!',0,'2024-08-10 08:10:41','System'),(50,5,'OK','Successfully Applied to the Job',0,'2024-08-10 08:11:44','System'),(51,8,'OK','The Interview has been Scheduled',0,'2024-08-10 08:25:10','System'),(52,9,'OK','Successfully saved job post',0,'2024-08-10 21:12:49','System'),(53,9,'OK','Successfully Applied to the Job',0,'2024-08-10 21:12:51','System'),(54,6,'OK','The Interview has been Scheduled',1,'2024-08-10 21:37:22','System'),(55,9,'OK','Your Additional Information has been registered',0,'2024-08-10 22:36:04','System'),(56,9,'OK','Your Main Profession has been updated',0,'2024-08-10 22:36:05','System'),(57,9,'OK','Your Description has been updated',0,'2024-08-10 22:36:05','System'),(58,9,'OK','Your Hobbies have been updated',0,'2024-08-10 22:36:05','System'),(59,9,'OK','Your Interests have been updated',0,'2024-08-10 22:36:05','System'),(60,6,'OK','Your Post was successfully Uploaded!',1,'2024-08-11 12:09:23','System'),(61,10,'OK','Successfully Applied to the Job',0,'2024-08-11 17:20:56','System'),(62,11,'OK','Your Post was successfully Uploaded!',0,'2024-08-11 17:37:08','System'),(63,6,'OK','Selected User has been deleted Successfully',1,'2024-08-11 21:28:48','System'),(64,6,'OK','Selected User has been deleted Successfully',1,'2024-08-11 21:29:34','System'),(65,6,'OK','Selected User has been deleted Successfully',1,'2024-08-11 21:30:15','System'),(66,6,'OK','Selected User has been deleted Successfully',1,'2024-08-11 21:32:45','System'),(67,5,'OK','Successfully Applied to the Job',0,'2024-08-13 08:17:05','System'),(68,6,'OK','The Interview has been Scheduled',1,'2024-08-13 08:18:21','System'),(69,12,'OK','Successfully saved job post',1,'2024-08-13 10:02:38','System'),(70,12,'OK','Successfully Applied to the Job',1,'2024-08-13 10:07:14','System'),(71,6,'OK','The Interview has been Scheduled',1,'2024-08-13 10:10:37','System'),(72,12,'OK','You Account Protection has been Enhanced!',0,'2024-08-13 10:15:30','System'),(73,12,'OK','Your Post was successfully Uploaded!',0,'2024-08-13 10:18:19','System'),(74,13,'OK','Job Post has been created successfully!',0,'2024-08-13 10:28:10','System'),(75,5,'OK','Your Post was successfully Uploaded!',0,'2024-08-14 12:00:01','System'),(76,5,'OK','Successfully Applied to the Job',0,'2024-08-15 19:02:28','System'),(77,6,'OK','The Interview has been Scheduled',0,'2024-08-15 19:13:09','System'),(78,6,'OK','Selected User has been deleted Successfully',0,'2024-08-15 19:20:46','System'),(79,5,'OK','Successfully Applied to the Job',0,'2024-08-15 19:56:35','System'),(80,5,'OK','Successfully Applied to the Job',0,'2024-08-15 20:08:16','System'),(81,5,'OK','Successfully Applied to the Job',0,'2024-08-15 20:08:19','System'),(82,5,'OK','Successfully Applied to the Job',0,'2024-08-15 21:31:55','System'),(83,5,'OK','Successfully Applied to the Job',0,'2024-08-15 21:58:01','System'),(84,6,'OK','The Interview has been Scheduled',0,'2024-08-15 23:30:27','System'),(85,9,'OK','Successfully Applied to the Job',0,'2024-08-16 05:16:57','System'),(86,5,'OK','Successfully Applied to the Job',0,'2024-08-16 05:19:12','System'),(87,5,'OK','Successfully Applied to the Job',0,'2024-08-16 05:19:15','System'),(88,15,'OK','Successfully Applied to the Job',0,'2024-08-16 05:22:35','System');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_views`
--

DROP TABLE IF EXISTS `profile_views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `profile_views_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `profile_views_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `employer_profiles` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_views`
--

LOCK TABLES `profile_views` WRITE;
/*!40000 ALTER TABLE `profile_views` DISABLE KEYS */;
INSERT INTO `profile_views` VALUES (1,5,6),(6,5,7),(7,5,8);
/*!40000 ALTER TABLE `profile_views` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_picture` longblob DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (3,5,'Muhammad Kaarim Hussain','03173009130','Surjani Town Karachi',_binary 'UserUploads/cropped-1920-1080-1356925.png','2024-08-06 13:17:24'),(4,9,'Umair','03123456789','Gulshan Iqbal Karachi',_binary 'UserUploads/pexels-sulimansallehi-1704488.jpg','2024-08-10 21:03:13'),(5,10,'Rashda','032539548','abc Karachi',_binary 'UserUploads/pexels-sulimansallehi-1704488.jpg','2024-08-11 16:49:56'),(6,11,'John Doe','03173009130','123 Washin DC',_binary 'UserUploads/google.png','2024-08-11 17:33:19'),(7,12,'owais khan','0123456789','Surjani Town Karachi',_binary 'UserUploads/pexels-sulimansallehi-1704488.jpg','2024-08-13 09:59:02'),(8,14,'Gemini','03123456789','ABC Washinton DC',_binary 'UserUploads/1.png','2024-08-14 12:25:02'),(9,15,'Ghufran','03173009130','Surjani Town Karachi',_binary 'UserUploads/google.png','2024-08-16 05:22:14');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recoveryemail`
--

DROP TABLE IF EXISTS `recoveryemail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recoveryemail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `conformed` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `recoveryemail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recoveryemail`
--

LOCK TABLES `recoveryemail` WRITE;
/*!40000 ALTER TABLE `recoveryemail` DISABLE KEYS */;
INSERT INTO `recoveryemail` VALUES (1,12,'499772',1);
/*!40000 ALTER TABLE `recoveryemail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resume1`
--

DROP TABLE IF EXISTS `resume1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resume1` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `resume1_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resume1`
--

LOCK TABLES `resume1` WRITE;
/*!40000 ALTER TABLE `resume1` DISABLE KEYS */;
/*!40000 ALTER TABLE `resume1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resume4`
--

DROP TABLE IF EXISTS `resume4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resume4` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `expertise` text DEFAULT NULL,
  `languages` text DEFAULT NULL,
  `hobbies` text DEFAULT NULL,
  `about_me` text DEFAULT NULL,
  `job_title_1` varchar(100) DEFAULT NULL,
  `company_name_1` varchar(100) DEFAULT NULL,
  `joblocation1` varchar(100) DEFAULT NULL,
  `job_duration_start1` date DEFAULT NULL,
  `job_duration_end1` date DEFAULT NULL,
  `job_description_1` text DEFAULT NULL,
  `job_title_2` varchar(100) DEFAULT NULL,
  `company_name_2` varchar(100) DEFAULT NULL,
  `joblocation2` varchar(100) DEFAULT NULL,
  `job_duration_start2` date DEFAULT NULL,
  `job_duration_end2` date DEFAULT NULL,
  `job_description_2` text DEFAULT NULL,
  `Education_name1` varchar(100) DEFAULT NULL,
  `Education_passoutdate1` date DEFAULT NULL,
  `Education_discription1` text DEFAULT NULL,
  `Education_name2` varchar(100) DEFAULT NULL,
  `Education_passoutdate2` date DEFAULT NULL,
  `Education_discription2` text DEFAULT NULL,
  `r_name` varchar(100) DEFAULT NULL,
  `job_position_1` varchar(100) DEFAULT NULL,
  `r_company_name_1` varchar(100) DEFAULT NULL,
  `job_phone_1` varchar(20) DEFAULT NULL,
  `job_email_1` varchar(100) DEFAULT NULL,
  `aboutme` text DEFAULT NULL,
  `job_title_experience` varchar(255) NOT NULL DEFAULT 'fresher',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `resume4_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resume4`
--

LOCK TABLES `resume4` WRITE;
/*!40000 ALTER TABLE `resume4` DISABLE KEYS */;
/*!40000 ALTER TABLE `resume4` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resume_data`
--

DROP TABLE IF EXISTS `resume_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resume_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `education` text DEFAULT NULL,
  `resume_visibility` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `resume_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resume_data`
--

LOCK TABLES `resume_data` WRITE;
/*!40000 ALTER TABLE `resume_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `resume_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resume_templates`
--

DROP TABLE IF EXISTS `resume_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resume_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(255) NOT NULL,
  `template_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resume_templates`
--

LOCK TABLES `resume_templates` WRITE;
/*!40000 ALTER TABLE `resume_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `resume_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resumes`
--

DROP TABLE IF EXISTS `resumes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resumes` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `job_title` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `education` text DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `job_title_experience` varchar(255) NOT NULL DEFAULT 'fresher',
  PRIMARY KEY (`id`),
  KEY `resumes_ibfk_1` (`user_id`),
  CONSTRAINT `resumes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resumes`
--

LOCK TABLES `resumes` WRITE;
/*!40000 ALTER TABLE `resumes` DISABLE KEYS */;
/*!40000 ALTER TABLE `resumes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resumes2`
--

DROP TABLE IF EXISTS `resumes2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resumes2` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `job_title1` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `job_duration_start` date DEFAULT NULL,
  `job_duration_end` date DEFAULT NULL,
  `job_description` varchar(255) DEFAULT NULL,
  `education_name` varchar(255) DEFAULT NULL,
  `education_description` text DEFAULT NULL,
  `education_name2` varchar(255) DEFAULT NULL,
  `education_description2` varchar(255) DEFAULT NULL,
  `education_name3` varchar(255) DEFAULT NULL,
  `education_description3` varchar(255) DEFAULT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `language_list` varchar(255) DEFAULT NULL,
  `job_title_experience` varchar(255) NOT NULL DEFAULT 'fresher',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `resumes2_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resumes2`
--

LOCK TABLES `resumes2` WRITE;
/*!40000 ALTER TABLE `resumes2` DISABLE KEYS */;
/*!40000 ALTER TABLE `resumes2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resumes3`
--

DROP TABLE IF EXISTS `resumes3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resumes3` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `job_summary` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(20) DEFAULT NULL,
  `locations` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `title_1` varchar(255) DEFAULT NULL,
  `company_name_1` varchar(255) DEFAULT NULL,
  `job_duration_1` varchar(25) DEFAULT NULL,
  `job_description_1` varchar(255) DEFAULT NULL,
  `job_title_2` varchar(255) DEFAULT NULL,
  `company_name_2` varchar(255) DEFAULT NULL,
  `job_duration_2` varchar(25) DEFAULT NULL,
  `job_description_2` varchar(255) DEFAULT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `Education1` varchar(255) DEFAULT NULL,
  `education_date1` date DEFAULT NULL,
  `Education2` varchar(255) DEFAULT NULL,
  `education_date2` date DEFAULT NULL,
  `job_title_experience` varchar(255) NOT NULL DEFAULT 'fresher',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `resumes3_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resumes3`
--

LOCK TABLES `resumes3` WRITE;
/*!40000 ALTER TABLE `resumes3` DISABLE KEYS */;
/*!40000 ALTER TABLE `resumes3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `savedpost`
--

DROP TABLE IF EXISTS `savedpost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `savedpost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_listing_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `job_listing_id` (`job_listing_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `savedpost_ibfk_1` FOREIGN KEY (`job_listing_id`) REFERENCES `job_listings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `savedpost_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `savedpost`
--

LOCK TABLES `savedpost` WRITE;
/*!40000 ALTER TABLE `savedpost` DISABLE KEYS */;
INSERT INTO `savedpost` VALUES (1,4,5),(2,3,5),(4,6,5),(5,4,9),(6,3,12);
/*!40000 ALTER TABLE `savedpost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scheduledinterviews`
--

DROP TABLE IF EXISTS `scheduledinterviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `scheduledinterviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `interviewedUser` varchar(255) NOT NULL,
  `interviewedEmail` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `interviewed_description` text DEFAULT NULL,
  `interviewed_date` date DEFAULT current_timestamp(),
  `interviewed_time` time DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `interviewStatus` enum('pending','interview_on','interview_off') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `job_id` (`job_id`),
  CONSTRAINT `scheduledinterviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `scheduledinterviews_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job_listings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scheduledinterviews`
--

LOCK TABLES `scheduledinterviews` WRITE;
/*!40000 ALTER TABLE `scheduledinterviews` DISABLE KEYS */;
INSERT INTO `scheduledinterviews` VALUES (3,5,7,'Muhammad Kaarim Hussain','kaariminnocent@gmail.com','Senior web developer','bring your dad with u ','2024-08-21','02:28:00','2024-08-10 13:25:04','interview_on'),(4,9,4,'Umair','umair@gmail.com','Full Stack Game Developer','Bring your Wife with you for Long Ride','2024-08-16','01:01:00','2024-08-11 02:37:18','interview_on'),(5,5,4,'Muhammad Kaarim Hussain','kaariminnocent@gmail.com','Full Stack Game Developer','Kuma Lala Savesta Jonny','2024-07-12','13:20:00','2024-08-13 13:18:14','interview_on'),(6,12,3,'owais khan','ubaidiqbal672@gmail.com','Database Manager','bring your father with u ','2024-08-08','05:10:00','2024-08-13 15:10:29','interview_on'),(8,5,3,'Muhammad Kaarim Hussain','kaariminnocent@gmail.com','Database Manager','Bring Every One','2024-08-22','04:33:00','2024-08-16 04:30:24','interview_on');
/*!40000 ALTER TABLE `scheduledinterviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `third_party_integrations`
--

DROP TABLE IF EXISTS `third_party_integrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `third_party_integrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `third_party_integrations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `third_party_integrations`
--

LOCK TABLES `third_party_integrations` WRITE;
/*!40000 ALTER TABLE `third_party_integrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `third_party_integrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `two_fact_auth`
--

DROP TABLE IF EXISTS `two_fact_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `two_fact_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `is_enabled` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `two_fact_auth`
--

LOCK TABLES `two_fact_auth` WRITE;
/*!40000 ALTER TABLE `two_fact_auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `two_fact_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_portfolio_links`
--

DROP TABLE IF EXISTS `user_portfolio_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_portfolio_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `portfolio_link` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_portfolio_links_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_portfolio_links`
--

LOCK TABLES `user_portfolio_links` WRITE;
/*!40000 ALTER TABLE `user_portfolio_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_portfolio_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_projects_links`
--

DROP TABLE IF EXISTS `user_projects_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_projects_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) NOT NULL,
  `project_description` text NOT NULL,
  `project_link` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_projects_links_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_projects_links`
--

LOCK TABLES `user_projects_links` WRITE;
/*!40000 ALTER TABLE `user_projects_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_projects_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_skills`
--

DROP TABLE IF EXISTS `user_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skill` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_skills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_skills`
--

LOCK TABLES `user_skills` WRITE;
/*!40000 ALTER TABLE `user_skills` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_work_experience`
--

DROP TABLE IF EXISTS `user_work_experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_work_experience` (
  `work_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `company_name` varchar(255) NOT NULL DEFAULT 'Undefined',
  `work_description` text DEFAULT NULL,
  `company_start_date` date DEFAULT current_timestamp(),
  `company_end_date` date DEFAULT NULL,
  PRIMARY KEY (`work_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_work_experience_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_work_experience`
--

LOCK TABLES `user_work_experience` WRITE;
/*!40000 ALTER TABLE `user_work_experience` DISABLE KEYS */;
INSERT INTO `user_work_experience` VALUES (2,5,'Junior Web Developer','Mind Vibes Solutions','Great working Experience been able to kill other employees','2024-08-03','0000-00-00'),(3,5,'Senior Game Developer & Game Designer','Rockstar','Was able to create and work in GTA 7','2020-12-31','0000-00-00');
/*!40000 ALTER TABLE `user_work_experience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('worker','recruiter') DEFAULT 'worker',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `account_visibility` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ubiad','ubiad@gmail.com','67890','','2024-08-06 10:28:10',1),(5,'Muhammad Kaarim Hussain','kaariminnocent@gmail.com','$2y$10$p7JX1igmqVwC3kK6HZpkv.9pIj6GTMrdLG5Xmxk4urMSaROsC57Py','worker','2024-08-06 13:17:24',1),(6,'Aptech','aptech@gmail.com','$2y$10$RK1yEwpnscBtNV4LykdAD.3Sf922ZV1rcAs1iE.MWkl/g12VqGm7i','recruiter','2024-08-06 22:13:32',1),(7,'Gujjar','highspeedlevel2005@gmail.com','$2y$10$XWxF.z5dV56RuXW8eVppw.m7KqZ3zrNHbqIpak.3WjljtEpXEbrOa','recruiter','2024-08-09 20:48:38',1),(8,'owais khan','highspeedlevel2000@gmail.com','$2y$10$qPPNlL2kmX83Vkz63Qh78eFd1sSf00bmAwfbkrGHGnozynpwXBxXa','recruiter','2024-08-10 08:04:27',1),(9,'Umair','umair@gmail.com','$2y$10$sp8sxvu5RU8Ji3sF1CYgmunUP1hkrWel9tTY7db/gINg0rtXIQ7g6','worker','2024-08-10 21:03:13',1),(10,'Rashda','rashda@gmail.com','$2y$10$0sk1Saf722hQtkZG7C7yLuH/z1G66w.mYCRRL8BvTY2LMWZpVwK8K','worker','2024-08-11 16:49:56',1),(11,'John Doe','john@gmail.com','$2y$10$hdg0DT9AVTYtbCQ70J35FeAVU7BmquuGqU4fkv2PYaHVEgf1dnYyW','worker','2024-08-11 17:33:19',1),(12,'owais khan','ubaidiqbal672@gmail.com','$2y$10$qC16Gkf4vpGLZbFs8ToydeTaGUEdKU/j47w2wrWwu973QgWORPNyG','worker','2024-08-13 09:59:02',1),(13,'CHIPS AND DIPS','doyoulikefury@gmail.com','$2y$10$/GDVHpFWXFFRQ5zwrw4WT.h149LHxNVO8HzIHYH89yDV66KEEVXhS','recruiter','2024-08-13 10:22:16',1),(14,'Gemini','google@gmail.com','$2y$10$hli1saA1LBUs9Nn9SMvFN.mYKDHR4Vj1LBqMv7WDTiG5zPRbxGGsa','worker','2024-08-14 12:25:01',1),(15,'Ghufran','ghufran@gmail.com','$2y$10$OQfmYCTqyyTnkqbOD1aMoOBP7dfiNsjErg/hDiZZ4feMEZ6NNkykO','worker','2024-08-16 05:22:14',1),(16,'Jensen','jensen@gmail.com','$2y$10$bi5ev6LEJ7X6PqsnERDCl.mjZINrovV6qz6YHFD0XjsNn6.AZykDW','recruiter','2024-08-16 05:56:33',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_additional_info`
--

DROP TABLE IF EXISTS `users_additional_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_additional_info` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_description` text DEFAULT NULL,
  `user_interest` varchar(100) DEFAULT NULL,
  `user_hobbies` varchar(100) DEFAULT NULL,
  `user_main_profession` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`info_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `users_additional_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_additional_info`
--

LOCK TABLES `users_additional_info` WRITE;
/*!40000 ALTER TABLE `users_additional_info` DISABLE KEYS */;
INSERT INTO `users_additional_info` VALUES (1,5,'Motivated man with straight forward goals to become something','Game Development','Discovering new Things','Next JS Developer'),(2,9,'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores modi ab excepturi.','DSA (Data Structure & Algorithems)','Relaxing','Python Developer | Database Engineer'),(3,10,'Mastering  Web Designing since 2010','Machine Learning - Artificial Intelligence','Gaming','UI/UX Designer'),(4,11,'Been React Developer for 7+ Years','Game Designing','Internet Explorer','React Developer | SEO Expert | Off Page SEO | Assembly Language | CEO'),(5,12,'asdf','job seeker','sleep','webdev'),(6,14,'## Reverse Engineering AI: Unveiling the Inner Workings\r\n\r\nAs a reverse engineer specializing in AI, you are a detective of the digital world, meticulously dissecting the inner workings of complex algorithms and models. Your expertise lies in understanding how AI systems function, from the underlying code to the data they consume. You delve into the black box of AI, piecing together how decisions are made, identifying potential vulnerabilities, and uncovering hidden patterns and biases.\r\n\r\nYour work is crucial for:\r\n\r\n* Understanding the limitations and vulnerabilities of AI systems. By analyzing how AI models operate, you can identify weaknesses and potential security risks.\r\n* Improving the reliability and trustworthiness of AI. You contribute to building more robust and ethical AI systems by understanding their inner workings.\r\n* Developing new and innovative AI applications. Your deep understanding of existing AI technologies allows you to push boundaries and explore novel solutions.\r\n\r\nYou are a bridge between the intricate world of algorithms and the real-world applications of AI, ensuring its responsible development and deployment. Your work is essential for shaping the future of this transformative technology.','Backend','Eating & Games','Reverse Engineer | AI | Artificial Intelligence'),(7,15,'Loasdnkasmdasndknaskdmnkdnk','Games','Sleep','Game Developer');
/*!40000 ALTER TABLE `users_additional_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usersavedimagesfordetection`
--

DROP TABLE IF EXISTS `usersavedimagesfordetection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usersavedimagesfordetection` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `savedImage` blob DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`img_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `usersavedimagesfordetection_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersavedimagesfordetection`
--

LOCK TABLES `usersavedimagesfordetection` WRITE;
/*!40000 ALTER TABLE `usersavedimagesfordetection` DISABLE KEYS */;
INSERT INTO `usersavedimagesfordetection` VALUES (1,12,_binary 'ImageDetection/images.jpg',1);
/*!40000 ALTER TABLE `usersavedimagesfordetection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usersinbox`
--

DROP TABLE IF EXISTS `usersinbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usersinbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `messages` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`),
  CONSTRAINT `usersinbox_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usersinbox_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersinbox`
--

LOCK TABLES `usersinbox` WRITE;
/*!40000 ALTER TABLE `usersinbox` DISABLE KEYS */;
INSERT INTO `usersinbox` VALUES (1,6,5,'Nice Brother','2024-08-10 19:47:38',1),(2,5,6,'I Know','2024-08-10 20:28:46',1),(3,5,6,'That Might Works','2024-08-10 20:55:12',1),(4,5,6,'So Tell me how are you doing','2024-08-10 20:56:10',1),(5,5,6,'Lol','2024-08-10 21:00:25',1),(6,6,9,'Hello There. I have seen that you applied in my job','2024-08-10 22:08:10',1),(7,6,9,'will be looking forward for your response','2024-08-10 22:14:09',1),(8,9,6,'Yes thank you soo much for replying','2024-08-10 22:16:54',1),(9,6,9,'Well that\'s Nice ','2024-08-10 22:17:44',1),(10,6,9,'Can you Share your Resume?','2024-08-10 22:18:01',1),(11,6,9,'Ok and Please make sure to share your resume on our provided email','2024-08-10 22:22:48',1),(12,6,9,'Ok Good Bye','2024-08-10 22:31:33',1),(13,9,6,'Ok Bye have a nice day','2024-08-10 22:34:32',1),(14,6,9,'Hey It\'s me from New Day','2024-08-11 11:38:14',0),(15,6,12,'ap kal AJO','2024-08-13 10:12:53',1),(16,12,6,'OK','2024-08-13 10:14:42',1),(17,6,5,'Meow','2024-08-15 19:37:39',0);
/*!40000 ALTER TABLE `usersinbox` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workers_resume`
--

DROP TABLE IF EXISTS `workers_resume`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workers_resume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `resume_file` longblob NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `workers_resume_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workers_resume`
--

LOCK TABLES `workers_resume` WRITE;
/*!40000 ALTER TABLE `workers_resume` DISABLE KEYS */;
INSERT INTO `workers_resume` VALUES (5,12,_binary './UserResume/owais khan_Resume.pdf',1),(6,5,_binary './ExternalResume/Muhammad Kaarim Hussain_Resume.pdf',1);
/*!40000 ALTER TABLE `workers_resume` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-16 11:00:19
