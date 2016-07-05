<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Chat_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function num_chats() {
        return $this->db->query('SELECT COUNT(*) FROM chat')->fetchColumn();
    }
    
    public function get_lastest_id() {
        return $this->db->query('SELECT MAX(chat_id) from chat')->fetchColumn();
    }

    public function get_chats($start, $limit) {
        return $this->db->query("SELECT chat.*, users.* FROM chat INNER JOIN users USING(user_id) ORDER BY chat.chat_id DESC LIMIT $start, $limit")->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function insert_chat($content) {
        $sth = $this->db->prepare('INSERT INTO chat(user_id, content, time) VALUES(?,?,?)');
        return $sth->execute(array($this->user->user_id, $content, time()));
    }
    
    public function clean_chat(){
        $time = time();
        $dname = $this->user->dname;
        $a = $this->db->exec('TRUNCATE TABLE chat');
        $b = $this->db->exec("INSERT INTO chat(user_id, content, time) VALUES(4,'[color=red]{$dname}[/color] dọn dẹp phòng chat',$time)");
        return $a || $b;
    }

}