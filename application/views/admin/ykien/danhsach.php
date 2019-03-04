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
								<th>Họ tên</th>
								<th>Hình ảnh</th>
								<th>Nội dung</th>
								<th>Ngày thêm</th>
								<th>Trang chủ</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(isset($ykien)) 
							{
								foreach($ykien as $tmp)
								{
							?>
							<tr>
								<td><?=$tmp['hoten'] ?></td>
								<td><img src="<?=base_url('img/ykien/'.$tmp['hinhanh']) ?>" width="64px"></td>
								<td><?=$tmp['noidung'] ?></td>
								<td><?=$tmp['ngaythem'] ?></td>
								<td><input type="checkbox" onClick="check_trangchu(<?=$tmp['idykien'] ?>)" id="trangchu_<?=$tmp['idykien'] ?>" <?=$tmp['trangchu'] == 1 ? 'checked' : '' ?> ></td>
								<td>
									<a href="<?=base_url('admin/ykien/chinhsua/'.$tmp['idykien']) ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
									<button class="btn btn-danger" onClick="xoaykien(<?=$tmp['idykien'] ?>)"><i class="fas fa-trash-alt"></i></button>
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
			url: "<?=base_url('admin/ykien/capnhat_moi'); ?>",
			data:{idykien: id, moi: val},
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
			url: "<?=base_url('admin/ykien/capnhat_trangchu'); ?>",
			data:{idykien: id, trangchu: val},
		})
		.done(function( msg ) {
			alertify.success(msg);
		});
	}
	function xoaykien(id)
	{
		var r = confirm('Bạn có thật sự muốn xóa ý kiến này?');
		if(r == true) {
			$.ajax({
				dataType: "JSON",
				method: "POST",
				url: "<?=base_url('admin/ykien/xoaykien'); ?>",
				data:{idykien: id},
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