<?php if(isset($_GET['added'])): ?>
<div class="msg">Đã thêm chuyên mục</div>
<?php endif; ?>
<?php if(isset($_GET['edited'])): ?>
<div class="msg">Đã sửa chuyên mục</div>
<?php endif; ?>
<?php if(isset($_GET['deleted'])): ?>
<div class="msg">Đã xóa chuyên mục</div>
<?php endif; ?>
<div class="msg">Chú ý: tất cả lệnh được thực thi ngay lập tức, tất cả bài viết, chủ đề sẽ bị xóa nếu xóa chuyên mục. Cẩn trọng trước khi thực hiện.</div>
<div class="hdr">Quản lý chuyên mục</div>
<div class="box">
    <div class="row">
        <a href="<?php echo URL; ?>/admin/add_root_cat/" class="button2">+ root cat</a><br />
<?php foreach ($this->map['root'] as $root_id => $root_name): ?>
        <?php echo $root_name ?> <a href="<?php echo URL; ?>/admin/edit_cat/<?php echo $root_id; ?>/" class="button2">E</a><a href="<?php echo URL; ?>/admin/del_root_cat/<?php echo $root_id; ?>/" class="button2" onclick="return confirmAction()">-</a><a href="<?php echo URL; ?>/admin/add_cat/<?php echo $root_id; ?>/" class="button2">+ sub cat</a><br />
<?php if(isset($this->map['subcat'][$root_id]))foreach ($this->map['subcat'][$root_id] as $cat_id => $cat_name): ?>
        &nbsp;&nbsp;|-- <?php echo $cat_name ?><a href="<?php echo URL; ?>/admin/edit_cat/<?php echo $cat_id; ?>/" class="button2">E</a><a href="<?php echo URL; ?>/admin/del_cat/<?php echo $cat_id; ?>/" class="button2" onclick="return confirmAction()">-</a><br />
<?php endforeach; ?>
<?php endforeach; ?>
    </div>
</div>
<script>
function confirmAction(){
      var confirmed = confirm("Chắc chắn muốn xóa?");
      return confirmed;
}
</script>