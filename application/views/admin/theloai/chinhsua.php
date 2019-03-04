<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item"><a href="<?=base_url('admin/theloai') ?>">Thể loại</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?=$title ?></li>
		</ol>
	</nav>
	<div class="main">
		<div class="card">
			<div class="card-header bg-info text-white"><?=$title ?></div>
			<div class="card-body">
				<form action="<?=base_url('admin/theloai/chinhsua/'.$theloai['id_theloai']) ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="tentheloai">Tên thể loại</label>
						<input type="text" class="form-control" id="tentheloai" name="tentheloai" value="<?=$theloai['tentheloai'] ?>">
					</div>
					<div class="form-group">
						<label for="tentheloai_kd">Tên thể loại không dấu</label>
						<input type="" class="form-control" id="tentheloai_kd" name="tentheloai_kd" value="<?=$theloai['tentheloai_kd'] ?>">
					</div>
					<button type="submit" name="luu" class="btn btn-primary">Lưu thể loại</button>
				</form>
			</div>
		</div>
	</div>
</div>