<div id="pcontent" style="text-align:center">
<?php 
	
	$allSupplier = array();
	foreach($productList['orderedCategory'] as $product_id => $product_name) {
		if($productList['categoryAll'][$product_id]['sale'] != "N/A") {
			$allSupplier[$productList['categoryAll'][$product_id]['supplier']] = $productList['categoryAll'][$product_id]['supplier'];
		}
	}
	if(empty($allSupplier)) { ?>
	<div style="text-align:center">
		<img src="<?php echo $base_url; ?>img/under-construction.jpg" class="img-responsive" style="display:inline-block">
		<div class="alert alert-warning">
			<p>In the mean time, you can visit our product page. by clicking the Products Page button. <a href="<?php echo $base_url; ?>products" class="btn btn-primary">Products Page</a></p>
		</div>
	</div>
<?php 
	}
	
	foreach($supplierList['orderedCategory'] as $id => $cat) { 
			if(!isset($allSupplier[$id])) {
				continue;
			}
		?>

		<div class="col-sm-6 col-md-3 col-centered">
			<input class="contentSearch" type="hidden" value="<?php echo $cat; ?>" />
			<?php 
				$image_properties = array(
			        'src'   => $base_url.'admin/uploads/Suppliers/'.$supplierList['categoryAll'][$id]['img'].'.jpg',
			        'alt'   => ucfirst($cat),
			        'class' => 'img-responsive onesidedropshadow',
			       	'data-toggle' => 'tooltip',
			       	'data-original-title' => ucfirst($cat),
			        'style' => 'margin-left:15px; margin-top:15px;',
			        'title' => ucfirst($cat),
				);
			?>
			<a href="<?php echo $base_url; ?>sales/suppliers/<?php echo $id;  ?>"><?php echo img($image_properties); ?></a>
		</div>
	<?php } ?>
</div>