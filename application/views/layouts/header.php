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
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<!-- mobile settings -->
	<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

	<!-- WEB FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

	<!-- FORM WIZARD -->

	<!-- CORE CSS -->
	<link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/css/jquery-ui.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/css/jquery.ui.ie.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/css/select2.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/css/bootstrap.select2.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/css/bootstrap-datepicker.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />

	<?php get_css();?>

	<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css" />

</head>
<body>

	<?php $this->load->view('layouts/top'); ?>

	<!-- WRAPPER -->
	<div class="col-sm-12"> <!--class="container"-->
		<div class="header">		
			<img class="img-responsive" src="<?php echo base_url('assets/images/header.png')?>" alt="header.png" />
		</div>
		
		<!-- NAVEGADOR -->
		
		<ol class="breadcrumb">
			<?php if (!isset($breadcrumb)):						
			?>
			<li class="active"><i class="glyphicon glyphicon-home"></i></li>
			
		<?php else:?>
			<li><a href="<?php echo base_url() ?>"><i class="glyphicon glyphicon-home"></i></a></li>			
			<?php 
			foreach($breadcrumb as $link):
				if(isset($link['class']) && $link['class'] == true):
					?>
				<li class="active"><?php echo $link['text']?></i></li>
			<?php else: ?>
				<li><a href="<?php echo $link['link'] ?>"><?php echo $link['text']?></a></li>
			<?php endif; ?>							
		<?php endforeach;?>

	<?php endif;?>
</ol>



<!-- NOTIFICACIONS -->
<?php if($this->session->flashdata('notification')):
	$flashnoti = $this->session->flashdata('notification');
	?>
	<div class="alert alert-<?php echo $flashnoti['type'] ?> alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong> <?php echo $flashnoti['status'] ?> </strong><?php echo $flashnoti['message'];?>
	</div>
<?php endif;	?>

<?php if(isset($section)): ?>
	<h2 class="orange"><?php echo $section ?></h2><hr>
<?php endif; ?>
