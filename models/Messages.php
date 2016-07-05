<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Messages_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function get_receive_messages($id, $start = 0, $limit = 10) {
        return $this->db->query("SELECT users.*, messages.* FROM messages INNER JOIN users ON(users.user_id = messages.from_id) WHERE messages.to_id = $id ORDER BY messages.message_id DESC LIMIT $start, $limit")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_send_messages($id, $start = 0, $limit = 10) {
        return $this->db->query("SELECT users.*, messages.* FROM messages INNER JOIN users ON(users.user_id = messages.to_id) WHERE messages.from_id = $id ORDER BY messages.message_id DESC LIMIT $start, $limit")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function num_receive_messages($id) {
        return $this->db->query("SELECT COUNT(*) FROM messages WHERE to_id = $id")->fetchColumn();
    }

    public function num_send_messages($id) {
        return $this->db->query("SELECT COUNT(*) FROM messages WHERE from_id = $id")->fetchColumn();
    }

    public function num_unread_messages($id) {
        return $this->db->query("SELECT COUNT(*) FROM messages WHERE to_id = $id AND `read` = 1")->fetchColumn();
    }

    public function mark_readed($id) {
        return $this->db->exec("UPDATE messages SET `read` = 1 WHERE message_id = $id");
    }

    public function message_exists($id, $uid) {
        return $this->db->query("SELECT COUNT(*) FROM messages WHERE message_id = $id AND (to_id = $uid OR from_id = $uid)")->fetchColumn() == 1;
    }

    public function get_receive_data($id) {
        return $this->db->query("SELECT messages.*, users.* FROM messages INNER JOIN users ON (messages.from_id = users.user_id) WHERE message_id = $id")->fetch(PDO::FETCH_ASSOC);
    }

    public function get_send_data($id) {
        return $this->db->query("SELECT messages.*, users.* FROM messages INNER JOIN users ON (messages.to_id = users.user_id) WHERE message_id = $id")->fetch(PDO::FETCH_ASSOC);
    }

    public function is_receiver($id, $uid) {
        return $this->db->query("SELECT to_id FROM messages WHERE message_id = $id")->fetchColumn() == $uid;
    }
    
    public function insert_message($id, $content) {
        $sth = $this->db->prepare('INSERT INTO messages (from_id, to_id, content, time, `read`) VALUES (?,?,?,?,?)');
        return $sth->execute(array($this->user->user_id, $id, $content, time(), 0));
    }

}
