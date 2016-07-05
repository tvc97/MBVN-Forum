<div class="hdr">Sửa chuyên mục</div>
<div class="box">
    <form action="<?php echo URL; ?>/admin/edit_cat/<?php echo $this->data['cat_id']; ?>/" method="post">
        Tên chuyên mục:<br/>
        <input type="text" name="name" value="<?php echo $this->data['cat_name'] ?>" /><br/>
        <input type="submit" name="submit" value="Sửa" />
    </form>
</div>