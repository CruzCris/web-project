CREATE DATABASE  IF NOT EXISTS `tienda` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tienda`;
-- MySQL dump 10.13  Distrib 8.0.24, for Win64 (x86_64)
--
-- Host: localhost    Database: tienda
-- ------------------------------------------------------
-- Server version	5.7.34-log

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`idAdmin`),
  KEY `email_idx` (`email`),
  CONSTRAINT `email` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (3,'juanf@gmail.com');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrito`
--

DROP TABLE IF EXISTS `carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrito` (
  `idCliente` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idVenta` varchar(7) DEFAULT NULL,
  KEY `idCliente_idx` (`idCliente`),
  KEY `idProducto_idx` (`idProducto`),
  KEY `idVenta_idx` (`idVenta`),
  CONSTRAINT `idCliente` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idProducto` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idVenta` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito`
--

LOCK TABLES `carrito` WRITE;
/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
INSERT INTO `carrito` VALUES (1,2,1,'6597238'),(4,55,2,'8739026'),(4,50,1,'8739026'),(5,56,3,'7465308'),(5,49,2,'7465308'),(1,88,1,'6597238'),(4,92,1,'8739026'),(4,90,1,'8739026'),(4,93,1,'8739026'),(1,87,1,'6597238'),(5,13,1,'7465308'),(5,14,1,'7465308'),(5,36,1,'9623748'),(5,49,1,'9623748');
/*!40000 ALTER TABLE `carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(45) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Beauty'),(2,'Fragances'),(3,'Furniture'),(4,'Groceries'),(5,'Home-Decoration'),(6,'Kitchen-Accesories'),(7,'Laptops'),(8,'Men-Shirts'),(9,'Mens-Shoes'),(10,'Mens-Watches'),(11,'Mobile-Accesories'),(12,'Beauty'),(13,'Fragances'),(14,'Furniture'),(15,'Groceries'),(16,'Home-Decoration'),(17,'Kitchen-Accesories'),(18,'Laptops'),(19,'Men-Shirts'),(20,'Mens-Shoes'),(21,'Mens-Watches'),(22,'Mobile-Accesories'),(23,'Beauty'),(24,'Fragances'),(25,'Furniture'),(26,'Groceries'),(27,'Home-Decoration'),(28,'Kitchen-Accesories'),(29,'Laptops'),(30,'Men-Shirts'),(31,'Mens-Shoes'),(32,'Mens-Watches'),(33,'Mobile-Accesories'),(34,'Beauty'),(35,'Fragances'),(36,'Furniture'),(37,'Groceries'),(38,'Home-Decoration'),(39,'Kitchen-Accesories'),(40,'Laptops'),(41,'Men-Shirts'),(42,'Mens-Shoes'),(43,'Mens-Watches'),(44,'Mobile-Accesories');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `monedero` double NOT NULL,
  PRIMARY KEY (`idCliente`),
  KEY `email_idx` (`email`),
  CONSTRAINT `email2` FOREIGN KEY (`email`) REFERENCES `usuario` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'david@gmail.com',9811.949),(2,'emilia123@gmail.com',10000),(3,'gerardo_j123@gmail.com',10000),(4,'carlitos@gmail.com',9724.817),(5,'carmen@gmail.com',8312.93);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` double NOT NULL,
  `descuento` double NOT NULL,
  `idCategoria` int(11) NOT NULL,
  PRIMARY KEY (`idProducto`),
  KEY `idCategoria_idx` (`idCategoria`),
  CONSTRAINT `idCategoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=401 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'Essence Mascara Lash Princess',5,9.99,7.17,1),(2,'Eyeshadow Palette with Mirror',43,19.99,5.5,1),(3,'Powder Canister',58,14.99,18.14,1),(4,'Red Lipstick',68,12.99,19.03,1),(5,'Red Nail Polish',71,8.99,2.46,1),(6,'Calvin Klein CK One',18,49.99,0.32,2),(7,'Chanel Coco Noir Eau De',41,129.99,18.64,2),(8,'Dior J\'adore',91,89.99,17.44,2),(9,'Dolce Shine Eau de',3,69.99,11.47,2),(10,'Gucci Bloom Eau de',93,79.99,8.9,2),(11,'Annibale Colombo Bed',47,1899.99,0.29,3),(12,'Annibale Colombo Sofa',16,2499.99,18.54,3),(13,'Bedside Table African Cherry',15,299.99,9.58,3),(14,'Knoll Saarinen Executive Conference Chair',46,499.99,15.23,3),(15,'Wooden Bathroom Sink with Mirror',95,799.99,11.22,3),(16,'Apple',9,1.99,1.97,4),(17,'Beef Steak',96,12.99,17.99,4),(18,'Cat Food',13,8.99,9.57,4),(19,'Chicken Meat',69,9.99,10.46,4),(20,'Cooking Oil',22,4.99,18.89,4),(21,'Cucumber',22,1.49,11.44,4),(22,'Dog Food',39,10.99,18.15,4),(23,'Eggs',10,2.99,5.8,4),(24,'Fish Steak',99,14.99,7,4),(25,'Green Bell Pepper',89,1.29,15.5,4),(26,'Green Chili Pepper',8,0.99,18.51,4),(27,'Honey Jar',25,6.99,1.91,4),(28,'Ice Cream',76,5.49,7.58,4),(29,'Juice',99,3.99,5.45,4),(30,'Kiwi',1,2.49,10.32,4),(31,'Lemon',0,0.79,17.81,4),(32,'Milk',57,3.49,15.09,4),(33,'Mulberry',78,4.99,16.35,4),(34,'Nescafe Coffee',22,7.99,11.65,4),(35,'Potatoes',8,2.29,4.05,4),(36,'Protein Powder',63,19.99,1.58,4),(37,'Red Onions',86,1.99,17.89,4),(38,'Rice',49,5.99,12.02,4),(39,'Soft Drinks',78,1.99,1.88,4),(40,'Strawberry',9,3.99,19.59,4),(41,'Tissue Paper Box',94,2.49,15.44,4),(42,'water',93,0.99,13.71,4),(43,'Decoration Swing',62,59.99,0.65,5),(44,'Family Tree Photo Frame',34,29.99,1.53,5),(45,'House Showpiece Plant',89,39.99,19.45,5),(46,'Plant Pot',70,14.99,0.19,5),(47,'Table Lamp',83,49.99,0.59,5),(48,'Bamboo Spatula',0,7.99,4.85,6),(49,'Black Aluminium Cup',38,5.99,9.22,6),(50,'Black whisk',16,9.99,16.87,6),(51,'Boxed Blender',81,39.99,7.36,6),(52,'Carbon Steel wok',2,29.99,5.89,6),(53,'Chopping Board',53,12.99,17.72,6),(54,'Citrus Squeezer Yellow',59,8.99,12.35,6),(55,'Egg Slicer',28,6.99,9.6,6),(56,'Electric Stove',37,49.99,16.64,6),(57,'Fine Mesh Strainer',13,9.99,2.56,6),(58,'Fork',10,3.99,14.36,6),(59,'Glass',68,4.99,7.38,6),(60,'Grater Black',79,10.99,3.29,6),(61,'Hand Blender',8,34.99,6.44,6),(62,'Ice Cube Tray',81,5.99,0.95,6),(63,'Kitchen Sieve',33,7.99,9.23,6),(64,'Knife',59,14.99,19.95,6),(65,'Lunch Box',26,12.99,15.33,6),(66,'Microwave Oven',27,89.99,18.73,6),(67,'Mug Tree Stand',93,15.99,15.21,6),(68,'Pan',40,24.99,6.55,6),(69,'Plate',30,3.99,13.03,6),(70,'Red Tongs',15,6.99,18.24,6),(71,'Silver Pot with Glass Cap',37,39.99,4.57,6),(72,'Slotted Turner',36,8.99,7.24,6),(73,'Spice Rack',24,19.99,13.78,6),(74,'Spoon',51,4.99,0.93,6),(75,'Tray',48,16.99,9.93,6),(76,'Wooden Rolling Pin',80,11.99,16.94,6),(77,'Yellow Peeler',85,5.99,17.09,6),(78,'Apple MacBook Pro 14 Inch Space Gray',38,1999.99,9.25,7),(79,'Asus Zenbook Pro Dual Screen Laptop',37,1799.99,9.21,7),(80,'Huawei Matebook X Pro',34,1399.99,15.25,7),(81,'Lenovo Yoga 920',71,1099.99,7.77,7),(82,'New DELL XPS 13 9300 Laptop',18,1499.99,11.7,7),(83,'Blue & Black Check Shirt',44,29.99,1.41,8),(84,'Gigabyte Aorus Men Tshirt',64,24.99,12.6,8),(85,'Man Plaid Shirt',65,34.99,17.53,8),(86,'Man Short Sleeve Shirt',20,19.99,8.65,8),(87,'Men Check Shirt',68,27.99,14.21,8),(88,'Nike Air Jordan 1 Red And Black',14,149.99,15.82,9),(89,'Nike Baseball Cleats',14,79.99,11.4,9),(90,'Puma Future Rider Trainers',9,89.99,3.64,9),(91,'Sports Sneakers Off White & Red',73,119.99,11.69,9),(92,'Sports Sneakers Off White Red',74,109.99,17.22,9),(93,'Brown Leather Belt Watch',68,89.99,15.01,10),(94,'Longines Master Collection',65,1499.99,0.64,10),(95,'Rolex Cellini Date Black Dial',83,8999.99,14.28,10),(96,'Rolex Cellini Moonphase',33,12999.99,5.7,10),(97,'Rolex Datejust',11,10999.99,9.69,10),(98,'Rolex Submariner Watch',35,13999.99,0.82,10),(99,'Amazon Echo Plus',50,99.99,16.3,11),(100,'Apple Airpods',93,129.99,4.82,11),(101,'Essence Mascara Lash Princess',5,9.99,7.17,1),(102,'Eyeshadow Palette with Mirror',44,19.99,5.5,1),(103,'Powder Canister',59,14.99,18.14,1),(104,'Red Lipstick',68,12.99,19.03,1),(105,'Red Nail Polish',71,8.99,2.46,1),(106,'Calvin Klein CK One',17,49.99,0.32,2),(107,'Chanel Coco Noir Eau De',41,129.99,18.64,2),(108,'Dior J\'adore',91,89.99,17.44,2),(109,'Dolce Shine Eau de',3,69.99,11.47,2),(110,'Gucci Bloom Eau de',93,79.99,8.9,2),(111,'Annibale Colombo Bed',47,1899.99,0.29,3),(112,'Annibale Colombo Sofa',16,2499.99,18.54,3),(113,'Bedside Table African Cherry',16,299.99,9.58,3),(114,'Knoll Saarinen Executive Conference Chair',47,499.99,15.23,3),(115,'Wooden Bathroom Sink with Mirror',95,799.99,11.22,3),(116,'Apple',9,1.99,1.97,4),(117,'Beef Steak',96,12.99,17.99,4),(118,'Cat Food',13,8.99,9.57,4),(119,'Chicken Meat',69,9.99,10.46,4),(120,'Cooking Oil',22,4.99,18.89,4),(121,'Cucumber',22,1.49,11.44,4),(122,'Dog Food',40,10.99,18.15,4),(123,'Eggs',10,2.99,5.8,4),(124,'Fish Steak',99,14.99,7,4),(125,'Green Bell Pepper',89,1.29,15.5,4),(126,'Green Chili Pepper',8,0.99,18.51,4),(127,'Honey Jar',25,6.99,1.91,4),(128,'Ice Cream',76,5.49,7.58,4),(129,'Juice',99,3.99,5.45,4),(130,'Kiwi',1,2.49,10.32,4),(131,'Lemon',0,0.79,17.81,4),(132,'Milk',57,3.49,15.09,4),(133,'Mulberry',79,4.99,16.35,4),(134,'Nescafe Coffee',22,7.99,11.65,4),(135,'Potatoes',8,2.29,4.05,4),(136,'Protein Powder',65,19.99,1.58,4),(137,'Red Onions',86,1.99,17.89,4),(138,'Rice',49,5.99,12.02,4),(139,'Soft Drinks',78,1.99,1.88,4),(140,'Strawberry',9,3.99,19.59,4),(141,'Tissue Paper Box',97,2.49,15.44,4),(142,'water',95,0.99,13.71,4),(143,'Decoration Swing',62,59.99,0.65,5),(144,'Family Tree Photo Frame',34,29.99,1.53,5),(145,'House Showpiece Plant',89,39.99,19.45,5),(146,'Plant Pot',70,14.99,0.19,5),(147,'Table Lamp',84,49.99,0.59,5),(148,'Bamboo Spatula',0,7.99,4.85,6),(149,'Black Aluminium Cup',42,5.99,9.22,6),(150,'Black whisk',17,9.99,16.87,6),(151,'Boxed Blender',81,39.99,7.36,6),(152,'Carbon Steel wok',2,29.99,5.89,6),(153,'Chopping Board',53,12.99,17.72,6),(154,'Citrus Squeezer Yellow',59,8.99,12.35,6),(155,'Egg Slicer',30,6.99,9.6,6),(156,'Electric Stove',41,49.99,16.64,6),(157,'Fine Mesh Strainer',13,9.99,2.56,6),(158,'Fork',10,3.99,14.36,6),(159,'Glass',68,4.99,7.38,6),(160,'Grater Black',80,10.99,3.29,6),(161,'Hand Blender',8,34.99,6.44,6),(162,'Ice Cube Tray',81,5.99,0.95,6),(163,'Kitchen Sieve',33,7.99,9.23,6),(164,'Knife',59,14.99,19.95,6),(165,'Lunch Box',26,12.99,15.33,6),(166,'Microwave Oven',27,89.99,18.73,6),(167,'Mug Tree Stand',93,15.99,15.21,6),(168,'Pan',40,24.99,6.55,6),(169,'Plate',30,3.99,13.03,6),(170,'Red Tongs',15,6.99,18.24,6),(171,'Silver Pot with Glass Cap',37,39.99,4.57,6),(172,'Slotted Turner',36,8.99,7.24,6),(173,'Spice Rack',24,19.99,13.78,6),(174,'Spoon',51,4.99,0.93,6),(175,'Tray',48,16.99,9.93,6),(176,'Wooden Rolling Pin',80,11.99,16.94,6),(177,'Yellow Peeler',86,5.99,17.09,6),(178,'Apple MacBook Pro 14 Inch Space Gray',39,1999.99,9.25,7),(179,'Asus Zenbook Pro Dual Screen Laptop',38,1799.99,9.21,7),(180,'Huawei Matebook X Pro',34,1399.99,15.25,7),(181,'Lenovo Yoga 920',71,1099.99,7.77,7),(182,'New DELL XPS 13 9300 Laptop',18,1499.99,11.7,7),(183,'Blue & Black Check Shirt',44,29.99,1.41,8),(184,'Gigabyte Aorus Men Tshirt',64,24.99,12.6,8),(185,'Man Plaid Shirt',65,34.99,17.53,8),(186,'Man Short Sleeve Shirt',20,19.99,8.65,8),(187,'Men Check Shirt',69,27.99,14.21,8),(188,'Nike Air Jordan 1 Red And Black',15,149.99,15.82,9),(189,'Nike Baseball Cleats',14,79.99,11.4,9),(190,'Puma Future Rider Trainers',10,89.99,3.64,9),(191,'Sports Sneakers Off White & Red',73,119.99,11.69,9),(192,'Sports Sneakers Off White Red',75,109.99,17.22,9),(193,'Brown Leather Belt Watch',69,89.99,15.01,10),(194,'Longines Master Collection',65,1499.99,0.64,10),(195,'Rolex Cellini Date Black Dial',84,8999.99,14.28,10),(196,'Rolex Cellini Moonphase',33,12999.99,5.7,10),(197,'Rolex Datejust',11,10999.99,9.69,10),(198,'Rolex Submariner Watch',35,13999.99,0.82,10),(199,'Amazon Echo Plus',50,99.99,16.3,11),(200,'Apple Airpods',93,129.99,4.82,11),(201,'Essence Mascara Lash Princess',5,9.99,7.17,1),(202,'Eyeshadow Palette with Mirror',44,19.99,5.5,1),(203,'Powder Canister',59,14.99,18.14,1),(204,'Red Lipstick',68,12.99,19.03,1),(205,'Red Nail Polish',71,8.99,2.46,1),(206,'Calvin Klein CK One',17,49.99,0.32,2),(207,'Chanel Coco Noir Eau De',41,129.99,18.64,2),(208,'Dior J\'adore',91,89.99,17.44,2),(209,'Dolce Shine Eau de',3,69.99,11.47,2),(210,'Gucci Bloom Eau de',93,79.99,8.9,2),(211,'Annibale Colombo Bed',47,1899.99,0.29,3),(212,'Annibale Colombo Sofa',16,2499.99,18.54,3),(213,'Bedside Table African Cherry',16,299.99,9.58,3),(214,'Knoll Saarinen Executive Conference Chair',47,499.99,15.23,3),(215,'Wooden Bathroom Sink with Mirror',95,799.99,11.22,3),(216,'Apple',9,1.99,1.97,4),(217,'Beef Steak',96,12.99,17.99,4),(218,'Cat Food',13,8.99,9.57,4),(219,'Chicken Meat',69,9.99,10.46,4),(220,'Cooking Oil',22,4.99,18.89,4),(221,'Cucumber',22,1.49,11.44,4),(222,'Dog Food',40,10.99,18.15,4),(223,'Eggs',10,2.99,5.8,4),(224,'Fish Steak',99,14.99,7,4),(225,'Green Bell Pepper',89,1.29,15.5,4),(226,'Green Chili Pepper',8,0.99,18.51,4),(227,'Honey Jar',25,6.99,1.91,4),(228,'Ice Cream',76,5.49,7.58,4),(229,'Juice',99,3.99,5.45,4),(230,'Kiwi',1,2.49,10.32,4),(231,'Lemon',0,0.79,17.81,4),(232,'Milk',57,3.49,15.09,4),(233,'Mulberry',79,4.99,16.35,4),(234,'Nescafe Coffee',22,7.99,11.65,4),(235,'Potatoes',8,2.29,4.05,4),(236,'Protein Powder',65,19.99,1.58,4),(237,'Red Onions',86,1.99,17.89,4),(238,'Rice',49,5.99,12.02,4),(239,'Soft Drinks',78,1.99,1.88,4),(240,'Strawberry',9,3.99,19.59,4),(241,'Tissue Paper Box',97,2.49,15.44,4),(242,'water',95,0.99,13.71,4),(243,'Decoration Swing',62,59.99,0.65,5),(244,'Family Tree Photo Frame',34,29.99,1.53,5),(245,'House Showpiece Plant',89,39.99,19.45,5),(246,'Plant Pot',70,14.99,0.19,5),(247,'Table Lamp',84,49.99,0.59,5),(248,'Bamboo Spatula',0,7.99,4.85,6),(249,'Black Aluminium Cup',42,5.99,9.22,6),(250,'Black whisk',17,9.99,16.87,6),(251,'Boxed Blender',81,39.99,7.36,6),(252,'Carbon Steel wok',2,29.99,5.89,6),(253,'Chopping Board',53,12.99,17.72,6),(254,'Citrus Squeezer Yellow',59,8.99,12.35,6),(255,'Egg Slicer',30,6.99,9.6,6),(256,'Electric Stove',41,49.99,16.64,6),(257,'Fine Mesh Strainer',13,9.99,2.56,6),(258,'Fork',10,3.99,14.36,6),(259,'Glass',68,4.99,7.38,6),(260,'Grater Black',80,10.99,3.29,6),(261,'Hand Blender',8,34.99,6.44,6),(262,'Ice Cube Tray',81,5.99,0.95,6),(263,'Kitchen Sieve',33,7.99,9.23,6),(264,'Knife',59,14.99,19.95,6),(265,'Lunch Box',26,12.99,15.33,6),(266,'Microwave Oven',27,89.99,18.73,6),(267,'Mug Tree Stand',93,15.99,15.21,6),(268,'Pan',40,24.99,6.55,6),(269,'Plate',30,3.99,13.03,6),(270,'Red Tongs',15,6.99,18.24,6),(271,'Silver Pot with Glass Cap',37,39.99,4.57,6),(272,'Slotted Turner',36,8.99,7.24,6),(273,'Spice Rack',24,19.99,13.78,6),(274,'Spoon',51,4.99,0.93,6),(275,'Tray',48,16.99,9.93,6),(276,'Wooden Rolling Pin',80,11.99,16.94,6),(277,'Yellow Peeler',86,5.99,17.09,6),(278,'Apple MacBook Pro 14 Inch Space Gray',39,1999.99,9.25,7),(279,'Asus Zenbook Pro Dual Screen Laptop',38,1799.99,9.21,7),(280,'Huawei Matebook X Pro',34,1399.99,15.25,7),(281,'Lenovo Yoga 920',71,1099.99,7.77,7),(282,'New DELL XPS 13 9300 Laptop',18,1499.99,11.7,7),(283,'Blue & Black Check Shirt',44,29.99,1.41,8),(284,'Gigabyte Aorus Men Tshirt',64,24.99,12.6,8),(285,'Man Plaid Shirt',65,34.99,17.53,8),(286,'Man Short Sleeve Shirt',20,19.99,8.65,8),(287,'Men Check Shirt',69,27.99,14.21,8),(288,'Nike Air Jordan 1 Red And Black',15,149.99,15.82,9),(289,'Nike Baseball Cleats',14,79.99,11.4,9),(290,'Puma Future Rider Trainers',10,89.99,3.64,9),(291,'Sports Sneakers Off White & Red',73,119.99,11.69,9),(292,'Sports Sneakers Off White Red',75,109.99,17.22,9),(293,'Brown Leather Belt Watch',69,89.99,15.01,10),(294,'Longines Master Collection',65,1499.99,0.64,10),(295,'Rolex Cellini Date Black Dial',84,8999.99,14.28,10),(296,'Rolex Cellini Moonphase',33,12999.99,5.7,10),(297,'Rolex Datejust',11,10999.99,9.69,10),(298,'Rolex Submariner Watch',35,13999.99,0.82,10),(299,'Amazon Echo Plus',50,99.99,16.3,11),(300,'Apple Airpods',93,129.99,4.82,11),(301,'Essence Mascara Lash Princess',5,9.99,7.17,1),(302,'Eyeshadow Palette with Mirror',44,19.99,5.5,1),(303,'Powder Canister',59,14.99,18.14,1),(304,'Red Lipstick',68,12.99,19.03,1),(305,'Red Nail Polish',71,8.99,2.46,1),(306,'Calvin Klein CK One',17,49.99,0.32,2),(307,'Chanel Coco Noir Eau De',41,129.99,18.64,2),(308,'Dior J\'adore',91,89.99,17.44,2),(309,'Dolce Shine Eau de',3,69.99,11.47,2),(310,'Gucci Bloom Eau de',93,79.99,8.9,2),(311,'Annibale Colombo Bed',47,1899.99,0.29,3),(312,'Annibale Colombo Sofa',16,2499.99,18.54,3),(313,'Bedside Table African Cherry',16,299.99,9.58,3),(314,'Knoll Saarinen Executive Conference Chair',47,499.99,15.23,3),(315,'Wooden Bathroom Sink with Mirror',95,799.99,11.22,3),(316,'Apple',9,1.99,1.97,4),(317,'Beef Steak',96,12.99,17.99,4),(318,'Cat Food',13,8.99,9.57,4),(319,'Chicken Meat',69,9.99,10.46,4),(320,'Cooking Oil',22,4.99,18.89,4),(321,'Cucumber',22,1.49,11.44,4),(322,'Dog Food',40,10.99,18.15,4),(323,'Eggs',10,2.99,5.8,4),(324,'Fish Steak',99,14.99,7,4),(325,'Green Bell Pepper',89,1.29,15.5,4),(326,'Green Chili Pepper',8,0.99,18.51,4),(327,'Honey Jar',25,6.99,1.91,4),(328,'Ice Cream',76,5.49,7.58,4),(329,'Juice',99,3.99,5.45,4),(330,'Kiwi',1,2.49,10.32,4),(331,'Lemon',0,0.79,17.81,4),(332,'Milk',57,3.49,15.09,4),(333,'Mulberry',79,4.99,16.35,4),(334,'Nescafe Coffee',22,7.99,11.65,4),(335,'Potatoes',8,2.29,4.05,4),(336,'Protein Powder',65,19.99,1.58,4),(337,'Red Onions',86,1.99,17.89,4),(338,'Rice',49,5.99,12.02,4),(339,'Soft Drinks',78,1.99,1.88,4),(340,'Strawberry',9,3.99,19.59,4),(341,'Tissue Paper Box',97,2.49,15.44,4),(342,'water',95,0.99,13.71,4),(343,'Decoration Swing',62,59.99,0.65,5),(344,'Family Tree Photo Frame',34,29.99,1.53,5),(345,'House Showpiece Plant',89,39.99,19.45,5),(346,'Plant Pot',70,14.99,0.19,5),(347,'Table Lamp',84,49.99,0.59,5),(348,'Bamboo Spatula',0,7.99,4.85,6),(349,'Black Aluminium Cup',42,5.99,9.22,6),(350,'Black whisk',17,9.99,16.87,6),(351,'Boxed Blender',81,39.99,7.36,6),(352,'Carbon Steel wok',2,29.99,5.89,6),(353,'Chopping Board',53,12.99,17.72,6),(354,'Citrus Squeezer Yellow',59,8.99,12.35,6),(355,'Egg Slicer',30,6.99,9.6,6),(356,'Electric Stove',41,49.99,16.64,6),(357,'Fine Mesh Strainer',13,9.99,2.56,6),(358,'Fork',10,3.99,14.36,6),(359,'Glass',68,4.99,7.38,6),(360,'Grater Black',80,10.99,3.29,6),(361,'Hand Blender',8,34.99,6.44,6),(362,'Ice Cube Tray',81,5.99,0.95,6),(363,'Kitchen Sieve',33,7.99,9.23,6),(364,'Knife',59,14.99,19.95,6),(365,'Lunch Box',26,12.99,15.33,6),(366,'Microwave Oven',27,89.99,18.73,6),(367,'Mug Tree Stand',93,15.99,15.21,6),(368,'Pan',40,24.99,6.55,6),(369,'Plate',30,3.99,13.03,6),(370,'Red Tongs',15,6.99,18.24,6),(371,'Silver Pot with Glass Cap',37,39.99,4.57,6),(372,'Slotted Turner',36,8.99,7.24,6),(373,'Spice Rack',24,19.99,13.78,6),(374,'Spoon',51,4.99,0.93,6),(375,'Tray',48,16.99,9.93,6),(376,'Wooden Rolling Pin',80,11.99,16.94,6),(377,'Yellow Peeler',86,5.99,17.09,6),(378,'Apple MacBook Pro 14 Inch Space Gray',39,1999.99,9.25,7),(379,'Asus Zenbook Pro Dual Screen Laptop',38,1799.99,9.21,7),(380,'Huawei Matebook X Pro',34,1399.99,15.25,7),(381,'Lenovo Yoga 920',71,1099.99,7.77,7),(382,'New DELL XPS 13 9300 Laptop',18,1499.99,11.7,7),(383,'Blue & Black Check Shirt',44,29.99,1.41,8),(384,'Gigabyte Aorus Men Tshirt',64,24.99,12.6,8),(385,'Man Plaid Shirt',65,34.99,17.53,8),(386,'Man Short Sleeve Shirt',20,19.99,8.65,8),(387,'Men Check Shirt',69,27.99,14.21,8),(388,'Nike Air Jordan 1 Red And Black',15,149.99,15.82,9),(389,'Nike Baseball Cleats',14,79.99,11.4,9),(390,'Puma Future Rider Trainers',10,89.99,3.64,9),(391,'Sports Sneakers Off White & Red',73,119.99,11.69,9),(392,'Sports Sneakers Off White Red',75,109.99,17.22,9),(393,'Brown Leather Belt Watch',69,89.99,15.01,10),(394,'Longines Master Collection',65,1499.99,0.64,10),(395,'Rolex Cellini Date Black Dial',84,8999.99,14.28,10),(396,'Rolex Cellini Moonphase',33,12999.99,5.7,10),(397,'Rolex Datejust',11,10999.99,9.69,10),(398,'Rolex Submariner Watch',35,13999.99,0.82,10),(399,'Amazon Echo Plus',50,99.99,16.3,11),(400,'Apple Airpods',93,129.99,4.82,11);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(45) NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'admin'),(2,'cliente'),(3,'admin'),(4,'cliente'),(5,'admin'),(6,'cliente'),(7,'admin'),(8,'cliente');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `email` varchar(50) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `paterno` varchar(45) NOT NULL,
  `materno` varchar(45) NOT NULL,
  `celular` varchar(45) NOT NULL,
  `idRol` int(11) NOT NULL,
  PRIMARY KEY (`email`),
  KEY `idRol_idx` (`idRol`),
  CONSTRAINT `idRol` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('carlitos@gmail.com','$2y$10$VTp2pZi31SMQ8H.NiiI8B.l8tbPG1yZZSenXzUqeTibEzkWNNIP5O','Carlos','Villanueva','Juarez','5667874313',2),('carmen@gmail.com','$2y$10$8F7dy6TkWNdU5AnzcWzq.u.jKPmVAsBun8tQxoeEhsZSCWpFovYrm','Carmen','Guevara','Lopez','5580901232',2),('david@gmail.com','$2y$10$XCzmUjdUeprbbSEfIcZIm./eFZ5M2iNa7Ujs8G6a6RIfKavr0x9FW','David','Gonzalez','Alonso','5590873212',2),('emilia123@gmail.com','emi345*','Emilia','Flores','Sanchez','5573018428',2),('gerardo_j123@gmail.com','gerry975*','Gerardo','Sandoval','Calderon','5538105782',2),('jorge_perez@gmail.com','jorge123*','Jorge','Perez','Juarez','5512345678',1),('juanf@gmail.com','$2y$10$Wtm9NGiBO.L.keGX9kdPa.gdz330ZelO07HEHH5MZn0mKRyrvpYLK','Juan','GÃ³mez ','Farias','5690097876',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venta` (
  `idVenta` varchar(7) NOT NULL,
  PRIMARY KEY (`idVenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES ('0283794'),('1240769'),('1243790'),('2056497'),('2063879'),('2410938'),('3075964'),('4076159'),('4965387'),('5614378'),('5647128'),('6597238'),('7465308'),('7693102'),('7924863'),('8739026'),('9623748');
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'tienda'
--

--
-- Dumping routines for database 'tienda'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-25  1:46:11
