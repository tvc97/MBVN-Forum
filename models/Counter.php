<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Counter_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function insert_online($ip, $ua, $location, $uid, $time) {
        $exists = $this->db->query("SELECT COUNT(*) FROM online WHERE ip = '$ip'")->fetchColumn() == 1;
        if($exists) {
            $sth = $this->db->prepare('UPDATE online SET ip = ?, ua = ?, location = ?, uid = ?, time = ? WHERE ip = ?');
            return $sth->execute(array($ip, $ua, $location, $uid, $time, $ip));
        } else {
            $sth = $this->db->prepare('INSERT INTO online VALUES(?,?,?,?,?)');
            return $sth->execute(array($ip, $ua, $location, $uid, $time));
        }
    }
    
    public function update_online_counter() {
        $del_time = time();
        $today_time = mktime(0, 0, 0);
        return $this->db->exec(
            'DELETE FROM online WHERE time < ' . ($del_time - 300) . ';'
          . 'UPDATE counter SET today = 0, time = ' . $today_time . ' WHERE time != ' . $today_time . ';'
          . 'UPDATE counter SET today = today + 1, total = total + 1'
        );
    }
    
    public function get_data() {
        return $this->db->query(
            'SELECT '
          . '(SELECT COUNT(DISTINCT ip) FROM online) AS online, '
          . '(SELECT COUNT(DISTINCT uid) FROM online WHERE uid != 0) AS member, '
          . '(SELECT COUNT(DISTINCT ip) FROM online WHERE uid = 0) AS guest, '
          . '(SELECT today FROM counter) AS today, '
          . '(SELECT total FROM counter) AS total'
        )->fetch(PDO::FETCH_ASSOC);
    }

}