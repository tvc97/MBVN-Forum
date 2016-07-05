<?php if(isset($this->error)): ?>
<div class="error"><?php echo $this->error; ?></div>
<?php endif; ?>
<div class="hdr">Gửi tin nhắn</div>
<div class="box">
    <form action="<?php echo URL; ?>/messages/send/<?php echo $this->uid; ?>/" method="post">
        Nội dung:<br/>
        <textarea name="content"></textarea><br/>
        <input type="submit" name="submit" value="Gửi"/>
    </form>
</div>