<?php 
session_start();
include_once "../../login/login_Safety/stytem.Safety.php";
include_once "../login/login_Safety/stytem.Safety.php";
include_once "../../config/conmysql.php";
$id=$_GET['id'];
$login_user=$_SESSION['user'];
if(is_numeric($id)){
    $sql = "DELETE FROM save_info WHERE id=? AND login_user=? ";
    $query=$db->prepare($sql);
    $is= $query->bind_param("is",$id,$login_user);
    $info=$query->execute();
    $db->close();
}
?>