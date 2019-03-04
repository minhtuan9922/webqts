<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item"><a href="<?=base_url('admin/sanpham') ?>">Sản phẩm</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?=$title ?></li>
		</ol>
	</nav>
	<div class="main">
		<div class="card">
			<div class="card-header bg-info text-white"><?=$title ?></div>
			<div class="card-body">
				<form action="<?=base_url('admin/sanpham/chinhsua/'.$sanpham['idsanpham']) ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="hinhanh">Hình ảnh</label>
						<input type="file" class="form-control" id="hinhanh" name="hinhanh" placeholder="Hình ảnh">
						<div class="space10"></div>
						<img src="<?=base_url('img/sanpham/'.$sanpham['hinhanh']) ?>" id="images" width="200px" class="mx-auto d-block img-thumbnail">
						<input type="text" value="<?=$sanpham['hinhanh'] ?>" name="hinhanhcu" hidden="">
					</div>
					<div class="form-group">
						<label for="tensanpham">Tên sản phẩm</label>
						<input type="text" class="form-control <?php if(form_error('tensanpham')) echo 'is-invalid'; ?>" id="tensanpham" name="tensanpham" required placeholder="Tên sản phẩm" value="<?php if(set_value('tensanpham')) echo set_value('tensanpham'); else echo $sanpham['tensanpham'] ?>">
						<div class="invalid-feedback"><?=form_error('tensanpham') ?></div>
					</div>
					<div class="form-group">
						<label for="mota">Mô tả</label>
						<textarea type="text" class="form-control" id="mota" name="mota" rows="6" placeholder="Mô tả"><?php if(set_value('mota')) echo set_value('mota'); else echo $sanpham['mota'] ?></textarea>
					</div>
					<div class="form-group">
						<label for="gia">Giá</label>
						<input type="text" class="form-control <?php if(form_error('gia')) echo 'is-invalid' ?>" id="gia" name="gia" placeholder="Giá" value="<?php if(set_value('gia')) echo set_value('gia'); else echo (int)$sanpham['gia'] ?>">
						<div class="invalid-feedback"><?=form_error('gia') ?></div>
					</div>
					<div class="grom-group">
						<label for="danhmuc">Danh mục</label>
						<select name="danhmuc" id="danhmuc" class="form-control <?php if(form_error('danhmuc')) echo 'is-invalid' ?>">
							<option value="" selected disabled>Chọn danh mục</option>
							<?php
							if(isset($list_danhmuc))
							{
								foreach($list_danhmuc as $item)
								{
									if(set_value('danhmuc') == $item['iddanhmuc'] || $sanpham['danhmuc'] == $item['iddanhmuc'])
									{
							?>
							<option value="<?=$item['iddanhmuc'] ?>" selected><?=$item['tendanhmuc'] ?></option>
							<?php
									}
									else
									{
							?>
							<option value="<?=$item['iddanhmuc'] ?>"><?=$item['tendanhmuc'] ?></option>
							<?php
									}
								}
							}
							?>
						</select>
						<div class="invalid-feedback"><?=form_error('danhmuc') ?></div>
					</div>
<!--
					<div class="grom-group">
						<label for="status">Danh mục</label>
						<select name="status" id="status" class="form-control">
							<option value="1" <?=set_value('status') == 1 ? 'selected' : '' ?>>Hoạt động</option>
							<option value="0" <?=set_value('status') === 0 ? 'selected' : '' ?>>Vô hiệu hóa</option>
						</select>
					</div>
-->
					<div class="form-check">
						<label class="form-check-label">
					  		<input class="form-check-input" type="checkbox" name="moi" value="1" <?php if(set_value('moi') == 1 || $sanpham['moi'] == 1) echo 'checked'; ?> > Món mới
						</label>
					</div>
					<div class="form-check">
						<label class="form-check-label">
					  		<input class="form-check-input" type="checkbox" name="trangchu" value="1" <?php if(set_value('trangchu') == 1 || $sanpham['trangchu'] == 1) echo 'checked'; ?>> Hiển thị trên trang chủ
						</label>
					</div>
					<div class="form-group">
						<label for="themeta">Thẻ meta</label>
						<input type="text" class="form-control" id="themeta" name="themeta" placeholder="Thẻ meta" value="<?php if(set_value('themeta')) echo set_value('themeta'); else echo $sanpham['themeta'] ?>">
					</div>
					<div class="form-group">
						<label for="keymeta">Từ khóa thẻ meta</label>
						<input type="text" class="form-control" id="keymeta" name="keymeta" placeholder="Từ khóa thẻ meta" value="<?php if(set_value('keymeta')) echo set_value('keymeta'); else echo $sanpham['keymeta'] ?>">
					</div>
					<div class="form-group">
						<label for="motameta">Mô tả thẻ meta</label>
						<input type="text" class="form-control" id="motameta" name="motameta" placeholder="Mô tả thẻ meta" value="<?php if(set_value('motameta')) echo set_value('motameta'); else echo $sanpham['motameta'] ?>">
					</div>
					<button type="submit" name="chinhsua" class="btn btn-primary">Chỉnh sửa</button>
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