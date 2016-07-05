<div class="hdr">Chuyên mục</div>
<div class="box">
<?php $n = count($this->data); for($i = 0; $i < $n; $i++): $a = $this->data[$i]; ?>
    <div class="row"><span class="li">•</span> <a href="<?php echo URL; ?>/cats/<?php echo Helper::mkURL($a['cat_name'], $a['cat_id']); ?>/"><?php echo $a['cat_name'] ?></a></div>
<?php endfor;?>
</div>