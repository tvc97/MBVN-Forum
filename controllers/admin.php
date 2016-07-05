<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Admin extends Controller {

    function __construct() {
        parent::__construct();

        if (!$this->user->isLoged) {
            $this->_error('Bạn không có quyền truy cập vào trang này.');
        }

        if ($this->user->level < 10) {
            $this->_error('Bạn không có quyền truy cập vào trang này.');
        }
    }

    public function index() {
        $this->view->load('admin/index');
    }
    
    public function stats() {
        $this->view->title = 'Thống kê toàn diện';
        $this->view->bar = array(URL . '/admin/' => 'Admin panel');
        $this->loadModel('Admin');
        $this->view->data = $this->model->stats();
        $this->view->load('admin/stats');
    }

    public function ip_banned() {

        if (isset($_GET['del'])) {
            $ip = trim($_GET['del']);
            $content = file(ROOT . '/system_logs/ip_banned.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $content = array_diff($content, array($ip));

            file_put_contents(ROOT . '/system_logs/ip_banned.txt', implode("\n", $content) . "\n");
            $this->view->msg = 'Đã xóa IP.';
        }

        $content = file(ROOT . '/system_logs/ip_banned.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $n = count($content);

        if ($n == 0) {
            $this->_error('Không có ip nào bị khóa.');
        }

        $this->view->data = $content;
        $this->view->title = 'IP bị khóa';
        $this->view->load('admin/ip_banned');
    }

    public function hash_banned() {
        
    }

/*    public function update_code() {
        $this->view->bar = array(URL . '/admin/' => 'Admin panel', URL . '/admin/update_code' => 'Update code');

        if (!isset($_POST['submit'])) {
            $this->view->bar = array(URL . '/admin/' => 'Admin panel');
            $this->view->load('admin/update_code');
            exit;
        }

        if ($_FILES['f']['error'] != UPLOAD_ERR_OK) {
            $this->_error('Lỗi trong quá trình upload.');
        }

        if (!move_uploaded_file($_FILES['f']['tmp_name'], ROOT . '/update.zip')) {
            $this->_error('Lỗi trong quá trình di chuyển.');
        }

        $z = new ZipArchive();
        if ($z->open(ROOT . '/update.zip', ZipArchive::CHECKCONS) !== true) {
            unlink(ROOT . '/update.zip');
            $this->_error('Lỗi trong khi mở file');
        }

        if (!$z->extractTo(ROOT . '/update')) {
            $this->_error('Lỗi trong khi giải nén');
        }

        unlink(ROOT . '/update.zip');

        if (!file_exists(ROOT . '/update/update.map')) {
            Helper::rmdir(ROOT . '/update');
            $this->_error('Missing file "update.map"');
        }

        $map = file(ROOT . '/update/update.map', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($map as $path) {
            Helper::rmdir(ROOT . $path);
            rename(ROOT . '/update' . $path, ROOT . $path);
        }
        Helper::rmdir(ROOT . '/update');
        Helper::re_chmod();

        $this->view->bar = array(URL . '/admin/' => 'Admin panel');
        $this->view->msg = 'Đã update code';
        $this->view->title = 'Update code';
        $this->view->load('admin/update_code');
    }
*/

    public function edit_level($id = -1) {
        if ($id == -1) {
            $this->_error('Missing variable.');
        }

        if (!isset($_GET['level'])) {
            $this->_error('Missing variable.');
        }

        $this->loadModel('Admin');
        $ulevel = $this->model->user_info($id);
        if ($ulevel['level'] >= $this->user->level) {
            $this->_error('Bạn không có quyền sửa thành viên này.');
        }

        if (!$this->model->id_exists($id)) {
            $this->_error('Thành viên không tồn tại.');
        }

        if ($this->model->edit_level($id, (int) $_GET['level'])) {
            header('Location: ' . URL . '/members/a.' . $id . '?edited');
        } else {
            $this->_error('Đã xảy ra lỗi.');
        }
    }

    /*
    public function backup_code() {
        $dir = ROOT . '/files/admin/backup/code/';
        if (isset($_GET['generate'])) {
            $fs = Helper::get_all_path(ROOT);
            $zip = new ZipArchive();
            $zip->open($dir . 'backup_' . date('H_i_s_d_m_Y') . '.zip', ZipArchive::CREATE);
            foreach ($fs as $f) {
                if (is_dir($f)){
                    $zip->addEmptyDir(str_replace(ROOT, '', $f));
                } else {
                    $zip->addFile($f, str_replace(ROOT, '', $f));
                }
            }
            $zip->close();
            Helper::re_chmod();
            $this->view->msg = 'Đã backup.';
        }

        if (isset($_GET['del'])) {
            $file = filter_var($_GET['f'], FILTER_SANITIZE_URL);
            $file = $dir . $file;
            if (!file_exists($file))
                $this->view->msg = 'File không tồn tại.';
            else {
                if (unlink($file))
                    $this->view->msg = 'Đã xóa.';
                else
                    $this->view->msg = 'Lỗi trong quá trình xóa.';
            }
        }

        $fs = glob($dir . '*.zip');
        $this->view->fs = $fs;

        $this->view->title = 'Backup code';
        $this->view->bar = array(URL . '/admin/' => 'Admin panel');
        $this->view->load('admin/backup_code');
    }
     */

    public function backup_db() {
        if ($this->user->level <= 10) {
            $this->_error('Bạn không có quyền truy cập vào trang này.');
        }

        $dir = ROOT . '/files/admin/backup/db/';
        if (isset($_GET['generate'])) {
            require ROOT . '/libs/Mysqldump.php';
            $dump = new Mysqldump(DB_NAME, DB_USER, DB_PASSWORD, DB_HOST, 'mysql', array('lock-tables' => false, 'add-locks' => false, 'add-drop-table' => true));
            $db_path = $dir . 'backup_' . date('H_i_s_d_m_Y') . '.sql';
            fclose(fopen($db_path, 'w'));
            $dump->start($db_path);
            $this->view->msg = 'Đã backup.';
        }

        if (isset($_GET['del'])) {
            $file = filter_var($_GET['f'], FILTER_SANITIZE_URL);
            $file = $dir . $file;
            if (!file_exists($file))
                $this->view->msg = 'File không tồn tại.';
            else {
                if (unlink($file))
                    $this->view->msg = 'Đã xóa.';
                else
                    $this->view->msg = 'Lỗi trong quá trình xóa.';
            }
        }

        $fs = glob($dir . '*.sql');
//        sort($fs, SORT_ASC);
        $this->view->fs = array_reverse($fs);

        $this->view->title = 'Backup code';
        $this->view->bar = array(URL . '/admin/' => 'Admin panel');
        $this->view->load('admin/backup_db');
    }

    public function update_db() {
        if ($this->user->level <= 10) {
            $this->_error('Bạn không có quyền truy cập vào trang này.');
        }

        $this->view->bar = array(URL . '/admin/' => 'Admin panel', URL . '/admin/update_db/' => 'Update database');

        if (!isset($_POST['submit'])) {
            $this->view->bar = array(URL . '/admin/' => 'Admin panel');
            $this->view->load('admin/update_db');
            exit;
        }

        if ($_FILES['f']['error'] != UPLOAD_ERR_OK) {
            $this->_error('Lỗi trong quá trình upload.');
        }

        $sql = file_get_contents($_FILES['f']['tmp_name']);
        unlink($_FILES['f']['tmp_name']);
        
        $this->getDefaultModel();
        if($this->model->db->exec($sql) != 0) {
            $this->_error('Lỗi trong quá trình update.');
        }

        $this->view->bar = array(URL . '/admin/' => 'Admin panel');
        $this->view->msg = 'Đã update db';
        $this->view->title = 'Update db';
        $this->view->load('admin/update_db');
    }

    public function get_db() {
        $dir = ROOT . '/files/admin/backup/db/';
        $file = filter_var($_GET['f'], FILTER_SANITIZE_URL);
        $file = $dir . $file;
        header('Content-type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        echo file_get_contents($file);
    }

    public function get_code() {
        $dir = ROOT . '/files/admin/backup/code/';
        $file = filter_var($_GET['f'], FILTER_SANITIZE_URL);
        $file = $dir . $file;
        header('Content-type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        echo file_get_contents($file);
    }

    public function cats() {
        if ($this->user->level <= 10) {
            $this->_error('Bạn không có quyền truy cập vào trang này.');
        }

        $this->loadModel('Admin');
        $data = $this->model->get_cats();
        $root = array();
        $subcat = array();
        foreach ($data as $a) {
            if ($a['parent'] == 0) {
                $root[$a['cat_id']] = $a['cat_name'];
            } else {
                $subcat[$a['parent']][$a['cat_id']] = $a['cat_name'];
            }
        }
        $this->view->map = array('root' => $root, 'subcat' => $subcat);
        $this->view->title = 'Quản lý chuyên mục';
        $this->view->load('admin/cats');
    }

    public function add_root_cat() {
        if (isset($_POST['name'])) {
            $cat_name = $_POST['name'];

            if (strlen($cat_name) < 3) {
                $this->view->error = 'Tên chuyên mục quá ngắn.';
            } else {
                $this->loadModel('Admin');
                if ($this->model->add_root_cat($cat_name)) {
                    header('Location: ' . URL . '/admin/cats/?added');
                    exit;
                } else {
                    $this->_error('Đã xảy ra lỗi.');
                }
            }
        }
        $this->view->title = 'Thêm chuyên mục gốc';
        $this->view->load('admin/add_root_cat');
    }

    public function add_cat($id = -1) {
        if ($id == -1) {
            $this->_error('Missing variable.');
        }

        $id = (int) $id;
        $this->loadModel('Admin');
        if (!$this->model->cat_exists($id)) {
            $this->_error('Chuyên mục không tồn tại.');
        }
        if (!$this->model->is_root_cat($id)) {
            $this->_error('Chỉ được thêm chuyên mục ở chuyên mục gốc.');
        }

        if (isset($_POST['name'])) {
            $cat_name = $_POST['name'];

            if (strlen($cat_name) < 3) {
                $this->view->error = 'Tên chuyên mục quá ngắn.';
            } else {
                if ($this->model->add_cat($id, $cat_name)) {
                    header('Location: ' . URL . '/admin/cats/?added');
                    exit;
                } else {
                    $this->_error('Đã xảy ra lỗi.');
                }
            }
        }

        $this->view->cid = $id;
        $this->view->tile = 'Thêm chuyên mục';
        $this->view->load('admin/add_cat');
    }

    public function del_cat($id = -1) {
        if ($id == -1) {
            $this->_error('Missing variable.');
        }

        $id = (int) $id;
        $this->loadModel('Admin');
        if (!$this->model->cat_exists($id)) {
            $this->_error('Chuyên mục không tồn tại.');
        }

        if ($this->model->is_root_cat($id)) {
            $this->_error('Chuyên mục gốc.');
        }

        if ($this->model->delete_cat($id)) {
            header('Location: ' . URL . '/admin/cats/?deleted');
        } else {
            $this->_error('Đã xảy ra lỗi.');
        }
    }

    public function del_root_cat($id = -1) {
        if ($id == -1) {
            $this->_error('Missing variable.');
        }

        $id = (int) $id;
        $this->loadModel('Admin');
        if (!$this->model->cat_exists($id)) {
            $this->_error('Chuyên mục không tồn tại.');
        }

        if (!$this->model->is_root_cat($id)) {
            $this->_error('Không phải chuyên mục gốc.');
        }

        if ($this->model->delete_root_cat($id)) {
            header('Location: ' . URL . '/admin/cats/?deleted');
        } else {
            $this->_error('Đã xảy ra lỗi.');
        }
    }

    public function edit_cat($id = -1) {
        if ($id == -1) {
            $this->_error('Missing variable.');
        }

        $id = (int) $id;
        $this->loadModel('Admin');
        if (!$this->model->cat_exists($id)) {
            $this->_error('Chuyên mục không tồn tại.');
        }

        if (isset($_POST['name'])) {
            $cat_name = $_POST['name'];

            if (strlen($cat_name) < 3) {
                $this->view->error = 'Tên chuyên mục quá ngắn.';
            } else {
                if ($this->model->edit_cat($id, $cat_name)) {
                    header('Location: ' . URL . '/admin/cats/?edited');
                    exit;
                } else {
                    $this->_error('Đã xảy ra lỗi.');
                }
            }
        }

        $this->view->data = $this->model->cat_info($id);
        $this->view->title = 'Sửa chuyên mục';
        $this->view->load('admin/edit_cat');
    }

}
