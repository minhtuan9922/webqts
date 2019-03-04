<div class="container">
	<div class="space50"></div>
	<?php
	if(isset($success))
	{
	?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?=$success ?>
	</div>
	<?php
	}
	?>
	<div class="row">
		<div class="col-md-6">
			<form action="<?=base_url('lienhe') ?>" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="ten">Họ và tên</label>
					<input type="text" class="form-control <?php if(form_error('ten')) echo 'is-invalid'; ?>" id="ten" name="ten" required placeholder="Họ và tên" value="<?php if(set_value('ten')) echo set_value('ten'); ?>">
					<div class="invalid-feedback"><?=form_error('ten') ?></div>
				</div>
				<div class="form-group">
					<label for="email">Địa chỉ email</label>
					<input type="email" class="form-control <?php if(form_error('email')) echo 'is-invalid' ?>" id="email" name="email" placeholder="Địa chỉ email" required value="<?php if(set_value('email')) echo set_value('email'); ?>">
					<div class="invalid-feedback"><?=form_error('email') ?></div>
				</div>
				<div class="form-group">
					<label for="dienthoai">Số điện thoại</label>
					<input type="text" class="form-control <?php if(form_error('dienthoai')) echo 'is-invalid' ?>" id="dienthoai" name="dienthoai" placeholder="Số điện thoại" required value="<?php if(set_value('dienthoai')) echo set_value('dienthoai'); ?>">
					<div class="invalid-feedback"><?=form_error('dienthoai') ?></div>
				</div>
				<div class="form-group">
					<label for="noidung">Nội dung</label>
					<textarea type="text" class="form-control <?php if(form_error('noidung')) echo 'is-invalid' ?>" id="noidung" name="noidung" rows="6" placeholder="Mô tả"><?php if(set_value('noidung')) echo set_value('noidung'); ?></textarea>
					<div class="invalid-feedback"><?=form_error('noidung') ?></div>
				</div>
				<button type="submit" name="themlienhe" class="btn btn-primary">Gửi</button>
			</form>
		</div>
		<div class="col-md-6">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15677.880593570962!2d106.6939979028513!3d10.775257856067872!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f3f3129e64d%3A0x8d6b2d79522c7f30!2zQ2jhu6MgQuG6v24gVGjDoG5o!5e0!3m2!1svi!2s!4v1548426903474" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</div>
	<div class="space50"></div>
</div>
<script>
var $image = $('.image-view');

//$image.viewer({
//  inline: true,
//  viewed: function() {
//    $image.viewer('zoomTo', 1);
//  }
//});

// Get the Viewer.js instance after initialized
var viewer = $image.data('viewer');

// View a list of images
$('.image-view').viewer();
</script>

