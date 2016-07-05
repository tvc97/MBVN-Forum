<div class="hdr">Chủ đề <?php echo $this->mode == 'old' ? 'cũ' : ($this->mode == 'view' ? 'xem nhiều' : 'mới') ?></div>
<div class="box">
    <div class="row">
<?php if($this->mode == 'new') :?>
        <b>Mới</b>
<?php else: ?>
        <a href="?m=new">Mới</a>
<?php endif; ?>
<?php if($this->mode == 'old') :?>
        &nbsp;|&nbsp;<b>Cũ</b>
<?php else: ?>
        &nbsp;|&nbsp;<a href="?m=old">Cũ</a>
<?php endif; ?>
<?php if($this->mode == 'view') :?>
        &nbsp;|&nbsp;<b>Xem nhiều</b>
<?php else: ?>
        &nbsp;|&nbsp;<a href="?m=view">Xem nhiều</a>
<?php endif; ?>
    </div>
<?php $n = count($this->data); for ($i = 0; $i < $n; $i++): $a = $this->data[$i]; ?>
    <div class="topx">
        <span class="li">•</span> <a href="<?php echo URL; ?>/threads/<?php echo Helper::mkURL($a['thread_name'], $a['thread_id']) ?>/"><?php echo $a['thread_name'] ?></a>
        (<?php echo $a['numpost'] ?>)
        [<font color="<?php echo Helper::level_color($a['level']); ?>"><?php echo $a['dname']; ?></font>]&nbsp;
        <?php if ($a['numpost'] > PPP): $p = ceil($a['numpost'] / PPP); ?><a href="<?php echo URL; ?>/threads/<?php echo Helper::mkURL($a['thread_name'], $a['thread_id']) . '/page-' . $p ?>/">&raquo;</a><?php endif; ?>
    </div>
<?php endfor; ?>
</div>