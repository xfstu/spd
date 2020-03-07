<?php
session_start();
include_once '../../config/conmysql.php';
include_once "../../login/login_Safety/stytem.Safety.php";
include_once '../../config/cookie.php';
include_once '../../config/isajax.php';
if(isajax()){
	echo "2";
    //h403(); //网页编码
    exit;
}
$user=$_SESSION['user'];
$useremail=mysqli_fetch_all(mysqli_query($db,"SELECT `email` FROM `user_info` WHERE userName='{$user}';"),MYSQLI_ASSOC)[0]['email'];
$auth1 = rand(10000, 99999);
function emailTo($user, $code)
{
    //return json_encode(['code' => '1']);
    //引入PHPMailer的核心文件
    include_once '../../config/phpmailer/class.phpmailer.php';
    include_once '../../config/phpmailer/class.smtp.php';

    //实例化PHPMailer核心类
    $mail = new PHPMailer();

    //$mail->SMTPDebug = 1;#是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    $mail->isSMTP(); #使用smtp鉴权方式发送邮件
    $mail->SMTPAuth = true; #smtp需要鉴权 这个必须是true
    $mail->Host = 'smtp.qq.com'; #链接qq域名邮箱的服务器地址

    $mail->SMTPSecure = 'ssl'; #设置使用ssl加密方式登录鉴权
    $mail->Port = 465; #设置ssl连接smtp服务器的远程服务器端口号

    $mail->CharSet = 'UTF-8'; #设置发送的邮件的编码
    $mail->FromName = '小枫同学密码托管平台'; #设置发件人昵称 显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->Username = ''; #smtp登录的账号
    $mail->Password = ''; #smtp登录的密码 使用生成的授权码
    $mail->From = ''; #设置发件人邮箱地址 同登录账号

    //邮件正文是否为html编码 注意此处是一个方法
    $mail->isHTML(true);
    //设置收件人邮箱地址
    $mail->addAddress($user);
    //添加多个收件人 则多次调用方法即可
    //$mail->addAddress('2650509256@qq.com');
    //添加该邮件的主题
    $mail->Subject = '您正在查看验证码';
    //添加邮件正文
    $mail->Body = "您正在查看密码，5分钟内有效，您的验证码是：" . $code;
    //为该邮件添加附件
    //$mail->addAttachment('./example.pdf');
    //发送邮件 返回状态
    if ($mail->send()) {
        return json_encode(['code' => '1']);
    } else {
        return json_encode(['code' => '0']);
    }
}
$time=date('Y-m-d H:i:s',time());
$timegq=date("Y-m-d H:i:s",time()-300);
echo emailTo($useremail, $auth1);
//echo json_encode(['code'=>1,'info'=>$auth1]);
$emauthdb=mysqli_fetch_all(mysqli_query($db,"SELECT `source` FROM `authcode` WHERE userName='$user';"),MYSQLI_ASSOC)[0]['source'];
if($emauthdb=='emauth'){
    mysqli_query($db,"UPDATE `authcode` SET `code`='$auth1', `Time`='$time' WHERE userName='$user';");
}else{
    mysqli_query($db,"INSERT INTO `authcode`(`source`, `userName`, `type`, `code`,`Time`) VALUES ('emauth','$user',NULL,'$auth1','$time');"); 
}

?>