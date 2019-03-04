<div class="container">
	<div class="space50"></div>
	<h2 class="text-danger border-bottom border-danger">Chi tiết sản phẩm</h2>
		<div class="row">
			<div class="col-md-6">
				<img class="img-thumbnail image-view" src="<?=base_url('img/sanpham/'.$sanpham['hinhanh']) ?>" alt="" width="100%">
				<div class="space20"></div>
			</div>
			<div class="col-md-6">
				<h4><strong><?=$sanpham['tensanpham'] ?></strong></h4>
				<p class="text-danger">Giá: <?=number_format($sanpham['gia'], 0) ?> VNĐ</p>
				<p>Lượt xem: <?=$sanpham['luotxem'] ?></p>
				<p>Mô tả: <?=$sanpham['mota'] ?></p>
			</div>
		</div>
		<div class="space30"></div>
		<h4 class="text-sang text-title">Món cùng danh mục</h4>
		<div class="row">
			<?php
			if(!empty($sanphamcungloai))
			{
				foreach($sanphamcungloai as $item)
				{
			?>
			<div class="col-md-3">
				<div class="product">
					<a href="<?=base_url('chitiet/'.$item['idsanpham'].'/'.$this->chuanhoa->convert_vi_to_en($item['tensanpham'])) ?>">
						<img src="<?=base_url('img/sanpham/'.$item['hinhanh']) ?>" width="100%">
						<h5 class="text-center"><?=$item['tensanpham'] ?></h5>
						<h6 class="text-center text-danger">Giá: <?=number_format($item['gia'], 0) ?> VNĐ</h6>
					</a>
				</div>
			</div>
			<?php
				}
			}
			?>
		</div>
		<div class="col-md-12">
			<div class="fb-comments" data-href="<?=base_url(uri_string()) ?>" data-numposts="5" width="100%" data-colorscheme="dark"></div>
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

