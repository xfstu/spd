<?php
function h404(){
    return header("HTTP/1.1 404 Not Found");
}
function h403(){
    return header("HTTP/1.1 403 Forbidden");
}
function hjson(){
    return header('Content-type: application/json'); //json
}
function hhtml(){
    header('Content-Type: text/html; charset=utf-8'); //网页编码
}
hjson();


?>