    <div id="footer">
        <?php if($this->user->isLoged)if($this->user->level >= 10): ?><a href="<?php echo URL; ?>/admin/">Admin panel</a><br/><?php endif; ?>
<?php if($this->user->isLoged): $theme = Helper::list_theme(); ?>
        <form action="<?php echo URL ?>/theme/change/" method="post">
            <select name="theme">
<?php foreach($theme as $a => $b): ?>
                <option <?php echo $this->user->user_theme == $a ? 'selected=""' : '' ?> value="<?php echo $a ?>"><?php echo $b ?></option>
<?php endforeach; ?>
            </select>
            <input type="submit" value="Chọn màu" />
        </form>
<?php endif; ?>
        <div class="row"><a href="<?php echo URL; ?>/pages/faq/">Quy định</a> - <a href="<?php echo URL; ?>/pages/contact/">Liên hệ</a> - <a href="<?php echo URL; ?>/pages/help/">Trợ giúp</a></div>
        <b>&copy; 2014 - 2016 <a href="<?php echo URL; ?>/"><?php echo strtoupper(SNAME) ?></a><br/>Developed By TVC97</b>
    </div>

</div> <!-- End Wraper!--><?php
global $start_load;
$time_load = round(microtime(true) - $start_load, 4);
echo "\n<!-- load: $time_load (s) !-->\n";
echo '<!-- mem:' . memory_get_usage() . '!-->';
?>

</body>
</html>