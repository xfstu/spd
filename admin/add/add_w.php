<?php
session_start();
include_once "../../login/login_Safety/stytem.Safety.php";
include_once "../../config/conmysql.php";
include_once "../../config/key.php";
$user=encrypt($_POST['user'],$_POST['key']) ;
$passwd=encrypt($_POST['passwd'],$_POST['key']) ;
$urlapp=$_POST['urlapp'];
$info=$_POST['info'];
$login_user=$_SESSION['user'];;
$sql = "INSERT INTO save_info (user,passwd,urlapp,info,login_user) VALUES (?,?,?,?,?)";
$query=$db->prepare($sql);
$is= $query->bind_param("sssss",$user,$passwd,$urlapp,$info,$login_user);
$info=$query->execute();
var_dump($info);
$db->close();

?>