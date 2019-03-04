<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
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
			<div class="card-header bg-info text-white">Danh sách liên hệ</div>
			<div class="card-body p-0">
				<div class="table-responsive-md">
					<table class="table table-hover table-bordered m-0">
						<thead>
							<tr>
								<th>Tên</th>
								<th>Email</th>
								<th>Điện thoại</th>
								<th>Nội dung</th>
								<th>Ngày thêm</th>
								<th>Trạng thái</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(isset($lienhe)) 
							{
								foreach($lienhe as $tmp)
								{
							?>
							<tr>
								<td><?=$tmp['ten'] ?></td>
								<td><?=$tmp['email'] ?></td>
								<td><?=$tmp['dienthoai'] ?></td>
								<td><?=$tmp['noidung'] ?></td>
								<td><?=$tmp['ngaythem'] ?></td>
								<td><?=$tmp['trangthai'] == 0 ? 'Chưa xem' : 'Đã xem' ?></td>
								<td>
									<a href="<?=base_url('admin/lienhe/xemlienhe/'.$tmp['idlienhe']) ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
									<button class="btn btn-danger" onClick="xoalienhe(<?=$tmp['idlienhe'] ?>)"><i class="fas fa-trash-alt"></i></button>
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
	function xoalienhe(id)
	{
		var r = confirm('Bạn có thật sự muốn xóa liên hệ này?');
		if(r == true) {
			$.ajax({
				dataType: "JSON",
				method: "POST",
				url: "<?=base_url('admin/lienhe/xoalienhe'); ?>",
				data:{idlienhe: id},
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