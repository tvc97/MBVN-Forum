<div class="hdr">Tìm kiếm</div>
<div class="box">
<?php if(isset($this->error)): ?>
    <div class="error"><?php echo $this->error ?></div>
<?php endif; ?>
<?php include __DIR__ . '/search_form.php' ?>
</div>