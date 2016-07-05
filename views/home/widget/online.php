<?php $n = count($this->online); ?>
<div class="hdr">Trực tuyến</div>
<div class="box">
    <div class="row">
        Có <b><?php echo $this->counter['online'] ?></b> người đang trực tuyến (<b><?php echo $this->counter['member'] ?></b> thành viên và <b><?php echo $this->counter['guest'] ?></b> khách)<br/>
<?php for($i = 0; $i < $n; $i++): $a = $this->online[$i]; ?>
    <a href="<?php echo URL . '/members/' . $a['user_name'] . '.' . $a['user_id'] ;?>/">
        <font color="<?php echo Helper::level_color($a['level']); ?>"><?php echo $a['dname']; ?></font><?php echo ($i != $n-1) ? ', ' : ''; ?>
    </a>
<?php endfor; ?>
    </div>
</div>