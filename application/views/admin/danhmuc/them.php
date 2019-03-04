<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item"><a href="<?=base_url('admin/danhmuc') ?>">Danh mục</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?=$title ?></li>
		</ol>
	</nav>
	<div class="main">
		<div class="card">
			<div class="card-header bg-info text-white"><?=$title ?></div>
			<div class="card-body">
				<form action="<?=base_url('admin/danhmuc/them') ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="tendanhmuc">Tên danh mục</label>
						<input type="text" class="form-control <?php if(form_error('tendanhmuc')) echo 'is-invalid' ?>" id="tendanhmuc" name="tendanhmuc" value="<?php if(set_value('tendanhmuc')) echo set_value('tendanhmuc'); ?>">
						<div class="invalid-feedback"><?=form_error('tendanhmuc') ?></div>
					</div>
					<div class="form-group">
						<label for="hinhanh">Hình ảnh</label>
						<input type="file" class="form-control <?php if(isset($error_file)) echo 'is-invalid' ?>" id="hinhanh" name="hinhanh">
						<div class="invalid-feedback"><?=isset($error_file) ? $error_file : '' ?></div>
						<div class="space10"></div>
						<img src="" id="images" width="100px" class="mx-auto d-block img-thumbnail">
					</div>
					<button type="submit" name="them" class="btn btn-primary">Thêm danh mục</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
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