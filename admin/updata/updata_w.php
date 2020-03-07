<?php 
session_start();
include_once "../../login/login_Safety/stytem.Safety.php";
include_once "../../config/conmysql.php";
include_once "../../config/key.php";
$id=$_GET['id'];
$key=$_POST['key'];
$user=encrypt($_POST['user'],$key);
$passwd=encrypt($_POST['passwd'],$key);
$urlapp=$_POST['urlapp'];
$info=$_POST['info'];
$login_user=$_SESSION['user'];
$sql = "UPDATE save_info SET user=?,passwd=?,urlapp=?,info=? WHERE id=? AND login_user=?;";
$query=$db->prepare($sql);
$is= $query->bind_param("ssssis",$user,$passwd,$urlapp,$info,$id,$login_user);
$info=$query->execute();
$db->close();

?>