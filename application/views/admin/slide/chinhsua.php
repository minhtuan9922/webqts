<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item"><a href="<?=base_url('admin/slide') ?>">Slide</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?=$title ?></li>
		</ol>
	</nav>
	<div class="main">
		<div class="card">
			<div class="card-header bg-info text-white"><?=$title ?></div>
			<div class="card-body">
				<form action="<?=base_url('admin/slide/chinhsua/'.$slide['id_slide']) ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="background">Background</label>
						<input type="file" class="form-control" id="background" name="background">
						<div class="space10"></div>
						<img src="<?=base_url('img/slide/'.$slide['background']) ?>" id="img_background" width="400px" class="mx-auto d-block img-thumbnail" style="display: none">
					</div>
					<div class="form-group">
						<label for="thutu">Thứ tự</label>
						<input type="number" class="form-control <?php if(form_error('thutu')) echo 'is-invalid' ?>" id="thutu" name="thutu" value="<?php if(set_value('thutu')) echo set_value('thutu'); else echo $slide['vitri']; ?>">
						<div class="invalid-feedback"><?=form_error('thutu') ?></div>
					</div>
					<button type="submit" name="chinhsua" class="btn btn-primary">Lưu</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$('#background').change(function () {
        if ( window.FileReader ) {
            var reader = new FileReader();
            reader.onload = function (e) {
				$('#img_background').show();
				$('#img_background').addClass('d-block');
                $('#img_background').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    })
	$('#chonphim').change(function() {
		var id = $( "select option:selected" ).val();
		$.ajax({
			dataType: "JSON",
			url: "<?=base_url('admin/slide/get_phim') ?>",
			method: "POST",
			data: {id:id} 
		}).done(function(json) {
			$('#poster').val(json.poster);
			$('#images').attr('src', '<?=base_url('img/poster/') ?>'+json.poster);
			$('#images').show();
			$('#images').addClass('d-block');
		});
	})
</script>