<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Helper {

    public static $geshi = false;
    public static $user;
    
    function __construct() {
        
    }

    public static function valid_user($str) {

        $regex = '/^[\w]{3,100}$/';
        return preg_match($regex, $str);
    }

    public static function valid_email($str) {

        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        return preg_match($regex, $str);
    }

    public static function valid_dob($str) {

        $regex = '#\d{1,2}/\d{1,2}/\d{4}#';
        return preg_match($regex, $str);
    }

    public static function to_ascii($str) {

        $str = self::utf2uni($str);

        $utf8 = array(
            // unicode
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd' => 'đ|Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i' => 'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach ($utf8 as $ascii => $uni)
            $str = preg_replace("/($uni)/i", $ascii, $str);
        return trim($str);
    }

    public static function utf2uni($str) {
        include_once(__DIR__ . '/Encoding.php');
        return Encoding::to_unicode($str);
    }


    public static function rand_str($l, $chars = false) {
        if (!$chars) {
            $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }

        $chars = str_split($chars);
        $n = count($chars);
        $str = '';

        for ($i = 0; $i < $l; $i++) {
            $str .= $chars[rand(0, $n)];
        }

        return $str;
    }

    public static function resize_image($image, $width, $height, $info) {

        $width_old = imagesx($image);
        $height_old = imagesy($image);

        $image_resized = imagecreatetruecolor($width, $height);
        if (($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG)) {
            $transparency = imagecolortransparent($image);

            if ($transparency >= 0) {
                $transparent_color = imagecolorsforindex($image, $trnprt_indx);
                $transparency = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                imagefill($image_resized, 0, 0, $transparency);
                imagecolortransparent($image_resized, $transparency);
            } elseif ($info[2] == IMAGETYPE_PNG) {
                imagealphablending($image_resized, false);
                $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
                imagefill($image_resized, 0, 0, $color);
                imagesavealpha($image_resized, true);
            }
        }
        imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $width, $height, $width_old, $height_old);

        return $image_resized;
    }

    public static function level_color($level) {
        if ($level == 1)
            return COLOR_MEM;
        if ($level == 5)
            return COLOR_MOD;
        if ($level >= 10)
            return COLOR_ADM;
        if ($level == 0)
            return COLOR_BAN . '" style="text-decoration:line-through;';
        return false;
    }

    public static function level_name($level) {
        if ($level == 1)
            return 'Thành viên';
        if ($level == 5)
            return 'Điều hành viên';
        if ($level == 10)
            return 'Quản trị viên';
        if ($level == 20)
            return 'Sáng lập';
        if ($level == 0)
            return 'Tài khoản bị khóa';
        return false;
    }

    public static function code($match) {
        $content = $match[1];
        $content = strip_tags($content);

        return '<div class="code"><p class="clang">Code:</p><pre>' . str_replace(array('>', '<'), array('&gt;', '&lt;'), $content) . '</pre></div>';
    }

    public static function BBCode($txt) {

        // Text decoration 
        $txt = preg_replace("#code([^]]*)\]<br />\r?\n#i", 'code$1]', $txt);

        $txt = preg_replace_callback('#\[code\](.+?)\[/code\]#is', 'self::code', $txt);
        $txt = preg_replace_callback('#\[code lang=(html|css|javascript|jquery|xml|pascal|php|mysql|java|python|ruby|asp|bash|c|cpp|csharp)\](.+?)\[/code\]#is', 'self::highlight', $txt);
        $txt = preg_replace('#\[b\](.+?)\[/b\]#i', '<b>$1</b>', $txt);
        $txt = preg_replace('#\[u\](.+?)\[/u\]#i', '<u>$1</u>', $txt);
        $txt = preg_replace('#\[i\](.+?)\[/i\]#i', '<i>$1</i>', $txt);
        $txt = preg_replace('#\[color=([a-z0-9\#]+)\](.+?)\[/color\]#i', '<span style="color: $1">$2</span>', $txt);

        // Other 
        $txt = preg_replace('#\[quote=(.+?)\]#is', '<div class="quote"><b>$1</b><br />', $txt);
        $txt = str_replace('[/quote]', '</div>', $txt);
        $txt = preg_replace('#\[img\](.+?)\[/img\]#i', '<center><a href="$1"><img src="$1" alt="Image" /></a></center>', $txt);
        $txt = preg_replace('#\[img=(.+?)\]#i', '<center><a href="$1"><img src="$1" alt="Image" /></a></center>', $txt);
        $txt = preg_replace('#\[youtube\](.+?)\[\/youtube\]#i', '<center><iframe width="224px" src="https://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe></center>', $txt);

        if(self::$user->isLoged) {
            $txt = preg_replace('#\[url\](.+?)\[/url\]#i', '<a href="$1" target="_blank">$1</a>', $txt);
            $txt = preg_replace('#\[url=(.+?)\](.+?)\[/url\]#i', '<a href="$1" target="_blank">$2</a>', $txt);
            $txt = preg_replace('#(^|[\n\s]|[^\"\>])https?://([^\n\s\>\<]*)([\n\s\>\<]|$)#is', '$1<a href="http://$2" target="_blank">http://$2</a>$3', $txt);
        } else {
            $txt = preg_replace('#\[url\](.+?)\[/url\]#i', '<a href="' . URL . '/login/" style="color:black"><b><i><u>Đăng nhập để xem link</u></i></b></a>', $txt);
            $txt = preg_replace('#\[url=(.+?)\](.+?)\[/url\]#i', '<a href="' . URL . '/login/" style="color:black"><b><i><u>Đăng nhập để xem link</i></b></u></a>', $txt);
            $txt = preg_replace('#(^|[\n\s]|[^\"\>])https?://([^\n\s\>\<]*)([\n\s\>\<]|$)#is', '$1<a href="' . URL . '/login/" style="color:black"><b><i><u>Đăng nhập để xem link</u></i></b></a>$3', $txt);
        }

        return $txt;
    }

    public static function highlight($match) {
        $lang = $match[1];
        $code = htmlspecialchars_decode(strip_tags($match[2]), ENT_QUOTES);

        if(!self::$geshi) {
            include_once ROOT . '/libs/highlight/geshi.php';
            self::$geshi = new GeSHi();
        }

        self::$geshi->set_source($code);
        self::$geshi->set_language($lang);
        self::$geshi->set_overall_style('');
        self::$geshi->set_overall_class('');
        self::$geshi->enable_keyword_links(false);

        return '<div class="code"><p class="clang">' . strtoupper($lang) . ' Code:</p>' . self::$geshi->parse_code() . '</div>';
    }

    public static function cleanXSS($txt) {
        return nl2br(htmlspecialchars($txt, ENT_QUOTES, "UTF-8"));
    }

    public static function cleanHTML($txt) {
        return htmlspecialchars($txt, ENT_QUOTES, "UTF-8");
    }

    public static function toURL($str) {
        $str = preg_replace('/[^\w-\s]/', '', $str);
        $str = strtolower($str);
        $str = str_replace(' ', '-', $str);
        $str = preg_replace('/-{1,}/', '-', $str);
        return $str;
    }

    public static function mkURL($name, $id) {
        return self::toURL(self::to_ascii($name)) . '.' . $id;
    }

    public static function paging($before, $after, $p, $num) {
        if ($num < 2)
            return;
        echo '    <div class="paging">Trang : ';
        $dot = null;
        for ($i = 1; $i <= $num; $i++) {
            if (($i > $p - 2 && $i < $p + 2) || $i == 1 || $i == $num) {
                $a = $i == $num ? '. ' : ', ';
                if ($dot == null)
                    $dot = '..';
                if ($i == $p)
                    echo '<b>' . $i . '</b>' . $a;
                else
                    echo '<a href="' . $before . $i . $after . '">' . $i . '</a>' . $a;
            }else if ($dot) {
                echo $dot . ' ';
                $dot = null;
            }
        }
        echo '</div>';
    }

    public static function get_all_path($dir) {
        if (!is_dir($dir))
            return false;
        chmod($dir, 0755);
        $fs = scandir($dir);
        $data = array();
        foreach ($fs as $f) {
            if ($f != '.' && $f != '..') {
                $path = $dir . '/' . $f;
                if (is_dir($path)) {
                    $data = array_merge($data, self::get_all_path($path));
                    $data[] = $path;
                } else
                if ($dir != ROOT . '/files/admin/backup/code' && $dir != ROOT . '/files/admin/backup/db')
                    $data[] = $path;
            }
        }

        return $data;
    }

    public static function generate_client_info() {
        return serialize(array('ua' => self::get_ua(), 'ip' => self::get_ip()));
    }
    
    public static function get_ua() {
        return $_SERVER['HTTP_USER_AGENT'];
    }
    
    public static function get_ip() {
        return isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    }
    
    public static function get_location() {
        return $_SERVER['REQUEST_URI'];
    }

    public static function rmdir($dir) {
        if (is_dir($dir)) {
            chmod($dir, 0777);
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir . "/" . $object))
                        self::rmdir($dir . "/" . $object);
                    else
                        unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
    
    public static function list_theme() {
        $theme = glob(ROOT . '/public/css/*');
        $t = array();
        foreach ($theme as $a) {
            if(file_exists($a . '/theme.inf')) {
                $inf = explode('=', file_get_contents($a . '/theme.inf'));
                $inf = trim($inf[1]);
                $t[basename($a)] = $inf;
            }
        }
        return $t;
    }

    public static function re_chmod() {
        $ps = get_all_path(ROOT);
        foreach ($ps as $a) {
            if (is_file($a))
                if (preg_match('/\.php/i', $a))
                    chmod($a, 0400);
                else
                    chmod($a, 0404);
            else
                chmod($a, 0701);
        }
        $map = array(
            '/config' => 0100,
            '/controllers' => 0100,
            '/views' => 0100,
            '/models' => 0100,
            '/libs' => 0100,
        );
        foreach ($map as $a => $m)
            chmod(ROOT . $a, $m);
    }

    public static function in_liked($id, $a) {
        foreach ($a as $b) {
            if ($b['user_id'] == $id)
                return true;
        }
        return false;
    }

    public static function removeQuote($str) {
        return preg_replace('#\[quote(.+?)\/quote\]#i', '', $str);
    }
    
    public static function isRobot() {
        return preg_match('/(bot|spider)/i', $_SERVER['HTTP_USER_AGENT']);
    }

}
