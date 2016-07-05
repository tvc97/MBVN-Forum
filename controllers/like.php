<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Like extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index() {
        header('Location: ' . URL);
    }
    
    public function do_like($id = -1) {
        if($id == -1) {
            header('Location: ' . URL);
            exit;
        }
        
        $id = (int)$id;
        $this->loadModel('Like');
        
        $post = $this->model->post_info($id);
        if(!$this->model->post_exists($id)) {
            $this->_error('Bài viết không tồn tại.');
        }
        
        if($this->model->already_like($id)) {
            $this->_error('Bạn đã thích bài viết này trước đó.');
        }
        
        $this->model->like($post['post_id'], $post['user_id']);
        header('Location: ' .URL . '/threads/' . Helper::mkURL($post['thread_name'], $post['thread_id']) . '/?liked');
    }
    
    public function un_like($id = -1) {
        if($id == -1) {
            header('Location: ' . URL);
            exit;
        }
        
        $id = (int) $id;
        $this->loadModel('Like');
        
        $post = $this->model->post_info($id);
        if(!$this->model->post_exists($id)) {
            $this->_error('Bài viết không tồn tại.');
        }
        
        if(!$this->model->already_like($id)) {
            $this->_error('Bạn chưa thích bài viết này trước đó.');
        }
        
        $this->model->un_like($post['post_id'], $post['user_id']);
        header('Location: ' .URL . '/threads/' . Helper::mkURL($post['thread_name'], $post['thread_id']) . '/?unliked');
    }
    
}