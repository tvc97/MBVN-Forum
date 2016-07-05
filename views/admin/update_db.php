<div class="hdr">Update database</div>
<div class="box">
<?php if(isset($this->msg)): ?>
    <div class="msg"><?php echo $this->msg ?></div>
<?php endif; ?>
    <form action="<?php echo URL; ?>/admin/update_db/" method="post" enctype="multipart/form-data">
        File (.sql file):<br />
        <input type="file" name="f" /><br/>
        <input type="submit" name="submit" value="Update" />
    </form>
</div>