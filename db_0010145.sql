-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2014 �?06 ??22 ??15:52
-- 伺服器版本: 5.6.16
-- PHP 版本： 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `db_final`
--

-- --------------------------------------------------------

--
-- 資料表結構 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `aid` int(15) NOT NULL,
  `content` varchar(100) NOT NULL,
  `post_time` datetime NOT NULL,
  `uid` int(15) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `article`
--

INSERT INTO `article` (`aid`, `content`, `post_time`, `uid`) VALUES
(1, 'hello~', '2014-06-22 10:06:04', 2),
(2, 'why~~~~', '2014-06-22 10:06:12', 2),
(3, 'I love DB', '2014-06-22 10:07:25', 1),
(8, 'i am king of the world', '2014-06-22 10:08:54', 1),
(10, 'herry', '2014-06-22 10:09:29', 1),
(13, 'hey!you,look here', '2014-06-22 10:11:06', 1),
(14, 'I DONT'' LIKE THIS', '2014-06-22 15:13:16', 5),
(15, 'WHAT??!!!!!\r\nI WANT VACATION', '2014-06-22 15:13:33', 5),
(16, 'hi~everyone', '2014-06-22 15:50:56', 5),
(17, 'i am a beauty', '2014-06-22 16:11:34', 6),
(21, 'hi!basketball', '2014-06-22 16:27:01', 4),
(22, 'full of energy', '2014-06-22 16:27:15', 4),
(23, 'HEY MAN', '2014-06-22 16:28:18', 4),
(24, 'do you like DB', '2014-06-22 16:31:39', 3),
(25, 'hmm   i dont want hw', '2014-06-22 16:31:53', 3),
(26, 'oh no!', '2014-06-22 16:34:22', 2),
(27, 'asdfasdf afg sdg', '2014-06-22 20:46:10', 6),
(28, 'i am mary~beautiful girl', '2014-06-22 20:56:24', 6),
(29, 'this is jane~~~', '2014-06-22 20:57:34', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `uid` varchar(15) NOT NULL,
  `friend_uid` varchar(15) NOT NULL,
  `relation` varchar(15) NOT NULL,
  PRIMARY KEY (`uid`,`friend_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `friend`
--

INSERT INTO `friend` (`uid`, `friend_uid`, `relation`) VALUES
('1', '3', 'cousin'),
('1', '4', 'friends'),
('1', '6', 'mom'),
('2', '3', 'friends'),
('3', '1', 'cousin'),
('3', '2', 'friends'),
('3', '5', 'friends'),
('3', '6', 'friends'),
('4', '1', 'friends'),
('4', '5', 'friends'),
('4', '6', 'friends'),
('5', '3', 'friends'),
('5', '4', 'friends'),
('6', '1', 'mom'),
('6', '3', 'friends'),
('6', '4', 'friends');

-- --------------------------------------------------------

--
-- 資料表結構 `household`
--

CREATE TABLE IF NOT EXISTS `household` (
  `hid` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `size` double NOT NULL,
  `city` varchar(10) NOT NULL,
  `headid` varchar(15) NOT NULL,
  PRIMARY KEY (`hid`),
  UNIQUE KEY `address` (`address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `household`
--

INSERT INTO `household` (`hid`, `address`, `size`, `city`, `headid`) VALUES
('F1', '1001 University Rd.', 39.52, 'Hsinchu', '1'),
('F2', '222 King St.', 22.17, 'Taipei', '4'),
('F3', '3F 138-2 Mingcheng Rd.', 76.42, 'Tainan', '6');

-- --------------------------------------------------------

--
-- 資料表結構 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `uid` int(15) NOT NULL,
  `friend_uid` int(15) NOT NULL,
  `message` varchar(50) NOT NULL,
  `send_time` datetime NOT NULL,
  PRIMARY KEY (`message`,`send_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `message`
--

INSERT INTO `message` (`uid`, `friend_uid`, `message`, `send_time`) VALUES
(6, 3, 'asd u w ', '2014-06-22 20:55:38'),
(1, 6, 'ggg', '2014-06-22 20:58:36'),
(1, 6, 'hello!mom', '2014-06-22 14:16:53'),
(1, 6, 'here is john', '2014-06-22 15:11:11'),
(6, 1, 'hi~\r\n', '2014-06-22 16:15:59'),
(4, 1, 'hmmmmmm', '2014-06-22 16:28:28'),
(1, 6, 'how are u', '2014-06-22 15:11:17'),
(6, 1, 'how are y ', '2014-06-22 16:16:05'),
(2, 3, 'hows going', '2014-06-22 16:35:37'),
(6, 3, 'i love u ', '2014-06-22 20:55:58'),
(6, 1, 'oh~~~~', '2014-06-22 20:56:08'),
(4, 1, 'r u ok', '2014-06-22 16:28:34'),
(6, 3, 'sh u s ', '2014-06-22 20:55:50'),
(6, 3, 'this d afg ', '2014-06-22 20:55:32'),
(6, 3, 'this d afg ', '2014-06-22 20:55:33'),
(2, 3, 'yo man', '2014-06-22 16:35:23');

-- --------------------------------------------------------

--
-- 資料表結構 `personal_info`
--

CREATE TABLE IF NOT EXISTS `personal_info` (
  `uid` varchar(15) NOT NULL,
  `name` varchar(30) NOT NULL,
  `sex` enum('M','F') NOT NULL,
  `birthday` date NOT NULL,
  `hid` varchar(15) NOT NULL,
  `modtime` datetime NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `personal_info`
--

INSERT INTO `personal_info` (`uid`, `name`, `sex`, `birthday`, `hid`, `modtime`) VALUES
('1', 'johnson', 'M', '1991-01-01', 'F1', '2014-01-17 09:53:07'),
('2', 'KevinGarnnet', 'M', '1992-03-05', 'F1', '2014-01-17 10:20:12'),
('3', 'kkbox', 'F', '1993-05-01', 'F1', '2014-01-17 10:22:05'),
('4', 'KobeBrian', 'M', '1991-12-12', 'F2', '2014-03-17 09:14:51'),
('5', 'LeBronJames', 'M', '1995-07-02', 'F2', '2014-03-18 13:19:20'),
('6', 'Mary', 'F', '1989-11-02', 'F3', '2014-02-10 15:27:22');

-- --------------------------------------------------------

--
-- 資料表結構 `pmod_history`
--

CREATE TABLE IF NOT EXISTS `pmod_history` (
  `historyid` varchar(15) NOT NULL,
  `uid` varchar(15) NOT NULL,
  `name` varchar(30) NOT NULL,
  `sex` enum('M','F') NOT NULL,
  `birthday` date NOT NULL,
  `hid` varchar(15) NOT NULL,
  `modtime` datetime NOT NULL,
  PRIMARY KEY (`historyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `pmod_history`
--

INSERT INTO `pmod_history` (`historyid`, `uid`, `name`, `sex`, `birthday`, `hid`, `modtime`) VALUES
('1', '1', 'johnson', 'M', '1991-01-01', 'F1', '2014-01-17 09:53:07'),
('2', '2', 'KevinGarnnet', 'M', '1992-03-05', 'F1', '2014-01-17 10:20:12'),
('3', '3', 'kkbox', 'F', '1993-05-01', 'F1', '2014-01-17 10:22:05'),
('4', '6', 'Mary', 'F', '1989-11-02', 'F3', '2014-02-10 15:27:22'),
('5', '5', 'LeBronJames', 'M', '1995-07-02', 'F3', '2014-02-20 09:23:00'),
('6', '4', 'KobeBrian', 'M', '1991-12-12', 'F2', '2014-03-17 09:14:51'),
('7', '5', 'LeBronJames', 'M', '1995-07-02', 'F2', '2014-03-18 13:19:20');

-- --------------------------------------------------------

--
-- 資料表結構 `reply`
--

CREATE TABLE IF NOT EXISTS `reply` (
  `rid` int(15) NOT NULL,
  `aid` int(15) NOT NULL,
  `uid` int(15) NOT NULL,
  `text` varchar(50) NOT NULL,
  `response_time` datetime NOT NULL,
  PRIMARY KEY (`response_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `reply`
--

INSERT INTO `reply` (`rid`, `aid`, `uid`, `text`, `response_time`) VALUES
(1, 19, 6, 'fffffdd', '2014-06-22 20:41:17'),
(3, 21, 6, 'asdfasdf g sety ', '2014-06-22 20:43:16'),
(4, 27, 6, 'adfsdf asdf ', '2014-06-22 20:46:21'),
(5, 17, 6, 'aaa', '2014-06-22 20:50:25'),
(7, 17, 6, 'eee fff hhh', '2014-06-22 20:50:41'),
(10, 25, 6, 'ohhhhhhhhhhhhhhhhh', '2014-06-22 20:55:09'),
(11, 22, 6, 'heyyyyyy', '2014-06-22 20:55:22'),
(12, 2, 1, 'no why', '2014-06-22 20:57:02'),
(13, 22, 1, 'ohohohohoh', '2014-06-22 20:57:12'),
(14, 26, 1, 'kkk nnn', '2014-06-22 20:57:24'),
(16, 29, 1, 'jane is cute', '2014-06-22 20:58:27'),
(17, 8, 1, 'i am ', '2014-06-22 20:59:22');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(15) NOT NULL,
  `password` char(32) NOT NULL,
  `uid` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `isadmin` tinyint(1) NOT NULL,
  PRIMARY KEY (`username`,`uid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`username`, `password`, `uid`, `email`, `isadmin`) VALUES
('john', '527bd5b5d689e2c32ae974c6229ff785', '1', 'john@gmail.com', 1),
('kevin', '9d5e3ecdeb4cdb7acfd63075ae046672', '2', 'kevin_cool@yahoo.com', 0),
('kkbox', '870cd34387781acbb5e3c82097dead41', '3', 'kkbox@gmail.com', 0),
('kobe', '2357e8fb9945f0a2039a7093422a3dee', '4', 'kobe@yahoo.com', 0),
('LBJ', 'a3aac5097340a9aa8c27278a39971223', '5', 'LBJ23@hotmail.com', 0),
('marry', '44d7231696044319858dc2c9a498f0da', '6', 'marry@gmail.com', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
