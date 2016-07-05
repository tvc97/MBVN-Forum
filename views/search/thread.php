<div class="hdr">Tìm kiếm trong tiêu đề</div>
<div class="box">
    <div class="row">Có <?php echo $this->num ?> kết quả cho từ khóa '<b><?php echo $_GET['q'] ?></b>'</div>
<?php foreach($this->data as $a): ?>
    <div class="topx">
        <span class="li">•</span> <a href="<?php echo URL; ?>/threads/<?php echo Helper::mkURL($a['thread_name'], $a['thread_id']); ?>"><?php echo $a['thread_name'] ?></a><br/>
        By: <a href="<?php echo URL . '/members/' . $a['user_name'] . '.' . $a['user_id']; ?>/"><font color="<?php echo Helper::level_color($a['level']); ?>"><?php echo $a['dname']; ?></font></a>&nbsp;
        Ngày gửi: <?php echo date('H:i d.m.Y', $a['time']) ;?>
    </div>
<?php endforeach; ?>
</div>