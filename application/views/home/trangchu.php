<!--Phần đăng phim-->
<div class="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1 class="text-danger">GIỚI THIỆU</h1>
				<h5 class="text-justify"><?=!empty($gioithieu) ? $gioithieu['noidungxemtruoc'] : '' ?></h5>
				<a href="<?=base_url('gioithieu') ?>" class="btn btn-light">Xem thêm</a>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-6">
						<img src="<?=base_url('img/hinh1-6450.jpg') ?>" width="100%">
					</div>
					<div class="col-6">
						<img src="<?=base_url('img/lau-thai-7267.jpg') ?>" width="100%">
					</div>
				</div>
			</div>
		</div>
		<div class="space30"></div>
	</div>
</div>
<div class="container-fluid bg-green">
	<div class="container">
		<div class="space50"></div>
		<h1 class="text-white text-center">THỰC ĐƠN LÀNG NƯỚNG SAO MAI</h1>
		<img src="<?=base_url('img/bgkh.png') ?>" class="mx-auto d-block" alt="">
		<div class="owl-carousel owl-theme" id="slide-thucdon">
			<?php
			if(isset($danhmuc))
			{
				foreach($danhmuc as $item)
				{
			?>
			<div class="item text-center">
				<a class="link-a" href="#thuc_don_<?=$item['tenkhongdau'] ?>">
					<img class="mx-auto d-block" src="<?=base_url('img/'.$item['hinhanh']) ?>" alt="">
				</a>
				<h5 class="text-white"><?=$item['tendanhmuc'] ?></h5>
			</div>
			<?php
				}
			}
			?>
		</div>
		<div class="tab-content">
			<?php
			if(isset($sanpham))
			{
				foreach($sanpham as $k => $item)
				{
					if($k == 0 || $item['danhmuc'] != $sanpham[$k-1]['danhmuc'])
					{
						echo '<div class=" text-center tab-pane fade" id="thuc_don_'. $item['tenkhongdau'] .'">';
						echo '<div class="row">';
					}
			?>
				
					<div class="col-md-3">
						<div class="product">
							<a href="<?=base_url('chitiet/'.$item['idsanpham'].'/'.$this->chuanhoa->convert_vi_to_en($item['tensanpham'])) ?>">
								<img src="<?=base_url('img/sanpham/'.$item['hinhanh_sp']) ?>" width="100%">
								<h5 class="text-center"><?=$item['tensanpham'] ?></h5>
							</a>
						</div>
					</div>
				
			<?php
					if($k == count($sanpham) - 1 || $item['danhmuc'] != $sanpham[$k+1]['danhmuc'])
					{
						echo '</div>';
						echo '<a href="'.base_url('thucdon/'.$item['tenkhongdau']).'" class="btn btn-light">Xem thêm</a>';
						echo '</div>';
					}
				}
			}
			?>
		</div>
		<script>
			$('#slide-thucdon').owlCarousel({
				loop:true,
				margin:10,
				nav: false,
				dots: false,
				autoplay:true,
				autoplayTimeout:2000,
				autoplayHoverPause:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:3
					},
					1000:{
						items:6
					}
				}
			});
			$('a.link-a').click(function(e) {
				e.preventDefault();
				var id = $(this).attr('href');
				$('.tab-pane').removeClass('show active');
				$(id).addClass('show active');
			});
//			$('a.nav-link').click(function(){
//				$(this).tab('show');
//			})
		</script>
		<div class="space50"></div>
	</div>
