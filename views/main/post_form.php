<?php if(!defined('RO')): ?>
<a name="pf"></a>
<div class="hdr">Trả lời</div>
<div class="box">
    <form action="<?php echo URL; ?>/upanel/post_add/<?php echo $this->thread['thread_id']; ?>" method="post" class="post-form">
        Nội dung:<br/>
        <textarea rows="3" name="content"><?php if(isset($this->quote)) echo '[quote=' . $this->quote[0] . ']' . Helper::cleanHTML(trim(Helper::removeQuote($this->quote[1]))) . '[/quote]'; ?></textarea><br/>
        <a class="button2" href="<?php echo URL; ?>/pages/bbcode/">BBCode</a>
        <a class="button2" href="<?php echo URL; ?>/pages/smilies/">Smilies</a><br/>
        <input type="submit" value="Gửi" />
    </form>
</div>
<?php endif; ?>