<div class="hdr">Đổi mật khẩu</div>
<div class="box">
<?php if(isset($this->err)): ?>
    <div class="error"><?php echo $this->err; ?></div>
<?php endif; ?>
<?php if(isset($this->msg)): ?>
    <div class="msg"><?php echo $this->msg; ?></div>
<?php endif; ?>
    <form action="<?php echo URL; ?>/upanel/password/" method="post">
        Mật khẩu cũ:<br/>
        <input type="password" name="old" /><br />
        Mật khẩu mới:<br />
        <input type="password" name="new" /><br />
        Nhập lại mật khẩu mới:<br />
        <input type="password" name="rnew" /><br />
        <input type="submit" name="submit" value="Đổi" />
    </form>
</div>