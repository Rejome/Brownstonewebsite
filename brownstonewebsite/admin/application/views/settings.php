<?php
include('header.inc');

?>

<div class="main-content">

	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/jquery.guillotine.css" />
	<div class="main-content-inner">
		<!-- #section:basics/content.breadcrumbs -->
		<div class="breadcrumbs" id="breadcrumbs">
			<script type="text/javascript">
				try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
			</script>

			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-cogs fa-3x"></i>
					&nbsp;
					<a href="<?php echo $this->config->base_url(); ?>Settings"><h1>Settings</h1></a>
				</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">

			<?php
				include('handlers.php');
			?>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<div class="tabbable">
						<ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
							<?php
								if($access['types']==1){
							?>
							<li>
								<a data-toggle="tab" href="#home4">Types</a>
							</li>
							<?php
								}
								if($access['industries']==1){
							?>
							<li>
								<a data-toggle="tab" href="#profile4">Industries</a>
							</li>
							<?php
								}
								if($access['suppliers']==1){
							?>
							<li>
								<a data-toggle="tab" href="#dropdown14">Suppliers</a>
							</li>
							<?php
								}
							?>
						</ul>

						<div class="tab-content">
							<div id="home4" class="tab-pane in active">
								<h4>
									<a href="#modal-table" role="button" class="green" data-toggle="modal" center> <i class="ace-icon fa fa-plus blue"></i> Add Types </a>
								</h4>
								<table id="types" class="table table-striped table-bordered table-hover">
									<thead>
										<th>ID</th>
										<th>Image</th>
										<th>Name</th>
										<th>Short</th>
										<th>Action</th>
									</thead>

									<tbody>
										<?php

										$this->load->helper('html');

										if(empty($types['type'])){

										}else if(!isset($types['type'][0])){
											$temp = $types;
											$types = array();
											$types['type'][0] = $temp['type'];
										}
										for($x = 0; $x<sizeof($types['type']); $x++){
											echo "<tr>";
											echo "<td id='ID".$types['type'][$x]['id']."'>".$types['type'][$x]['id']."</td>";

											$image_properties = array(
												'src'   => 'uploads\types/'.$types['type'][$x]['img'].'.jpg',
												'alt'   =>  $types['type'][$x]['img'],
												'class' => 'post_images',
												'width' => '200',
												'height'=> '200',
												'title' => $types['type'][$x]['img'],
												'rel'   => $types['type'][$x]['img']
												);

											echo "<td>".img($image_properties)."</td>";
											echo "<td id='image".$types['type'][$x]['id']."' class='hidden'>".$types['type'][$x]['img']."</td>";
											echo "<td id='name".$types['type'][$x]['id']."'>".$types['type'][$x]['name']."</td>";
											echo "<td id='short".$types['type'][$x]['id']."'>".$types['type'][$x]['short']."</td>";
											echo "<td>
											<a class='btn btn-xs btn-info' id='".$types['type'][$x]['id']."' href='#edittype' role='button' data-toggle='modal' onclick='edittype(this.id)'>
												<i class='ace-icon fa fa-pencil bigger-120'></i> 
											</a>

											<a class='btn btn-xs btn-danger' id='".$types['type'][$x]['id']."' href='#deletetype' role='button' data-toggle='modal' onclick='deletetype(this.id)'>
												<i class='ace-icon fa fa-trash-o bigger-120'></i>
											</a>
										</td>";
										echo "</tr>";

									}

									?>
								</tbody>
							</table>
						</div>

						<div id="profile4" class="tab-pane">
							<h4>
								<a href="#modal-table1" role="button" class="green" data-toggle="modal" center><i class="ace-icon fa fa-plus blue"></i> Add Industries </a>
							</h4>
							<table id="industries" class="table table-striped table-bordered table-hover">
								<thead>
									<th>ID</th>
									<th>Image</th>
									<th>Title</th>
									<th>Action</th>
								</thead>

								<tbody>
									<?php
									if(empty($industries['industry'])){

									}else if(!isset($industries['industry'][0])){
										$temp = $industries;
										$industries = array();
										$industries['industry'][0] = $temp['industry'];
									}
									for($x = 0; $x<sizeof($industries['industry']); $x++){
										echo "<tr>";
										echo "<td id='iID".$industries['industry'][$x]['id']."'>".$industries['industry'][$x]['id']."</td>";

										$image_properties = array(
											'src'   => 'uploads\industries/'.$industries['industry'][$x]['img'].'.jpg',
											'alt'   =>  $industries['industry'][$x]['img'],
											'class' => 'post_images',
											'width' => '200',
											'height'=> '200',
											'title' => $industries['industry'][$x]['img'],
											'rel'   => $industries['industry'][$x]['img']
											);

										echo "<td>".img($image_properties)."</td>";
										echo "<td id='iTitle".$industries['industry'][$x]['id']."'>".$industries['industry'][$x]['title']."</td>";
										echo "<td>
										<a class='btn btn-xs btn-info' id='".$industries['industry'][$x]['id']."' href='#editindustry' role='button' data-toggle='modal' onclick='editindustry(this.id)'>
											<i class='ace-icon fa fa-pencil bigger-120'></i> 
										</a>

										<a class='btn btn-xs btn-danger' id='".$industries['industry'][$x]['id']."' href='#deleteindustry' role='button' data-toggle='modal' onclick='deleteindustry(this.id)'>
											<i class='ace-icon fa fa-trash-o bigger-120'></i>
										</a>
									</td>";
									echo "</tr>";
								}

								?>
							</tbody>
						</table>

					</div>

					<div id="dropdown14" class="tab-pane">

						<h4>
							<a href="#modal-table2" role="button" class="green" data-toggle="modal" center><i class="ace-icon fa fa-plus blue"></i> Add Suppliers </a>
						</h4>
						<table id="suppliers" class="table table-striped table-bordered table-hover">
							<thead>
								<th>ID</th>
								<th>Image</th>
								<th>Title</th>
								<th>Site</th>
								<th>Action</th>
							</thead>

							<tbody>
								<?php
								if(empty($suppliers['supplier'])){

								}else if(!isset($suppliers['supplier'][0])){
									$temp = $suppliers;
									$suppliers = array();
									$suppliers['supplier'][0] = $temp['supplier'];
								}
								for($x = 0; $x < sizeof($suppliers['supplier']); $x++){
									echo "<tr>";
									echo "<td id='sID".$suppliers['supplier'][$x]['id']."'>".$suppliers['supplier'][$x]['id']."</td>";

									$image_properties = array(
										'src'   => 'uploads\suppliers/'.$suppliers['supplier'][$x]['img'].'.jpg',
										'alt'   =>  $suppliers['supplier'][$x]['img'],
										'class' => 'post_images',
										'width' => '160',
										'height'=> '80',
										'title' => $suppliers['supplier'][$x]['img'],
										'rel'   => $suppliers['supplier'][$x]['img']
										);

									echo "<td>".img($image_properties)."</td>";
									echo "<td id='stitle".$suppliers['supplier'][$x]['id']."'>".$suppliers['supplier'][$x]['title']."</td>";
									echo "<td ><a id='ssite".$suppliers['supplier'][$x]['id']."' href='http://".$suppliers['supplier'][$x]['site']."' target='_blank'>".$suppliers['supplier'][$x]['site']."</a></td>";
									echo "<td>
									<a class='btn btn-xs btn-info' id='".$suppliers['supplier'][$x]['id']."' href='#editsupplier' role='button' data-toggle='modal' onclick='editsupplier(this.id)'>
										<i class='ace-icon fa fa-pencil bigger-120'></i> 
									</a>

									<a class='btn btn-xs btn-danger' id='".$suppliers['supplier'][$x]['id']."' href='#deletesupplier' role='button' data-toggle='modal' onclick='deletesupplier(this.id)'>
										<i class='ace-icon fa fa-trash-o bigger-120'></i>
									</a>
								</td>";
								echo "</tr>";
							}

							?>
						</tbody>
					</table>

				</div>
			</div>
		</div>
		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.page-content -->
