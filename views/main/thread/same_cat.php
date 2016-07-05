<div class="hdr">Cùng chuyên mục</div>
<div class="box">
<?php $i = 0; foreach ($this->data as $a): $i++; ?>
    <div class="row"><span class="li">•</span> <a href="<?php echo URL . '/threads/' . Helper::mkURL($a['thread_name'], $a['thread_id']); ?>"><?php echo $a['thread_name']; ?></a></div>
<?php endforeach; if($i == 0) : ?>
    <div class="row">Không có chủ đề nào</div>
<?php endif; ?>
</div>