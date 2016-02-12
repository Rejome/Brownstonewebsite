<div id="pcontent">
<?php 
	$allProducts = array();
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
						if($typId['type']['id'] == $typeId) {
							$allProducts[$product_id] = $product_name;
						}
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
								if($typId['type']['id'] == $typeId) {
									$allProducts[$product_id] = $product_name;
								}
							}
						}
					}
				}

			}
		}
	}

?>
<?php 
	asort($allProducts);
	
	$x=0;
	if(empty($allProducts)) { ?>
	
	<div style="text-align:center">
		<img src="<?php echo $base_url; ?>img/under-construction.jpg" class="img-responsive" style="display:inline-block">
		<div class="alert alert-warning">
			<p>In the mean time, you can inquire about <b><?php echo $typeList['categoryAll'][$typeId]['name']; ?></b> by clicking the inquire/order button. <a href="<?php echo $base_url; ?>contact/inquire/<?php echo $typeId; ?>" class="btn btn-primary">Inquire</a></p>
		</div>
	</div>
<?php 
	}

	foreach ($allProducts as  $prod_id => $prod_name) { ?>

		<?php if($productList['categoryAll'][$prod_id]['sale'] != "N/A"){ ?>
		<div class="row">
			
			<input class="contentSearch" type="hidden" value="<?php echo $prod_name; ?>" />
			<div class="col-md-3" style="text-align: center">
				<a href="#">
					<img class="img-responsive onesidedropshadow prod_img" src="<?php echo $base_url; ?>admin/uploads/products/<?php echo $productList['categoryAll'][$prod_id]['img']; ?>.jpg" alt="<?php echo $prod_name; ?>"/>
				</a><br/>
				Supplier: <a data-toggle="tooltip" data-placement="bottom" data-original-title="View all products of <?php echo $supplierList['categoryAll'][$productList['categoryAll'][$prod_id]['supplier']]['title']; ?>" href="<?php echo $base_url; ?>products/suppliers/<?php echo $productList['categoryAll'][$prod_id]['supplier'];?>"><?php echo $supplierList['categoryAll'][$productList['categoryAll'][$prod_id]['supplier']]['title']; ?></a>
		<?php if($productList['categoryAll'][$prod_id]['sale'] != "N/A"){ ?>
			<img class="img-responsive" src="<?php echo $base_url; ?>img/sale.png" style="display:inline-block"/>
		<?php } ?>		
		</div>
			<div class="col-md-9">
				<div class="row-centered">
					<?php if (isset($cata[$prod_id])){ ?>
					<div class="col-md-3 col-centered" style="margin-top:5px">
						<button class="btn btn-primary" data-toggle="modal" data-target="#modal<?php echo $key; ?>">See Product Catalogue</button>
					</div>
					<?php } ?>
					<div class="col-md-3 col-centered" style="margin-top:5px">
						<a href="<?php echo $base_url; ?>contact/inquire/<?php echo $prod_id; ?>" class="btn btn-primary">Inquire</a>
					</div>
				</div>
				<hr/>
				<div class="caption" style="text-align:left">
					<h3><?php echo $prod_name; ?></h3>
					<?php echo $productList['categoryAll'][$prod_id]['description']; ?>
				</div>
			</div>
		</div>
		<hr/>
	<?php if (isset($cata[$prod_id])){ ?>
	<div  id="modal<?php echo $key; ?>" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Product Catalogue</h4>
				</div>
				<div class="modal-body">
					<ul>
						<?php foreach ($cata[$key] as $cat){ ?>
							<li><a href="<?php echo $base_url; ?>img/catalogue/<?php echo $suppliersimage[$supplier[$key]]."/".$cat; ?>"  target="_blank"><?php echo $cat; ?></a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
		<?php } ?>
	 <?php } ?>
<?php } ?>
</div>