</div>
</div><!-- /.main-content -->

<?php
include('footer.inc');

?>

<script src="<?php echo $this->config->base_url(); ?>assets/js/jquery.guillotine.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>


<script type="text/javascript">
	jQuery(function($) {

		$('#id-input-file-1 , #id-input-file-2').ace_file_input({
			no_file:'No File ...',
			btn_choose:'Choose',
			btn_change:'Change',
			droppable:false,
			onchange:null,
			thumbnail:false //| true | large
					//whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php'
					//onchange:''
					//
				});
				//pre-show a file name, for example a previously selected file
				//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])

				var oTable1 = 
				$('#types')
			//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
			.dataTable( {
				bAutoWidth: false,
				"aoColumns": [
				null, { "bSortable": false },
				null, null, 
				{ "bSortable": false }, 
				null
				],
				"aaSorting": [],

					//,
					//"sScrollY": "200px",
					//"bPaginate": false,

					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element

					//"iDisplayLength": 50
				});

			var oTable2 = 
			$('#industries')
			//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
			.dataTable( {
				bAutoWidth: false,
				"aoColumns": [
				null, { "bSortable": false },
				null, 
				{ "bSortable": false }
				],
				"aaSorting": [],

					//,
					//"sScrollY": "200px",
					//"bPaginate": false,

					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element

					//"iDisplayLength": 50
				});

			var oTable3 = 
			$('#suppliers')
			//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
			.dataTable( {
				bAutoWidth: false,
				"aoColumns": [
				null, { "bSortable": false },
				null, null,
				{ "bSortable": false }
				],
				"aaSorting": [],

					//,
					//"sScrollY": "200px",
					//"bPaginate": false,

					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element

					//"iDisplayLength": 50
				});

		});
