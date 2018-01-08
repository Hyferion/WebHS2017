<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="description" content="Aviato E-Commerce Template">

	<meta name="author" content="Themefisher.com">

	<title>Aviato | E-commerce template</title>

	<!-- Mobile Specific Meta-->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

	<!-- Themefisher Icon font -->
	<link rel="stylesheet" href="../plugins/themefisher-font/style.css">
	<!-- bootstrap.min css -->
	<link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../plugins/slick-carousel/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="../plugins/slick-carousel/slick/slick-theme.css"/>

	<!-- Main Stylesheet -->
	<link rel="stylesheet" href="../css/style.css">

</head>

<body id="body">

<?php
include_once 'header.php';
?>

<!-- Main Menu Section -->
<section class="menu">
	<nav class="navbar navigation">
		<div class="container">
			<div class="navbar-header">
				<h2 class="menu-title">Main Menu</h2>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

			</div><!-- / .navbar-header -->

			<!-- Navbar Links -->
			<div id="navbar" class="navbar-collapse collapse text-center">
				<ul class="nav navbar-nav">

					<!-- Home -->
					<li class="dropdown ">
						<a href="index.php">Home</a>
					</li><!-- / Home -->


					<!-- Elements -->
					<li>
						<a href="products.php">Shop</a>
					</li><!-- / Elements -->
					<!-- Elements -->
					<li>
						<a href="">Contact</a>
					</li><!-- / Elements -->

				</ul><!-- / .nav .navbar-nav -->

			</div><!--/.navbar-collapse -->
		</div><!-- / .container -->
	</nav>
</section>

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Contact Us</h1>
					<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li class="active">contact</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>




<section class="page-wrapper">
	<div class="contact-section">
		<div class="container">
			<div class="row">
				<!-- Contact Form -->
				<div class="contact-form col-md-6 " >
					<form id="contact-form" method="post" action="" role="form">

						<div class="form-group">
							<input type="text" placeholder="Your Name" class="form-control" name="name" id="name">
						</div>

						<div class="form-group">
							<input type="email" placeholder="Your Email" class="form-control" name="email" id="email">
						</div>

						<div class="form-group">
							<input type="text" placeholder="Subject" class="form-control" name="subject" id="subject">
						</div>

						<div class="form-group">
							<textarea rows="6" placeholder="Message" class="form-control" name="message" id="message"></textarea>
						</div>

						<div id="mail-success" class="success">
							Thank you. The Mailman is on His Way :)
						</div>

						<div id="mail-fail" class="error">
							Sorry, don't know what happened. Try later :(
						</div>

						<div id="cf-submit">
							<input type="submit" id="contact-submit" class="btn btn-transparent" value="Submit">
						</div>

					</form>
				</div>
				<!-- ./End Contact Form -->

				<!-- Contact Details -->
				<div class="contact-details col-md-6 " >
					<ul class="contact-short-info" >
						<li>
							<i class="tf-ion-ios-home"></i>
							<span>Berner Fachhochschule, Abteilung Informatik</span>
						</li>
						<li>
							<i class="tf-ion-android-mail"></i>
							<span>Email: cars@cars.com</span>
						</li>
					</ul>

				</div>
			</div>
		</div>
	</div>
</section>



<?php
include_once 'footer.php';
?>


<!--
Essential Scripts
=====================================-->


<!-- Main jQuery -->
<script src="https://code.jquery.com/jquery-git.min.js"></script>
<!-- Bootstrap 3.1 -->
<script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- Instagram Feed Js -->
<script src="../plugins/instafeed.js/instafeed.min.js"></script>
<!-- Slick Carousel -->
<script src="../plugins/slick-carousel/slick/slick.min.js"></script>
<!-- Google Map js -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYpkJWR07RJEJ_fKv0kpSStIj_VXGrGzA&callback=initMap"></script>

<!-- Main Js File -->
<script src="../js/script.js"></script>



</body>
</html>