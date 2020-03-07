<?php
session_start();
include_once '../../config/conmysql.php';
include_once '../../login/login_Safety/stytem.Safety.php';
include_once '../../config/isajax.php';
if (isajax()) {
    h403();
}
$user=(string)$_SESSION['user'];
$sessionuser=$_SESSION['user'];
if ($_SESSION['user'] != "" and $_POST['type'] == "false") {
    $dbauthcode=mysqli_fetch_all(mysqli_query($db,"SELECT `code` FROM `authcode` WHERE userName='{$sessionuser}'  AND source='emauth';"),MYSQLI_ASSOC)[0]['code'];
    $auth2_date=mysqli_fetch_all(mysqli_query($db,"SELECT `Time` FROM `authcode` WHERE userName='{$sessionuser}'  AND source='emauth';"),MYSQLI_ASSOC)[0]['Time'];
    if($_POST['authcode']==$dbauthcode and time()-strtotime($auth2_date)<=300){
        $info = mysqli_query($db, "UPDATE `WSettings` SET `type`='false' WHERE userName='$user' AND name='sendemail';");
    }
    else{
        hjson();
        echo json_encode(['code'=>0,'info'=>'验证码错误或已过期','time'=>time()-strtotime($auth2_date),"dbcode"=>$dbauthcode]);
    }
    if ($info) {
        hjson();
        echo json_encode(['code' => 1]);
    }
    exit;
} elseif ($_SESSION['user'] != "" and $_POST['type'] == "true") {
    $info = mysqli_query($db, "UPDATE `WSettings` SET `type`='true' WHERE userName='$user' AND name='sendemail';");
    if ($info) {
        hjson();
        echo json_encode(['code' =>1]);
    }
    exit;
}
if($user!="" and $_GET['q']=='emau'){
    $data=mysqli_fetch_all(mysqli_query($db,"SELECT `type` FROM `WSettings` WHERE name='sendemail' AND userName='{$user}';"),MYSQLI_ASSOC)[0]['type'];
    hjson();
    echo json_encode(['info'=>$data]);
}
?>
