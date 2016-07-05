<div class="hdr">Trò chuyện</div>
<div class="box">
<?php if($this->user->isLoged): ?>
    <form action="<?php echo URL; ?>/chat/post_c/" class="chat-form" method="post">
        Nội dung:<br/>
        <textarea name="content" rows="2"></textarea><br/>
        <a class="button2" href="<?php echo URL; ?>/pages/bbcode/">BBCode</a>
        <a class="button2" href="<?php echo URL; ?>/pages/smilies/">Smilies</a>
<?php if($this->user->level >= 10): ?>
        <a class="button2" href="<?php echo URL; ?>/chat/clean_c/">Dọn dẹp</a>
<?php endif; ?>
        <br/><input type="submit" value="Gửi" />
    </form>
<?php endif; ?>
</div>

<?php foreach($this->data as $a): ?>
<div class="hdr"><?php echo date('d.m.Y / H:i', $a['time']); ?></div>
<div class="post">
    <table width="100%" class="post-hdr">
        <tr><td class="col-avatar">
            <img src="<?php echo URL; ?>/public/img/avatar/<?php echo $a['user_id'] ?>.png" class="avatar" alt="avatar" /><br/>
            <a href="<?php echo URL; ?>/members/<?php echo Helper::mkURL($a['user_name'], $a['user_id']) ?>/"><font color="<?php echo Helper::level_color($a['level']); ?>"><?php echo $a['dname']; ?></font></a><span class="<?php echo time() - $a['last'] < 300 && $a['logout'] != 1 ? 'li-green' : 'li-red' ?>">•</span> <br/>
            (<font color="<?php echo Helper::level_color($a['level']); ?>"><?php echo Helper::level_name($a['level']); ?></font>)
        </td>
        <td class="col-main">
            Điểm: <?php echo $a['point']; ?><br/>
            Thích: (<?php echo $a['beliked'] . '/' . $a['liked']; ?>)<br/>
        </td></tr>
    </table>
    <div class="content">
        <?php echo Smilies::parse(Helper::BBCode(Helper::cleanXSS($a['content']))) ?>
    </div>
</div>
<?php endforeach;?>
