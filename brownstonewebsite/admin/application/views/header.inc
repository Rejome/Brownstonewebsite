<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>Blank Page - Ace Admin</title>

	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/font-awesome.css" />
	<script src="<?php echo $this->config->base_url(); ?>assets/js/jquery.js"></script>
	

	<!-- page specific plugin styles -->

	<!-- text fonts -->
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/ace-fonts.css" />

	<!-- ace styles -->
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/ace-skins.css" />
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/ace-part2.css" class="ace-main-stylesheet" />
			<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/ace-ie.css" />
		  <![endif]-->

		  <!-- inline styles related to this page -->

		  <!-- ace settings handler -->
		  <script src="<?php echo $this->config->base_url(); ?>assets/js/ace-extra.js"></script>

		  <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo $this->config->base_url(); ?>assets/js/html5shiv.js"></script>
		<script src="<?php echo $this->config->base_url(); ?>assets/js/respond.js"></script>
		<![endif]-->
		<style type="text/css">
			#hideAll
			{
				position: fixed;
				left: 0px; 
				right: 0px; 
				top: 0px; 
				bottom: 0px; 
				background-color: white;
				z-index: 99; /* Higher than anything else in the document */
			}
		</style>


	</head>

	
	<body class="skin-3">
		<!-- #section:basics/navbar.layout -->
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="#" class="navbar-brand">
						<small>
							<i class="fa fa-globe"></i>
							<span class="orange bolder">Brownstone</span> Asia-Tech, Inc.
						</small>
					</a>

					<!-- /section:basics/navbar.layout.brand -->

					<!-- #section:basics/navbar.toggle -->

					<!-- /section:basics/navbar.toggle -->
				</div>

				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

						<!-- #section:basics/navbar.user_menu -->
						<li class="light-orange">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								
								<span class="user-info">
									<small>Welcome,</small>
									<?php
										$this->load->library('session');
										$access = $this->session->userdata('access');
										echo $access['username'];
									?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="<?php echo $this->config->base_url(); ?>Admin/logout">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>

						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>

				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>

		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				

				<ul class="nav nav-list">
					<li class="">
						<a href="<?php echo $this->config->base_url(); ?>Dashboard">
							<i class="menu-icon fa fa-home"></i>
							<span class="menu-text"> Dashboard </span>
						</a>
						<b class="arrow"></b>
					</li>
					<?php
						if($access['banners']==1){
					?>
					<li class="">
						<a href="<?php echo $this->config->base_url(); ?>Banners">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Banners </span>
						</a>
						<b class="arrow"></b>
					</li>
					<?php
						}
						if($access['products']==1){
					?>
					<li class="">
						<a href="<?php echo $this->config->base_url(); ?>Products">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Products </span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php
						}
						if($access['news']==1){
					?>
					<li class="">
						<a href="<?php echo $this->config->base_url(); ?>News">
							<i class="menu-icon fa fa-calendar"></i>
							<span class="menu-text"> News &amp; Events </span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php
						}
						if($access['careers']==1){
					?>
					<li class="">
						<a href="<?php echo $this->config->base_url(); ?>Careers">
							<i class="menu-icon fa fa-briefcase"></i>
							<span class="menu-text"> Careers </span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php
						}
						if($access['settings']==1){
					?>
					
					<li class="">
						<a href="<?php echo $this->config->base_url(); ?>Settings">
							<i class="menu-icon fa fa-cogs"></i>
							<span class="menu-text"> Settings </span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php
						}
						if($access['users']=='admin'){
					?>
					<li class="">
						<a href="<?php echo $this->config->base_url(); ?>Users">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> User Management </span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php
						}
					?>
					

				</ul><!-- /.nav-list -->

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>