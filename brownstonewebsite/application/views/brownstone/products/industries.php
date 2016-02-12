<div id="pcontent" style="text-align:center">
	<?php foreach($industryList['orderedCategory'] as $id => $cat) { ?>
		<div class="col-sm-6 col-md-3 col-centered">
			<input class="contentSearch" type="hidden" value="<?php echo $cat; ?>" />
			<div class="type_div">
				<?php
					$image_properties = array(
				        'src'   => $base_url.'admin/uploads/Industries/'.$industryList['categoryAll'][$id]['img'].'.jpg',
				        'alt'   => ucfirst($cat),
				        'class' => 'img-responsive onesidedropshadow prod_img',
				       	'data-toggle' => 'tooltip',
				       	'data-original-title' => ucfirst($cat),
				        'style' => 'margin-left:15px; margin-top:15px;',
				        'title' => ucfirst($cat),
					);
				?>
				<a href="<?php echo $base_url; ?>products/industries/<?php echo $id;  ?>"><?php echo img($image_properties); ?></a>
				<div class="caption" style="text-align:center">
					<h4><?php echo substr(ucfirst($cat), 0, 25);?></h4>
				</div>
			</div>
		</div>
	<?php } ?>
</div>