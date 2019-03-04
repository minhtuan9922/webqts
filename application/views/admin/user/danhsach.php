<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item active" aria-current="page">Quảng trị viên</li>
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
			<div class="card-header bg-info text-white">Danh sách quảng trị viên</div>
			<div class="card-body p-0">
				<div class="table-responsive-md">
					<table class="table table-hover table-bordered m-0">
						<thead>
							<tr>
								<th>ID quảng tị viên</th>
								<th>Tài khoản</th>
								<th>Tên</th>
								<th>Trạng thái</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(isset($users)) 
							{
								foreach($users as $tmp)
								{
							?>
							<tr>
								<td><?=$tmp['id'] ?></td>
								<td><?=$tmp['account'] ?></td>
								<td><?=$tmp['ten'] ?></td>
								<td><?=$tmp['active'] = 1 ? 'Hoạt động' : 'Đình chỉ' ?></td>
								<td>
									<a href="<?=base_url('admin/user/chinhsua/'.$tmp['id']) ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
									<button class="btn btn-danger" onClick="xoa_slide(<?=$tmp['id'] ?>)" id="active_<?=$tmp['id'] ?>"><i class="fas fa-trash-alt"></i></button>
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
//	function xoa_slide(id)
//	{
//		var r = confirm('Bạn có thật sự muốn xóa thể loại này?');
//		if(r == true) {
//			$.ajax({
//				method: "POST",
//				url: "<?=base_url('admin/slide/xoa_slide'); ?>",
//				data:{id_slide: id},
//			})
//			.done(function( msg ) {
//				alertify.success(msg);
//				setTimeout(function() {
//					location.reload();
//				}, 1000);
//			});
//		}
//	}
</script>