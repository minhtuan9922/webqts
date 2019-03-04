<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item"><a href="<?=base_url('admin/phim') ?>">Phim</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?=$title ?></li>
		</ol>
	</nav>
	<div class="main">
		<div class="card">
			<div class="card-header bg-info text-white"><?=$title ?></div>
			<div class="card-body">
				<form action="<?=base_url('admin/theloai/them') ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="tentheloai">Tên thể loại</label>
						<input type="text" class="form-control" id="tentheloai" name="tentheloai">
					</div>
					<button type="submit" name="themtheloai" class="btn btn-primary">Thêm thể loại</button>
				</form>
			</div>
		</div>
	</div>
</div>