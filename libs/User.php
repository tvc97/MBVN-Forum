<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class User extends Model {

    public $isLoged = false;
    public $data;
    public $numMessage;
    public $user_theme = 'default';

    function __construct() {
        parent::__construct();
        if (isset($_COOKIE['hash'])) {
            $this->isLoged = $this->checkHash($_COOKIE['hash']);
        }
        if ($this->isLoged) {
            $hash = trim($_COOKIE['hash']);
            $this->update_user($hash);
            
            $this->updateData();

            $this->numMessage = $this->numURMessage($this->user_id);
            
            if($this->level >= 5)
                $this->unverify = $this->numUnVerify();
            
        }
    }

    /**
     * 
     * @param String $hash user login hash
     * @return bool if login hash exists
     */
    function checkHash($hash) {

        $sth = $this->db->prepare('SELECT COUNT(*) FROM users WHERE login_hash = ?');
        $sth->execute(array($hash));
        $rs = $sth->fetchColumn();

        return $rs == 1;
    }

    /**
     * 
     * @param String $hash user hash login
     * @return array user info
     */
    function userData($hash) {

        $rs = $this->db->query("SELECT * FROM users WHERE login_hash = '$hash'")->fetchAll(PDO::FETCH_ASSOC);

        return $rs[0];
    }

    /*
     * Update user info for last access web
     */

    function update_user($hash) {

        $time = time();
        $data = serialize(array('ua' => Helper::get_ua(), 'ip' => Helper::get_ip(), 'locate' => Helper::get_location()));

        $sth = $this->db->prepare("UPDATE users SET logout = 0, vars = ?, last = ? WHERE login_hash = '$hash'");
        $sth->execute(array($data, $time));
    }

    function updateData() {

        $this->data = $this->userData($_COOKIE['hash']);

        foreach ($this->data as $key => $val) {
            $this->$key = $val;
        }
        
        unset($this->data);
    }
    
    public function numURMessage($id) {
        return $this->db->query("SELECT COUNT(*) FROM messages WHERE to_id = $id AND `read` = 0")->fetchColumn();
    }
    
    public function numUnVerify() {
        return $this->db->query('SELECT COUNT(*) FROM threads WHERE verified = 0')->fetchColumn();
    }


}