</script>

<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Settings/AddType">
	<div id="modal-table" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="white">&times;</span>
						</button>
						Please enter new type information below:
					</div>
				</div>


				<div class="modal-body no-padding">
					<!-- content -->
					<div class="row">
						<div class="col-sm-12">

							<div class="widget-body">
								<div class="widget-main">

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right hidden"> ID </label>

										<div class="col-sm-6 hidden">
											<input type="text" placeholder="<?php 
											if(empty($types['type'])){
												echo "0";
											}else if(!isset($types['type'][0])){
												echo "1";
											}else{
												echo $types['type'][sizeof($types['type'])-1]['id'] + 1;
											}
											?>" 
											value="<?php 
											if(empty($types['type'])){
												echo "0";
											}else if(!isset($types['type'][0])){
												echo "1";
											}else{
												echo $types['type'][sizeof($types['type'])-1]['id'] + 1;
											}
											?>" class="col-xs-12 col-sm-12" name="tid" readonly/>
										</div>
									</div>

									<div class="form-group">
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right"> Image </label>

											<div class="col-sm-6">
												<input type="file" placeholder="" id="id-input-file-2" name="userfile" required/>
											</div>
										</div>
										<div class="col-sm-12">
											<center>
												<input type="hidden" id="x" name="x" />
												<input type="hidden" id="y" name="y" />
												<input type="hidden" id="w" name="w" />
												<input type="hidden" id="h" name="h" />
												<input type="hidden" id="scale" name="scale" />
												<input type="hidden" id="angle" name="angle" />
												<div style="width:200px; height:200px">
													<img id="preview" src="uploads/types/-1.jpg" class="crop"/>
												</div>


												<div>
													<button id='rotate_left'  type='button' title='Rotate left'> &lt; </button>
													<button id='zoom_out'     type='button' title='Zoom out'> - </button>
													<button id='fit'          type='button' title='Fit image'> [ ]  </button>
													<button id='zoom_in'      type='button' title='Zoom in'> + </button>
													<button id='rotate_right' type='button' title='Rotate right'> &gt; </button>
												</div>
											</center>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Name </label>

										<div class="col-sm-6">
											<input type="text" placeholder="" class="col-xs-12 col-sm-12" name="tname" required/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Description </label>

										<div class="col-sm-6">
											<textarea class="form-control" placeholder="Default Text" name="tshort" required></textarea>
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

