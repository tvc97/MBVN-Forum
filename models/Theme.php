<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Theme_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function update_theme($theme_name) {
        $sth = $this->db->prepare('UPDATE users SET user_theme = ? WHERE user_id = ?');
        return $sth->execute(array($theme_name, $this->user->user_id));
    }

}