<?php
session_start();
include_once "../../login/login_Safety/stytem.Safety.php";
include_once "../../config/conmysql.php";
function all_q($tbname,$dbname){
    $sql=$sql = "SELECT * FROM  $tbname ORDER BY id ASC";
    $result = mysqli_query($dbname, $sql);
    $sql_j = mysqli_fetch_all($result,MYSQLI_ASSOC);
    return $sql_j;
}

?>

<p>
<input type="password" id="key_input" style="width: 40%;height:37px">
<button style="display: inline" onclick="addKey()">输入密钥</button>
<button style="display: inline" onclick="add_passwd()">添加密码</button>
</p>
<table class="table table-bordered" style="text-align: center" style="table-layout: fixed;display:block">
    <tbody>
        <tr>
            <th>用户名</th>
            <th>密码</th>
            <th>站点应用</th>
            <th>备注</th>
            <th>操作</th>
        </tr>
        <?php $data=all_q("save_info",$db); foreach ($data as $key) {
        ?>
        <?php if($key['login_user']==$_SESSION['user']){ ?>
            <tr>
                <td><p class="passwd"><?php echo htmlentities($key['user']) ; ?></p></td>
                <td><p class="passwd"><?php echo htmlentities($key['passwd']); ?></p></td>
                <td><p class="passwd"><?php echo htmlentities($key['urlapp']); ?></p></td>
                <td><p class="passwd"><?php echo htmlentities($key['info']) ; ?></p></td>
                <td>
                    <a href="javascript:updata(<?php echo $key['id']?>)">改</a>
                    <!-- <span>|</span> -->
                    <a href="javascript:del(<?php echo $key['id']?>)">删</a>
                    <!-- <span>|</span> -->
                    <a href="javascript:lookAuth(<?php echo $key['id']?>)">查</a>
                </td>    
            </tr>
        <?php }} ?>
    </tbody>
</table>
<?php $db->close(); ?>