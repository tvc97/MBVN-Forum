<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Register_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function insert_user($data){
        
        $dbh = $this->db->prepare('INSERT INTO users (`user_name`, `dname`, `user_passwd`, `email`, `login_hash`, `gender`, `dob`, `reg`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        return $dbh->execute(array(
            $data['username'],
            $data['dname'],
            $data['password'],
            $data['email'],
            $data['login_hash'],
            $data['gender'],
            $data['dob'],
            $data['reg']
        ));
        
    }
    
    public function getID($user_name) {
        return $this->db->query("SELECT user_id FROM users WHERE user_name = '$user_name'")->fetchColumn();
    }

    public function insert_message($id, $content) {
        $sth = $this->db->prepare('INSERT INTO messages (from_id, to_id, content, time, `read`) VALUES (?,?,?,?,?)');
        return $sth->execute(array(1, $id, $content, time(), 0));
    }

}