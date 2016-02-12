<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46221050-1', 'brownstone-asiatech.com');
  ga('send', 'pageview');
</script>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-6 col-md-8">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel"  data-interval="3000">
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<?php 
					if(empty($banners['banner'])) {

					} else if(!isset($banners['banner'][0])) {
						$temp = $banners;
						$banners = array();
						$banners['banner'][0] = $temp['banner'];
					}

					if(!empty($banners)) {
						for($x = 0; $x < sizeof($banners['banner']); $x++) {
							$urls = "";
							if($banners['banner'][$x]['category'] == 'Products') {

								foreach($productList['categoryAll'][$banners['banner'][$x]['cid']]['types'] as $typId) {
									$urls = "products/types/list/".current($typId);
								}
								
							} else if ($banners['banner'][$x]['category'] == 'News and Events') {

								$realDate3 = explode("/", $newsList['categoryAll'][$banners['banner'][$x]['cid']]['from']);
								$urls = "news/all/".$realDate3[0]."-".$realDate3[2];
						
							} else if ($banners['banner'][$x]['category'] == 'Types') {

								$urls = "products/types/list/".$banners['banner'][$x]['cid'];
								
							} else if ($banners['banner'][$x]['category'] == 'Suppliers') {

								$urls = "products/suppliers/".$banners['banner'][$x]['cid'];
								
							} else if ($banners['banner'][$x]['category'] == 'Industries') {

								$urls = "products/industries/".$banners['banner'][$x]['cid'];
								
							} else if ($banners['banner'][$x]['category'] == 'Career') {

								$urls = "career";
								
							}

							?>
							<div class="item <?php if($x == 1) { echo 'active'; } ?>">
								<img src="<?php echo $base_url; ?>admin/uploads/Banners/<?php echo $banners['banner'][$x]['id'] ?>.jpg" alt="<?php echo $banners['banner'][$x]['img']; ?>">
								<?php if(!empty($urls)) { ?>
								<div class="carousel-caption">
							        <a href="<?php echo $base_url.$urls; ?>">Go to <?php echo $banners['banner'][$x]['category']; ?> Page</a>
							    </div>
							    <?php } ?>
							</div>
							<?php
						}
					} ?>
				</div>
			 
				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div> <!-- Carousel -->	
		</div>
		<div class="col-sm-6 col-md-4">
			<h3 style="text-align:center">News &amp; Events</h3>
			<hr>
			<div>
				<?php echo $eventList; ?>
			</div>
			<p style="text-align:center"><a href="<?php echo $base_url ?>news/all/upcoming" class="btn btn-success">Read More &raquo;</a></p>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="page-header">
	  <h3 style="text-align:center">View Products By</h3>
	</div>
    <div class="row row-centered">
        <div class="col-xs-3 col-centered" style="text-align:center">
			<a href="<?php echo $base_url ?>products/suppliers">
                <img class="img-responsive onesidedropshadow" src="<?php echo $base_url; ?>img/supplier.jpg" data-toggle="tooltip" data-original-title="View Products by Suppliers">
            </a>
			<h3 class="lead">SUPPLIERS</h3>
        </div>
        <div class="col-xs-3 col-centered" style="text-align:center">
			<a href="<?php echo $base_url ?>products/types">
                <img class="img-responsive onesidedropshadow" src="<?php echo $base_url; ?>img/products.jpg" data-toggle="tooltip" data-original-title="View Products by Types">
            </a>
			<h3 class="lead">PRODUCTS</h3>
        </div>
        <div class="col-xs-3 col-centered" style="text-align:center">
			<a href="<?php echo $base_url; ?>products/industries">
                <img class="img-responsive onesidedropshadow" src="<?php echo $base_url; ?>img/industry.jpg" data-toggle="tooltip" data-original-title="View Products by Industry">
            </a>
			<h3 class="lead">INDUSTRIES</h3>
        </div>
    </div>
</div>