<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item"><a href="<?=base_url('admin/hinhanh') ?>">Hình ảnh</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?=$title ?></li>
		</ol>
	</nav>
	<div class="main">
		<div class="card">
			<div class="card-header bg-info text-white"><?=$title ?></div>
			<div class="card-body">
				<form action="<?=base_url('admin/hinhanh/themhinhanh') ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="hinhanh">Hình ảnh</label>
						<input type="file" class="form-control <?php if(isset($error_hinhanh)) echo 'is-invalid'; ?>" id="hinhanh1" name="hinhanh" placeholder="Hình ảnh">
						<div class="invalid-feedback"><?=isset($error_hinhanh) ? $error_hinhanh : '' ?></div>
						<div class="space10"></div>
						<img src="" id="images" width="200px" class="mx-auto d-block img-thumbnail">
					</div>
					<button type="submit" name="themhinhanh" class="btn btn-primary">Thêm hình ảnh</button>
				</form>
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