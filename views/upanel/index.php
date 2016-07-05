<div class="hdr">Trang cá nhân</div>
<div class="box">
    <div class="row"><span class="li">•</span> <a href="<?php echo URL; ?>/upanel/profile/">Sửa hồ sơ</a></div>
    <div class="row"><span class="li">•</span> <a href="<?php echo URL; ?>/members/<?php echo $this->user->user_name . '.' . $this->user->user_id;?>">Xem hồ sơ</a></div>
    <div class="row"><span class="li">•</span> <a href="<?php echo URL; ?>/upanel/password/">Đổi mật khẩu</a></div>
    <div class="row"><span class="li">•</span> <a href="<?php echo URL; ?>/messages/inbox/">Hộp thư đến <?php if($this->user->numMessage != 0):?>(<font style="color:#ff0000;font-weight:bold"><?php echo $this->user->numMessage; ?></font>)<?php endif; ?></a></div>
    <div class="row"><span class="li">•</span> <a href="<?php echo URL; ?>/messages/outbox/">Hộp thư đi</a></div>
</div>