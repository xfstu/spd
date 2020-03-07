<?php
session_start();
include_once '../../login/login_Safety/stytem.Safety.php';
include_once "../../config/key.php";
include_once "../../config/conmysql.php";
include_once '../../config/cookie.php';
$sessionuser=$_SESSION['user'];
$data=mysqli_fetch_all(mysqli_query($db,"SELECT `type` FROM `wsettings` WHERE name='sendemail' AND userName='{$sessionuser}';"),MYSQLI_ASSOC)[0]['type'];
$userauth=$_SESSION['user'].'cookie';
//var_dump($data);exit;
$auth2=mysqli_fetch_all(mysqli_query($db,"SELECT `code` FROM `authcode` WHERE userName='{$sessionuser}'  AND source='emauth';"),MYSQLI_ASSOC)[0]['code'];
$auth2_date=mysqli_fetch_all(mysqli_query($db,"SELECT `Time` FROM `authcode` WHERE userName='{$sessionuser}'  AND source='emauth';"),MYSQLI_ASSOC)[0]['Time'];

if($data=="true"){
    //echo "第一个条件满足";
    if($_GET['auth']!=$auth2 or time()-strtotime($auth2_date)>=300){
        echo "0";
        exit;
    }

}
$id=$_GET['id'];
$key=$_GET['key'];
$sql = "SELECT * FROM save_info where id=?";
$query=$db->prepare($sql);
$query->bind_param("i",$id);
$query->bind_result($id,$user,$passwd,$urlapp,$info,$login_user);
$query->execute();
$query->fetch();
?>
<style>
#updata_passwd{
    width: 350px;
    font-size: 18px;
    margin: 120px auto;
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
<div id="updata_passwd">
    <p id="id" style="display: none;"><?php echo $id; ?></p>
    <p><input type="text" value="<?php echo htmlentities(decrypt($user,$key)) ;?>" id="user"></p>
    <p><input type="text" value="<?php echo htmlentities(decrypt($passwd,$key));?>" id="passwd"></p>
    <p><input type="text" value="<?php echo htmlentities($urlapp);?>" id=urlapp></p>
    <p><input type="text" value="<?php echo htmlentities($info);?>"  id="info"></p>
    <p><input type="text" id="key" placeholder="密钥"></p>
    <button onclick="send_updata()">修改</button>
</div>
<?php $db->close(); ?>