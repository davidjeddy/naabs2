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
-- Table structure for table `time_amount_options`
--

DROP TABLE IF EXISTS `time_amount_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `time_amount_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(32) NOT NULL,
  `value` int(11) NOT NULL,
  `cost` varchar(16) NOT NULL DEFAULT '0.00',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_amount_options`
--

LOCK TABLES `time_amount_options` WRITE;
/*!40000 ALTER TABLE `time_amount_options` DISABLE KEYS */;
INSERT INTO `time_amount_options` (`id`, `key`, `value`, `cost`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'4 hours',14400,'2.95',0,NULL,NULL),(2,'1 day (24 hours)',86400,'5.95',0,NULL,NULL),(3,'One Week (7 days)',604800,'11.95',0,NULL,NULL),(4,'One Month (30 days)',2419200,'24.95',0,NULL,NULL),(5,'Three Months (90 days)',7776000,'69.95',0,NULL,NULL),(6,'Six Months (180 days)',15552000,'132.95',0,NULL,NULL);
/*!40000 ALTER TABLE `time_amount_options` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `time_amount_options_BINS` BEFORE INSERT ON `time_amount_options` FOR EACH ROW

            SET new.created_at = UNIX_TIMESTAMP(NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `device_count_id` int(11) DEFAULT NULL,
  `time_amount_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `f_name` varchar(45) NOT NULL,
  `l_name` varchar(45) NOT NULL,
  `street_1` varchar(45) NOT NULL,
  `street_2` varchar(45) DEFAULT NULL,
  `city` varchar(45) NOT NULL,
  `prov` varchar(45) NOT NULL,
  `postal` varchar(45) NOT NULL,
  `last_4` int(4) NOT NULL,
  `price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `return_code` int(11) DEFAULT NULL,
  `return_message` varchar(45) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `device_id_idx` (`device_count_id`),
  KEY `time_id_idx` (`time_amount_id`),
  KEY `id_idx` (`country_id`),
  CONSTRAINT `device_count` FOREIGN KEY (`device_count_id`) REFERENCES `device_count_options` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `time_amount` FOREIGN KEY (`time_amount_id`) REFERENCES `time_amount_options` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase`
--

