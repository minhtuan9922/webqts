<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?=$title ?></li>
		</ol>
	</nav>
	<div class="main">
		<div class="card">
			<div class="card-header bg-info text-white"><?=$title ?></div>
			<div class="card-body">
				<form action="<?=base_url('admin/setting') ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="ten_website">Tên website</label>
						<input type="text" class="form-control" id="ten_website" name="ten_website" placeholder="Tên website" value="<?php if(isset($ten_website)) echo $ten_website ?>">
					</div>
					<div class="form-group">
						<label for="dienthoai">Số điện thoại</label>
						<input type="text" class="form-control" id="dienthoai" name="dienthoai" placeholder="Số điện thoại" value="<?php if(isset($dienthoai)) echo $dienthoai ?>">
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email ?>">
					</div>
					<div class="form-group">
						<label for="diachi">Địa chỉ</label>
						<input type="text" class="form-control" id="diachi" name="diachi" placeholder="Địa chỉ" value="<?php if(isset($diachi)) echo $diachi ?>">
					</div>
					<div class="form-group">
						<label for="diachi_website">Địa chỉ website</label>
						<input type="text" class="form-control" id="diachi_website" name="diachi_website" placeholder="Địa chỉ website" value="<?php if(isset($diachi_website)) echo $diachi_website ?>">
					</div>
					<button type="submit" class="btn btn-primary">Lưu</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Đọc file XML</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="file_xml">File XML</label>
					<input type="file" class="form-control" id="file_xml" name="file_xml">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onClick="docfile_xml()">Đọc file</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#docfile_xml').click(function(e) {
			e.preventDefault();
		});
	});
	function docfile_xml() {
		var file_xml = $('#file_xml').prop('files')[0];
		var form_data = new FormData();
        form_data.append("file_xml", file_xml);
		$.ajax({
			typeData: "JSON",
			url: "<?=base_url('admin/phim/xulyfile_xml') ?>",
			method: "POST",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false, 
		}).done(function(ketqua) {
			var dulieu = JSON.parse(ketqua);
			$('#tenphim_en').val(dulieu.tenphim_en);
			$('#daodien').val(dulieu.daodien);
			$('#kichban').val(dulieu.kichban);
			$('#dienvien').val(dulieu.dienvien);
			$('#theloai').val(dulieu.theloai);
			$('#nam_sanxuat').val(dulieu.nam_sanxuat);
			$('#thoiluong').val(dulieu.thoiluong);
			$('#diem_imdb').val(dulieu.diem_imdb);
			$('#trailer').val(dulieu.trailer);
		});
	}
	function chonhinh() 
	{}
	$('#hinhanh').change(function () {
        if ( window.FileReader ) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#images').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    })
	$(function() { 
		$('textarea').froalaEditor({
			iconsTemplate: 'font_awesome_5',
			heightMin: 300,
			language: 'vi',
			imageManagerLoadURL: '<?=base_url('admin/images') ?>',
			imageManagerDeleteURL: '<?=base_url('admin/images/delete_file') ?>',
			imageUploadURL: '<?=base_url('admin/images/upload_file') ?>'
		}) 
	}); 
</script>