<?php
include('header.inc');
?>
<!-- /section:basics/sidebar -->
<div class="main-content">
	<script type="text/javascript">
		$(document).ready(function () {
			$('.checkbtn').click(function() {
				checked = $("input[type=checkbox]:checked").length;

				if(!checked) {
					alert("You must check at least one checkbox.");
					return false;
				}

			});
		});
	</script>

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
		  xmlhttp.open("POST","products/viewdocs",true);
		  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		  xmlhttp.send("p_id="+encodeURIComponent(el)+"&path=uploads/products/attachments/");
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
		  	xmlhttp.open("POST","products/deleteAttachments",true);
		  	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		  	xmlhttp.send("p_id="+splitname[splitname.length-2]+"&map="+splitname[splitname.length-1]+"&path=uploads/products/attachments/");
		  }
		</script>

		<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/jquery.guillotine.css" />
		<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/jquery-ui.custom.css" />

		<div class="main-content-inner">

			<!-- #section:basics/content.breadcrumbs -->
			<div class="breadcrumbs" id="breadcrumbs">
				<script type="text/javascript">
					try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
				</script>

				<ul class="breadcrumb">
					<li>
						<i class="ace-icon fa fa-list fa-3x"></i>
						&nbsp;
						<a href="<?php echo $this->config->base_url(); ?>Products"><h1>Products</h1></a>
					</li>
				</div>

				<!-- /section:basics/content.breadcrumbs -->
				<?php
					include('handlers.php');
				?>
				<div class="page-content">

					<!-- /section:settings.box -->
					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<h4 class="pink">
								<a href="#modal-table" role="button" class="green" data-toggle="modal" center><i class="ace-icon fa fa-plus blue"></i> Add Product </a>
							</h4>

							<table id="productstable" class="table table-striped table-bordered table-hover wrap">
								<thead>
									<th>ID</th>
									<th>Image</th>
									<th>Product Name</th>
									<th>Type</th>
									<th>Description</th>
									<th>Supplier</th>
									<th>Industries</th>
									<th>Stock/s</th>
									<th>Sale</th>
									<th>Attachments</th>
									<th>Action</th>
								</thead>

								<tbody>
									<?php
									$this->load->helper('html');
									function array_sort_by_column(&$array, $column, $direction = SORT_ASC) {
										$reference_array = array();

										foreach($array as $key => $row) {
										    $reference_array[$key] = strtolower($row[$column]);
									    }

										array_multisort($reference_array, $direction, $array);
									}
									array_sort_by_column($types['type'], 'name');
									array_sort_by_column($suppliers['supplier'], 'title');

									if(empty($products['product'])){

									}else if(!isset($products['product'][0])){
										$temp = $products;
										$products = array();
										$products['product'][0] = $temp['product'];
									}

									
									for($x=0; $x< sizeof($types['type']); $x++){
										$retypes[$types['type'][$x]['id']] = $types['type'][$x];
									}

									for($x=0; $x< sizeof($industries['industry']); $x++){
										$reindustries[$industries['industry'][$x]['id']] = $industries['industry'][$x];
									}

									for($x=0; $x< sizeof($suppliers['supplier']); $x++){
										$resuppliers[$suppliers['supplier'][$x]['id']] = $suppliers['supplier'][$x];
									}

									for($x=0; $x<sizeof($products['product']); $x++){
										echo "<tr>";
										echo "<td id='id".$products['product'][$x]['id']."'>".$products['product'][$x]['id']."</td>";
										$image_properties = array(
											'src'   => 'uploads\products/'.$products['product'][$x]['img'].'.jpg',
											'alt'   => $products['product'][$x]['img'],
											'class' => 'post_images',
											'width' => '200',
											'height'=> '200',
											'title' => $products['product'][$x]['img'],
											'rel'   => $products['product'][$x]['img']
											);
										echo "<td>".img($image_properties)."</td>";
										echo "<td id='name".$products['product'][$x]['id']."'>".$products['product'][$x]['name']."</td>";

										if(empty($products['product'][$x]['types']['type']['id'])&&$products['product'][$x]['types']['type']['id']!=0){
											echo "<td><input type='hidden' id='types".$products['product'][$x]['id']."' value='0'><p class='red'>Unknown value</p></td>";
										}else{
											echo "<td><input type='hidden' id='types".$products['product'][$x]['id']."' value='".$products['product'][$x]['types']['type']['id']."'>".$retypes[$products['product'][$x]['types']['type']['id']]['short']."</td>";
										}

										if(empty($products['product'][$x]['description'])){
											echo "<td id='description".$products['product'][$x]['id']."'>N/A</td>";
										}else{
											echo "<td id='description".$products['product'][$x]['id']."'>".$products['product'][$x]['description']."</td>";
										}
										
										if(empty($products['product'][$x]['supplier'])){
											echo "<td><input type='hidden' id='suppliers".$products['product'][$x]['id']."' value='0'><p class='red'>Unknown value</p></td>";
										}else{
											echo "<td><input type='hidden' id='suppliers".$products['product'][$x]['id']."' value='".$products['product'][$x]['supplier']."'>".$resuppliers[$products['product'][$x]['supplier']]['title']."</td>";
										}

										echo '<td><center><a href="#industries'.$products['product'][$x]['id'].'" role="button" class="green" data-toggle="modal" center><i class="ace-icon fa fa-search blue"></i></a></center></td>';

										$size = sizeof($products['product'][$x]['industries']['industry']);

										if($size==1){
											echo "<input type='text' class='hidden' name='industry".$products['product'][$x]['id']."' value=".$products['product'][$x]['industries']['industry']['id'].">";
										}else if($size==0){
											echo "";
										}else{
											for($z=0; $z<sizeof($products['product'][$x]['industries']['industry']); $z++){
												echo "<input type='text' class='hidden' name='industry".$products['product'][$x]['id']."' value=".$products['product'][$x]['industries']['industry'][$z]['id'].">";
											}
										}
										
										if(empty($products['product'][$x]['stock'])){
											echo "<td id='stocks".$products['product'][$x]['id']."'>N/A</td>";
										}else{
											echo "<td id='stocks".$products['product'][$x]['id']."'>".$products['product'][$x]['stock']."</td>";
										}

										if(empty($products['product'][$x]['sale'])){
											echo "<td id='sales".$products['product'][$x]['id']."'>N/A</td>";
										}else{
											echo "<td id='sales".$products['product'][$x]['id']."'>".$products['product'][$x]['sale']."</td>";
										}
										echo '<td><a href="#modaldocuments" id="'.$products['product'][$x]['id'].'" role="button" data-toggle="modal" class="tooltip-info blue" data-rel="tooltip" title="Documents" onclick="viewdocs(this.id)">
										<i class="ace-icon fa fa-file bigger-130"></i>
									</a></td>';
									echo "<td>
									<a class='btn btn-xs btn-info' id='".$products['product'][$x]['id']."' href='#modal-table-8' role='button' value='check all' data-toggle='modal' onclick='editproducts(this.id)'>
										<i class='ace-icon fa fa-pencil bigger-120'></i> 
									</a>
									<a class='btn btn-danger btn-xs' id='".$products['product'][$x]['id']."' href='#modal-table-7' role='button' data-toggle='modal' onclick='deleteproduct(this.id)'>
										<i class='ace-icon fa fa-trash-o bigger-120'></i>
									</a></td>";
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

	<!--Add modal-->
	<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Products/AddProduct">
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
												<i class="green ace-icon fa fa-globe bigger-120"></i>
												Industries
											</a>
										</li>

										<li>
											<a data-toggle="tab" href="#faq-tab-3">
												<i class="orange ace-icon fa fa-briefcase bigger-120"></i>
												Attachments
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
										<div id="faq-tab-1" class="tab-pane fade in active">
											<div id="faq-list-1" class="panel-group accordion-style1 accordion-style2">
												<div class="widget-main">

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> ID </label>

														<div class="col-sm-6">
															<input type="text" placeholder="<?php 
															if(empty($products['product'])){
																echo "0";
															}else if(!isset($products['product'][0])){
																echo "1";
															}else{
																echo $products['product'][sizeof($products['product'])-1]['id'] + 1;
															}
															?>" 
															value="<?php 
															if(empty($products['product'])){
																echo "0";
															}else if(!isset($products['product'][0])){
																echo "1";
															}else{
																echo $products['product'][sizeof($products['product'])-1]['id'] + 1;
															}
															?>" class="col-xs-2 col-sm-12" name="id" readonly/>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Product Name </label>

														<div class="col-sm-6">
															<input type="text" class="col-xs-2 col-sm-12" name="name" required/>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Type </label>

														<div class="col-sm-6">
															<div>
																<select class="form-control" name="types[]" required>
																	<?php
																	

																	

																	for($x=0; $x<sizeof($types['type']); $x++){
																		echo "<option value='".$types['type'][$x]['id']."'>".$types['type'][$x]['name']."</option>";
																	}
																	?>
																</select>
															</div>
														</div>
													</div>

													<div class="form-group">
														<center> <label>Description </label></center>

														<div class="col-sm-12">
															<div class="wysiwyg-editor" id="editor1" ></div>
															<textarea class="hidden" id="hidden-editor" name="description"></textarea>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Supplier </label>

														<div class="col-sm-6">
															<div>
																<select class="form-control" name="supplier" id="suppliercheckbox" required>
																	<?php
																	

																	for($x=0; $x<sizeof($suppliers['supplier']); $x++){
																		echo "<option value='".$suppliers['supplier'][$x]['id']."'>".$suppliers['supplier'][$x]['title']."</option>";
																	}
																	?>
																</select>
															</div>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Sale</label>
														<div class="col-sm-6">
															<div class="control-group">
																<input type="text" class="col-xs-2 col-sm-12" name="sale"/>
															</div>
														</div>
													</div><!-- /.row -->

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" > Stock </label>
														<div class="col-sm-6">
															<input type="text" class="col-xs-2 col-sm-12" name="stock"/>
														</div>
													</div><!-- /.row -->
													
												</div>
											</div>
										</div>

										<div id="faq-tab-2" class="tab-pane fade">
											<div id="faq-list-2" class="panel-group accordion-style1 accordion-style2">
												
												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3">Industries</label>

													<div class="controls col-xs-12 col-sm-9">
														<!-- #section:custom/checkbox.switch -->
														<div class="row">
															<div class="checkbox">
																
																<?php
																for($x=0; $x<sizeof($industries['industry']); $x++){
																	echo '
																	<div><label>
																		<input name="industries[]" type="checkbox" class="ace" value="'.$industries['industry'][$x]['id'].'"/>
																		<span class="lbl"> '.$industries['industry'][$x]['title'].'</span>
																	</label></div>';
																}
																?>

															</div>

														</div>
													</div>

													<!-- /section:custom/checkbox.switch -->
												</div>
											</div>
										</div>

										<div id="faq-tab-3" class="tab-pane fade">
											<div id="faq-list-3" class="panel-group accordion-style1 accordion-style2">
												<div class="form-group">
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

										<div id="faq-tab-4" class="tab-pane fade">
											<div id="faq-list-4" class="panel-group accordion-style1 accordion-style2">
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
																<img id="preview" src="uploads/products/-1.jpg" class="crop"/>
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
							<button class="btn btn-info checkbtn" id="submit-btn" type="submit">
								<i class="ace-icon fa fa-check bigger-110"></i>
								Submit
							</button>
							&nbsp; &nbsp; &nbsp;
							<button class="btn btn-default" data-dismiss="modal">
								<i class="ace-icon fa fa-remove bigger-110"></i>
								Cancel
							</button>
						</center>
					</div>
				</div><!-- /.col -->
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</form>
	<!--Edit modal-->
	<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Products/EditProduct">
		<div id="modal-table-8" class="modal fade" tabindex="-1">
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
											<a data-toggle="tab" href="#faq-tab-5">
												<i class="blue ace-icon fa fa-question-circle bigger-120"></i>
												General
											</a>
										</li>

										<li>
											<a data-toggle="tab" href="#faq-tab-6">
												<i class="green ace-icon fa fa-globe bigger-120"></i>
												Industries
											</a>
										</li>

										<li>
											<a data-toggle="tab" href="#faq-tab-7">
												<i class="orange ace-icon fa fa-briefcase bigger-120"></i>
												Attachments
											</a>
										</li>

										<li>
											<a data-toggle="tab" href="#faq-tab-8">
												<i class="red ace-icon fa fa-image bigger-120"></i>
												Image
											</a>
										</li>
									</ul>

									<!-- /section:pages/faq -->
									<div class="tab-content no-border padding-24">
										<div id="faq-tab-5" class="tab-pane fade in active">
											<div id="faq-list-5" class="panel-group accordion-style1 accordion-style2">
												<div class="widget-main">

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right hidden"> ID </label>

														<div class="col-sm-6">
															<input type="text" class="col-xs-2 col-sm-12 hidden" name="eid" id="eid" readonly/>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Product Name </label>

														<div class="col-sm-6">
															<input type="text" class="col-xs-2 col-sm-12" name="ename" id="ename" required/>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Type </label>

														<div class="col-sm-6">
															
																<select class="form-control" name="etypes" id="etypes" required>
																	<?php
																	for($x=0; $x<sizeof($types['type']); $x++){
																		echo "<option value='".$types['type'][$x]['id']."'>".$types['type'][$x]['name']."</option>";
																	}
																	?>
																</select>
															
														</div>
													</div>

													<div class="form-group">
														<center> <label>Description </label></center>

														<div class="col-sm-12">
															<div class="wysiwyg-editor" id="editor2" ></div>
															<textarea class="hidden" id="hidden-editor2" name="edescription"></textarea>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Supplier </label>

														<div class="col-sm-6">
															
																<select class="form-control" name="esuppliers" id="esuppliers" required>
																	<?php

																	for($x=0; $x<sizeof($suppliers['supplier']); $x++){
																		echo "<option value='".$suppliers['supplier'][$x]['id']."'>".$suppliers['supplier'][$x]['title']."</option>";
																	}
																	?>
																</select>
															
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Sale</label>
														<div class="col-sm-6">
															<div class="control-group">
																<input type="text" class="col-xs-2 col-sm-12" name="esale" id="esale"/>
															</div>
														</div>
													</div><!-- /.row -->

													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" > Stock </label>
														<div class="col-sm-6">
															<input type="text" class="col-xs-2 col-sm-12" name="estock" id="estocks"/>
														</div>
													</div><!-- /.row -->

												</div>
											</div>
										</div>

										<div id="faq-tab-6" class="tab-pane fade">
											<div id="faq-list-6" class="panel-group accordion-style1 accordion-style2">

												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3">Industries</label>

													<div class="controls col-xs-12 col-sm-9">
														<!-- #section:custom/checkbox.switch -->
														<div class="row">
															<div class="checkbox">

																<?php
																for($x=0; $x<sizeof($industries['industry']); $x++){
																	echo '
																	<div><label>
																		<input id="eindustries" name="eindustries[]" type="checkbox" class="ace" value="'.$industries['industry'][$x]['id'].'"/>
																		<span class="lbl"> '.$industries['industry'][$x]['title'].'</span>
																	</label></div>';
																}
																?>

															</div>
														</div>

														<!-- /section:custom/checkbox.switch -->
													</div>
												</div>
											</div>
										</div>

										<div id="faq-tab-7" class="tab-pane fade">
											<div id="faq-list-7" class="panel-group accordion-style1 accordion-style2">
												<div class="form-group">
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

										<div id="faq-tab-8" class="tab-pane fade">
											<div id="faq-list-8" class="panel-group accordion-style1 accordion-style2">
												<div class="form-group">
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right"> Image </label>

														<div class="col-sm-6">
															<input type="file" placeholder="" id="id-input-file-2" name="userfile1" />
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
																<img id="preview1" src="uploads/products/-1.jpg" class="crop"/>
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
					</div><!-- /.col -->


					<div class="modal-footer no-margin-top">

						<center>
							<button class="btn btn-info checkbtn" id="submit-btn1" type="submit">
								<i class="ace-icon fa fa-check bigger-110"></i>
								Submit
							</button>
							&nbsp; &nbsp; &nbsp;
							<button class="btn btn-default" data-dismiss="modal">
								<i class="ace-icon fa fa-remove bigger-110"></i>
								Cancel
							</button>
						</center>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
	</form>
	<?php

	for($x=0; $x<sizeof($products['product']); $x++){
		?>
		<div id="industries<?=$products['product'][$x]['id']?>" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header no-padding">
						<div class="table-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								<span class="white">&times;</span>
							</button>
							Industries
						</div>
					</div>

					<div class="modal-body no-padding">
						<!-- content -->
						<table class="table table-striped" id='industrytable<?=$products['product'][$x]['id']?>'>
							<thead>
								<!--<th>Image</th>-->
								<th>Title</th>
							</thead>
							<tbody>
								<?php
								$size = sizeof($products['product'][$x]['industries']['industry']);
								if($size==1){
									echo "<tr>";
									echo "<td>".$reindustries[$products['product'][$x]['industries']['industry']['id']]['title']."</td>";
									echo "</tr>";
									//echo "<input type='text' class='hidden' name='industry".$products['product'][$x]['id']."' value=".$products['product'][$x]['industries']['industry']['id'].">";
								}else if($size==0){
									echo "<tr>";
									echo "<td></td>";
									echo "</tr>";
								}else{
									for($z=0; $z<sizeof($products['product'][$x]['industries']['industry']); $z++){
										echo "<tr>";
										echo "<td>".$reindustries[$products['product'][$x]['industries']['industry'][$z]['id']]['title']."</td>";
										echo "</tr>";
										//echo "<input type='text' class='hidden' name='industry".$products['product'][$x]['id']."' value=".$products['product'][$x]['industries']['industry'][$z]['id'].">";
									}
								}
								//if(!isset($products['product'][$x]['industries']['industry'][0])){
								//	$products['product'][$x]['industries']['industry'][0] = $products['product'][$x]['industries']['industry'];

								//}
								//for($y=0; $y<sizeof($products['product'][$x]['industries']['industry']); $y++){	
								//	echo "<tr>";
								//	echo "<td>".$products['product'][$x]['industries']['industry'][$y]['id']."</td>";
								//			//echo "<td>".$reindustries[$products['product'][$x]['id']]['img']."</td>";
								//	echo "<td>".$reindustries[$products['product'][$x]['industries']['industry'][$y]['id']]['title']."</td>";
								//	echo "</tr>";
								//}
								
								

								?>
							</tbody>
						</table>
					</div><!-- /.col -->
				</div>
			</div>
		</div>
		<?php
	}
	?>

	<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Products/DeleteProduct">
		<div id="modal-table-7" class="modal fade" tabindex="-1">
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
											<span>Do you want to delete ID: </span><span id='dptext' name="dptext"></span>
											<input type="text" class="hidden" id="dpid" name="dpid" />
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

	<div id="modaldocuments" class="modal fade" tabindex="-1">
		<form action="Products/EditAttachments" method="POST" enctype="multipart/form-data">
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
											<div id="myDiv">Loading document please wait</div>
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


	<script type="text/javascript">
		window.jQuery || document.write("<script src='<?php echo $this->config->base_url(); ?>assets/js/jquery.js'>"+"<"+"/script>");
	</script>

	<script src="<?php echo $this->config->base_url(); ?>assets/js/jquery.guillotine.js"></script>

	<script src="<?php echo $this->config->base_url(); ?>assets/js/bootstrap-wysiwyg.js"></script>
	<script src="<?php echo $this->config->base_url(); ?>assets/js/jquery.hotkeys.js"></script>
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
				thumbnail:false
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
				       	//auto fit
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

<script type="text/javascript">
	jQuery(function($){

		function showErrorAlert (reason, detail) {
			var msg='';
			if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
			else {
			//console.log("error uploading file", reason, detail);
		}
		$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
			'<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
	}

	//$('#editor1').ace_wysiwyg();//this will create the default editor will all buttons

	//but we want to change a few buttons colors for the third style
	$('#editor1').ace_wysiwyg({
		toolbar:
		[
		'font',
		null,
		'fontSize',
		null,
		{name:'bold', className:'btn-info'},
		{name:'italic', className:'btn-info'},
		{name:'strikethrough', className:'btn-info'},
		{name:'underline', className:'btn-info'},
		null,
		{name:'insertunorderedlist', className:'btn-success'},
		{name:'insertorderedlist', className:'btn-success'},
		{name:'outdent', className:'btn-purple'},
		{name:'indent', className:'btn-purple'},
		null,
		{name:'justifyleft', className:'btn-primary'},
		{name:'justifycenter', className:'btn-primary'},
		{name:'justifyright', className:'btn-primary'},
		{name:'justifyfull', className:'btn-inverse'},
		null,
		{name:'undo', className:'btn-grey'},
		{name:'redo', className:'btn-grey'}
		],
		'wysiwyg': {
			fileUploadError: showErrorAlert
		}
	}).prev().addClass('wysiwyg-style2');

	$('#editor2').ace_wysiwyg({
		toolbar:
		[
		'font',
		null,
		'fontSize',
		null,
		{name:'bold', className:'btn-info'},
		{name:'italic', className:'btn-info'},
		{name:'strikethrough', className:'btn-info'},
		{name:'underline', className:'btn-info'},
		null,
		{name:'insertunorderedlist', className:'btn-success'},
		{name:'insertorderedlist', className:'btn-success'},
		{name:'outdent', className:'btn-purple'},
		{name:'indent', className:'btn-purple'},
		null,
		{name:'justifyleft', className:'btn-primary'},
		{name:'justifycenter', className:'btn-primary'},
		{name:'justifyright', className:'btn-primary'},
		{name:'justifyfull', className:'btn-inverse'},
		null,
		{name:'undo', className:'btn-grey'},
		{name:'redo', className:'btn-grey'}
		],
		'wysiwyg': {
			fileUploadError: showErrorAlert
		}
	}).prev().addClass('wysiwyg-style2');

	
	/**
	//make the editor have all the available height
	$(window).on('resize.editor', function() {
		var offset = $('#editor1').parent().offset();
		var winHeight =  $(this).height();
		
		$('#editor1').css({'height':winHeight - offset.top - 10, 'max-height': 'none'});
	}).triggerHandler('resize.editor');
*/


$('[data-toggle="buttons"] .btn').on('click', function(e){
	var target = $(this).find('input[type=radio]');
	var which = parseInt(target.val());
	var toolbar = $('#editor1').prev().get(0);
	if(which >= 1 && which <= 4) {
		toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g , '');
		if(which == 1) $(toolbar).addClass('wysiwyg-style1');
		else if(which == 2) $(toolbar).addClass('wysiwyg-style2');
		if(which == 4) {
			$(toolbar).find('.btn-group > .btn').addClass('btn-white btn-round');
		} else $(toolbar).find('.btn-group > .btn-white').removeClass('btn-white btn-round');
	}
});




	//RESIZE IMAGE
	
	//Add Image Resize Functionality to Chrome and Safari
	//webkit browsers don't have image resize functionality when content is editable
	//so let's add something using jQuery UI resizable
	//another option would be opening a dialog for user to enter dimensions.
	if ( typeof jQuery.ui !== 'undefined' && ace.vars['webkit'] ) {
		
		var lastResizableImg = null;
		function destroyResizable() {
			if(lastResizableImg == null) return;
			lastResizableImg.resizable( "destroy" );
			lastResizableImg.removeData('resizable');
			lastResizableImg = null;
		}

		var enableImageResize = function() {
			$('.wysiwyg-editor')
			.on('mousedown', function(e) {
				var target = $(e.target);
				if( e.target instanceof HTMLImageElement ) {
					if( !target.data('resizable') ) {
						target.resizable({
							aspectRatio: e.target.width / e.target.height,
						});
						target.data('resizable', true);
						
						if( lastResizableImg != null ) {
							//disable previous resizable image
							lastResizableImg.resizable( "destroy" );
							lastResizableImg.removeData('resizable');
						}
						lastResizableImg = target;
					}
				}
			})
			.on('click', function(e) {
				if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
					destroyResizable();
				}
			})
			.on('keydown', function() {
				destroyResizable();
			});
		}

		enableImageResize();

		/**
		//or we can load the jQuery UI dynamically only if needed
		if (typeof jQuery.ui !== 'undefined') enableImageResize();
		else {//load jQuery UI if not loaded
			//in Ace demo ../assets will be replaced by correct assets path
			$.getScript("../assets/js/jquery-ui.custom.min.js", function(data, textStatus, jqxhr) {
				enableImageResize()
			});
		}
		*/
	}

	$('#submit-btn').click(function(){
		$('#hidden-editor').html(
			$("#editor1").html()
			);
	});

	$('#submit-btn1').click(function(){
		$('#hidden-editor2').html(
			$("#editor2").html()
			);
	});

});
</script>

