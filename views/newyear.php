<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>Chúc mừng năm mới - <?php echo isset($this->title) ? $this->title : PNAME; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>/public/css/default/style.css" />
    <link rel="icon" href="<?php echo URL; ?>/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo URL; ?>/favicon.ico" type="image/x-icon" />
    <style>
        .border_top {
            border-top: 1px dashed #ff9820;
            margin-top: 5px;
            padding-top: 5px
        }
        
        #hpny {
            font-weight: bold;
            padding: 5px;
            padding-bottom: 10px;
            margin-top: 5px;
            margin-bottom: 5px;
        }
        
        .box {
            border: 1px solid #ff7800;
            padding: 5px;
        }
    </style>
</head>

<?php include ROOT . '/libs/Lunar.php'; ?>

<body>
    <div id="wraper">
        <div class="msg" style="line-height: 1.5em; font-weight:normal">
            <div class="box">
                <div id="hpny">CHÚC MỪNG NĂM MỚI!</div>
                <div class="border_top"><?php echo date('H:i:s d/m/Y'); ?><br/>(<?php echo alhn(); ?>)</div>
                <div class="border_top">Chúc <?php echo $this->user->isLoged ? $this->user->dname : 'bạn' ?> năm mới vui vẻ, khỏe mạnh, code đều, thoát FA.</div>
                <div class="border_top">Diễn đàn sẽ hoạt động trở lại vào ngày mùng 7 tết (14/02)</div>
                <div class="border_top"><b>P/S: TẾT TẾT CÁI CON KHỈ</b></div>
            </div>
        </div>
    </div>
</body>
</html>