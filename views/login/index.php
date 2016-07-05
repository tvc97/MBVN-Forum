<div class="hdr">Đăng nhập</div>
<div class="box">
<?php if(isset($this->msg)): ?>
    <div class="error"><?php echo $this->msg;?></div>
<?php endif; ?>
    <form action="<?php echo URL; ?>/login/doLog/" method="post">
        Tên đăng nhập:<br/>
        <input type="text" name="login" /><br/>
        Mật khẩu:<br/>
        <input type="password" name="password" /><br/>
        <input type="submit" name="submit" value="Đăng nhập" />
    </form>
</div>