<div id="pcontent" style="text-align:center">
<?php 
	$allTypes = array();
	$allProducts = array();
	foreach($productList['orderedCategory'] as $product_id => $product_name) {
		if(isset($supplierId)) {
			if($productList['categoryAll'][$product_id]['supplier'] == $supplierId) {
				if(!isset($productList['categoryAll'][$product_id]['types'][0])) {
					$temp = $productList['categoryAll'][$product_id]['types'];
					$productList['categoryAll'][$product_id]['types'] = array();
					$productList['categoryAll'][$product_id]['types'][0] = $temp;
				}
				foreach($productList['categoryAll'][$product_id]['types'] as $typId) {
					$allTypes[$typId['type']['id']] = $typId['type']['id'];
				}
			}
		} elseif(isset($industryId)) {
			if(!isset($productList['categoryAll'][$product_id]['types'][0])) {
				$temp = $productList['categoryAll'][$product_id]['types'];
				$productList['categoryAll'][$product_id]['types'] = array();
				$productList['categoryAll'][$product_id]['types'][0] = $temp;
			}
			foreach($productList['categoryAll'][$product_id]['industries'] as $indId) {
				if(!isset($indId[0])) {
					$temp = $indId;
					$indId = array();
					$indId[0] = $temp;
				}

				foreach($indId as $ind2) {
					if($ind2['id'] == $industryId) {
						foreach($productList['categoryAll'][$product_id]['types'] as $typId) {
							$allTypes[$typId['type']['id']] = $typId['type']['id'];
						}
					}
				}
			}
		} else {
			foreach($productList['categoryAll'][$product_id]['types'] as $typId) {
				if(!empty($typId['id'])){
					$allTypes[$typId['id']] = $typId['id'];
				}
				
			}
		}
	}
	if(isset($supplierId)) {
		$nContent = $supplierList['orderedCategory'][$supplierId];
		$nId = $supplierId;
		$ccat = '/'.$supplierId;
	} else if(isset($industryId)) {
		$nContent = $supplierList['orderedCategory'][$industryId];
		$nId = $industryId;
		$ccat = '/'.$industryId; 
	} else {
		$ccat = '/list';
	}
	$countType = 0;
?>
<?php foreach($typeList['orderedCategory'] as $id => $cat) {
		if(!isset($allTypes[$id])) {
			continue;
		}
		$countType ++;
		if(count($allTypes) == 1 ) {
			header("Location: ".$base_url.'products/'.strtolower($browseBy).$ccat.'/'.$id);
		 	exit();
		}
?>
		<div class="col-sm-6 col-md-3 col-centered">
			<input class="contentSearch" type="hidden" value="<?php echo $cat.' '.$typeList['categoryAll'][$id]['name']; ?>" />
			<div class="type_div">
				<?php 
					$image_properties = array(
				        'src'   => $base_url.'admin/uploads/Types/'.$typeList['categoryAll'][$id]['img'].'.jpg',
				        'alt'   => ucfirst($typeList['categoryAll'][$id]['name']),
				        'class' => 'img-responsive onesidedropshadow prod_img',
				       	'data-toggle' => 'tooltip',
				       	'data-original-title' => ucfirst($cat),
				        'style' => 'margin-left:15px; margin-top:15px;',
				        'title' => ucfirst($typeList['categoryAll'][$id]['name']),
					);
				?>
				<a href="<?php echo $base_url.'products/'.strtolower($browseBy).$ccat.'/'.$id; ?>"><?php echo img($image_properties); ?></a>
				<div class="caption" style="text-align:center">
					<h4><?php echo substr(ucfirst($cat), 0, 25);?></h4>
				</div>
			</div>
		</div>
	<?php } ?>
	<?php 
	if(count($allTypes) == 0 ) {
	?>
	<div style="text-align:center">
		<img src="<?php echo $base_url; ?>img/under-construction.jpg" class="img-responsive" style="display:inline-block">
		<div class="alert alert-warning">
			<p>In the mean time, you can inquire about <b><?php echo $nContent; ?></b> by clicking the inquire/order button. <a href="<?php echo $base_url; ?>contact/inquire/<?php echo strtolower($browseBy); ?>/<?php echo $nId; ?>" class="btn btn-primary">Inquire</a></p>
		</div>
	</div>
	<?php
		}
	?>
	<br/>
	<!--<a href="<?php echo $base_url; ?>products/all" class="btn btn-success">See all products</a>-->
</div>