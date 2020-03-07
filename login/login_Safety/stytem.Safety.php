<?php 
session_start();
chdir(dirname(__FILE__));
if($_SESSION['user']==""){?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>安全校验</title>
    <style>
    *{margin: 0;padding: 0;}
    #img , img{
        width: 300px;  
        margin: 50px auto 0px auto;
    }
    #info{
        width: 224px;
        margin: 0 auto;
    }
    </style>
</head>
<body>
    <div>
        <div id="img"><img src="http://res.xfstu.top/img/error/error.jpg"></div>
        <div id="info">
            <h2>您还没登录，请<a href="../login/index.html">登录</a></h2>
        </div>
    </div>
</body>
</html>


<?php
   exit; 
}
    
?>