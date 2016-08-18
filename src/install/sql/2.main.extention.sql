CREATE TABLE IF NOT EXISTS `%prefix%attach` (
  `attach_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attach_filename` varchar(2048) COLLATE utf8_estonian_ci NOT NULL,
  `attach_ext` varchar(5) COLLATE utf8_estonian_ci NOT NULL,
  `attach_location` varchar(4096) COLLATE utf8_estonian_ci NOT NULL,
  `attach_url` varchar(4096) COLLATE utf8_estonian_ci NOT NULL,
  `attach_time` int(11) unsigned NOT NULL,
  `attach_size` int(10) unsigned NOT NULL DEFAULT '0',
  `attach_label` varchar(255) COLLATE utf8_estonian_ci DEFAULT NULL,
  `attach_download` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`attach_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;


CREATE TABLE IF NOT EXISTS `%prefix%comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `comment_member_id` int(11) NOT NULL COMMENT 'member id',
  `comment_text` mediumtext COLLATE utf8_estonian_ci NOT NULL COMMENT 'comment content',
  `comment_guest_info` text COLLATE utf8_estonian_ci COMMENT 'if guest info',
  `comment_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'comment status, default = penddling',
  `comment_ip` bigint(20) unsigned NOT NULL COMMENT 'commneter id',
  `comment_time` int(11) NOT NULL,
  `comment_parent` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '0 = not reply',
  `comment_topic_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;


CREATE TABLE IF NOT EXISTS `%prefix%dropdown` (
  `dropdown_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dropdown_mode` tinyint(3) unsigned NOT NULL,
  `dropdown_title` varchar(255) NOT NULL,
  `dropdown_link` varchar(4096) NOT NULL,
  `dropdown_parent` tinyint(3) unsigned NOT NULL,
  `dropdown_sort_index` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`dropdown_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='.0';


CREATE TABLE IF NOT EXISTS `%prefix%member` (
  `member_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_email` varchar(90) COLLATE utf8_estonian_ci NOT NULL COMMENT 'email and login name',
  `member_password` varchar(32) COLLATE utf8_estonian_ci NOT NULL COMMENT 'password',
  `member_name` varchar(90) COLLATE utf8_estonian_ci NOT NULL COMMENT 'name and family',
  `member_register_time` int(11) unsigned NOT NULL,
  `member_active_time` int(11) unsigned NOT NULL DEFAULT '0',
  `member_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'user type ',
  `member_status` varchar(255) COLLATE utf8_estonian_ci NOT NULL COMMENT 'user status text',
  `member_avatar` varchar(255) COLLATE utf8_estonian_ci NOT NULL COMMENT 'avatar image name',
  `member_degree` varchar(50) COLLATE utf8_estonian_ci NOT NULL,
  `member_city` varchar(60) COLLATE utf8_estonian_ci NOT NULL,
  `member_number` varchar(11) COLLATE utf8_estonian_ci NOT NULL,
  `member_field` varchar(70) COLLATE utf8_estonian_ci NOT NULL,
  `member_chat` tinyint(1) NOT NULL DEFAULT '1',
  `member_comment` varchar(4096) COLLATE utf8_estonian_ci NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

ALTER TABLE `%prefix%member`
	ADD UNIQUE INDEX `member_email` (`member_email`);
CREATE TABLE IF NOT EXISTS `%prefix%statistic` (
  `statistic_id` int(11) NOT NULL AUTO_INCREMENT,
  `statistic_time` int(12) NOT NULL,
  `statistic_os` int(11) NOT NULL,
  `statistic_browser` int(11) NOT NULL,
  `statistic_verstion` int(11) NOT NULL DEFAULT '0',
  `statistic_visit` int(11) NOT NULL DEFAULT '1',
  `statistic_referer` varchar(2500) DEFAULT NULL,
  `statistic_keyword` varchar(128) DEFAULT NULL,
  `statistic_ip` bigint(20) NOT NULL,
  `statistic_last_visit` int(11) unsigned NOT NULL,
  PRIMARY KEY (`statistic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `%prefix%topic` (
  `topic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `topic_title` varchar(1024) NOT NULL,
  `topic_keyword` varchar(4069) NOT NULL,
  `topic_abstract` varchar(4096) NOT NULL,
  `topic_text` longtext NOT NULL,
  `topic_time` int(11) unsigned NOT NULL,
  `topic_owner_id` int(10) unsigned NOT NULL,
  `topic_image` varchar(4069) NOT NULL,
  `topic_status` tinyint(4) NOT NULL DEFAULT '0',
  `topic_counter` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_type` tinyint(3) unsigned NOT NULL,
  `topic_icon` varchar(255) DEFAULT NULL,
  `topic_term` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
