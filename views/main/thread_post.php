<?php if(isset($this->error)): ?>
<div class="error"><?php echo $this->error; ?></div>
<?php endif;?>
<?php if(!defined('RO')): ?>
<div class="hdr">Đăng chủ đề</div>
<div class="msg">Thành viên đăng chủ đề mới cần chờ ban quản trị kiểm duyệt</div>
<div class="box">
    <form action="<?php echo URL; ?>/upanel/thread_post/<?php echo $this->cat['cat_id']; ?>/" method="post">
        Tiêu đề:<br/>
        <input type="text" name="title" /><br />
        Nội dung:<br />
        <textarea name="content"></textarea><br/>
        <input type="submit" name="submit" value="Đăng" />
    </form>
</div>
<?php endif; ?>