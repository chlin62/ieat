-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2014 年 06 月 17 日 10:11
-- 伺服器版本: 5.6.17
-- PHP 版本: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `mydb`
--
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mydb`;

-- --------------------------------------------------------

--
-- 表的結構 `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `INV_ID` int(11) NOT NULL AUTO_INCREMENT,
  `MBR_NUM` int(11) NOT NULL,
  `INV_DATE` date NOT NULL,
  PRIMARY KEY (`INV_ID`),
  KEY `MBR_NUM_idx` (`MBR_NUM`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 轉存資料表中的資料 `invoice`
--

INSERT INTO `invoice` (`INV_ID`, `MBR_NUM`, `INV_DATE`) VALUES
(10, 1, '2014-05-22'),
(12, 1, '2014-05-24'),
(13, 1, '2014-05-25'),
(14, 1, '2014-05-26'),
(17, 1, '2014-05-29'),
(18, 10, '2014-05-29'),
(19, 11, '2014-06-05');

-- --------------------------------------------------------

--
-- 表的結構 `line`
--

CREATE TABLE IF NOT EXISTS `line` (
  `LINE_NUM` int(11) NOT NULL AUTO_INCREMENT,
  `INV_ID` int(11) NOT NULL,
  `P_ID` int(11) NOT NULL,
  `P_PRICE` int(11) NOT NULL,
  `LINE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`LINE_NUM`),
  KEY `INV_ID_idx` (`INV_ID`),
  KEY `P_ID_idx` (`P_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- 轉存資料表中的資料 `line`
--

INSERT INTO `line` (`LINE_NUM`, `INV_ID`, `P_ID`, `P_PRICE`, `LINE_DATE`) VALUES
(7, 10, 1, 60, '2014-05-22 17:30:53'),
(8, 10, 1, 60, '2014-05-22 17:30:53'),
(13, 10, 4, 60, '2014-05-22 18:00:58'),
(14, 10, 5, 100, '2014-05-22 18:29:32'),
(15, 10, 5, 100, '2014-05-22 21:18:18'),
(21, 13, 5, 100, '2014-05-25 23:50:19'),
(22, 14, 1, 60, '2014-05-26 00:24:48'),
(26, 18, 1, 60, '2014-05-29 16:25:26'),
(27, 17, 1, 60, '2014-05-29 16:37:51'),
(28, 19, 1, 60, '2014-06-05 17:58:16'),
(29, 19, 5, 100, '2014-06-05 17:58:19'),
(30, 19, 4, 60, '2014-06-05 17:58:27');

-- --------------------------------------------------------

--
-- 表的結構 `menber`
--

CREATE TABLE IF NOT EXISTS `menber` (
  `MBR_NUM` int(11) NOT NULL AUTO_INCREMENT,
  `MBR_ID` varchar(15) NOT NULL,
  `MBR_PWD` varchar(15) NOT NULL,
  `MBR_NAME` varchar(11) NOT NULL,
  `MBR_LV` varchar(20) NOT NULL,
  `MBR_EMAIL` varchar(45) NOT NULL,
  PRIMARY KEY (`MBR_NUM`),
  UNIQUE KEY `MBR_NUM` (`MBR_NUM`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 轉存資料表中的資料 `menber`
--

INSERT INTO `menber` (`MBR_NUM`, `MBR_ID`, `MBR_PWD`, `MBR_NAME`, `MBR_LV`, `MBR_EMAIL`) VALUES
(1, 'test1', 'test1', 'test', 'SuperUser', 'b@b.b.b'),
(7, 'wssu', 'wssu777', '蘇偉順', 'SuperUser', 'wssu@pu.edu.tw'),
(10, 'test2', 'test2', 'tes', 'NormalUser', 'a@1a.1.1'),
(11, 'a123', '123', '林成和', 'SuperUser', '1@1.1.1');

-- --------------------------------------------------------

--
-- 表的結構 `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `P_ID` int(11) NOT NULL AUTO_INCREMENT,
  `P_NAME` varchar(20) NOT NULL,
  `P_PRICE` int(11) NOT NULL,
  `V_ID` int(11) NOT NULL,
  PRIMARY KEY (`P_ID`),
  KEY `V_ID_idx` (`V_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 轉存資料表中的資料 `product`
--

INSERT INTO `product` (`P_ID`, `P_NAME`, `P_PRICE`, `V_ID`) VALUES
(1, '滷肉飯', 60, 24),
(4, '秉豫紅', 60, 25),
(5, '秉豫便當', 100, 24);

-- --------------------------------------------------------

--
-- 表的結構 `today_menu`
--

CREATE TABLE IF NOT EXISTS `today_menu` (
  `TM_ID` int(11) NOT NULL AUTO_INCREMENT,
  `V_ID` int(11) NOT NULL,
  `TM_DATE` date NOT NULL,
  `TM_STATE` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`TM_ID`),
  KEY `V_ID` (`V_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- 轉存資料表中的資料 `today_menu`
--

INSERT INTO `today_menu` (`TM_ID`, `V_ID`, `TM_DATE`, `TM_STATE`) VALUES
(17, 24, '2014-05-21', 0),
(18, 24, '2014-05-22', 1),
(19, 25, '2014-05-22', 1),
(20, 24, '2014-05-24', 0),
(21, 24, '2014-05-25', 1),
(22, 24, '2014-05-26', 0),
(25, 24, '2014-05-29', 0),
(27, 24, '2014-06-05', 1),
(28, 25, '2014-06-05', 1);

-- --------------------------------------------------------

--
-- 表的結構 `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `V_ID` int(11) NOT NULL AUTO_INCREMENT,
  `V_NAME` varchar(20) NOT NULL,
  `VT_ID` int(11) NOT NULL,
  `V_NOTE` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`V_ID`),
  UNIQUE KEY `廠商_id_UNIQUE` (`V_ID`),
  KEY `VT_ID_idx` (`VT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- 轉存資料表中的資料 `vendor`
--

INSERT INTO `vendor` (`V_ID`, `V_NAME`, `VT_ID`, `V_NOTE`) VALUES
(24, '歡歡滷肉飯', 7, '滿400外送'),
(25, '五十嵐', 1, '店取買五送一');

-- --------------------------------------------------------

--
-- 表的結構 `vendor_phone`
--

CREATE TABLE IF NOT EXISTS `vendor_phone` (
  `VP_NUM` int(11) NOT NULL AUTO_INCREMENT,
  `VP_TEL` varchar(10) NOT NULL,
  `V_ID` int(11) NOT NULL,
  PRIMARY KEY (`VP_NUM`),
  KEY `V_ID_idx` (`V_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 轉存資料表中的資料 `vendor_phone`
--

INSERT INTO `vendor_phone` (`VP_NUM`, `VP_TEL`, `V_ID`) VALUES
(8, '0426335009', 24),
(9, '0426523432', 25);

-- --------------------------------------------------------

--
-- 表的結構 `vendor_type`
--

CREATE TABLE IF NOT EXISTS `vendor_type` (
  `VT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `V_TYPE` varchar(45) NOT NULL,
  PRIMARY KEY (`VT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 轉存資料表中的資料 `vendor_type`
--

INSERT INTO `vendor_type` (`VT_ID`, `V_TYPE`) VALUES
(1, '飲料類'),
(3, '炸物/速食類'),
(7, '主食類'),
(8, '冰品類');

--
-- 匯出資料表的 Constraints
--

--
-- 資料表的 Constraints `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`MBR_NUM`) REFERENCES `menber` (`MBR_NUM`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `line`
--
ALTER TABLE `line`
  ADD CONSTRAINT `line_ibfk_1` FOREIGN KEY (`P_ID`) REFERENCES `product` (`P_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `line_ibfk_2` FOREIGN KEY (`INV_ID`) REFERENCES `invoice` (`INV_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`V_ID`) REFERENCES `vendor` (`V_ID`),
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`V_id`) REFERENCES `vendor` (`V_ID`);

--
-- 資料表的 Constraints `today_menu`
--
ALTER TABLE `today_menu`
  ADD CONSTRAINT `today_menu_ibfk_1` FOREIGN KEY (`V_ID`) REFERENCES `vendor` (`V_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的 Constraints `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `vendor_ibfk_1` FOREIGN KEY (`VT_ID`) REFERENCES `vendor_type` (`VT_ID`);

--
-- 資料表的 Constraints `vendor_phone`
--
ALTER TABLE `vendor_phone`
  ADD CONSTRAINT `vendor_phone_ibfk_1` FOREIGN KEY (`V_ID`) REFERENCES `vendor` (`V_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
