<?php
class en_de{
    public function encrypt($data, $key){
        $key = md5($key);
        $x = 0;
        $len = strlen($data);
        $l = strlen($key);
        for ($i = 0; $i < $len; $i++){
            if ($x == $l) {
                $x = 0;
            }
            $char .= $key{$x};
            $x++;
        }
        for ($i = 0; $i < $len; $i++)
        {
            $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
        }
        return str_replace('=','eqdy1',base64_encode($str));
    }
    
    public function decrypt($data, $key){
        $data=str_replace('eqdy1','=',$data);
        $key = md5($key);
        $x = 0;
        $data = base64_decode($data);
        $len = strlen($data);
        $l = strlen($key);
        for ($i = 0; $i < $len; $i++)
        {
            if ($x == $l) 
            {
                $x = 0;
            }
            $char .= substr($key, $x, 1);
            $x++;
        }
        for ($i = 0; $i < $len; $i++)
        {
            if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1)))
            {
                $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
            }
            else
            {
                $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
            }
        }
        return $str;
    }
}
function en_cookie($str){
    $key='cookiedata';
    $cookie_input=new en_de();
    return $cookie_input->encrypt($str,$key);
}
function dn_cookie($str){
    $key='cookiedata';
    $cookie_input=new en_de();
    return $cookie_input->decrypt($str,$key);
}
function cookie_set($name,$key,$time){
    setcookie(en_cookie($name),en_cookie((string)$key),time()+$time,'/');
}
function cookie_read($name){
    $name=$_COOKIE[en_cookie($name)];
    return dn_cookie("$name");
}
function cookie_del($name){
    setcookie($name,$_COOKIE[$name],time()-1);
}
function en_str($str,$key){
    $cookie_input=new en_de();
    return $cookie_input->encrypt($str,$key);
}
function de_str($str,$key){
    $cookie_input=new en_de();
    return $cookie_input->decrypt($str,$key);
}
