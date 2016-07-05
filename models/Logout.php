<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Logout_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function update_logout($id) {
        
        return $this->db->exec('UPDATE users SET logout = 1 WHERE user_id = '.$id);
        
    }

}