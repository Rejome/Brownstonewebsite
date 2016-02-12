<?php
include('header.inc');
$this->load->helper('url');
?>
<!-- /section:basics/sidebar -->
<div class="main-content">


	<script>
		function loadXMLDoc(el){
			var xmlhttp;
		  if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		  	xmlhttp=new XMLHttpRequest();
		  }
		  else{// code for IE6, IE5
		  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  xmlhttp.onreadystatechange=function(){
		  	if (xmlhttp.readyState==4 && xmlhttp.status==200){
		  		document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
		  	}
		  }
		  xmlhttp.open("POST","news/viewdocs",true);
		  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		  xmlhttp.send("p_id="+encodeURIComponent(el)+"&path=uploads/newsevents/readmore/");
		}
	</script>

	<script>
		function deleteAttachments(el){
			var splitname = el.split("/");
			var xmlhttp;
		  	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		  		xmlhttp=new XMLHttpRequest();
		  	}else{// code for IE6, IE5
		  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  	}
		  	xmlhttp.onreadystatechange=function(){
		  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		  			document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
		  		}
		  	}
		  	xmlhttp.open("POST","news/deleteAttachments",true);
		  	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		  	xmlhttp.send("p_id="+splitname[splitname.length-2]+"&map="+splitname[splitname.length-1]+"&path=uploads/newsevents/readmore/");
		  }
		</script>

		<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/jquery-ui.custom.css" />
		<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/daterangepicker.css" />
		<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/jquery.guillotine.css" />

		<style type="text/css">
			.datepicker {z-index: 1151 !important}
		</style>


		<div class="main-content-inner">
			<!-- #section:basics/content.breadcrumbs -->
			<div class="breadcrumbs" id="breadcrumbs">
				<script type="text/javascript">
					try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}

				</script>

				<ul class="breadcrumb">
					<li>
						<i class="ace-icon fa fa-calendar fa-3x"></i>
						&nbsp;
						<a href="<?php echo $this->config->base_url(); ?>News"><h1>News and Events</h1></a>
					</li>
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
								<a href="#modal-table" role="button" class="green" data-toggle="modal" center><i class="ace-icon fa fa-plus blue"></i> Add News & Events </a>
							</h4>
							
							<table id="newstable" class="table table-striped table-bordered table-hover wrap" style="width: 100%">
								<thead>
									<th>ID</th>
									<th>Image</th>
									<th>Type</th>
									<th>Title</th>
									<th>Date</th>
									<th>Location</th>
									<th>Description</th>
									<th>Attachments</th>
									<th>Action</th>
								</thead>

								<tbody>
									<?php
									$this->load->helper('html');

									if(empty($newsevents['newsevent'])){

									}else if(!isset($newsevents['newsevent'][0])){
										$temp = $newsevents;
										$newsevents = array();
										$newsevents['newsevent'][0] = $temp['newsevent'];
									}
									for($x = 0; $x<sizeof($newsevents['newsevent']); $x++){
										echo "<tr>";
										echo "<td id='id".$newsevents['newsevent'][$x]['id']."'>".$newsevents['newsevent'][$x]['id']."</td>";
										$image_properties = array(
											'src'   => 'uploads\newsevents/'.$newsevents['newsevent'][$x]['img'].'.jpg',
											'alt'   =>  $newsevents['newsevent'][$x]['img'],
											'class' => 'post_images',
											'width' => '200',
											'height'=> '200',
											'title' => $newsevents['newsevent'][$x]['img'],
											'rel'   => $newsevents['newsevent'][$x]['img']
											);

										echo "<td>".img($image_properties)."</td>";	
										echo "<td id='type".$newsevents['newsevent'][$x]['id']."'>".$newsevents['newsevent'][$x]['type']."</td>";	
										echo "<td id='title".$newsevents['newsevent'][$x]['id']."'>".$newsevents['newsevent'][$x]['title']."</td>";	
										echo "<td id='date".$newsevents['newsevent'][$x]['id']."'>".$newsevents['newsevent'][$x]['from']." - ".$newsevents['newsevent'][$x]['to']."</td>";	
										echo "<td id='location".$newsevents['newsevent'][$x]['id']."'>".$newsevents['newsevent'][$x]['location']."</td>";

										if(is_array($newsevents['newsevent'][$x]['description'])){	
											echo "<td id='description".$newsevents['newsevent'][$x]['id']."'></td>";
										}else{
											echo "<td id='description".$newsevents['newsevent'][$x]['id']."'>".$newsevents['newsevent'][$x]['description']."</td>";
										}

										if(is_array($newsevents['newsevent'][$x]['readmore'])){	
											echo "<td id='readmore".$newsevents['newsevent'][$x]['id']."'></td>";
										}else{
											if($newsevents['newsevent'][$x]['readmore']=="No"){
												echo "<td id='readmore".$newsevents['newsevent'][$x]['id']."'></td>";
											}else{
												echo '<td><a href="#modaldocuments" id="'.$newsevents['newsevent'][$x]['id'].'" role="button" data-toggle="modal" class="tooltip-info blue" data-rel="tooltip" title="Documents" onclick="viewdocs(this.id)">
												<i class="ace-icon fa fa-file bigger-130"></i>
											</a></td>';
										}
									}

									echo "<td>
									<a class='btn btn-xs btn-info' id='".$newsevents['newsevent'][$x]['id']."' href='#editnews' role='button' data-toggle='modal' onclick='editnews(this.id)'>
										<i class='ace-icon fa fa-pencil bigger-120'></i> 
									</a>
									<a class='btn btn-xs btn-danger' id='".$newsevents['newsevent'][$x]['id']."' href='#deletenews' role='button' data-toggle='modal' onclick='deletenews(this.id)'>
										<i class='ace-icon fa fa-trash-o bigger-120'></i>
									</a>
								</td>";
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

<?php
include('footer.inc');
?>

<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>News/AddNews">
	<div id="modal-table" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="white">&times;</span>
						</button>
						Please enter new Product information below:
					</div>
				</div>

				<div class="modal-body no-padding">
					<!-- content -->
					<div class="row">
						<div class="col-sm-12">
							<div class="tabbable">
								<!-- #section:pages/faq -->
								<ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
									<li class="active">
										<a data-toggle="tab" href="#faq-tab-1">
											<i class="blue ace-icon fa fa-question-circle bigger-120"></i>
											General
										</a>
									</li>

									<li>
										<a data-toggle="tab" href="#faq-tab-2">
											<i class="red ace-icon fa fa-image bigger-120"></i>
											Image
										</a>
									</li>
								</ul>

								<!-- /section:pages/faq -->
								<div class="tab-content no-border padding-24">
									<div id="faq-tab-1" class="tab-pane fade in active">
										<div id="faq-list-1" class="panel-group accordion-style1 accordion-style2">
											<div class="widget-main">

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right hidden"> ID </label>

													<div class="col-sm-6">
														<input type="text" placeholder="<?php 
														if(empty($newsevents['newsevent'])){
															echo "0";
														}else if(!isset($newsevents['newsevent'][0])){
															echo "1";
														}else{
															echo $newsevents['newsevent'][sizeof($newsevents['newsevent'])-1]['id'] + 1;
														}
														?>" 
														value="<?php 
														if(empty($newsevents['newsevent'])){
															echo "0";
														}else if(!isset($newsevents['newsevent'][0])){
															echo "1";
														}else{
															echo $newsevents['newsevent'][sizeof($newsevents['newsevent'])-1]['id'] + 1;
														}
														?>" class="col-xs-2 col-sm-12 hidden" name="id" readonly/>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Title </label>

													<div class="col-sm-6">
														<input type="text" placeholder="" class="col-xs-2 col-sm-12" name="title" required/>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right"> Type </label>

													<div class="col-sm-6">
														
														<div class="control-group">


															<div class="radio">
																<label>
																	<input name="type" type="radio" class="ace" value="News" required/>
																	<span class="lbl"> News</span>
																</label>
																<label>
																	<input name="type" type="radio" class="ace" value="Event"/>
																	<span class="lbl"> Event</span>
																</label>
															</div>


														</div>
													</div>
												</div><!-- /.row -->

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Date </label>

													<div class='col-sm-6'>
														<div class="input-group">
															<input class="form-control" type="text" name="date-range-picker" id="id-date-range-picker" required/>

															<span class="input-group-addon">
																<i class="fa fa-calendar bigger-110"></i>
															</span>
														</div>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right"> Location </label>

													<div class="col-sm-6">
														<textarea class="form-control" id="form-field-8" name="location" required></textarea>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right"> Description </label>

													<div class="col-sm-6">
														<textarea class="form-control" id="form-field-8" name="description"></textarea>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right"></label>

													<div class="col-sm-6">
														<button class="add">Add More Fields</button>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right"> Read more </label>

													<div class="parent col-sm-6">

														<div><input type="file" placeholder="" class="col-xs-2 col-sm-12 " name="1-userfile[]"></div>
													</div>
												</div>

											</div>
										</div>
									</div>

									<div id="faq-tab-2" class="tab-pane fade">
										<div id="faq-list-2" class="panel-group accordion-style1 accordion-style2">
											<div class="form-group">

												<div class="form-group">
													

													<label class="col-sm-3 control-label no-padding-right"> Image </label>

													<div class="col-sm-6">
														<input type="file" placeholder="" id="id-input-file-2" name="userfile" />
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
															<img id="preview" src="uploads/newsevents/-1.jpg" class="crop"/>
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
			</div><!-- /.col -->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</form>

<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>News/EditNews">
	<div id="editnews" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="white">&times;</span>
						</button>
						Please enter new Product information below:
					</div>
				</div>

				<div class="modal-body no-padding">
					<!-- content -->
					<div class="row">
						<div class="col-sm-12">
							<div class="tabbable">
								<!-- #section:pages/faq -->
								<ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
									<li class="active">
										<a data-toggle="tab" href="#faq-tab-3">
											<i class="blue ace-icon fa fa-question-circle bigger-120"></i>
											General
										</a>
									</li>

									<li>
										<a data-toggle="tab" href="#faq-tab-4">
											<i class="red ace-icon fa fa-image bigger-120"></i>
											Image
										</a>
									</li>
								</ul>

								<!-- /section:pages/faq -->
								<div class="tab-content no-border padding-24">
									<div id="faq-tab-3" class="tab-pane fade in active">
										<div id="faq-list-3" class="panel-group accordion-style1 accordion-style2">
											<div class="widget-main">

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right hidden"> ID </label>

													<div class="col-sm-6 hidden">
														<input type="text" placeholder="" class="col-xs-2 col-sm-12" name="nid" id="nid" readonly/>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Title </label>

													<div class="col-sm-6">
														<input type="text" placeholder="" class="col-xs-2 col-sm-12" name="ntitle" id="ntitle" required/>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right"> Type </label>

													<div class="col-sm-6">
														
														<div class="control-group">


															<div class="radio" >
																<label>
																	<input type="radio" class="ace" name="ntype" id="News" value="News" required/>
																	<span class="lbl"> News</span>
																</label>
																<label>
																	<input type="radio" class="ace" name="ntype" id="Event" value="Event"/>
																	<span class="lbl"> Event</span>
																</label>
															</div>


														</div>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Date </label>

													<div class='col-sm-6'>
														<div class="input-group">
															<input class="form-control" type="text" name="date-range-picker-1" id="id-date-range-picker-1" required/>

															<span class="input-group-addon">
																<i class="fa fa-calendar bigger-110"></i>
															</span>
														</div>


													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right"> Location </label>

													<div class="col-sm-6">
														<textarea class="form-control" name="nlocation" id="nlocation" required></textarea>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right"> Description </label>

													<div class="col-sm-6">
														<textarea class="form-control" name="ndescription" id="ndescription"></textarea>
													</div>
												</div>

											</div>
										</div>
									</div>

									<div id="faq-tab-4" class="tab-pane fade">
										<div id="faq-list-4" class="panel-group accordion-style1 accordion-style2">
											<div class="form-group">

												<div class="form-group">
													

													<label class="col-sm-3 control-label no-padding-right"> Image </label>

													<div class="col-sm-6">
														<input type="file" placeholder="" id="id-input-file-2" name="userfile1" />
														<input type="text" placeholder="<?php 
														if(empty($banners['banner'])){
															echo "0";
														}else if(!isset($banners['banner'][0])){
															echo "1";
														}else{
															echo $banners['banner'][sizeof($banners['banner'])-1]['id'] + 1;
														}
														?>" 
														value="<?php 
														if(empty($banners['banner'])){
															echo "0";
														}else if(!isset($banners['banner'][0])){
															echo "1";
														}else{
															echo $banners['banner'][sizeof($banners['banner'])-1]['id'] + 1;
														}
														?>" name="id" class="hidden" />
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
															<img id="preview1" src="uploads/newsevents/-1.jpg" class="crop"/>
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
			</div><!-- /.col -->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</form>

<div id="deletenews" class="modal fade" tabindex="-1">
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

			<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>News/DeleteNews">
				<div class="modal-body no-padding">
					<!-- content -->
					<div class="row">
						<div class="col-sm-12">

							<div class="widget-body">
								<div class="widget-main">
									<span>Are you sure do you want to delete: </span><span id='dntext' name="dntext"></span>
									<input type="text" class="hidden" id="dnid" name="dnid" />
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

<div id="modaldocuments" class="modal fade" tabindex="-1">
	<form action="news/EditAttachments" method="POST" enctype="multipart/form-data">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="white">&times;</span>
						</button>
						Modal View  
						<a href="#" data-action="reload" class="red" id="changethis3" value="" onclick="loadXMLDoc(this.value)">
							<i class="ace-icon fa fa-refresh read"></i>
						</a>
					</div>


					<div class="modal-body no-padding">
						<div id="changethis2">
							<div class="widget-body">
								<div class="widget-main no-padding">
									<fieldset>
										<div id="myDiv">caewf awef awe</div>
									</fieldset>
								</div>
							</div>
						</div>
					</div>

					<div class="modal-footer no-margin-top">
						<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right">
								Documents
							</label>

							<input type="text" class="hidden" id="dp_id2" name="dp_id2">
							<div class="col-xs-6 col-sm-6">
								<div class="clearfix">
									<div class="col-xs-12 col-sm-9">
										<input type="file" id="id-input-file-2" name="1-userfile" required/>
									</div>
									<div class="col-xs-12 col-sm-3">
										<button type="submit" name="adddocu" class="btn btn-sm btn-success">
											<i class="ace-icon fa fa-check"></i>
											Submit
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</form>
</div><!-- PAGE CONTENT ENDS -->



<script src="<?php echo $this->config->base_url(); ?>assets/js/date-time/moment.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/js/date-time/daterangepicker.js"></script>
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


			});

	$('input[name=date-range-picker]').daterangepicker({
		'applyClass' : 'btn-sm btn-success',
		'cancelClass' : 'btn-sm btn-default',
		locale: {
			applyLabel: 'Apply',
			cancelLabel: 'Cancel',
		},
		'format' : 'YYYY/MM/DD'
	}).prev().on(ace.click_event, function(){
		$(this).next().focus();
	});

	$('input[name=date-range-picker-1]').daterangepicker({
		'applyClass' : 'btn-sm btn-success',
		'cancelClass' : 'btn-sm btn-default',
		locale: {
			applyLabel: 'Apply',
			cancelLabel: 'Cancel',
		},
		'format' : 'YYYY/MM/DD'
	}).prev().on(ace.click_event, function(){
		$(this).next().focus();
	});
	</script>

	<script type="text/javascript">
	jQuery(function($){
		var oTable1 = 
		$('#newstable')
			.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
			.dataTable( {
				bAutoWidth: false,
				"aoColumns": [
				null, { "bSortable": false },
				null, 
				null, null, 
				null, null,{ "bSortable": false },
				{ "bSortable": false }, 
				],
				"aaSorting": [],
				"scrollX": true
				
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

</script>

<script>
	function editnews(clicked_id) {
		document.getElementById("nid").value = document.getElementById("id"+clicked_id).innerHTML;
		document.getElementById("ntitle").value = document.getElementById("title"+clicked_id).innerHTML;

		var type = document.getElementById("type"+clicked_id).innerHTML;
		var ntype = document.getElementById(type).checked = true;
		document.getElementById("id-date-range-picker-1").value = document.getElementById("date"+clicked_id).innerHTML;
		document.getElementById("nlocation").innerHTML = document.getElementById("location"+clicked_id).innerHTML;
		document.getElementById("ndescription").innerHTML = document.getElementById("description"+clicked_id).innerHTML;
	}
</script>

<script>
	function deletenews(clicked_id) {
		document.getElementById("dntext").innerHTML = document.getElementById("title"+clicked_id).innerHTML;
		document.getElementById("dnid").value = document.getElementById("id"+clicked_id).innerHTML;
	}
</script>

<script type="text/javascript">
	$(function() {
		$(document).ready(function() {
			var max_fields      = 10; 
			var wrapper         = $(".parent");
			var add_button      = $(".add");

			var x = 1;
			$(add_button).click(function(e){
				e.preventDefault();
				if(x < max_fields){
					x++;
					$(wrapper).append('<div><input type="file" class="col-sm-9" name="1-userfile[]"><a href="#" class="remove_field">x</a></div>');
				}
			});

			$(wrapper).on("click",".remove_field", function(e){
				e.preventDefault(); $(this).parent('div').remove(); x--;
			})
		});
	});
</script>

<script type="text/javascript">
	function viewdocs(clicked_id){
		document.getElementById("changethis3").value = clicked_id;
		document.getElementById("dp_id2").value = document.getElementById("id"+clicked_id).innerHTML;
		loadXMLDoc(clicked_id);
	}
</script>

<script type="text/javascript">
	$('form').submit(function() {
		$(this).find("button[type='submit']").prop('disabled',true);
	});
</script>