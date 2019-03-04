<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item active" aria-current="page">Thể loại</li>
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
			<div class="card-header bg-info text-white">Danh sách slide</div>
			<div class="card-body p-0">
				<div class="table-responsive-md">
					<table class="table table-hover table-bordered m-0">
						<thead>
							<tr>
								<th>ID slide</th>
								<th>Hình ảnh</th>
								<th>Thứ tự</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(isset($danhsach)) 
							{
								foreach($danhsach as $tmp)
								{
							?>
							<tr>
								<td><?=$tmp['id_slide'] ?></td>
								<td><img src="<?=base_url('img/slide/'.$tmp['background']) ?>" width="200px"></td>
								<td><?=$tmp['vitri'] ?></td>
								<td>
									<a href="<?=base_url('admin/slide/chinhsua/'.$tmp['id_slide']) ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
									<button class="btn btn-danger" onClick="xoa_slide(<?=$tmp['id_slide'] ?>)" id="active_<?=$tmp['id_slide'] ?>"><i class="fas fa-trash-alt"></i></button>
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
		</div>
	</div>
</div>
<script>
	function xoa_slide(id)
	{
		var r = confirm('Bạn có thật sự muốn xóa slide này?');
		if(r == true) {
			$.ajax({
				method: "POST",
				url: "<?=base_url('admin/slide/xoa_slide'); ?>",
				data:{id_slide: id},
			})
			.done(function( msg ) {
				alertify.success(msg);
				setTimeout(function() {
					location.reload();
				}, 1000);
			});
		}
	}
</script>