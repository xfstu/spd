<?php
session_start();
include_once "../../login/login_Safety/stytem.Safety.php";
//include_once '../../config/isajax.php';
?>
<style>
#add_passwd{
    width: 350px;
    font-size: 18px;
    margin: 100px auto;
}
input{
    font-size: 18px;
    padding: 8px;
    border-radius: 5px;
    width: 350px;
}
button{
    font-size: 18px;
    padding: 5px;
    background-color: rgb(3, 158, 3);
    width: 100px;
    color: #fff;
    border-radius: 5px;
    margin: 0 auto;
    display: block;
}
</style>
<div id="add_passwd">
    <p><input type="text" id="user" placeholder="用户名"></p>
    <p><input type="text" id="passwd" placeholder="密码"></p>
    <p><input id="pdnumber" type="text" placeholder="位数"><input type="button" value="生成" id="qpd"></p>
    <p><input type="text" id=urlapp placeholder="站点或应用"></p>
    <p><input type="text" id="info" placeholder="备注"></p>
    <input type="password" id="key" placeholder="密钥"><button onclick="send_add()">添加</button>
</div>