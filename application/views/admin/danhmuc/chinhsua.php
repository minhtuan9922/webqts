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
				<form action="<?=base_url('admin/danhmuc/chinhsua/'.$danhmuc['iddanhmuc']) ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="tendanhmuc">Tên danh mục</label>
						<input type="text" class="form-control <?php if(form_error('tendanhmuc')) echo 'is-invalid' ?>" id="tendanhmuc" name="tendanhmuc" value="<?php if(set_value('tendanhmuc')) echo set_value('tendanhmuc'); else echo $danhmuc['tendanhmuc'] ?>">
						<div class="invalid-feedback"><?=form_error('tendanhmuc') ?></div>
					</div>
					<div class="form-group">
						<label for="tenkhongdau">Tên danh mục không dấu</label>
						<input type="text" class="form-control <?php if(form_error('tenkhongdau')) echo 'is-invalid' ?>" id="tenkhongdau" name="tenkhongdau" value="<?php if(set_value('tenkhongdau')) echo set_value('tenkhongdau'); else echo $danhmuc['tenkhongdau'] ?>">
						<div class="invalid-feedback"><?=form_error('tenkhongdau') ?></div>
					</div>
					<div class="form-group">
						<label for="hinhanh">Hình ảnh</label>
						<input type="file" class="form-control <?php if(form_error('hinhanh')) echo 'is-invalid' ?>" id="hinhanh" name="hinhanh" value="<?php if(set_value('hinhanh')) echo set_value('hinhanh'); ?>">
						<div class="invalid-feedback"><?=form_error('hinhanh') ?></div>
						<div class="space10"></div>
						<img src="<?=base_url('img/'.$danhmuc['hinhanh']) ?>" id="images" width="100px" class="mx-auto d-block img-thumbnail">
						<input type="text" name="hinhanhcu" value="<?=$danhmuc['hinhanh'] ?>" hidden="">
					</div>
					<button type="submit" name="sua" class="btn btn-primary">Lưu</button>
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