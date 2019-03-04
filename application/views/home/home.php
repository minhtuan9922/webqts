<!--Phần đăng phim-->
<div class="bg-toi wrapper">
	<div class="container">
		<?php
		if(isset($phimmoi) && $phimmoi != '')
		{
		?>
		<h4 class="text-sang text-title" id="phim_moi">Phim mới cập nhật</h4>
		<div class="space25"></div>
		<div class="row">
			<?php
			foreach($phimmoi as $tmp)
			{
			?>
			<div class="col-lg-2 col-md-3 col-sm-4 col-6">
				<div class="phim">
					<div class="poster">
						<a href="<?=base_url('xemphim/'.$tmp['id_phim'].'/'.$this->chuanhoa->convert_vi_to_en($tmp['tenphim_vn'])) ?>"><img src="<?=base_url('img/poster/'.$tmp['poster']) ?>" width="100%" alt="" class="poster-img"></a>
					</div>
					<div class="tieude">
						<a href="<?=base_url('xemphim/'.$tmp['id_phim'].'/'.$this->chuanhoa->convert_vi_to_en($tmp['tenphim_vn'])) ?>"><?=$tmp['tenphim_vn'] ?></a>
						<div class="nut-play-trailer">
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#trailer" onClick="play_trailer(<?=$tmp['id_phim'] ?>)">Trailer</button>
							<a href="<?=base_url('xemphim/'.$tmp['id_phim'].'/'.$this->chuanhoa->convert_vi_to_en($tmp['tenphim_vn'])) ?>" class="btn btn-danger">Play</a>
						</div>
					</div>
				</div>
			</div>
			<?php
			}
			?>
		</div>
		<?php
		}
		?>
		<div class="space25"></div>
		<?php
		if(!empty($list_phim))
		{
			foreach($list_phim as $phim)
			{
		?>
		<h4 class="text-sang text-title" id="phim_moi">Phim <?=$phim['theloai'] ?></h4>
		<div class="space25"></div>
		<div class="row">
			<?php
			if(isset($phim['phim']) && $phim['phim'] != '')
			{
				foreach($phim['phim'] as $tmp)
				{
			?>
			<div class="col-lg-2 col-md-3 col-sm-4 col-6">
				<div class="phim">
					<div class="poster">
						<a href="<?=base_url('xemphim/'.$tmp['id_phim'].'/'.$this->chuanhoa->convert_vi_to_en($tmp['tenphim_vn'])) ?>"><img src="<?=base_url('img/poster/'.$tmp['poster']) ?>" width="100%" alt="" class="poster-img"></a>
					</div>
					<div class="tieude">
						<a href="<?=base_url('xemphim/'.$tmp['id_phim'].'/'.$this->chuanhoa->convert_vi_to_en($tmp['tenphim_vn'])) ?>"><?=$tmp['tenphim_vn'] ?></a>
						<div class="nut-play-trailer">
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#trailer" onClick="play_trailer(<?=$tmp['id_phim'] ?>)">Trailer</button>
							<a href="<?=base_url('xemphim/'.$tmp['id_phim'].'/'.$this->chuanhoa->convert_vi_to_en($tmp['tenphim_vn'])) ?>" class="btn btn-danger">Play</a>
						</div>
					</div>
				</div>
			</div>
			<?php
				}
			}
			?>
		</div>
		<?php
			}
		}
		?>
		<?php
		if(isset($pagination))
		{
			echo $pagination;
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
</script>
