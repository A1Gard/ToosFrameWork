
CREATE TABLE IF NOT EXISTS `%prefix%category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_title` varchar(255) NOT NULL,
  `category_description` longtext NOT NULL,
  `category_parent` int(10) unsigned NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `%prefix%manager` (
  `manager_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `manager_username` varchar(65) NOT NULL,
  `manager_email` varchar(65) DEFAULT NULL,
  `manager_password` varchar(32) NOT NULL COMMENT 'password md5',
  `manager_displayname` varchar(65) DEFAULT NULL COMMENT 'manager display name.',
  `manager_lastlogin` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'last login time time stamp',
  `manager_type` tinyint(4) NOT NULL DEFAULT '0',
  `manager_protected` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`manager_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='cms manager table';


CREATE TABLE IF NOT EXISTS `%prefix%tag` (
  `tag_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_label` varchar(45) COLLATE utf8_estonian_ci NOT NULL,
  `tag_description` text COLLATE utf8_estonian_ci,
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

