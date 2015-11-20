-- MySQL dump 10.13  Distrib 5.6.27, for Linux (x86_64)
--
-- Host: localhost    Database: tvker
-- ------------------------------------------------------
-- Server version	5.6.27

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
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `userid` int(12) NOT NULL,
  `messageid` int(12) NOT NULL,
  `content` varchar(255) CHARACTER SET utf8 NOT NULL,
  `commenttime` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`userid`,`messageid`),
  KEY `MessageId` (`messageid`),
  KEY `UserId` (`userid`),
  CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`messageid`) REFERENCES `message` (`messageid`),
  CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,1,'213123123','2015-11-11 14:49:31.755744'),(1,2,'啊等等撒的','2015-11-11 14:49:23.738813'),(2,1,'ssssss','2015-11-11 14:49:52.866538'),(2,3,'上的创新成长','2015-11-11 14:49:39.219253'),(3,7,'呵呵呵呵呵','2015-11-11 15:34:14.805369'),(9,21,'评论','2015-11-13 15:56:51.794608'),(14,1,'我在平','2015-11-13 14:15:58.879104'),(14,15,'特','2015-11-13 14:08:56.154710'),(14,19,'评论','2015-11-13 14:17:50.856896'),(14,34,'cgbhfdghv','2015-11-14 01:34:41.404130'),(15,19,'11111','2015-11-13 14:29:44.797139'),(15,20,'4444','2015-11-13 14:31:11.774760'),(16,19,'我评论','2015-11-13 17:17:07.343661'),(17,22,'去去去','2015-11-13 17:33:53.048017'),(17,23,'是的','2015-11-13 17:35:19.487309'),(19,25,'时间的哈个','2015-11-13 17:42:46.856489'),(22,26,'大腿韩','2015-11-14 01:22:35.329384'),(22,27,'我是Young，你特么是谁？','2015-11-14 01:24:27.298441'),(22,30,'举头望明月，低头思故乡','2015-11-14 01:28:17.854193'),(24,26,'nihaoshuai','2015-11-14 01:31:19.984238'),(25,34,'发的好的发挥','2015-11-14 01:33:43.366770'),(26,29,'afsdfsndfn;','2015-11-14 01:39:42.213576'),(29,36,'我用Chrome 一点都不卡阿','2015-11-19 11:45:37.857705'),(35,39,'合纵连横','2015-11-19 15:18:14.816361'),(35,40,'逐鹿中原','2015-11-19 15:18:45.007372'),(36,39,'纵横捭俾','2015-11-19 15:16:31.856306');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `level`
--

DROP TABLE IF EXISTS `level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `level` (
  `levelid` int(2) NOT NULL,
  `levelname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`levelid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level`
--

