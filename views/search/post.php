<div class="hdr">Tìm kiếm trong tiêu đề</div>
<div class="box">
    <div class="row">Có <?php echo $this->num ?> kết quả cho từ khóa '<b><?php echo $_GET['q'] ?></b>'</div>
</div>
<?php foreach($this->data as $a): ?>
<div class="hdr"><?php echo date('d.m.Y / H:i', $a['time']); ?></div>
<?php $ct = explode(' ', $a['content']); if(count($ct) > 20){ $ct = array_slice($ct, 0, 20); $ct = implode(' ', $ct) . '...'; } else { $ct = $a['content']; } ?>
<div class="post">
    <table width="100%" class="post-hdr">
        <tr><td class="col-avatar">
            <img src="<?php echo URL; ?>/public/img/avatar/<?php echo $a['user_id'] ?>.png" class="avatar" alt="avatar" /><br/>
            <a href="<?php echo URL; ?>/members/<?php echo Helper::mkURL($a['user_name'], $a['user_id']) ?>/"><font color="<?php echo Helper::level_color($a['level']); ?>"><?php echo $a['dname']; ?></font></a>&nbsp;<span class="<?php echo time() - $a['last'] < 300 && $a['logout'] != 1 ? 'li-green' : 'li-red' ?>">•</span><br/>
            (<font color="<?php echo Helper::level_color($a['level']); ?>"><?php echo Helper::level_name($a['level']); ?></font>)
        </td>
        <td class="col-main">
        </td></tr>
    </table>
    <div class="content">
        <?php echo Smilies::parse(Helper::BBCode(Helper::cleanXSS($ct))); ?>
    </div>
    <div class="tline">
        <div class="block">Trong: <a href="<?php echo URL; ?>/threads/<?php echo Helper::mkURL($a['thread_name'], $a['thread_id']); ?>"><b><?php echo $a['thread_name'] ?></b></a></div>
<?php if($this->user->isLoged) if($this->user->level >= 10): $vars = unserialize($a['vars']); ?>
        <?php if(isset($vars['ua']) && isset($vars['ip'])) echo current(explode('/', $vars['ua'])) . ' - ' . $vars['ip']; ?>
<?php endif; ?>
    </div>
</div>
<?php endforeach; ?>