LOCK TABLES `purchase` WRITE;
/*!40000 ALTER TABLE `purchase` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radcheck`
--

DROP TABLE IF EXISTS `radcheck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radcheck` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `attribute` varchar(32) NOT NULL,
  `op` varchar(2) NOT NULL,
  `value` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radcheck`
--

LOCK TABLES `radcheck` WRITE;
/*!40000 ALTER TABLE `radcheck` DISABLE KEYS */;
/*!40000 ALTER TABLE `radcheck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `f_name` varchar(16) NOT NULL,
  `l_name` varchar(16) DEFAULT NULL,
  `p_phone` int(11) NOT NULL,
  `s_phone` int(11) DEFAULT NULL,
  `s_question` varchar(128) NOT NULL,
  `s_answer` varchar(128) NOT NULL,
  `p_email` varchar(64) NOT NULL,
  `s_email` varchar(64) DEFAULT NULL,
  `role` int(2) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_details`
--

LOCK TABLES `user_details` WRITE;
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_data`
--

DROP TABLE IF EXISTS `app_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Hold application data that does not necessarily fit into other locations of the application. Exp: tos / about / etc. Use this as a flex storage location as well.',
  `key` varchar(8) NOT NULL,
  `value` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_data`
--

LOCK TABLES `app_data` WRITE;
/*!40000 ALTER TABLE `app_data` DISABLE KEYS */;
INSERT INTO `app_data` (`id`, `key`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'App Name','Naabs 2',0,NULL,NULL),(2,'tos','<div class=\"well well-lg\"> <div><p class=\"MsoNormal\" style=\"margin-bottom:7.5pt\"><b><span style=\"font-size:14.5pt;font-family:Arial,sans-serif;color:rgb(52,50,46)\">Wi-Fi Access <span class=\"il\">Terms</span> <span class=\"il\">and</span> <span class=\"il\">Conditions</span></span></b></p>  <p class=\"MsoNormal\" style=\"margin-bottom:15pt;line-height:16.8pt\"><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">This agreement sets out the <span class=\"il\">terms</span> <span class=\"il\">and</span> <span class=\"il\">conditions</span> on which wireless internet access (“the <span class=\"il\">Service</span>”) is provided by Windnetworks WiFi, LLC (“The Provider”).</span></p>  <p class=\"MsoNormal\" style=\"margin-bottom:15pt;line-height:16.8pt\"><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">The Provider provides wifi access for a fee at Recreation Plantation (“The Park”). The Park allows The Provider to operate in its area.</span></p>  <p class=\"MsoNormal\" style=\"margin-bottom:15pt;line-height:16.8pt\"><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">For the purposes <span class=\"il\">of</span> this Agreement a Guest is defined as an end user accessing the <span class=\"il\">Service</span>.</span></p>  <p class=\"MsoNormal\" style=\"margin-bottom:15pt;line-height:16.8pt\"><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">Your access to the <span class=\"il\">Service</span> is completely at the discretion <span class=\"il\">of</span> The Provider.&nbsp; Access to the <span class=\"il\">Service</span> may be blocked, suspended, or terminated at any time for any reason including, but not limited to, violation <span class=\"il\">of</span> this Agreement, actions that may lead to liability for The Provider or The Park, disruption <span class=\"il\">of</span> access to other users or networks, <span class=\"il\">and</span> violation <span class=\"il\">of</span> applicable laws or regulations.&nbsp; The Provider reserves the right to monitor <span class=\"il\">and</span> collect information while you are connected to the <span class=\"il\">Service</span> <span class=\"il\">and</span> that the collected information can be used at discretion <span class=\"il\">of</span> The Provider, including sharing the information with any law enforcement agencies <span class=\"il\">and</span> The Park.</span></p>  <p class=\"MsoNormal\" style=\"margin-bottom:15pt;line-height:16.8pt\"><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">The Provider may revise this Agreement at any time. You must accept this Agreement each time you <span class=\"il\">use</span> the <span class=\"il\">Service</span> <span class=\"il\">and</span> it is your responsibility to review it for any changes each time.</span></p>  <p class=\"MsoNormal\" style=\"margin-bottom:15pt;line-height:16.8pt\"><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">We reserve the right at all times to withdraw the <span class=\"il\">Service</span>, change the specifications or manner <span class=\"il\">of</span> <span class=\"il\">use</span> <span class=\"il\">of</span> the <span class=\"il\">Service</span>, to change access codes, usernames, passwords or other security information necessary to access the <span class=\"il\">service</span>.</span></p>  <p class=\"MsoNormal\" style=\"margin-bottom:15pt;line-height:16.8pt\"><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">IF YOU DO NOT AGREE WITH THESE <span class=\"il\">TERMS</span>, INCLUDING CHANGES THERETO, DO NOT ACCESS OR <span class=\"il\">USE</span> THE <span class=\"il\">SERVICE</span>.</span></p>  <p class=\"MsoNormal\" style=\"margin:0in 0in 0.0001pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:Symbol;color:rgb(109,109,109)\"><span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><b><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">1.&nbsp;Disclaimer</span></b><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\"></span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 15pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">You acknowledge</span></p>  <p class=\"MsoNormal\" style=\"margin-left:26.25pt;line-height:16.8pt\"><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">1.<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">that the <span class=\"il\">Service</span> may not be uninterrupted or error-free;</span></p>  <p class=\"MsoNormal\" style=\"margin-left:26.25pt;line-height:16.8pt\"><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">2.<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">that your device may be exposed to viruses or other harmful applications&nbsp; through the internet;</span></p>  <p class=\"MsoNormal\" style=\"margin-left:26.25pt;line-height:16.8pt\"><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">3.<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">that </span><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">The Provider</span><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\"> does not guarantee the security <span class=\"il\">of</span> the <span class=\"il\">Service</span> <span class=\"il\">and</span> that unauthorized third parties may access your computer or files or otherwise monitor your connection, you are encourage to maintain latest virus, malware <span class=\"il\">and</span> other threat protection software for you end point device accessing the <span class=\"il\">Service</span>;</span></p>  <p class=\"MsoNormal\" style=\"margin-left:26.25pt;line-height:16.8pt\"><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">4.<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">that </span><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">The Provider’s</span><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\"> ability to provide the <span class=\"il\">Service</span> is based on the limited warranty, disclaimer <span class=\"il\">and</span> limitation <span class=\"il\">of</span> liability specified in this Section;</span></p>  <p class=\"MsoNormal\" style=\"margin-left:26.25pt;line-height:16.8pt\"><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">5.<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">that </span><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">The Provider</span><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\"> can at any point block access to Internet <span class=\"il\">Services</span> that they deem violate the acceptable <span class=\"il\">terms</span> <span class=\"il\">of</span> <span class=\"il\">use</span> outlined in 2.1.</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 15pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">The <span class=\"il\">service</span> <span class=\"il\">and</span> any products or <span class=\"il\">services</span> provided on or in connection with the <span class=\"il\">service</span> are provided on an \"as is\", \"as available\" basis without warranties <span class=\"il\">of</span> any kind. All warranties, <span class=\"il\">conditions</span>, representations, indemnities <span class=\"il\">and</span> guarantees with respect to the content or <span class=\"il\">service</span> <span class=\"il\">and</span> the operation, capacity, speed, functionality, qualifications, or capabilities <span class=\"il\">of</span> the <span class=\"il\">services</span>, goods or personnel resources provided hereunder, whether express or implied, arising by law, custom, prior oral or written statements by The Provider, or otherwise (including, but not limited to any warranty <span class=\"il\">of</span> satisfactory quality, merchantability, fitness for particular purpose, title <span class=\"il\">and</span> non-infringement) are hereby overridden, excluded <span class=\"il\">and</span> disclaimed.</span></p>  <p class=\"MsoNormal\" style=\"margin:0in 0in 0.0001pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:Symbol;color:rgb(109,109,109)\"><span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><b><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">2.&nbsp;Acceptable <span class=\"il\">Use</span> <span class=\"il\">of</span> the <span class=\"il\">Service</span></span></b><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\"></span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 15pt 48pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:\'Courier New\';color:rgb(109,109,109)\">o<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">2.1 &nbsp;You must not <span class=\"il\">use</span> the <span class=\"il\">Service</span> to access Internet <span class=\"il\">Services</span> which:</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 3.75pt 76.5pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:Wingdings;color:rgb(109,109,109)\">§<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">2.1.1 &nbsp;Are considered illegal or against local law or government regulations;</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 3.75pt 76.5pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:Wingdings;color:rgb(109,109,109)\">§<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">2.1.2 &nbsp;contain material which infringe third party’s rights (including intellectual property rights);</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 3.75pt 76.5pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:Wingdings;color:rgb(109,109,109)\">§<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">2.1.3 &nbsp;in our reasonable opinion may adversely affect the manner in which we carry out our work;</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 3.75pt 76.5pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:Wingdings;color:rgb(109,109,109)\">§<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">2.1.4 &nbsp;produce <span class=\"il\">and</span>/or send bulk <span class=\"il\">and</span>/or spam message <span class=\"il\">and</span>/or unwanted commercial messages;</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 3.75pt 76.5pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:Wingdings;color:rgb(109,109,109)\">§<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">2.1.5 &nbsp;contain forged or misrepresented message headers, whether in whole or in part, to mask the originator <span class=\"il\">of</span> the message;</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 3.75pt 76.5pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:Wingdings;color:rgb(109,109,109)\">§<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">2.1.6 &nbsp;are activities that invade another’s privacy; or</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 3.75pt 76.5pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:Wingdings;color:rgb(109,109,109)\">§<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">2.1.7 &nbsp;are otherwise unlawful or inappropriate;</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 15pt 48pt\"><span style=\"line-height:16.8pt;font-size:10pt;font-family:\'Courier New\';color:rgb(109,109,109)\">o<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><font color=\"#6d6d6d\" face=\"Arial, sans-serif\"><span style=\"line-height:16.8pt\">2.2 &nbsp;Music, video, pictures, text <span class=\"il\">and</span> other content on the internet are copyright works <span class=\"il\">and</span> you should not download, alter, e-mail or otherwise <span class=\"il\">use</span> such content unless certain that the owner <span class=\"il\">of</span> such works has&nbsp;</span></font><font color=\"#6d6d6d\" face=\"Arial, sans-serif\"><span style=\"line-height:22.399999618530273px\">authorized</span></font><font color=\"#6d6d6d\" face=\"Arial, sans-serif\"><span style=\"line-height:16.8pt\">&nbsp;its <span class=\"il\">use</span> by you.</span></font></p>   <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 15pt 48pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:\'Courier New\';color:rgb(109,109,109)\">o<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">2.3 &nbsp;You must not <span class=\"il\">use</span> the <span class=\"il\">service</span> to access illegally or without authorization computers, accounts, equipment or networks belonging to another party, or attempting to penetrate security measures <span class=\"il\">of</span> another system. This includes any activity that may be used as a precursor to an attempted system penetration, including, but not limited to, port scans, stealth scans, or other information gathering activity.</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 15pt 48pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:\'Courier New\';color:rgb(109,109,109)\">o<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">2.4 &nbsp;You must not <span class=\"il\">use</span> the <span class=\"il\">service</span> to distribute Internet Viruses, Trojan Horses, or other destructive software.</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 15pt 48pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:\'Courier New\';color:rgb(109,109,109)\">o<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">2.6 &nbsp;We may terminate or temporarily suspend the <span class=\"il\">Service</span> if we reasonably believe that you are in breach <span class=\"il\">of</span> any provisions <span class=\"il\">of</span> this agreement.</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 15pt 48pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:\'Courier New\';color:rgb(109,109,109)\">o<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">2.7 &nbsp;We recommend that you <span class=\"il\">use</span> antivirus, malware <span class=\"il\">and</span> threat detection software. That you transmit confidential data to trusted secured sites only, <span class=\"il\">and</span> set your computers Firewall to the highest settings that are recommended for public WiFi <span class=\"il\">use</span>.</span></p>  <p class=\"MsoNormal\" style=\"margin:0in 0in 0.0001pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:Symbol;color:rgb(109,109,109)\"><span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><b><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">3.&nbsp;Criminal Activity</span></b><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\"></span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 15pt 48pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:\'Courier New\';color:rgb(109,109,109)\">o<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">3.1 &nbsp;You must not <span class=\"il\">use</span> the <span class=\"il\">Service</span> to engage in any activity which constitutes or is capable <span class=\"il\">of</span> constituting a criminal offence, either in the United States or in any country throughout the world.</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 15pt 48pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:\'Courier New\';color:rgb(109,109,109)\">o<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">3.2 &nbsp;You agree <span class=\"il\">and</span> acknowledge that we may be required to provide assistance <span class=\"il\">and</span> information to law enforcement, governmental agencies <span class=\"il\">and</span> other authorities.</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 15pt 48pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:\'Courier New\';color:rgb(109,109,109)\">o<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">3.3 &nbsp;You agree <span class=\"il\">and</span> acknowledge that we will monitor your activity while you <span class=\"il\">use</span> this <span class=\"il\">service</span> <span class=\"il\">and</span> keep a log <span class=\"il\">of</span> the Internet Protocol (“IP”) addresses <span class=\"il\">of</span> any devices which access the <span class=\"il\">Service</span>, the times when they have accessed the <span class=\"il\">Service</span> <span class=\"il\">and</span> the activity associated with that IP address</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 15pt 48pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:\'Courier New\';color:rgb(109,109,109)\">o<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">3.4 &nbsp;You further agree we are entitled to co-operate with law enforcement authorities <span class=\"il\">and</span> rights-holders in the investigation <span class=\"il\">of</span> any suspected or alleged illegal activity by you which may include, but is not limited to, disclosure <span class=\"il\">of</span> such information as we have (whether pursuant to clause 3.3 or otherwise), <span class=\"il\">and</span> are entitled to provide by law, to law enforcement authorities or rights-holders.</span></p>  <p class=\"MsoNormal\" style=\"margin:0in 0in 0.0001pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:Symbol;color:rgb(109,109,109)\"><span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><b><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">4.&nbsp;Other <span class=\"il\">Terms</span></span></b><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\"></span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 15pt 48pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:\'Courier New\';color:rgb(109,109,109)\">o<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">4.1 &nbsp;Under no circumstances will The Provider, The Park, their suppliers or licensors, or their respective officers, directors, employees, agents, <span class=\"il\">and</span> affiliates be liable for consequential, indirect, special, punitive or incidental damages, whether foreseeable or unforeseeable, based on claims <span class=\"il\">of</span> the Guest or its appointees (including, but not limited to, unauthorized access, damage, or theft <span class=\"il\">of</span> your system or data, claims for loss <span class=\"il\">of</span> goodwill, claims for loss <span class=\"il\">of</span> data, <span class=\"il\">use</span> <span class=\"il\">of</span> or reliance on the <span class=\"il\">service</span>, stoppage <span class=\"il\">of</span> other work or impairment <span class=\"il\">of</span> other assets, or damage caused to equipment or programs from any virus or other harmful application), arising out <span class=\"il\">of</span> breach or failure <span class=\"il\">of</span> express or implied warranty, breach <span class=\"il\">of</span> contract, misrepresentation, negligence, strict liability in tort or otherwise.</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 15pt 48pt\"><span style=\"line-height:16.8pt;font-size:10pt;font-family:\'Courier New\';color:rgb(109,109,109)\">o<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"line-height:16.8pt;font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">4.2 &nbsp;You agree to indemnify <span class=\"il\">and</span> hold harmless </span><span style=\"line-height:16.8pt;font-size:9pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">The Provider, The Park</span><font color=\"#6d6d6d\" face=\"Arial, sans-serif\"><span style=\"line-height:16.8pt\"> <span class=\"il\">and</span> its suppliers,</span></font><font color=\"#6d6d6d\" face=\"Arial, sans-serif\"><span style=\"line-height:16.8pt\">&nbsp;officers, directors, employees, agents <span class=\"il\">and</span> affiliates from any claim,&nbsp;liability, loss, damage, cost, or expense (including without limitation reasonable attorney\'s fees) arising out <span class=\"il\">of</span> or related to your <span class=\"il\">use</span> <span class=\"il\">of</span> the <span class=\"il\">Service</span>, any materials downloaded or uploaded through the <span class=\"il\">Service</span>, any actions taken by you in connection with your <span class=\"il\">use</span> <span class=\"il\">of</span> the <span class=\"il\">Service</span>, any violation <span class=\"il\">of</span> any third party\'s rights or an violation <span class=\"il\">of</span> law or regulation, or any breach <span class=\"il\">of</span> this agreement. This Section will not be construed to limit or exclude any other claims or remedies that </span></font><span style=\"line-height:16.8pt;font-size:9pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">The Provider</span><span style=\"line-height:16.8pt;font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\"> may assert under this Agreement or by law.</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 15pt 48pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:\'Courier New\';color:rgb(109,109,109)\">o<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">4.3 &nbsp;This Agreement shall not be construed as creating a partnership, joint venture, agency relationship or granting a franchise between the parties. Except as otherwise provided above, any waiver, amendment or other modification <span class=\"il\">of</span> this Agreement will not be effective unless in writing <span class=\"il\">and</span> signed by the party against whom enforcement is sought. If any provision <span class=\"il\">of</span> this Agreement is held to be unenforceable, in whole or in part, such holding will not affect the validity <span class=\"il\">of</span> the other provisions <span class=\"il\">of</span> this Agreement.</span></p>  <p class=\"MsoNormal\" style=\"margin:7.5pt 0in 15pt 48pt;line-height:16.8pt\"><span style=\"font-size:10pt;font-family:\'Courier New\';color:rgb(109,109,109)\">o<span style=\"font-size:7pt;line-height:normal;font-family:\'Times New Roman\'\">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\">4.4 &nbsp;</span><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">The Provider</span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\"> performance <span class=\"il\">of</span> this Agreement is subject to existing laws <span class=\"il\">and</span> legal process, <span class=\"il\">and</span> nothing contained in this Agreement shall waive or impede </span><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">The Provider’s</span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\"> right to comply with law enforcement requests or requirements relating to your <span class=\"il\">use</span> <span class=\"il\">of</span> this <span class=\"il\">Service</span> or information provided to or gathered by </span><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">The Provider</span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\"> with respect to such <span class=\"il\">use</span>. This Agreement constitutes the complete <span class=\"il\">and</span> entire statement <span class=\"il\">of</span> all <span class=\"il\">terms</span>, <span class=\"il\">conditions</span> <span class=\"il\">and</span> representations <span class=\"il\">of</span> the agreement between you <span class=\"il\">and</span> </span><span style=\"font-size:9pt;font-family:Arial,sans-serif;color:rgb(95,94,91)\">The Provider</span><span style=\"font-size:10pt;font-family:Arial,sans-serif;color:rgb(109,109,109)\"> with respect to its subject matter <span class=\"il\">and</span> supersedes all prior writings or understanding.</span></p>',0,NULL,NULL);
/*!40000 ALTER TABLE `app_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(2) NOT NULL DEFAULT '',
  `value` varchar(64) NOT NULL DEFAULT '',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` (`id`, `key`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'US','United States',0,NULL,NULL),(2,'CA','Canada',0,NULL,NULL),(3,'AF','Afghanistan',0,NULL,NULL),(4,'AL','Albania',0,NULL,NULL),(5,'DZ','Algeria',0,NULL,NULL),(6,'DS','American Samoa',0,NULL,NULL),(7,'AD','Andorra',0,NULL,NULL),(8,'AO','Angola',0,NULL,NULL),(9,'AI','Anguilla',0,NULL,NULL),(10,'AQ','Antarctica',0,NULL,NULL),(11,'AG','Antigua and/or Barbuda',0,NULL,NULL),(12,'AR','Argentina',0,NULL,NULL),(13,'AM','Armenia',0,NULL,NULL),(14,'AW','Aruba',0,NULL,NULL),(15,'AU','Australia',0,NULL,NULL),(16,'AT','Austria',0,NULL,NULL),(17,'AZ','Azerbaijan',0,NULL,NULL),(18,'BS','Bahamas',0,NULL,NULL),(19,'BH','Bahrain',0,NULL,NULL),(20,'BD','Bangladesh',0,NULL,NULL),(21,'BB','Barbados',0,NULL,NULL),(22,'BY','Belarus',0,NULL,NULL),(23,'BE','Belgium',0,NULL,NULL),(24,'BZ','Belize',0,NULL,NULL),(25,'BJ','Benin',0,NULL,NULL),(26,'BM','Bermuda',0,NULL,NULL),(27,'BT','Bhutan',0,NULL,NULL),(28,'BO','Bolivia',0,NULL,NULL),(29,'BA','Bosnia and Herzegovina',0,NULL,NULL),(30,'BW','Botswana',0,NULL,NULL),(31,'BV','Bouvet Island',0,NULL,NULL),(32,'BR','Brazil',0,NULL,NULL),(33,'IO','British lndian Ocean Territory',0,NULL,NULL),(34,'BN','Brunei Darussalam',0,NULL,NULL),(35,'BG','Bulgaria',0,NULL,NULL),(36,'BF','Burkina Faso',0,NULL,NULL),(37,'BI','Burundi',0,NULL,NULL),(38,'KH','Cambodia',0,NULL,NULL),(39,'CM','Cameroon',0,NULL,NULL),(40,'CV','Cape Verde',0,NULL,NULL),(41,'KY','Cayman Islands',0,NULL,NULL),(42,'CF','Central African Republic',0,NULL,NULL),(43,'TD','Chad',0,NULL,NULL),(44,'CL','Chile',0,NULL,NULL),(45,'CN','China',0,NULL,NULL),(46,'CX','Christmas Island',0,NULL,NULL),(47,'CC','Cocos (Keeling) Islands',0,NULL,NULL),(48,'CO','Colombia',0,NULL,NULL),(49,'KM','Comoros',0,NULL,NULL),(50,'CG','Congo',0,NULL,NULL),(51,'CK','Cook Islands',0,NULL,NULL),(52,'CR','Costa Rica',0,NULL,NULL),(53,'HR','Croatia (Hrvatska)',0,NULL,NULL),(54,'CU','Cuba',0,NULL,NULL),(55,'CY','Cyprus',0,NULL,NULL),(56,'CZ','Czech Republic',0,NULL,NULL),(57,'DK','Denmark',0,NULL,NULL),(58,'DJ','Djibouti',0,NULL,NULL),(59,'DM','Dominica',0,NULL,NULL),(60,'DO','Dominican Republic',0,NULL,NULL),(61,'TP','East Timor',0,NULL,NULL),(62,'EC','Ecuador',0,NULL,NULL),(63,'EG','Egypt',0,NULL,NULL),(64,'SV','El Salvador',0,NULL,NULL),(65,'GQ','Equatorial Guinea',0,NULL,NULL),(66,'ER','Eritrea',0,NULL,NULL),(67,'EE','Estonia',0,NULL,NULL),(68,'ET','Ethiopia',0,NULL,NULL),(69,'FK','Falkland Islands (Malvinas)',0,NULL,NULL),(70,'FO','Faroe Islands',0,NULL,NULL),(71,'FJ','Fiji',0,NULL,NULL),(72,'FI','Finland',0,NULL,NULL),(73,'FR','France',0,NULL,NULL),(74,'FX','France, Metropolitan',0,NULL,NULL),(75,'GF','French Guiana',0,NULL,NULL),(76,'PF','French Polynesia',0,NULL,NULL),(77,'TF','French Southern Territories',0,NULL,NULL),(78,'GA','Gabon',0,NULL,NULL),(79,'GM','Gambia',0,NULL,NULL),(80,'GE','Georgia',0,NULL,NULL),(81,'DE','Germany',0,NULL,NULL),(82,'GH','Ghana',0,NULL,NULL),(83,'GI','Gibraltar',0,NULL,NULL),(84,'GR','Greece',0,NULL,NULL),(85,'GL','Greenland',0,NULL,NULL),(86,'GD','Grenada',0,NULL,NULL),(87,'GP','Guadeloupe',0,NULL,NULL),(88,'GU','Guam',0,NULL,NULL),(89,'GT','Guatemala',0,NULL,NULL),(90,'GN','Guinea',0,NULL,NULL),(91,'GW','Guinea-Bissau',0,NULL,NULL),(92,'GY','Guyana',0,NULL,NULL),(93,'HT','Haiti',0,NULL,NULL),(94,'HM','Heard and Mc Donald Islands',0,NULL,NULL),(95,'HN','Honduras',0,NULL,NULL),(96,'HK','Hong Kong',0,NULL,NULL),(97,'HU','Hungary',0,NULL,NULL),(98,'IS','Iceland',0,NULL,NULL),(99,'IN','India',0,NULL,NULL),(100,'ID','Indonesia',0,NULL,NULL),(101,'IR','Iran (Islamic Republic of)',0,NULL,NULL),(102,'IQ','Iraq',0,NULL,NULL),(103,'IE','Ireland',0,NULL,NULL),(104,'IL','Israel',0,NULL,NULL),(105,'IT','Italy',0,NULL,NULL),(106,'CI','Ivory Coast',0,NULL,NULL),(107,'JM','Jamaica',0,NULL,NULL),(108,'JP','Japan',0,NULL,NULL),(109,'JO','Jordan',0,NULL,NULL),(110,'KZ','Kazakhstan',0,NULL,NULL),(111,'KE','Kenya',0,NULL,NULL),(112,'KI','Kiribati',0,NULL,NULL),(113,'KP','Korea, Democratic People\'s Republic of',0,NULL,NULL),(114,'KR','Korea, Republic of',0,NULL,NULL),(115,'XK','Kosovo',0,NULL,NULL),(116,'KW','Kuwait',0,NULL,NULL),(117,'KG','Kyrgyzstan',0,NULL,NULL),(118,'LA','Lao People\'s Democratic Republic',0,NULL,NULL),(119,'LV','Latvia',0,NULL,NULL),(120,'LB','Lebanon',0,NULL,NULL),(121,'LS','Lesotho',0,NULL,NULL),(122,'LR','Liberia',0,NULL,NULL),(123,'LY','Libyan Arab Jamahiriya',0,NULL,NULL),(124,'LI','Liechtenstein',0,NULL,NULL),(125,'LT','Lithuania',0,NULL,NULL),(126,'LU','Luxembourg',0,NULL,NULL),(127,'MO','Macau',0,NULL,NULL),(128,'MK','Macedonia',0,NULL,NULL),(129,'MG','Madagascar',0,NULL,NULL),(130,'MW','Malawi',0,NULL,NULL),(131,'MY','Malaysia',0,NULL,NULL),(132,'MV','Maldives',0,NULL,NULL),(133,'ML','Mali',0,NULL,NULL),(134,'MT','Malta',0,NULL,NULL),(135,'MH','Marshall Islands',0,NULL,NULL),(136,'MQ','Martinique',0,NULL,NULL),(137,'MR','Mauritania',0,NULL,NULL),(138,'MU','Mauritius',0,NULL,NULL),(139,'TY','Mayotte',0,NULL,NULL),(140,'MX','Mexico',0,NULL,NULL),(141,'FM','Micronesia, Federated States of',0,NULL,NULL),(142,'MD','Moldova, Republic of',0,NULL,NULL),(143,'MC','Monaco',0,NULL,NULL),(144,'MN','Mongolia',0,NULL,NULL),(145,'ME','Montenegro',0,NULL,NULL),(146,'MS','Montserrat',0,NULL,NULL),(147,'MA','Morocco',0,NULL,NULL),(148,'MZ','Mozambique',0,NULL,NULL),(149,'MM','Myanmar',0,NULL,NULL),(150,'NA','Namibia',0,NULL,NULL),(151,'NR','Nauru',0,NULL,NULL),(152,'NP','Nepal',0,NULL,NULL),(153,'NL','Netherlands',0,NULL,NULL),(154,'AN','Netherlands Antilles',0,NULL,NULL),(155,'NC','New Caledonia',0,NULL,NULL),(156,'NZ','New Zealand',0,NULL,NULL),(157,'NI','Nicaragua',0,NULL,NULL),(158,'NE','Niger',0,NULL,NULL),(159,'NG','Nigeria',0,NULL,NULL),(160,'NU','Niue',0,NULL,NULL),(161,'NF','Norfork Island',0,NULL,NULL),(162,'MP','Northern Mariana Islands',0,NULL,NULL),(163,'NO','Norway',0,NULL,NULL),(164,'OM','Oman',0,NULL,NULL),(165,'PK','Pakistan',0,NULL,NULL),(166,'PW','Palau',0,NULL,NULL),(167,'PA','Panama',0,NULL,NULL),(168,'PG','Papua New Guinea',0,NULL,NULL),(169,'PY','Paraguay',0,NULL,NULL),(170,'PE','Peru',0,NULL,NULL),(171,'PH','Philippines',0,NULL,NULL),(172,'PN','Pitcairn',0,NULL,NULL),(173,'PL','Poland',0,NULL,NULL),(174,'PT','Portugal',0,NULL,NULL),(175,'PR','Puerto Rico',0,NULL,NULL),(176,'QA','Qatar',0,NULL,NULL),(177,'RE','Reunion',0,NULL,NULL),(178,'RO','Romania',0,NULL,NULL),(179,'RU','Russian Federation',0,NULL,NULL),(180,'RW','Rwanda',0,NULL,NULL),(181,'KN','Saint Kitts and Nevis',0,NULL,NULL),(182,'LC','Saint Lucia',0,NULL,NULL),(183,'VC','Saint Vincent and the Grenadines',0,NULL,NULL),(184,'WS','Samoa',0,NULL,NULL),(185,'SM','San Marino',0,NULL,NULL),(186,'ST','Sao Tome and Principe',0,NULL,NULL),(187,'SA','Saudi Arabia',0,NULL,NULL),(188,'SN','Senegal',0,NULL,NULL),(189,'RS','Serbia',0,NULL,NULL),(190,'SC','Seychelles',0,NULL,NULL),(191,'SL','Sierra Leone',0,NULL,NULL),(192,'SG','Singapore',0,NULL,NULL),(193,'SK','Slovakia',0,NULL,NULL),(194,'SI','Slovenia',0,NULL,NULL),(195,'SB','Solomon Islands',0,NULL,NULL),(196,'SO','Somalia',0,NULL,NULL),(197,'ZA','South Africa',0,NULL,NULL),(198,'GS','South Georgia South Sandwich Islands',0,NULL,NULL),(199,'ES','Spain',0,NULL,NULL),(200,'LK','Sri Lanka',0,NULL,NULL),(201,'SH','St. Helena',0,NULL,NULL),(202,'PM','St. Pierre and Miquelon',0,NULL,NULL),(203,'SD','Sudan',0,NULL,NULL),(204,'SR','Suriname',0,NULL,NULL),(205,'SJ','Svalbarn and Jan Mayen Islands',0,NULL,NULL),(206,'SZ','Swaziland',0,NULL,NULL),(207,'SE','Sweden',0,NULL,NULL),(208,'CH','Switzerland',0,NULL,NULL),(209,'SY','Syrian Arab Republic',0,NULL,NULL),(210,'TW','Taiwan',0,NULL,NULL),(211,'TJ','Tajikistan',0,NULL,NULL),(212,'TZ','Tanzania, United Republic of',0,NULL,NULL),(213,'TH','Thailand',0,NULL,NULL),(214,'TG','Togo',0,NULL,NULL),(215,'TK','Tokelau',0,NULL,NULL),(216,'TO','Tonga',0,NULL,NULL),(217,'TT','Trinidad and Tobago',0,NULL,NULL),(218,'TN','Tunisia',0,NULL,NULL),(219,'TR','Turkey',0,NULL,NULL),(220,'TM','Turkmenistan',0,NULL,NULL),(221,'TC','Turks and Caicos Islands',0,NULL,NULL),(222,'TV','Tuvalu',0,NULL,NULL),(223,'UG','Uganda',0,NULL,NULL),(224,'UA','Ukraine',0,NULL,NULL),(225,'AE','United Arab Emirates',0,NULL,NULL),(226,'GB','United Kingdom',0,NULL,NULL),(227,'UM','United States minor outlying islands',0,NULL,NULL),(228,'UY','Uruguay',0,NULL,NULL),(229,'UZ','Uzbekistan',0,NULL,NULL),(230,'VU','Vanuatu',0,NULL,NULL),(231,'VA','Vatican City State',0,NULL,NULL),(232,'VE','Venezuela',0,NULL,NULL),(233,'VN','Vietnam',0,NULL,NULL),(234,'VG','Virgin Islands (British)',0,NULL,NULL),(235,'VI','Virgin Islands (U.S.)',0,NULL,NULL),(236,'WF','Wallis and Futuna Islands',0,NULL,NULL),(237,'EH','Western Sahara',0,NULL,NULL),(238,'YE','Yemen',0,NULL,NULL),(239,'YU','Yugoslavia',0,NULL,NULL),(240,'ZR','Zaire',0,NULL,NULL),(241,'ZM','Zambia',0,NULL,NULL),(242,'ZW','Zimbabwe',0,NULL,NULL);
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `device_name` varchar(64) NOT NULL,
  `pass_phrase` varchar(8) NOT NULL,
  `expiration` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device`
--

LOCK TABLES `device` WRITE;
/*!40000 ALTER TABLE `device` DISABLE KEYS */;
/*!40000 ALTER TABLE `device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_count_options`
--

DROP TABLE IF EXISTS `device_count_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device_count_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(32) NOT NULL,
  `value` int(11) NOT NULL,
  `cost` varchar(16) NOT NULL DEFAULT '0.00',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_count_options`
--

LOCK TABLES `device_count_options` WRITE;
/*!40000 ALTER TABLE `device_count_options` DISABLE KEYS */;
INSERT INTO `device_count_options` (`id`, `key`, `value`, `cost`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'One (1)',1,'1.00',0,NULL,NULL),(2,'Two (2)',2,'2.00',0,NULL,NULL),(3,'Three (3)',3,'3.00',0,NULL,NULL),(4,'Four (4)',4,'4.00',0,NULL,NULL),(5,'Five (5)',5,'5.00',0,NULL,NULL);
/*!40000 ALTER TABLE `device_count_options` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`%`*/ /*!50003 TRIGGER `device_count_options_BINS` BEFORE INSERT ON `device_count_options` FOR EACH ROW

            SET new.created_at = UNIX_TIMESTAMP(NOW()) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `value` int(2) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `value_UNIQUE` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `name`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'admin',10,0,NULL,NULL),(2,'user',20,0,NULL,NULL);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'naabs2'
--

--
-- Dumping routines for database 'naabs2'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;