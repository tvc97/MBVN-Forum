<div class="hdr">Ai là triệu phú</div>
<div class="box">
    <center class="row">
        <div class="ordinal">Câu <?php echo $this->data['level']; ?></div><br/>
        <div class="vline"></div>
        <div class="tleft">Thời gian: <?php echo $this->data['tleft']; ?></div><br/>
        <div class="vline"></div>
        <div class="tleft">Điểm: <?php echo $this->data['money']; ?></div>
    </center>
    <div class="row1">
        <?php echo substr($this->data['question'], strpos($this->data['question'], '.') + 1) ?>
    </div>
    <form action="<?php echo URL; ?>/game_room/altp/" method="post">
        <div class="row">
            <label><input type="radio" name="answer" value="a" /> <?php echo $this->data['a']; ?></label>
        </div>
        <div class="row">
            <label><input type="radio" name="answer" value="b" /> <?php echo $this->data['b']; ?></label>
        </div>
        <div class="row">
            <label><input type="radio" name="answer" value="c" /> <?php echo $this->data['c']; ?></label>
        </div>
        <div class="row">
            <label><input type="radio" name="answer" value="d" /> <?php echo $this->data['d']; ?></label>
        </div>
        <div class="row">
            <input type="submit" class="button" value="Trả lời"/><a class="button" href="<?php echo URL; ?>/game_room/altp/stop/">Dừng cuộc chơi</a>
        </div>
    </form>
</div>