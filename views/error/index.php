<?php if(isset($this->addition))
    echo $this->addition;
?>
<div class="hdr">Lỗi</div>
<div class="box">
    <div class="row">
        <div class="error"><?php echo isset($this->msg) ? $this->msg : 'Đã xảy ra lỗi!' ;?></div>
    </div>
</div>