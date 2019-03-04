<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item active" aria-current="page">Video</li>
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
			<div class="card-header bg-info text-white">Danh sách video</div>
			<div class="card-body p-0">
				<div class="table-responsive-md">
					<table class="table table-hover table-bordered m-0">
						<thead>
							<tr>
								<th>ID video</th>
								<th>Link video</th>
								<th>Ngày thêm</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(isset($video)) 
							{
								foreach($video as $tmp)
								{
							?>
							<tr>
								<td><?=$tmp['idvideo'] ?></td>
								<td><?=$tmp['link'] ?></td>
								<td><?=$tmp['ngaythem'] ?></td>
								<td>
									<a href="<?=base_url('admin/video/chinhsua/'.$tmp['idvideo']) ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
									<button class="btn btn-danger" onClick="xoavideo(<?=$tmp['idvideo'] ?>)"><i class="fas fa-trash-alt"></i></button>
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
			url: "<?=base_url('admin/video/capnhat_moi'); ?>",
			data:{idvideo: id, moi: val},
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
			url: "<?=base_url('admin/video/capnhat_trangchu'); ?>",
			data:{idvideo: id, trangchu: val},
		})
		.done(function( msg ) {
			alertify.success(msg);
		});
	}
	function xoavideo(id)
	{
		var r = confirm('Bạn có thật sự muốn xóa video này?');
		if(r == true) {
			$.ajax({
				dataType: "JSON",
				method: "POST",
				url: "<?=base_url('admin/video/xoavideo'); ?>",
				data:{idvideo: id},
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