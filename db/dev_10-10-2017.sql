DROP TABLE IF EXISTS `acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_acos_lft_rght` (`lft`,`rght`),
  KEY `idx_acos_alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acos`
--

LOCK TABLES `acos` WRITE;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
INSERT  IGNORE INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES (1,NULL,NULL,NULL,'controllers',1,112),(2,1,NULL,NULL,'Contracts',2,13),(3,2,NULL,NULL,'index',3,4),(4,2,NULL,NULL,'view',5,6),(5,2,NULL,NULL,'add',7,8),(6,2,NULL,NULL,'del',9,10),(7,2,NULL,NULL,'isAuthorized',11,12),(8,1,NULL,NULL,'Groups',14,27),(9,8,NULL,NULL,'index',15,16),(10,8,NULL,NULL,'add',17,18),(11,8,NULL,NULL,'view',19,20),(12,8,NULL,NULL,'edit',21,22),(13,8,NULL,NULL,'delete',23,24),(14,8,NULL,NULL,'isAuthorized',25,26),(15,1,NULL,NULL,'Notifications',28,39),(16,15,NULL,NULL,'index',29,30),(17,15,NULL,NULL,'view',31,32),(18,15,NULL,NULL,'add',33,34),(19,15,NULL,NULL,'del',35,36),(20,15,NULL,NULL,'isAuthorized',37,38),(21,1,NULL,NULL,'Pages',40,47),(22,21,NULL,NULL,'index',41,42),(23,21,NULL,NULL,'display',43,44),(24,21,NULL,NULL,'isAuthorized',45,46),(32,1,NULL,NULL,'Users',62,83),(33,32,NULL,NULL,'login',63,64),(34,32,NULL,NULL,'logout',65,66),(35,32,NULL,NULL,'recover_password',67,68),(36,32,NULL,NULL,'index',69,70),(37,32,NULL,NULL,'add',71,72),(38,32,NULL,NULL,'view',73,74),(39,32,NULL,NULL,'edit',75,76),(40,32,NULL,NULL,'delete',77,78),(41,32,NULL,NULL,'isAuthorized',79,80),(42,1,NULL,NULL,'AclExtras',84,85),(43,32,NULL,NULL,'initDB',81,82),(44,1,NULL,NULL,'Posts',86,99),(45,44,NULL,NULL,'index',87,88),(47,44,NULL,NULL,'add',91,92),(48,44,NULL,NULL,'view',93,94),(49,44,NULL,NULL,'edit',95,96),(50,44,NULL,NULL,'delete',97,98),(51,1,NULL,NULL,'Settings',100,111),(52,51,NULL,NULL,'index',101,102),(53,51,NULL,NULL,'add',103,104),(54,51,NULL,NULL,'edit',105,106),(55,51,NULL,NULL,'view',107,108),(56,51,NULL,NULL,'delete',109,110);
/*!40000 ALTER TABLE `acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agreements`
--

DROP TABLE IF EXISTS `agreements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agreements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `cpf_cnpj` varchar(20) DEFAULT NULL,
  `value` decimal(50,2) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `type_agreement_id` int(11) DEFAULT NULL,
  `validity` datetime DEFAULT NULL,
  `guarantee` varchar(200) DEFAULT NULL,
  `is_public` tinyint(4) DEFAULT '0',
  `file_name` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agreements`
--

LOCK TABLES `agreements` WRITE;
/*!40000 ALTER TABLE `agreements` DISABLE KEYS */;
INSERT  IGNORE INTO `agreements` (`id`, `user_id`, `name`, `cpf_cnpj`, `value`, `description`, `type_agreement_id`, `validity`, `guarantee`, `is_public`, `file_name`, `created`, `modified`) VALUES (1,1,'Contrato Teste 1','04088208000165',25500.45,'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim.',1,'2018-08-25 23:26:08','Garantia Teste 1',1,NULL,'2017-10-24 23:26:52','2017-10-24 23:26:52'),(2,1,'Contrato Teste 2','04088208000165',29581.55,'Praesent in mauris eu tortor porttitor accumsan. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Aenean fermentum risus id tortor. Integer imperdiet lectus quis justo. Integer tempor. Vivamus ac urna vel leo pretium faucibus. Mauris elementum mauris vitae tortor. In dapibus augue non sapien. Aliquam ante. Curabitur bibendum justo non orci.',2,'2020-05-15 23:45:35','Garantia Teste 2',0,NULL,'2017-10-24 23:45:35','2017-10-24 23:45:35'),(3,1,'Contrato Teste 3','01560320230',15450.00,'Etiam posuere quam ac quam. Maecenas aliquet accumsan leo. Nullam dapibus fermentum ipsum. Etiam quis quam. Integer lacinia. Nulla est. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Integer vulputate sem a nibh rutrum consequat. Maecenas lorem. Pellentesque pretium lectus id turpis. Etiam sapien elit, consequat eget, tristique non, venenatis quis, ante. Fusce wisi. Phasellus faucibus molestie',3,'2021-10-19 23:46:16','Garantia Teste 3',0,NULL,'2017-10-24 23:46:16','2017-10-24 23:46:16'),(4,1,'Contrato Teste 4','04088208000165',22350.45,'Nam quis nulla. Integer malesuada. In in enim a arcu imperdiet malesuada. Sed vel lectus. Donec odio urna, tempus molestie, porttitor ut, iaculis quis, sem. Phasellus rhoncus. Aenean id metus id velit ullamcorper pulvinar. Vestibulum fermentum tortor id mi. Pellentesque ipsum. Nulla non arcu lacinia neque faucibus fringilla. Nulla non lectus sed nisl molestie malesuada. Proin in tellus sit amet',1,'2018-08-25 09:56:26','TEste',1,'cvgabrielhernandez-1508932589.pdf','2017-10-25 09:56:29','2017-10-25 09:56:29');
/*!40000 ALTER TABLE `agreements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros`
--

DROP TABLE IF EXISTS `aros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_aros_lft_rght` (`lft`,`rght`),
  KEY `idx_aros_alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros`
--

LOCK TABLES `aros` WRITE;
/*!40000 ALTER TABLE `aros` DISABLE KEYS */;
INSERT  IGNORE INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES (1,NULL,'Group',1,NULL,1,2),(2,NULL,'Group',2,NULL,3,4),(3,NULL,'Group',3,NULL,5,6);
/*!40000 ALTER TABLE `aros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros_acos`
--

DROP TABLE IF EXISTS `aros_acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`),
  KEY `idx_aco_id` (`aco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros_acos`
--

LOCK TABLES `aros_acos` WRITE;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
INSERT  IGNORE INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES (1,1,1,'1','1','1','1'),(2,2,1,'-1','-1','-1','-1'),(4,3,1,'-1','-1','-1','-1'),(5,3,27,'1','1','1','1'),(6,3,29,'1','1','1','1'),(7,3,34,'1','1','1','1'),(8,1,32,'1','1','1','1'),(9,2,32,'1','1','1','1'),(10,3,32,'-1','1','1','-1'),(12,3,44,'1','1','-1','-1'),(13,1,51,'1','1','1','1');
/*!40000 ALTER TABLE `aros_acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `domain` varchar(120) DEFAULT NULL,
  `domain_name` varchar(120) DEFAULT NULL,
  `brand_name` varchar(120) DEFAULT NULL,
  `brand_slogan` varchar(120) DEFAULT NULL,
  `image_path` varchar(100) DEFAULT NULL,
  `logo_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=ucs2;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT  IGNORE INTO `brands` (`id`, `user_id`, `domain`, `domain_name`, `brand_name`, `brand_slogan`, `image_path`, `logo_name`) VALUES (1,123,'','luanadomingos','Luana Domingos','Studio de Treinamento Personalizado','/uploads/luanadomingos/',NULL),(2,15,'saulostopa.com','saulostopa','Saulo Stopa','Personal Trainer','/uploads/saulostopa/',NULL),(4,1,'legpress.com.br','legpress','LegPress','Your Workout',NULL,NULL),(5,197,'','kleberlucas','Kleber Lucas','Personal Trainer',NULL,'logo.png');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT  IGNORE INTO `groups` (`id`, `name`, `created`, `modified`) VALUES (1,'Administrador','2017-10-02 17:03:43','2017-10-02 17:03:43'),(2,'Gerente','2017-10-02 17:04:25','2017-10-02 17:04:25'),(3,'Usuário','2017-10-02 17:05:07','2017-10-02 17:05:20');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `to_name` varchar(45) DEFAULT NULL,
  `to_email` varchar(45) DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `body` text NOT NULL,
  `is_acknowledgment_receipt` tinyint(1) NOT NULL DEFAULT '0',
  `is_acknowledgment_receipt_checked` tinyint(1) DEFAULT '0',
  `acknowledgment_receipt_visualized` datetime DEFAULT NULL,
  `is_electronic_signature` tinyint(1) NOT NULL DEFAULT '0',
  `is_electronic_signature_checked` tinyint(1) DEFAULT '0',
  `electronic_signature_signed` datetime DEFAULT NULL,
  `file_name` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT  IGNORE INTO `notifications` (`id`, `user_id`, `to_name`, `to_email`, `title`, `body`, `is_acknowledgment_receipt`, `is_acknowledgment_receipt_checked`, `acknowledgment_receipt_visualized`, `is_electronic_signature`, `is_electronic_signature_checked`, `electronic_signature_signed`, `file_name`, `created`, `modified`, `token`) VALUES (1,1,'Flávio Costa','flavio@costa.com.br','Teste','Nam quis nulla. Integer malesuada. In in enim a arcu imperdiet malesuada. Sed vel lectus. Donec odio urna, tempus molestie, porttitor ut, iaculis quis, sem. Phasellus rhoncus. Aenean id metus id velit ullamcorper pulvinar. Vestibulum fermentum tortor id mi. Pellentesque ipsum. Nulla non arcu lacinia neque faucibus fringilla. Nulla non lectus sed nisl molestie malesuada. Proin in tellus sit amet nibh dignissim sagittis. Vivamus luctus egestas leo. Maecenas sollicitudin. Nullam rhoncus aliquam metus. Etiam egestas wisi a erat.\n\n Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Aenean vel massa quis mauris vehicula lacinia. Quisque tincidunt scelerisque libero. Maecenas libero. Etiam dictum tincidunt diam. Donec ipsum massa, ullamcorper in, auctor et, scelerisque sed, est. Suspendisse nisl. Sed convallis magna eu sem. Cras pede libero, dapibus nec, pretium sit amet, tempor quis, urna.\n\n Etiam posuere quam ac quam. Maecenas aliquet accumsan leo. Nullam dapibus fermentum ipsum. Etiam quis quam. Integer lacinia. Nulla est. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Integer vulputate sem a nibh rutrum consequat. Maecenas lorem. Pellentesque pretium lectus id turpis. Etiam sapien elit, consequat eget, tristique non, venenatis quis, ante. Fusce wisi. Phasellus faucibus molestie nisl. Fusce eget urna. Curabitur vitae diam non enim vestibulum interdum. Nulla quis diam. Ut tempus purus at lorem.\n\n Morbi a metus. Phasellus enim erat, vestibulum vel, aliquam a, posuere eu, velit. Nullam sapien sem, ornare ac, nonummy non, lobortis a, enim. Nunc tincidunt ante vitae massa. Duis ante orci, molestie vitae, vehicula venenatis, tincidunt ac, pede. Nulla accumsan, elit sit amet varius semper, nulla mauris mollis quam, tempor suscipit diam nulla vel leo. Etiam commodo dui eget wisi. Donec iaculis gravida nulla. Donec quis nibh at felis congue commodo. Etiam bibendum elit eget erat.\n\n In sem justo, commodo ut, suscipit at, pharetra vitae, orci. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam id dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris dictum facilisis augue. Fusce tellus. Pellentesque arcu. Maecenas fermentum, sem in pharetra pellentesque, velit turpis volutpat ante, in pharetra metus odio a lectus. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Etiam ligula pede, sagittis quis, interdum ultricies, scelerisque eu, urna. Nullam at arcu a est sollicitudin euismod. Praesent dapibus. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus. Nam sed tellus id magna elementum tincidunt.',0,0,NULL,1,0,NULL,NULL,NULL,NULL,NULL),(2,1,'test','test','sret','sdf',1,1,NULL,0,0,NULL,NULL,'2017-10-10 10:38:52','2017-10-10 10:38:52',NULL),(3,1,'sdaf','sadf','sdf','sadf',0,0,NULL,1,1,NULL,'sem-parar-1507645776.pdf','2017-10-10 11:28:26','2017-10-10 11:28:26',NULL),(4,1,'fasdfd','dsafsadf','dfsaf','dsfa',0,0,NULL,1,0,NULL,'sem-parar-1507646891.pdf','2017-10-10 11:46:38','2017-10-10 11:46:38',NULL),(5,1,'kkk','kkk','kkk','kkk',1,0,NULL,1,1,NULL,'sem-parar-1507647059.pdf','2017-10-10 11:50:28','2017-10-10 11:50:28',NULL),(6,1,'sdaF','sadF','SADF','SDF',1,0,NULL,0,0,NULL,'sem-parar-1507649883.pdf','2017-10-10 12:38:03','2017-10-10 12:38:03',NULL),(7,1,'sdaF','sadF','SADF','SDF',1,0,NULL,0,0,NULL,'sem-parar-1507649911.pdf','2017-10-10 12:38:31','2017-10-10 12:38:31',NULL),(8,1,'sdaF','sadF','SADF','SDF',1,0,NULL,0,0,NULL,'sem-parar-1507649959.pdf','2017-10-10 12:39:19','2017-10-10 12:39:19',NULL),(9,1,'sdaf','jkl','jkl','jkl',0,0,NULL,0,0,NULL,'cvgabrielhernandez-1507650333.pdf','2017-10-10 12:45:33','2017-10-10 12:45:33','0412e152ccc8073d5966b13bca6683e017078e66'),(10,1,'1010','jkl','jkl','jkl',0,0,NULL,0,0,NULL,'cvgabrielhernandez-1507650656.pdf','2017-10-10 12:50:55','2017-10-10 12:50:55','0412e152ccc8073d5966b13bca6683e017078e66'),(11,1,'PPP','pp','pp','pp',1,0,NULL,1,0,NULL,'sem-parar-1507651353.pdf','2017-10-10 13:02:33','2017-10-10 13:02:33','f93929be563ca3099907f73d3ce1cad0c45895fd'),(12,1,'TTT','tt','tt','tt',0,0,NULL,1,0,NULL,'sem-parar-1507651545.pdf','2017-10-10 13:05:45','2017-10-10 13:05:45','b33d24a5ef60cfe2cd7a64d9c06b6c44b849ceaa'),(13,1,'Saulo','saulostopa@gmail.com','Teste 5566','teste',1,0,NULL,1,0,NULL,'cvgabrielhernandez-1507656932.pdf','2017-10-10 14:35:32','2017-10-10 14:35:32','e55e8c7b18c4444db92c7c8327749d0ff423c7b7'),(14,1,'Saulo','saulostopa@gmail.com','Teste 5566','teste',1,0,NULL,1,0,NULL,'cvgabrielhernandez-1507657067.pdf','2017-10-10 14:37:47','2017-10-10 15:33:56','ea52b35c733a9af40f3d68ea2f9888b1b94fc833'),(15,1,'Saulo Lima','saulostopa@gmail.com','Teste 99','Maecenas ipsum velit, consectetuer eu, lobortis ut, dictum at, dui. In rutrum. Sed ac dolor sit amet purus malesuada congue. In laoreet, magna id viverra tincidunt, sem odio bibendum justo, vel imperdiet sapien wisi sed libero. Suspendisse sagittis ultrices augue. Mauris metus. Nunc dapibus tortor vel mi dapibus sollicitudin. Etiam posuere lacus quis dolor. Praesent id justo in neque elementum ultrices. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. In convallis. Fusce suscipit libero eget elit. Praesent vitae arcu tempor neque lacinia pretium. Morbi imperdiet, mauris ac auctor dictum, nisl ligula egestas nulla, et sollicitudin sem purus in lacus.\r\n\r\n Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Aenean vel massa quis mauris vehicula lacinia. Quisque tincidunt scelerisque libero. Maecenas libero. Etiam dictum tincidunt diam. Donec ipsum massa, ullamcorper in, auctor et, scelerisque sed, est. Suspendisse nisl. Sed convallis magna eu sem. Cras pede libero, dapibus nec, pretium sit amet, tempor quis, urna.\r\n\r\n Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Aenean vel massa quis mauris vehicula lacinia. Quisque tincidunt scelerisque libero. Maecenas libero. Etiam dictum tincidunt diam. Donec ipsum massa, ullamcorper in, auctor et, scelerisque sed, est. Suspendisse nisl. Sed convallis magna eu sem. Cras pede libero, dapibus nec, pretium sit amet, tempor quis, urna.\r\n\r\n Praesent in mauris eu tortor porttitor accumsan. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Aenean fermentum risus id tortor. Integer imperdiet lectus quis justo. Integer tempor. Vivamus ac urna vel leo pretium faucibus. Mauris elementum mauris vitae tortor. In dapibus augue non sapien. Aliquam ante. Curabitur bibendum justo non orci.',1,0,NULL,1,0,NULL,'cvgabrielhernandez-1507673404.pdf','2017-10-10 19:10:04','2017-10-10 19:10:04','e72d53a7a30134ec5907b6591ca6621d273ecf11'),(16,1,'Saulo Lima','saulostopa@gmail.com','Teste 5566 - 988','Maecenas ipsum velit, consectetuer eu, lobortis ut, dictum at, dui. In rutrum. Sed ac dolor sit amet purus malesuada congue. In laoreet, magna id viverra tincidunt, sem odio bibendum justo, vel imperdiet sapien wisi sed libero. Suspendisse sagittis ultrices augue. Mauris metus.\r\n\r\n Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat.\r\n\r\n Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat.\r\n\r\n Praesent in mauris eu tortor porttitor accumsan. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Aenean fermentum risus id tortor. Integer imperdiet lectus quis justo. Integer tempor. Vivamus ac urna vel leo pretium faucibus. Mauris elementum mauris vitae tortor. In dapibus augue non sapien. Aliquam ante. Curabitur bibendum justo non orci.',1,1,'2017-10-10 22:02:08',1,1,NULL,NULL,'2017-10-10 19:41:42','2017-10-10 20:04:12','feaf0f409c40ad59498ddb5a7e3813119640cf45'),(17,1,'Saulo Stopa','saulostopa@gmail.com','sdf ___','Maecenas ipsum velit, consectetuer eu, lobortis ut, dictum at, dui. In rutrum. Sed ac dolor sit amet purus malesuada congue. In laoreet, magna id viverra tincidunt, sem odio bibendum justo, vel imperdiet sapien wisi sed libero. Suspendisse sagittis ultrices augue. Mauris metus.\r\n\r\n Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat.\r\n\r\n Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat.',1,1,'2017-10-10 21:18:31',1,1,'2017-10-10 21:43:11',NULL,'2017-10-10 20:26:14','2017-10-10 20:37:58','c93fab9e45ba82a60c4e60bba525f18610fd37d2'),(18,1,'Saulo Stopa','saulostopa@gmail.com','sdf ___','Maecenas ipsum velit, consectetuer eu, lobortis ut, dictum at, dui. In rutrum. Sed ac dolor sit amet purus malesuada congue. In laoreet, magna id viverra tincidunt, sem odio bibendum justo, vel imperdiet sapien wisi sed libero. Suspendisse sagittis ultrices augue. Mauris metus.\r\n\r\n Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat.\r\n\r\n Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat.',1,1,'2017-10-10 21:14:10',1,0,NULL,NULL,'2017-10-10 20:39:58','2017-10-10 20:39:58','38f1fd03116bca9cb11bf12daccc3772e0bb317a'),(19,1,'Saulo Lima','saulostopa@gmail.com','Teste - 5566','tste',1,0,NULL,1,0,NULL,'cvgabrielhernandez-1508777052.pdf','2017-10-23 14:44:12','2017-10-23 14:44:12','918c6528c6713b711feee47faff10c72403b5772'),(20,1,'teste','saulostopa@gmail.com','sdf','dsf',1,1,'2017-10-23 15:12:01',1,1,'2017-10-23 15:11:58',NULL,'2017-10-23 15:10:44','2017-10-23 15:10:44','5e86039f87f4432d8c76deda909e46b8dbfbc4ba'),(21,1,'Saulo Lima','saulostopa@gmail.com','teste1','teste',1,0,NULL,0,0,NULL,NULL,'2017-10-23 15:41:12','2017-10-23 15:41:12',NULL),(22,1,'Saulo Lima','saulostopa@gmail.com','test12','f',1,0,NULL,0,0,NULL,NULL,'2017-10-23 15:50:53','2017-10-23 15:50:53',NULL),(23,1,'Saulo Lima','saulostopa@gmail.com','2323','sdf',1,0,NULL,0,0,NULL,NULL,'2017-10-23 15:53:43','2017-10-23 15:53:43',NULL),(24,1,'Saulo Lima','saulostopa@gmail.com','2323','sdf',1,1,'2017-10-23 15:56:53',0,0,NULL,NULL,'2017-10-23 15:55:45','2017-10-23 15:55:45','91edbdb57b89dcd9a7352c45c52b3d9c7dc93de0'),(25,1,'Saulo Lima','saulostopa@gmail.com','45','45',1,1,'2017-10-23 15:58:41',0,0,NULL,NULL,'2017-10-23 15:58:24','2017-10-23 15:58:24','9d94fd15b14ff3215483a4e4092231c63cedf1ee'),(26,1,'Saulo Lima','saulostopa@gmail.com','333','333',1,1,'2017-10-23 16:19:53',0,0,NULL,NULL,'2017-10-23 16:05:14','2017-10-23 16:05:14','5ae154e5ca5f472cf9ee64e4d3cec4b3a83f0f62'),(27,1,'Saulo Lima','saulostopa@gmail.com','2233','2233',1,1,'2017-10-23 16:25:03',0,0,NULL,NULL,'2017-10-23 16:22:21','2017-10-23 16:22:21','f1a4ef1f09acf00200fabf3ea98925901948b7de'),(28,1,'Saulo Lima','saulostopa@gmail.com','2211','1122',1,1,'2017-10-23 16:42:36',0,0,NULL,'cvgabrielhernandez-1508777052.pdf','2017-10-23 16:27:03','2017-10-23 16:42:36','aefe6f92750571d686ba0d68b66389ca5d6ae585'),(29,1,'Saulo Lima','saulostopa@gmail.com','5656','5656',0,0,NULL,1,1,'2017-10-23 16:49:24',NULL,'2017-10-23 16:45:07','2017-10-23 16:45:07','8f91748eba969d731a848a23f2857b2ea015685f'),(30,1,'Saulo Lima','saulostopa@gmail.com','5577','5577',0,0,NULL,1,1,'2017-10-23 16:50:40',NULL,'2017-10-23 16:50:05','2017-10-23 16:50:05','c7d510229261b57cb8e4bbd9a6763cc7a248aea3'),(31,1,'Saulo Lima','saulostopa@gmail.com','8877','8877',0,0,NULL,1,1,'2017-10-23 16:55:48',NULL,'2017-10-23 16:51:08','2017-10-23 16:51:08','c6f3797cc2cad5b9c20d1fed4436ffbf7a76142b');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plan_users`
--

DROP TABLE IF EXISTS `plan_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plan_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan_users`
--

LOCK TABLES `plan_users` WRITE;
/*!40000 ALTER TABLE `plan_users` DISABLE KEYS */;
INSERT  IGNORE INTO `plan_users` (`id`, `plan_id`, `user_id`) VALUES (1,1,1),(2,1,2),(3,1,3);
/*!40000 ALTER TABLE `plan_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(45) DEFAULT NULL,
  `code_pagseguro` varchar(60) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `value` decimal(12,2) NOT NULL,
  `qtde_notifications` int(11) DEFAULT NULL,
  `qtde_consult_serasa` int(11) DEFAULT NULL,
  `update_subscriptions` tinyint(1) DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT  IGNORE INTO `plans` (`id`, `reference`, `code_pagseguro`, `name`, `description`, `value`, `qtde_notifications`, `qtde_consult_serasa`, `update_subscriptions`, `status`, `created`, `modified`) VALUES (1,'c9c1c4bd','24637C5CB1B1E7ADD4398F82D6F066D8','Gold','9898',64.56,55,66,0,1,'2017-10-10 10:38:52','2017-10-24 15:17:51'),(2,'1bb65bf2','C5C0BBD82B2B8D944480DF9EB84CCB02','Master','Teste Master',120.60,8,4,0,1,'2017-10-24 15:31:05','2017-10-24 15:31:05'),(3,'b23b9ad8','CB62FA692C2C3062240A6FAD21F87D41','Plus','Teste',59.20,10,12,0,1,'2017-10-24 16:37:40','2017-10-24 20:10:02'),(4,'af5e0bae','AF0744962424255004997F925E1DEB26','Platinum',NULL,55.80,6,12,0,1,'2017-10-24 16:37:40',NULL);
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT  IGNORE INTO `posts` (`id`, `user_id`, `title`, `body`, `created`, `modified`) VALUES (18,3,'ABC','ddd','2017-09-25 23:42:47','2017-10-05 11:52:00'),(19,1,'dddd1','dddd','2017-09-25 23:48:15','2017-10-02 22:53:00'),(20,NULL,'sdfsdafsadf','sadfsdaf','2017-09-25 23:49:00','2017-09-25 23:49:00'),(21,NULL,'sdfsdafsadfsad f',' sadfsadfsdaf','2017-09-25 23:49:52','2017-09-25 23:49:52'),(22,NULL,'sdfsdafsadfsad fsdaf',' sadfsadfsdaf','2017-09-25 23:51:03','2017-09-25 23:51:03'),(23,NULL,'sdfsadf','safsdaf','2017-09-25 23:56:39','2017-09-25 23:56:39'),(24,NULL,'sa f','sa fd','2017-09-25 23:57:05','2017-09-25 23:57:05'),(25,NULL,'as df',' sadf','2017-09-26 00:00:38','2017-09-26 00:00:38'),(26,NULL,'as dfs dfa',' sadf','2017-09-26 00:00:54','2017-09-26 00:00:54'),(27,NULL,'cxcxcxzzz.','xccxcxc.','2017-09-26 14:01:47','2017-09-26 14:03:41'),(29,1,'For Pedro','Teste','2017-10-02 20:41:41','2017-10-02 20:43:24');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `brand_name` varchar(120) DEFAULT NULL,
  `brand_slogan` varchar(120) DEFAULT NULL,
  `host` varchar(120) DEFAULT NULL,
  `host_sufix` varchar(45) DEFAULT NULL,
  `dir_name` varchar(120) DEFAULT NULL,
  `logo_name` varchar(100) DEFAULT NULL,
  `avatar_name` varchar(100) DEFAULT NULL,
  `full_path` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT  IGNORE INTO `settings` (`id`, `user_id`, `brand_name`, `brand_slogan`, `host`, `host_sufix`, `dir_name`, `logo_name`, `avatar_name`, `full_path`) VALUES (1,1,'Aveeze','Notificações Online','http://local.cakephp-2.9.5.saulostopa.com','aveeze.com.br','aveeze','logo.png','avatar.png','/uploads/aveeze/');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_agreements`
--

DROP TABLE IF EXISTS `type_agreements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_agreements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_agreements`
--

LOCK TABLES `type_agreements` WRITE;
/*!40000 ALTER TABLE `type_agreements` DISABLE KEYS */;
INSERT  IGNORE INTO `type_agreements` (`id`, `name`, `status`, `created`, `modified`) VALUES (1,'Imóvel',1,NULL,NULL),(2,'Automóvel',1,NULL,NULL),(3,'Eletrodoméstico',1,NULL,NULL);
/*!40000 ALTER TABLE `type_agreements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '1',
  `email` varchar(80) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `full_path_files` varchar(200) DEFAULT NULL,
  `token` varchar(256) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT  IGNORE INTO `users` (`id`, `parent_id`, `email`, `password`, `group_id`, `role`, `first_name`, `last_name`, `full_path_files`, `token`, `created`, `modified`) VALUES (1,1,'admin@aveeze.com.br','$2a$10$CTkfFfd8iby6f8CZyStdy.74RVLT9Gw4DCi6VivZSS6AMhxdgyIc.',1,'admin','Aveeze','Notificações Online','c4ca4238a0b923820dcc509a6f75849b',NULL,'2017-09-26 12:39:31','2017-10-10 11:47:36'),(2,1,'saulostopa@gmail.com','$2a$10$CTkfFfd8iby6f8CZyStdy.74RVLT9Gw4DCi6VivZSS6AMhxdgyIc.',1,'admin','Saulo','Stopa',NULL,'8150b818f430d85151e79f3b575f2e4c64af6379','2017-09-26 12:39:31','2017-10-06 15:46:07'),(3,1,'pedro@ricardo.com.br','$2a$10$8Hx7rs.KCEkg7gZSRNlYk.2.RQD7bli/Atpt5uloqs1WgnEmfUKtS',2,'manager','Pedro','Ricardo',NULL,NULL,'2017-10-02 20:41:17','2017-10-02 22:39:51'),(4,3,'carlos@chagas.com.br','$2a$10$l6FR3kzBhEoViWqZEx/DE.6nBgtyuVJK8.bCzuHIYe.BFAyZh.X6a',3,'user','Carlos','Chagas',NULL,NULL,'2017-10-09 19:16:28','2017-10-09 19:16:28'),(5,3,'danilo@elfort.com.br','$2a$10$MPA8xq0Zl3CN2npUeshYfumxvkKSd9N5jz/fuBT1aNqvCgb98AyfS',3,'user','Danilo','Elfort',NULL,NULL,'2017-10-09 19:17:51','2017-10-09 19:17:51'),(6,3,'eliseu@almeida.com.br','$2a$10$JISw2800acytYlcjwg/I8eXJ3OI3X/EYjbKIW.pYk5QvQrVXLsYdS',2,'manager','Eliseu','Almeida',NULL,NULL,'2017-10-09 19:18:14','2017-10-09 19:18:14'),(7,3,'fabio@goncalves.com.br','$2a$10$tbS25XxXR/2z0OoDXSJ5O.NCUVZMNPcGDQ3xLrLkd1xDZ6AkrPOZe',3,'user','Fabio','Gonçalves',NULL,NULL,'2017-10-09 19:19:15','2017-10-09 19:19:15'),(8,3,'gabriel@hector.com.br','$2a$10$tzbiw.PnQLsO/XfQY3T4quceFO8E7wVXkInnYNrOdHlA06wJcHF6a',3,'user','Gabriel','Hector',NULL,NULL,'2017-10-09 19:21:24','2017-10-09 19:21:24'),(9,3,'itamar@franco.com.br','$2a$10$tB99cTFQyDHZJ.d/denUheKidqCqA9wA8fK2sxMpXyArCENo.6Kta',3,'user','Itamar','Franco',NULL,NULL,'2017-10-09 19:22:05','2017-10-09 19:22:05'),(10,3,'julio@brandao.com.br','$2a$10$6UagoQaYAVxzuxuG/MhAROdsDrh8HzapxjHgRYB5MuwC44XAnsVs6',3,'user','Julio','Brandão',NULL,NULL,'2017-10-09 19:22:28','2017-10-09 19:22:28'),(11,1,'kleber@limeira.com.br','$2a$10$jmYRl6QghA5QqVEc6diAweE1nagJv9pbnUvs2XQA2lGytTswjXWli',3,'user','Kleber','Limeira',NULL,NULL,'2017-10-09 19:23:01','2017-10-09 19:23:01'),(12,1,'luciano@mendes.com.br','$2a$10$G0egisr8wSWm26YF9WRkBONX24/2LzAOfom/oW4f9m1/zprYqxAgG',3,'user','Luciano','Mendes',NULL,NULL,'2017-10-09 19:23:32','2017-10-09 19:23:32');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widgets`
--

DROP TABLE IF EXISTS `widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `part_no` varchar(12) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widgets`
--

LOCK TABLES `widgets` WRITE;
/*!40000 ALTER TABLE `widgets` DISABLE KEYS */;
/*!40000 ALTER TABLE `widgets` ENABLE KEYS */;
UNLOCK TABLES;