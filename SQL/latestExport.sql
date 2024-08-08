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
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `job_id` (`job_id`),
  CONSTRAINT `applied_jobs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `applied_jobs_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job_listings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applied_jobs`
--

LOCK TABLES `applied_jobs` WRITE;
/*!40000 ALTER TABLE `applied_jobs` DISABLE KEYS */;
INSERT INTO `applied_jobs` VALUES (1,2,1),(2,11,1);
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
  CONSTRAINT `backup_applications_ibfk_1` FOREIGN KEY (`job_seeker_id`) REFERENCES `users` (`id`),
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
  KEY `user_id` (`user_id`),
  CONSTRAINT `backup_employer_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
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
  KEY `receiver_id` (`receiver_id`),
  CONSTRAINT `backup_messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  CONSTRAINT `backup_messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`)
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
  KEY `user_id` (`user_id`),
  CONSTRAINT `backup_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_profiles`
--

LOCK TABLES `backup_profiles` WRITE;
/*!40000 ALTER TABLE `backup_profiles` DISABLE KEYS */;
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
  KEY `user_id` (`user_id`),
  CONSTRAINT `backup_resume_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
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
  KEY `user_id` (`user_id`),
  CONSTRAINT `backup_user_work_experience_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
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
  `created_at` date DEFAULT current_timestamp(),
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
INSERT INTO `community_post` VALUES (1,'Checking for the first time',NULL,2,'2024-08-02'),(2,'Check out this Cool Design I made from the internet and using AI\r\n\r\nTell if this is good or not?',_binary './CommunityPostImage/meshback.png',2,'2024-08-02'),(3,'Nice job\r\n\r\nKaarim',_binary './CommunityPostImage/home.png',2,'2024-08-02'),(4,'Asim, Sarfaraz\r\nUbaid Chuza\r\nKaarim Chuza',_binary './CommunityPostImage/Messsages2.png',2,'2024-08-02'),(5,'kaarim is loro',_binary './CommunityPostImage/CompanyHome.png',9,'2024-08-03'),(6,'sjajdsjkadsjajdsjkadsjajdsjkadsjajdsjkadsjajdsjkadsjajdsjkadsjajdsjkadsjajdsjkad\r\nsjajdsjkadsjajdsjkadsjajdsjkad',NULL,9,'2024-08-03'),(7,'Shaazad',_binary './CommunityPostImage/cropped-1920-1080-1350518.jpeg',2,'2024-08-04'),(8,'hi',_binary './CommunityPostImage/gallery5.jpg',11,'2024-08-06');
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `community_post_comments`
--

LOCK TABLES `community_post_comments` WRITE;
/*!40000 ALTER TABLE `community_post_comments` DISABLE KEYS */;
INSERT INTO `community_post_comments` VALUES (1,1,2,'Let&#039;s Goo','2024-08-03 11:25:16'),(2,1,6,'That\'s good','2024-08-03 11:30:34'),(3,2,6,'Nice Art','2024-08-03 11:38:32'),(4,3,6,'Nice','2024-08-03 12:02:36'),(5,1,2,'Nice one','2024-08-03 20:59:26'),(6,1,2,'Nice ','2024-08-03 21:03:13'),(7,2,2,'Meow','2024-08-03 21:04:15'),(8,4,2,'try to make that shit','2024-08-03 21:04:56'),(9,6,2,'What is this','2024-08-03 21:07:03'),(10,1,2,'Yeah I know','2024-08-03 21:08:23'),(11,2,2,'Write for the same shit','2024-08-03 21:08:33'),(12,2,2,'Why','2024-08-03 21:08:50'),(13,3,2,'What do you mean by that','2024-08-03 21:09:05'),(14,4,2,'Well yeah','2024-08-03 21:13:42'),(15,5,2,'Asim hi ek ensaan hai','2024-08-03 21:13:58'),(16,6,2,'What did you do asim','2024-08-03 21:14:12'),(17,2,8,'That\'s the Reson','2024-08-03 21:42:48'),(18,3,8,'Wakanda Salute','2024-08-03 21:44:00'),(19,1,10,'Gulhay','2024-08-03 21:45:28'),(20,7,2,'Shahzad','2024-08-04 13:24:15'),(21,1,2,'Hello Baji','2024-08-04 16:05:22');
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `community_post_likes`
--

LOCK TABLES `community_post_likes` WRITE;
/*!40000 ALTER TABLE `community_post_likes` DISABLE KEYS */;
INSERT INTO `community_post_likes` VALUES (5,3,2,1,'2024-08-04 14:13:07'),(18,2,2,1,'2024-08-04 16:06:11'),(19,2,2,1,'2024-08-04 16:06:12'),(20,1,2,1,'2024-08-04 16:07:14');
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
  CONSTRAINT `companies_applied_jobs_ibfk_3` FOREIGN KEY (`employers_id`) REFERENCES `employer_profiles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies_applied_jobs`
--

LOCK TABLES `companies_applied_jobs` WRITE;
/*!40000 ALTER TABLE `companies_applied_jobs` DISABLE KEYS */;
INSERT INTO `companies_applied_jobs` VALUES (1,2,1,2,'2024-08-06 04:00:03'),(2,11,1,2,'2024-08-06 13:38:16');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employer_profiles`
--

