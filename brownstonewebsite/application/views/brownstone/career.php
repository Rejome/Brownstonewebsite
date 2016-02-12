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
        <div class="col-sm-6 col-md-8 col-centered">
			<img class="img-responsive" src="<?php echo $base_url; ?>img/career_header2.jpg" alt="career header">
        </div>
	</div>
	<hr style="width:70%">
	<div class="row row-centered">
        <div class="col-sm-6 col-md-8 col-centered">
           <h2>For immediate hiring</h2>
        </div>
    </div>
	<div class="row row-centered">
        <div class="col-sm-6 col-md-8 col-centered">
           <p>We are looking for:</p>
        </div>
    </div>
    <?php 
	    if(!isset($careers['career'][0])){
			$temp = $careers;
			$careers = array();
			$careers['career'][0] = $temp['career'];
		}
		foreach($careers['career'] as $car) { ?>

			<hr style="width:70%">
			<div class="row row-centered">
		        <div class="col-sm-6 col-md-8 col-centered">
		            <h3><?php echo $car['title']; ?></h3>
		            <h4>Qualification : </h4>
					<?php echo $car['description']; ?>
					<?php 
						if(!empty($car['link'])) { ?>
							<p>You can also apply here: <a href="http://<?php echo $car["link"]; ?>"><?php echo $car['link']; ?></a></link></p>
						<?php }
					?>
				</div>
		    </div>
		<?php }
    ?>
	
	<hr style="width:70%">
	<div class="row row-centered">
        <div class="col-sm-6 col-md-8 col-centered">
			<p>Please send us your resume and transcript of records to: batinc@pldtdsl.net</p>
		</div>
    </div>
</div>