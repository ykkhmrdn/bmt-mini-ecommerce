-- MySQL dump 10.13  Distrib 9.3.0, for macos15.2 (arm64)
--
-- Host: localhost    Database: bmt_mini_ecommerce
-- ------------------------------------------------------
-- Server version	9.3.0

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
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_user_id_foreign` (`user_id`),
  KEY `cart_product_id_foreign` (`product_id`),
  CONSTRAINT `cart_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_09_02_075243_add_two_factor_columns_to_users_table',1),(5,'2025_09_29_014455_create_products_table',1),(6,'2025_09_29_014511_create_cart_table',1),(7,'2025_09_29_014520_create_transactions_table',1),(8,'2025_09_29_014527_create_transaction_items_table',1),(9,'2025_09_29_022436_create_personal_access_tokens_table',1);
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
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Laptop Gaming ASUS ROG',15000000.00,10,'Laptop gaming dengan spesifikasi tinggi, processor Intel i7, RAM 16GB, GPU RTX 4060 untuk kebutuhan gaming dan kerja profesional','https://picsum.photos/400/400?random=1','2025-09-28 19:39:19','2025-09-28 19:39:19'),(2,'Smartphone Samsung Galaxy',3500000.00,25,'Smartphone Android dengan kamera 108MP, layar AMOLED 6.5 inci, dan performa cepat dengan chipset Snapdragon','https://picsum.photos/400/400?random=2','2025-09-28 19:39:19','2025-09-28 19:39:19'),(3,'Headset Sony WH-1000XM5',750000.00,15,'Headset wireless dengan Active Noise Cancelling terbaik di kelasnya dan battery life hingga 30 jam','https://picsum.photos/400/400?random=3','2025-09-28 19:39:19','2025-09-28 19:39:19'),(4,'Mouse Logitech G Pro X',450000.00,30,'Mouse gaming dengan sensor HERO 25K, berat hanya 63 gram, dan RGB lighting yang dapat dikustomisasi','https://picsum.photos/400/400?random=4','2025-09-28 19:39:19','2025-09-28 19:39:19'),(5,'Keyboard Keychron K2',850000.00,20,'Keyboard mechanical dengan switch Gateron Blue, wireless/wired dual mode, dan hot-swappable switches','https://picsum.photos/400/400?random=5','2025-09-28 19:39:19','2025-09-28 19:39:19'),(6,'Monitor LG UltraWide 34\"',6500000.00,8,'Monitor curved 34 inci dengan resolusi 3440x1440, refresh rate 144Hz, ideal untuk gaming dan productivity','https://picsum.photos/400/400?random=6','2025-09-28 19:39:19','2025-09-28 19:39:19'),(7,'iPhone 15 Pro Max',18500000.00,12,'iPhone terbaru dengan chip A17 Pro, kamera 48MP dengan zoom 5x, dan layar Super Retina XDR 6.7 inci','https://picsum.photos/400/400?random=7','2025-09-28 19:39:19','2025-09-28 19:39:19'),(8,'Webcam Logitech C920',1250000.00,18,'Webcam Full HD 1080p dengan autofocus dan stereo microphone untuk streaming dan video conference','https://picsum.photos/400/400?random=8','2025-09-28 19:39:19','2025-09-28 19:39:19'),(9,'SSD Samsung 970 EVO 1TB',1800000.00,22,'SSD NVMe M.2 dengan kecepatan baca hingga 3500 MB/s dan teknologi V-NAND 3-bit MLC','https://picsum.photos/400/400?random=9','2025-09-28 19:39:19','2025-09-28 19:39:19'),(10,'Speaker JBL Charge 5',2200000.00,16,'Speaker portable waterproof dengan JBL Pro Sound, battery 20 jam, dan dapat digunakan sebagai power bank','https://picsum.photos/400/400?random=10','2025-09-28 19:39:19','2025-09-28 19:39:19'),(11,'Tablet iPad Air 5th Gen',9500000.00,14,'iPad Air dengan chip M1, layar Liquid Retina 10.9 inci, dan kompatibel dengan Apple Pencil generasi ke-2','https://picsum.photos/400/400?random=11','2025-09-28 19:39:19','2025-09-28 19:39:19'),(12,'Router WiFi 6 ASUS AX6000',3200000.00,6,'Router WiFi 6 dengan kecepatan hingga 6000 Mbps, 8 antena, dan teknologi AiMesh untuk coverage optimal','https://picsum.photos/400/400?random=12','2025-09-28 19:39:19','2025-09-28 19:39:19'),(13,'Power Bank Anker 20000mAh',650000.00,35,'Power bank dengan kapasitas 20000mAh, fast charging 22.5W, dan dapat mengisi 3 device sekaligus','https://picsum.photos/400/400?random=13','2025-09-28 19:39:19','2025-09-28 19:39:19'),(14,'Smartwatch Apple Watch Series 9',6800000.00,11,'Apple Watch dengan chip S9, layar Always-On Retina, GPS, dan berbagai fitur kesehatan advanced','https://picsum.photos/400/400?random=14','2025-09-28 19:39:19','2025-09-28 19:39:19'),(15,'Earbuds Sony WF-1000XM4',3800000.00,19,'True wireless earbuds dengan industry-leading noise canceling dan Hi-Res Audio Wireless','https://picsum.photos/400/400?random=15','2025-09-28 19:39:19','2025-09-28 19:39:19'),(16,'Gaming Chair SecretLab Titan',7500000.00,5,'Gaming chair premium dengan cold-cure foam, adjustable lumbar support, dan material PU leather','https://picsum.photos/400/400?random=16','2025-09-28 19:39:19','2025-09-28 19:39:19'),(17,'Microphone Blue Yeti',2800000.00,13,'USB microphone dengan 4 polar patterns, real-time headphone monitoring, dan plug & play setup','https://picsum.photos/400/400?random=17','2025-09-28 19:39:19','2025-09-28 19:39:19'),(18,'Graphics Card RTX 4070',11500000.00,7,'GPU NVIDIA RTX 4070 dengan arsitektur Ada Lovelace, DLSS 3, dan ray tracing generation terbaru','https://picsum.photos/400/400?random=18','2025-09-28 19:39:19','2025-09-28 19:39:19'),(19,'CPU Intel Core i7-13700K',6200000.00,9,'Processor Intel generasi ke-13 dengan 16 core, 24 thread, dan boost clock hingga 5.4 GHz','https://picsum.photos/400/400?random=19','2025-09-28 19:39:19','2025-09-28 19:39:19'),(20,'RAM Corsair Vengeance 32GB',3400000.00,17,'DDR5 RAM kit 32GB (2x16GB) dengan kecepatan 5600MHz dan heat spreader aluminum','https://picsum.photos/400/400?random=20','2025-09-28 19:39:19','2025-09-28 19:39:19'),(21,'Motherboard ASUS ROG Maximus',8500000.00,4,'Motherboard Z790 chipset dengan WiFi 6E, Thunderbolt 4, dan dukungan DDR5 & PCIe 5.0','https://picsum.photos/400/400?random=21','2025-09-28 19:39:19','2025-09-28 19:39:19'),(22,'Case Fractal Design Define',2100000.00,21,'PC case mid-tower dengan sound dampening panels dan excellent airflow design','https://picsum.photos/400/400?random=22','2025-09-28 19:39:19','2025-09-28 19:39:19'),(23,'PSU Seasonic Focus GX 850W',2650000.00,15,'Power supply 850W 80+ Gold certified dengan full modular cables dan 10 tahun warranty','https://picsum.photos/400/400?random=23','2025-09-28 19:39:19','2025-09-28 19:39:19'),(24,'Cooling AIO Corsair iCUE H150i',3600000.00,8,'All-in-one liquid cooler 360mm dengan RGB pump head dan magnetic levitation fans','https://picsum.photos/400/400?random=24','2025-09-28 19:39:19','2025-09-28 19:39:19');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('4K2S3DECWnuBNByhb97YQAzk4dEmfkqbMasJq52X',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWTZJRktjMjhWTDVXZTBjOWFjU0JTeG9raUpHb2Z3YnFjUVZya2djaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvcHJvZHVjdHM/cGFnZT0xJnBlcl9wYWdlPTUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1759113565),('jkbVPC81TbsRuOqgGsup53yjyW7M7nAoHai0kECl',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiM0E0NVJlMTU3RUhBQVBDMGRNbGNHc3dEa1ZOekJleHZqbVhpZVpQSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvcHJvZHVjdHM/cGFnZT0zJnBlcl9wYWdlPTUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1759113584),('vyzD3qMJ9c4dchmFqUef0ftuu0VWzt7fcoMRIBsV',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR3NyNkFLQ0RYUUU0U2lMU1dIOExyTmx5a0lYbnNRRWNESzdQdGpNMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvcHJvZHVjdHM/cGFnZT0xJnBlcl9wYWdlPTUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1759113539),('XONrGyzKtkO5B3I4vU1hmMeviQD5xRlCNvD715tz',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoib0xXRHVrNjBPcEZLa3cwVzRVdXhlb3R3OG1wSTlJT2JmcUM3NDIxYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvcHJvZHVjdHM/cGFnZT0xJnBlcl9wYWdlPTEyJnNlYXJjaD0mc29ydF9ieT1wcmljZSZzb3J0X29yZGVyPWFzYyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1759113623);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_items`
--

DROP TABLE IF EXISTS `transaction_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_items_transaction_id_foreign` (`transaction_id`),
  KEY `transaction_items_product_id_foreign` (`product_id`),
  CONSTRAINT `transaction_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaction_items_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_items`
--

LOCK TABLES `transaction_items` WRITE;
/*!40000 ALTER TABLE `transaction_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_user_id_foreign` (`user_id`),
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
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
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Test User','test@example.com','2025-09-28 19:38:50','$2y$12$YewRIYBebOlPR.fk3thT8.5k.P16smodFoo1qDjxCXbEDqdNqP6ju',NULL,NULL,NULL,'23an5SFnte','2025-09-28 19:38:50','2025-09-28 19:38:50');
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

-- Dump completed on 2025-09-29  9:40:53
