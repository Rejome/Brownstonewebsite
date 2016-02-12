<?php
include('header.inc');
?>
<div class="main-content">
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/jquery-ui.css" />
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/colorbox.css" />
	<div class="main-content-inner">
		<!-- #section:basics/content.breadcrumbs -->
		<div class="breadcrumbs" id="breadcrumbs">
			<script type="text/javascript">
				try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
			</script>
			<ul class="breadcrumb">
				<li>
					<i class="fa fa-home fa-3x"></i>
					&nbsp;
					<a href="<?php echo $this->config->base_url(); ?>Dashboard"><h1>Dashboard</h1></a>
					
				</li>
			</ul>
		</div>
		<!-- /section:settings.box -->
		<div class="page-header">

		</div><!-- /.page-header -->
		<!-- /section:basics/content.breadcrumbs -->
		
			
		<div class="row">
			<div class="col-xs-12">
				<div class="page-content">
					<div>
						<p>Welcome user</p>
					</div>




					<div class="row">
						<?php
							if($access['banners']==1){
						?>
						<div class="col-lg-3 col-md-6">
							<div class="panel btn-info">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="glyphicon glyphicon-picture fa-5x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge"></div>
											<div>Banner Manager</div>
										</div>
									</div>
								</div>
								<a href="<?php echo $this->config->base_url(); ?>Banners" class="hide-option"  title="Photo gallery of all the products in Brownstone">
									<div class="panel-footer">
										<span class="pull-left">Photo gallery </span>
										<span class="pull-right"></i></span>
										<div class="clearfix"></div>
									</div>
								</a>
							</div>
						</div>
						<?php
							}
							if($access['products']==1){
						?>
						<div class="col-lg-3 col-md-6">
							<div class="panel btn-yellow">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3 ">
											<i class="fa fa-list fa-5x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge"></div>
											<div>Products</div>
										</div>
									</div>
								</div>
								<a href="<?php echo $this->config->base_url();?>Products" class="hide-option"  title="All the Products in Brownstone">
									<div class="panel-footer">
										<span class="pull-left">List of all Products</span>
										<span class="pull-right"></i></span>
										<div class="clearfix"></div>
									</div>
								</a>
							</div>
						</div>
						<?php
							}
							if($access['news']==1){
						?>
						<div class="col-lg-3 col-md-6">
							<div class="panel btn-danger">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-calendar fa-5x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge"></div>
											<div>News & Events</div>
										</div>
									</div>
								</div>
								<a href="<?php echo $this->config->base_url(); ?>News" class="hide-option"  title="Upcoming Events in Brownstone">
									<div class="panel-footer">
										<span class="pull-left">Upcoming events</span>
										<span class="pull-right"></i></span>
										<div class="clearfix"></div>
									</div>
								</a>
							</div>
						</div>
						<?php
							}
							if($access['careers']==1){
						?>
						<div class="col-lg-3 col-md-6">
							<div class="panel btn-success">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-briefcase fa-5x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge"></div>
											<div>Careers</div>
										</div>
									</div>
								</div>
								<a href="<?php echo $this->config->base_url(); ?>Careers" class="hide-option"  title="Job offers in Brownstone">
									<div class="panel-footer">
										<span class="pull-left">List of job offers</span>
										<span class="pull-right"></i></span>
										<div class="clearfix"></div>
									</div>
								</a>
							</div>
						</div>
						<?php
							}
							if($access['settings']==1){
						?>
						<div class="col-lg-3 col-md-6">
							<div class="panel btn-app">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-cogs fa-5x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge"></div>
											<div>Settings</div>
										</div>
									</div>
								</div>
								<a href="<?php echo $this->config->base_url(); ?>Settings" class="hide-option"  title="Type, Industry, Supplier">
									<div class="panel-footer">
										<span class="pull-left">Types, Industry, Suppliers</span>
										<span class="pull-right"></i></span>
										<div class="clearfix"></div>
									</div>
								</a>
							</div>
						</div>
						<?php
							}
							if($access['users']=='admin'){
						?>
						<div class="col-lg-3 col-md-6">
							<div class="panel btn-purple">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-users fa-5x"></i>
										</div>
										<div class="col-xs-9 text-right">
											<div class="huge"></div>
											<div>User Management</div>
										</div>
									</div>
								</div>
								<a href="<?php echo $this->config->base_url(); ?>Users" class="hide-option"  title="User Management">
									<div class="panel-footer">
										<span class="pull-left">User management with history logs </span>
										<span class="pull-right"></i></span>
										<div class="clearfix"></div>
									</div>
								</a>
							</div>
						</div>	
						<?php
							}
						?>
					</div>
				</div><!-- /.page-content -->
			</div>
		</div>

	</div><!-- /.main-content -->
