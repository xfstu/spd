<?php 
session_start();
 if ($_GET['action'] == "unlogin") {
     unset($_SESSION['login-user']);
     $logoun_info= '退出登录成功！点击此处 <a href="../login/index.html">登录</a>';
 }else{
     $logoun_info= '注销失败';
 } 
?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>注销登录</title>
    <style>
        *{
            margin: 0;
        }
        .content{
            width: 350px;
            height: 350px;
            margin: 0 auto;
            margin-top: 40px;
            background-color: rgb(255, 255, 255);
        }
        .img img{
                width: 350px;            
        }
        .logoun_info{
            width:350px;
            height: 60px;
            line-height: 60px;
            color: rgb(235, 76, 28);
            font-size: 22px;
            text-align: center;
            background-color: rgba(255, 255, 255);
        }
        hr{
            color: #ccc;
        }
    
    </style>
</head>
<body>
    <div class="content">
        <div class="img">
            <img src="./正确.jpg" alt="">
        </div>
        <div class="logoun_info">
        <?php 
             echo $logoun_info; 
            ?>
        </div>
    </div>

</body>
</html>
