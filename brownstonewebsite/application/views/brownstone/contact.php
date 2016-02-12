<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46221050-1', 'brownstone-asiatech.com');
  ga('send', 'pageview');
</script>

<style>
#recaptcha_image img {
    width:100%
}
#recaptcha_image {
    width: 100% ! important;
}

</style>
<div class="container-fluid">
    <div class="row row-centered">
        <div class="col-sm-6 col-md-8 col-centered">
			<img class="img-responsive" src="<?php echo $base_url; ?>img/contactus_header2.jpg" alt="...">
        </div>
	</div>
	<hr style="width:70%">
	<div class="row row-centered">
        <div class="col-sm-6 col-md-4 col-centered">
			<h3>Send us a message now!</h3>
			<form class="sendus-form" method="post" id="frmSubmit" name="contact" action="<?php echo $base_url; ?>contact/thanks">
				<div class="form-group">
					<label for="inputEmail">Name</label>
					<input type="text" class="form-control" id="author" name="author" placeholder="Name" required>
				</div>
				<div class="form-group">
					<label for="inputEmail">Email</label>
					<input type="email" class="form-control" id="inputEmail" name="email" type="email" placeholder="Email" required>
				</div>	
				<div class="form-group">
					<label for="inputEmail">Mobile #</label>
					<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile #" required>
				</div>
				<div class="form-group">
					<label for="inputEmail">Company</label>
					<input type="text" class="form-control" id="company" name="subject" placeholder="Company" required>
				</div>
				<div class="form-group">
					<label for="inputEmail">Message</label>

				<?php if(isset($category)) { ?>
						<?php if($category == 'types') { ?>
							<textarea class="form-control" rows="10" id="message "name="message" style="resize: none;">I want to inquire for the following item:

Product: <?php
		$typeCount = 0;
		foreach($productList['categoryAll'][$categoryId]['types'] as $typId) {
			echo ($typeCount > 0) ? ', '.$typeList['orderedCategory'][$typId['id']] : $typeList['orderedCategory'][$typId['id']];
			$typeCount ++;
		} ?>

Model: <?php echo $productList['orderedCategory'][$categoryId]; ?>

Brand: <?php echo $supplierList['orderedCategory'][$productList['categoryAll'][$categoryId]['supplier']]; ?>
</textarea>
						<?php } elseif ($category == 'suppliers') { ?>
						<textarea class="form-control" rows="10" id="message "name="message" style="resize: none;">I want to inquire for the following item:
					
Brand: <?php echo $supplierList['orderedCategory'][$categoryId]; ?>
</textarea>
						<?php } elseif ($category == 'xrf') { ?>
						<textarea class="form-control" rows="10" id="message "name="message" style="resize: none;">I want to inquire for the following item:

Product: Portable XRF Analyzers

Brand: Thermo Scientific Portable Analyzer Instruments, inc.
</textarea>
						<?php } ?>
				<?php } else { 
			?>
			<textarea class="form-control" rows="10" id="message "name="message" style="resize: none;"></textarea>
			<?php } ?>
				
				</div>	
				<div id="capchaThis"></div>
				<span style="visibility:hidden" id="captchaConfirm" class="label label-warning">Please confirm that you're not a robot.</span>
				<br/>
				<br/>
				<button type="submit" class="btn btn-primary">Send</button>
				<button type="clear" class="btn btn-primary">Clear</button>
			</form>
			<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
				async defer>
			</script>
        </div>
        <div class="col-sm-6 col-md-4 col-centered">
			<h3>Our Location</h3>
			<iframe class="img-responsive" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3861.1979761341686!2d121.03495699999999!3d14.587791999999997!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1457310f52c42cea!2sBrownstone+Asia-Tech%2C+Inc.!5e0!3m2!1sen!2sph!4v1405364089776" width="465" height="350" frameborder="0" style="border:0"></iframe>
			<br/>
			<p>For inquiries and Orders, please contact us through any of the following channels listed below. Business hours are from 8:30AM to 6:00PM</p>
			<h3>Address</h3>
            <p>No. 10-A (Old No. 310) H. Poblador Street,<br/> Barangay Hagdan Bato Libis,<br/> Mandaluyong City, Philippines</p>
		
			<h3>Telephone</h3>
			<p>(632) 532-4310; (632) 718-4391; <br/>(632) 535-2269; (632) 718-1694</p>
			
            <h3>Fax</h3>
            <p>(632) 531-6518</p>
			
            <h3>Email</h3>
            <p><a href="mailto:batinc@pldtdsl.net">batinc@pldtdsl.net</a></p>
			<br/>
			<br/>
			<br/>
			<br/>
	   </div>
    </div>
</div>


