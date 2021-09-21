CREATE DATABASE  IF NOT EXISTS `binaryshop2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `binaryshop2`;
-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: binaryshop2
-- ------------------------------------------------------
-- Server version	8.0.20

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Placa mãe'),(2,'Processador'),(3,'Placa de vídeo'),(4,'Memória RAM'),(5,'Armazenamento'),(6,'Fonte'),(7,'Gabinete');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quantity` int NOT NULL DEFAULT '1',
  `stated_price` double NOT NULL,
  `pcbuild_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `items_pcbuild_id_foreign` (`pcbuild_id`),
  KEY `items_product_id_foreign` (`product_id`),
  CONSTRAINT `items_pcbuild_id_foreign` FOREIGN KEY (`pcbuild_id`) REFERENCES `pcbuilds` (`id`),
  CONSTRAINT `items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,1,1171.26,1,2),(2,1,1017.05,1,3),(3,1,5169.15,1,6),(4,1,1049.99,1,8),(5,2,289.95,1,9),(6,1,651.53,1,12),(7,1,409,1,13),(8,1,605,2,1),(9,1,1559,2,4),(10,1,1999.97,2,5),(11,2,299.99,2,7),(12,1,309.99,2,10),(13,1,1195.99,2,11),(14,1,329.99,2,14),(15,1,605,3,1),(16,1,1559,3,4),(17,1,5169.15,3,6),(18,2,1049.99,3,8),(19,2,289.95,3,9),(20,1,1195.99,3,11),(21,1,568.99,3,15),(22,1,605,4,1),(23,1,1559,4,4),(24,1,1999.97,4,5),(25,1,299.99,4,7),(26,1,289.95,4,9),(27,1,651.53,4,12),(28,1,329.99,4,14);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2021_04_16_203327_create_users_table',1),(2,'2021_04_16_203345_create_pcbuilds_table',1),(3,'2021_04_16_203359_create_categories_table',1),(4,'2021_04_16_203415_create_products_table',2),(5,'2021_04_16_203407_create_items_table',3),(6,'2021_04_16_203530_create_password_resets_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pcbuilds`
--

DROP TABLE IF EXISTS `pcbuilds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pcbuilds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `total_price` double NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pcbuilds_user_id_foreign` (`user_id`),
  CONSTRAINT `pcbuilds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pcbuilds`
--

LOCK TABLES `pcbuilds` WRITE;
/*!40000 ALTER TABLE `pcbuilds` DISABLE KEYS */;
INSERT INTO `pcbuilds` VALUES (1,10047.88,1,'2021-04-17 02:30:17','2021-04-17 04:33:36'),(2,6599.92,1,'2021-04-17 04:34:26','2021-04-17 04:34:26'),(3,11778.01,2,'2021-04-17 04:35:48','2021-04-17 04:35:48'),(4,5735.43,3,'2021-04-17 04:42:56','2021-04-17 04:42:56');
/*!40000 ALTER TABLE `pcbuilds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'https://storage-asset.msi.com/global/picture/image/feature/mb/A520M/A520m-PRO/msi-a520m-pro-cooling.jpg','MSI A520M-A PRO (AMD)','A série PRO ajuda os usuários a trabalhar de maneira mais inteligente, proporcionando uma experiência eficiente e produtiva. Apresentando funcionalidade estável e montagem de alta qualidade, as placas-mãe da série PRO fornecem não apenas fluxos de trabalho profissionais otimizados, mas também menos solução de problemas e longevidade.',605,1,'2021-04-17 00:57:00','2021-04-17 00:57:00'),(2,'https://rog.asus.com/websites/global/products/cnhwpmnioz7bydpa/img/z490/gallery/2.jpg','Asus Rog Strix B460-G (Intel)','A placa-mãe ROG Strix B460-G Gaming é instantaneamente reconhecível com seu esquema de cores vermelho e preto clássico e marcações futuristas de cibertexto. Ele inclui todos os elementos essenciais, incluindo hardware robusto e software ROG intuitivo para torná-lo ideal para jogadores e construtores de todos os níveis.',1171.26,1,'2021-04-17 00:57:50','2021-04-17 04:28:39'),(3,'https://ae01.alicdn.com/kf/HTB1QMOnfQZmBKNjSZPiq6xFNVXaa/Intel-Core-i5-8-Processador-s-rie-I5-8400-I5-8400-Encaixotado-CPU-processador-LGA-1151.jpg_Q90.jpg_.webp','Intel Core i5 8400','A memória Intel® Optane™ é uma nova e revolucionária classe de memória não volátil que fica entre a memória de sistema e o armazenamento para aumentar o desempenho e melhorar a responsividade do sistema. Quando combinada com o driver da Tecnologia de armazenamento Intel® Rapid, ela gerencia de modo transparente múltiplas camadas de armazenamento, mostrando uma única unidade virtual para o sistema operacional e garantindo que os dados que são usados com mais frequência estejam na camada mais rápida do armazenamento.',1017.05,2,'2021-04-17 00:58:29','2021-04-17 04:33:25'),(4,'https://offcomp.com.br/produtos/4206.jpg','AMD Ryzen 5 3600','Velocidades mais elevadas, mais memória e largura de banda mais ampla do que as gerações anteriores. Processadores AMD Ryzen™ de 3ª geração com núcleo “Zen 2” de 7 nm² define o padrão para alto desempenho: tecnologia de fabricação exclusiva, histórico de produtividade no chip e desempenho global revolucionário para jogos.',1559,2,'2021-04-17 00:59:00','2021-04-17 00:59:00'),(5,'https://media.pichau.com.br/media/wysiwyg/Descricao/MSI/gtx-1070-gaming/carousel_beatingheart.jpg','MSI Gaming X GTX 1070 8GB','A placa de vídeo NVIDIA GeForce GTX 1070 oferece altíssimo desempenho nos últimos games, sendo recomendada para rodar jogos como CS:GO a 283 FPS com qualidade no Ultra, Overwatch a 237 FPS no Ultra, Dota 2 a 197 FPS no Ultra, Tom Clancy\'s Rainbow Six Siege a 164 FPS no Ultra, Battlefield 1 a 108 FPS no Ultra, Resident Evil 7 a 118 FPS no Ultra e GTA V a 74 FPS no Ultra, todos os games em full HD 1080p.',1999.97,3,'2021-04-17 00:59:59','2021-04-17 00:59:59'),(6,'https://cdn.mos.cms.futurecdn.net/cvgRsLKufXUPw4iMjcAzh5.jpg','RTX 2080 Founders Edition','A melhor e mais atual placa de vídeo da NVIDIA revoluciona o realismo e o desempenho dos games. Sua poderosa arquitetura de GPU NVIDIA Turing, além de tecnologias inovadoras e dos 11 GB de memória GDDR6 ultrarrápida de próxima geração fazem dela a melhor placa de vídeo para games do mundo.',5169.15,3,'2021-04-17 01:00:30','2021-04-17 01:00:30'),(7,'https://www.kabum.com.br/conteudo/descricao/99556/img/02.jpg','Ballistix Sport AT White 8GB','Projetado para entusiastas do desempenho, jogadores e qualquer um que simplesmente queira aproveitar melhor seu sistema, a memória Ballistix Sport DDR4 ajuda você a fazer exatamente isso.',299.99,4,'2021-04-17 01:00:57','2021-04-17 01:00:57'),(8,'https://gamerpc.es/wp-content/uploads/2019/01/mejores-memorias-ram.jpg','G.Skill Trident Z RGB 16GB','Efeito de iluminação LED RGB revolucionário projetado para mostrar o seu sistema Efeito de iluminação padrão de onda do arco-íris Fluido Completamente descoberto, barra de luz de comprimento completo ICs altamente rastreados e PCB de 10 camadas personalizado para desempenho de overclocking sem compromisso Luxuoso acabamento de linha de cabelo com design de aleta agressivo para dissipação de calor altamente eficiente Suporte de perfil Intel XMP 2.0 para overclocking fácil e simples.',1049.99,4,'2021-04-17 01:01:39','2021-04-17 03:06:26'),(9,'https://www.techwikies.com/wp-content/uploads/2018/09/capasite.jpg','SSD WD Green 240GB','Para desempenho rápido e confiabilidade, os SSDs WD Green aceleram a experiência de computação em seu PC desktop ou laptop.',289.95,5,'2021-04-17 01:02:07','2021-04-17 01:02:07'),(10,'https://cdn.hipwallpaper.com/m/72/41/cxyOah.jpg','HD Seagate BarraCuda 1TB','O BarraCuda lidera o setor com as mais altas capacidades para desktops e computadores móveis. Com discos de até 12 TB, o portfólio do BarraCuda é uma ótima opção para upgrades em qualquer faixa de preço. O BarraCuda não abre mão de nada e oferece a capacidade de armazenamento mais alta do setor com velocidades de rotação de 7.200 RPM, proporcionando um desempenho e tempos de carregamento incrivelmente rápidos para jogos ou execução de cargas de trabalho pesadas. O BarraCuda também é fornecido com uma garantia limitada de 5 anos.',309.99,5,'2021-04-17 01:02:29','2021-04-17 01:02:29'),(11,'http://static3.tcdn.com.br/img/img_prod/720116/fonte_atx_860w_ax860i_full_modular_digital_80plus_platinum_cp_9020037_ww_83649_6_20201213233103.jpg','Corsair 860W AX860i 80 Plus','A revolucionária AXi é a primeira série de fontes de alimentação para desktop a usar controle digital (DSP) e Corsair Link para levar a você um nível sem precedentes de monitoramento e personalização de desempenho.',1195.99,6,'2021-04-17 01:02:53','2021-04-17 01:02:53'),(12,'https://cdn.mos.cms.futurecdn.net/tnTr7yG3Zrc3tn2vA9jGJW-1200-80.jpg','Seasonic FOCUS SGX-650 650W','A fonte de alimentação SFX-L modular Seasonic FOCUS SGX Série 650W 80 Plus Gold é uma unidade eficiente e durável projetada para fornecer energia consistente para sistemas de fator de forma pequeno. Graças aos cabos modulares, você pode conectar os necessários e armazenar o restante para reduzir a confusão de cabos e melhorar o fluxo de ar. Já para refrigeração está equipado com ventoinha de 120mm.',651.53,6,'2021-04-17 01:03:20','2021-04-17 01:03:20'),(13,'https://scontent.fcxj1-1.fna.fbcdn.net/v/t31.18172-8/19250778_1396339603792769_1557449220488019688_o.jpg?_nc_cat=101&ccb=1-3&_nc_sid=973b4a&_nc_ohc=-pbNn3SixesAX8pqYsr&_nc_ht=scontent.fcxj1-1.fna&oh=ed2b447261bceecee8bd43d7ff5c70e2&oe=609B3B96','Corsair Carbide 400C','Lindamente simples e projetado para desempenho: o Carbide Clear 400C, com janela de tamanho completo e tecnologia de resfriamento Direct Airflow, é compacto, expansível e lindo.',409,7,'2021-04-17 01:03:43','2021-04-17 01:03:43'),(14,'https://3dnews.ru/assets/external/illustrations/2019/05/07/987047/tg1.jpg','Aerocool Cylon Pro RGB','Caixa de torre média de alto desempenho com um design elegante de LED RGB no painel frontal. Vem com um painel lateral de vidro completo para mostrar o interior do seu equipamento. Os orifícios de ventilação nas laterais do painel frontal proporcionam fluxo de ar e ventilação superiores. Dê vida ao seu case com 13 modos de iluminação: 6 modos de fluxo RGB e 7 modos de cor estática.',329.99,7,'2021-04-17 01:04:14','2021-04-17 01:04:14'),(15,'https://i.redd.it/3j622ci9mi741.jpg','Lian Li Lancool II','O Lancool II possui varias funcionalidades, vem com quatro painéis dobráveis, coberturas modulares para os cabos e uma baía de drives ajustável, tudo isto num visual moderno e com efeitos RGB no painel frontal e vidro temperado em ambos os lados da caixa.',568.99,7,'2021-04-17 01:04:38','2021-04-17 01:04:38');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
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
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Paulo','paulozaneripe@hotmail.com','$2y$10$7gpVrlL2fu8G1SbhIPXggu4n9a6q.Jl4hpKTHJTEbobzU6ffuL.4u',1,'2021-04-16 23:59:51','2021-04-16 23:59:51'),(2,'Ramon','rserravasconcelos@gmail.com','$2y$10$uhv6Vs04Pb48xMOhK9is0eQGHcBnSPxXmyEvWQhf1qG40LZcFWOA2',1,'2021-04-17 04:35:07','2021-04-17 04:35:07'),(3,'Lucas','lucasbastos@gmail.com','$2y$10$oomDwEhCs9AUJEuQCGQLQes7WeNuTqR./PPvIXCLz76w7DHsPVRci',0,'2021-04-17 04:40:12','2021-04-17 04:40:12');
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

-- Dump completed on 2021-04-18 21:05:07
