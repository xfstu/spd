-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2020-03-07 23:25:27
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `authcode`
--

CREATE TABLE `authcode` (
  `id` int(4) NOT NULL,
  `source` varchar(10) DEFAULT NULL,
  `userName` varchar(15) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL,
  `code` varchar(5) NOT NULL,
  `Time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `loginfre`
--

CREATE TABLE `loginfre` (
  `id` int(3) NOT NULL,
  `loginUser` varchar(10) NOT NULL,
  `loginTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `login_info`
--

CREATE TABLE `login_info` (
  `id` int(7) NOT NULL,
  `userName` varchar(10) NOT NULL,
  `userPasswd` varchar(15) NOT NULL,
  `loginTime` datetime NOT NULL,
  `loginType` varchar(5) NOT NULL,
  `loginIPv4` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='登录信息表：用户名，密码，登录时间，登录类型，登录地址';

-- --------------------------------------------------------

--
-- 表的结构 `save_info`
--

CREATE TABLE `save_info` (
  `id` int(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `urlapp` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `login_user` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user_info`
--

CREATE TABLE `user_info` (
  `id` int(7) NOT NULL,
  `userName` varchar(10) NOT NULL,
  `userPasswd` varchar(15) NOT NULL,
  `email` varchar(20) DEFAULT NULL,
  `regTime` datetime DEFAULT NULL,
  `regIPv4` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wsettings`
--

CREATE TABLE `wsettings` (
  `id` int(5) NOT NULL,
  `name` varchar(10) NOT NULL,
  `userName` varchar(15) NOT NULL,
  `type` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `xinfo`
--

CREATE TABLE `xinfo` (
  `id` int(1) NOT NULL,
  `xInfo` varchar(1) NOT NULL,
  `user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转储表的索引
--

--
-- 表的索引 `authcode`
--
ALTER TABLE `authcode`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `loginfre`
--
ALTER TABLE `loginfre`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `login_info`
--
ALTER TABLE `login_info`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `save_info`
--
ALTER TABLE `save_info`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `wsettings`
--
ALTER TABLE `wsettings`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `xinfo`
--
ALTER TABLE `xinfo`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `authcode`
--
ALTER TABLE `authcode`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `loginfre`
--
ALTER TABLE `loginfre`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `login_info`
--
ALTER TABLE `login_info`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `save_info`
--
ALTER TABLE `save_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `wsettings`
--
ALTER TABLE `wsettings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `xinfo`
--
ALTER TABLE `xinfo`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
