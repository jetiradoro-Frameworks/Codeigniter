<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<title><?php echo APP_NAME ?></title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta name="Author" content="Jesús Tirado Ródenas" />

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

		<!-- WEB FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet" type="text/css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

		<!-- CORE CSS -->
		<link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css" />
		
		<?php get_css();?>

		
	</head>
	<body>
	
	<div class="container">
	<div class="header">
			<img clas="img-responsive" src="<?php echo base_url('assets/images/header.png')?>" alt="header.png" />
	</div>
	<!-- NOTIFICACIONS -->
	<?php if($this->session->flashdata('notification')):
			$flashnoti = $this->session->flashdata('notification');
	?>
				<div class="alert alert-<?php echo $flashnoti['type'] ?> alert-dismissable">
					 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong> <?php echo $flashnoti['status'] ?> </strong><?php echo $flashnoti['message'];?>
				</div>
	<?php endif;	?>
		
		