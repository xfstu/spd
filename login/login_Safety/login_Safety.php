<?php
session_start();
include_once "../../config/conmysql.php";
/**
 * 接收数据
 */
$username=$_POST['username'];
$userpasswd=$_POST['userpasswd'];
if($username=="" or $userpasswd==""){header('HTTP/1.1 403 Forbidden');include_once "./stytem.Safety.php";exit;}
$ip = $_SERVER["REMOTE_ADDR"];
if($_SESSION['authcode']!=$_POST['auth']){
    $false=array('code'=>0,'info'=>"验证码错误！");
    echo json_encode($false);
    exit;
}elseif($_POST['auth']==""){
    $false=array('code'=>0,'info'=>"请输入验证码！");
    echo json_encode($false);
    exit;
}
/**
 * 对比数据
 * 如果用户名和密码对比通过则返回1，否则返回0
 * 如果用户输入的用户名和数据库的一致，则存储该用户的名字，用来区分登录次数，否则不做记录
 */
$sql = "SELECT * FROM  user_info ORDER BY id ASC";
$result = mysqli_query($db, $sql);
$user_info = mysqli_fetch_all($result,MYSQLI_ASSOC);
if(count($user_info)=='0'){
    echo json_encode(['code'=>0,'info'=>"请注册账号"]);
    exit;
}
foreach($user_info as $data){
    if($data['userName']===$username and $data['userPasswd']===$userpasswd){
        $login_info=1;
    }else{
        $login_info=0;
    }
    if($data['userName']==$username){
        $user_t=true;
        $user=$data['userName'];
    break;
    }else {
        $user_t=false;
    }
}
//------------------------------用户对比功能结束-------------------------------------
if($user_t){
    //根据登录的用户名查询登录的时间差
    $logintime=time();
    $sql="select * from loginfre WHERE loginUser='{$username}' order by id DESC limit 1";
    $result = mysqli_query($db, $sql);
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
   // $dbtime=strtotime($data[0]['loginTime']);
    $tf=$logintime-strtotime($data[0]['loginTime']);

    //根据登录的用户名查登录的次数
    $sql_num="select * from loginfre WHERE loginUser='{$username}' order by id DESC";
    $result_num = mysqli_query($db, $sql_num);
    $total_num = mysqli_num_rows($result_num)+1;
    //var_dump($tf,$total_num);
}
if($tf>=3600 and $user==$username and $total_num>3){
    $qing="DELETE FROM `loginfre` WHERE loginUser='{$username}'";
    mysqli_query($db,$qing);
    echo json_encode(['code'=>0,'info'=>'登录限制已解除，请重试']);
}
//------------------------------查询登录记录功能结束-------------------------------------

if($login_info===0 and $total_num<=3){
    //如果登录失败则写入记录，而且登录次数不能大于3次，包括3次
    $intime=date('Y-m-d H:i:s',time());
    $sql = "INSERT INTO login_info (userName,userPasswd,loginTime,loginType,loginIPv4) VALUES (?,?,?,?,?)";
    $query=$db->prepare($sql);
    $type='失败';
    $is= $query->bind_param("sssss",$username,$userpasswd,$intime,$type,$ip);
    $query->execute();
    mysqli_query($db,"INSERT INTO `loginfre` (`loginUser`, `loginTime`) VALUES ('{$username}', '{$intime}')");
    $false=array('code'=>0,'info'=>"用户名或密码错误！");
    echo json_encode($false);
    exit;
}
if($login_info==1 and $total_num<=3){
    //用户名和密码对比通过，而且登录次数不能大于3次，包括3次，即第3次对比通过还是可以登录的。
    $_SESSION['user']=$username;
    //include_once "../../config/cookie.php";
    /* if(cookie_read($user_email)==""){
        echo json_encode(['code'=>2,'info'=>'新设备登录需要验证邮箱']);
        exit;
    } */
    //var_dump(cookie_read($user_email)=="");exit;
    $intime=date('Y-m-d H:i:s',time());
    $sql = "INSERT INTO login_info (userName,userPasswd,loginTime,loginType,loginIPv4) VALUES (?,?,?,?,?)";
    $query=$db->prepare($sql);
    $type='成功';
    $is= $query->bind_param("sssss",$username,$userpasswd,$intime,$type,$ip);
    $info=$query->execute();
    echo json_encode(['code'=>1,'info'=>"登录成功，正在跳转"]) ;
    $qing="DELETE FROM `timeing` WHERE user='{$username}'";
    mysqli_query($db,$qing);
    $db->close();
}
if($tf<=3600 and $total_num>3 and $user==$username){
    //这次登录时间和上次登录时间间隔小于3600秒，则证明在5小时之内
    //登录次数为4或者更多，则证明3次登录机会已用完
    //登录者要是该输入者，否则一人错误将使全部人不允许登录
    $false=array('code'=>0,'info'=>"登录次数达到上限，5小时候重试");
    echo json_encode($false);
    exit;
}

//------------------------------登录验证功能结束-------------------------------------




?>