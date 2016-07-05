<?php if(isset($this->error)): ?>
<div class="error"><?php echo $this->error; ?></div>
<?php endif; ?>
<div class="hdr">Thêm chuyên mục</div>
<div class="box">
    <form action="<?php echo URL; ?>/admin/add_cat/<?php echo $this->cid; ?>/" method="post">
        Tên chuyên mục:<br/>
        <input type="text" name="name" /><br/>
        <input type="submit" name="submit" value="Thêm" />
    </form>
</div>