</div>
<?php
include('footer.inc');

?>
<script src="<?php echo $this->config->base_url(); ?>assets/js/jquery.colorbox.js"></script>
<script type="text/javascript">
	jQuery(function($) {
		var $overflow = '';
		var colorbox_params = {
			rel: 'colorbox',
			reposition:true,
			scalePhotos:true,
			scrolling:false,
			previous:'<i class="ace-icon fa fa-arrow-left"></i>',
			next:'<i class="ace-icon fa fa-arrow-right"></i>',
			close:'&times;',
			current:'{current} of {total}',
			maxWidth:'100%',
			maxHeight:'100%',
			onOpen:function(){
				$overflow = document.body.style.overflow;
				document.body.style.overflow = 'hidden';
			},
			onClosed:function(){
				document.body.style.overflow = $overflow;
			},
			onComplete:function(){
				$.colorbox.resize();
			}
		};

		$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
	$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
	
	
	$(document).one('ajaxloadstart.page', function(e) {
		$('#colorbox, #cboxOverlay').remove();
	});
})
</script>


<!--Modals-->

<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Dashboard/EditBanner">
	<div id="edit" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="white">&times;</span>
						</button>
						Upload New Image information below:
					</div>
				</div>

				<div class="modal-body no-padding">
					<!-- content -->
					<div class="row">
						<div class="col-sm-12">

							<div class="widget-body">
								<div class="widget-main">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1" >  </label>

										<div class="col-sm-6">
											<input type="file" placeholder="" id="id-input-file-2" name="userfile1" />
											<input type="text" name="eid" class="hidden" id="eid" />
										</div>
									</div>
								</div>
							</div>

						</div>
					</div><!-- /.col -->


					<div class="modal-footer no-margin-top">

						<center>
							<button class="btn btn-primary" type="submit">
								Submit
							</button>
							&nbsp; &nbsp; &nbsp;
							<button class="btn btn-danger" data-dismiss="modal">
								Cancel
							</button>
						</center>

					</div>
				</div><!-- /.modal-content -->
				
			</div><!-- /.modal-dialog -->
		</div>
	</div>
</form>

<div id="delete" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header no-padding">
				<div class="table-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<span class="white">&times;</span>
					</button>
					Delete Confirmation
				</div>
			</div>
			<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Dashboard/DeleteBanner">
				<div class="modal-body no-padding">
					<!-- content -->
					<div class="row">
						<div class="col-sm-12">

							<div class="widget-body">
								<div class="widget-main">
									<span>Do you want to delete ID: </span><span id="ddtext" name="ddtext"></span>
									<input type="text" class="hidden" id="ddid" name="ddid" />
								</div>
							</div>

						</div>
					</div><!-- /.col -->


					<div class="modal-footer no-margin-top">

						<center>
							<button class="btn btn-primary" type="submit">
								Submit
							</button>
							&nbsp; &nbsp; &nbsp;
							<button class="btn btn-danger" data-dismiss="modal">
								Cancel
							</button>
						</center>
					</div>
				</div><!-- /.modal-content -->
			</form>
		</div><!-- /.modal-dialog -->
	</div>
</div>

<script src="<?php echo $this->config->base_url(); ?>assets/js/jquery-ui.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/js/jquery.ui.touch-punch.js"></script>



<script>
	function edit(clicked_id) {
		document.getElementById("eid").value = document.getElementById("id"+clicked_id).innerHTML;
	}
</script>


<script>
	function delete1(clicked_id) {
		document.getElementById("ddtext").innerHTML = document.getElementById("id"+clicked_id).innerHTML;
		document.getElementById("ddid").value = document.getElementById("id"+clicked_id).innerHTML;
	}
</script>
