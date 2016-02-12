<?php
include('header.inc');
?>
<!-- /section:basics/sidebar -->
<div class="main-content">
	<div class="main-content-inner">
		<!-- #section:basics/content.breadcrumbs -->
		<div class="breadcrumbs" id="breadcrumbs">
			<script type="text/javascript">
				try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
			</script>

			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-users fa-3x"></i>
					&nbsp;
					<a href="<?php echo $this->config->base_url(); ?>Users"><h1>User Management</h1></a>
				</li>
			</ul>
		</div>

		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">
			<?php
				include('handlers.php');
			?>
			<!-- /section:settings.box -->
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<h4>
						<a href="#add-users" role="button" class="green" data-toggle="modal" center><i class="ace-icon fa fa-plus blue"></i> Add users </a>
					</h4>
					<table id="users" class="table table-striped table-bordered table-hover">
						<thead>
							<th>Username</th>
							<th>Level</th>
							<th>Access</th>
							<th>Action</th>
						</thead>

						<tbody>
							<?php
								if(empty($logins['login'])){

								}else if(!isset($logins['login'][0])){
									$temp = $logins;
									$logins = array();
									$logins['login'][0] = $temp['login'];
								}
								for($x = 0; $x<sizeof($logins['login']); $x++){
									echo "<tr>";
									echo "<td id='username".$logins['login'][$x]['name']."'>".$logins['login'][$x]['name']."</td>";
									echo "<td id='level".$logins['login'][$x]['name']."'>".$logins['login'][$x]['level']."</td>";
									$access = $logins['login'][$x]['access'];
									$text = "";

									if($access>=64){
										$text .= " Industries,";
										$access-=64;
									}
									if($access>=32){
										$text .= " Suppliers,";
										$access-=32;
									}
									if($access>=16){
										$text .= " Types,";
										$access-=16;
									}if($access>=8){
										$text .= " Careers,";
										$access-=8;
									}if($access>=4){
										$text .= " News and Events,";
										$access-=4;
									}if($access>=2){
										$text .= " Products,";
										$access-=2;
									}if($access>=1){
										$text .= " Banners,";
										$access-=1;
									}if($logins['login'][$x]['level']=='admin'){
										$text .= " Users,";
									}
									echo "<td id='access".$logins['login'][$x]['name']."'>".substr($text, 0, strlen($text)-1)."</td>";
									echo "<td><a class='btn btn-xs btn-info' id='".$logins['login'][$x]['name']."' href='#edituser' role='button' data-toggle='modal' onclick='edituser(this.id)'><i class='ace-icon fa fa-pencil bigger-120'></i> </a><a class='btn btn-xs btn-danger' id='".$logins['login'][$x]['name']."' href='#deleteuser' role='button' data-toggle='modal' onclick='deleteuser(this.id)'><i class='ace-icon fa fa-trash-o bigger-120'></i></a></td>";
									echo "</tr>";
								}
							?>
						</tbody>
					</table>

					
					<table id="users2" class="table table-striped table-bordered table-hover">
						<thead>
							<th>Category</th>
							<th>ID</th>
							<th>Activity</th>
							<th>Date</th>
						</thead>

						<tbody>
							<?php
								foreach ($histories['history'] as $key => $value) {
									echo "<tr>";
									echo "<td>".$value['category']."</td>";
									echo "<td>".$value['cid']."</td>";
									echo "<td>".$value['activity']."</td>";
									echo "<td>".$value['date']."</td>";
									echo "</tr>";
								}
							?>
						</tbody>
					</table>

					
					<!-- PAGE CONTENT ENDS -->
				</div><!-- /.col -->
			</div><!-- /.row -->

		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->


<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Users/deleteUser">
	<div id="deleteuser" class="modal fade" tabindex="-1">
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

				<form>
					<div class="modal-body no-padding">
						<!-- content -->
						<div class="row">
							<div class="col-sm-12">

								<div class="widget-body">
									<div class="widget-main">
										<span>Do you want to delete user: </span><span id='dutext' name="dutext"></span>
										<input type="text" class="hidden" id="duid" name="duid" />
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
</form>

<?php
include('footer.inc');
?>

