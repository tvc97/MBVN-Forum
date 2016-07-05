<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Search_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function num_result_thread($query) {
        $sth = $this->db->prepare('SELECT COUNT(*) FROM threads WHERE thread_name LIKE ?');
        $sth->execute(array('%' . $query . '%'));
        return $sth->fetchColumn();
    }
    
    public function num_result_post($query) {
        $sth = $this->db->prepare('SELECT COUNT(*) FROM posts WHERE content LIKE ?');
        $sth->execute(array('%' . $query . '%'));
        return $sth->fetchColumn();
    }
    
    public function num_result_user($query) {
        $sth = $this->db->prepare('SELECT COUNT(*) FROM users WHERE user_name LIKE ?');
        $sth->execute(array('%' . $query . '%'));
        return $sth->fetchColumn();
    }
    
    public function result_thread($query, $start, $limit) {
        $sth = $this->db->prepare('SELECT threads.*, users.user_name, users.dname, users.user_id, users.level FROM threads INNER JOIN users USING(user_id) WHERE threads.thread_name LIKE ? ORDER BY thread_id DESC LIMIT ' . $start . ', ' . $limit);
        $sth->execute(array('%' . $query . '%'));
        return $sth->fetchAll();
    }
    
    public function result_post($query, $start, $limit) {
        $sth = $this->db->prepare('SELECT posts.*, users.user_name, users.dname, users.user_id, users.level, users.last, users.logout, threads.thread_name, threads.thread_id FROM posts INNER JOIN users USING(user_id) INNER JOIN threads ON(posts.parent = threads.thread_id) WHERE content LIKE ? ORDER BY posts.post_id DESC LIMIT ' . $start . ', ' . $limit);
        $sth->execute(array('%' . $query . '%'));
        return $sth->fetchAll();
    }

    public function result_user($query, $start, $limit) {
        $sth = $this->db->prepare('SELECT * FROM users WHERE user_name LIKE ? ORDER BY user_id ASC LIMIT ' . $start . ', ' . $limit);
        $sth->execute(array('%' . $query . '%'));
        return $sth->fetchAll();
    }
}