<div class="container">
	<div class="space50"></div>
	<h2 class="text-danger border-bottom border-danger text-center">Hình ảnh làng nướng Sao Mai</h2>
		<div class="row image-view">
			<div class="col-md-3">
				<?php
				if(isset($list1))
				{
					foreach($list1 as $item)
					{
				?>
				<img class="img-thumbnail" src="<?=base_url('img/hinhanh/'.$item['hinhanh']) ?>" alt="" width="100%">
				<div class="space20"></div>
				<?php
					}
				}
				?>
			</div>
			<div class="col-md-3">
				<?php
				if(isset($list2))
				{
					foreach($list2 as $item)
					{
				?>
				<img class="img-thumbnail" src="<?=base_url('img/hinhanh/'.$item['hinhanh']) ?>" alt="" width="100%">
				<div class="space20"></div>
				<?php
					}
				}
				?>
			</div>
			<div class="col-md-3">
				<?php
				if(isset($list3))
				{
					foreach($list3 as $item)
					{
				?>
				<img class="img-thumbnail" src="<?=base_url('img/hinhanh/'.$item['hinhanh']) ?>" alt="" width="100%">
				<div class="space20"></div>
				<?php
					}
				}
				?>
			</div>
			<div class="col-md-3">
				<?php
				if(isset($list4))
				{
					foreach($list4 as $item)
					{
				?>
				<img class="img-thumbnail" src="<?=base_url('img/hinhanh/'.$item['hinhanh']) ?>" alt="" width="100%">
				<div class="space20"></div>
				<?php
					}
				}
				?>
			</div>
		</div>
	</div>
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

