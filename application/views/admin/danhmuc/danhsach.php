<div class="wrapper">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">Trang chủ</a></li>
			<li class="breadcrumb-item active" aria-current="page">Danh mục</li>
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
			<div class="card-header bg-info text-white">Danh sách danh mục</div>
			<div class="card-body p-0">
				<div class="table-responsive-md">
					<table class="table table-hover table-bordered m-0">
						<thead>
							<tr>
								<th>ID danh mục</th>
								<th>Hình ảnh</th>
								<th>Tên danh mục</th>
								<th>Tên danh mục không dấu</th>
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
								<td><?=$tmp['iddanhmuc'] ?></td>
								<td><img src="<?=base_url('img/'.$tmp['hinhanh']) ?>" width="64px"></td>
								<td><?=$tmp['tendanhmuc'] ?></td>
								<td><?=$tmp['tenkhongdau'] ?></td>
								<td>
									<a href="<?=base_url('admin/danhmuc/chinhsua/'.$tmp['iddanhmuc']) ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
									<button class="btn btn-danger" onClick="xoa_danhmuc(<?=$tmp['iddanhmuc'] ?>)" id="active_<?=$tmp['iddanhmuc'] ?>"><i class="fas fa-trash-alt"></i></button>
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
	function xoa_danhmuc(id)
	{
		var r = confirm('Bạn có thật sự muốn xóa danh mục này?');
		if(r == true) {
			$.ajax({
				dataType: "JSON",
				method: "POST",
				url: "<?=base_url('admin/danhmuc/xoa_danhmuc'); ?>",
				data:{iddanhmuc: id},
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