<div class="container">
	<div class="space50"></div>
	<h2><?=isset($danhmuc) ? $danhmuc : '' ?></h2>
	<div class="row">
		<?php
		if(isset($sanpham))
		{
			foreach($sanpham as $k => $item)
			{
		?>
			<div class="col-md-3">
				<div class="product">
					<a href="<?=base_url('chitiet/'.$item['idsanpham'].'/'.$this->chuanhoa->convert_vi_to_en($item['tensanpham'])) ?>">
						<img src="<?=base_url('img/sanpham/'.$item['hinhanh']) ?>" width="100%">
						<h5 class="text-center"><?=$item['tensanpham'] ?></h5>
						<h6 class="text-center text-danger">Giá: <?=$item['gia'] == 0 ? 'Liên hệ' : number_format($item['gia'], 0).' VNĐ' ?></h6>
					</a>
				</div>
			</div>
		<?php
			}
		}
		?>
	</div>
	<div class="space50"></div>
</div>
	
		
