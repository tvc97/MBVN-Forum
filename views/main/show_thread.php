<div class="thread-name">Chủ đề: <b><?php echo $this->thread['thread_name']; ?></b></div>
<?php if(isset($this->msg)): ?>
<div class="msg"><?php echo $this->msg ?></div>
<?php endif; ?>
<?php if(isset($_GET['thread_edited'])): ?>
<div class="msg">Đã sửa</div>
<?php endif; ?>
<?php if($this->thread['verified'] == 0): ?><div class="error">Chủ đề chưa được kiểm duyệt</div><?php endif; ?>
<?php if($this->user->isLoged) if($this->user->level >= 5) if($this->thread['verified'] == 0): ?><a class="button" href="<?php echo URL; ?>/upanel/verify/<?php echo $this->thread['thread_id']; ?>/">Duyệt</a><?php endif; ?>
<?php if($this->user->isLoged) if($this->user->level >= 5 && ($this->user->level > $this->upost['level'] || $this->user->user_id == $this->upost['user_id'])): ?><a class="button" href="<?php echo URL; ?>/upanel/thread_edit/<?php echo $this->thread['thread_id']; ?>/">Sửa</a><?php endif; ?>
<?php if($this->user->isLoged) if($this->user->level >= 5 && ($this->user->level > $this->upost['level'] || $this->user->user_id == $this->upost['user_id'])): ?><a class="button" href="<?php echo URL; ?>/upanel/thread_del/<?php echo $this->thread['thread_id']; ?>/">Xóa</a><?php endif; ?>
<?php $n = count($this->data); foreach($this->data as $a): ?>
<div class="hdr"><?php echo date('d.m.Y / H:i', $a['time']); ?></div>
<div class="post">
    <table width="100%" class="post-hdr">
        <tr><td class="col-avatar">
            <img src="<?php echo URL; ?>/public/img/avatar/<?php echo $a['user_id'] ?>.png" class="avatar" alt="avatar" /><br/>
            <a href="<?php echo URL; ?>/members/<?php echo Helper::mkURL($a['user_name'], $a['user_id']) ?>/"><font color="<?php echo Helper::level_color($a['level']); ?>"><?php echo $a['dname']; ?></font></a>&nbsp;<span class="<?php echo (time() - $a['last']  < 300 && $a['logout'] == 0) ? 'li-green' : 'li-red' ;?>">•</span><br/>
            (<font color="<?php echo Helper::level_color($a['level']); ?>"><?php echo Helper::level_name($a['level']); ?></font>)
        </td>
        <td class="col-main">
            Điểm: <?php echo $a['point']; ?><br/>
            Thích: (<?php echo $a['beliked'] . '/' . $a['u_liked']; ?>)<br/>
<?php if($this->user->isLoged): ?>
<?php if($a['liked'] != 0): if(!Helper::in_liked($this->user->user_id, $this->liked[$a['post_id']])): ?>
            <a href="<?php echo URL . '/like/do_like/' .  $a['post_id'] . '/'; ?>">Thích</a>
<?php else: ?>
            <a href="<?php echo URL . '/like/un_like/' .  $a['post_id'] . '/'; ?>">Bỏ thích</a>
<?php endif; endif;?>
<?php  if($a['liked'] == 0): ?>
            <a href="<?php echo URL . '/like/do_like/' .  $a['post_id'] . '/'; ?>#">Thích</a>
<?php endif; ?>
            &nbsp;·&nbsp;<a href="?quote=<?php echo $a['post_id']; ?>#pf">Trích dẫn</a>
<?php if($this->user->user_id == $a['user_id'] || ($this->user->level >= 10 && $a['level'] < $this->user->level)): ?>
            &nbsp;·&nbsp;<a href="<?php echo URL; ?>/upanel/post_edit/<?php echo $a['post_id'] ?>/">Sửa</a>
<?php endif; ?>
<?php if($this->user->level >= 5 && ($this->user->level > $a['level'] || $this->user->user_id == $a['user_id'])): ?>
            &nbsp;·&nbsp;<a href="<?php echo URL; ?>/upanel/post_del/<?php echo $a['post_id'] ?>/">Xóa</a>
<?php endif; ?>
<?php endif; ?>
        </td></tr>
    </table>
    <div class="content">
        <?php echo Smilies::parse(Helper::BBCode(Helper::cleanXSS($a['content']))); ?>
    </div>
<?php if($a['liked'] != 0): ?>
    <div class="tline">
<?php for($i = 0; $i < $a['liked']; $i++): $b = $this->liked[$a['post_id']][$i];?>
        <a href="<?php echo URL; ?>/members/<?php echo Helper::mkURL($b['user_name'], $b['user_id']); ?>/"><font color="<?php echo Helper::level_color($b['level']) ?>"><?php echo $b['dname'];?></font></a>
<?php if($i != $a['liked'] - 1) echo ', '; else echo ' '; endfor; ?>
        Thích bài viết này
    </div>
<?php endif; ?>
<?php if($this->user->isLoged) if($this->user->level >= 10): $vars = unserialize($a['vars']); ?>
    <div class="tline">
        <?php if(isset($vars['ua']) && isset($vars['ip'])) echo current(explode('/', $vars['ua'])) . ' - ' . $vars['ip']; ?>
    </div>
<?php endif; ?>
</div>
<?php endforeach; ?>
