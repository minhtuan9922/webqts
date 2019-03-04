<!--Slide đầu trang-->
<div id="slide" class="carousel slide" data-ride="carousel">
	<ul class="carousel-indicators">
		<?php
		if(!empty($list_slide))
		{
			foreach($list_slide as $k => $item)
			{
		?>
		<li data-target="#slide" data-slide-to="<?=$k ?>" class="<?php if($k == 0) echo 'active'; ?>">
			<div class="slide-poster">
				<?php /*<img src="<?=base_url('img/poster/'.$item['poster']) ?>" alt="" width="100%">*/ ?>
			</div>
		</li>
		<?php
			}
		}
		?>
	</ul>
	<div class="carousel-inner">
		<?php
		if(!empty($list_slide))
		{
			foreach($list_slide as $k => $item)
			{
		?>
		<div class="carousel-item <?php if($k == 0) echo 'active'; ?>">
			<img src="<?=base_url('img/slide/'.$item['background']) ?>" width="100%"> 
			<?php /*
			<div class="carousel-caption">
				<h3><a href="<?=base_url('xemphim/'.$item['id_phim'].'/'.$this->chuanhoa->convert_vi_to_en($item['tenphim_vn'])) ?>"><?=$item['tenphim_vn'] ?></a></h3>
			</div>  
			*/
			?>
		</div>
		<?php
			}
		}
		?>
	</div>
	<a class="carousel-control-prev" href="#slide" data-slide="prev">
		<span class="carousel-control-prev-icon"></span>
	</a>
		<a class="carousel-control-next" href="#slide" data-slide="next">
	<span class="carousel-control-next-icon"></span>
	</a>
</div>