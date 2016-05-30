-- MySQL dump 10.13  Distrib 5.6.28, for Win32 (AMD64)
--
-- Host: localhost    Database: aliadvanced
-- ------------------------------------------------------
-- Server version	5.6.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cart_id`),
  KEY `user_id` (`user_id`),
  KEY `product` (`product_id`,`user_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (13,78,3,1,0,'2016-05-14 04:33:35'),(15,112,1,3,0,'2016-05-29 07:50:13');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(32) NOT NULL,
  `parent_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  KEY `parent_category_id` (`parent_category_id`),
  CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_category_id`) REFERENCES `categories` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Women’s Clothing',NULL),(2,' 	Men’s Clothing',NULL),(3,'Phones & Accessories 	',NULL),(4,'Computer & Office',NULL),(5,'Consumer Electronics 	',NULL),(6,'Jewelry & Watches',NULL),(7,'Home & Garden',NULL),(8,' 	Bags & Shoes',NULL),(9,'Toys, Kids & Baby',NULL),(10,'Sports & Outdoors 	',NULL),(11,'Health & Beauty',NULL),(12,'Automobiles & Motorcycles 	',NULL),(13,'Home Improvement 	',NULL),(14,'Hot Categories',1),(15,'Bottoms',1),(19,'Dresses',1),(20,'Blouses & Shirts',1),(21,'Jackets & Coats',1),(22,'Tops & Tees',1),(23,'Accessories',1),(24,'Bottoms',1),(25,'Intimates',1),(26,'Jumpsuits & Rompers',1),(27,'Suits & Sets',1),(28,'Hoodies & Sweatshirts',1),(29,'Socks & Hosiery',1),(30,'Sleep & Lounge',1),(31,'Sweaters',1),(32,'Swimwear',1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_pages`
--