<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Settings/AddIndustry">
	<div id="modal-table1" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="white">&times;</span>
						</button>
						Please enter new industries information below:
					</div>
				</div>

				<div class="modal-body no-padding">
					<!-- content -->
					<div class="row">
						<div class="col-sm-12">
							<div class="widget-box">

								<div class="widget-body">
									<div class="widget-main">

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right hidden" > ID </label>

											<div class="col-sm-6 hidden">
												<input type="text" 
												placeholder="<?php 
												if(empty($industries['industry'])){
													echo "0";
												}else if(!isset($industries['industry'][0])){
													echo "1";
												}else{
													echo $industries['industry'][sizeof($industries['industry'])-1]['id'] + 1;
												}
												?>" 
												value="<?php 
												if(empty($industries['industry'])){
													echo "0";
												}else if(!isset($industries['industry'][0])){
													echo "1";
												}else{
													echo $industries['industry'][sizeof($industries['industry'])-1]['id'] + 1;
												}
												?>" class="col-xs-12 col-sm-12" name="iid" readonly/>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Title </label>

											<div class="col-sm-6">
												<input type="text" placeholder="" class="col-xs-12 col-sm-12" name="ititle" required/>
											</div>
										</div>

										<div class="form-group">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Image </label>

												<div class="col-sm-6">
													<input type="file" placeholder="" id="id-input-file-2" name="userfile2" required/>
												</div>
											</div>
											<div class="col-sm-12">
												<center>
													<input type="hidden" id="x2" name="x" />
													<input type="hidden" id="y2" name="y" />
													<input type="hidden" id="w2" name="w" />
													<input type="hidden" id="h2" name="h" />
													<input type="hidden" id="scale2" name="scale" />
													<input type="hidden" id="angle2" name="angle" />
													<div style="width:200px; height:200px">
														<img id="preview2" src="uploads/industries/-1.jpg" class="crop"/>
													</div>


													<div>
														<button id='rotate_left2'  type='button' title='Rotate left'> &lt; </button>
														<button id='zoom_out2'     type='button' title='Zoom out'> - </button>
														<button id='fit2'          type='button' title='Fit image'> [ ]  </button>
														<button id='zoom_in2'      type='button' title='Zoom in'> + </button>
														<button id='rotate_right2' type='button' title='Rotate right'> &gt; </button>
													</div>
												</center>
											</div>
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

<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Settings/AddSupplier">
	<div id="modal-table2" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="white">&times;</span>
						</button>
						Please enter new suppliers information below:
					</div>
				</div>

				<div class="modal-body no-padding">
					<!-- content -->
					<div class="row">
						<div class="col-sm-12">
							<div class="widget-box">


								<div class="widget-body">
									<div class="widget-main">


										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right hidden" for="form-field-1" > ID </label>

											<div class="col-sm-6 hidden">
												<input type="text" class="col-xs-12 col-sm-12" name="sid" placeholder="<?php 
												if(empty($suppliers['supplier'])){
													echo "0";
												}else if(!isset($suppliers['supplier'][0])){
													echo "1";
												}else{
													echo $suppliers['supplier'][sizeof($suppliers['supplier'])-1]['id'] + 1;
												}
												?>" 
												value="<?php 
												if(empty($suppliers['supplier'])){
													echo "0";
												}else if(!isset($suppliers['supplier'][0])){
													echo "1";
												}else{
													echo $suppliers['supplier'][sizeof($suppliers['supplier'])-1]['id'] + 1;
												}
												?>" readonly/>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Title </label>

											<div class="col-sm-6">
												<input type="text" placeholder="" class="col-xs-12 col-sm-12" name="stitle" required/>

											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Site </label>

											<div class="col-sm-6">
												<input type="text" class="col-xs-12 col-sm-12" name="ssite"/>
											</div>
										</div>

										<div class="form-group">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Image </label>

												<div class="col-sm-6">
													<input type="file" placeholder="" id="id-input-file-2" name="userfile5" required/>
												</div>
											</div>
											<div class="col-sm-12">
												<center>
													<input type="hidden" id="x5" name="x" />
													<input type="hidden" id="y5" name="y" />
													<input type="hidden" id="w5" name="w" />
													<input type="hidden" id="h5" name="h" />
													<input type="hidden" id="scale5" name="scale" />
													<input type="hidden" id="angle5" name="angle" />
													<div style="width:160px; height:80px">
														<img id="preview5" src="uploads/suppliers/-1.jpg" class="crop"/>
													</div>


													<div>
														<button id='rotate_left5'  type='button' title='Rotate left'> &lt; </button>
														<button id='zoom_out5'     type='button' title='Zoom out'> - </button>
														<button id='fit5'          type='button' title='Fit image'> [ ]  </button>
														<button id='zoom_in5'      type='button' title='Zoom in'> + </button>
														<button id='rotate_right5' type='button' title='Rotate right'> &gt; </button>
													</div>
												</center>
											</div>
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

