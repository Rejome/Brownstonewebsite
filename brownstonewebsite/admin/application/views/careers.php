<?php
include('header.inc');

?>

<!-- /section:basics/sidebar -->
<div class="main-content">

	<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/css/jquery-ui.custom.css" />


	<div class="main-content-inner">
		<!-- #section:basics/content.breadcrumbs -->
		<div class="breadcrumbs" id="breadcrumbs">
			<script type="text/javascript">
				try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
			</script>

			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-briefcase fa-3x"></i>
					&nbsp;
					<a href="<?php echo $this->config->base_url(); ?>Careers"><h1>Careers</h1></a>
				</li>
			</ul>
		</div>

		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">

			<!-- /section:settings.box -->
			<?php
				include('handlers.php');
			?>


			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<h4>
						<a href="#modal-table" role="button" class="green" data-toggle="modal" center><i class="ace-icon fa fa-plus blue"></i> Add Career </a>
					</h4>

					<table id="careers" class="table table-striped table-bordered table-hover">
						<thead>
							<th>ID</th>
							<th>Title</th>
							<th>Link</th>
							<th>Qualification</th>
							<th>Action</th>
						</thead>

						<tbody>
								<?php
								if(empty($careers['career'])){

								}else if(!isset($careers['career'][0])){
									$temp = $careers;
									$careers = array();
									$careers['career'][0] = $temp['career'];
								}
									for($x = 0; $x<sizeof($careers['career']); $x++){
										echo "<tr>";
										echo "<td id='cID".$careers['career'][$x]['id']."'>".$careers['career'][$x]['id']."</td>";
										echo "<td id='cTitle".$careers['career'][$x]['id']."'>".$careers['career'][$x]['title']."</td>";
										if(is_array($careers['career'][$x]['link'])){
											echo "<td ><a id='cLink".$careers['career'][$x]['id']."'></a></td>";
										}else{
											echo "<td ><a id='cLink".$careers['career'][$x]['id']."' href='http://".$careers['career'][$x]['link']."' target='_blank'>".$careers['career'][$x]['link']."</a></td>";
										}
										echo "<td id='cQualifications".$careers['career'][$x]['id']."'>".$careers['career'][$x]['description']."</td>";
										echo "<td>
										<a class='btn btn-xs btn-info' id='".$careers['career'][$x]['id']."' href='#editcareer' role='button' data-toggle='modal' onclick='editcareer(this.id)'>
											<i class='ace-icon fa fa-pencil bigger-120'></i> 
										</a>

										<a class='btn btn-xs btn-danger' id='".$careers['career'][$x]['id']."' href='#deletecareer' role='button' data-toggle='modal' onclick='deletecareer(this.id)'>
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


<script src="<?php echo $this->config->base_url(); ?>assets/js/bootstrap-wysiwyg.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/js/jquery.hotkeys.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo $this->config->base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>

<form class="form-horizontal" role="form" method="POST" action="<?php echo $this->config->base_url(); ?>Careers/addCareer">
	<div id="modal-table" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="white">&times;</span>
						</button>
						Please enter new career information below:
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
											<input type="text" placeholder="" class="col-xs-12 col-sm-12" name="cid" placeholder="<?php 
													if(empty($careers['career'])){
														echo "0";
													}else if(!isset($careers['career'][0])){
														echo "1";
													}else{
														echo $careers['career'][sizeof($careers['career'])-1]['id'] + 1;
													}
												?>" 
												value="<?php 
													if(empty($careers['career'])){
														echo "0";
													}else if(!isset($careers['career'][0])){
														echo "1";
													}else{
														echo $careers['career'][sizeof($careers['career'])-1]['id'] + 1;
													}
												?>" readonly/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Title </label>

										<div class="col-sm-6">
											<input type="text" placeholder="" class="col-xs-12 col-sm-12" name="ctitle" required/>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Link </label>

										<div class="col-sm-6">
											<input type="text" placeholder="" class="col-xs-12 col-sm-12" name="clink"/>

										</div>
									</div>

									<div class="form-group">
										<center> <label>Qualification </label></center>

										<div class="col-sm-12">
											<div class="wysiwyg-editor" id="editor1" ></div>
											<textarea class="hidden" id="hidden-editor" name="cqualifications" required></textarea>
										</div>
									</div>
									
								</div>
							</div>

						</div>
					</div><!-- /.col -->


					<div class="modal-footer no-margin-top">

						<center>
							<button class="btn btn-primary" id="submit-btn" type="submit">
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


<form class="form-horizontal" role="form" method="POST" action="<?php echo $this->config->base_url(); ?>Careers/editCareer">
	<div id="editcareer" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<span class="white">&times;</span>
						</button>
						Please enter new career information below:
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
											<input type="text" placeholder="" class="col-xs-12 col-sm-12" name="ecid" id="ecid" readonly/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Title </label>

										<div class="col-sm-6">
											<input type="text" placeholder="" class="col-xs-12 col-sm-12" name="ectitle" id="ectitle" required/>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"> Link </label>

										<div class="col-sm-6">
											<input type="text" placeholder="" class="col-xs-12 col-sm-12" name="eclink" id="eclink"/>

										</div>
									</div>

									<div class="form-group">
										<center> <label>Qualification </label></center>

										<div class="col-sm-12">
											<div class="wysiwyg-editor" id="editor2" ></div>
											<textarea class="hidden" id="hidden-editor2" name="ecqualifications" required></textarea>
										</div>
									</div>
									
								</div>
							</div>

						</div>
					</div><!-- /.col -->


					<div class="modal-footer no-margin-top">

						<center>
							<button class="btn btn-primary" id="submit-btn1" type="submit">
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

<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="<?php echo $this->config->base_url(); ?>Careers/DeleteCareer">
	<div id="deletecareer" class="modal fade" tabindex="-1">
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
									<span>Are you sure do you want to delete: </span><span id='dctext' name="dctext"></span>
									<input type="text" class="hidden" id="dcid" name="dcid" />
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
				//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt']
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

	var oTable1 = 
			$('#careers')
			//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.dataTable( {
					bAutoWidth: false,
					"aoColumns": [
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

<script>
	function editcareer(clicked_id) {
		document.getElementById("ecid").value = document.getElementById("cID"+clicked_id).innerHTML;
		document.getElementById("ectitle").value = document.getElementById("cTitle"+clicked_id).innerHTML;
		document.getElementById("eclink").value = document.getElementById("cLink"+clicked_id).innerHTML;
		document.getElementById("editor2").innerHTML = document.getElementById("cQualifications"+clicked_id).innerHTML;
	}
</script>

<script>
	function deletecareer(clicked_id) {
		document.getElementById("dctext").innerHTML = document.getElementById("cTitle"+clicked_id).innerHTML;
		document.getElementById("dcid").value = document.getElementById("cID"+clicked_id).innerHTML;
	}
</script>

<script type="text/javascript">
	$('form').submit(function() {
		$(this).find("button[type='submit']").prop('disabled',true);
	});
</script>