function get_ajax(options) {

    //创建Ajax对象
    let xhr = new XMLHttpRequest();
    //GET方式
    xhr.open("GET", options.url, true);
    //发送请求
    xhr.send();
    //接收数据，即监听xhr对象下的onload事件
    xhr.onload = function () {
        options.success(xhr.responseText);
    }
}

function post_ajax(options) {
    //html = document.getElementById('content').value; 
    //创建POST Ajax对象
    let xhr = new XMLHttpRequest();
    //POST方式
    xhr.open("POST", options.url, true);
    //发送请求
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded", true);
    xhr.send(options.data);
    //接收数据，即监听xhr对象下的onload事件
    xhr.onload = function () {
        //接收回调数据并传给success
        options.success(xhr.responseText);
    }
}