<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Settings/DeleteType">
	<div id="deletetype" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="white">&times;</span>
						</button>
						Delete Confirm
					</div>
				</div>


				<div class="modal-body no-padding">
					<!-- content -->
					<div class="row">
						<div class="col-sm-12">

							<div class="widget-body">
								<div class="widget-main">
									<span>Do you want to delete ID: </span><span id='dttext' name="dttext"></span>
									<input type="text" class="hidden" id="dtid" name="dtid" />
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

<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Settings/DeleteIndustry">
	<div id="deleteindustry" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="white">&times;</span>
						</button>
						Delete Confirm
					</div>
				</div>


				<div class="modal-body no-padding">
					<!-- content -->
					<div class="row">
						<div class="col-sm-12">

							<div class="widget-body">
								<div class="widget-main">
									<span>Do you want to delete ID: </span><span id='ditext' name="ditext"></span>
									<input type="text" class="hidden" id="diid" name="diid" />
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

<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Settings/EditType">
	<div id="edittype" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="white">&times;</span>
						</button>
						Edit Confirm
					</div>
				</div>

				<div class="modal-body no-padding">
					<!-- content -->
					<div class="row">
						<div class="col-sm-12">

							<div class="widget-body">
								<div class="widget-main">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right hidden"> ID </label>

										<div class="col-sm-6">
											<input type="text" id='etid' class="col-xs-12 col-sm-12 hidden" name="etid" readonly/>
										</div>
									</div>

									<div class="form-group">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Image </label>

												<div class="col-sm-6">
													<input type="file" placeholder="" id="id-input-file-2" name="userfile1" required/>
												</div>
											</div>
											<div class="col-sm-12">
												<center>
													<input type="hidden" id="x1" name="x" />
													<input type="hidden" id="y1" name="y" />
													<input type="hidden" id="w1" name="w" />
													<input type="hidden" id="h1" name="h" />
													<input type="hidden" id="scale1" name="scale" />
													<input type="hidden" id="angle1" name="angle" />
													<div style="width:200px; height:200px">
														<img id="preview1" src="uploads/types/-1.jpg" class="crop"/>
													</div>


													<div>
														<button id='rotate_left1'  type='button' title='Rotate left'> &lt; </button>
														<button id='zoom_out1'     type='button' title='Zoom out'> - </button>
														<button id='fit1'          type='button' title='Fit image'> [ ]  </button>
														<button id='zoom_in1'      type='button' title='Zoom in'> + </button>
														<button id='rotate_right1' type='button' title='Rotate right'> &gt; </button>
													</div>
												</center>
											</div>
										</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Name </label>

										<div class="col-sm-6">
											<input type="text" placeholder="" id='etname' class="col-xs-12 col-sm-12" name="etname" required/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Description </label>

										<div class="col-sm-6">
											<textarea class="form-control" placeholder="Default Text" id='etshort' name="etshort" required></textarea>
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

