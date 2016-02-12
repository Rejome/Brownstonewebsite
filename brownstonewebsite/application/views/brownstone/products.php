<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46221050-1', 'brownstone-asiatech.com');
  ga('send', 'pageview');
</script>
<div class="container-fluid">
	<div class="row row-centered">
        <div class="col-sm-6 col-md-4 col-centered">
			<h3>Browse Information By:</h3>
			<select class="form-control" id="browseBy">
                <option <?php if($browseBy == "Suppliers"){ echo "selected"; } ?> value="<?php echo $base_url; ?>products/suppliers">Supplier</option>
                <option <?php if($browseBy == "Industries"){ echo "selected"; } ?> value="<?php echo $base_url; ?>products/industries">Industry</option>
                <option <?php if($browseBy == "Types"){ echo "selected"; } ?> value="<?php echo $base_url; ?>products/types">Product</option>
            </select>
		</div>
	</div>
	<hr style="width:70%">
	<div class="row row-centered">
        <div class="col-sm-6 col-md-2 col-centered">
			<input id="sear search_box" type="text" class="form-control searchbox" placeholder="Filter Content&hellip;" style="margin-top:5px;">
        </div>
	</div>
	<hr/>
	<div class="row row-centered" style="margin-top:10px">
        <div class="col-sm-6 col-md-10 col-centered">
        	<div>
				<ol class="breadcrumb">
					<li class="active"><a href="<?php echo $base_url.'products/'.strtolower($browseBy); ?>"><?php echo $browseBy; ?></a></li>
					<?php if(isset($industryId)) { ?>
						<li><a href="<?php echo $base_url.'products/industries/'.$industryId; ?>"><?php echo $industryList['categoryAll'][$industryId]['title']; ?></a></li>
					<?php } elseif(isset($supplierId)) { ?>
						<li><a href="<?php echo $base_url.'products/suppliers/'.$supplierId; ?>"><?php echo $supplierList['categoryAll'][$supplierId]['title']; ?></a></li>
					<?php } ?>
					<?php if(isset($typeId)) { ?>
						<?php if(isset($industryId)) { ?>
							<li><a href="<?php echo $base_url.'products/industries/'.$industryId.'/'.$typeId; ?>"><?php echo $typeList['categoryAll'][$typeId]['name']; ?></a></li>
						<?php }elseif(isset($supplierId)) { ?>
							<li><a href="<?php echo $base_url.'products/suppliers/'.$supplierId.'/'.$typeId; ?>"><?php echo $typeList['categoryAll'][$typeId]['name']; ?></a></li>
						<?php } else { ?>
							<li><a href="<?php echo $base_url.'products/types/list/'.$typeId; ?>"><?php echo $typeList['categoryAll'][$typeId]['name']; ?></a></li>
						<?php } ?>
					<?php } ?>
				</ol>
			</div>
			<?php echo $product_content; ?>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	$(".searchbox").keyup(function(e) {
		$('.contentSearch').each(function(i, obj) {
			if($(this).val().toLowerCase().search($(".searchbox").val().toLowerCase()) < 0) {
				$(this).parent().hide();
			} else {
				$(this).parent().show();
			}
		});
	});
});
 </script>