<footer>
	<div class="container-fuld border-bottom border-dark">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<h4 class="text-danger">LÀNG NƯỚNG SAO MAI</h4>
					<p class="text-white"><em>Địa chỉ: <?=$this->msetting->get_setting('diachi') ?></em></p>
					<p class="text-white"><em>Email: <?=$this->msetting->get_setting('email') ?></em></p>
					<p class="text-white"><em>Điện thoại: <?=$this->msetting->get_setting('dienthoai') ?></em></p>
					<p class="text-white"><em>Website: <?=$this->msetting->get_setting('diachi_website') ?></em></p>
				</div>
				<div class="col-md-4">
					<h4 class="text-white">Quy định chung</h4>
					<p class="text-white"><a href="<?=base_url() ?>" class="text-white">Dịch vụ hổ trợ</a></p>
					<p class="text-white"><a href="<?=base_url() ?>" class="text-white">Chính sách ưu đãi</a></p>
				</div>
				<div class="col-md-4">
					<div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
				</div>
			</div>
			<div class="space20"></div>
<!--
			<div class="footer">
				<div class="row">
					<div class="col-md-6">
						<p class="text-secondary text-md-left text-center"><i class="far fa-copyright"></i> 2018 - <?=date('Y')?>. Designed by Minh Tuấn</p>

					</div>
					<div class="col-md-6">
						<ul class="text-md-right text-center footer-icon">
							<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#"><i class="fab fa-youtube"></i></a></li>
							<li><a href="#"><i class="far fa-envelope"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
-->
		</div>
	</div>
	<div class="container">
		<div class="space20"></div>
		<div class="row align-items-center">
			<div class="col-md-6">
				<ul class="footer-icon">
					<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
					<li><a href="#"><i class="fab fa-youtube"></i></a></li>
					<li><a href="#"><i class="far fa-envelope"></i></a></li>
				</ul>
			</div>
			<div class="col-md-6">
				<p class="text-secondary text-right"><i class="far fa-copyright"></i> 2019 - <?=date('Y')?>. Designed by QTS</p>
			</div>
		</div>
	</div>
</footer>