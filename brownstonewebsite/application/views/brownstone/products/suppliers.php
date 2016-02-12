<div id="pcontent" style="text-align:center">
<?php 
	foreach($supplierList['orderedCategory'] as $id => $cat) { ?>
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
			<a href="<?php echo $base_url; ?>products/suppliers/<?php echo $id;  ?>"><?php echo img($image_properties); ?></a>
		</div>
	<?php } ?>
</div>