LOCK TABLES `employer_profiles` WRITE;
/*!40000 ALTER TABLE `employer_profiles` DISABLE KEYS */;
INSERT INTO `employer_profiles` VALUES (1,7,'Ubisoft','Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum libero fuga obcaecati iure magnam magni, quam corporis optio voluptatibus, explicabo quas beatae adipisci placeat at ipsum odit harum perferendis, facere minima. Ipsa harum commodi consequuntur?','Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum libero fuga obcaecati iure magnam magni, quam corporis optio voluptatibus, explicabo quas beatae adipisci placeat at ipsum odit harum perferendis, facere minima. Ipsa harum commodi consequuntur?','Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum libero fuga obcaecati iure magnam magni, quam corporis optio voluptatibus, explicabo quas beatae adipisci placeat at ipsum odit harum perferendis, facere minima. Ipsa harum commodi consequuntur?','approved',_binary 'UserUploads/3.png'),(2,8,'Amazon','Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consectetur corporis autem sapiente aliquid iste iure officia dicta, dolores maiores, illo, officiis neque amet eum vero enim ad dignissimos eius nulla quis nisi quibusdam commodi.','Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consectetur corporis autem sapiente aliquid iste iure officia dicta, dolores maiores, illo, officiis neque amet eum vero enim ad dignissimos eius nulla quis nisi quibusdam commodi.','Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consectetur corporis autem sapiente aliquid iste iure officia dicta, dolores maiores, illo, officiis neque amet eum vero enim ad dignissimos eius nulla quis nisi quibusdam commodi.','approved',_binary 'UserUploads/WhatsApp Image 2023-10-16 at 19.55.57_56b08e1c.jpg');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `external_user_resume`
--

