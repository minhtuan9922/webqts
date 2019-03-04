<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item"><a href="<?=base_url('admin/video') ?>">Video</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?=$title ?></li>
		</ol>
	</nav>
	<div class="main">
		<div class="card">
			<div class="card-header bg-info text-white"><?=$title ?></div>
			<div class="card-body">
				<form action="<?=base_url('admin/video/chinhsua/'.$video['idvideo']) ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="link">Link video</label>
						<input type="text" class="form-control <?php if(form_error('link')) echo 'is-invalid'; ?>" id="link" name="link" required placeholder="Link video" value="<?php if(set_value('link')) echo set_value('link'); else echo $video['link'] ?>">
						<div class="invalid-feedback"><?=form_error('link') ?></div>
					</div>
					<button type="submit" name="chinhsua" class="btn btn-primary">Chỉnh sửa video</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#hinhanh').change(function () {
        if ( window.FileReader ) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#images').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    })
</script>