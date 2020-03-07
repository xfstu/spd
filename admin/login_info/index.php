<?php
session_start();

include_once '../../config/conmysql.php';
include_once "../../login/login_Safety/stytem.Safety.php";
$login_info_sql = "SELECT * FROM `login_info` WHERE userName='{$_SESSION['user']}' ";
$login_info_data = mysqli_query($db, $login_info_sql);
$login_info_rows = mysqli_fetch_all($login_info_data, MYSQLI_ASSOC);
?>
<table class="table table-bordered">
    <tbody>
        <tr>
            <th>登录IP</th>
            <th>登录时间</th>
            <th>登录密码</th>
            <th>登录状态</th>
        </tr>
        <?
        foreach ($login_info_rows as $row) {
        ?>
            
            <tr>
                <td><a href="http://www.ip138.com/iplookup.asp?ip=<?php echo $row['loginIPv4']; ?>&action=2" target="_blank" rel="noopener noreferrer"><?php echo $row['loginIPv4']; ?></a></td>
                <td><?php echo $row['loginTime'] ?></td>
                <td><?php echo $row['userPasswd']; ?></td>
                <td><?php echo $row['loginType']; ?></td>
            </tr>
            
        <?php
        }
        ?>
    </tbody>
</table>