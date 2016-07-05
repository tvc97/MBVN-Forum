<?php if($this->user->isLoged && !defined('RO')): ?>
<a href="<?php echo URL; ?>/upanel/thread_post/<?php echo $this->cat_id; ?>/" class="button">Đăng chủ đề mới</a>
<?php endif; ?>
<div class="hdr"><?php echo $this->name; ?></div>
<div class="box">
<?php $n = count($this->data); for($i = 0; $i < $n; $i++): $a = $this->data[$i]; ?>
    <div class="topx">
        <span class="li">•</span> <a href="<?php echo URL; ?>/threads/<?php echo Helper::mkURL($a['thread_name'], $a['thread_id']) ?>/"><?php echo $a['thread_name'] ?></a>&nbsp;
        (<?php echo $a['numpost'] . '/' . $a['view']; ?>)&nbsp;
        <?php if($a['numpost'] > PPP): $p = ceil($a['numpost']/PPP); ?><a href="<?php echo URL; ?>/threads/<?php echo Helper::mkURL($a['thread_name'], $a['thread_id']) . '/page-' . $p ?>/">&raquo;</a><?php endif;?><br />
        By: <a href="<?php echo URL . '/members/' . $a['user_name'] . '.' . $a['user_id']; ?>/"><font color="<?php echo Helper::level_color($a['level']); ?>"><?php echo $a['dname']; ?></font></a>&nbsp;
        Ngày gửi: <?php echo date('H:i d.m.Y', $a['time']) ;?>
    </div>
<?php endfor; ?>
</div>