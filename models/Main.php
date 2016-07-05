<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Main_Model extends Model {

    public function cat_exists($id) {
        return $this->db->query('SELECT COUNT(*) FROM cats WHERE cat_id = ' . $id)->fetchColumn() == 1;
    }

    public function is_root_cat($id) {
        return $this->db->query('SELECT COUNT(*) FROM cats WHERE parent = 0 AND cat_id = ' . $id)->fetchColumn() == 1;
    }

    public function cat_info($id) {
        return $this->db->query('SELECT * FROM cats WHERE cat_id = ' . $id)->fetch(PDO::FETCH_ASSOC);
    }

    public function thread_exists($id) {
        return $this->db->query('SELECT COUNT(*) FROM threads WHERE thread_id = ' . $id)->fetchColumn() == 1;
    }

    public function thread_info($id) {
        return $this->db->query('SELECT threads.*, cats.cat_id, cats.cat_name FROM threads INNER JOIN cats ON(cats.cat_id = threads.parent) WHERE thread_id = ' . $id)->fetch(PDO::FETCH_ASSOC);
    }

    public function post_exists($id) {
        return $this->db->query('SELECT COUNT(*) FROM posts WHERE post_id = ' . $id)->fetchColumn();
    }

    public function post_info($id) {
        return $this->db->query('SELECT posts.*, users.level, users.user_id, threads.thread_id, threads.thread_name FROM posts INNER JOIN users USING(user_id) INNER JOIN threads ON(threads.thread_id = posts.parent) WHERE post_id = ' . $id)->fetch(PDO::FETCH_ASSOC);
    }

    public function get_new_threads($start, $limit) {
        $thread = $this->db->query('SELECT threads.thread_id, threads.thread_name, threads.time, threads.view, users.user_id, users.user_name, users.level, users.dname FROM threads INNER JOIN posts INNER JOIN users ON(posts.user_id = users.user_id AND posts.time = threads.last) WHERE threads.verified = 1 ORDER BY(threads.last) DESC LIMIT ' . $start . ',' . $limit)->fetchAll(PDO::FETCH_ASSOC);
        $n = count($thread);
        $query = 'SELECT ';

        for ($i = 0; $i < 10 && $i < $n; $i++)
            $query .= '(SELECT COUNT(*) FROM posts WHERE parent = ' . $thread[$i]['thread_id'] . ')' . ' AS num' . $i . ($i == $n - 1 ? '' : ',');
        $numpost = $this->db->query($query)->fetch(PDO::FETCH_ASSOC);

        for ($i = 0; $i < 10 && $i < $n; $i++)
            $thread[$i]['numpost'] = $numpost['num' . $i];
        return $thread;
    }

    public function get_old_threads($start, $limit) {
        $thread = $this->db->query('SELECT threads.thread_id, threads.thread_name, threads.time, threads.view, users.user_id, users.user_name, users.level, users.dname FROM threads INNER JOIN posts INNER JOIN users ON(posts.user_id = users.user_id AND posts.time = threads.last) WHERE threads.verified = 1 ORDER BY(threads.last) ASC LIMIT ' . $start . ',' . $limit)->fetchAll(PDO::FETCH_ASSOC);
        $n = count($thread);
        $query = 'SELECT ';

        for ($i = 0; $i < 10 && $i < $n; $i++)
            $query .= '(SELECT COUNT(*) FROM posts WHERE parent = ' . $thread[$i]['thread_id'] . ')' . ' AS num' . $i . ($i == $n - 1 ? '' : ',');
        $numpost = $this->db->query($query)->fetch(PDO::FETCH_ASSOC);

        for ($i = 0; $i < 10 && $i < $n; $i++)
            $thread[$i]['numpost'] = $numpost['num' . $i];
        return $thread;
    }

    public function get_view_threads($start, $limit) {
        $thread = $this->db->query('SELECT threads.thread_id, threads.thread_name, threads.time, threads.view, users.user_id, users.user_name, users.level, users.dname FROM threads INNER JOIN posts INNER JOIN users ON(posts.user_id = users.user_id AND posts.time = threads.last) WHERE threads.verified = 1 ORDER BY(threads.view) DESC LIMIT ' . $start . ',' . $limit)->fetchAll(PDO::FETCH_ASSOC);
        $n = count($thread);
        $query = 'SELECT ';

        for ($i = 0; $i < 10 && $i < $n; $i++)
            $query .= '(SELECT COUNT(*) FROM posts WHERE parent = ' . $thread[$i]['thread_id'] . ')' . ' AS num' . $i . ($i == $n - 1 ? '' : ',');
        $numpost = $this->db->query($query)->fetch(PDO::FETCH_ASSOC);

        for ($i = 0; $i < 10 && $i < $n; $i++)
            $thread[$i]['numpost'] = $numpost['num' . $i];
        return $thread;
    }

    public function get_threads_by_cat($id, $start, $limit) {
        $thread = $this->db->query('SELECT threads.thread_id, threads.thread_name, threads.time, threads.view, users.user_id, users.user_name, users.level, users.dname FROM threads INNER JOIN posts INNER JOIN users ON(posts.user_id = users.user_id AND posts.time = threads.last) WHERE threads.verified = 1 AND threads.parent = ' . $id . ' ORDER BY(threads.last) DESC LIMIT ' . $start . ',' . $limit)->fetchAll(PDO::FETCH_ASSOC);
        $n = count($thread);
        $query = 'SELECT ';

        for ($i = 0; $i < 10 && $i < $n; $i++)
            $query .= '(SELECT COUNT(*) FROM posts WHERE parent = ' . $thread[$i]['thread_id'] . ')' . ' AS num' . $i . ($i == $n - 1 ? '' : ',');
        $numpost = $this->db->query($query)->fetch(PDO::FETCH_ASSOC);

        for ($i = 0; $i < 10 && $i < $n; $i++)
            $thread[$i]['numpost'] = $numpost['num' . $i];
        return $thread;
    }

    public function get_threads_by_catN($id, $start, $limit) {
        $thread = $this->db->query('SELECT threads.thread_id, threads.thread_name, threads.time, threads.view, users.user_id, users.user_name, users.level, users.dname FROM threads INNER JOIN users ON(threads.user_id = users.user_id) WHERE threads.verified = 1 AND threads.parent = ' . $id . ' ORDER BY(threads.last) DESC LIMIT ' . $start . ',' . $limit)->fetchAll(PDO::FETCH_ASSOC);
        $n = count($thread);
        $query = 'SELECT ';

        for ($i = 0; $i < 10 && $i < $n; $i++)
            $query .= '(SELECT COUNT(*) FROM posts WHERE parent = ' . $thread[$i]['thread_id'] . ')' . ' AS num' . $i . ($i == $n - 1 ? '' : ',');
        $numpost = $this->db->query($query)->fetch(PDO::FETCH_ASSOC);

        for ($i = 0; $i < 10 && $i < $n; $i++)
            $thread[$i]['numpost'] = $numpost['num' . $i];
        return $thread;
    }

    public function get_threads_by_user($id, $start, $limit) {
        $thread = $this->db->query('SELECT threads.thread_id, threads.thread_name, threads.time, threads.view, users.user_id, users.user_name, users.level, users.dname FROM threads INNER JOIN posts INNER JOIN users ON(posts.user_id = users.user_id AND posts.time = threads.last) WHERE threads.verified = 1 AND threads.user_id = ' . $id . ' ORDER BY(threads.last) DESC LIMIT ' . $start . ',' . $limit)->fetchAll(PDO::FETCH_ASSOC);
        $n = count($thread);
        $query = 'SELECT ';

        for ($i = 0; $i < 10 && $i < $n; $i++)
            $query .= '(SELECT COUNT(*) FROM posts WHERE parent = ' . $thread[$i]['thread_id'] . ')' . ' AS num' . $i . ($i == $n - 1 ? '' : ',');
        $numpost = $this->db->query($query)->fetch(PDO::FETCH_ASSOC);

        for ($i = 0; $i < 10 && $i < $n; $i++)
            $thread[$i]['numpost'] = $numpost['num' . $i];
        return $thread;
    }

    public function get_posts_by_thread($id, $start, $limit) {
        return $this->db->query("SELECT posts.*, users.dname, users.user_name, users.user_id, users.level, users.last, users.logout, users.point, users.liked as u_liked, users.beliked FROM posts INNER JOIN users USING(user_id) WHERE parent = $id ORDER BY post_id ASC LIMIT $start, $limit")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_posts_by_user($id, $start, $limit) {
        return $this->db->query("SELECT posts.*, users.* FROM posts INNER JOIN users USING(user_id) WHERE user_id = $id ORDER BY post_id ASC LIMIT $start, $limit")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function users_online() {
        return $this->db->query('SELECT * FROM users WHERE logout = 0 AND last > ' . ( time() - 300 ))->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_cats() {
        return $this->db->query('SELECT * FROM cats WHERE parent = 0')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_cats_by_root($id) {
        $cat = $this->db->query('SELECT * FROM cats WHERE parent = ' . $id)->fetchAll(PDO::FETCH_ASSOC);
        $n = count($cat);
        $query = 'SELECT ';

        for ($i = 0; $i < 10 && $i < $n; $i++)
            $query .= '(SELECT COUNT(*) FROM threads WHERE verified = 1 AND parent = ' . $cat[$i]['cat_id'] . ')' . ' AS num' . $i . ($i == $n - 1 ? '' : ',');
        $numthread = $this->db->query($query)->fetch(PDO::FETCH_ASSOC);

        for ($i = 0; $i < 10 && $i < $n; $i++)
            $cat[$i]['numthread'] = $numthread['num' . $i];
        return $cat;
    }
    
    public function get_chats() {
        return $this->db->query('SELECT chat.*, users.* FROM chat INNER JOIN users USING(user_id) ORDER BY chat.chat_id DESC LIMIT 5')->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function chatbox_thread($name, $url) {
        $color = Helper::level_color($this->user->level);
        $time = time();
        $content = "[color=$color]{$this->user->dname}[/color] Đăng chủ đề mới => [url=$url]{$name}[/url]";
        $sth = $this->db->prepare("INSERT INTO chat(user_id, content, time) VALUES(4, ?,$time)");
        return $sth->execute(array($content));
    }

    public function chatbox_thread_user($uid, $name, $url) {
        $u = $this->user_info($uid);
        $color = Helper::level_color($u['level']);
        $time = time();
        $content = "[color=$color]{$u['dname']}[/color] Đăng chủ đề mới => [url=$url]{$name}[/url]";
        $sth = $this->db->prepare("INSERT INTO chat(user_id, content, time) VALUES(4, ?,$time)");
        return $sth->execute(array($content));
    }

    public function root_info($id) {
        return $this->db->query('SELECT r.cat_name AS cat_name, r.cat_id AS cat_id FROM cats AS r INNER JOIN cats as s ON (r.cat_id = s.parent) WHERE s.cat_id = ' . $id)->fetch(PDO::FETCH_ASSOC);
    }

    public function stats() {
        $time = mktime(0, 0, 0);
        return $this->db->query('SELECT (SELECT COUNT(user_id) FROM users WHERE reg > ' . $time . ') AS numNewUser, (SELECT COUNT(user_id) FROM users) AS num_user, (SELECT COUNT(thread_id) FROM threads) AS numThread, (SELECT COUNT(post_id) FROM posts) AS numPost')->fetch(PDO::FETCH_ASSOC);
    }

    public function num_threads() {
        return $this->db->query('SELECT COUNT(thread_id) FROM threads')->fetchColumn();
    }

    public function num_threads_by_cat($id) {
        return $this->db->query('SELECT COUNT(*) FROM threads WHERE verified = 1 AND parent = ' . $id)->fetchColumn();
    }

    public function num_threads_by_user($id) {
        return $this->db->query('SELECT COUNT(thread_id) FROM threads WHERE verified = 1 AND user_id = ' . $id)->fetchColumn();
    }

    public function num_posts() {
        return $this->db->query('SELECT COUNT(post_id) FROM posts')->fetchColumn();
    }

    public function num_posts_by_thread($id) {
        return $this->db->query('SELECT COUNT(post_id) FROM posts WHERE parent = ' . $id)->fetchColumn();
    }

    public function num_posts_by_user($id) {
        return $this->db->query('SELECT COUNT(post_id) FROM posts WHERE user_id = ' . $id)->fetchColumn();
    }
    
    public function liked($id) {
        return $this->db->query("SELECT users.*, likes.like_id FROM likes INNER JOIN users USING(user_id) WHERE likes.post_id = $id")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete_post($id) {
        return $this->db->exec("DELETE FROM posts WHERE post_id = $id");
    }

    public function update_last_post($id) {
        return $this->db->exec("UPDATE threads SET last = (SELECT MAX(time) FROM posts WHERE parent = $id) WHERE thread_id = $id");
    }

    public function update_post($id, $content) {
        $sth = $this->db->prepare("UPDATE posts SET content = ? WHERE post_id = $id");
        return $sth->execute(array($content));
    }
    
    public function subcat_tree() {
        return $this->db->query('SELECT s.cat_id as scat_id, s.cat_name as scat_name, r.cat_id as rcat_id, r.cat_name as rcat_name FROM cats as s INNER JOIN cats as r ON(s.parent = r.cat_id) WHERE r.parent = 0 AND s.parent != 0 ORDER BY s.parent ASC')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_post($id, $content) {
        $var = Helper::generate_client_info();
        $this->db->exec("UPDATE users SET point = point + 3 WHERE user_id = {$this->user->user_id}");
        $sth = $this->db->prepare("INSERT INTO posts (user_id, content, parent, time, vars) VALUES(?,?,?,?,?)");
        return $sth->execute(array($this->user->user_id, $content, $id, time(), $var));
    }

    public function insert_thread($id, $title) {
        $sth = $this->db->prepare("INSERT INTO threads (parent, thread_name, user_id, time, last, verified) VALUES(?,?,?,?,?,?)");
        $this->db->exec("UPDATE users SET point = point + 7 WHERE user_id = {$this->user->user_id}");
        $sth->execute(array($id, $title, $this->user->user_id, time(), time(), $this->user->level >= 5 ? 1 : 0));
        return $this->db->lastInsertId();
    }
    
    public function update_views($id) {
        return $this->db->exec("UPDATE threads SET view = view + 1 WHERE thread_id = $id");
    }
    
    public function verify_thread($id) {
        return $this->db->exec("UPDATE threads SET verified = 1 WHERE thread_id = $id");
    }
    
    public function is_verified($id) {
        return $this->db->query("SELECT verified FROM threads WHERE thread_id = $id")->fetchColumn() == 1;
    }
    
    public function get_unverified_threads() {
        return $this->db->query('SELECT users.dname, users.user_id, users.user_name, threads.* FROM threads INNER JOIN users USING(user_id) WHERE threads.verified = 0')->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function delete_thread($id) {
        return $this->db->exec("DELETE FROM threads WHERE thread_id = $id")
            && $this->db->exec("DELETE FROM posts WHERE parent = $id");
    }
    
    public function edit_thread($cat, $id, $content) {
        $sth = $this->db->prepare("UPDATE threads SET thread_name = ?, parent = ? WHERE thread_id = $id");
        return $sth->execute(array($content, $cat));
    }

    public function same_cat_threads($cat_id, $thread_id) {
        return $this->db->query("SELECT * FROM threads WHERE thread_id != $thread_id AND parent = $cat_id ORDER BY RAND() LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function viewing_thread($thread_url) {
        $data = array();
        $count = $this->db->query("SELECT (SELECT COUNT(DISTINCT ip) FROM online WHERE location LIKE '%$thread_url%') AS total, (SELECT COUNT(DISTINCT ip) FROM online WHERE location LIKE '%$thread_url%' AND uid != 0) AS member, (SELECT COUNT(DISTINCT ip) FROM online WHERE location LIKE '%$thread_url%' AND uid = 0) AS guest")->fetch(PDO::FETCH_ASSOC);
        if($count['member'] != 0) {
            $data['member'] = $this->db->query("SELECT DISTINCT online.ip, users.* FROM online INNER JOIN users ON(users.user_id = online.uid) WHERE online.location LIKE '%$thread_url%'")->fetchAll(PDO::FETCH_ASSOC);
        }
        $data['view'] = $count;
        return $data;
    }

}
