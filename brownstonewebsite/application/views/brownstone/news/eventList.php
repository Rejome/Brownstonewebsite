<?php
$eventAll = array();
$orderedDate = array();
foreach($newsEvents['newsevent'] as $car) {
	$eventAll[$car['id']] = $car; 
	$orderedDate[$car['id']] = $car['from'];
}
?>
<?php if($newsPage == "news") { ?>
	<?php $x = 0; ?>
	<?php for($i=0; $i < 8; $i++) { ?>
		<li style="clear:left; width:100%"><a class="list-group-item" href="<?php echo $base_url; ?>news/all/<?php echo date('m-Y', mktime(0, 0, 0, date('m')-$i, 1, date('Y')));  ?>"><?php echo date('F Y', mktime(0, 0, 0, date('m')-$i, 1, date('Y'))); ?></a></li>
	<?php 	} ?>

<?php } else { ?>
<div class="image_thumb">
<?php	asort($orderedDate); $y=0; ?>
<?php 	foreach ($orderedDate as  $id => $date5) {
			$y++;

			$realDate3 = explode("/", $date5);
			
			if($y == 4) break; ?> 
			
			<a href="<?php  echo $base_url; ?>news/all/<?php echo $realDate3[0]."-".$realDate3[2];  ?>" class="thumb-a" style="color: #222222;"><h4 style="margin-top:20px; "><?php echo $eventAll[$id]['title']; ?></h4></a>
			<?php if($eventAll[$id]['from'] == $eventAll[$id]['to']) { ?>
				<p style="text-align:left"><?php echo $eventAll[$id]['from']; ?></p>
			<?php } else { ?>
				<p style="text-align:left"><?php echo $eventAll[$id]['from'].' - '.$eventAll[$id]['to']; ?></p>
			<?php }
		} ?>
</div>
<?php } ?>