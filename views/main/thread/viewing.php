<div class="hdr">Đang xem</div>
<div class="box">
    <div class="row">
        <b><?php echo $this->data['view']['total'] ?></b> người đang xem (<b><?php echo $this->data['view']['member'] ?></b> thành viên và <b><?php echo $this->data['view']['guest'] ?></b> khách)<br/>
<?php $n = $this->data['view']['member']; if($n != 0): for($i = 0; $i < $n; $i++): $a = $this->data['member'][$i]; ?>
        <a href="<?php echo URL . '/members/' . $a['user_name'] . '.' . $a['user_id'] ;?>/">
            <font color="<?php echo Helper::level_color($a['level']); ?>"><?php echo $a['dname']; ?></font><?php echo ($i != $n-1) ? ', ' : ''; ?>
        </a>
<?php endfor; endif; ?>
    </div>
</div>