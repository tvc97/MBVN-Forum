<?php if(isset($_GET['edited'])): ?>
<div class="msg">Đã sửa</div>
<?php endif; ?>
<div class="hdr">Hồ sơ <?php echo $this->data['dname']; ?></div>
<div class="box">
    <center>
        <img class="avatar" src="<?php echo URL; ?>/public/img/avatar/<?php echo $this->data['user_id']; ?>.png" /><br/>
        <font color="<?php echo Helper::level_color($this->data['level']); ?>"><?php echo $this->data['dname']; ?></font>&nbsp;
        <span class="<?php echo (time() - $this->data['last'] < 300 && $this->data['logout'] != 1  ) ? 'li-green' : 'li-red'; ?>">•</span><br/>
        [ <?php echo Helper::level_name($this->data['level']); ?> ]<br/>
    </center>
    <div class="row"> Ngày sinh: <?php echo $this->data['dob']; ?></div>
    <div class="row"> Giới tính: <?php echo $this->data['gender'] == 1 ? 'Nam' : 'Nữ' ;?></div>
    <div class="row"> Hoạt động cuối: <?php echo date('H:i:s d/m/Y', $this->data['last']); ?></div>
    <div class="row"> Gia nhập: <?php echo date('H:i:s d/m/Y', $this->data['reg']); ?></div>
    <div class="row"> Số chủ đề: <a href="<?php echo URL; ?>/members/threads/<?php echo $this->data['user_id']; ?>/"><?php echo $this->data['numthread'] ?></a></div>
    <div class="row"> Số bài viết: <?php echo $this->data['numpost']; ?></div>
    <?php if($this->user->isLoged): if($this->user->user_id != $this->data['user_id']):?><div class="row"> <a href="<?php echo URL; ?>/messages/send/<?php echo $this->data['user_id']; ?>/">Gửi tin nhắn</a></div><?php endif; endif;?>
<?php if($this->user->isLoged): if($this->user->level >= 5): $info = unserialize($this->data['vars']); ?>
    <div class="row2"><b>Private Info</b></div>
    <div class="row1"> Email: <?php echo $this->data['email']; ?></div>
    <div class="row1"> Trình duyệt: <?php echo $info['ua']; ?></div>
    <div class="row1"> IP: <?php echo $info['ip']; ?></div>
    <div class="row1"> Vị trí: <a href="<?php echo $info['locate']; ?>"><?php echo $info['locate']; ?></a></div>
<?php endif; endif; ?>
<?php if($this->user->isLoged): if($this->user->level >= 10 && $this->data['level'] < $this->user->level): $info = unserialize($this->data['vars']); ?>
    <div class="row2"><b>Forum Level</b></div>
    <div class="row1">
        <form action="<?php echo URL; ?>/admin/edit_level/<?php echo $this->data['user_id']; ?>/" method="get">
            <select name="level">
                <option value="1" <?php echo $this->data['level'] == 1 ? ' selected=""' : ''?>>Thành viên</option>
                <option value="5" <?php echo $this->data['level'] == 5 ? ' selected=""' : ''?>>Điều hành viên</option>
                <option value="10" <?php echo $this->data['level'] == 10 ? ' selected=""' : ''?>>Quản trị viên</option>
            </select>
            <input type="submit" value="Sửa" />
        </form>
    </div>
    <div class="row1"><a href="<?php echo URL; ?>/admin/edit_level/<?php echo $this->data['user_id']; ?>/?level=0">Khóa tài khoản</a></div>
<?php endif; endif;?>
</div>