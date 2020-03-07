<?php 
session_start();
include_once "conmysql.php";
//------------------------------连接数据库功能结束-------------------------------------

$userInfo="CREATE TABLE `{$dbname}`.`user_info` ( `id` INT(7) NOT NULL AUTO_INCREMENT , `userName` VARCHAR(10) NOT NULL , `userPasswd` VARCHAR(15) NOT NULL , `email` VARCHAR(20) NULL , `regTime` DATETIME NULL , `regIPv4` VARCHAR(20) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$loginInfo="CREATE TABLE `{$dbname}`.`login_info` ( `id` INT(7) NOT NULL AUTO_INCREMENT , `userName` VARCHAR(10) NOT NULL , `userPasswd` VARCHAR(15) NOT NULL , `loginTime` DATETIME NOT NULL , `loginType` VARCHAR(5) NOT NULL , `loginIPv4` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB COMMENT = '登录信息表：用户名，密码，登录时间，登录类型，登录地址';";
$loginTime="CREATE TABLE `{$dbname}`.`loginfre` ( `id` INT(3) NOT NULL AUTO_INCREMENT , `loginUser` VARCHAR(10) NOT NULL , `loginTime` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$authcode="CREATE TABLE `{$dbname}`.`authcode` ( `id` INT(4) NOT NULL AUTO_INCREMENT , `type` VARCHAR(5) NOT NULL , `code` VARCHAR(5) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
mysqli_query($db,$userInfo);
mysqli_query($db,$loginInfo);
mysqli_query($db,$loginTime);
mysqli_query($db,$authcode);
//------------------------------创建通用表结束功能结束-------------------------------------

