/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `eventid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `starttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `published` tinyint(4) DEFAULT NULL,
  `submitter` int(10) unsigned NOT NULL,
  PRIMARY KEY (`eventid`),
  KEY `starttime` (`starttime`),
  KEY `endtime` (`endtime`),
  KEY `submitter` (`submitter`)
) ENGINE=InnoDB AUTO_INCREMENT=20001 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mech_event_registration` (
  `mechid` int(10) unsigned NOT NULL,
  `eventid` int(10) unsigned NOT NULL,
  `reguser` int(10) unsigned NOT NULL,
  `regtime` datetime DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mechid`,`eventid`),
  KEY `reguser` (`reguser`),
  KEY `eventid` (`eventid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mechs` (
  `mechid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `builder` int(10) unsigned NOT NULL,
  `team` int(10) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`mechid`),
  KEY `name` (`name`),
  KEY `builder` (`builder`),
  KEY `team` (`team`)
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `sessionid` varchar(255) NOT NULL DEFAULT '',
  `data` text,
  `expires` datetime DEFAULT NULL,
  PRIMARY KEY (`sessionid`),
  KEY `expires` (`expires`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teammembers` (
  `teamid` int(10) unsigned NOT NULL,
  `userid` int(10) unsigned NOT NULL,
  `membersince` datetime NOT NULL,
  `teamadmin` tinyint(4) DEFAULT '0',
  `approved` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`teamid`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `teamid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `leader` int(10) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`teamid`),
  KEY `name` (`name`),
  KEY `leader` (`leader`)
) ENGINE=InnoDB AUTO_INCREMENT=30002 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `useremaillog` (
  `userid` int(10) unsigned NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `setdate` datetime DEFAULT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT '0',
  KEY `userid` (`userid`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `useriplog` (
  `userid` int(10) unsigned NOT NULL,
  `ipaddr` varchar(64) DEFAULT NULL,
  `attime` datetime DEFAULT NULL,
  KEY `userid` (`userid`),
  KEY `ipaddr` (`ipaddr`),
  KEY `attime` (`attime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usernamelog` (
  `userid` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `setdate` datetime DEFAULT NULL,
  KEY `userid` (`userid`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `verified` tinyint(4) DEFAULT '0',
  `verifykey` varchar(255) DEFAULT NULL,
  `passwordhash` varchar(255) DEFAULT NULL,
  `registerdate` datetime DEFAULT NULL,
  `disabled` tinyint(4) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `adminlevel` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=40004 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
