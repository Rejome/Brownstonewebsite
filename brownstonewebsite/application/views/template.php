<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $pageTitle; ?> - Brownstone Asia-Tech Inc.</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo $base_url; ?>img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/style.css">
    <script src="<?php echo $base_url; ?>js/jquery.min.js"></script>
</head>

<body>
    <nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $base_url; ?>" style="padding:15px 0px 15px 0px;"><img id="company-logo" class="img-responsive" src="<?php echo $base_url; ?>img/logotrans.png"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="nav navbar-nav res-main-links">
                    <li <?php if($active == "home"){ echo "class='active'";} ?>> <a href="<?php echo $base_url; ?>">Home</a> </li>
                    <li <?php if($active == "about"){ echo "class='active'";} ?>> <a href="<?php echo $base_url; ?>about">About</a> </li>
                    <li <?php if($active == "product"){ echo "class='active'";} ?> class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Products <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo $base_url; ?>products/suppliers"><i class="fa fa-fw fa-envelope"></i> By Supplier</a>
                            </li>
                            <li>
                                <a href="<?php echo $base_url; ?>products/types"><i class="fa fa-fw fa-gear"></i> By Products</a>
                            </li>
                            <li>
                                <a href="<?php echo $base_url; ?>products/industries"><i class="fa fa-fw fa-gear"></i> By Industry</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php if($active == "sale"){ echo "class='active'";} ?>> <a href="<?php echo $base_url; ?>sales/suppliers">Sale</a> </li>
                    <li <?php if($active == "news"){ echo "class='active'";} ?>> <a href="<?php echo $base_url; ?>news/all/upcoming">News &amp; Events</a> </li>
                    <li <?php if($active == "career"){ echo "class='active'";} ?>> <a href="<?php echo $base_url; ?>career">Career</a> </li>
                    <li <?php if($active == "contact"){ echo "class='active'";} ?>> <a href="<?php echo $base_url; ?>contact">Contact</a> </li>
                </ul>
    			<div class="small_contact onesidedropshadow">
                    <label>TEL: (632) 532-4310/718-4319/ 532-5131 <br/>EMAIL: <a href="mailto:sales@brownstone-asiatech.com">sales@brownstone-asiatech.com</a> </label>	
    			</div>
            </div>
        </div>
    </nav>
    <div class="container-fluid topper">
    </div>
    <?php echo $content; ?>
    <div class="container-fluid">
        <hr>
    	<div class="row">
            <div class="col-xs-12">
                <footer style="text-align:center">
                    <p>&copy; Copyright <?php echo date('Y'); ?>.</p>
                    <p>Brownstone Asia-Tech, Inc. </p>
    				<p>10-A H. Poblador St., Brgy. Hagdan Bato Libis, Mandaluyong City 1552, Philippines</p>
                </footer>
            </div>
        </div>
    </div>

    <script src="<?php echo $base_url; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url; ?>js/myjs.js"></script>
    <script>

    </script>
</body>
</html>
