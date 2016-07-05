<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Upanel_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    /**
     * 
     * @param int $id user id
     * @param String $password new user password
     * @param String $hash new user hash login
     * update user login hash and password
     */
    public function update_user($id, $password, $hash) {
        
        $sth = $this->db->exec("UPDATE users SET user_passwd = '$password', login_hash = '$hash' WHERE user_id = $id");
        return $sth;

    }
    
    public function update_profile($id, $email, $gender, $dob) {
        
        $sth = $this->db->exec("UPDATE users SET email = '$email', gender = $gender, dob = '$dob' WHERE user_id = $id");
        return $sth;
        
    }

}