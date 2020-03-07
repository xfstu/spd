<?php 
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "temp";
$charset="utf8";
// 创建连接
$db = @new mysqli($servername, $username, $password,$dbname);
@mysqli_set_charset($db,$charset);
if ($db -> connect_errno !=0) {
    echo "服务器内部通信失败！";
    exit;
}else{
    $dbinfo=true;
    //echo "通信建立！";
}
?>