<?php foreach($this->chat as $a): ?>
    <div class="row">
        <span class="<?php echo time() - $a['last'] < 300 && $a['logout'] != 1 ? 'li-green' : 'li-red' ?>">•</span> <a href="<?php echo URL . '/members/' . Helper::mkURL($a['user_name'], $a['user_id']); ?>/"><font color="<?php echo Helper::level_color($a['level']); ?>"><?php echo $a['dname'] ?></font></a>: <?php echo Smilies::parse(Helper::BBCode(Helper::cleanXSS($a['content']))) ?>
    </div>
<?php endforeach;?>
