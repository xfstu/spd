<?php
session_start();
$user=$_SESSION['login-user'];
include_once "../../config/conmysql.php";
include_once "../../login/login_Safety/stytem.Safety.php";
$sql="SELECT * FROM xinfo where user='{$user}';";
$sql_query= mysqli_query($db,$sql);
$dataRows=mysqli_fetch_all($sql_query,MYSQLI_ASSOC);
foreach($dataRows as $row){
	$info= $row['xInfo'];
}
//var_dump($dataRows) ;exit;
if($info=="x"){
    $putinfo=['code'=>'1'];
    echo json_encode($putinfo);
    //exit;
}else{
    echo json_encode(['code'=>'0']);
}
$x=$_POST['xinfo'];
if($x=="y"){
    $sql="UPDATE `xinfo` SET `Xinfo`='y' WHERE user='{$user}';";
    //var_dump($sql);
    mysqli_query($db,$sql);
    exit;
}
?>
