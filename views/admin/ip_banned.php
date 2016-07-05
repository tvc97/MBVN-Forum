<?php if(isset($this->msg)): ?>
<div class="msg"><?php echo $this->$msg ?></div>
<?php endif; ?>
<div class="hdr">IP bị khóa</div>
<div class="box">
<?php foreach ($this->data as $ip): ?>
    <div class="row">
        <?php echo $ip; ?> - <a href="<?php echo URL; ?>/admin/ip_banned/?del=<?php echo $ip ?>">Xóa</a>
    </div>
<?php endforeach; ?>
</div>