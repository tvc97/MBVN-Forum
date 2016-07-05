<div class="hdr">Ai là triệu phú</div>
<div class="box">
    <div class="row">Bạn đã vượt qua câu hỏi số <?php echo $this->level; ?></div>
<?php if($this->landmark > 0): ?>
    <div class="row">Bạn đang nắm chắc trong tay số điểm: <b><?php echo $this->sure; ?></b></div>
<?php endif; ?>
    <div class="row">Số điểm hiện tại: <b><?php echo $this->point; ?></b></div>
    <div class="row">Nếu vượt qua câu tiếp theo, bạn sẽ dành được số điểm: <b><?php echo $this->next; ?></b></div>
    <div class="row">
        <a class="button" href="<?php echo URL; ?>/game_room/altp/?next">Chơi tiếp</a>
    </div>
</div>