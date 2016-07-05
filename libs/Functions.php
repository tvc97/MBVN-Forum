<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

function wap(){
    $ua = $_SERVER['HTTP_USER_AGENT'];
    if(preg_match('#(cldc|midp|wap)#i', $ua))
        return true;
    if(preg_match('#(chrome|firefox|web|macintosh|windows|linux|mac os|solaris|android)#i', $ua))
        return false;
    return true;
}

function send_mail($to, $title, $html, $body){
    require ROOT . "/libs/class.smtp.php";
    require ROOT . "/libs/class.phpmailer.php";

    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->IsSMTP();
    $mail->SMTPDebug  = 0;
     
    $mail->Debugoutput = "html";
    $mail->Host       = "smtp.gmail.com";
    $mail->Port       = 587;
    $mail->SMTPSecure = "tls";
    $mail->SMTPAuth   = true;
    $mail->Username   = "mbvn.tk@gmail.com";
    $mail->Password   = "mbvn@TVC97";

    $mail->SetFrom("mbvn.tk@gmail.com", "Mobile Việt Nam");
    $mail->AddAddress($to, "");
    $mail->Subject = $title;
    $mail->MsgHTML($html);
    $mail->AltBody = $body;

    return $mail->Send();
}

function format_chat_id($str) {
    for($i = strlen($str); $i < 8; $i++)
        $str = '0' . $str;
    return $str;
}