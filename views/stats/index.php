<div class="hdr">Thống kê diễn đàn</div>
<div class="box">
    <div class="row">Số chủ đề: <b><?php echo $this->data['forum']['numthread'] ?></b></div>
    <div class="row">Số bài viết: <b><?php echo $this->data['forum']['numpost'] ?></b></div>
    <div class="row"><a href="<?php echo URL; ?>/members/">Thành viên</a>: <b><?php echo $this->data['forum']['numuser'] ?></b><?php if($this->data['forum']['newuser'] != 0): ?> / <b>+<?php echo $this->data['forum']['newuser']; endif; ?></b></div>
    <div class="row">Thành viên mới nhất: <a href="<?php echo URL; ?>/members/<?php echo Helper::mkURL($this->data['newestUser']['user_name'], $this->data['newestUser']['user_id']) ?>"><font color="<?php echo Helper::level_color($this->data['newestUser']['level']); ?>"><b><?php echo $this->data['newestUser']['dname'] ?></b></font></a></div>
</div>