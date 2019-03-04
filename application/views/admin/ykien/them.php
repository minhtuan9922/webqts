<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item"><a href="<?=base_url('admin/ykien') ?>">Ý kiến</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?=$title ?></li>
		</ol>
	</nav>
	<div class="main">
		<div class="card">
			<div class="card-header bg-info text-white"><?=$title ?></div>
			<div class="card-body">
				<form action="<?=base_url('admin/ykien/themykien') ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="hoten">Họ tên</label>
						<input type="text" class="form-control <?php if(form_error('hoten')) echo 'is-invalid'; ?>" id="hoten" name="hoten" required placeholder="Họ tên" value="<?php if(set_value('hoten')) echo set_value('hoten'); ?>">
						<div class="invalid-feedback"><?=form_error('hoten') ?></div>
					</div>
					<div class="form-group">
						<label for="noidung">Nội dung</label>
						<textarea type="text" class="form-control <?php if(form_error('noidung')) echo 'is-invalid'; ?>" id="noidung" name="noidung" rows="6" placeholder="Nội dung"><?php if(set_value('noidung')) echo set_value('noidung'); ?></textarea>
						<div class="invalid-feedback"><?=form_error('noidung') ?></div>
					</div>
					<div class="form-group">
						<label for="hinhanh">Hình ảnh</label>
						<input type="file" class="form-control <?php if(isset($error_file)) echo 'is-invalid' ?>" id="hinhanh" name="hinhanh">
						<div class="invalid-feedback"><?=isset($error_file) ? $error_file : '' ?></div>
						<div class="space10"></div>
						<img src="" id="images" width="200px" class="mx-auto d-block img-thumbnail">
					</div>
					<div class="form-check">
						<label class="form-check-label">
					  		<input class="form-check-input" type="checkbox" name="trangchu" value="1" <?php if(set_value('trangchu') == 1) echo 'checked'; ?>> Hiển thị trên trang chủ
						</label>
					</div>
					<button type="submit" name="themykien" class="btn btn-primary">Thêm ý kiến</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#hinhanh').change(function () {
        if ( window.FileReader ) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#images').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    })
</script>