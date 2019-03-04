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
				<form action="<?=base_url('admin/phim/chinhsua/'.$chitietphim['id_phim']) ?>" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="tenphim_vn">Tựa Tiếng Việt</label>
								<input type="text" class="form-control" id="tenphim_vn" name="tenphim_vn" required value="<?=$chitietphim['tenphim_vn'] ?>">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="tenphim_en">Tựa Tiếng Anh</label>
								<input type="text" class="form-control" id="tenphim_en" name="tenphim_en" required value="<?=$chitietphim['tenphim_en'] ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="daodien">Đạo diễn</label>
								<input type="text" class="form-control" id="daodien" name="daodien" value="<?=$chitietphim['daodien'] ?>">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="kichban">Kịch bản</label>
								<input type="text" class="form-control" id="kichban" name="kichban" value="<?=$chitietphim['kichban'] ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="dienvien">Diễn viên</label>
						<input type="text" class="form-control" id="dienvien" name="dienvien" value="<?=$chitietphim['dienvien'] ?>">
					</div>
					<div class="form-group">
						<label for="theloai">Thể loại</label>
						<input type="" class="form-control" id="theloai" name="theloai" value="<?=$chitietphim['theloai'] ?>">
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="nam_sanxuat">Năm sản xuất</label>
								<input type="number" class="form-control" id="nam_sanxuat" name="nam_sanxuat" value="<?=$chitietphim['nam_sanxuat'] ?>">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="thoiluong">Thời lượng</label>
								<input type="text" class="form-control" id="thoiluong" name="thoiluong" value="<?=$chitietphim['thoiluong'] ?>">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="diem_imdb">Điểm IMDB</label>
								<input type="text" class="form-control" id="diem_imdb" name="diem_imdb" value="<?=$chitietphim['diem_imdb'] ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="link_phude">Link phụ đề</label>
						<input type="text" class="form-control" id="link_phude" name="link_phude" value="<?=$chitietphim['link_phude'] ?>">
					</div>
					<div class="form-group">
						<label for="link_thuyetminh">Link thuyết minh</label>
						<input type="text" class="form-control" id="link_thuyetminh" name="link_thuyetminh" value="<?=$chitietphim['link_thuyetminh'] ?>">
					</div>
					<div class="form-group">
						<label for="gioithieu">Giới thiệu</label>
						<textarea type="text" class="form-control" id="gioithieu" name="gioithieu" rows="6"><?=$chitietphim['gioithieu'] ?></textarea>
					</div>
					<div class="form-group">
						<label for="trailer">Trailer</label>
						<input type="text" class="form-control" id="trailer" name="trailer" value="<?=$chitietphim['trailer'] ?>">
					</div>
					<div class="form-group">
						<label for="poster">Poster</label>
						<input type="file" class="form-control" id="poster" name="poster">
						<input type="text" value="<?=$chitietphim['poster'] ?>" name="poster_cu" hidden="">
						<div class="space10"></div>
						<img src="<?=base_url('img/poster/'.$chitietphim['poster']) ?>" id="images" width="200px" class="mx-auto d-block img-thumbnail">
					</div>
					<div class="form-check">
						<label class="form-check-label">
					  		<input class="form-check-input" type="checkbox" name="phimbo" value="1" <?php if($chitietphim['phimbo'] == 1) echo 'checked'; ?> > Phim bộ
						</label>
					</div>
					<button type="submit" name="luu" class="btn btn-primary">Lưu phim</button>
					<button class="btn btn-info" data-toggle="modal" data-target="#myModal" id="docfile_xml">Đọc file XML</button>
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
	$('#poster').change(function () {
        if ( window.FileReader ) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#images').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    })
</script>