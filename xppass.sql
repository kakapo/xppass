-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2009 年 10 月 13 日 09:24
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `kakapo`
--

-- --------------------------------------------------------

--
-- 表的结构 `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `client_id` tinyint(4) NOT NULL auto_increment,
  `domain` varchar(60) NOT NULL,
  `private_key` char(32) NOT NULL,
  PRIMARY KEY  (`client_id`),
  UNIQUE KEY `domain` (`domain`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `forget_pwd`
--

CREATE TABLE IF NOT EXISTS `forget_pwd` (
  `id` smallint(6) NOT NULL auto_increment,
  `user` varchar(64) character set utf8 NOT NULL,
  `code` char(32) NOT NULL,
  `start_ts` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- 表的结构 `onlineuser`
--

CREATE TABLE IF NOT EXISTS `onlineuser` (
  `ticket` char(32) character set utf8 NOT NULL,
  `user` varchar(64) character set utf8 NOT NULL,
  `expiry` int(11) NOT NULL,
  `data` text character set utf8 NOT NULL,
  UNIQUE KEY `session_id` (`ticket`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `user_00`
--

CREATE TABLE IF NOT EXISTS `user_00` (
  `user_id` int(11) NOT NULL,
  `user` varchar(64) NOT NULL,
  `user_password` char(32) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `user_nickname` varchar(12) NOT NULL,
  `user_realname` varchar(9) NOT NULL,
  `user_sex` tinyint(1) NOT NULL,
  `user_state` tinyint(1) NOT NULL,
  `user_reg_time` int(11) NOT NULL,
  `user_reg_ip` varchar(16) NOT NULL,
  `user_lastlogin_time` int(11) NOT NULL,
  `user_lastlogin_ip` varchar(16) NOT NULL,
  `user_question` varchar(128) NOT NULL,
  `user_answer` varchar(30) NOT NULL,
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user_blockword`
--

CREATE TABLE IF NOT EXISTS `user_blockword` (
  `word` text character set utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `user_index`
--

CREATE TABLE IF NOT EXISTS `user_index` (
  `user_id` int(11) NOT NULL auto_increment,
  `user` varchar(64) NOT NULL,
  PRIMARY KEY  (`user_id`),
  KEY `user` (`user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;