LOCK TABLES `external_user_resume` WRITE;
/*!40000 ALTER TABLE `external_user_resume` DISABLE KEYS */;
INSERT INTO `external_user_resume` VALUES (1,2,'Rust Developer','5');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_listings`
--

LOCK TABLES `job_listings` WRITE;
/*!40000 ALTER TABLE `job_listings` DISABLE KEYS */;
INSERT INTO `job_listings` VALUES (1,8,'DevOps Engineer','Capable of doing work like Fixing the AC','Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni, asperiores. Aperiam, eum odio!','Karachi','part-time','2+ Years','50000','DevOps, Cloud Computing, OnlyFans, Labesheer, Qari Sahab ka hamza','2024-08-05 22:59:03');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,2,5,'DAqTjQ==','2024-07-31 12:56:02'),(2,2,5,'Dwafn8EDhmDVY5Eo8A==','2024-07-31 22:28:49'),(3,2,6,'CwqanME1kWOaVA==','2024-07-31 22:29:00'),(4,9,6,'KQbclo4Fmw==','2024-08-03 08:20:13'),(5,2,9,'LAqTjQ==','2024-08-04 21:14:41'),(6,11,9,'KQbcmIkWnTmBW7km76WL/nkENn0qR6K5','2024-08-06 08:42:22');
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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,5,'OK','Your Additional Information has been registered',1,'2024-07-30 18:36:02','System'),(2,5,'OK','Your Main Profession has been updated',1,'2024-07-30 18:36:02','System'),(3,5,'OK','Your Description has been updated',1,'2024-07-30 18:36:02','System'),(4,5,'OK','Your Hobbies have been updated',1,'2024-07-30 18:36:02','System'),(5,5,'OK','Your Interests have been updated',1,'2024-07-30 18:36:02','System'),(6,2,'OK','Your Main Profession has been updated',1,'2024-07-31 14:15:54','System'),(7,2,'OK','Your Description has been updated',1,'2024-07-31 14:15:54','System'),(8,2,'OK','Your Hobbies have been updated',1,'2024-07-31 14:15:54','System'),(9,2,'OK','Your Interests have been updated',1,'2024-07-31 14:15:54','System'),(10,2,'OK','You Account Protection has been Enhanced!',1,'2024-07-31 16:03:50','System'),(11,2,'OK','Your Post was successfully Uploaded!',1,'2024-08-01 22:04:28','System'),(12,2,'OK','Your Post was successfully Uploaded!',1,'2024-08-01 22:14:06','System'),(13,2,'OK','Your Post was successfully Uploaded!',1,'2024-08-01 22:16:30','System'),(14,2,'OK','Your Post was successfully Uploaded!',1,'2024-08-02 10:39:56','System'),(15,9,'OK','Your Post was successfully Uploaded!',1,'2024-08-03 08:13:30','System'),(16,9,'OK','Your Post was successfully Uploaded!',1,'2024-08-03 08:14:09','System'),(17,9,'OK','You Account Protection has been Enhanced!',1,'2024-08-03 08:31:37','System'),(18,6,'OK','Your Additional Information has been registered',0,'2024-08-03 11:44:54','System'),(19,6,'OK','Your Main Profession has been updated',0,'2024-08-03 11:44:54','System'),(20,6,'OK','Your Description has been updated',0,'2024-08-03 11:44:54','System'),(21,6,'OK','Your Hobbies have been updated',0,'2024-08-03 11:44:54','System'),(22,6,'OK','Your Interests have been updated',0,'2024-08-03 11:44:54','System'),(23,2,'OK','Your Post was successfully Uploaded!',0,'2024-08-04 13:23:56','System'),(24,8,'OK','Your Password has been changed!',0,'2024-08-04 19:48:34','System'),(25,8,'OK','Job Post has been created successfully!',0,'2024-08-05 22:59:03','System'),(26,2,'OK','Successfully saved job post',0,'2024-08-05 22:59:39','System'),(27,2,'OK','Successfully Applied to the Job',0,'2024-08-05 23:00:03','System'),(28,2,'OK','You Account Protection has been Enhanced!',0,'2024-08-06 08:32:15','System'),(29,2,'OK','You Account Protection has been Enhanced!',0,'2024-08-06 08:33:12','System'),(30,11,'OK','You Account Protection has been Enhanced!',1,'2024-08-06 08:35:00','System'),(31,11,'OK','Successfully saved job post',1,'2024-08-06 08:37:59','System'),(32,11,'OK','Successfully saved job post',1,'2024-08-06 08:37:59','System'),(33,11,'OK','Successfully Removed Saved job post',1,'2024-08-06 08:38:03','System'),(34,11,'OK','Successfully Removed Saved job post',1,'2024-08-06 08:38:03','System'),(35,11,'OK','Successfully saved job post',1,'2024-08-06 08:38:04','System'),(36,11,'OK','Successfully Applied to the Job',1,'2024-08-06 08:38:16','System'),(37,11,'OK','Your Post was successfully Uploaded!',1,'2024-08-06 08:41:06','System');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_views`
--

LOCK TABLES `profile_views` WRITE;
/*!40000 ALTER TABLE `profile_views` DISABLE KEYS */;
INSERT INTO `profile_views` VALUES (1,2,8);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (2,2,'Kaarim','03173009130','Surjani Town Karachi',_binary 'UserUploads/cropped-1920-1080-1356925.png','2024-07-30 18:08:38'),(3,5,'Akbar','03173009130','ABC Washinton DC',_binary 'UserUploads/cropped-1920-1080-1356925.png','2024-07-30 18:20:38'),(4,6,'Google','+7856961546','LA, Los Angeles',_binary 'UserUploads/google.png','2024-07-30 19:28:26'),(5,9,'DrBean','03492223158','mars',_binary 'UserUploads/postNotFound.png','2024-08-03 08:09:39'),(6,10,'Muhammad','03173009130','Surjani Town Karachi',_binary 'UserUploads/gallery3.jpg','2024-08-03 21:45:16'),(7,11,'Ubaid','0123456789','abc Karachi',_binary 'UserUploads/gallery3.jpg','2024-08-06 08:34:31');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recoveryemail`
--

LOCK TABLES `recoveryemail` WRITE;
/*!40000 ALTER TABLE `recoveryemail` DISABLE KEYS */;
INSERT INTO `recoveryemail` VALUES (1,2,'364125',1),(2,9,'511925',0),(3,9,'967901',1),(4,11,'228435',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resume4`
--

LOCK TABLES `resume4` WRITE;
/*!40000 ALTER TABLE `resume4` DISABLE KEYS */;
INSERT INTO `resume4` VALUES (2,1,'Muhammad Kaarim Hussain','Rust Developer','03173009130','kaariminnocent@gmail.com','ABC Washinton DC','Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium quos totam expedita?','Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium quos totam expedita?','Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium quos totam expedita?',NULL,'Senior Git Manager','Larvel','123 anywhere','2024-08-17','2024-08-12','Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium quos totam expedita?','driver','amazon','wakanda','2024-08-28','2024-08-24','Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium quos totam expedita?','Dae Aptech learnig','2024-08-22','Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium quos totam expedita?','Blower','2024-08-22','Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium quos totam expedita?','kaarim','naked boy','aptech','031795155151','nakedguy@gmail.com','Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium quos totam expedita?','fresher'),(9,2,'Muhammad Kaarim Hussain','PHP Developer','03173009130','kaariminnocent@gmail.com','abc Karachi','HTML\r\nCSS\r\nJAVASCRIPT\r\nPHP','ENGLISH\r\nMATH\r\nSCIENCE','LORO',NULL,'Senior Git Manager','deconte','africa','2024-07-30','2024-07-31','WORK THERE  as a floor cleaner','driver','amazon','antartica','2024-08-01','2024-08-02','jet engine mantancese','Dae Aptech learnig','0000-00-00','sksd','DAE IN SOFTWARE','2024-08-28','ENGKL','kaarim','naked boy','aptech','128937691273','nakedguy@gmail.com','HI BY HELLO','fresher'),(2,3,'Muhammad Kaarim Hussain','Andshand Developer','03173009130','kaarim@gmail.com','ABC Washinton DC','Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores dolore ducimus explicabo facilis eveniet!','Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores dolore ducimus explicabo facilis eveniet!','Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores dolore ducimus explicabo facilis eveniet!',NULL,'Senior Git Manager','GPT','123 anywhere','2024-08-16','2024-08-23','Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores dolore ducimus explicabo facilis eveniet!','driver','amazon','wakanda','2024-08-16','2024-08-29','Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores dolore ducimus explicabo facilis eveniet!','Dae Aptech learnig','2024-08-14','Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores dolore ducimus explicabo facilis eveniet!','DAE IN SOFTWARE','2024-08-23','Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores dolore ducimus explicabo facilis eveniet!','kaarim','naked boy','aptech','03173009130','kaariminnocent@gmail.com','Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores dolore ducimus explicabo facilis eveniet!','10');
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
  KEY `user_id` (`user_id`),
  CONSTRAINT `resumes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resumes`
--

