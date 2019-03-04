<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item active" aria-current="page">Hình ảnh</li>
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
			<div class="card-header bg-info text-white">Danh sách hình ảnh</div>
			<div class="card-body p-0">
				<div class="table-responsive-md">
					<table class="table table-hover table-bordered m-0">
						<thead>
							<tr>
								<th>ID hình ảnh</th>
								<th>Hình ảnh</th>
								<th>Ngày thêm</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(isset($hinhanh)) 
							{
								foreach($hinhanh as $tmp)
								{
							?>
							<tr>
								<td><?=$tmp['idhinhanh'] ?></td>
								<td><img src="<?=base_url('img/hinhanh/'.$tmp['hinhanh']) ?>" width="200px"></td>
								<td><?=$tmp['ngaythem'] ?></td>
								<td>
									<a href="<?=base_url('admin/hinhanh/chinhsua/'.$tmp['idhinhanh']) ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
									<button class="btn btn-danger" onClick="xoahinhanh(<?=$tmp['idhinhanh'] ?>)"><i class="fas fa-trash-alt"></i></button>
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
	function xoahinhanh(id)
	{
		var r = confirm('Bạn có thật sự muốn xóa hinhanh này?');
		if(r == true) {
			$.ajax({
				dataType: "JSON",
				method: "POST",
				url: "<?=base_url('admin/hinhanh/xoahinhanh'); ?>",
				data:{idhinhanh: id},
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