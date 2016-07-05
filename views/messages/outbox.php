<?php if(isset($_GET['sended'])): ?>
<div class="msg">Đã gửi tin nhắn<br />[UR]: Chưa đọc (unread)</div>
<?php endif; ?>
<div class="hdr">Hộp thư đi</div>
<div class="box">
    <?php $n = count($this->data); for($i = 0; $i < $n; $i++): $a = $this->data[$i]; $r = $a['read']==1; ?>
    <div class="row">
        <a href="<?php echo URL; ?>/messages/read/<?php echo $a['message_id']; ?>/"><?php echo !$r ? '<font style="font-weight:bold">[UR] ' : ''; ?>Tin nhắn đến <?php echo $a['dname']; ?><?php echo !$r ? '</font>' : ''; ?></a><br />
        <?php echo date('H:i:s d/m/Y', $a['time']); ?>
    </div>
<?php endfor; ?>
</div>