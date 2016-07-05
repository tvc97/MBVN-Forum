<?php if(isset($this->msg)): ?>
<div class="msg"><?php echo $this->msg; ?></div>
<?php endif; ?>
<div class="hdr">Sửa bài viết</div>
<div class="box">
    <form action="<?php echo URL; ?>/upanel/post_edit/<?php echo $this->data['post_id']; ?>" method="post" class="post-form">
        Nội dung:<br/>
        <textarea rows="3" name="content"><?php echo Helper::cleanHTML($this->data['content']); ?></textarea><br/>
        <input type="submit" name="submit" value="Sửa" /><br/>
        <a href="<?php echo URL . '/threads/' . Helper::mkURL($this->data['thread_name'], $this->data['thread_id']) ?>">&laquo; Trở về</a>
    </form>
</div>
