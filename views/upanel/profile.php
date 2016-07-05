<div class="hdr">Sửa hồ sơ</div>
<div class="box">
<?php if(isset($this->err)): ?>
    <div class="error"><?php echo $this->err;?></div>
<?php endif; ?>
<?php if(isset($this->msg)): ?>
    <div class="msg"><?php echo $this->msg;?></div>
<?php endif; ?>
<?php
$dob = explode('/', $this->user->dob);
?>
    <form action="<?php echo URL; ?>/upanel/profile/" method="post" enctype="multipart/form-data">
        Ảnh đại diện:<br/>
        <input type="file" name="avatar" accept="image/*" /><br/>
        Email:<br/>
        <input type="text" name="email" value="<?php echo $this->user->email; ?>" /><br/>
        Giới tính:<br/>
        <select name="gender">
            <option value="male" <?php echo $this->user->gender == 1 ? 'selected' : ''?>>Nam</option>
            <option value="female" <?php echo $this->user->gender == 2 ? 'selected' : ''?>>Nữ</option>
        </select><br/>
        Ngày sinh:<br/>
        <select name="date">
        <?php for($i = 1; $i < 32; $i++): ?>
            <option value="<?php echo $i; ?>" <?php echo $dob[0] == $i ? 'selected' : '';?>><?php echo $i; ?></option>
        <?php endfor; ?>
        </select>/
        <select name="month">
        <?php for($i = 1; $i < 13; $i++): ?>
            <option value="<?php echo $i; ?>" <?php echo $dob[1] == $i ? 'selected' : '';?>><?php echo $i; ?></option>
        <?php endfor; ?>
        </select>/
        <select name="year">
        <?php for($i = 1980; $i < 2010; $i++): ?>
            <option value="<?php echo $i; ?>" <?php echo $dob[2] == $i ? 'selected' : '';?>><?php echo $i; ?></option>
        <?php endfor; ?>
        </select><br/>
        <input type="submit" name="submit" value="Cập nhật" />
    </form>
</div>