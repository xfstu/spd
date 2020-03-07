function isJSON(str) {
    if (typeof str == 'string') {
        try {
            var obj = JSON.parse(str);
            if (typeof obj == 'object' && obj) {
                return true;
            } else {
                return false;
            }

        } catch (e) {
            console.log('error：' + str + '!!!' + e);
            return false;
        }
    }
    console.log('It is not a string!')
}

function check() {
    var key = document.getElementById("key_def").innerHTML;
    if (key == "" || key == undefined) {
        return false;
    } else {
        return key;
    }
}

function addKey() {
    let key = document.getElementById("key_input").value;
    document.getElementById("key_def").innerHTML = key;
    if (!check()) {
        alert("写入失败！");
    } else {
        alert("写入成功！")
    }

}

function authBtnfor() {
    get_ajax({
        url: './emaliAuth/emaliAuth.php',
        success: function (data) {
            if (data.code == 0) {
                alert("发送失败");
            } else {
                querypd();
            }
        }
    })
}


function lookAuth(id) {
    if (!check()) {
        alert("没有密钥！");
        return;
    }
    //console.log($.cookie('checkbox'));
    $.ajax({
        type: "get",
        url: "./t/t.php",
        data: "q=emau",
        //dataType: "dataType",
        success: function (response) {
            if (response.info == 'true') {
                $('#content_info').append(" <div id='bgAuth'><div id='querypdDiv'><p>将验证码发送至您注册时绑定的邮箱</p><input type='text' id='auth' placeholder='验证码'><br><button id='authBtnfor'>重发</button><button id='queryPd'>确定</button></div></div>");
                $.ajax({
                    type: "get",
                    url: "./emaliAuth/emaliAuth.php",
                    success: function (response) {
                        let dataobj = JSON.parse(response);
                        if (dataobj.code == 1) {
                            alert("发送成功");
                            Auth(id);
                        } else {
                            alert("发送失败");
                        }
                    }
                });
                let btn = document.getElementById("authBtnfor");
                btn.onclick = function () {
                    get_ajax({
                        url: './emaliAuth/emaliAuth.php',
                        success: function (data) {
                            let dataobj = JSON.parse(data);
                            if (dataobj.code == 1) {
                                alert("发送成功");
                                Auth(id);
                            } else {
                                alert("发送失败");
                            }
                        }
                    });
                }
                console.log($.cookie('checkbox'));
                return;
            } else {
                var key = check();
                let send_data = "id=" + id + "&key=" + key;
                post_ajax({
                    url: "../admin/look/look.php",
                    data: send_data,
                    success: function (data) {
                        document.getElementById("content_info").innerHTML = data;
                        var sUserAgent = navigator.userAgent.toLowerCase();
                        if (/ipad|iphone|midp|rv:1.2.3.4|ucweb|android|windows ce|windows mobile/.test(sUserAgent)) {
                            $("div:eq(4)").css("marginTop", "10px").css("padding", "10px");
                        }
                        $("#user,#passwd,#appurl").click(function (e) {
                            var id = $(e.target).attr('id');
                            var Url = document.getElementById(id);
                            Url.select();
                            document.execCommand("Copy");
                            alert("复制成功！");
                        })
                    }
                });
            }
        }
    });
}

function Auth(id) {
    let btn = document.getElementById("queryPd");
    btn.onclick = function () {
        let valueAuthh = document.getElementById("auth").value;
        var key = check();
        let send_data = "id=" + id + "&key=" + key;
        post_ajax({
            url: "../admin/look/look.php?auth=" + valueAuthh,
            data: send_data,
            success: function (data) {
                //let dataobj = JSON.parse(data);
                if (data == '0') {
                    alert("验证码错误或者已过期");
                } else {
                    document.getElementById("content_info").innerHTML = data;
                    var sUserAgent = navigator.userAgent.toLowerCase();
                    if (/ipad|iphone|midp|rv:1.2.3.4|ucweb|android|windows ce|windows mobile/.test(sUserAgent)) {
                        $("div:eq(4)").css("marginTop", "10px").css("padding", "10px");
                    }
                    $("#user,#passwd,#appurl").click(function (e) {
                        var id = $(e.target).attr('id');
                        var Url = document.getElementById(id);
                        Url.select();
                        document.execCommand("Copy");
                        alert("复制成功！");
                    })
                }
            }
        });
    }
}


