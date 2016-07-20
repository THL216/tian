/*
Navicat MySQL Data Transfer

Source Server         : win
Source Server Version : 50547
Source Host           : 127.0.0.1:3306
Source Database       : wei9a

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-07-20 13:24:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wei_publicnum
-- ----------------------------
DROP TABLE IF EXISTS `wei_publicnum`;
CREATE TABLE `wei_publicnum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appname` varchar(255) DEFAULT NULL,
  `appid` char(55) DEFAULT NULL,
  `appsecret` varchar(255) DEFAULT NULL,
  `appdesc` varchar(255) DEFAULT NULL,
  `appcheck` varchar(255) DEFAULT NULL,
  `appurl` varchar(255) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `apptoken` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wei_reply
-- ----------------------------
DROP TABLE IF EXISTS `wei_reply`;
CREATE TABLE `wei_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` int(11) DEFAULT NULL,
  `rename` varchar(50) DEFAULT NULL,
  `rekeyword` varchar(50) DEFAULT NULL,
  `redesc` varchar(255) DEFAULT NULL,
  `retype` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wei_session
-- ----------------------------
DROP TABLE IF EXISTS `wei_session`;
CREATE TABLE `wei_session` (
  `id` char(40) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wei_user
-- ----------------------------
DROP TABLE IF EXISTS `wei_user`;
CREATE TABLE `wei_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `upwd` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
