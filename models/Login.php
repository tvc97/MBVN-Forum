<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Login_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function id_exist($id) {
        $dbh = $this->db->prepapre('SELECT COUNT(*) FROM lost_password WHERE id = ?');
        return $dbh->execute($id)->fetchColumn() == 1;
    }

    function get_user_info($id) {
        $dbh = $this->db->prepare('SELECT user_id FROM lost_password WHERE id = ?');
        $user_id = $dbh->execute($id)->fetchColumn();
        return user_info($user_id);
    }

    function change_password($uid, $un, $pwd) {
        $password = Hash::generate('md5', $pwd, PWD_KEY);
        $hash = Hash::generate('sha512', strtolower($un) . ';' . $password, PWD_KEY);
        return $this->db->execute("UPDATE users SET user_password = '$password', login_hash = '$hash' WHERE user_id = $uid");
    }

}