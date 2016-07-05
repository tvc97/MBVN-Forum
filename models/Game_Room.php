<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Game_Room_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function add_point($id, $point) {
        return $this->db->exec("UPDATE users SET point = point + $point WHERE user_id = $id");
    }
    
    public function altp_already($id) {
        return $this->db->query("SELECT COUNT(*) FROM game WHERE user_id = $id AND game_code = 'ALTP'")->fetchColumn() == 1;
    }
    
    public function altp_data($id) {
        return $this->db->query("SELECT * FROM game WHERE user_id = $id AND game_code = 'ALTP'")->fetch(PDO::FETCH_ASSOC);
    }
    
    public function altp_insert($id, $vars, $time) {
        $sth = $this->db->prepare('INSERT INTO game VALUES(?, ?, ?, ?)');
        return $sth->execute(array($id, 'ALTP', $vars, $time));
    }

    public function altp_update($id, $vars, $time) {
        $sth = $this->db->prepare("UPDATE game SET vars = ?, time = ? WHERE game_code = 'ALTP' AND user_id = $id");
        return $sth->execute(array($vars, $time));
    }
    
    public function chatbox_notify($content) {
        $sth = $this->db->prepare('INSERT INTO chat(user_id, content, time) VALUES(?,?,?)');
        return $sth->execute(array(4, $content, time()));
    }

}