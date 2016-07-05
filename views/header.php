<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title><?php echo isset($this->title) ? $this->title : PNAME; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>/public/css/<?php echo !wap() ? 'pc' : $this->user->user_theme ?>/style.css" />
<?php if(isset($this->css)): foreach ($this->css as $a): ?>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>/public/css/<?php echo $a ?>" />
<?php endforeach; endif; ?>
<?php if(!wap() && !defined('INSIDE_CHAT') && $this->user->isLoged): ?>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <script src="<?php echo URL; ?>/public/js/chat.js"></script>
<?php endif; ?>
    <link rel="icon" href="<?php echo URL; ?>/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo URL; ?>/favicon.ico" type="image/x-icon" />
<?php if(isset($this->refresh)): ?>
    <meta http-equiv="refresh" content="<?php echo $this->refresh[0]; ?>;url=<?php echo $this->refresh[1]?>" />
<?php endif; ?>
<?php if(isset($this->meta)): foreach ($this->meta as $name => $content): ?>
    <meta name="<?php echo $name; ?>" content="<?php echo $content?>" />
<?php endforeach; endif; ?>
<?php if (isset($this->display_desc)): ?>
    <meta name="description" content="Diễn đàn Mobile Việt Nam - <?php echo strtoupper(SNAME); ?>" />
    <meta name="keywords" content="lập trình, tài liệu, học tập, game, giải trí, j2me, source code, php, html, css, javascript, phần mềm" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Diễn đàn Mobile Việt Nam" />
    <meta property="og:description" content="Diễn đàn Mobile Việt Nam - MBVN.TK" />
    <meta property="og:url" content="<?php echo URL; ?>/" />
    <meta property="og:site_name" content="Mobile Việt Nam" />
    <meta property="og:image" content="<?php echo URL; ?>/favicon.ico" />
<?php endif; ?>
</head>

<body class="<?php echo $this->user->isLoged ? 'loggedIn' : ''; ?>">
<div id="wraper">
    <div id="header">
        <a href="<?php echo URL; ?>/"><?php echo strtoupper(SNAME); ?></a>
    </div>

<?php if(!$this->user->isLoged): ?>
    <div id="nav">
        <a href="<?php echo URL; ?>/login/">ĐĂNG NHẬP</a>
        <a href="<?php echo URL; ?>/register/faq/">ĐĂNG KÍ</a>
    </div> 

<?php else: ?>
    <div id="nav">
        <a href="<?php echo URL; ?>/upanel/">CÁ NHÂN<?php if($this->user->numMessage != 0):?><span class="notify"><?php echo $this->user->numMessage; ?></span><?php endif; ?></a>
        <a href="<?php echo URL; ?>/logout/">ĐĂNG XUẤT</a>
    </div>

<?php endif; ?>
    <div id="addr-bar">
        <a href="<?php echo URL; ?>/">Trang chủ</a> &gt; 
        <?php if(isset($this->bar)): foreach ($this->bar as $link=>$name):?><a href="<?php echo $link; ?>"><?php echo $name; ?></a> &gt; <?php endforeach; endif; ?>

    </div>

<?php if($this->user->isLoged) if($this->user->level >= 5) if($this->user->unverify != 0): ?>
    <div class="thread-name"><a href="<?php echo URL; ?>/upanel/verify/">Kiểm duyệt (<?php echo $this->user->unverify ?>)</a></div>
<?php endif; ?>

<?php if(defined('RO')): ?>
<div class="msg">
    Diễn đàn chuyển sang trạng thái chỉ đọc. Mọi ý kiến vui lòng để lại ở khu vực chatbox
</div>
<?php endif ?>