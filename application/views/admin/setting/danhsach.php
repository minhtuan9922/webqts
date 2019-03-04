<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
		</ol>
	</nav>
	<div class="main">
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
		<div class="card">
			<div class="card-header bg-info text-white">Danh sách sản phẩm</div>
			<div class="card-body p-0">
				<div class="table-responsive-md">
					<table class="table table-hover table-bordered m-0">
						<thead>
							<tr>
								<th>Hình ảnh</th>
								<th>Tên sản phẩm</th>
								<th>Thực đơn</th>
								<th>Ngày thêm</th>
								<th>Món mới</th>
								<th>Trang chủ</th>
								<th>Giá</th>
								<th>Lượt xem</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(isset($sanpham)) 
							{
								foreach($sanpham as $tmp)
								{
							?>
							<tr>
								<td><img src="<?=base_url('img/sanpham/'.$tmp['hinhanh']) ?>" width="64px"></td>
								<td><?=$tmp['tensanpham'] ?></td>
								<td><?=$tmp['tendanhmuc'] ?></td>
								<td><?=$tmp['ngaythem'] ?></td>
								<td><input type="checkbox" onClick="check_moi(<?=$tmp['idsanpham'] ?>)" id="moi_<?=$tmp['idsanpham'] ?>" <?=$tmp['moi'] == 1 ? 'checked' : '' ?>></td>
								<td><input type="checkbox" onClick="check_trangchu(<?=$tmp['idsanpham'] ?>)" id="trangchu_<?=$tmp['idsanpham'] ?>" <?=$tmp['trangchu'] == 1 ? 'checked' : '' ?> ></td>
								<td><?=number_format($tmp['gia']) ?> VNĐ</td>
								<td><?=$tmp['luotxem'] ?></td>
								<td>
									<a href="<?=base_url('admin/sanpham/chinhsua/'.$tmp['idsanpham']) ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
									<button class="btn btn-danger" onClick="xoasanpham(<?=$tmp['idsanpham'] ?>)"><i class="fas fa-trash-alt"></i></button>
								</td>
							</tr>
							<?php
								}
							}
							?>
						</tbody>
					</table>
				</div> 
			</div>
			<div class="card-footer">
			<?=$this->pagination->create_links(); ?>
			</div>
		</div>
	</div>
</div>
<script>
	function check_moi(id)
	{
		var val = 0;
		if($('#moi_'+id).is(":checked") == true){
            val =1;
        };
		$.ajax({
			method: "POST",
			url: "<?=base_url('admin/sanpham/capnhat_moi'); ?>",
			data:{idsanpham: id, moi: val},
		})
		.done(function( msg ) {
			alertify.success(msg);
//			setTimeout(function() {
//				location.reload();
//			}, 1000);
		});
	}
	function check_trangchu(id)
	{
		var val = 0;
		if($('#trangchu_'+id).is(":checked") == true){
            val =1;
        };
		$.ajax({
			method: "POST",
			url: "<?=base_url('admin/sanpham/capnhat_trangchu'); ?>",
			data:{idsanpham: id, trangchu: val},
		})
		.done(function( msg ) {
			alertify.success(msg);
		});
	}
	function xoasanpham(id)
	{
		var r = confirm('Bạn có thật sự muốn xóa sản phẩm này?');
		if(r == true) {
			$.ajax({
				dataType: "JSON",
				method: "POST",
				url: "<?=base_url('admin/sanpham/xoasanpham'); ?>",
				data:{idsanpham: id},
			})
			.done(function( msg ) {
				if(msg.success) {
					alertify.success(msg.success);
					setTimeout(function() {
						location.reload();
					}, 1000);
				}
				if(msg.error) {
					alertify.error(msg.error); 
				}
			});
		}
	}
</script>