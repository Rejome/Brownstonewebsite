

<div id="pcontent">
<?php 
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
		} else {
			foreach($productList['categoryAll'][$product_id]['types'] as $typId) {
				if($typId['id'] == $typeId) {
					$allProducts[$product_id] = $product_name;
				}
			}
			
		}
	}

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

?>
<?php 
	//sorting
	natcasesort($allProducts);
	$x=0;
	if(empty($allProducts)) { ?>
	
	<div style="text-align:center">
		<img src="<?php echo $base_url; ?>img/under-construction.jpg" class="img-responsive" style="display:inline-block">
		<div class="alert alert-warning">
			<p>In the mean time, you can inquire about <b><?php echo $typeList['categoryAll'][$typeId]['name']; ?></b> by clicking the inquire/order button. <a href="<?php echo $base_url; ?>contact/inquire/<?php echo $typeId; ?>" class="btn btn-primary">Inquire</a></p>
		</div>
	</div>
<?php 
	}$this->load->helper('directory');
	$urls = "admin/uploads/Products/Attachments/";
	foreach ($allProducts as  $prod_id => $prod_name) { ?>

		<?php
			$catalogue = false;
			if(!is_dir_empty($urls.$prod_id)) {
				$catalogue = true;
				$map = directory_map($urls.$prod_id);
			}
		?>
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
					<?php if ($catalogue == true){ ?>
					<div class="col-md-3 col-centered" style="margin-top:5px">
						<a href="#modaldocuments<?php echo $prod_id ?>" id="<?php echo $prod_id; ?>" role="button" data-toggle="modal" class="tooltip-info blue btn btn-primary" data-rel="tooltip" title="Documents" onclick="viewdocs(this.id)">See Product Catalogue</a>
					</div>
					<?php } ?>
					<div class="col-md-3 col-centered" style="margin-top:5px">
						<a href="<?php echo $base_url; ?>contact/inquire/types/<?php echo $prod_id; ?>" class="btn btn-primary">Inquire</a>
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

		<?php if($catalogue == true) { ?>
		<div id="modaldocuments<?php echo $prod_id ?>" class="modal fade" tabindex="-1">
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
													echo "<a href='".$base_url.$urls.$prod_id.'/'.$map[$x]."' target='_blank'>".$map[$x]."</a>";
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
<?php } ?>
</div>