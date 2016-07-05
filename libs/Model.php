<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Model {

    function __construct() {

        if (!isset($this->db))
            $this->db = Database::getInstance(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->db->exec('SET NAMES UTF8');
    }

    public function user_exists($user) {

        $sth = $this->db->prepare('SELECT COUNT(*) FROM users WHERE user_name = ?');
        $sth->execute(array($user));
        $rs = $sth->fetchColumn();
        return $rs == 1;
    }

    public function id_exists($id) {

        $sth = $this->db->prepare('SELECT COUNT(*) FROM users WHERE user_id = ?');
        $sth->execute(array($id));
        $rs = $sth->fetchColumn();
        return $rs == 1;
    }

    public function email_exists($email) {

        $sth = $this->db->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
        $sth->execute(array($email));
        $rs = $sth->fetchColumn();
        return $rs == 1;
    }

    public function check_login($login, $passwd, $hash) {

        $sth = $this->db->prepare('SELECT COUNT(*) FROM users WHERE user_name = ? AND user_passwd = ? AND login_hash = ?');
        $sth->execute(array($login, $passwd, $hash));
        $rs = $sth->fetchColumn();
        return $rs == 1;
    }

    public function get_users($uid, $start, $limit) {
        return $this->db->query("SELECT * FROM users WHERE user_id != $uid ORDER BY user_id DES LIMIT $start, $limit")->fetch(PDO::FETCH_ASSOC);
    }
    
    public function user_info($id) {
        return $this->db->query("SELECT * FROM users WHERE user_id = $id")->fetch(PDO::FETCH_ASSOC);
    }

    public function num_user($uid) {
        return $this->db->query("SELECT COUNT(user_id) FROM users WHERE user_id != $uid")->fetchColumn();
    }

}
