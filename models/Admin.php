<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Admin_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function edit_level($id, $level) {
        return $this->db->exec("UPDATE users SET level = $level WHERE user_id = $id");
    }

    public function get_cats() {
        return $this->db->query('SELECT * FROM cats')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cat_info($id) {
        return $this->db->query('SELECT * FROM cats WHERE cat_id = ' . $id)->fetch(PDO::FETCH_ASSOC);
    }

    public function add_root_cat($name) {
        $sth = $this->db->prepare('INSERT INTO cats (cat_name, parent) VALUES(?,?)');
        return $sth->execute(array($name, 0));
    }

    public function add_cat($id, $name) {
        $sth = $this->db->prepare('INSERT INTO cats (cat_name, parent) VALUES(?,?)');
        return $sth->execute(array($name, $id));
    }

    public function edit_cat($id, $name) {
        $sth = $this->db->prepare('UPDATE cats SET cat_name = ? WHERE cat_id = ' . $id);
        return $sth->execute(array($name));
    }

    public function delete_root_cat($id) {
        $a = $this->db->exec("DELETE FROM posts WHERE parent IN (SELECT thread_id FROM threads WHERE parent IN (SELECT cat_id FROM cats WHERE parent = $id))");
        $b = $this->db->exec("DELETE FROM threads WHERE parent IN (SELECT cat_id FROM cats WHERE parent = $id)");
        $c = $this->db->exec("DELETE FROM cats WHERE parent = $id");
        $d = $this->db->exec("DELETE FROM cats WHERE cat_id = $id");
        
        return $a || $b || $c || $d;
    }
    
    public function delete_cat($id) {
        $a = $this->db->exec("DELETE FROM posts WHERE parent IN (SELECT thread_id FROM threads WHERE parent = $id)");
        $b = $this->db->exec("DELETE FROM threads WHERE parent = $id");
        $c = $this->db->exec("DELETE FROM cats WHERE cat_id = $id");
        
        return $a || $b || $c;
    }
    
    public function delete_thread() {
        
    }

    public function is_root_cat($id) {
        return $this->db->query('SELECT COUNT(*) FROM cats WHERE parent = 0 AND cat_id = ' . $id)->fetchColumn() == 1;
    }

    public function cat_exists($id) {
        return $this->db->query('SELECT COUNT(*) FROM cats WHERE cat_id = ' . $id)->fetchColumn() == 1;
    }
    
    public function stats() {
        return $this->db->query(
                'SELECT'
                . '(SELECT COUNT(*) FROM users) as num_user,'
                . '(SELECT COUNT(*) FROM users WHERE level = 0) as ban_user,'
                . '(SELECT COUNT(*) FROM users WHERE level = 1) as num_mem,'
                . '(SELECT COUNT(*) FROM users WHERE level = 5) as mod_user,'
                . '(SELECT COUNT(*) FROM users WHERE level >= 10) as admin_user,'
                . '(SELECT COUNT(*) FROM cats) as num_cat,'
                . '(SELECT COUNT(*) FROM threads) as num_thread,'
                . '(SELECT COUNT(*) FROM posts) as num_post'
                )->fetch(PDO::FETCH_ASSOC);
    }

}
