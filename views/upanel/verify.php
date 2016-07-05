<?php if(isset($_GET['ok'])): ?>
<div class="msg">Đã kiểm duyệt chủ đề</div>
<?php endif; ?>
<div class="hdr">Kiểm duyệt</div>
<div class="box">
<?php foreach ($this->data as $a): ?>
    <div class="topx">
        &raquo; <a href="<?php echo URL; ?>/threads/<?php echo Helper::mkURL($a['thread_name'], $a['thread_id']); ?>"><?php echo $a['thread_name']; ?></a><br/>
        Bởi: <a href="<?php echo URL; ?>/members/<?php echo Helper::mkURL($a['user_name'], $a['user_id']); ?>"><?php echo $a['dname']; ?></a> Ngày đăng: <?php echo date('H:i:s d/m/Y', $a['time']) ?><br/>
        <a class="button" href="<?php echo URL; ?>/upanel/verify/<?php echo $a['thread_id']; ?>/">Duyệt</a>
        <a class="button" href="<?php echo URL; ?>/upanel/thread_del/<?php echo $a['thread_id']; ?>/">Xóa</a>
    </div>
<?php endforeach; ?>
</div>