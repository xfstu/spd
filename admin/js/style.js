$(document).ready(function () {
    $("#myPasswd").click(function () {
        $("#myPasswd").css("background", "rgb(44,49,56)");
        $("#login_info").css("background", "");
        $("#Visit").css("background", "");
        $("#unlogin").css("background", "");
        get_ajax({
            url: "./content/myPasswd.php",
            success: function (data) {
                document.getElementById("content_info").innerHTML = data;
                var sUserAgent = navigator.userAgent.toLowerCase();
                if (/ipad|iphone|midp|rv:1.2.3.4|ucweb|android|windows ce|windows mobile/.test(sUserAgent)) {
                    $("table tbody tr th,table p,table a").css("fontSize","12px").css("width","auto").css("height","22px");
                }
                
            }
        });
    });
    $("#login_info").click(function () {
        $("#login_info").css("background", "rgb(44,49,56)");
        $("#myPasswd").css("background", "");
        $("#Visit").css("background", "");
        $("#unlogin").css("background", "");
        get_ajax({
            url: "./login_info/index.php",
            success: function (params) {
                document.getElementById("content_info").innerHTML = params;
            }
        });
    });
    $("#Visit").click(function () {
        $("#Visit").css("background", "rgb(44,49,56)");
        $("#myPasswd").css("background", "");
        $("#login_info").css("background", "");
        $("#unlogin").css("background", "");
        get_ajax({
            url: "./Visit_info/Visit.php",
            success: function (params) {
                document.getElementById("content_info").innerHTML = params;
            }
        });
    });

});