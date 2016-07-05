<div class="hdr">Sao lưu database</div>
<div class="box">
<?php if(isset($this->msg)): ?>
    <div class="msg"><?php echo $this->msg ?></div>
<?php endif; ?>
    <div class="row"><a class="button2" href="?generate">+ Tạo mới</a></div>
    <div class="row1">Các bản backup trước</div>
<?php $n = count($this->fs); for($i = 0; $i < $n; $i++): $a = $this->fs[$i]; ?>
    <div class="row"><a href="<?php echo URL . '/admin/get_db/?f=' . basename($a) ?>"><?php echo basename($a); ?></a> <a class="button2" href="?f=<?php echo basename($a); ?>&del">Xóa</a></div>
<?php endfor; ?>
</div>