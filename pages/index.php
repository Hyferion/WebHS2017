<?php
session_start();

?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>Cars</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../plugins/slick-carousel/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="../plugins/slick-carousel/slick/slick-theme.css"/>
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
						<a href="">Home</a>
					</li><!-- / Home -->


					<!-- Elements -->
					<li>
						<a href="products.php">Shop</a>
					</li><!-- / Elements -->
					<!-- Elements -->
					<li>
						<a href="contact.php">Contact</a>
					</li><!-- / Elements -->

				</ul><!-- / .nav .navbar-nav -->

			</div><!--/.navbar-collapse -->
		</div><!-- / .container -->
	</nav>
</section>


<div class="home-slider">
	<div>
		<div class="slider-item dark-bg" style="background-image:url('../src/background.jpg')">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="slide-inner text-left">
							<h1>Ford Mustang GT</h1>
							<p>Now with 500 ps</p>
							<a href="" class="btn btn-main">Buy Now</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<section class="product-category section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="title text-center">
					<h2>News</h2>
				</div>
			</div>
			<div class="col-md-6">
				<div class="category-box">
					<a href="">
						<img src="../src/car4.jpg" alt="" />
						<div class="content">
							<h3 style="color: #FFFFFF;">AMG</h3>
							<p style="color: #FFFFFF;">It's fast it's new</p>
						</div>
					</a>
				</div>
				<div class="category-box">
					<a href="">
						<img src="../src/car3.jpg" alt="" />
						<div class="content">
							<h3 style="color: #FFFFFF;">Ford Mustang</h3>
							<p style="color: #FFFFFF;">Now available again in black!</p>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="category-box category-box-2">
					<a href="">
						<img src="../src/car1.jpg" alt="" />
						<div class="content">
							<h3 style="color: #FFFFFF;">Jaguar</h3>
							<p style="color: #FFFFFF;">Drive with style</p>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="products section bg-gray">
	<div class="container">
		<div class="row">
			<div class="title text-center">
				<h2>Best Sellers</h2>
			</div>
		</div>
		<div class="row">

			<div class="col-md-4">
				<div class="product-item">
					<div class="product-thumb">
						<span class="bage">Sale</span>
						<img class="img-responsive" src="images/shop/products/product-1.jpg" alt="product-img" />
						<div class="preview-meta">
							<ul>
								<li>
									<span  data-toggle="modal" data-target="#product-modal">
										<i class="tf-ion-ios-search-strong"></i>
									</span>
								</li>
								<li>
									<a href=""><i class="tf-ion-android-cart"></i></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="product-content">
						<h4><a href="product-single.html">Reef Boardsport</a></h4>
						<p class="price">$200</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="call-to-action bg-gray section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="title">
					<h2>SUBSCRIBE TO OUR NEWSLETTER</h2>
				</div>
				<div class="col-lg-6 col-md-offset-3">
					<div class="input-group subscription-form">
						<input type="text" class="form-control" placeholder="Enter Your Email Address">
						<span class="input-group-btn">
				        <button class="btn btn-main" type="button">Subscribe Now!</button>
				      </span>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>

<?php
include_once 'footer.php';
?>


<script src="https://code.jquery.com/jquery-git.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/slick-carousel/slick/slick.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYpkJWR07RJEJ_fKv0kpSStIj_VXGrGzA&callback=initMap"></script>
<script src="../js/script.js"></script>



</body>
</html>
