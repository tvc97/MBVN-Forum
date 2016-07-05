<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Stats_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function forum_stats() {
        return $this->db->query('SELECT (SELECT COUNT(*) FROM posts) AS numpost, (SELECT COUNT(*) FROM threads) AS numthread, (SELECT COUNT(*) FROM users) as numuser, (SELECT COUNT(*) FROM users WHERE reg > ' . mktime(0, 0, 0) . ') AS newuser')->fetch(PDO::FETCH_ASSOC);
    }

    public function get_newest_user() {
        return $this->db->query('SELECT * FROM users ORDER BY user_id DESC LIMIT 1')->fetch(PDO::FETCH_ASSOC);
    }

}
