<div class="hdr">Tìm kiếm</div>
<div class="box">
    <div class="row">Có <?php echo $this->num; ?> kết quả cho từ khóa '<b><?php echo $_GET['q'] ?></b>'</div>
<?php foreach ($this->data as $a): ?>
    <div class="row">
        <span class="<?php echo time() - $a['last'] < 300 && $a['logout'] != 1 ? 'li-green' : 'li-red' ?>">•</span>&nbsp;
        <a href="<?php echo URL; ?>/members/<?php echo Helper::mkURL($a['user_name'], $a['user_id']); ?>/"><font color="<?php echo Helper::level_color($a['level']); ?>"><?php echo $a['dname']; ?></font></a> (<?php echo Helper::level_name($a['level']) ?>)<br/>
        (<?php echo date('d/m/Y', $a['reg']) ?> -- <?php echo date('d/m/Y', $a['last']) ?>)
    </div>
<?php endforeach; ?>
</div>