LOCK TABLES `level` WRITE;
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
INSERT INTO `level` VALUES (0,'学弱'),(1,'学渣'),(2,'学馊'),(3,'学霸'),(4,'学神');
/*!40000 ALTER TABLE `level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `messageid` int(12) NOT NULL,
  `userid` int(12) NOT NULL,
  `sendtime` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`messageid`),
  KEY `UserId` (`userid`),
  KEY `MessageId` (`messageid`),
  CONSTRAINT `Message_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,1,'2015-11-11 14:43:42.305012','asdsadasdsa'),(2,2,'2015-11-11 14:43:55.529212','呵呵'),(3,1,'2015-11-11 14:44:29.969557','啊是的撒大事'),(4,1,'2015-11-11 15:02:37.612439','123123'),(5,1,'2015-11-11 15:03:15.646700','123123'),(6,1,'2015-11-11 15:03:29.673483','测试'),(7,3,'2015-11-11 15:26:41.485613','我和恶化'),(8,4,'2015-11-12 05:42:57.955111','hello world!'),(9,4,'2015-11-12 09:16:57.358995','12312321321'),(10,4,'2015-11-12 12:02:52.776717','asdsdasd'),(11,4,'2015-11-12 12:03:01.839764','xczxcasdwew'),(12,4,'2015-11-12 12:03:06.887527','fhjghjgfhjgfhj'),(13,5,'2015-11-12 15:39:58.198507','jjjjjjj'),(14,6,'2015-11-13 02:09:42.593957','uhasdasud naonas'),(15,6,'2015-11-13 03:05:36.846348','呵呵呵'),(16,14,'2015-11-13 14:09:18.258966','发送状态'),(17,14,'2015-11-13 14:11:54.872472','发送状态收拾收拾'),(18,14,'2015-11-13 14:13:16.999857','发送信息'),(19,14,'2015-11-13 14:14:47.896034','状态'),(20,15,'2015-11-13 14:30:49.610899','111254'),(21,9,'2015-11-13 15:07:16.981676','测试一个'),(22,17,'2015-11-13 17:33:33.275394','钱钱钱'),(23,17,'2015-11-13 17:35:08.955860','明天软工实验课'),(24,17,'2015-11-13 17:40:23.658982','天啊'),(25,19,'2015-11-13 17:42:14.594727','kintg士大夫都是粉丝啊沙发建设步伐是不发不发V啊'),(26,21,'2015-11-14 01:14:18.770944','最后一节课啊'),(27,22,'2015-11-14 01:23:09.025441','我是Young，你特么是谁？'),(28,22,'2015-11-14 01:27:03.359810','两个黄鹂鸣翠柳，一行白鹭上青天'),(29,23,'2015-11-14 01:27:48.439906','hhhhh~~~'),(30,22,'2015-11-14 01:27:59.393660','床前明月光，疑是地上霜'),(31,22,'2015-11-14 01:29:06.943447','天长地久有时尽，此恨绵绵无绝期'),(32,24,'2015-11-14 01:30:57.551943','I am a girl'),(33,25,'2015-11-14 01:33:24.131798','I am a girl'),(34,25,'2015-11-14 01:33:31.666971','I am a girl'),(35,27,'2015-11-18 11:01:23.872816','hhhhh~~~'),(36,29,'2015-11-19 11:44:56.050862','卡吗？ 不卡 啊 杨丞琳'),(37,35,'2015-11-19 14:45:54.308760','卡呀，待会就卡了'),(38,35,'2015-11-19 14:58:11.726458','狂野大西部'),(39,35,'2015-11-19 15:13:24.921055','纵横天下'),(40,36,'2015-11-19 15:15:23.010738','金戈铁马');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messagetag`
--

DROP TABLE IF EXISTS `messagetag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messagetag` (
  `messageid` int(11) NOT NULL,
  `tagid` int(11) NOT NULL,
  PRIMARY KEY (`messageid`,`tagid`),
  KEY `TagId` (`tagid`),
  CONSTRAINT `messagetag_ibfk_1` FOREIGN KEY (`messageid`) REFERENCES `message` (`messageid`),
  CONSTRAINT `messagetag_ibfk_2` FOREIGN KEY (`tagid`) REFERENCES `tag` (`tagid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messagetag`
--

LOCK TABLES `messagetag` WRITE;
/*!40000 ALTER TABLE `messagetag` DISABLE KEYS */;
/*!40000 ALTER TABLE `messagetag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `praise`
--

DROP TABLE IF EXISTS `praise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `praise` (
  `messageid` int(12) NOT NULL,
  `userid` int(12) NOT NULL,
  `praisetime` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`messageid`,`userid`),
  KEY `MessageId` (`messageid`),
  KEY `UserId` (`userid`),
  CONSTRAINT `Praise_ibfk_1` FOREIGN KEY (`messageid`) REFERENCES `message` (`messageid`),
  CONSTRAINT `Praise_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `praise`
--

LOCK TABLES `praise` WRITE;
/*!40000 ALTER TABLE `praise` DISABLE KEYS */;
INSERT INTO `praise` VALUES (1,1,'2015-11-11 14:43:26.000000'),(1,2,'2015-12-04 14:44:08.000000'),(1,3,'2015-11-11 15:26:26.461886'),(1,4,'2015-11-12 09:41:40.771439'),(1,6,'2015-11-13 03:16:58.762798'),(1,16,'2015-11-13 17:15:50.609627'),(1,22,'2015-11-18 09:13:15.477853'),(2,1,'2015-11-11 15:22:45.290384'),(2,4,'2015-11-12 09:42:01.810918'),(2,5,'2015-11-12 15:36:55.400711'),(2,22,'2015-11-18 09:26:01.729781'),(3,1,'2015-11-18 14:44:39.000000'),(3,3,'2015-11-11 15:27:17.539998'),(3,5,'2015-11-12 15:37:09.651145'),(3,22,'2015-11-18 09:13:36.985459'),(7,3,'2015-11-11 15:27:46.562357'),(7,4,'2015-11-12 09:44:28.238763'),(12,14,'2015-11-13 13:51:56.756962'),(13,13,'2015-11-13 11:26:22.785524'),(14,13,'2015-11-13 11:26:17.357150'),(15,13,'2015-11-13 11:06:49.094939'),(15,14,'2015-11-13 13:51:32.734693'),(19,14,'2015-11-13 14:14:56.268515'),(19,15,'2015-11-13 14:30:04.096211'),(20,15,'2015-11-13 14:30:56.257710'),(22,17,'2015-11-13 17:33:42.572662'),(23,21,'2015-11-14 01:14:54.534807'),(25,19,'2015-11-13 17:42:24.596744'),(25,22,'2015-11-14 01:23:37.989487'),(26,21,'2015-11-14 01:14:30.808846'),(26,22,'2015-11-14 01:54:26.087423'),(27,22,'2015-11-14 01:23:20.217157'),(29,26,'2015-11-14 01:39:35.559903'),(31,21,'2015-11-14 01:29:37.440841'),(32,22,'2015-11-14 01:31:11.360171'),(34,14,'2015-11-14 01:34:34.440287'),(34,25,'2015-11-14 01:33:50.997288'),(36,29,'2015-11-19 11:45:10.075354'),(37,35,'2015-11-19 14:45:58.709539'),(39,35,'2015-11-19 15:17:58.852379'),(39,36,'2015-11-19 15:15:36.101069'),(40,35,'2015-11-19 15:18:27.896373');
/*!40000 ALTER TABLE `praise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `name` varchar(32) NOT NULL,
  `value` int(32) DEFAULT NULL,
  `string` varchar(32) DEFAULT NULL,
  `text` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES ('messagenumber',40,NULL,NULL),('passwordsalt',NULL,'password',NULL),('usernumber',36,NULL,NULL),('welcomemessage',NULL,NULL,'这是一个校园交流站！欢迎您的加入！');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `tagid` int(11) NOT NULL,
  `tagname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tagid`),
  KEY `TagId` (`tagid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userid` int(12) NOT NULL COMMENT '用户ID',
  `username` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `studentid` int(10) DEFAULT NULL,
  `signature` text,
  `registertime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ban` int(1) NOT NULL DEFAULT '0',
  `level` int(2) NOT NULL DEFAULT '1',
  `count` int(1) NOT NULL DEFAULT '0',
  `qq` int(20) DEFAULT NULL,
  `phone` int(20) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','paT/1YTFu9I5w','admin@163.com',123456,'依依依依','2015-11-13 16:01:03',0,1,0,0,NULL),(2,'test','pawpU97AVNPO6','test@ppp.com',123123,'哦哦哦哦','2015-11-13 16:01:04',0,1,0,0,NULL),(3,'test2','paAkmAwCFbx12','test2@111.com',123456,'呵呵呵呵','2015-11-13 16:01:05',0,2,0,0,NULL),(4,'chenpeng','paa5KD6arxLr2','12312@163.com',2013303380,'哈哈哈哈','2015-11-13 16:01:07',0,3,0,0,NULL),(5,'asd','paD7PsPY/naQg','dfgfdgfdg.@qq.com',54684864,'无人机去','2015-11-13 16:01:08',0,4,0,0,NULL),(6,'12312','paN8aiEIonqJE','12312@163.com',12391312,'上善若水','2015-11-13 16:01:09',0,1,0,0,0),(7,'123111','paN8aiEIonqJE','pal6exe@163.com',123123,'','2015-11-13 16:01:12',0,2,0,0,0),(8,'112312312','paMBoIDFPyp46','pal6exe@163.com',123123123,NULL,'2015-11-13 16:01:16',0,3,0,NULL,NULL),(9,'pal6exe','paN8aiEIonqJE','1231312@qq.com',1232131312,'唯我独仙','2015-11-13 16:01:20',0,4,0,10001,15555),(10,'1231231','paN8aiEIonqJE','pal6exe@163.com',123456,NULL,'2015-11-13 10:50:00',0,0,0,NULL,NULL),(11,'12312312312321','paN8aiEIonqJE','pal6exe@163.com',123,NULL,'2015-11-13 10:53:12',0,0,0,NULL,NULL),(12,'1231231321','paN8aiEIonqJE','pal6exe@gmail.com',110,NULL,'2015-11-13 10:55:03',0,0,0,NULL,NULL),(13,'111111111111','paN8aiEIonqJE','pal6exe@163.com',123123,NULL,'2015-11-13 10:56:45',0,0,0,NULL,NULL),(14,'123','paN8aiEIonqJE','15529463967@qq.com',123123,'测试测试','2015-11-14 01:22:10',0,2,0,1231212321,214748111),(15,'1122334','pa8BbRB67.DFU','1122334@qq.com',123456,'3333','2015-11-13 14:30:37',0,0,0,1111,2222),(16,'asdasdasda','pa3TBmbPGj/ys','pal6exe@qq.com',123123123,NULL,'2015-11-13 17:15:19',0,1,0,NULL,NULL),(17,'阿斯顿','pa8xK.imF4J7w','164@qq.coom',1234,NULL,'2015-11-13 17:29:55',0,1,0,NULL,NULL),(18,'qwe','paD7PsPY/naQg','sdfasdfs',305646541,NULL,'2015-11-13 17:39:57',0,1,0,NULL,NULL),(19,'df','paUD.XF6AT3SA','sdafsdaf',324234,NULL,'2015-11-13 17:41:31',0,1,0,NULL,NULL),(20,'哈哈','paMBoIDFPyp46','5122131778@gmail.com',2102318012,NULL,'2015-11-14 01:06:34',0,1,0,NULL,NULL),(21,'韩笑','paPg.MZNLej7Q','abc',123,NULL,'2015-11-14 01:13:42',0,1,0,NULL,NULL),(22,'Young','paa5KD6arxLr2','123456@qq.com',2013333333,'我是Young，你特么是谁？','2015-11-14 01:22:03',0,1,0,123456,1224587),(23,'6554zhu','pa7FXh9QRrSuY','483282373@qq.com',2013303389,NULL,'2015-11-14 01:26:30',0,1,0,NULL,NULL),(24,'octopus','pazpFApQ59hiA','123',1234,NULL,'2015-11-14 01:30:16',0,1,0,NULL,NULL),(25,'7','paBnOsjCcM4WE','5co',71,NULL,'2015-11-14 01:32:57',0,1,0,NULL,NULL),(26,'qwgiwegi','paN8aiEIonqJE','546465',2131231,NULL,'2015-11-14 01:39:04',0,1,0,NULL,NULL),(27,'用户名','papAq5PwY/QQM','1343475906@qq.com',2013303389,NULL,'2015-11-18 10:57:13',0,1,0,NULL,NULL),(28,'风凉兮','paa5KD6arxLr2','123@qq.com',123456789,NULL,'2015-11-18 11:47:18',0,1,0,NULL,NULL),(29,'卡吗','paN8aiEIonqJE','21312312@123.ss',21323221,'#include <iostream>  using namespace std;  extern int sum(int, int);   int main() { 	int x = 4; 	int y = 5; 	cout << sum(x, y);  	cin >> x;   }  int sum(int a, int b) {  	int r; 	_asm 	{ 			mov eax, a 			mov eax, 12345678 			mov ebx, b 			add eax, ebx 			mov r, eax  	} 	return r; }','2015-11-19 12:38:25',0,1,0,123123,12312312),(30,'李斯','paa5KD6arxLr2','123456@qq.com',123456,NULL,'2015-11-19 11:50:50',0,1,0,NULL,NULL),(31,'@#￥','papAq5PwY/QQM','123456@qq.com',123456,NULL,'2015-11-19 11:52:07',0,1,0,NULL,NULL),(32,'请问','papAq5PwY/QQM','123456@qq.com',123456,NULL,'2015-11-19 12:02:40',0,1,0,NULL,NULL),(33,'登等等','papAq5PwY/QQM','123456@qq.com',123456,NULL,'2015-11-19 12:03:21',0,1,0,NULL,NULL),(34,'楚','paa5KD6arxLr2','123456',123456,NULL,'2015-11-19 12:30:11',0,1,0,NULL,NULL),(35,'李四','paa5KD6arxLr2','654321@qq.com',654321,'黑色裂变','2015-11-19 15:39:03',0,1,0,1234567,1234567),(36,'张六','paa5KD6arxLr2','1234567',1234567,NULL,'2015-11-19 15:14:40',0,1,0,NULL,NULL);
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

-- Dump completed on 2015-11-20  8:09:13
