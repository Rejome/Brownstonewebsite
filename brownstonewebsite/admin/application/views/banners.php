<?php
include('header.inc');
?>
<div class="main-content">
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/colorbox.css" />
	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/jquery.guillotine.css" />

	<script>
		function loadXMLDoc(el){
			var xmlhttp;
			var selectIndex=el.selectedIndex;
   			var selectValue=el.options[selectIndex].text;
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
		  	xmlhttp.open("POST","banners/bannerdocs",true);
		  	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		  	xmlhttp.send("category="+encodeURIComponent(selectValue));
		}
	</script>

	<script>
		function loadXMLDoce(el){
			var xmlhttp;
			var selectIndex=el.selectedIndex;
   			var selectValue=el.options[selectIndex].text;
			if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		  		xmlhttp=new XMLHttpRequest();
		  	}else{// code for IE6, IE5
		  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  	}
		  	xmlhttp.onreadystatechange=function(){
		  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		  			document.getElementById("emyDiv").innerHTML=xmlhttp.responseText;
		  		}
		  	}
		  	xmlhttp.open("POST","banners/bannerdocsedit",true);
		  	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		  	xmlhttp.send("category="+encodeURIComponent(selectValue));
		}
	</script>

	<div class="main-content-inner">
		<!-- #section:basics/content.breadcrumbs -->
		<div class="breadcrumbs" id="breadcrumbs">
			<script type="text/javascript">
				try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
			</script>
			<ul class="breadcrumb">
				<li>
					<i class="glyphicon glyphicon-picture fa-3x"></i>
					&nbsp;
					<a href="<?php echo $this->config->base_url(); ?>Banners"><h1>Banner Manager</h1></a>
				</li>
			</ul>
		</div>
		<!-- /section:settings.box -->
		<div class="page-content">
			<?php
				include('handlers.php');
			?>

			<div class="col-sm-12">
				<h4 class="pink">
					<a href="#modal-table" role="button" class="green" data-toggle="modal" center><i class="ace-icon fa fa-plus blue"></i> Add Product </a>
				</h4>
			</div>

			<div class="col-sm-12">
				
				<ul class="ace-thumbnails clearfix">
					<?php
					$this->load->helper('html');
					if(empty($banners['banner'])){

					}else if(!isset($banners['banner'][0])){
						$temp = $banners;
						$banners = array();
						$banners['banner'][0] = $temp['banner'];
					}
						for($x = 0; $x<sizeof($banners['banner']); $x++){
							?>
							<li>
								<a href="<?php echo $this->config->base_url(); ?>uploads/banners/<?= $banners['banner'][$x]['id']?>.jpg" data-rel="colorbox">
									<img width="300" height="150" alt="150x150" src="<?php echo $this->config->base_url(); ?>uploads/banners/<?= $banners['banner'][$x]['id']?>.jpg" />
									<div class="text">
										<div class="inner" ><?=$banners['banner'][$x]['banner']?></div>
										<input type="hidden" id="id<?php echo $banners['banner'][$x]['id'] ?>" value="<?php echo $banners['banner'][$x]['id'] ?>"/>
									</div>
									<input type="hidden" id="banner<?=$banners['banner'][$x]['id']?>" value="<?=$banners['banner'][$x]['banner']?>">
									<input type="hidden" id="category<?=$banners['banner'][$x]['id']?>" value="<?=$banners['banner'][$x]['category']?>">
									<input type="hidden" id="cid<?=$banners['banner'][$x]['id']?>" value="<?=$banners['banner'][$x]['cid']?>">
								</a>

								<div class="tools tools-bottom">
									<a id="<?php echo $banners['banner'][$x]['id'];?>" href="#edit" role='button' data-toggle='modal' onclick="edit(this.id)">
										<i class="ace-icon fa fa-pencil"></i>
									</a>
									<a id="<?php echo $banners['banner'][$x]['id'];?>" href="#delete" role='button' data-toggle='modal' onclick='delete1(this.id)'>
										<i class="ace-icon fa fa-times red"></i>
									</a>
								</div>
							</li>
							<?php
						}
					
					?>
				</ul>
			</div>
		</div><!-- /.page-header -->
		<!-- /section:basics/content.breadcrumbs -->
		<div class="row">
			<div class="col-xs-12">
				<div class="page-content">
					<div>

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
<script src="<?php echo $this->config->base_url(); ?>assets/js/jquery.guillotine.js"></script>

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
<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Banners/AddBanner">
	<div id="modal-table" class="modal fade" tabindex="-1" >
		<div class="modal-dialog" style="width:1200px">
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
										<label class="col-sm-3 control-label no-padding-right"> Banner name </label>

										<div class="col-sm-6">
											<input type="text" placeholder="" class="col-xs-12 col-sm-12" name="banner" required/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Category </label>

										<div class="col-sm-6">
											<select name='category' onchange="loadXMLDoc(this)">
												<option value='Banner'>Banner</option>
												<?php
													if($access['products']==1){
												?>
												<option value='Products'>Products</option>
												<?php
													}
													if($access['news']==1){
												?>
												<option value='News and Events'>News and Events</option>
												<?php
													}
													if($access['types']==1){
												?>
												<option value='Types'>Types</option>
												<?php
													}
													if($access['suppliers']==1){
												?>
												<option value='Suppliers'>Suppliers</option>
												<?php
													}
													if($access['industries']==1){
												?>
												<option value='Industries'>Industries</option>
												<?php
													}
													if($access['careers']==1){
												?>
												<option value='Career'>Career</option>
												<?php
													}
												?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> </label>

										<div class="col-sm-6">
											<?php
											echo "<div id='myDiv'>";
											echo "<input type='text' name='cid' value='all' readonly>";
											echo "</div>";
											?>
										</div>
									</div>



									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Image </label>

										<div class="col-sm-6">
											<input type="file" placeholder="" id="id-input-file-2" name="userfile" required/>
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
											<input type="hidden" id="x" name="x" />
								            <input type="hidden" id="y" name="y" />
								            <input type="hidden" id="w" name="w" />
								            <input type="hidden" id="h" name="h" />
								            <input type="hidden" id="scale" name="scale" />
								            <input type="hidden" id="angle" name="angle" />
								            <div style="width:1000px">
								            	<img id="preview" src="#" class="crop"/>
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

<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Banners/EditBanner">
	<div id="edit" class="modal fade" tabindex="-1">
		<div class="modal-dialog" style="width:1200px">
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

									<div class="form-group hidden">
										<label class="col-sm-3 control-label no-padding-right"> ID </label>

										<div class="col-sm-6">
											<input type="text" placeholder="" class="col-xs-12 col-sm-12" name="eid" id="eid" required/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Banner name </label>

										<div class="col-sm-6">
											<input type="text" placeholder="" class="col-xs-12 col-sm-12" name="ebanner" id="ebanner" required/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Category </label>

										<div class="col-sm-6">
											<select name='ecategory' id="ecategory" onchange="loadXMLDoce(this)">
												<option value='Banner'>Banner</option>
												<?php
													if($access['products']==1){
												?>
												<option value='Products'>Products</option>
												<?php
													}
													if($access['news']==1){
												?>
												<option value='News and Events'>News and Events</option>
												<?php
													}
													if($access['types']==1){
												?>
												<option value='Types'>Types</option>
												<?php
													}
													if($access['suppliers']==1){
												?>
												<option value='Suppliers'>Suppliers</option>
												<?php
													}
													if($access['industries']==1){
												?>
														<option value='Industries'>Industries</option>
												<?php
													}
													if($access['careers']==1){
												?>
													<option value='Career'>Career</option>
												<?php
													}
												?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> </label>

										<div class="col-sm-6">
											<?php
											echo "<div id='emyDiv'>";
												echo "<select>";
													echo "<option type='text' name='ecid' id='ecid' readonly>";
												echo "</select>";
												
											echo "</div>";
											?>
										</div>
									</div>


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
								            <div style="width:1000px">
								            	<img id="preview1" src="#" class="crop"/>
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
			<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Banners/DeleteBanner">
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



<script>
	function edit(clicked_id) {
		document.getElementById("eid").value = document.getElementById("id"+clicked_id).value;
		document.getElementById("ebanner").value = document.getElementById("banner"+clicked_id).value;
		document.getElementById("ecategory").value = document.getElementById("category"+clicked_id).value;
		loadXMLDocev2(document.getElementById("category"+clicked_id).value,document.getElementById("cid"+clicked_id).value);
	}
</script>


<script>
		function loadXMLDocev2(el,le){
			var xmlhttp;;
			if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		  		xmlhttp=new XMLHttpRequest();
		  	}else{// code for IE6, IE5
		  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  	}
		  	xmlhttp.onreadystatechange=function(){
		  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
		  			document.getElementById("emyDiv").innerHTML=xmlhttp.responseText;
		  		}
		  	}
		  	xmlhttp.open("POST","banners/bannerdocsedit",true);
		  	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		  	xmlhttp.send("category="+el+"&cid="+le);
		}
	</script>

<script>
	function delete1(clicked_id) {
		document.getElementById("ddtext").innerHTML = document.getElementById("banner"+clicked_id).value;
		document.getElementById("ddid").value = document.getElementById("id"+clicked_id).value;
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
		readURL(this,'',1001,501);
	});

	$("input[name=userfile1]").change(function(){
		console.log(this);
		readURL(this,'1',1001,501);
	});

</script>

<script type="text/javascript">
	$('form').submit(function() {
		$(this).find("button[type='submit']").prop('disabled',true);
	});
</script>