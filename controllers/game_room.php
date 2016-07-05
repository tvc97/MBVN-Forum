<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Game_Room extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view->title = 'Phòng Game';
        $this->view->load('game_room/index');
    }

    public function altp($stop = null) {
        $this->view->bar = array(URL . '/game_room/' => 'Phòng Game');
        $this->view->title = 'Ai là triệu phú';

        if (!$this->user->isLoged) {
            $this->_error('Bạn cần đăng nhập để chơi');
        }
        $point_level = array(0, 5, 10, 20, 30, 50, 75, 100, 130, 160, 200, 250, 300, 360, 430, 500);
        $this->view->css = array('game/altp.css');

        $this->loadModel('Game_Room');

        if ($stop == 'stop') {
            if (!$this->model->altp_already($this->user->user_id)) {
                $this->_error('Lỗi');
            }
            $data = $this->model->altp_data($this->user->user_id);
            $vars = unserialize($data['vars']);
            $mode = $vars['mode'];

            if ($mode != 'started' && $mode != 'next') {
                $this->_error('Lỗi');
            }

            $this->model->altp_update($this->user->user_id, serialize(array('mode' => 'over')), time());
            $point = $point_level[$vars['level'] - 1];
            $this->view->level = $vars['level'] - 1;
            $this->view->point = $point;
            $this->model->add_point($this->user->user_id, $point);
            $this->model->chatbox_notify('[color=' . Helper::level_color($this->user->level) . ']'. $this->user->dname . '[/color] vừa dừng cuộc chơi [b]Ai là triệu phú[/b]' . ($vars['level'] - 1 == 0 ? ' không trả lời đúng câu hỏi nào, tay trắng :3' : (' vượt qua câu hỏi số ' . ($vars['level']) . ' với số điểm: ' . $point)));
            $this->view->load('game_room/altp/give_up');
            exit;
        }

        if (!$this->model->altp_already($this->user->user_id)) {
            $this->model->altp_insert($this->user->user_id, serialize(array('mode' => 'start')), time());
            $this->view->load('game_room/altp/faq');
            exit;
        }

        $data = $this->model->altp_data($this->user->user_id);
        $vars = unserialize($data['vars']);
        $mode = $vars['mode'];

        if ($mode == 'over') {
            if (time() - $data['time'] < 86400) {
                $h = floor((86400 - time() + $data['time']) / 3600);
                $m = floor(((86400 - time() + $data['time']) % 3600) / 60);
                $s = (86400 - time() + $data['time']) % 60;
                $h = $h < 10 ? '0' . $h : $h;
                $m = $m < 10 ? '0' . $m : $m;
                $s = $s < 10 ? '0' . $s : $s;
                $this->view->tleft = $h . ':' . $m . ':' . $s;
                $this->view->load('game_room/altp/back_soon');
                exit;
            } else {
                if(isset($_GET['start'])) {
                    $mode = 'start';
                } else {
                    $this->view->load('game_room/altp/wellcome_back');
                    exit;
                }
            }
        }

        if ($mode == 'start') {
            if (!isset($_GET['start'])) {
                $this->view->load('game_room/altp/faq');
            } else {
                $fs = glob(ROOT . '/other/altp/1/*.txt');
                $f = $fs[array_rand($fs)];
                $content = file($f);
                $answer = trim($content[5]);
                $fn = basename($f);

                $this->view->data = array(
                    'level' => 1,
                    'question' => $content[0],
                    'a' => $content[1],
                    'b' => $content[2],
                    'c' => $content[3],
                    'd' => $content[4],
                    'money' => '0$ - ' . $point_level[1] . '$',
                    'tleft' => '1:0'
                );
                $this->view->altp_answer = $vars['answer'];

                $this->view->load('game_room/altp/index');

                $this->model->altp_update(
                        $this->user->user_id, serialize(array(
                    'mode' => 'started',
                    'level' => 1,
                    'file' => $fn,
                    'answer' => $answer
                        )), time()
                );
            }
            exit;
        }

        if ($mode == 'next') {
            if (!isset($_GET['next'])) {
                $landmark = floor(($vars['level'] - 1) / 5);
                $point = $point_level[$vars['level']];
                $this->view->level = $vars['level'];
                $this->view->point = $point;
                $this->view->sure = $point_level[$landmark * 5];
                $this->view->next = $point_level[$vars['level'] + 1];
                $this->view->landmark = $landmark;
                $this->view->load('game_room/altp/next');
            } else {
                $level = $vars['level'] + 1;
                $fs = glob(ROOT . '/other/altp/' . $level . '/*.txt');
                $f = $fs[array_rand($fs)];
                $content = file($f);
                $answer = trim($content[5]);
                $fn = basename($f);

                $this->view->data = array(
                    'level' => $level,
                    'question' => $content[0],
                    'a' => $content[1],
                    'b' => $content[2],
                    'c' => $content[3],
                    'd' => $content[4],
                    'money' => $point_level[$level - 1] . '$ - ' . $point_level[$level] . '$',
                    'tleft' => '1:0'
                );
                $this->view->altp_answer = $vars['answer'];

                $this->view->load('game_room/altp/index');

                $this->model->altp_update(
                    $this->user->user_id, serialize(array(
                        'mode' => 'started',
                        'level' => $level,
                        'file' => $fn,
                        'answer' => $answer
                    )), time()
                );
            }
            exit;
        }

        if ($mode == 'started') {
            if (time() - $data['time'] > 60) {
                $this->model->altp_update(
                        $this->user->user_id, serialize(array(
                    'mode' => 'over',
                        )), time()
                );
                $landmark = floor(($vars['level'] - 1) / 5);
                $point = $point_level[$landmark * 5];

                if ($landmark > 0) {
                    $this->model->add_point($this->user->user_id, $point);
                }

                $this->model->altp_update($this->user->user_id, serialize(array('mode' => 'over')), time());

                $this->view->point = $point;
                $this->view->landmark = $landmark;
                $this->view->load('game_room/altp/time_over');
                exit;
            }

            if (isset($_POST['answer'])) {
                $asw = $_POST['answer'];
                if ($asw != $vars['answer']) {
                    $landmark = floor(($vars['level'] - 1) / 5);
                    $point = $point_level[$landmark * 5];

                    if ($landmark > 0) {
                        $this->model->add_point($this->user->user_id, $point);
                    }

                    $this->model->altp_update($this->user->user_id, serialize(array('mode' => 'over')), time());
                    $this->model->chatbox_notify('[color=' . Helper::level_color($this->user->level) . ']'. $this->user->dname . '[/color] vừa thua cuộc [b]Ai là triệu phú[/b]' . ($landmark == 0 ? ' không vượt qua mốc câu hỏi nào, tay trắng :3' : (' vượt qua mốc câu hỏi số ' . ($landmark) . ' với số điểm: ' . $point)));

                    $this->view->point = $point;
                    $this->view->landmark = $landmark;
                    $this->view->load('game_room/altp/over');
                } else {
                    if ($vars['level'] == 15) {
                        $this->view->load('game_room/altp/win');
                        $this->model->chatbox_notify('[color=' . Helper::level_color($this->user->level) . ']'. $this->user->dname . '[/color] đã thắng cuộc [b]Ai là triệu phú[/b] và giành được số điểm là [b]500[/b]');
                        $this->model->add_point($this->user->user_id, 500);
                        $this->model->altp_update($this->user->user_id, serialize(array('mode' => 'over')), time());
                    } else {
                        $landmark = floor(($vars['level'] - 1) / 5);
                        $point = $point_level[$vars['level']];

                        $this->model->altp_update($this->user->user_id, serialize(array('mode' => 'next', 'level' => $vars['level'])), time());

                        $this->view->level = $vars['level'];
                        $this->view->point = $point;
                        $this->view->sure = $point_level[$landmark * 5];
                        $this->view->next = $point_level[$vars['level'] + 1];
                        $this->view->landmark = $landmark;
                        $this->view->load('game_room/altp/next');
                    }
                }
                exit;
            }

            $content = file(ROOT . '/other/altp/' . $vars['level'] . '/' . $vars['file']);
            $this->view->data = array(
                'level' => $vars['level'],
                'question' => $content[0],
                'a' => $content[1],
                'b' => $content[2],
                'c' => $content[3],
                'd' => $content[4],
                'money' => $point_level[$vars['level'] - 1] . '$ - ' . $point_level[$vars['level']] . '$',
                'tleft' => '0:' . (60 - time() + $data['time'])
            );
            $this->view->altp_answer = $vars['answer'];
            $this->view->load('game_room/altp/index');
        }
    }

}
