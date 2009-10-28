DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `k` varchar(32) NOT NULL default '',
  `v` text NOT NULL,
  PRIMARY KEY  (`k`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `client_id` tinyint(4) NOT NULL auto_increment,
  `domain` varchar(60) NOT NULL,
  `private_key` char(32) NOT NULL,
  PRIMARY KEY  (`client_id`),
  UNIQUE KEY `domain` (`domain`)
) ENGINE=MyISAM;

-- --------------------------------------------------------
DROP TABLE IF EXISTS `forget_pwd`;
CREATE TABLE IF NOT EXISTS `forget_pwd` (
  `id` smallint(6) NOT NULL auto_increment,
  `user` varchar(64) character set utf8 NOT NULL,
  `code` char(32) NOT NULL,
  `start_ts` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

DROP TABLE IF EXISTS `onlineuser`;
CREATE TABLE IF NOT EXISTS `onlineuser` (
  `ticket` char(32) character set utf8 NOT NULL,
  `user` varchar(64) character set utf8 NOT NULL,
  `expiry` int(11) unsigned NOT NULL,
  `data` text character set utf8 NOT NULL,
  UNIQUE KEY `session_id` (`ticket`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM;


-- --------------------------------------------------------

DROP TABLE IF EXISTS `user_index`;
CREATE TABLE IF NOT EXISTS `user_index` (
  `user_id` int(11) NOT NULL auto_increment,
  `user` varchar(64) NOT NULL,
  `user_nickname` varchar(16) NOT NULL,
  `user_reg_time` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`user_id`),
  UNIQUE `user` (`user`),
  INDEX `user_nickname` (`user_nickname`),
  KEY `user_reg_time` (`user_reg_time`)
) ENGINE=MyISAM;

CREATE TABLE `__tblname__` ( 
`user_id` int(11) unsigned NOT NULL ,
`user` varchar(64) NOT NULL,
`user_password` char(32) NOT NULL,
`user_email` varchar(64) NOT NULL,
`user_nickname` varchar(16) NOT NULL,
`user_sex` tinyint(1) NOT NULL,
`user_state` tinyint(1) NOT NULL,
`user_reg_time` int(11) unsigned NOT NULL,
`user_reg_ip` varchar(16) NOT NULL,
`user_lastlogin_time` int(11) unsigned NOT NULL,
`user_lastlogin_ip` varchar(16) NOT NULL,
`user_question` VARCHAR( 128 ) NOT NULL,
`user_answer` VARCHAR( 30 ) NOT NULL, 
PRIMARY KEY  (`user_id`),
UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM