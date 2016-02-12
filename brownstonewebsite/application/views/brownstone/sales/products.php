<div id="pcontent" style="text-align:center">
<?php 
	$allTypes = array();
	if(isset($supplierId) || isset($industryId)) {
		foreach($productList['orderedCategory'] as $product_id => $product_name) {
			if(isset($supplierId)) {
				if($productList['categoryAll'][$product_id]['supplier'] == $supplierId) {
					if(!isset($productList['categoryAll'][$product_id]['types'][0])) {
						$temp = $productList['categoryAll'][$product_id]['types'];
						$productList['categoryAll'][$product_id]['types'] = array();
						$productList['categoryAll'][$product_id]['types'][0] = $temp;
					}
					foreach($productList['categoryAll'][$product_id]['types'] as $typId) {
						if($productList['categoryAll'][$product_id]['sale'] != "N/A") {
							$allTypes[$typId['type']['id']] = $typId['type']['id'];
						}

					}
				}
			}
		}
	}
	if(isset($supplierId)) {
		$ccat = '/'.$supplierId;
	} else if(isset($industryId)) {
		$ccat = '/'.$industryId; 
	} else {
		$ccat = '/list';
	}



?>
<?php foreach($typeList['orderedCategory'] as $id => $cat) {
		if(isset($supplierId) || isset($industryId)) {
			if(!isset($allTypes[$id])) {
				continue;
			}
		}

		if(count($allTypes) == 1 ) {
			header("Location: ".$base_url.'sales/'.strtolower($browseBy).$ccat.'/'.$id);
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
				<a href="<?php echo $base_url.'sales/'.strtolower($browseBy).$ccat.'/'.$id; ?>"><?php echo img($image_properties); ?></a>
				<div class="caption" style="text-align:center">
					<h4><?php echo substr(ucfirst($cat), 0, 25);?></h4>
				</div>
			</div>
		</div>
	<?php } ?>
	<br/>
	<!--<a href="<?php echo $base_url; ?>products/all" class="btn btn-success">See all products</a>-->
</div>