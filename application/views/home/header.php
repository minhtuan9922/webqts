<nav class="navbar navbar-expand navbar-dark bg-dark sticky-top">
	<div class="container">
		<a class="navbar-brand logo" href="<?=base_url() ?>" style="width: 94px"><img src="<?=base_url() ?>img/logo1.png"></a>
<!--
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
-->
<!--		<div class="collapse navbar-collapse" id="navbarSupportedContent">-->
			<ul class="navbar-nav">
				<li class="nav-item <?php if( $this->uri->segment('1') == '') echo 'active'; ?>">
					<a class="nav-link" href="<?=base_url() ?>">TRANG CHỦ </a>
				</li>
				<li class="nav-item dropdown <?php if( $this->uri->segment('1') == 'thucdon') echo 'active'; ?>">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">THỰC ĐƠN</a>
					<div class="dropdown-menu bg-dark menu-drop" aria-labelledby="navbarDropdown">
						<a class="dropdown-item text-light" href="<?=base_url('thucdon/monmoi') ?>">MÓN MỚI</a>
						<?php
						$danhmuc = $this->mdanhmuc->get_danhmuc(0);
					   	if(!empty($danhmuc))
						{
							foreach($danhmuc as $tmp)
							{
						?>
						<a class="dropdown-item text-light" href="<?=base_url('thucdon/'.$tmp['tenkhongdau']) ?>"><?=mb_convert_case($tmp['tendanhmuc'], MB_CASE_UPPER, 'UTF-8') ?></a>
						<?php
							}
						}
					   	?>
					</div>
				</li>
				<li class="nav-item <?php if( $this->uri->segment('1') == 'gioithieu') echo 'active'; ?>">
					<a class="nav-link" href="<?=base_url('gioithieu') ?>">GIỚI THIỆU </a>
				</li>
				<li class="nav-item <?php if( $this->uri->segment('1') == 'hinhanh') echo 'active'; ?>">
					<a class="nav-link" href="<?=base_url('hinhanh') ?>">HÌNH ẢNH </a>
				</li>
				<li class="nav-item <?php if( $this->uri->segment('1') == 'lienhe') echo 'active'; ?>">
					<a class="nav-link" href="<?=base_url('lienhe') ?>">LIÊN HỆ </a>
				</li>
				
			</ul>
			<form class="form-inline my-2 my-lg-0 form-timkiem ml-auto">
				<input class="form-control mr-sm-2 bg-secondary text-light input-dark" type="search" placeholder="Tìm kiếm" aria-label="Search" id="timkiem" autocomplete="off">
				<button class="btn btn-secondary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
				<div class="ketqua bg-secondary">
					
				</div>
			</form>
<!--
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="#" data-toggle="modal" data-target="#dangnhap">Đăng nhập</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#" data-toggle="modal" data-target="#dangky">Đăng ký</a>
				</li>
			</ul>
-->
<!--		</div>-->
	</div>
</nav>
<!--Model đăng nhập-->
<div class="modal fade" id="dangnhap">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<form>
				<div class="modal-header border-b-dark">
					<h4 class="modal-title text-light">Đăng nhập</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="email_dangnhap" class="text-light">Email</label>
						<input type="email" id="email_dangnhap" name="email_dangnhap" class="form-control bg-secondary input-dark text-light" placeholder="Nhập email">
					</div>
					<div class="form-group">
						<label for="matkhau_dangnhap" class="text-light">Mật khẩu</label>
						<input type="password" id="matkhau_dangnhap" name="matkhau_dangnhap" class="form-control bg-secondary input-dark text-light" placeholder="Nhập mật khẩu">
					</div>
				</div>
				<div class="modal-footer border-t-dark">
					<p class="text-light text-model-footer">Bạn chưa có tài khoản? <a href="#" data-toggle="modal" data-target="#dangky" data-dismiss="modal">Đăng ký</a></p>
					<button type="submit" class="btn btn-success">Đăng nhập</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--Model đăng ký-->
<div class="modal fade" id="dangky">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<form>
				<div class="modal-header border-b-dark">
					<h4 class="modal-title text-light">Đăng ký</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="email_dangky" class="text-light">Email</label>
						<input type="email" id="email_dangky" name="email_dangky" class="form-control bg-secondary input-dark text-light" placeholder="Nhập email">
					</div>
					<div class="form-group">
						<label for="matkhau_dangky" class="text-light">Mật khẩu</label>
						<input type="password" id="matkhau_dangky" name="matkhau_dangky" class="form-control bg-secondary input-dark text-light" placeholder="Nhập mật khẩu">
					</div>
					<div class="form-group">
						<label for="nhaplai_matkhau" class="text-light">Nhập lại mật khẩu</label>
						<input type="password" id="nhaplai_matkhau" name="nhaplai_matkhau" class="form-control bg-secondary input-dark text-light" placeholder="Nhập lại mật khẩu">
					</div>
					<div class="form-group">
						<label for="ngaysinh" class="text-light">Ngày sinh</label>
						<input type="date" id="ngaysinh" name="ngaysinh" class="form-control bg-secondary input-dark text-light">
					</div>
					<div class="form-group">
						<label for="gioitinh" class="text-light">Giới tính</label>
						<select class="form-control bg-secondary input-dark text-light">
							<option>Chọn giới tính</option>
							<option value="1">Nam</option>
							<option value="2">Nữ</option>
						</select>
					</div>
				</div>
				<div class="modal-footer border-t-dark">
					<p class="text-light text-model-footer">Bạn đã có tài khoản? <a href="#" data-toggle="modal" data-target="#dangnhap" data-dismiss="modal">Đăng nhập</a></p>
					<button type="submit" class="btn btn-success">Đăng ký</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#timkiem').keyup(function() {
			$('.ketqua').show('fast');
			var tukhoa = $('#timkiem').val();
			$(window).click(function() {
				$('.ketqua').hide();
			});
			$.ajax({
				method:"POST",
				url: "<?=base_url('home/timkiem') ?>",
				data:{tukhoa:tukhoa},
				success: function(result)
				{
					$('.ketqua').html(result);
				}
			});
		});
	});
</script>