<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

function wap(){
    $ua = $_SERVER['HTTP_USER_AGENT'];
    if(preg_match('#(cldc|midp|wap)#i', $ua))
        return true;
    if(preg_match('#(chrome|firefox|web|macintosh|windows|linux|mac os|solaris|android)#i', $ua))
        return false;
    return true;
}

function format_chat_id($str) {
    for($i = strlen($str); $i < 8; $i++)
        $str = '0' . $str;
    return $str;
}
