ALTER DATABASE `%dbname%` COLLATE 'utf8_general_ci';

CREATE TABLE IF NOT EXISTS `%prefix%hook` (
  `hook_id` int(11) NOT NULL AUTO_INCREMENT,
  `hook_function_name` varchar(150) DEFAULT NULL COMMENT 'function name to pass vars',
  `hook_effect` varchar(255) DEFAULT NULL COMMENT 'hook effect is echo where is need act this hook',
  `hook_plugin` varchar(150) DEFAULT NULL COMMENT 'name of hook parent',
  PRIMARY KEY (`hook_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='here is all hooks in actived plugin';

CREATE TABLE IF NOT EXISTS `%prefix%plugin` (
  `plugin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plugin_name` varchar(150) DEFAULT NULL,
  `plugin_status` tinyint(1) DEFAULT '0',
  `plugin_version` varchar(10) DEFAULT '0',
  `plugin_url` varchar(1024) DEFAULT '0',
  `plugin_author` varchar(60) DEFAULT '0',
  `plugin_discrption` text,
  PRIMARY KEY (`plugin_id`),
  KEY `plugin_name` (`plugin_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='active plugin list';


CREATE TABLE IF NOT EXISTS `%prefix%registry` (
  `registry_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `registry_root` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'root of key unoknow , system , plugin &  ...',
  `registry_key` varchar(128) NOT NULL COMMENT 'key name',
  `registry_value` longtext COMMENT 'vlaue of key',
  PRIMARY KEY (`registry_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='system registry same as windows registry';

ALTER TABLE `%prefix%registry`
	ADD UNIQUE INDEX `registry_root_registry_key` (`registry_root`, `registry_key`);

CREATE TABLE IF NOT EXISTS `%prefix%relation` (
  `src` bigint(20) unsigned NOT NULL COMMENT 'source',
  `dst` bigint(20) unsigned NOT NULL COMMENT 'destination',
  `typ` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='relationship table';


CREATE TABLE IF NOT EXISTS `%prefix%trylog` (
  `trylog_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trylog_type` tinyint(3) unsigned DEFAULT NULL,
  `trylog_ip` bigint(20) unsigned DEFAULT NULL,
  `trylog_time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`trylog_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='try events log.';
