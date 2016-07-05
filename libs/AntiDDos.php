<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class AntiDDos {

    function __construct() {

        $ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

        $banned = file(ROOT . '/system_logs/ip_banned.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (in_array($ip, $banned)) {
            header('Content-Type: text/plain;charset=UTF-8');
            exit('IP của bạn đã bị cấm vĩnh viễn vì có dấu hiệu ddos');
        }

        $file = file_get_contents(ROOT . '/system_logs/ip.txt');
        $ips = unserialize($file);

        $ips['' . microtime(true) . ''] = $ip;
        $count = 0;

        foreach ($ips as $key => $val) {
            if ($val == $ip)
                $count++;

            if (microtime(true) - (float) $key > 1)
                unset($ips[$key]);
        }

        if ($count > 9){
            file_put_contents(ROOT . '/system_logs/ip_banned.txt', $ip."\n");
            if(isset($_COOKIE['hash']))
                file_put_contents(ROOT . '/system_logs/hash_banned.txt', $_COOKIE['hash']."\n");
        }

        file_put_contents(ROOT . '/system_logs/ip.txt', serialize($ips));
    }

}