function add_passwd() {
    if (!check()) {
        alert("没有密钥！");
        return;
    }
    get_ajax({
        url: "../admin/add/add_Editor.php",
        success: function (params) {
            document.getElementById("content_info").innerHTML = params;
            var sUserAgent = navigator.userAgent.toLowerCase();
            if (/ipad|iphone|midp|rv:1.2.3.4|ucweb|android|windows ce|windows mobile/.test(sUserAgent)) {
                $("div:eq(4)").css("margin", "10px").css("paddingTop", "10px")
            }
            $("#qpd").click(function () {
                let pdlen = document.getElementById("pdnumber").value;
                if (pdlen == '') {
                    pdlen = 10;
                }
                pddata = '';
                pdlen = pdlen || 32;
                var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678*#!*#!'; /****默认去掉了容易混淆的字符oOLl,9gq,Vv,Uu,I1****/
                var maxPos = $chars.length;
                var pwd = '';
                for (i = 0; i < pdlen; i++) {
                    pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
                }
                document.getElementById('passwd').value = pwd;
            })
        }


    });

}

function send_add(params) {
    if (!check()) {
        alert("没有密钥！");
        return;
    }
    var key = check();
    let user = document.getElementById("user").value;
    let passwd = document.getElementById("passwd").value;
    let urlapp = document.getElementById("urlapp").value;
    let info = document.getElementById("info").value;
    let data = "user=" + user + "&passwd=" + passwd + "&urlapp=" + urlapp + "&info=" + info + "&key=" + key;
    post_ajax({
        url: "../admin/add/add_w.php",
        data: data,
        success: function (params) {
            get_ajax({
                url: "./content/myPasswd.php",
                success: function (data) {
                    document.getElementById("content_info").innerHTML = data;
                    var sUserAgent = navigator.userAgent.toLowerCase();
                    if (/ipad|iphone|midp|rv:1.2.3.4|ucweb|android|windows ce|windows mobile/.test(sUserAgent)) {
                        $("table tbody tr th,table p,table a").css("fontSize", "12px").css("width", "auto");
                    }
                }
            });
        }
    });
}

function del(params) {
    get_ajax({
        url: "./del/del.php?id=" + params,
        success: function (params) {
            get_ajax({
                url: "./content/myPasswd.php",
                success: function (data) {
                    document.getElementById("content_info").innerHTML = data;
                    var sUserAgent = navigator.userAgent.toLowerCase();
                    if (/ipad|iphone|midp|rv:1.2.3.4|ucweb|android|windows ce|windows mobile/.test(sUserAgent)) {
                        $("table tbody tr th,table p,table a").css("fontSize", "12px").css("width", "auto");
                    }
                }
            });
        }
    });
}

function updata(params) {
    /* if (!check()) {
        alert("没有密钥！");
        return;
    } */
    $.ajax({
        type: "get",
        url: "./t/t.php",
        data: "q=emau",
        //dataType: "dataType",
        success: function (response) {
            if (response.info == 'true') {
                $('#content_info').append(" <div id='bgAuth'><div id='querypdDiv'><p>将验证码发送至您注册时绑定的邮箱</p><input type='text' id='auth' placeholder='验证码'><br><button id='authBtnfor'>重发</button><button id='queryupPd'>确定</button></div></div>");
                $.ajax({
                    type: "get",
                    url: "./emaliAuth/emaliAuth.php",
                    success: function (response) {
                        let dataobj = JSON.parse(response);
                        if (dataobj.code == 1) {
                            alert("发送成功");
                            updataAuth(params);
                        } else {
                            alert("发送失败");
                        }
                    }
                });
                let btn = document.getElementById("authBtnfor");
                btn.onclick = function () {
                    $.ajax({
                        type: "get",
                        url: "./emaliAuth/emaliAuth.php",
                        success: function (response) {
                            let dataobj = JSON.parse(response);
                            if (dataobj.code == 1) {
                                alert("发送成功");
                                updataAuth(params);
                            } else {
                                alert("发送失败");
                            }
                        }
                    });
                }
            } else {
                var key = check();
                get_ajax({
                    url: "./updata/updata_Editor.php?id=" + params + "&key=" + key,
                    success: function (params) {
                        document.getElementById("content_info").innerHTML = params;
                        var sUserAgent = navigator.userAgent.toLowerCase();
                        if (/ipad|iphone|midp|rv:1.2.3.4|ucweb|android|windows ce|windows mobile/.test(sUserAgent)) {
                            $("div:eq(4)").css("marginTop", "10px").css("paddingTop", "10px")
                        }
                    }
                });
            }
        }
    });



   /*  var key = check();
    get_ajax({
        url: "./updata/updata_Editor.php?id=" + params + "&key=" + key,
        success: function (params) {
            document.getElementById("content_info").innerHTML = params;
            var sUserAgent = navigator.userAgent.toLowerCase();
            if (/ipad|iphone|midp|rv:1.2.3.4|ucweb|android|windows ce|windows mobile/.test(sUserAgent)) {
                $("div:eq(4)").css("marginTop", "10px").css("paddingTop", "10px")
            }
        }
    }); */
}
function updataAuth(params){
    let btn = document.getElementById("queryupPd");
    btn.onclick = function () {
        let valueAuthh = document.getElementById("auth").value;
        var key = check();
        get_ajax({  
            url: "./updata/updata_Editor.php?id=" + params + "&key=" + key+"&auth="+ valueAuthh,
            success: function (data) {
                //let dataobj = JSON.parse(data);
                if (data == '0') {
                    alert("验证码错误或者已过期");
                } else {
                    document.getElementById("content_info").innerHTML = data;
                    var sUserAgent = navigator.userAgent.toLowerCase();
                    if (/ipad|iphone|midp|rv:1.2.3.4|ucweb|android|windows ce|windows mobile/.test(sUserAgent)) {
                        $("div:eq(4)").css("marginTop", "10px").css("padding", "10px");
                    }
                    $("#user,#passwd,#appurl").click(function (e) {
                        var id = $(e.target).attr('id');
                        var Url = document.getElementById(id);
                        Url.select();
                        document.execCommand("Copy");
                        alert("复制成功！");
                    })
                }
            }
        });
    }
}

