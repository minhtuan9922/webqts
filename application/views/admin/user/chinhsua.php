<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item"><a href="<?=base_url('admin/user') ?>">Quảng trị viên</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?=$title ?></li>
		</ol>
	</nav>
	<div class="main">
		<div class="card">
			<div class="card-header bg-info text-white"><?=$title ?></div>
			<div class="card-body">
				<form action="<?=base_url('admin/user/chinhsua/'.$user['id']) ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="account">Tài khoản <span class="text-red">*</span></label>
						<input type="text" name="account" id="account" value="<?php if(set_value('account')) echo set_value('account'); else echo $user['account']; ?>" placeholder="Tài khoản" class="form-control <?php if(form_error('account')) echo 'is-invalid' ?>" readonly>
						<div class="invalid-feedback"><?=form_error('account') ?></div>
						<div class="space10"></div>
					</div>
					<div class="form-group">
						<label for="ten">Họ tên <span class="text-red">*</span></label>
						<input type="text" name="ten" id="ten" value="<?php if(set_value('ten')) echo set_value('ten'); else echo $user['ten']; ?>" placeholder="Họ tên" class="form-control <?php if(form_error('ten')) echo 'is-invalid' ?>">
						<div class="invalid-feedback"><?=form_error('ten') ?></div>
						<div class="space10"></div>
					</div>
					<div class="form-group">
						<label for="password">Mật khẩu cũ</label>
						<input type="password" name="password" id="password" value="<?=isset($password) ? $password : '' ?>" placeholder="Mật khẩu cũ" class="form-control <?php if(isset($error_password)) echo 'is-invalid' ?>">
						<?php
						if(isset($error_password))
						{
						?>
						<div class="invalid-feedback"><?=$error_password ?></div>
						<?php
						}
						?>
						<div class="space10"></div>
					</div>
					<div class="form-group">
						<label for="password_new">Mật khẩu mới</label>
						<input type="password" name="password_new" id="password_new" value="<?php if(set_value('password_new')) echo set_value('password_new'); ?>" placeholder="Mật khẩu mới" class="form-control <?php if(form_error('password_new')) echo 'is-invalid' ?>">
						<div class="invalid-feedback"><?=form_error('password_new') ?></div>
						<div class="space10"></div>
					</div>
					<div class="form-group">
						<label for="re_password_new">Nhập lại mật khẩu mới</label>
						<input type="password" name="re_password_new" id="re_password_new" value="<?php if(set_value('re_password_new')) echo set_value('re_password_new'); ?>" placeholder="Nhập lại mật khẩu mới" class="form-control <?php if(form_error('re_password_new')) echo 'is-invalid' ?>">
						<div class="invalid-feedback"><?=form_error('re_password_new') ?></div>
						<div class="space10"></div>
					</div>
					<div class="form-group">
						<label for="background" hidden="">Trạng thái</label>
						<select name="active" class="form-control" id="active" hidden="">
							<option value="1" <?=$user['active'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
							<option value="0" <?=$user['active'] == 0 ? 'selected' : '' ?>>Đình chỉ</option>
						</select>
						<div class="invalid-feedback"><?=form_error('active') ?></div>
					</div>
					<button type="submit" name="chinhsua" class="btn btn-primary">Lưu</button>
				</form>
			</div>
		</div>
	</div>
</div>