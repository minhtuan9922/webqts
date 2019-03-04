<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php if(isset($title)) echo $title; else echo 'phimmt'; ?></title>
	<link rel="icon" href="<?=base_url() ?>img/logo.png">
	<link rel="stylesheet" href="<?=base_url('asset/') ?>css/bootstrap.css">
	<link rel="stylesheet" href="<?=base_url('asset/') ?>css/style.css">
	<link rel="stylesheet" href="<?=base_url('asset/') ?>css/alertify.min.css">
	<link rel="stylesheet" href="<?=base_url('asset/') ?>css/themes/default.min.css">
	<link rel="stylesheet" href="<?=base_url('asset/') ?>fontawesome-free-5.0.6/web-fonts-with-css/css/fontawesome-all.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<script type="text/javascript" src="<?=base_url('asset/') ?>js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?=base_url('asset/') ?>js/popper.min.js"></script>
	<script type="text/javascript" src="<?=base_url('asset/') ?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url('asset/') ?>js/scrollreveal.min.js"></script>
	<script type="text/javascript" src="<?=base_url('asset/') ?>js/alertify.min.js"></script>
	<script type="text/javascript" src="<?=base_url('asset/') ?>js/custom.js"></script>
	<link href="<?=base_url() ?>asset/css/froala_editor.pkgd.min.css" rel="stylesheet">
	<script src="<?=base_url() ?>asset/js/froala_editor.pkgd.min.js"></script>
	<script src="<?=base_url() ?>asset/js/languages/vi.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
	<?php
	$this->load->view('admin/home/header');
	$this->load->view($content);
	//$this->load->view('admin/home/footer');
	?>

</body>

</html>