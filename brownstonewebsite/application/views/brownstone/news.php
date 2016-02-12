<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46221050-1', 'brownstone-asiatech.com');
  ga('send', 'pageview');
</script>
<div class="container">
	<div class="row">
		<div class="col-sm-4 col-md-3 sidebar">
			<div class="mini-submenu">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</div>
			<div class="list-group">
				<span href="#" class="list-group-item active">
					News &amp; Events
					<span class="pull-right" id="slide-submenu">
						<i class="fa fa-times"></i>
					</span>
				</span>
				<nav id="myNavbar" class="navbar navbar-default" role="navigation"> 
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header" style="text-align:center">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse2"> 
							<span class="sr-only">Toggle navigation</span> 
							<span class="icon-bar"></span> 
							<span class="icon-bar"></span> 
							<span class="icon-bar"></span> 
						</button><br/>
						<a class="navbar-brand" style="float:none; margin-left:55px" href="#">Select Month</a>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="navbarCollapse2">
						<ul class="nav navbar-nav" style="width:100%; text-align:center">
							<li style="clear:left; width:100%"><a class="list-group-item" href="<?php echo $base_url; ?>news/all/upcoming">Upcoming</a></li>
							<?php echo $eventList; ?>
						</ul>
					</div>
				</nav>
			</div>        
		</div>
		<div class="col-sm-4 col-md-9" id="newsContent">
			<?php echo $event; ?>
		</div>
	</div>
</div>