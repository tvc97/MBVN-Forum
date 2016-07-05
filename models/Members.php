<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Members_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function infoID($id) {
        $id = (int) $id;
        $dat = $this->db->query('SELECT * FROM users WHERE user_id = ' . $id);
        $dat = $dat->fetch(PDO::FETCH_ASSOC);
        $dat['numpost'] = $this->num_posts_by_user($id);
        $dat['numthread'] = $this->num_threads_by_user($id);
        return $dat;
    }

    public function num_threads_by_user($id) {
        return $this->db->query('SELECT COUNT(thread_id) FROM threads WHERE verified = 1 AND user_id = ' . $id)->fetchColumn();
    }

    public function num_posts_by_user($id) {
        return $this->db->query('SELECT COUNT(post_id) FROM posts WHERE user_id = ' . $id)->fetchColumn();
    }

    public function num_users() {
        return $this->db->query('SELECT COUNT(*) FROM users')->fetchColumn();
    }

    public function listUser($start, $limit) {
        return $this->db->query("SELECT * FROM users ORDER BY user_id LIMIT $start, $limit")->fetchAll(PDO::FETCH_ASSOC);
    }

}
