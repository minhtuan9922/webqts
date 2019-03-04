<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item"><a href="<?=base_url('admin/baiviet') ?>">Bài viết</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?=$title ?></li>
		</ol>
	</nav>
	<div class="main">
		<div class="card">
			<div class="card-header bg-info text-white"><?=$title ?></div>
			<div class="card-body">
				<form action="<?=base_url('admin/baiviet/chinhsua/'.$baiviet['idbaiviet']) ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="tenbaiviet">Tên bài viết</label>
						<input type="text" class="form-control <?php if(form_error('tenbaiviet')) echo 'is-invalid'; ?>" id="tenbaiviet" name="tenbaiviet" required placeholder="Tên bài viết" value="<?php if(set_value('tenbaiviet')) echo set_value('tenbaiviet'); else echo $baiviet['tenbaiviet'] ?>">
						<div class="invalid-feedback"><?=form_error('tenbaiviet') ?></div>
					</div>
					<div class="form-group">
						<label for="mabaiviet">Mã bài viết</label>
						<input type="text" class="form-control <?php if(form_error('mabaiviet')) echo 'is-invalid'; ?>" id="mabaiviet" name="mabaiviet" required placeholder="Mã bài viết" value="<?php if(set_value('mabaiviet')) echo set_value('mabaiviet'); else echo $baiviet['mabaiviet'] ?>">
						<div class="invalid-feedback"><?=form_error('mabaiviet') ?></div>
					</div>
					<div class="form-group">
						<label for="noidungxemtruoc">Mô tả ngắn</label>
						<textarea type="text" class="form-control <?php if(form_error('noidungxemtruoc')) echo 'is-invalid'; ?>" id="noidungxemtruoc" name="noidungxemtruoc" rows="6" placeholder="Mô tả"><?php if(set_value('noidungxemtruoc')) echo set_value('noidungxemtruoc'); else echo $baiviet['noidungxemtruoc'] ?></textarea>
						<div class="invalid-feedback"><?=form_error('noidungxemtruoc') ?></div>
					</div>
					<div class="form-group">
						<label for="noidung">Nội dung</label>
						<textarea type="text" class="form-control <?php if(form_error('noidung')) echo 'is-invalid'; ?>" id="noidung" name="noidung" rows="6" placeholder="Nội dung"><?php if(set_value('noidung')) echo set_value('noidung'); else echo $baiviet['noidung'] ?></textarea>
						<div class="invalid-feedback"><?=form_error('noidung') ?></div>
					</div>
					<div class="form-group">
						<label for="themeta">Thẻ meta</label>
						<input type="text" class="form-control" id="themeta" name="themeta" placeholder="Thẻ meta" value="<?php if(set_value('themeta')) echo set_value('themeta'); else echo $baiviet['themeta'] ?>">
					</div>
					<div class="form-group">
						<label for="keymeta">Từ khóa thẻ meta</label>
						<input type="text" class="form-control" id="keymeta" name="keymeta" placeholder="Từ khóa thẻ meta" value="<?php if(set_value('keymeta')) echo set_value('keymeta'); else echo $baiviet['keymeta'] ?>">
					</div>
					<div class="form-group">
						<label for="motameta">Mô tả thẻ meta</label>
						<input type="text" class="form-control" id="motameta" name="motameta" placeholder="Mô tả thẻ meta" value="<?php if(set_value('motameta')) echo set_value('motameta'); else echo $baiviet['motameta'] ?>">
					</div>
					<button type="submit" name="chinhsua" class="btn btn-primary">Chỉnh sửa bài viết</button>
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
		$('#noidung').froalaEditor({
			iconsTemplate: 'font_awesome_5',
			heightMin: 300,
			language: 'vi',
			imageManagerLoadURL: '<?=base_url('admin/images') ?>',
			imageManagerDeleteURL: '<?=base_url('admin/images/delete_file') ?>',
			imageUploadURL: '<?=base_url('admin/images/upload_file') ?>'
		}) 
	}); 
</script>