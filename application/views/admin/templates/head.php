<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	

	<link rel="stylesheet" href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css') ?>">

	<?php if (isset($css)) foreach ($css as $filePath) { ?>
		<link rel="stylesheet" href="<?php echo base_url('public/css/admin/'.$filePath.'.css') ?>">
	<?php } ?>

	<script src="<?php echo base_url('public/js/lib/jquery-2.1.1.min.js') ?>"></script>
	<script src="<?php echo base_url('public/js/lib/jquery-migrate-1.3.0.js') ?>"></script>
	<script src="<?php echo base_url('public/js/lib/jquery.bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js') ?>"></script>

	<?php if (isset($js)) foreach ($js as $filePath) { ?>
		<script src="<?php echo base_url('public/js/admin/'.$filePath.'.js') ?>"></script>
	<?php } ?>

	<title><?php echo isset($title) ? $title : 'LostFound pages' ?></title>
</head>
<body>

