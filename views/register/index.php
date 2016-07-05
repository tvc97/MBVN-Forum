<div class="hdr">Đăng kí</div>
<div class="box">
<?php if(isset($this->msg)): ?>
    <div class="error"><?php echo $this->msg; ?></div>
<?php endif; ?>
    <form action="<?php echo URL; ?>/register/doReg/" method="post">
        Tên đăng nhập:<br/>
        <input type="text" name="login" value="<?php echo isset($_POST['login']) ? $_POST['login'] : ''; ?>" /><br/>
        Mật khẩu:<br/>
        <input type="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" /><br/>
        Nhập lại mật khẩu:<br/>
        <input type="password" name="rpassword" value="<?php echo isset($_POST['rpassword']) ? $_POST['rpassword'] : ''; ?>" /><br/>
        Email:<br/>
        <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" /><br/>
        Giới tính:<br/>
        <select name="gender">
            <option value="male" <?php echo isset($_POST['gender']) ? ($_POST['gender'] == 'male' ? 'selected' : '') : 'selected'; ?>>Nam</option>
            <option value="female" <?php echo isset($_POST['gender']) ? ($_POST['gender'] == 'female' ? 'selected' : '') : ''; ?>>Nữ</option>
        </select><br/>
        Ngày sinh:<br/>
        <select name="date">
        <?php for($i = 1; $i < 32; $i++): ?>
            <option value="<?php echo $i; ?>" <?php echo isset($_POST['date']) ? ($_POST['date'] == $i ? 'selected' : '') : ($i == 1 ? 'selected' : ''); ?>><?php echo $i; ?></option>
        <?php endfor; ?>
        </select>/
        <select name="month">
        <?php for($i = 1; $i < 13; $i++): ?>
            <option value="<?php echo $i; ?>" <?php echo isset($_POST['month']) ? ($_POST['month'] == $i ? 'selected' : '') : ($i == 1 ? 'selected' : ''); ?>><?php echo $i; ?></option>
        <?php endfor; ?>
        </select>/
        <select name="year">
        <?php for($i = 1980; $i < 2010; $i++): ?>
            <option value="<?php echo $i; ?>" <?php echo isset($_POST['year']) ? ($_POST['year'] == $i ? 'selected' : '') : ($i == 1980 ? 'selected' : ''); ?>><?php echo $i; ?></option>
        <?php endfor; ?>
        </select><br/>
        Mã bảo mật:<br/>
        <img src="<?php echo URL; ?>/public/captcha/img.php" /><br/>
        <input type="text" name="verify" /><br/>
        <input type="submit" name="submit" value="Đăng kí" />
    </form>
</div>