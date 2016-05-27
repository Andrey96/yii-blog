-- --------------------------------------------------------
-- Хост:                         192.168.1.1
-- Версия сервера:               5.6.15-log - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных blog
CREATE DATABASE IF NOT EXISTS `blog` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `blog`;


-- Дамп структуры для таблица blog.tbl_auth
CREATE TABLE IF NOT EXISTS `tbl_auth` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) unsigned NOT NULL,
  `lastTry` int(10) unsigned NOT NULL DEFAULT '0',
  `fails` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__tbl_user` (`userID`),
  CONSTRAINT `FK__tbl_user` FOREIGN KEY (`userID`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Used to restrict access to user account if he enters wrong password several times';

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица blog.tbl_post
CREATE TABLE IF NOT EXISTS `tbl_post` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `authorID` int(11) unsigned NOT NULL,
  `created` int(11) unsigned NOT NULL,
  `edited` int(11) unsigned DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `preview` varchar(512) DEFAULT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_post_tbl_user` (`authorID`),
  CONSTRAINT `FK_tbl_post_tbl_user` FOREIGN KEY (`authorID`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Used to store blog posts';

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица blog.tbl_user
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `passhash` varchar(60) NOT NULL,
  `email` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Used to store users';

-- Экспортируемые данные не выделены.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
