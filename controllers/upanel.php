<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Upanel extends Controller {

    function __construct() {
        parent::__construct();

        /*
         * Deny guest
         */
        if (!$this->user->isLoged) {
            $this->_error = 'Lỗi! Bạn chưa đăng nhập.';
        }

    }

    public function index() {
        $this->view->title = 'Trang cá nhân';
        $this->view->load('upanel/index');
    }

    /*
     * Edit profile
     */
    public function profile() {
        $err = false;
        if (isset($_POST['submit'])) {
            $avatar = false;
            $email = $_POST['email'];
            $gender = $_POST['gender'] == 'female' ? 2 : 1;
            $dob = implode('/', array($_POST['date'], $_POST['month'], $_POST['year']));

            if ($_FILES['avatar']['error'] != 0 && $_FILES['avatar']['error'] != 4) {
                $err[] = 'Lỗi trong quá trình tải lên ảnh đại diện.';
            } elseif ($_FILES['avatar']['error'] == 0) {
                $avatar = imagecreatefromstring(file_get_contents($_FILES['avatar']['tmp_name']));

                if (!$avatar) {
                    $err[] = 'Định dạng ảnh lỗi';
                } else {
                    $info = getimagesize($_FILES['avatar']['tmp_name']);
                    $avatar = Helper::resize_image($avatar, 128, 128, $info);
                    imagepng($avatar, ROOT . '/public/img/avatar/' . $this->user->user_id . '.png');
                    imagedestroy($avatar);
                }
                unlink($_FILES['avatar']['tmp_name']);
            }

            if (!Helper::valid_email($email)) {
                $err[] = 'Email không hợp lệ.';
            }

            if (!Helper::valid_dob($dob)) {
                $err[] = 'Lỗi, Bạn là siêu nhân.';
            }

            $this->loadModel('Upanel');
            if ($this->model->email_exists($email) && $email != $this->user->email) {
                $err[] = 'Email đã có người sử dụng';
            }

            if (!$err) {
                $this->model->update_profile($this->user->user_id, $email, $gender, $dob);
                $this->user->updateData();
                $this->view->msg = 'Đã sửa hồ sơ.';
            } else {
                $this->view->err = $err[0];
            }
        }
        $this->view->title = 'Sửa hồ sơ';
        $this->view->bar = array(URL . '/upanel/' => 'Trang cá nhân');
        $this->view->load('upanel/profile');
    }

    /*
     * Change password
     */
    public function password() {
        if (isset($_POST['submit'])) {
            $old = $_POST['old'];
            $new = $_POST['new'];
            $rnew = $_POST['rnew'];

            if (Hash::generate('md5', $old, PWD_KEY) != $this->user->user_passwd) {
                $this->view->err = 'Mật khẩu cũ không chính xác.';
            } elseif (strlen($new) < 1) {
                $this->view->err = 'Vui lòng nhập mật khẩu mới.';
            } elseif ($new != $rnew) {
                $this->view->err = 'Nhập lại mật khẩu không chính xác.';
            } else {
                $this->view->msg = 'Đổi mật khẩu thành công.';

                $hash = Hash::generate('sha512', $this->user->user_name . ';' . $new, PWD_KEY);
                $password = Hash::generate('md5', $new, PWD_KEY);
                setcookie('hash', $hash, time() + 3600 * 24 * 365, '/');

                $this->loadModel('Upanel');
                $this->model->update_user($this->user->user_id, $password, $hash);
            }
        }
        $this->view->bar = array(URL . '/upanel/' => 'Trang cá nhân');
        $this->view->title = 'Đổi mật khẩu';
        $this->view->load('upanel/password');
    }

    /*
     * Delete post
     */
    public function post_del($id = -1) {
        if ($id == -1) {
            header('Location: ' . URL);
            exit;
        }

        if ($this->user->level < 5) {
            $this->_error('Bạn không có quyền xóa bài viết.');
        }

        $id = (int) $id;
        $this->loadModel('Main');
        if (!$this->model->post_exists($id)) {
            $this->_error('Bài viết không tồn tại.');
        }

        $post = $this->model->post_info($id);
        if ($post['level'] >= $this->user->level && $this->user->user_id != $post['user_id']) {
            $this->_error('Bạn không có quyền xóa bài viết này.');
        }

        if(!isset($_GET['confirm'])) {
            $this->view->title = 'Xóa bài viết';
            $this->view->text = substr($post['content'], 0, 50) . '... ';
            $this->view->confirm_url = URL . '/upanel/post_del/' . $id . '/?confirm';
            $this->view->return_url = URL . '/threads/back.' . $post['parent'];
            $this->view->load('confirm_box/del_post');
            exit;
        }

        $this->model->delete_post($id);

        $this->model->update_last_post($post['parent']);

        header('Location: ' . URL . '/threads/' . Helper::mkURL($post['thread_name'], $post['thread_id']) . '?del');
    }

    /*
     * Edit post
     */
    public function post_edit($id = -1) {
        if ($id == -1) {
            header('Location: ' . URL);
            exit;
        }

        $id = (int) $id;
        $this->loadModel('Main');
        if (!$this->model->post_exists($id)) {
            $this->_error('Bài viết không tồn tại.');
        }

        $post = $this->model->post_info($id);

        if ($this->user->user_id != $post['user_id'] && ($this->user->level >= 10 && $post['level'] >= 10 && $this->user->user_id != $post['user_id'])) {
            $this->_error('Bạn không có quyền sửa bài viết này.');
        }

        if (isset($_POST['submit'])) {
            if ($this->model->update_post($id, $_POST['content'])) {
                $this->view->msg = 'Đã sửa bài viết.';
                $post = $this->model->post_info($id);
            } else {
                $this->view->msg = 'Xảy ra lỗi.';
            }
        }

        $this->view->title = 'Sửa bài viết';
        $this->view->data = $post;
        $this->view->load('main/post_edit');
    }

    /*
     * Post a comment
     */
    public function post_add($id = -1) {
        if ($id == -1) {
            header('Location: ' . URL);
            exit;
        }

        if (!isset($_POST['content'])) {
            $this->_error('Trường nhập không xác định.');
        }

        if (strlen($_POST['content']) < 3) {
            $this->_error('Nội dung quá ngắn.');
        }

        $id = (int) $id;
        $this->loadModel('Main');
        if (!$this->model->thread_exists($id)) {
            $this->_error('Chủ đề không tồn tại.');
        }

        $thread = $this->model->thread_info($id);

        if ($thread['verified'] == 0) {
            $this->_error('Chủ đề chưa được kiểm duyệt.');
        }

        if ($this->model->insert_post($id, $_POST['content'])) {
            $npage = ceil($this->model->num_posts_by_thread($id) / PPP);
            if ($npage > 1) {
                header('Location: ' . URL . '/threads/' . Helper::mkURL($thread['thread_name'], $thread['thread_id']) . '/page-' . $npage);
            } else {
                header('Location: ' . URL . '/threads/' . Helper::mkURL($thread['thread_name'], $thread['thread_id']));
            }
        }

        $this->model->update_last_post($id);
    }

    /*
     * Post new thread
     */
    public function thread_post($id = -1) {
        if ($id == -1) {
            header('Location: ' . URL);
            exit;
        }

        $id = (int) $id;

        $this->loadModel('Main');

        if (!$this->model->cat_exists($id)) {
            $this->_error('Chuyên mục không tồn tại.');
        }

        if ($this->model->is_root_cat($id)) {
            $this->_error('Không được đăng chủ đề mới ở chuyên mục gốc.');
        }

        if (isset($_POST['submit'])) {
            if (!isset($_POST['title']) || !isset($_POST['content'])) {
                $this->_error('Đã xảy ra lỗi.');
            }

            $title = $_POST['title'];
            $content = $_POST['content'];

            if (strlen($title) < 5) {
                $this->view->error = 'Tiêu đề quá ngắn.';
            } else if (strlen($content) < 50) {
                $this->view->error = 'Nội dung quá ngắn.';
            } else {
                $tid = $this->model->insert_thread($id, $title, $content);
                $this->model->insert_post($tid, $content);
                $this->model->update_last_post($tid);
                if($this->user->level >= 5)
                    $this->model->chatbox_thread($title, '/threads/' . Helper::mkURL($title, $tid) . '/');

                header('Location: ' . URL . '/threads/' . Helper::mkURL($title, $tid));
            }
        }

        $cat = $this->model->cat_info($id);
        $root = $this->model->root_info($id);
        $this->view->bar = array(URL . '/cats/' . Helper::mkURL($root['cat_name'], $root['cat_id']) => $root['cat_name'], URL . '/cats/' . Helper::mkURL($cat['cat_name'], $cat['cat_id']) => $cat['cat_name']);
        $this->title = 'Đăng chủ đề';
        $this->view->cat = $cat;

        $this->view->load('main/thread_post');
    }
    
    /*
     * Delete thread
     */
    public function thread_del($id = -1) {
        if($this->user->level <5) {
            $this->_error('Bạn không có quyền truy cập trang này.');
        }

        if($id == -1) {
            $this->_error('Missing varibale.');
        }
        
        $id = (int) $id;
        $this->loadModel('Main');
        
        if(!$this->model->thread_exists($id)) {
            $this->_error('Chủ đề không tồn tại hoặc đã bị xóa.');
        }
        
        $thread = $this->model->thread_info($id);
        $ulevel = $this->model->user_info($thread['user_id']);
        if($thread['user_id'] != $this->user->user_id && ($this->user->level < $ulevel['level'])) {
            $this->_error('Bạn không có quyền xóa chủ đế này.');
        }
        
        if(!isset($_GET['confirm'])) {
            $this->view->title = 'Xóa chủ đề';
            $this->view->text = $thread['thread_name'];
            $this->view->confirm_url = URL . '/upanel/thread_del/' . $id . '/?confirm';
            $this->view->return_url = URL . '/threads/back.' . $thread['thread_id'];
            $this->view->load('confirm_box/del_thread');
            exit;
        }
        
        if($this->model->delete_thread($id)) {
            header('Location: ' . URL . '/?deleted_thread');
        }else{
            $this->_error('Đã xảy ra lỗi');
        }
    }

    /*
     * Edit thread (name, category only)
     */
    public function thread_edit($id = -1) {
        if($this->user->level <5) {
            $this->_error('Bạn không có quyền truy cập trang này.');
        }

        if($id == -1) {
            $this->_error('Missing varibale.');
        }
        
        $id = (int) $id;
        $this->loadModel('Main');
        
        if(!$this->model->thread_exists($id)) {
            $this->_error('Chủ đề không tồn tại hoặc đã bị xóa.');
        }
        
        $thread = $this->model->thread_info($id);
        $ulevel = $this->model->user_info($thread['user_id']);
        if($thread['user_id'] != $this->user->user_id && ($this->user->level < $ulevel['level'])) {
            $this->_error('Bạn không có quyền sửa chủ đế này.');
        }

        if(isset($_POST['submit'])) {
            if (!isset($_POST['title'])) {
                $this->_error('Missing varibale.');
            }
            
            $content = $_POST['title'];
            if(strlen($content) < 5) {
                $this->_error('Tiêu đề quá ngắn.');
            }
            $cat = (int) $_POST['cat'];
            if(!$this->model->cat_exists($cat)) {
                $this->_error('Chuyên mục không tồn tại.');
            }
            if($this->model->is_root_cat($cat)) {
                $this->_error('Không thể chọn chuyên mục gốc');
            }
            
            if($this->model->edit_thread($cat, $id, $content)) {
                $thread = $this->model->thread_info($id);
                header('Location: ' . URL . '/threads/' . Helper::mkURL($thread['thread_name'], $thread['thread_id']) . '?thread_edited');
            }else{
                $this->_error('Đã xảy ra lỗi.');
            }
        }
        $this->view->title = 'Sửa chủ đề';

        $this->view->data = $this->model->thread_info($id);
        $this->view->cat_tree = $this->model->subcat_tree();
        $this->view->load('upanel/thread_edit');
        
    }
    
    /*
     * Verify thread
     */
    public function verify($id = -1) {
        if ($this->user->level < 5) {
            $this->_error('Bạn không có quyền truy cập trang này.');
        }

        $this->loadModel('Main');

        if ($id == -1) {
            if ($this->user->unverify == 0) {
                $this->_error('Không có chủ đề chưa kiểm duyệt.');
            }

            $this->view->data = $this->model->get_unverified_threads();
            $this->view->load('upanel/verify');
        } else {
            $id = (int) $id;
            if (!$this->model->thread_exists($id)) {
                $this->_error('Chủ đề không tồn tại hoặc đã bị xóa.');
            }

            if ($this->model->is_verified($id)) {
                $this->_error('Chủ đề đã được kiểm duyệt trước đó.');
            }

            if ($this->model->verify_thread($id)) {
                $t = $this->model->thread_info($id);
                $title = $t['thread_name'];
                $tid = $t['thread_id'];
                $this->model->chatbox_thread_user($t['user_id'], $title, '/threads/' . Helper::mkURL($title, $tid) . '/');
                header('Location: ' . URL . '/upanel/verify/?ok');
            } else {
                $this->_error('Đã xảy ra lỗi.');
            }
        }
    }

}