DROP TABLE IF EXISTS `company_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_pages` (
  `company_page_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_title` varchar(32) NOT NULL,
  `company_description` text NOT NULL,
  PRIMARY KEY (`company_page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_pages`
--

LOCK TABLES `company_pages` WRITE;
/*!40000 ALTER TABLE `company_pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorite_products`
--

DROP TABLE IF EXISTS `favorite_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorite_products` (
  `favorite_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`favorite_product_id`),
  UNIQUE KEY `favorite` (`user_id`,`product_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `favorite_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  CONSTRAINT `favorite_products_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite_products`
--

LOCK TABLES `favorite_products` WRITE;
/*!40000 ALTER TABLE `favorite_products` DISABLE KEYS */;
INSERT INTO `favorite_products` VALUES (17,82,3);
/*!40000 ALTER TABLE `favorite_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1462453647),('m130524_201442_init',1462453649);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_photos`
--

DROP TABLE IF EXISTS `product_photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_photos` (
  `product_photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `product_photo_name` varchar(1024) NOT NULL,
  PRIMARY KEY (`product_photo_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_photos_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_photos`
--

LOCK TABLES `product_photos` WRITE;
/*!40000 ALTER TABLE `product_photos` DISABLE KEYS */;
INSERT INTO `product_photos` VALUES (1,78,'14639899301.jpg'),(2,78,'14639899306.jpg'),(3,78,'14639899315.jpg'),(4,78,'14639899312.jpg'),(5,78,'14639899323.jpg'),(6,78,'14639899324.jpg'),(7,78,'14639899327.jpg');
/*!40000 ALTER TABLE `product_photos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_ratings`
--

DROP TABLE IF EXISTS `product_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_ratings` (
  `product_rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_score` tinyint(4) NOT NULL,
  PRIMARY KEY (`product_rating_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_ratings_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  CONSTRAINT `product_ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_ratings`
--

LOCK TABLES `product_ratings` WRITE;
/*!40000 ALTER TABLE `product_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(1024) NOT NULL,
  `product_description` varchar(2048) NOT NULL,
  `product_price` double NOT NULL,
  `product_photo` varchar(256) NOT NULL,
  `product_state` int(11) NOT NULL,
  `product_count` int(11) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`),
  KEY `product_category_id` (`product_category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_category_id`) REFERENCES `categories` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (78,'New Fashion 2016 Summer women dresses sexy o-neck Black and red dress Casual Short sleeve pockets mini Dress(China (Mainland))','',6.98,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(79,'new arrivals 2016 women dresses sexy celebrity mid calf red white bandage dress spaghetti strap club long party dress HL434(China (Mainland))','',45.65,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(80,'Simplee Apparel Elegant gray sleeveless knitted casual dress Women evening party sexy bodycon dress Girls Spring short vestidos(China (Mainland))','',11.79,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(81,'Gagaopt 2016 New Arrival Sleeveless Summer Dresses Letter Print Sexy Slim Dresses Sheath Side Split Women Dresses Vestidos Robes(China (Mainland))','',11.19,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(82,'2015 new fashion women strap white beige black V neck women sexy mini evening party bandage Dresses(China (Mainland))','',27.55,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(83,'Sleeveless floral 60s vintage dress 50s swing pinup vestidos summer style women o neck Masquerade rockabilly dress belt 2016(China (Mainland))','',24.43,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(84,'Plus Size XL European Summer Sexy Dress Women Vestidos Round Neck Sleeveless Vintage Print Casual A-Line Dresses LYQ867(China (Mainland))','',8.76,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(85,'SheIn 2016 New Fashion Women Summer Dresses Ladies Casual Sleeveless Contrast Lace Polka Dot Ruffle Loose Mini Dress(China (Mainland))','',17.98,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(86,'new spring and summer vintage fashion dress sleeveless printed art slim dress European embroidery casual one piece dress(China (Mainland))','',10.35,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(87,'2016 New Womens Elegant Faux Twinset Belted  Dots Tartan Floral Lace Patchwork Wear to Work Business Pencil Sheath Bodycon Dress(China (Mainland))','',12.19,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(88,'2016 Summer Style Sexy Hip Women Denim Dress Slim Plus Size Casual Club Bodycon Jeans Women Dress(China (Mainland))','',21.84,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(89,'Women Summer Dress 2016 plus size clothing Audrey hepburn Floral robe Retro Swing Casual 50s Vintage Rockabilly Dresses Vestidos(China (Mainland))','',25.24,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(90,'New Women Summer Floral Print Retro Vintage 50s 60s Casual Party Rockabilly Pinup Dresses Ladies Swing Elegant Dresses Plus Size(China (Mainland))','',12.23,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(91,'ACEVOG Women Bandage Bodycon Dress Sexy vestidos 2016 Lady Elegant Spring Summer Leopard V-Neck Long Sleeve Stretch Pencil Dress(China (Mainland))','',13.4,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(92,'2016 New Summer Lace Derss Women Sleeveless Slim Bodycon Vintage Dress Patchwork Office Casual Base Dress Plus Size XXL dress(China (Mainland))','',10.3,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(93,'New European 2016 Spring Women&#39;s Lace Hollow Out Long Dresses Bohemian Femme Casual Clothing Women Sexy Slim Party Dress Vestido(China (Mainland))','',17.59,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(94,'Sale Special Offer Limited Natural Vintage Robe 2016 Spring Dresses Fashion Vestidos Long Sleeved Plus Size Women Lace Dress(China (Mainland))','',17.47,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(95,'2016 New Women Denim Dresses Summer Fashion Elegant Ladies Thin Turn Down Collar Long Office Party Dresses Vestidos Femininos(China (Mainland))','',19.5,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(96,'Women Summer Dress 2016 Off Shoulder Strapless Tunic Women Dress Big Size Lace Dress Long Sleeve Sexy Mini Sundress Robe Femme(China (Mainland))','',14.88,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(97,'Vestidos 2016 Love Heart Print Slim Pencil Dresses Party Plus Size Women Clothing Cute Casual Bandage Bodycon Summer Dress Robe(China (Mainland))','',9.83,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(98,'OTHERMIX 2016 spring new cherry print camisole dress halter dress woman(China (Mainland))','',27.19,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(99,'Women Spring Style 2016 Newest Shift Dresses Beautiful Black Long Sleeve Floral Print Round Neck Chiffon Short Dress(China (Mainland))','',11.92,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(100,'LANLAN Solid Red Black Audrey Hepburn Style 50s rockabilly Dress 2016 New Summer Sleeveless Bow Sash Women Vintage Retro Dresses(China (Mainland))','',23.08,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(101,'Women Retro Ink Printing Loose Dress Long Section Vintage Dress 2016 Summer Style Round Neck Sleeveless Cotton Dress Plus Size(China (Mainland))','',13.75,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(102,'Vintage floral dress female 2015 Summer Women New Cotton maxi Dress casual Linen Sleeveless blue black Long Dress vestido(China (Mainland))','',11.89,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(103,'Womens Summer Dress 2016 New Arrival Hepburn Style 1950s Vintage Dresses Round Neck Sleeveless Floral Print Dress With Belt(China (Mainland))','',16.3,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(104,'COLROVE Sexy Summer Style 2016 New Arrival Bodycon Dresses Women Fitness Grey Oblique Hem Spaghetti Strap Dress(China (Mainland))','',12.99,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(105,'new fashion summer style cotton linen plus size vintage print women casual long loose dress vestido femininos party 2016 dresses(China (Mainland))','',11.98,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(106,'Heyoungirl 2016 Women Dress Mouse Pattern Print Cute Fashion short Sleeve Summer Dresses Sexy Dress Free Shipping Vestidos Robes(China (Mainland))','',11.12,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(107,'2016 New Elegant Women Lace Floral Short Sleeve Casual Party  Mini Dress Summer Dress(China (Mainland))','',7.38,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(108,'Free Shipping 2015 Newest Fashion Beach Summer Style Woman Dress Army Green Slim Bodycon Sexy Party Short Sleeve Women Clothes(China (Mainland))','',9.99,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(109,'floral print strap halter women dresses bohemian leisure beach wear lady mini dress sweet holiday loose lady dressLBAA8193(China (Mainland))','',15.46,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(110,'eSale Womens Autumn Winter Long Sleeve Color Block Front Zipper Slim Bodycon Sheath Party Prom Casual Midi Dress CG078(China (Mainland))','',16.58,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(111,'2016 Casual Women Sexy Pencil Dresss Print Long Sleeve Wear To Office Slim Sheath Office Party Dresses Plus Size 4XL 5XL(China (Mainland))','',11.52,'14639899301.jpg',1,0,19,'2016-05-11 19:39:19'),(112,'Men Polo Shirts Short Sleeve Cotton Turn-down Collar Solid Slim Polo Tees Shirts Fashion Brand Men Tops Tees Sport Shirts 6971(China (Mainland))','',14.77,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(113,'Heybig Brand Clothing New Arrival Swag Men clothing Kanye West I Feel Like Pablo Yeezy Season 3 Hiphop Tee Chinese Size S-3XL(China (Mainland))','',16,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(114,'Hot ! 2016 New Fashion Mens polo shirt Brands, Cotton short-sleeve Polo homme, Casual Loose Breathable Fitness Men polo shirt(China (Mainland))','',9.68,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(115,'Pioneer Camp 2016 new fashion summer t shirt men o-neck cotton comfortable man t-shirt fitness tshirt homme men clothing 522056(China (Mainland))','',12.48,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(116,'HanHent Hermanos T-Shirt Man Breaking Bad T Shirt Men Walter White Cook Tops Heisenberg Men Tops Tees 2016 Summer Fashion New(China (Mainland))','',6.9,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(117,'Summer Men t Shirts 2016 New Fashion Tops Tees Hooded Short Sleeve T Shirt Mens Clothing Casual Tee Shirts hombre t-shirts(China (Mainland))','',10.79,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(118,'Man Casual Camouflage T-shirt Men Cotton Army Tactical Combat T Shirt Military Sport Camo Camp Mens T Shirts Fashion 2016 Tees(China (Mainland))','',9.9,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(119,'Pionner Camp Brand 2016 New Men Polo Shirt Men &#39;s Business &amp; Casual solid polo shirt Short Sleeve breathable golf polo shirts t(China (Mainland))','',12.38,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(120,'Brand Clothing Polo Shirt Solid Casual Polo Homme For Men Tee Shirt Tops High Quality Cotton Slim Fit 102TCG Accpet Custom(China (Mainland))','',9.14,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(121,'2016 New Fashion Summer design funny tee cute t shirt homme men&#39;s Simba Pumba women 100% cotton cool sport tshirt lovely top(China (Mainland))','',8.89,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(122,'2016  Stormtrooper printed t-shirt funny men&#39;s tee shirts Hipster O-neck cool tops(China (Mainland))','',7.79,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(123,'INF Mens |2016 summer kanye west yeezus  T shirt  men skull religious style(China (Mainland))','',11.98,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(124,'HanHent Targaryen Dragon T shirt Men Fire and blood 3D Cotton Short sleeve Stark Wolf Tshirt Game of Thrones T-shirt Swag Casual(China (Mainland))','',6.99,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(125,'Hot Sale 2016 New Fashion Mens Polo Shirt Striped Slim Fit Short Sleeve Polo Mens Clothing Summer Trend Men Polo Shirt 5XL(China (Mainland))','',10.99,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(126,'New arrival steam punk style cat/owl/Chameleon vintage printed men&#39;s casual t-shirt male retro design funny tops/tee(China (Mainland))','',8.79,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(127,'Free Shipping 2014 Men&#39;s Popular Appliques Pattern Short Sleeve Cotton T shirts  Casual Sporty T Shirts S--XL over 40 models(China (Mainland))','',14.73,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(128,'men t shirt 2016 tees summer style fashion men t shirt short sleeve Mens brand sports Camel Animal Print  sleeved cotton fashion(China (Mainland))','',5.22,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(129,'E Baihui design 3XL Men fashion 3d Printed Skull O-NECK t shirt Summer Slim Short Sleeve Brand Clothing men swag wear Y049(China (Mainland))','',10.99,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(130,'Free shipping solid color long sleeves T shirt men,full sleeves mens Tees, lycra cotton tight fit casual tops men(China (Mainland))','',11.1,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(131,'2015 Summer Men Polo Shirt Flag Style Black Yellow White Plus Size embroidery Breathable Cotton Polo Shirts E5036(China (Mainland))','',11.98,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(132,'2015 Men&#39;s Fashion Tshirts Schrodinger&#39;s Cat The Big Bang Theory Cotton Short Sleeve O-neck Tops Tees Summer Swag T-shirt TA0164(China (Mainland))','',7.21,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(133,'Mens Gym Shark Hoodie Stringer Tank Top Men Gymshark Workout Fitness Vest Men&#39;s Singlets Sports Top Tees Sleeveless Sweatshirts(China (Mainland))','',13.97,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(134,'CXT03-C1 Top quality COTTON o neck heisenberg men tshirt short sleeve print casual breaking bad print T shirt for men 2015(China (Mainland))','',6.99,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(135,'Harajuku Style Fashion Men V-Neck T Shirt Swag Punk Rock Mens 3d T-shirt Skull tshirt Buddha Tee Shirts Casual Streetwear,mtx146(China (Mainland))','',12,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(136,'2016 New Brand Men Polo Shirt Mens Solid Polo homme Casual Short Sleeve Sport Golf Tennis  Patchwork 100% Cotton Plus Size 016(China (Mainland))','',12.87,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(137,'The Punisher Vintage Bodybuilding Stringer Tank Top Men Gym Singlet Fitness Sleeveless  Workout Vest Cotton Sport Y BACK Racer(China (Mainland))','',4.89,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(138,'Summer New Brand Fashion Element Skateboard Streetwear Cotton Man T-shirts Tops Tees Short Sleeve Casual T Shirts(China (Mainland))','',7.99,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(139,'Men&#39;s Tank Tops Fashion 100% Cotton Brand Sport Sleeveless Undershirts For Male Bodybuilding Tank Tops White Casual Summer Vest(China (Mainland))','',5.62,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(140,'2015 New Fashion Brand Trend Print Slim Fit Long Sleeve T Shirt Men Tee V-Neck Casual Men T-Shirt  Cotton T Shirts Plus Size 5XL(China (Mainland))','',13.99,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(141,'Summer Style Sport T Shirt Men LINGSAI 2016 New Brand Sales Camisas Quick Dry Slim Fit Running T-shirt Men&#39;s Clothing Camisetas(China (Mainland))','',8.89,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(142,'Join The Empire Fashion Star Wars Men T Shirts Short Sleeve Yoda/Darth Vader Cartoon Man t-shirts Cool Storm Trooper Tee Shirt(China (Mainland))','',7.98,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(143,'Men&#39;s short-sleeved Polo shirt black and white irregular stitching personality summer casual men&#39;s lapel POLO 4XL / 5XL / 6XL(China (Mainland))','',16.05,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(144,'2016 New funny tee cute t shirts homme Pumba men women 100% cotton cool sport tshirt lovely kawaii summer jersey costume t-shirt(China (Mainland))','',10.19,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(145,'Camel Summer New Arrival Men&#39;s T-shirts Polka Dot Top Business Casual Men Tops O Neck Plus Size XXXL T-shirts Men X6B201435(China (Mainland))','',33.9,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(146,'E-BAIHUI  Summer Men Cotton Clothing Dsq  T-shirtS Camisetas T-Shirt Fitness tops TeeS Skateboard Moleton mens t-shirts  Y032(China (Mainland))','',7.7,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(147,'2016 New Cotton Math Geometry Print Short Sleeve Summer T Shirt Men O-neck T Shirt Size M-6XL(China (Mainland))','',8.66,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(148,'2016 Fashion Mens Polo Short Sleeve Print Slim Fit Shirts For Men Polo Shirts Summer Plus Size 4XL 5XL Camisa Polo Masculina(China (Mainland))','',15.48,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(149,'Hip hop fashion men t shirt 3d eminem/unkut print compression t-shirt crossfit tshirt homme camisetas hombre fitness clothes(China (Mainland))','',7.04,'14639899301.jpg',1,0,2,'2016-05-12 04:17:24'),(150,'Ulefone Power Smartphone Big Battery 4G LTE 5.5 Inch FHD MTK6753 Octa Core Android 5.1 Mobile Cell Phone 3GB RAM 16GB ROM 13MP(China (Mainland))','',169.99,'14639899301.jpg',1,0,3,'2016-05-12 04:27:44'),(151,'Ulefone Power 4G 5.5&quot; FHD 1080P Smartphone Android 5.1 Octa Core MT6753 3GB+16GB 13MP 6050mAh OTG Fingerprint ID Mobile Phone(China (Mainland))','',159.99,'14639899301.jpg',1,0,3,'2016-05-12 04:27:44'),(152,'RU Stock!Original Leagoo Elite 1 5 inch FHD 16MP+13MP FDD LTE Mobile Phone Octa core 3GB RAM 32GB ROM Fingerprint ID Android 5.1(China (Mainland))','',169.99,'14639899301.jpg',1,0,3,'2016-05-12 04:27:44'),(153,'Oukitel U10 5.5 FHD Andorid 5.1 MTK6753 Octa Core Smartphone Touch ID 3G RAM 16G ROM 4G LTE Cellphone(China (Mainland))','',115.99,'14639899301.jpg',1,0,3,'2016-05-12 04:27:44'),(154,'TCL 3N M2U 4G LTE 5.5 Inch MTK6752M 1.5GHz Octa Core 2GB RAM 16GB ROM Dual SIM Smartphone 1280*720 HD 8.0MP+13.0MP Android 4.4(China (Mainland))','',103.65,'14639899301.jpg',1,0,3,'2016-05-12 04:27:44'),(155,'UMI TOUCH 4G LTE 5.5 Inch 2.5D FHD MT6753 1.3GHz Octa Core 3GB RAM 16GB ROM Smartphone 1920*1080 LCD Android 6.0 4000mAh Battery(China (Mainland))','',149.99,'14639899301.jpg',1,0,3,'2016-05-12 04:27:44'),(156,'Original BLUBOO XTOUCH X500 MTK6753 Octa Core 4G Mobile Phone 5.0&#39;&#39; FHD 3GB RAM 32GB ROM Android 5.1 13MP 3050mAh Fingerprint(China (Mainland))','',139.99,'14639899301.jpg',1,0,3,'2016-05-12 04:27:44'),(157,'Jiayu S3 S3+ Plus Octa Core mtk6753 1.3Ghz 3GB Ram 16GB Rom Dual SIM GPS 3000mAh 13MP Camera 4G TDD FDD LTE Russia smartphone(China (Mainland))','',154.99,'14639899301.jpg',1,0,3,'2016-05-12 04:27:44'),(158,'Original THL T7 LTE 4G Cell Phone MT6753 Octa Core 1280*720P 5.5&quot; 3G RAM 16G ROM  Android 5.1 Phone 13MP 4800mAh Fingerprint ID(China (Mainland))','',139.99,'14639899301.jpg',1,0,3,'2016-05-12 04:27:44'),(159,'Original HTC Desire 826 826w Unlocked Mobile phone Dual SIM Dual 4G LTE 5.5&quot; 13MP Camera 16GB ,Free DHL-EMS shipping(Hong Kong)','',191,'14639899301.jpg',1,0,3,'2016-05-12 04:27:44'),(160,'Original 5.5 inch FHD Jiayu S3 plus S3+ Android 5.1 Smart cellphone MTK6753 Octa Core 3GB/16GB 3000mAh Battery Dual SIM(China (Mainland))','',155.79,'14639899301.jpg',1,0,3,'2016-05-12 04:27:44'),(161,'UMI TOUCH 4G LTE 5.5 Inch 2.5D FHD MT6753 1.3GHz Octa Core 3GB RAM 16GB ROM Smartphone 1920*1080 LCD Android 6.0 4000mAh Battery(China (Mainland))','',149.99,'14639899301.jpg',1,0,3,'2016-05-12 04:27:44'),(163,'','',0,'14639899301.jpg',0,0,1,'2016-05-17 12:51:10');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'User'),(2,'Moderator'),(3,'Administrator');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles_access`
--

DROP TABLE IF EXISTS `roles_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles_access` (
  `role_access_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `controller` varchar(64) NOT NULL,
  `action` varchar(32) NOT NULL,
  `allow` tinyint(1) NOT NULL,
  PRIMARY KEY (`role_access_id`),
  UNIQUE KEY `action` (`action`,`controller`,`role_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `roles_access_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles_access`
--

LOCK TABLES `roles_access` WRITE;
/*!40000 ALTER TABLE `roles_access` DISABLE KEYS */;
INSERT INTO `roles_access` VALUES (1,3,'CategoriesController','Index',1),(2,3,'CategoriesController','View',1),(3,3,'CategoriesController','Create',1),(4,3,'CategoriesController','Update',1),(5,3,'CategoriesController','Delete',1),(6,3,'DefaultController','Index',1),(7,3,'ProductsController','Index',1),(8,3,'ProductsController','View',1),(9,3,'ProductsController','Create',1),(10,3,'ProductsController','Update',1),(11,3,'ProductsController','RealDelete',1),(12,3,'ProductsController','Delete',1),(14,3,'ProductsController','Fillup',1),(15,3,'ProductsController','Createpost',1),(16,3,'ProductsController','Upload',1),(18,3,'ProductsController','Deletephoto',1),(19,3,'RolesController','Index',1),(20,3,'RolesController','View',1),(21,3,'RolesController','Create',1),(23,3,'RolesController','Update',1),(24,3,'RolesController','Delete',1),(25,3,'RolesaccessController','Index',1),(26,3,'RolesaccessController','View',1),(28,3,'RolesaccessController','Create',1),(29,3,'RolesaccessController','Update',1),(30,3,'RolesaccessController','Delete',1),(31,3,'UserController','Index',1),(32,3,'UserController','View',1),(33,3,'UserController','Create',1),(35,3,'UserController','Update',1),(36,3,'UserController','Delete',1),(37,3,'RolesaccessController','Fillup',1),(38,3,'RolesaccessController','Checkit',1),(39,1,'CategoriesController','index',0),(40,1,'CategoriesController','view',0),(41,1,'CategoriesController','create',0),(42,1,'CategoriesController','update',0),(43,1,'CategoriesController','delete',0),(44,1,'DefaultController','index',0),(45,1,'ProductsController','index',0),(46,1,'ProductsController','view',0),(47,1,'ProductsController','create',0),(48,1,'ProductsController','update',0),(49,1,'ProductsController','realdelete',0),(50,1,'ProductsController','delete',0),(51,1,'ProductsController','fillup',0),(52,1,'ProductsController','createpost',0),(53,1,'ProductsController','upload',0),(54,1,'ProductsController','deletephoto',0),(55,1,'RolesController','index',0),(56,1,'RolesController','view',0),(57,1,'RolesController','create',0),(58,1,'RolesController','update',0),(59,1,'RolesController','delete',0),(60,1,'RolesaccessController','index',0),(61,1,'RolesaccessController','view',0),(62,1,'RolesaccessController','create',0),(63,1,'RolesaccessController','update',0),(64,1,'RolesaccessController','delete',0),(65,1,'RolesaccessController','checkit',0),(66,1,'RolesaccessController','fillup',0),(67,1,'UserController','index',0),(68,1,'UserController','view',0),(69,1,'UserController','create',0),(70,1,'UserController','update',0),(71,1,'UserController','delete',0),(72,1,'UserController','initroledb',0),(73,2,'CategoriesController','index',1),(74,2,'CategoriesController','view',1),(75,2,'CategoriesController','create',1),(76,2,'CategoriesController','update',1),(77,2,'CategoriesController','delete',1),(78,2,'DefaultController','index',1),(79,2,'ProductsController','index',1),(80,2,'ProductsController','view',1),(81,2,'ProductsController','create',1),(82,2,'ProductsController','update',1),(83,2,'ProductsController','realdelete',1),(84,2,'ProductsController','delete',1),(85,2,'ProductsController','fillup',1),(86,2,'ProductsController','createpost',1),(87,2,'ProductsController','upload',1),(88,2,'ProductsController','deletephoto',1),(89,2,'RolesController','index',1),(90,2,'RolesController','view',1),(91,2,'RolesController','create',1),(92,2,'RolesController','update',1),(93,2,'RolesController','delete',1),(94,2,'RolesaccessController','index',1),(95,2,'RolesaccessController','view',1),(96,2,'RolesaccessController','create',1),(97,2,'RolesaccessController','update',1),(98,2,'RolesaccessController','delete',1),(99,2,'RolesaccessController','checkit',1),(100,2,'RolesaccessController','fillup',1),(101,2,'UserController','index',1),(102,2,'UserController','view',1),(103,2,'UserController','create',1),(104,2,'UserController','update',1),(105,2,'UserController','delete',1),(106,2,'UserController','initroledb',1),(140,3,'UserController','initroledb',1);
/*!40000 ALTER TABLE `roles_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `role` int(11) NOT NULL DEFAULT '1',
  `incart_count` int(11) NOT NULL,
  `favorites_count` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','V4Rl_XzDdG6UJ9tBcEBrRqK_XCfyChzz','$2y$13$NTbl6E1oEIqY1qoIun8Z8us6fZmab/gOEs9/zdc4p7wjYCjkuC1a.',NULL,'javlon@gmail.com',10,3,1,0,'0000-00-00 00:00:00','2016-05-29 07:50:13'),(2,'javlonuser','_d-8LzBHIlVQsLRR6ETAqBMA2t39oNEr','$2y$13$U7TXi7quFaTPtd.PMHJQeO9ImY0F8xIhPVih3HK8C4gvHIrFS4JNW',NULL,'javlonuser@gmail.com',10,2,0,0,'0000-00-00 00:00:00','2016-05-17 12:43:22'),(3,'javlon','WxLisCtGlc4oiQDNRoOnh4SzhV7agu28','$2y$13$MzB97uutYroOaXEwoCZvFexmDpxhDMOFyQ0OZas8/ZQtiTAGNHsKi',NULL,'javlonuser@yahoo.com',10,1,1,1,'0000-00-00 00:00:00','2016-05-16 16:47:51'),(4,'name','w972U5FYS8nLMLX8JhUV5FH5l0R65pyV','$2y$13$LeyXPwTFj4w.t6aRyDOkkO7CGhQXOmgsBuZF3klEDO3J3Bnb/dsCC',NULL,'name@name.com',10,1,0,0,'2016-05-19 17:07:31','2016-05-19 17:11:55');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-30 12:21:41
