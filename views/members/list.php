<div class="hdr">Danh sách thành viên</div>
<div class="box">
<?php include __DIR__ . '/search_form.php'; ?>
<?php foreach ($this->data as $a): ?>
    <div class="row">
        <span class="<?php echo time() - $a['last'] < 300 && $a['logout'] != 1 ? 'li-green' : 'li-red' ?>">•</span>&nbsp;
        <a href="<?php echo URL; ?>/members/<?php echo Helper::mkURL($a['user_name'], $a['user_id']); ?>/"><font color="<?php echo Helper::level_color($a['level']); ?>"><?php echo $a['dname']; ?></font></a> (<?php echo Helper::level_name($a['level']) ?>)<br/>
        (<?php echo date('d/m/Y', $a['reg']) ?> -- <?php echo date('d/m/Y', $a['last']) ?>)
    </div>
<?php endforeach; ?>
</div>