LOCK TABLES `resumes` WRITE;
/*!40000 ALTER TABLE `resumes` DISABLE KEYS */;
INSERT INTO `resumes` VALUES (2,1,'Muhammad Kaarim Hussain','Junior Develop','kaariminnocent@gmail.com','0123456789','www.linkedIn.com','LOREM IDASDAKSMDMAGFNJASDKQNWE QKLENMJLQ CQSMKD QK DKQWF QKDMQJKW DKQWMDK QWKD ','Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus beatae illum nemo ratione? Praesentium illum officiis, a rerum harum doloremque.','HTML\r\nCSS\r\nJAVASCRIPT\r\nBOOTSTRAP\r\nJQUERY','Junior Develop at MVS (3 Months): Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus beatae illum nemo ratione? Praesentium illum officiis, a rerum harum doloremque.\n','fresher'),(2,2,'Kaarim','Junior Develop','kaariminnocent@gmail.com','0123456789','www.linkedIn.com','Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sit aliquid reiciendis totam in aspernatur repellat!','Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sit aliquid reiciendis totam in aspernatur repellat!','HTML\r\nCSS\r\nJS\r\nBOOTSTRAP','Junior Develop at MVS (3 Months): Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sit aliquid reiciendis totam in aspernatur repellat!\n','fresher'),(2,3,'Muhammad Kaarim Hussain','Junior Develop','kaariminnocent@gmail.com','0123456789','www.linkedIn.com','Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore consequatur, fugit ducimus iste ex nobis.','Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore consequatur, fugit ducimus iste ex nobis.','HTML\r\nCSS\r\nJavaScript\r\nBoot sucker','Junior Develop at MVS (3 Months): Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore consequatur, fugit ducimus iste ex nobis.\n','1'),(11,4,'Muhammad Kaarim Hussain','asddas','kaariminnocent@gmail.com','1234567890','www.linkedIn.com','asdasd','asdasdasd','asdasdasdasdasd','asddas at MVS (3 Months): adsdasd\n','5');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resumes2`
--

LOCK TABLES `resumes2` WRITE;
/*!40000 ALTER TABLE `resumes2` DISABLE KEYS */;
INSERT INTO `resumes2` VALUES (2,1,'Muhammad Kaarim Hussain','Database Manager','kaariminnocent@gmail.com',2147483647,'ABC Washinton DC','2024-08-22','Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nostrum iusto aspernatur iure saepe modi.','Salam Dev','Chuza Company','2024-08-22','2024-08-31','Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nostrum iusto aspernatur iure saepe modi.','Mumbai Gallies','Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nostrum iusto aspernatur iure saepe modi.','Karachi Bomb Makers','Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nostrum iusto aspernatur iure saepe modi.','Bangladeshi','Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nostrum iusto aspernatur iure saepe modi.','HTML\r\nCSS\r\nJS\r\nBOOTSTRAP\r\nREACT\r\nANGULAR\r\nNODE JS\r\nEXPRESS JS','URDU\r\nENGLISH','1');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resumes3`
--

LOCK TABLES `resumes3` WRITE;
/*!40000 ALTER TABLE `resumes3` DISABLE KEYS */;
INSERT INTO `resumes3` VALUES (2,1,'Muhammad Kaarim Hussain','Database Manager','loremkasndkasdknaskdnaskdnkasdnkandkasndkasndkasndkasndkasndklandlanskldnaskldnklasndklasndkla','kaariminnocent@gmail.com',2147483647,'Karachi','www.linkedIn.com','www.twitter.com','Junior Web Developer','MVS','1 Year','asdkndkasndkasndkasnkdnaskdnaskdnaskdnakdnakasdnkdnakakdnasknd','Database Engineer','Illuminati','11 years','asdkndkasndkasndkasnkdnaskdnaskdnaskdnakdnakasdnkdnakakdnasknd','HTML\r\nCSS\r\nJavaScript\r\nBootstrap\r\nJQuery\r\nMongoDB','Urdu\r\nPashto\r\nEnglish','Harvert University','2024-08-29','NED University','2024-08-23','fresher'),(2,2,'Muhammad Kaarim Hussain','Database Manager','loremkasndkasdknaskdnaskdnkasdnkandkasndkasndkasndkasndkasndklandlanskldnaskldnklasndklasndkla','kaariminnocent@gmail.com',2147483647,'Karachi','www.linkedIn.com','www.twitter.com','Junior Web Developer','MVS','1 Year','loremkasndkasdknaskdnaskdnkasdnkandkasndkasndkasndkasndkasndklandlanskldnaskldnklasndklasndkla','Database Engineer','Illuminati','11 years','loremkasndkasdknaskdnaskdnkasdnkandkasndkasndkasndkasndkasndklandlanskldnaskldnklasndklasndkla','HTML\r\nCSS\r\nJavaScript\r\nBootstrap','Language\r\nLanguages\r\nItaly','loremkasndkasdknaskdnaskdnkasdnkandkasndkasndkasndkasndkasndklandlanskldnaskldnklasndklasndkl','2024-08-21','loremkasndkasdknaskdnaskdnkasdnkandkasndkasndkasndkasndkasndklandlanskldnaskldnklasndklasndkla','2024-08-15','3');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `savedpost`
--

