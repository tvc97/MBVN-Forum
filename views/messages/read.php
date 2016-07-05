<div class="hdr">Đọc tin nhắn</div>
<div class="box">
<?php if ($this->is_receiver): ?>
    <div class="row">
        Tin nhắn từ <a href="<?php echo URL . '/members/' . $this->data['user_name'] . '.' . $this->data['user_id']; ?>"><font color="<?php echo Helper::level_color($this->data['level']); ?>"><?php echo $this->data['dname']; ?></font></a><br />
        (<?php echo date('H:i:s d/m/Y', $this->data['time']); ?>)<br/>
        Nội dung:
    </div>
    <div class="row">
        <?php echo Smilies::parse(Helper::BBCode(Helper::cleanXSS($this->data['content']))); ?><br/><br/>
        <a href="<?php echo URL . '/messages/send/' . $this->data['user_id']; ?>/">Trả lời</a>
    </div>
<?php else: ?>
    <div class="row">
        Gửi đến <a href="<?php echo URL . '/members/' . $this->data['user_name'] . '.' . $this->data['user_id']; ?>"><font color="<?php echo Helper::level_color($this->data['level']); ?>"><?php echo $this->data['dname']; ?></font></a><br />
        (<?php echo date('H:i:s d/m/Y', $this->data['time']); ?>)<br/>
        Nội dung:
    </div>
    <div class="row">
        <?php echo Smilies::parse(Helper::BBCode(Helper::cleanXSS($this->data['content']))); ?><br/><br/>
        <a href="<?php echo URL . '/messages/send/' . $this->data['user_id']; ?>/">Gửi tin nhắn</a>
    </div>
<?php endif; ?>
</div>