<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Settings/EditIndustry">
	<div id="editindustry" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="white">&times;</span>
						</button>
						Edit Confirm
					</div>
				</div>

				<div class="modal-body no-padding">
					<!-- content -->
					<div class="row">
						<div class="col-sm-12">

							<div class="widget-body">
								<div class="widget-main">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right hidden" > ID </label>

										<div class="col-sm-6">
											<input type="text" placeholder="" class="col-xs-12 col-sm-12 hidden" name="eiid" id="eiid" readonly/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Title </label>

										<div class="col-sm-6">
											<input type="text" placeholder="" class="col-xs-12 col-sm-12" name="eititle" id="eititle" required/>
										</div>
									</div>

									<div class="form-group">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Image </label>

												<div class="col-sm-6">
													<input type="file" placeholder="" id="id-input-file-2" name="userfile3" required/>
												</div>
											</div>
											<div class="col-sm-12">
												<center>
													<input type="hidden" id="x3" name="x" />
													<input type="hidden" id="y3" name="y" />
													<input type="hidden" id="w3" name="w" />
													<input type="hidden" id="h3" name="h" />
													<input type="hidden" id="scale3" name="scale" />
													<input type="hidden" id="angle3" name="angle" />
													<div style="width:200px; height:200px">
														<img id="preview3" src="uploads/industries/-1.jpg" class="crop"/>
													</div>


													<div>
														<button id='rotate_left3'  type='button' title='Rotate left'> &lt; </button>
														<button id='zoom_out3'     type='button' title='Zoom out'> - </button>
														<button id='fit3'          type='button' title='Fit image'> [ ]  </button>
														<button id='zoom_in3'      type='button' title='Zoom in'> + </button>
														<button id='rotate_right3' type='button' title='Rotate right'> &gt; </button>
													</div>
												</center>
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

<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Settings/EditSupplier">
	<div id="editsupplier" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="white">&times;</span>
						</button>
						Edit Confirm
					</div>
				</div>

				<div class="modal-body no-padding">
					<!-- content -->
					<div class="row">
						<div class="col-sm-12">

							<div class="widget-body">
								<div class="widget-main">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right hidden" for="form-field-1" > ID </label>

										<div class="col-sm-6">
											<input type="text" id="esid" class="col-xs-12 col-sm-12 hidden" name="esid"/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Title </label>

										<div class="col-sm-6">
											<input type="text" id="estitle" placeholder="" class="col-xs-12 col-sm-12" name="estitle" required/>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Site </label>

										<div class="col-sm-6">
											<input type="text" class="col-xs-12 col-sm-12" name="essite" id="essite"/>
										</div>
									</div>

									<div class="form-group">
											<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right"> Image </label>

												<div class="col-sm-6">
													<input type="file" placeholder="" id="id-input-file-2" name="userfile6" required/>
												</div>
											</div>
											<div class="col-sm-12">
												<center>
													<input type="hidden" id="x6" name="x" />
													<input type="hidden" id="y6" name="y" />
													<input type="hidden" id="w6" name="w" />
													<input type="hidden" id="h6" name="h" />
													<input type="hidden" id="scale6" name="scale" />
													<input type="hidden" id="angle6" name="angle" />
													<div style="width:160px; height:80px">
														<img id="preview6" src="uploads/suppliers/-1.jpg" class="crop"/>
													</div>


													<div>
														<button id='rotate_left6'  type='button' title='Rotate left'> &lt; </button>
														<button id='zoom_out6'     type='button' title='Zoom out'> - </button>
														<button id='fit6'          type='button' title='Fit image'> [ ]  </button>
														<button id='zoom_in6'      type='button' title='Zoom in'> + </button>
														<button id='rotate_right6' type='button' title='Rotate right'> &gt; </button>
													</div>
												</center>
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

<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Settings/DeleteSupplier">
	<div id="deletesupplier" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="white">&times;</span>
						</button>
						Delete Confirm
					</div>
				</div>


				<div class="modal-body no-padding">
					<!-- content -->
					<div class="row">
						<div class="col-sm-12">

							<div class="widget-body">
								<div class="widget-main">
									<span>Are you sure do you want to delete: </span><span id='dstext' name="dstext"></span>
									<input type="text" class="hidden" id="dsid" name="dsid" />
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



<script>
	function edittype(clicked_id) {
		document.getElementById("etid").value = document.getElementById("ID"+clicked_id).innerHTML;
		document.getElementById("etname").value = document.getElementById("name"+clicked_id).innerHTML;
		document.getElementById("etshort").value = document.getElementById("short"+clicked_id).innerHTML;
	}