<div id="add-users" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header no-padding">
				<div class="table-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<span class="white">&times;</span>
					</button>
					Please enter new Users information below:
				</div>
			</div>


			<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Users/AddUsers">
				<div class="modal-body no-padding">
					<!-- content -->
					<div class="row">
						<div class="col-sm-12">
							<div class="widget-box">
								<div class="widget-body">
									<div class="widget-main">

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Username </label>

											<div class="col-sm-6">
												<input type="text" placeholder="" class="col-xs-2 col-sm-12" name="username" required pattern="[A-Za-z]{3,}"/>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Password </label>

											<div class="col-sm-6">
												<input type="password" placeholder="" class="col-xs-2 col-sm-12" name="password" required/>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Confirm Password </label>

											<div class="col-sm-6">
												<input type="password" placeholder="" class="col-xs-2 col-sm-12" name="cpassword" required/>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right"> Level </label>

											<div class="col-sm-6">
												<select class="form-control" name="level" required>
													<option value="user">User</option>
													<option value="admin">Admin</option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right"> Access </label>
											<div class="row">
												<div class="checkbox">
													<div class="rows">
														<label>
															<input type="checkbox" name="access[]" class="ace" value="1" required>
															<span class="lbl">Banners</span>
														</label>

														<label>
															<input type="checkbox" name="access[]" class="ace" value="2" required>
															<span class="lbl">Products</span>
														</label>

														<label>
															<input type="checkbox" name="access[]" class="ace" value="4" required>
															<span class="lbl">News & Events</span>
														</label>
													</div>
													<div class="rows">
														<label>
															<input type="checkbox" name="access[]" class="ace" value="8" required>
															<span class="lbl">Careers</span>
														</label>	

														<label>
															<input type="checkbox" name="access[]" class="ace" value="16" required>
															<span class="lbl">Types</span>
														</label>

														<label>
															<input type="checkbox" name="access[]" class="ace" value="16" required>
															<span class="lbl">Suppliers</span>
														</label>

														<label>
															<input type="checkbox" name="access[]" class="ace" value="16" required>
															<span class="lbl">Industries</span>
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /.col -->
					<div class="modal-footer no-margin-top">

						<center>
							<button class="btn btn-info" type="submit">
								<i class="ace-icon fa fa-check bigger-110"></i>
								Submit
							</button>
							&nbsp; &nbsp; &nbsp;
							<button class="btn btn-info" data-dismiss="modal">
								<i class="ace-icon fa fa-remove bigger-110"></i>
								Cancel
							</button>
						</center>
					</div>
				</div><!-- /.modal-content -->
			</form>
		</div><!-- /.modal-dialog -->
	</div>
</div>

<!--
<div id="add-users2" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header no-padding">
				<div class="table-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<span class="white">&times;</span>
					</button>
					Please enter new Users information below:
				</div>
			</div>


			<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Users/AddUsers">
				<div class="modal-body no-padding">
					
					<div class="row">
						<div class="col-sm-12">
							<div class="widget-box">
								<div class="widget-body">
									<div class="widget-main">

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Username </label>

											<div class="col-sm-6">
												<input type="text" placeholder="" class="col-xs-2 col-sm-12" name="username" required pattern="[A-Za-z]{3,}"/>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Password </label>

											<div class="col-sm-6">
												<input type="password" placeholder="" class="col-xs-2 col-sm-12" name="password" required/>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Confirm Password </label>

											<div class="col-sm-6">
												<input type="password" placeholder="" class="col-xs-2 col-sm-12" name="cpassword" required/>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right"> Level </label>

											<div class="col-sm-6">
												<select class="form-control" name="level" required>
													<option value="user">User</option>
													<option value="admin">Admin</option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right"> Access </label>
											<div class="row">
												<div class="checkbox">
													<div>
														<label>
															<input type="checkbox" name="access[]" class="ace" value="1">
															<span class="lbl">Banners</span>
														</label>

														<label>
															<input type="checkbox" name="access[]" class="ace" value="2">
															<span class="lbl">Products</span>
														</label>

														<label>
															<input type="checkbox" name="access[]" class="ace" value="4">
															<span class="lbl">News & Events</span>
														</label>

														<label>
															<input type="checkbox" name="access[]" class="ace" value="8">
															<span class="lbl">Careers</span>
														</label>	

														<label>
															<input type="checkbox" name="access[]" class="ace" value="16">
															<span class="lbl">Types</span>
														</label>

														<label>
															<input type="checkbox" name="access[]" class="ace" value="32">
															<span class="lbl">Suppliers</span>
														</label>

														<label>
															<input type="checkbox" name="access[]" class="ace" value="64">
															<span class="lbl">Industries</span>
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer no-margin-top">

						<center>
							<button class="btn btn-info" type="submit">
								<i class="ace-icon fa fa-check bigger-110"></i>
								Submit
							</button>
							&nbsp; &nbsp; &nbsp;
							<button class="btn btn-info" data-dismiss="modal">
								<i class="ace-icon fa fa-remove bigger-110"></i>
								Cancel
							</button>
						</center>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
