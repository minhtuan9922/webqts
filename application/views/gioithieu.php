<div class="container">
	<div class="space50"></div>
		<?php
		if(!empty($gioithieu))
		{
			echo $gioithieu['noidung'];
		}
		?>
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

