<div class="hdr">Trực tuyến</div>
<div class="box">
    <div class="row">
        Có <b><?php echo $this->data['online'] ?></b> người đang trực tuyến (<b><?php echo $this->data['member'] ?></b> thành viên và <b><?php echo $this->data['guest'] ?></b> khách)<br/>
    </div>
<?php if($this->data['member'] !=0 ): ?>
    <div class="row">
        Các thành viên đang trực tuyến:<br/>
<?php $n = count($this->onl); for($i = 0; $i < $n; $i++): $a = $this->onl[$i]; ?>
        <a href="<?php echo URL . '/members/' . $a['user_name'] . '.' . $a['user_id'] ;?>/">
            <font color="<?php echo Helper::level_color($a['level']); ?>"><?php echo $a['dname']; ?></font><?php echo ($i != $n-1) ? ', ' : ''; ?>
        </a>
<?php endfor; ?>
    </div>
<?php endif; ?>
<div class="hdr">Truy cập</div>
    <div class="row">
        Hôm nay: <?php echo $this->data['today']; ?><br/>
    </div>
    <div class="row">
        Tổng: <?php echo $this->data['total']; ?>
    </div>
</div>