<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Smilies {

    public static $prevent_count = 0;
    
    public static $char_yahoo = array(':)', ':(', ';)', ':D', ';;)', '&gt;:D&lt;', ':-/', ':x', ':&quot;&gt;', ':P', ':-*', '=((',
        ':-O', 'X(', ':&gt;', 'B-)', ':-S', '#:-S', '&gt;:)', ':((', ':))', ':|', '/:)',
        '=))', 'O:-)', ':-B', '=;', ':-c', ':)]', '~X(', ':-h', ':-t', '8-&gt;', 'I-)',
        '8-', 'L-)', ':-&amp;', ':-$', '[-(', ':O)', '8-}', '&lt;:-P', '(:', '=P~',
        ':-?', '#-o', '=D&gt;', ':-SS', '@-)', ':^o', ':-w', ':-&lt;', '&gt;:P', '&lt;):)', 'X_X',
        ':!!', '\m/', ':-q', ':-bd', '^#(^', ':ar!', ':o3', ':-??', '%-(', ':@)', '3:-O',
        ':(|)', '~:&gt;', '@};-', '%%-', '**==', '(~~)', '~O)', '*-:)', '8-X', '=:)', '&gt;-)',
        ':-L', '[-O&lt;', '$-)', ':-&quot;', 'b-(', ':)&gt;-', '[-X', '\:D/', '&gt;:/', ';))', ':-@', '^:)^',
        ':-j', '(*)', 'o-&gt;', 'o=&gt;', 'o-+', '(%)', ':bz', ':3', ':v', ':yaoming:', ':ym:', ':adore:', ':boom:',
        ':ah:', ':amazed:', ':angry:', ':bad_smelly:', ':baffle:', ':bang:', ':bann:', ':beat_plaster:',
        ':beat_shot:', ':beauty:', ':boss:', ':gach:', ':lay:', ':bye:', ':byebye:', ':canny:', ':capture:',
        ':chaymau:', ':cheers:', ':choler:', ':confident:', ':cool:', ':doublegun:', ':doubt:', ':driblle:',
        ':embarrass:', ':good:', ':fix:', ':flame:', ':go:', ':haha:', ':hang:', ':hell:', ':hug:', ':hungry:',
        ':lay:', ':lmao:', ':lol:', ':look_down:', ':lovemachine:', ':loveyou:', ':matrix:', 
        ':misdoubt:', ':oh:', ':ops:', ':ot:', ':phone:', ':please:', ':pundency:', ':rap:', ':rofl:',
        ':rungun:', ':sad:', ':sexy:', ':shame:', ':shit:', ':sleep:', ':smoke:', ':spam:', ':dream:', ':sure:',
        ':surrender:', ':sweat:', ':kiss:', ':theft:', ':tire:', ':too_sad:', ':waaaht:', ':welcome:', ':what:');

    function __construct() {
        
    }

    public static function parse($str) {
        $dir = URL . '/public/img/smilies/';
        $path = ROOT . '/public/img/smilies/';
        $url = array();

        preg_match_all('#<div class="code">.+?</div>#is', $str, $prevent);
        $str = preg_replace_callback('#<div class="code">.+?</div>#is', 'self::prevent_code', $str);

        preg_match_all('#href=".+?"#i', $str, $prevent2);
        $str = preg_replace_callback('#href=".+?"#i', 'self::prevent_code', $str);

        preg_match_all('#src=".+?"#i', $str, $prevent3);
        $str = preg_replace_callback('#src=".+?"#i', 'self::prevent_code', $str);

        if(isset($prevent2[0][0])) {
            $prevent[0] = array_merge($prevent[0], $prevent2[0]);
        }
        if(isset($prevent3[0][0])) {
            $prevent[0] = array_merge($prevent[0], $prevent3[0]);
        }

        $n = count(self::$char_yahoo);
        for ($i = $n - 1; $i >= 0; $i--) {
            if(file_exists($path . $i . '.gif'))
                $url[] = '<img src="' . $dir . $i . '.gif" /> ';
            else
                $url[] = '<img src="' . $dir . $i . '.png" /> ';
        }

        $from = array_reverse(self::$char_yahoo);
        for($i = 0; $i < $n; $i++)
            $str = preg_replace('#(?<=\s|^)(' . preg_quote($from[$i], '#') . ')(?=\s|$)#', $url[$i], $str);

        if (self::$prevent_count != 0) {
            $a = array();
            $b = array();
            $n = count($prevent[0]);
            
            for ($i = 0; $i < $n; $i++) {
                $a[$i] = '[[[prevented' . $i . ']]]';
                $b[$i] = $prevent[0][$i];
            }
            $str = str_replace($a, $b, $str);
        }
        
        self::$prevent_count = 0;
        return $str;
    }
    
    public static function prevent_code($match) {
        $return = '[[[prevented' . self::$prevent_count . ']]]';
        self::$prevent_count++;
        return $return;
    }

    public static function get() {
        return self::$char_yahoo;
    }

}
