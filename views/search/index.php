<div class="hdr">Tìm kiếm</div>
<div class="box">
<?php if(isset($this->error)): ?>
    <div class="error"><?php echo $this->error ?></div>
<?php endif; ?>
    <form action="<?php echo URL; ?>/search/" method="get">
        Từ tìm kiếm:<br/>
        <input type="text" name="q" /><br/>
        Tìm trong:<br />
        <select name="t">
            <option value="t" selected="">Tiêu đề</option>
            <option value="p">Bài viết</option>
        </select><br />
        <input type="submit" value="Tìm" />
    </form>
</div>