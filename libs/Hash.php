<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Hash {

    function __construct() {
        
    }
    
    /**
     * 
     * @param String $type encrypt type
     * @param String $content content to encrypt
     * @param String $key key for encrypt
     * @return String encrypted content
     */
    public static function generate($type, $content, $key) {
        
        $hash = hash_init($type, HASH_HMAC, $key);
        hash_update($hash, $content);
        
        return hash_final($hash);
        
    }

}