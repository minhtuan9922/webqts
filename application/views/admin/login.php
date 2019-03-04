<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php if(isset($title)) echo $title; else echo 'phimmt'; ?></title>
	<link rel="icon" href="<?=base_url('asset/') ?>img/icon.png">
	<link rel="stylesheet" href="<?=base_url('asset/') ?>css/bootstrap.css">
	<link rel="stylesheet" href="<?=base_url('asset/') ?>css/style.css">
	<link rel="stylesheet" href="<?=base_url('asset/') ?>fontawesome-free-5.0.6/web-fonts-with-css/css/fontawesome-all.css">
	<script type="text/javascript" src="<?=base_url('asset/') ?>js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?=base_url('asset/') ?>js/popper.min.js"></script>
	<script type="text/javascript" src="<?=base_url('asset/') ?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url('asset/') ?>js/scrollreveal.min.js"></script>
	<script type="text/javascript" src="<?=base_url('asset/') ?>js/custom.js"></script>
</head>

<body>
	<div class="container-login">
		<div class="container">
			<div class="row align-items-center justify-content-center login-height">
				<div class="col-lg-6">
					<div class="login">
						<h4 class="text-center text-white">Đăng nhập trang quản trị</h4>
						<form enctype="multipart/form-data" method="post" action="<?=base_url('admin/login') ?>">
							<div class="form-group">
								<label for="account" class="text-white">Tài khoản:</label>
								<input type="text" class="form-control" id="account" name="account" placeholder="Nhập tài khoản">
							</div>
							<div class="form-group">
								<label for="password" class="text-white">Mật khẩu:</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
							</div>
							<button type="submit" name="dangnhap" class="btn btn-success">Đăng nhập</button>
							<a href="<?=base_url() ?>" class="btn btn-danger">Hủy</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>