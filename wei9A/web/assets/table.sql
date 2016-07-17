SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wei_user`;
CREATE TABLE `wei_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `upwd` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `wei_publicnum`;
CREATE TABLE `wei_publicnum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appname` varchar(255) DEFAULT NULL,
  `appid` char(55) DEFAULT NULL,
  `appsecret` varchar(255) DEFAULT NULL,
  `appdesc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE `wei_session`
(
    id CHAR(40) NOT NULL PRIMARY KEY,
    expire INTEGER,
    data BLOB
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