-->
<div id="edituser" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header no-padding">
				<div class="table-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<span class="white">&times;</span>
					</button>
					Please enter new Users information below:
				</div>
			</div>


			<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Users/EditUsers">
				<div class="modal-body no-padding">
					<!-- content -->
					<div class="row">
						<div class="col-sm-12">
							<div class="widget-box">
								<div class="widget-body">
									<div class="widget-main">

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Username </label>

											<div class="col-sm-6">
												<input type="text" placeholder="" class="col-xs-2 col-sm-12" id="eusername" name="eusername" readonly/>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1">New Password </label>

											<div class="col-sm-6">
												<input type="password" placeholder="" class="col-xs-2 col-sm-12" name="epassword"/>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Confirm Password </label>

											<div class="col-sm-6">
												<input type="password" placeholder="" class="col-xs-2 col-sm-12" name="ecpassword"/>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right"> Level </label>

											<div class="col-sm-6">
												<select class="form-control" name="elevel" id="elevel" required>
													<option value="user">User</option>
													<option value="admin">Admin</option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right"> Access </label>
											<div class="row">
												<div class="checkbox">
													<div>
														<label>
															<input type="checkbox" id="eaccess" name="eaccess[]" class="ace" value="1" required>
															<span class="lbl">Banners</span>
														</label>

														<label>
															<input type="checkbox" id="eaccess" name="eaccess[]" class="ace" value="2" required>
															<span class="lbl">Products</span>
														</label>

														<label>
															<input type="checkbox" id="eaccess" name="eaccess[]" class="ace" value="4" required>
															<span class="lbl">News and Events</span>
														</label>
														<br/>
														<label>
															<input type="checkbox" id="eaccess" name="eaccess[]" class="ace" value="8" required>
															<span class="lbl">Careers</span>
														</label>	

														<label>
															<input type="checkbox" id="eaccess" name="eaccess[]" class="ace" value="16" required>
															<span class="lbl">Types</span>
														</label>

														<label>
															<input type="checkbox" id="eaccess" name="eaccess[]" class="ace" value="32" required>
															<span class="lbl">Suppliers</span>
														</label>

														<label>
															<input type="checkbox" id="eaccess" name="eaccess[]" class="ace" value="64" required>
															<span class="lbl">Industries</span>
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /.col -->
					<div class="modal-footer no-margin-top">

						<center>
							<button class="btn btn-info" type="submit">
								<i class="ace-icon fa fa-check bigger-110"></i>
								Submit
							</button>
							&nbsp; &nbsp; &nbsp;
							<button class="btn btn-info" data-dismiss="modal">
								<i class="ace-icon fa fa-remove bigger-110"></i>
								Cancel
							</button>
						</center>
					</div>
				</div><!-- /.modal-content -->
			</form>
		</div><!-- /.modal-dialog -->
	</div>
</div>

<script src="<?php echo $this->config->base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>

<script type="text/javascript">
	$(function(){
	    var requiredCheckboxes = $(':checkbox[required]');

	    requiredCheckboxes.change(function(){

	        if(requiredCheckboxes.is(':checked')) {
	            requiredCheckboxes.removeAttr('required');
	        }

	        else {
	            requiredCheckboxes.attr('required', 'required');
	        }
	    });
	});
</script>

<script type="text/javascript">
	var oTable1 = 
	$('#users').dataTable( {
		bAutoWidth: false,
		"aoColumns": [
		null, null, null, { "bSortable": false }
		],
		"aaSorting": [],
	});
</script>

<script type="text/javascript">
	var oTable1 = 
	$('#users2').dataTable( {
		bAutoWidth: false,
		"aoColumns": [
		null, null, null, null
		],
		"aaSorting": [],
		"order": [[ 3, "desc" ]]
	});
</script>

<script>
	function edituser(clicked_id) {

		document.getElementById("eusername").value = document.getElementById("username"+clicked_id).innerHTML;
		document.getElementById("elevel").value = document.getElementById("level"+clicked_id).innerHTML;

		var e = document.getElementById("access"+clicked_id).innerHTML;
		var p = document.getElementsByName("eaccess[]");
		var ec = e.split(",");
		var x=0;
		for (i = 0; i < ec.length; i++) { 
			if(ec[i] == ' Industries'){
				p[6].checked = true;
			}else if(ec[i] == ' Suppliers'){
				p[5].checked = true;
			}else if(ec[i] == ' Types'){
				p[4].checked = true;
			}else if(ec[i] == ' Careers'){
				p[3].checked = true;
			}else if(ec[i] == ' News and Events'){
				p[2].checked = true;
			}else if(ec[i] == ' Products'){
				p[1].checked = true;
			}else if(ec[i] == ' Banners'){
				p[0].checked = true;
			}
		}
	}
</script>

<script>
	function deleteuser(clicked_id) {
		document.getElementById("dutext").innerHTML = document.getElementById("username"+clicked_id).innerHTML;
		document.getElementById("duid").value = document.getElementById("username"+clicked_id).innerHTML;
	}
</script>

<script type="text/javascript">
	$('form').submit(function() {
		$(this).find("button[type='submit']").prop('disabled',true);
	});
</script>