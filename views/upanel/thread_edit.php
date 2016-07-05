<?php if(isset($this->error)): ?>
<div class="error"><?php echo $this->error ?></div>
<?php endif; ?>
<div class="hdr">Sửa chủ đề</div>
<div class="box">
    <form action="<?php echo URL; ?>/upanel/thread_edit/<?php echo $this->data['thread_id'] ?>/" method="post">
        Tên chủ đề:<br/>
        <input type="text" name="title" value="<?php echo $this->data['thread_name'] ?>" /><br/>
        Chuyên mục:<br/>
        <select name="cat">
<?php foreach($this->cat_tree as $a): ?>
            <option value="<?php echo $a['scat_id'] ?>" <?php echo $this->data['parent'] == $a['scat_id'] ? 'selected=""' : '';?>><?php echo $a['rcat_name'] . ' > ' . $a['scat_name']; ?></option>
<?php endforeach; ?>
        </select><br/>
        <input type="submit" name="submit" value="Sửa" />
    </form>
</div>