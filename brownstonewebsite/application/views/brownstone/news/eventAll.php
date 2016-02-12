<?php
if($selectedDate == "upcoming") {
	$s_date = date("Y-m-d", strtotime(date('Y')."-".date('m')."-".date('d')));
} else {
	$s_date = explode("-", $selectedDate);
	$s_date1 = date("Y-m-d", strtotime($s_date[1]."-".$s_date[0]."-01"));
	$s_date2 = date("Y-m-d",strtotime($s_date[1]."-".$s_date[0]."-31"));
}
if(!isset($newsEvents['newsevent'][0])) {
	$temp = $newsEvents;
	$newsEvents = array();
	$newsEvents['newsevent'][0] = $temp['newsevent'];
}

$eventAll = array();
$orderedDate = array();
foreach($newsEvents['newsevent'] as $car) {
	$allow = false;
	$from_date = date("Y-m-d", strtotime($car['from']));
	$to_date = date("Y-m-d", strtotime($car['to']));
	if($selectedDate == "upcoming") {
		if($to_date >= $s_date){
			$allow = true;
		}
	} else {
		if($from_date >= $s_date1 && $to_date <= $s_date2) {
			$allow = true;
		}
	}

	if($allow == true) {
		$eventAll[$car['id']] = $car; 
		$orderedDate[$car['id']] = $from_date;
	}
}
?>
<div>
	<ol class="breadcrumb">
		<li class="active">News &amp; Events</li>
	</ol>
</div>
<?php
	if(empty($eventAll)) { ?>
		<div class="alert alert-warning">
			No news and event for this month.
		</div>
<?php }
asort($orderedDate);
$this->load->helper('directory');
$urls = "admin/uploads/Newsevents/Readmore/";
	function is_dir_empty($dir) {
	  if (!is_readable($dir)) return NULL; 
	  	$handle = opendir($dir);
	  while (false !== ($entry = readdir($handle))) {
	    if ($entry != "." && $entry != "..") {
	      return FALSE;
	    }
	  }
	  return TRUE;
	}

if(!empty($orderedDate)) {

	

	foreach($orderedDate as $id => $date5) { ?>

	<?php
		$catalogue = false;
		if(!is_dir_empty($urls.$eventAll[$id]['readmore'])) {
			$catalogue = true;
			$map = directory_map($urls.$eventAll[$id]['readmore']);
		}
	?>

	<div class="row">
		<div class="col-md-3" style="text-align:center">
			<a href="#">
				<img class="img-responsive onesidedropshadow prod_img" src="<?php echo $base_url; ?>admin/uploads/Newsevents/<?php echo $eventAll[$id]['img']; ?>.jpg"/>
			</a>
			<br/>
		</div>
		<div class="col-md-9">
			<div style="text-align:right;">
				<?php if($catalogue) {?><a href="#modal<?php echo $eventAll[$id]['readmore'] ?>" class="btn btn-primary" role="button" data-toggle="modal">Read more</a>
				<div id="modal<?php echo $eventAll[$id]['readmore'] ?>" class="modal fade" style="text-align:left;" tabindex="-1">
					<form action="Products/EditAttachments" method="POST" enctype="multipart/form-data">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header no-padding">
									<div class="table-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											<span class="white">&times;</span>
										</button>
										Attachments
									</div>


									<div class="modal-body no-padding">
										<div id="changethis2">
											<div class="widget-body">
												<div class="widget-main no-padding">
													<fieldset>
														<?php 
														for($x = 0; $x < sizeof($map); $x++){
															echo "<div id='myDiv'>";
															echo "<a href='".$base_url.$urls.$eventAll[$id]['readmore'].'/'.$map[$x]."' target='_blank'>".$map[$x]."</a>";
															echo "</div>";
														} ?>
													</fieldset>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</form>
				</div>

				<?php } ?>
			</div>
			<div class="caption" style="text-align:left">
				<h3><?php echo $eventAll[$id]['title']; ?></h3>
				<?php  if(isset($eventAll[$id]['description'])) echo $eventAll[$id]['description']; ?>
				<br/>
				<br/>
				<label>Location:</label> <?php echo $eventAll[$id]['location']; ?><br/>
				
				<label>Date:</label> 
				<?php if($eventAll[$id]['from'] == $eventAll[$id]['to']) { ?>
					<?php echo $eventAll[$id]['from']; ?>
				<?php } else { ?>
					<?php echo $eventAll[$id]['from'].' - '.$eventAll[$id]['to']; ?>
				<?php } ?>
				<br/>
				<br/>
				<?php if(isset($eventAll[$id]['featurings'])) { ?>
				<label>Featuring Supplier :</label>
				<p>	
					<?php
						$x = 0; 
						foreach($featuring2[$id] as $key9=>$featuring) {
							 $x++; ?>
							<img data-toggle="tooltip" data-original-title="<?php  echo ucfirst($featuring);?>" class="img-responsive onesidedropshadow"  src="<?php echo $base_url; ?>img/supplier/<?php echo $key9.".jpg"; ?>" style="width:145px;height:67px; margin-top:10px;">
						<?php } ?>
				</p>
				<?php } ?>
			</div>
		</div>
	</div>
	<hr/>
<?php	}
}

?>
