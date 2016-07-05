<div class="hdr">Tin nhắn</div>
<div class="box">
    <div class="row"> <a href="<?php echo URL; ?>/messages/inbox/">Hộp thư đến <?php if($this->user->numMessage != 0):?>(<font style="font-weight:bold;color:#ff0000"><?php echo $this->user->numMessage; ?></font>)<?php endif; ?></a></div>
    <div class="row"> <a href="<?php echo URL; ?>/messages/outbox/">Hộp thư đi</a></div>
</div>