<script>
	function editproducts(clicked_id) {

		document.getElementById("eid").value = document.getElementById("id"+clicked_id).innerHTML;
		document.getElementById("ename").value = document.getElementById("name"+clicked_id).innerHTML;
		document.getElementById("etypes").value = document.getElementById("types"+clicked_id).value;
		document.getElementById("editor2").innerHTML = document.getElementById("description"+clicked_id).innerHTML;
		document.getElementById("esuppliers").value = document.getElementById("suppliers"+clicked_id).value;
		document.getElementById("esale").value = document.getElementById("sales"+clicked_id).innerHTML;
		document.getElementById("estocks").value = document.getElementById("stocks"+clicked_id).innerHTML;
		
		var e = document.getElementsByName("eindustries[]");
		var p = document.getElementsByName("industry"+clicked_id);

		for (var i=0; i<e.length; i++){
		    e[i].checked = false;
		}
		
		x=0;
		for (i = 0; i < e.length; i++) { 
			if(p[x].value == e[i].value){
				e[i].checked = true;
				x++;
			}else{
				e[i].checked = false;
			}
		}
	}
</script>

<script type="text/javascript">
	$(document).ready(function(){
	    $('.check:button').toggle(function(){
	        $('input:checkbox').attr('checked','checked');
	        $(this).val('uncheck all')
	    },function(){
	        $('input:checkbox').removeAttr('checked');
	        $(this).val('check all');        
	    })
	})
</script>

<script>
	function deleteproduct(clicked_id) {
		document.getElementById("dptext").innerHTML = document.getElementById("name"+clicked_id).innerHTML;
		document.getElementById("dpid").value = document.getElementById("id"+clicked_id).innerHTML;
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
	jQuery(function($){
		var oTable1 = 
		$('#productstable')
			.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
			.dataTable( {
				bAutoWidth: false,
				"aoColumns": [
				null, { "bSortable": false },
				null, null, 
				null, null, 
				null, null,
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

<script type="text/javascript">
	function viewdocs(clicked_id){
		document.getElementById("changethis3").value = clicked_id;
		document.getElementById("dp_id2").value = document.getElementById("id"+clicked_id).innerHTML;
		loadXMLDoc(clicked_id);
	}
</script>