LOCK TABLES `savedpost` WRITE;
/*!40000 ALTER TABLE `savedpost` DISABLE KEYS */;
INSERT INTO `savedpost` VALUES (1,1,2),(4,1,11);
/*!40000 ALTER TABLE `savedpost` ENABLE KEYS */;
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
  `company_end_date` date DEFAULT current_timestamp(),
  PRIMARY KEY (`work_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_work_experience_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_work_experience`
--

LOCK TABLES `user_work_experience` WRITE;
/*!40000 ALTER TABLE `user_work_experience` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ubiad','ubiad@gmail.com','67890','','2024-07-30 17:54:10',1),(2,'Kaarim Hussain','kaariminnocent@gmail.com','$2y$10$ebObHbSihK2/7J2M4r8UG.g59/nCS7hhxEGtYvFNPYQBhcFp/K3vS','worker','2024-07-30 18:02:22',1),(3,'Kaarim','kaarim@gmail.com','$2y$10$CssvmCg2ZR1Dk.aGSrx95u5sCTrKBoZqrQ10T5hsirHKgm.nOKz.W','worker','2024-07-30 18:08:38',1),(4,'Hussain','hussain@gmail.com','$2y$10$qjEp6Aw2JMf96q58Gfkd1.6FtKHesxopQdZPuD9fXCg2G9X4N8dCO','worker','2024-07-30 18:13:21',1),(5,'Akbar','akbar@gmail.com','$2y$10$T0AVpG2nf.hDBq1EGX1VIufhcG.TvIRR7c0omDYHOhrPN7Jg4F7v.','worker','2024-07-30 18:20:38',1),(6,'Google','google@gmail.com','$2y$10$vTS5BZ9Z4QY4Kgnq2lss9OgZcarGRNHD/S9vnmLYgSmxOSXNato2m','worker','2024-07-30 19:28:26',1),(7,'Ezio Auditore','ubisoft@gmail.com','$2y$10$dhRi.n57sLu0AQ.etLbcdeG2Ds.g87w1Sa2Ym/qSrQY5gfdVpHYBi','recruiter','2024-07-30 19:33:54',1),(8,'Justin Beiber','amazon@gmail.com','$2y$10$og6IdmF2A9iU5h/eNAaDYO0uxZudmusG2qbXBBTYuFNnnXimwvtmG','recruiter','2024-07-31 14:16:54',1),(9,'DrBean','highspeedlevel2005@gmail.com','$2y$10$Cw2GabFWFheIKETvcpBc/OeO/jllQ0SwXsI1xrYsLOpB2V5ygmJtK','worker','2024-08-03 08:09:39',1),(10,'Muhammad','muhammad@gmail.com','$2y$10$0Fohy76Eql2I3VecoJutaewGWEj3erIb9T71fWB7klepiRuQf/61C','worker','2024-08-03 21:45:15',1),(11,'Ubaid','maryamaptech42@gmail.com','$2y$10$/2/sBVNmEs/tKY5925q6hOVlk0pdXunKe2a4Q83ZxXCrFDxdyOYKG','worker','2024-08-06 08:34:31',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_additional_info`
--

LOCK TABLES `users_additional_info` WRITE;
/*!40000 ALTER TABLE `users_additional_info` DISABLE KEYS */;
INSERT INTO `users_additional_info` VALUES (1,2,'Hard Working and Motivated Person looking for a company to work and collaborate with. eager to learn new things','Game Development','Games','Full Stack Developer'),(2,3,NULL,NULL,NULL,NULL),(4,5,'A Motivated and desperate learner','Learning New Things','Playing Games','PHP Web Developer'),(5,6,'A Self Motivated Boy who loves to rank up the Website','Web Development','Discovering new Things','Seo Expert');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersavedimagesfordetection`
--

LOCK TABLES `usersavedimagesfordetection` WRITE;
/*!40000 ALTER TABLE `usersavedimagesfordetection` DISABLE KEYS */;
INSERT INTO `usersavedimagesfordetection` VALUES (1,2,_binary 'ImageDetection/WhatsApp Image 2023-10-16 at 19.55.57_56b08e1c.jpg',1),(2,9,_binary 'ImageDetection/CompanyHome.png',1),(3,2,_binary 'ImageDetection/images.jpg',1),(4,2,_binary 'ImageDetection/images.jpg',1),(5,11,_binary 'ImageDetection/Logo.png',1);
/*!40000 ALTER TABLE `usersavedimagesfordetection` ENABLE KEYS */;
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
  CONSTRAINT `workers_resume_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workers_resume`
--

LOCK TABLES `workers_resume` WRITE;
/*!40000 ALTER TABLE `workers_resume` DISABLE KEYS */;
INSERT INTO `workers_resume` VALUES (1,9,_binary './UserResume/DrBean_Resume.pdf',1),(5,2,_binary './UserResume/Kaarim Hussain_Resume.pdf',1),(6,2,_binary './ExternalResume/Kaarim Hussain_Resume.pdf',1);
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

-- Dump completed on 2024-08-06 14:06:28
