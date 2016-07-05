<div class="hdr">Danh sách Smilies</div>
<div class="box" style="text-align:center">
<?php $smilies = Smilies::get(); $n = count($smilies); for($i = 0; $i < $n; $i++): $a = $smilies[$i]; $ext = file_exists(ROOT . '/public/img/smilies/' . $i . '.gif') ? '.gif' : '.png'; ?>
    <div class="smile"><img src="<?php echo URL . '/public/img/smilies/' . $i . $ext; ?>" alt="<?php echo $a; ?>" /><p><?php echo $a; ?></p></div>
<?php endfor; ?>
</div>