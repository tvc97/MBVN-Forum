<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Like_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function post_exists($id) {
        return $this->db->query("SELECT COUNT(*) FROM posts WHERE post_id = $id")->fetchColumn() == 1;
    }
    
    public function post_info($id) {
        return $this->db->query("SELECT posts.*, threads.thread_name, threads.thread_id FROM posts INNER JOIN threads ON(posts.parent = threads.thread_id) WHERE post_id = $id")->fetch();
    }
    
    public function already_like($id) {
        return $this->db->query("SELECT COUNT(*) FROM likes WHERE post_id = $id AND user_id = {$this->user->user_id}")->fetchColumn() == 1;
    }
    
    public function like($id, $user) {
        $q1 = $this->db->exec(
            "INSERT INTO likes(user_id, post_id) VALUES({$this->user->user_id}, $id);"
            . "UPDATE users SET liked = liked + 1 WHERE user_id = {$this->user->user_id};"
            . "UPDATE users SET beliked = beliked + 1 WHERE user_id = $user;"
            . "UPDATE users SET point = point + 5 WHERE user_id = $user;"
            . "UPDATE posts SET liked = liked + 1 WHERE post_id = $id"
        );
        return $q1;
    }

    public function un_like($id, $user) {
        $q1 = $this->db->exec(
            "DELETE FROM likes WHERE user_id = $user AND post_id = $id;"
            . "UPDATE users SET liked = liked - 1 WHERE user_id = {$this->user->user_id};"
            . "UPDATE users SET beliked = beliked - 1 WHERE user_id = $user;"
            . "UPDATE users SET point = point - 5 WHERE user_id = $user;"
            . "UPDATE posts SET liked = liked - 1 WHERE post_id = $id"
        );
        return $q1;
    }

}