</script>

<script>
	function editindustry(clicked_id) {
		document.getElementById("eiid").value = document.getElementById("iID"+clicked_id).innerHTML;
		document.getElementById("eititle").value = document.getElementById("iTitle"+clicked_id).innerHTML;
	}
</script>


<script>
	function editsupplier(clicked_id) {
		document.getElementById("esid").value = document.getElementById("sID"+clicked_id).innerHTML;
		document.getElementById("estitle").value = document.getElementById("stitle"+clicked_id).innerHTML;
		document.getElementById("essite").value = document.getElementById("ssite"+clicked_id).innerHTML;
	}
</script>

<script>
	function deletetype(clicked_id) {
		document.getElementById("dttext").innerHTML = document.getElementById("name"+clicked_id).innerHTML;
		document.getElementById("dtid").value = document.getElementById("ID"+clicked_id).innerHTML;
	}
</script>

<script>
	function deleteindustry(clicked_id) {
		document.getElementById("ditext").innerHTML = document.getElementById("iTitle"+clicked_id).innerHTML;
		document.getElementById("diid").value = document.getElementById("iID"+clicked_id).innerHTML;
	}
</script>

<script>
	function deletesupplier(clicked_id) {
		document.getElementById("dstext").innerHTML = document.getElementById("stitle"+clicked_id).innerHTML;
		document.getElementById("dsid").value = document.getElementById("sID"+clicked_id).innerHTML;
	}
</script>

<script type="text/javascript">
	function readURL(input, idname, widthx, heighty) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#preview'+idname).attr('src', e.target.result);
				jQuery(function() {
					var picture = $('#preview'+idname);
					// Make sure the image is completely loaded before calling the plugin
				    picture.on('load', function(){

				    	if (picture.guillotine('instance')) picture.guillotine('remove');

				    	picture.guillotine({
				    		width: widthx,
				    		height: heighty,
				    		eventOnChange: 'guillotinechange'
				    	});
				       	// Initialize plugin (with custom event)
				       	// Display inital data
				       	var data = picture.guillotine('getData');
				       	for(var key in data) { 
				       		$('#'+key+''+idname).html(data[key]); 
				       	}
				       	// Bind button actions
				       	$('#rotate_left'+idname).click(function(){ 
				       		picture.guillotine('rotateLeft'); 
				       	});
				       	$('#rotate_right'+idname).click(function(){ 
				       		picture.guillotine('rotateRight'); 
				       	});
				       	$('#fit'+idname).click(function(){ 
				       		picture.guillotine('fit'); 
				       	});
				       	$('#zoom_in'+idname).click(function(){ 
				       		picture.guillotine('zoomIn'); 
				      	});
				       	$('#zoom_out'+idname).click(function(){ 
				       		picture.guillotine('zoomOut'); 
				       	});
				       	// Update data on change
				       	picture.on('guillotinechange', function(ev, data, action) {
				       		data.scale = parseFloat(data.scale.toFixed(4));
				       		for(var k in data) { 
				       			$('#'+k+''+idname).val(data[k]); 
				       		}
				       	});
				       	jQuery('#fit'+idname).click();
				    });
			      	// Make sure the 'load' event is triggered at least once (for cached images)
			    });
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("input[name=userfile]").change(function(){
		console.log(this);
		readURL(this,'',201,201);
	});

	$("input[name=userfile1]").change(function(){
		console.log(this);
		readURL(this,'1',201,201);
	});

	$("input[name=userfile2]").change(function(){
		console.log(this);
		readURL(this,'2',201,201);
	});

	$("input[name=userfile3]").change(function(){
		console.log(this);
		readURL(this,'3',201,201);
	});

	$("input[name=userfile5]").change(function(){
		console.log(this);
		readURL(this,'5',161,81);
	});

	$("input[name=userfile6]").change(function(){
		console.log(this);
		readURL(this,'6',161,81);
	});

</script>

<script type="text/javascript">
	$('form').submit(function() {
		$(this).find("button[type='submit']").prop('disabled',true);
	});
</script>