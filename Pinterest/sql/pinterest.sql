-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 08 月 28 日 15:42
-- Server version: 5.5.8
-- PHP version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- database: `pinterest`
--

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `gender` varchar(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `first_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `about` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `head_pic` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `name_index` (`user_name`),
  KEY `email_index` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;
--
-- table `board`
--

CREATE TABLE IF NOT EXISTS `board` (
  `board_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL,
  `board_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `board_cat` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`board_id`),
  KEY `user_board_index` (`user_id`),
  KEY `board_index` (`board_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;



--
-- table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(8) NOT NULL AUTO_INCREMENT,
  `pin_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `content` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `comment_time` datetime NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `pin_comment_index` (`pin_id`),
  KEY `user_comment_index` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;



--
-- table `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
  `follow_id` int(8) NOT NULL AUTO_INCREMENT,
  `following_user_id` int(8) NOT NULL,
  `followed_user_id` int(8) NOT NULL,
  `follow_time` datetime NOT NULL,
  PRIMARY KEY (`follow_id`),
  KEY `followed_index` (`followed_user_id`),
  KEY `following_index` (`following_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;



--
-- table `like_pin`
--

CREATE TABLE IF NOT EXISTS `like_pin` (
  `like_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL,
  `pin_id` int(8) NOT NULL,
  `like_time` datetime NOT NULL,
  PRIMARY KEY (`like_id`),
  KEY `like_user_index` (`user_id`),
  KEY `like_pin_index` (`pin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;



--
-- table `pin`
--

CREATE TABLE IF NOT EXISTS `pin` (
  `pin_id` int(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL,
  `image_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `board_id` int(8) DEFAULT NULL,
  `pin_time` datetime NOT NULL,
  `description` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`pin_id`),
  KEY `pin_delete_key` (`board_id`),
  KEY `use_board_index` (`user_id`,`board_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;



--
-- table `user`
--



--
-- 限制表 `board`
--
ALTER TABLE `board`
  ADD CONSTRAINT `board_key` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- 限制表 `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `pin_comment_key` FOREIGN KEY (`pin_id`) REFERENCES `pin` (`pin_id`) ON DELETE CASCADE;

--
-- 限制表 `like_pin`
--
ALTER TABLE `like_pin`
  ADD CONSTRAINT `like_key` FOREIGN KEY (`pin_id`) REFERENCES `pin` (`pin_id`) ON DELETE CASCADE;

--
-- 限制表 `pin`
--
ALTER TABLE `pin`
  ADD CONSTRAINT `pin_delete_key` FOREIGN KEY (`board_id`) REFERENCES `board` (`board_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `board_pin_key` FOREIGN KEY (`board_id`) REFERENCES `board` (`board_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pin_key` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
