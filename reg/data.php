<?php
session_start();
include_once "../config/conmysql.php";
$userInput = htmlentities($_POST['user']);
$passwdInput = htmlentities($_POST['passwd']);
$keyInput =htmlentities( $_POST['key']);
if(empty($userInput) or empty($passwdInput)){
    $switch=false;
    $false=array('code'=>0,'info'=>"请填写完表单");
    echo json_encode($false);
    exit;
}elseif($_SESSION['authcode']!=htmlentities($_POST['auth'])){
    $false=array('code'=>0,'info'=>"验证码为空或者错误");
    echo json_encode($false);
    exit;
}else {
    $switch=true;
}

$sql = "SELECT * FROM  authcode ORDER BY id ASC";
$result = mysqli_query($db, $sql);
$key_info = mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach ($key_info as $data) {
    if($key_info['type']){
        if(empty($keyInput)){
            echo json_encode(['code'=>0,'info'=>'请填写授权码']);
        }
        if ($keyInput == $data['code']) {
            $key =true;
        } else {
            $key= false;
        }
    }else{
        $key=true;
    }
}
if(count($key_info)=='0'){
    $key=true;
}
$sql = "SELECT * FROM  user_info ORDER BY id ASC";
$result = mysqli_query($db, $sql);
$user_info = mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach ($user_info as $data) {
    if ($data['userName'] == $userInput) {
        $user= false;
        break;
    }else {
        $user=true;
    }
}
if(!$switch){};
if(count($user_info)=='0'){
    $user=true;
}

if ($key and $user) {
    $sql_info = true;
} else {
    $sql_info = false;
}

if ($sql_info) {
    $regTime  =date('Y-m-d H:i:s', time());
    $regIPv4 =$_SERVER["REMOTE_ADDR"];
    $register = "INSERT INTO user_info (userName,userPasswd,email,regTime,regIPv4) VALUES (?,?,?,?,?)";
    $register_query = $db->prepare($register);
    $register_query->bind_param("sssss", $userInput, $passwdInput, htmlentities($_POST['email']),$regTime,$regIPv4);
    $add_user = $register_query->execute();
    mysqli_query($db,"INSERT INTO `wsettings` (`id`, `name`, `userName`, `type`) VALUES (NULL, 'sendemail', '{$userInput}', 'false')");
    $db->close();
    if (!$add_user) {
        # code...
        $info=array('code'=>0,'info'=>"注册失败");
        echo json_encode($info);
        exit;
    }elseif ($add_user){
        # code...
        $info=array('code'=>1,'info'=>"注册成功！");
        echo json_encode($info);
        exit;
    }
}elseif (!$key) {
    # code...
    $info=array('code'=>0,'info'=>"注册码不正确");
    echo json_encode($info);
    exit;
}elseif (!$user) {
    # code...
    $info=array('code'=>0,'info'=>"用户名冲突");
    echo json_encode($info);
    exit;
}
