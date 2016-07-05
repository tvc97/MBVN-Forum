<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Database extends PDO {
    
    public static $constructed = false;

    function __construct($host, $user, $password, $dbname) {
        try{
            parent::__construct("mysql:host=$host;dbname=$dbname", $user, $password);
            self::$constructed = $this;
        }  catch (Exception $e){
            exit('Could not connect to database server');
        }
    }
    
    public static function getInstance($host, $user, $password, $dbname){
        if(!self::$constructed){
            return new Database($host, $user, $password, $dbname);
        }else{
            return self::$constructed;
        }
    }

}