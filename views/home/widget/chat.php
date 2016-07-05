<div class="hdr"><a href="<?php echo URL; ?>/chat/">Trò chuyện</a></div>
<div class="box">
<?php if($this->user->isLoged): ?>
    <form action="<?php echo URL; ?>/chat/post_i/" class="chat-form" method="post">
        Nội dung:<br/>
        <textarea name="content" rows="2" id="msg"></textarea><br/>
        <a class="button2" href="<?php echo URL; ?>/pages/bbcode/">BBCode</a>
        <a class="button2" href="<?php echo URL; ?>/pages/smilies/">Smilies</a>
<?php if($this->user->level >= 10): ?>
        <a class="button2" href="<?php echo URL; ?>/chat/clean_i/">Dọn dẹp</a>
<?php endif; ?>
        <br/><input type="submit" value="Gửi" />
    </form>
<?php endif; ?>
    <div id="chat">
<?php foreach($this->chat as $a): ?>
    <div class="row">
        <span class="<?php echo time() - $a['last'] < 300 && $a['logout'] != 1 ? 'li-green' : 'li-red' ?>">•</span> <a href="<?php echo URL . '/members/' . Helper::mkURL($a['user_name'], $a['user_id']); ?>/"><font color="<?php echo Helper::level_color($a['level']); ?>"><?php echo $a['dname'] ?></font></a>: <?php echo Smilies::parse(Helper::BBCode(Helper::cleanXSS($a['content']))) ?>
    </div>
<?php endforeach;?>
   </div>
</div>