</div>
<div class="contact-home">
	<div class="space50"></div>
	<div class="container">
		<h1 class="text-center text-white">LIÊN HỆ ĐẶT BÀN</h1>
		<p class="text-center text-white">Đăng ký ngay để được tư vấn nhanh nhất!</p>
		<form action="<?=base_url() ?>" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-3">
					<input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email (*)">
				</div>
				<div class="col-md-3">
					<input type="text" name="dienthoai" class="form-control form-control-lg" id="dienthoai" placeholder="Điện thoại (*)">
				</div>
				<div class="col-md-3">
					<input type="text" name="noidung" class="form-control form-control-lg" id="noidung" placeholder="Nội dung">
				</div>
				<div class="col-md-3">
					<button type="submit" name="dangky" class="btn btn-success btn-block btn-lg">Đăng ký</button>
				</div>
			</div>
		</form>
	</div>
	<div class="space50"></div>
</div>
<div class="container-fluid">
	<div class="space50"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1>Ý kiến khách hàng</h1>
				<img src="<?=base_url('img/boder2.png') ?>" class="" alt="">
				<div class="space20"></div>
				<?php
				if(!empty($ykien))
				{
					foreach($ykien as $item)
					{
				?>
				<div class="box-item">
					<div class="item-img">
						<img src="<?=base_url('img/ykien/'.$item['hinhanh']) ?>" alt="">
					</div>
					<div class="item-text">
						<h4 class="text-danger"><?=$item['hoten'] ?></h4>
						<p><?=$item['noidung'] ?></p>
					</div>
				</div>
				<?php
					}
				}
			  	?>
			</div>
			<div class="col-md-6">
				<h1>Video tiêu biểu</h1>
				<img src="<?=base_url('img/boder2.png') ?>" class="" alt="">
				<div class="space20"></div>
				<div class="fotorama" data-nav="thumbs" data-thumbwidth="130" data-thumbheight="100" data-width="100%" data-ratio="16/9" data-fit="cover">
					<?php
					if(!empty($video))
					{
						foreach($video as $item)
						{
					?>
					<a href="<?=$item['link'] ?>"></a>
					<?php
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="space50"></div>
</div>
<div class="container-fluid bg-green">
	<div class="space30"></div>
	<h1 class="text-white text-center">HÌNH ẢNH LÀNG NƯỚNG SAO MAI</h1>
	<img src="<?=base_url('img/bgkh.png') ?>" class="mx-auto d-block" alt="">
	<div class="space30"></div>
</div>
<div class="container">
	<div class="owl-carousel owl-theme" id="slide-hinhanh">
		<?php
		if(isset($hinhanh))
		{
			foreach($hinhanh as $item)
			{
		?>
		<div class="item text-center">
			<img src="<?=base_url('img/hinhanh/'.$item['hinhanh']) ?>" alt="">
		</div>
		<?php
			}
		}
		?>
	</div>
</div>
<!-- The Modal -->
<div class="modal fade" id="trailer">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content trailer">
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" id="trailer_youtube"  src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</div>
<script>
	function play_trailer(id) {
		$.ajax({
			dataType: "JSON",
			method: "POST",
			url: "<?=base_url('home/trailer'); ?>",
			data:{id:id},
			success: function(result)
			{
				if(result.trailer) {
					$('#trailer iframe').attr('src', result.trailer);
				}
			}
		});
	}
	$("#trailer").on('hidden.bs.modal', function () {
		$('#trailer iframe').attr('src', '');
	});
	<?php
	if(isset($result) && $result == 1)
	{
	?>
	alert('Đăng ký thành công. Chúng tôi sẽ liên lạc trong thời gian sớm nhất.')
	<?php
	}
	?>
	$('#slide-hinhanh').owlCarousel({
		loop:true,
		margin:0,
		nav: false,
		dots: false,
		autoplay:true,
		autoplayTimeout:2000,
		autoplayHoverPause:true,
		autoWidth:true,
		autoHeight: false,
		responsive:{
			0:{
				items:4
			},
			600:{
				items:4
			},
			1000:{
				items:4
			}
		}
	});
	var $image = $('#slide-hinhanh');

	// Get the Viewer.js instance after initialized
	var viewer = $image.data('viewer');

	// View a list of images
	$('#slide-hinhanh').viewer();
</script>