function send_updata() {
    if (!check()) {
        alert("没有密钥！");
        return;
    }
    var key = check();
    let id = document.getElementById("id").innerHTML;
    let user = document.getElementById("user").value;
    let passwd = document.getElementById("passwd").value;
    let urlapp = document.getElementById("urlapp").value;
    let info = document.getElementById("info").value;
    let data = "user=" + user + "&passwd=" + passwd + "&urlapp=" + urlapp + "&info=" + info + "&key=" + key;
    post_ajax({
        url: "./updata/updata_w.php?id=" + id,
        data: data,
        success: function () {
            get_ajax({
                url: "./content/myPasswd.php",
                success: function (data) {
                    document.getElementById("content_info").innerHTML = data;
                    var sUserAgent = navigator.userAgent.toLowerCase();
                    if (/ipad|iphone|midp|rv:1.2.3.4|ucweb|android|windows ce|windows mobile/.test(sUserAgent)) {
                        $("table tbody tr th,table p,table a").css("fontSize", "15px").css("width", "auto");
                    }
                }
            });
        }
    });
}

function login_up(page) {
    get_ajax({
        url: "../login_info/login_info.php?page=" + page,
        success: function (params) {
            document.getElementById("content_info").innerHTML = params;
        }
    });
}

function login_down(page) {
    get_ajax({
        url: "../login_info/login_info.php?page=" + page,
        success: function (params) {
            document.getElementById("content_info").innerHTML = params;
        }
    });
}

function login_homepage(page) {
    get_ajax({
        url: "../login_info/login_info.php?page=" + page,
        success: function (params) {
            document.getElementById("content_info").innerHTML = params;
        }
    });
}

function login_tailpage(page) {
    get_ajax({
        url: "../login_info/login_info.php?page=" + page,
        success: function (params) {
            document.getElementById("content_info").innerHTML = params;
        }
    });
}

//------------------------------登录分页请求功能结束-------------------------------------

function Visit_up(page) {
    get_ajax({
        url: "../Visit_info/Visit.php?page=" + page,
        success: function (params) {
            document.getElementById("content_info").innerHTML = params;
        }
    });
}

function Visit_down(page) {
    get_ajax({
        url: "../Visit_info/Visit.php?page=" + page,
        success: function (params) {
            document.getElementById("content_info").innerHTML = params;
        }
    });
}

function Visit_homepage(page) {
    get_ajax({
        url: "../Visit_info/Visit.php?page=" + page,
        success: function (params) {
            document.getElementById("content_info").innerHTML = params;
        }
    });
}

function Visit_tailpage(page) {
    get_ajax({
        url: "../Visit_info/Visit.php?page=" + page,
        success: function (params) {
            document.getElementById("content_info").innerHTML = params;
        }
    });
}
//------------------------------访问分页功能结束-------------------------------------