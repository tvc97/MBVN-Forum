-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: mbvn
-- ------------------------------------------------------
-- Server version 	5.5.42
-- Date: Wed, 06 Jul 2016 00:13:32 +0700

--
-- Table structure for table `cats`
--

DROP TABLE IF EXISTS `cats`;

CREATE TABLE `cats` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL DEFAULT '0',
  `cat_name` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cats`
--

INSERT INTO `cats` VALUES (1,0,'Chuyên mục root'),(2,1,'Chuyên mục con');
--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`chat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` VALUES (1,4,'[color=#ff0000]Admin[/color] Đăng chủ đề mới => [url=/threads/cam-on-ban-da-su-dung-phan-mem-forum-mbvn.1/]Cảm ơn bạn đã sử dụng phần mềm forum MBVN[/url]',1467738324),(2,1,'Test chat',1467738675),(3,1,'Test chat 2',1467738687);
--
-- Table structure for table `counter`
--

DROP TABLE IF EXISTS `counter`;

CREATE TABLE `counter` (
  `today` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` VALUES (99,705394,1467738000);
--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;

CREATE TABLE `game` (
  `user_id` int(11) NOT NULL,
  `game_code` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `vars` text COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` VALUES (9,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1410109887),(2,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1455546910),(5,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1439615787),(15,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1410999361),(13,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1409535932),(10,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1426077904),(14,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1409533177),(24,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1411360198),(6,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1412668317),(11,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1409750210),(26,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1409700946),(17,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1441457148),(27,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1410848807),(28,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1409878984),(29,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1410754152),(16,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1447804309),(30,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1410269925),(7,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1410505381),(31,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1410590706),(33,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1410706148),(34,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1410848531),(36,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1456406162),(1,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1431522996),(48,'ALTP','a:4:{s:4:\"mode\";s:7:\"started\";s:5:\"level\";i:1;s:4:\"file\";s:7:\"101.txt\";s:6:\"answer\";s:1:\"b\";}',1432277415),(50,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1448343844),(52,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1461085880),(47,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1434942730),(55,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1435501061),(53,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1462671478),(56,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1441023033),(57,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1436168390),(63,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1437160219),(66,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1438394186),(69,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1462151820),(58,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1440807539),(70,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1464497913),(68,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1440211770),(60,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1442758622),(73,'ALTP','a:4:{s:4:\"mode\";s:7:\"started\";s:5:\"level\";i:3;s:4:\"file\";s:7:\"179.txt\";s:6:\"answer\";s:1:\"c\";}',1453094196),(39,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1455546243),(75,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1440047045),(77,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1442286240),(76,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1440569651),(80,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1440546057),(86,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1441691895),(89,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1463808744),(90,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1441878024),(92,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1442754932),(93,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1455550348),(96,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1443553917),(100,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1445693351),(99,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1443881907),(101,'ALTP','a:4:{s:4:\"mode\";s:7:\"started\";s:5:\"level\";i:1;s:4:\"file\";s:7:\"143.txt\";s:6:\"answer\";s:1:\"c\";}',1451140475),(102,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1443936876),(91,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1444236884),(87,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1448766775),(97,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1444483813),(22,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1447828632),(112,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1450015314),(113,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1465613597),(122,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1452683046),(123,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1452813979),(125,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1454422414),(109,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1454572353),(132,'ALTP','a:1:{s:4:\"mode\";s:5:\"start\";}',1457836000),(144,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1459846191),(145,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1460121634),(146,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1462962045),(147,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1460797843),(152,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1462268717),(153,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1462459005),(154,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1462978519),(160,'ALTP','a:4:{s:4:\"mode\";s:7:\"started\";s:5:\"level\";i:4;s:4:\"file\";s:7:\"149.txt\";s:6:\"answer\";s:1:\"d\";}',1463493064),(161,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1463747832),(162,'ALTP','a:1:{s:4:\"mode\";s:4:\"over\";}',1463824836);
--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` VALUES (1,1,1);
--
-- Table structure for table `lost_password`
--

DROP TABLE IF EXISTS `lost_password`;

CREATE TABLE `lost_password` (
  `id` varchar(32) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lost_password`
--

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `read` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` VALUES (1,1,1,'Hey, Admin.\nChào mừng bạn đến với diễn đàn Mobile Việt Nam\n Trước khi tham gia bàn luận trên diễn đàn hãy dành chút thời gian đọc qua [url=/pages/faq/]Quy định[/url] và [url=/threads/quy-dinh-khi-dang-chu-de.3/]Quy định khi đăng chủ đề[/url] nhé!\nCám ơn bạn.',1467738104,0);
--
-- Table structure for table `online`
--

DROP TABLE IF EXISTS `online`;

CREATE TABLE `online` (
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ua` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `uid` int(4) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `online`
--

INSERT INTO `online` VALUES ('127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.84 Safari/537.36 OPR/38.0.2220.31','/admin/backup_db/?generate',1,1467738812);
--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `liked` int(11) NOT NULL DEFAULT '0',
  `vars` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` VALUES (1,1,'[b]Cảm ơn bạn đã sử dụng phần mềm forum MBVN[/b]\r\n\r\n===============================\r\n\r\n[b]Thông tin tài khoản quản trị mặc định:[/b]\r\n- [b]Username:[/b] Admin\r\n- [b]Mật khẩu:[/b] 123456\r\n\r\n==============================\r\n\r\n[b]Thông tin liên hệ:[/b]\r\n\r\nEmail: tvc208@gmail.com\r\nYahoo / Facebook / Instagram / Twitter Username: tvc97\r\nSố điện thoại: 01628122970',1467738324,1,1,'a:2:{s:2:\"ua\";s:137:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.84 Safari/537.36 OPR/38.0.2220.31\";s:2:\"ip\";s:9:\"127.0.0.1\";}');
--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;

CREATE TABLE `threads` (
  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `thread_name` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `last` int(11) NOT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT '0',
  `view` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`thread_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` VALUES (1,2,'Cảm ơn bạn đã sử dụng phần mềm forum MBVN',1,1467738324,1467738324,1,6);
--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_passwd` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `login_hash` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `gender` tinyint(4) NOT NULL,
  `dob` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `reg` int(11) NOT NULL,
  `last` int(11) DEFAULT NULL,
  `point` int(11) NOT NULL DEFAULT '0',
  `liked` int(11) NOT NULL DEFAULT '0',
  `beliked` int(11) NOT NULL DEFAULT '0',
  `user_theme` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'default',
  `logout` tinyint(4) DEFAULT '0',
  `vars` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `dname` (`dname`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES (1,'admin','Admin','01fa6ef73949d66d72c08b21c8811674','tvc208@gmail.com','77d35f5133cba2e6288601904d4d382b1b77b668992b006a958449df3a7ddd6770dcb573ce698da39ba7b33111e5fab6d188d7aa436b5ccd95ad95100406e3d3',20,1,'20/8/1997',1467738104,1467738812,15,1,1,'default',0,'a:3:{s:2:\"ua\";s:137:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.84 Safari/537.36 OPR/38.0.2220.31\";s:2:\"ip\";s:9:\"127.0.0.1\";s:6:\"locate\";s:26:\"/admin/backup_db/?generate\";}');
