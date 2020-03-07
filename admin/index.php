<?php
include_once "../login/login_Safety/stytem.Safety.php";
?>
<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/admin.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <script src="./js/jquery-3.4.1.js"></script>
    <script src="./js/ajax.js"></script>
    <script src="./js/system2.0.js"></script>
    <script src="./js/style.js"></script>
    <script src="./js/jquery.cookie.js"></script>
    <title>密码托管程序</title>
</head>

<body>
    <div id="content">
        <div id="head">
        </div>
        <div id="xxk">
            <p>欢迎您：<span style="font-size: 14px"><?php echo $_SESSION['user']; ?></span></p>
            <p id="myPasswd">我的密码</p>
            <p id="login_info">登录记录</p>
            <p id="key_def" style="display: none;"></p>
            <p id=se>微设置</p>
            <p id="unlogin"><a href="../unlogin/unlogin.php?action=unlogin" style="color:#fff">注销登录</a></p>
        </div>
        <div id="content_info">

        </div>
        <p><a href="http://note.youdao.com/noteshare?id=b08493906d4442fb48e6c571cab122d8"></a></p>
    </div>
    <script>
        $(document).ready(function() {
            get_ajax({
                url: "./content/myPasswd.php",
                success: function(data) {
                    document.getElementById("content_info").innerHTML = data;
                    var sUserAgent = navigator.userAgent.toLowerCase();
                    if (/ipad|iphone|midp|rv:1.2.3.4|ucweb|android|windows ce|windows mobile/.test(sUserAgent)) {
                        $("table tbody tr th,table p,table a").css("fontSize", "12px").css("width", "auto");
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var sUserAgent = navigator.userAgent.toLowerCase();
            if (/ipad|iphone|midp|rv:1.2.3.4|ucweb|android|windows ce|windows mobile/.test(sUserAgent)) {
                $("#content,#head,#xxk,#content_info").css(
                    "width", "100%"
                );
                $("#xxk").css(
                    "height", "130px"
                );
                $("#content").css(
                    "height", "100%"
                )
                $("#xxk,#content_info").css(
                    "float", "none"
                );
                $("#xxk p").css(
                    "float", "left",
                );

                get_ajax({
                    url: "./user/info.php",
                    success: function(data) {
                        let info = eval('(' + data + ')');
                        console.log(info.code)
                        if (info.code == 1) {
                            $("body").append("<div id='newbg'><div id='newinfo'><a href='http://note.youdao.com/noteshare?id=b08493906d4442fb48e6c571cab122d8' target='_blank'>使用说明书</a><span>关闭</span><span id='x'>不再提示</span></div></div>");

                            $("#newbg").addClass("newbg");
                            $("#newinfo").addClass("newinfo");
                            $("#newinfo span:eq(1)").addClass("x");
                            $("#newinfo span:eq(0)").addClass("x1");
                            $("#x").click(function() {
                                $("#newbg").remove();
                                post_ajax({
                                    url: "./user/info.php",
                                    data: "xinfo=y",
                                    success: function() {}
                                });
                            });
                            $("#newinfo span:eq(0)").click(function() {
                                $("#newbg").remove();
                            });
                        }
                    }
                })
            }

        });
    </script>
    <script>
        $(function() {
            $("#se").click(function() {
                $("#content").append("<div id='bgse'><div id='seContent'><p>查看密码需要验证邮箱<input type='checkbox' id='seche'></p><p><button id='sebtn1' style='position: relative;top: 43px;'>取消</button><button id='sebtn2' style='position: relative;top: 12px;left: 150px;'>确定</button></p></div></div>");
                $.ajax({
                    type: "get",
                    url: "./t/t.php",
                    data: "q=emau",
                    //dataType: "dataType",
                    success: function(response) {
                        if (response.info == "true") {
                            $("#seche").prop("checked", true);
                        }
                        if (response.info == 'false') {
                            $("#seche").prop("checked", false);
                        }
                    }
                });
                $("#sebtn1").click(function() {
                    $("#bgse").remove();

                })
                $("#sebtn2").click(function() {
                    if (!$("#seche").is(':checked')) {
                        $('#content_info').append(" <div id='bgAuth'><div id='querypdDiv'><p>将验证码发送至您注册时绑定的邮箱</p><input type='text' id='auth' placeholder='验证码'><br><button id='authBtnfor'>重发</button><button id='sendse'>确定</button></div></div>");
                        $.ajax({
                            type: "get",
                            url: "./emaliAuth/emaliAuth.php",
                            success: function(response) {
                                let dataobj = JSON.parse(response);
                                if (dataobj.code == 1) {
                                    alert("发送成功");
                                } else {
                                    alert("发送失败");
                                }
                            }
                        });
                        $("#sendse").click(function() {
                            $.ajax({
                            type: "post",
                            url: "./t/t.php",
                            data: "type=false&authcode="+document.getElementById("auth").value,
                            success: function(response) {
                                if (response.code == '1') {
                                    alert("修改成功");
                                    $("#bgAuth").remove();
                                }
                                if(response.code == '0'){
                                    alert(response.info);
                                }
                            }
                        });
                        });
                        /* $.ajax({
                            type: "post",
                            url: "./t/t.php",
                            data: "type=true",
                            //dataType: "dataType",
                            success: function(response) {
                                if (response.code == '1') {
                                    alert("修改成功")
                                } else {
                                    alert("修改失败")
                                }
                            }
                        }); */

                    }
                    if ($("#seche").is(':checked')) {
                        $.ajax({
                            type: "post",
                            url: "./t/t.php",
                            data: "type=true",
                            //dataType: "dataType",
                            success: function(response) {
                                if (response.code == '1') {
                                    alert("修改成功")
                                } else {
                                    alert("修改失败")
                                }
                            }
                        });

                    }
                    $("#bgse").remove();
                })
            });


        })
    </script>
</body>

</html>