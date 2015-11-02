<nav class="navbar navbar-default">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">
				<?php echo ($this->session->admin) ? 'Administració' : 'Tecnocampus' ?>
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<?php if($this->session->admin):?>
				<ul class="nav navbar-nav">
					<li class="<?php echo ($menu == 'pdi') ? 'active' : ''?>">
						<a href="<?php echo base_url('gestio')?>" >Gestió de PDI</a>
					</li>
					<li class="<?php echo ($menu == 'masters') ? 'active' : ''?>">
						<a href="<?php echo base_url('gestio/masters')?>">Manteniment de Taules Mestres</a>
					</li>						
				</ul>
			<?php endif; ?>
			
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<i class="fa fa-globe"></i> 						
						<?php echo ucfirst($lang->IDIOMA) ?> <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<?php foreach($idiomes as $row):?>
							<li><a class="set-idioma" data-id="<?php echo $row->ID ?>"><?php echo $row->IDIOMA ?></a></li>
						<?php endforeach; ?>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<i class="fa fa-user"></i> 
						<?php echo $this->session->userdata('user_name') ?>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo base_url('logout') ?>">Logout</a></li>							
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>