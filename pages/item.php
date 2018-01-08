<?php

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$idprev = $id - 1;
	$idnext = $id + 1;
}

$db = new mysqli("localhost:8889", "root", "test123", "carscars");
if ($db->connect_error) {
	echo("Unable to connect to the database" . $db->connect_error);
}

if (!$result = $db->query("SELECT * FROM products WHERE id =".$id.";")) {
	echo("There was an error connecting to the db");
}
while ($car = $result->fetch_assoc()) {
	$products[$car['id']] = array(
		'brand' => $car ['brand'],
		'model' => $car ['model'],
		'price' => $car ['price'],
		'type' => $car['type'],
		'imgRef' => $car ['imgRef'],
		'imgRefTwo' => $car['imgRefTwo'],
		'imgRefThree' => $car['imgRefThree']
	);
}
if (!$result = $db->query("SELECT MAX(id) from products")) {
	echo("There was an error connecting to the db");
}
$res= $result->fetch_assoc();

$idmax = $res['MAX(id)'];
$db->close();

echo "<table style='margin-top: 50px'>";
echo "<tr>
		<td> Marke: ".$products[$id]['brand']."</td>
		<td>Model: ".$products[$id]['model']."</td>
		<td>Kategorie: ".$products[$id]['category']."</td>.
		<td>Preis: ".$products[$id]['price']."</td>
		<td> <img src=".$products[$id]['imgRef']."></td>
		<td> <form action=\"shoppingcart.php?item_id=".$id."\" method=\"post\">
		<select name='quantity'>
		<option value='1'>1</option>
		<option value='2'>2</option>		
		<option value='3'>3</option>
</select>
	<input type=\"submit\" value=\"Add\">
</form></td>
		</tr>";
echo "</table>";
echo "<a href='./products.php'> Back </a></br>";
echo "<a href='./shoppingcart.php'> Cart </a>";
?>
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
						<a href="contact.php">Contact</a>
					</li><!-- / Elements -->

			</div><!--/.navbar-collapse -->
		</div><!-- / .container -->
	</nav>
</section>

<?php
echo "<section class=\"single-product\">
	<div class=\"container\">
		<div class=\"row\">
			<div class=\"col-md-6\">
				<ol class=\"breadcrumb\">
					<li><a href=\"index.php\">Home</a></li>
					<li><a href=\"products.php\">Shop</a></li>
					<li class=\"active\">Single Product</li>
				</ol>
			</div>
			<div class=\"col-md-6\">
				<ol class=\"product-pagination text-right\">
				";

	if ($id < $idmax){echo "
					<li><a href='?id=".$idnext."'><i class=\"tf-ion-ios-arrow-left\"></i> Next </a></li>
					";}
if ($id > 1){ echo "
					<li><a href='?id=".$idprev."'>Preview <i class=\"tf-ion-ios-arrow-right\"></i></a></li>
					";}
					echo "
				</ol>
			</div>
		</div>
		<div class=\"row mt-20\">
			<div class=\"col-md-5\">
				<div class=\"single-product-slider\">
					<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
						<div class='carousel-outer'>
							<!-- me art lab slider -->
							<div class='carousel-inner '>
								<div class='item active'>
									<img src=".$products[$id]['imgRef']." alt='' data-zoom-image=\"images/shop/single-products/product-1.jpg\" />
								</div>
								<div class='item'>
									<img src=".$products[$id]['imgRefTwo']." alt='' data-zoom-image=\"images/shop/single-products/product-2.jpg\" />
								</div>

								<div class='item'>
									<img src=".$products[$id]['imgRefThree']." alt='' data-zoom-image=\"images/shop/single-products/product-3.jpg\" />
								</div>

							</div>

							<!-- sag sol -->
							<a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
								<i class=\"tf-ion-ios-arrow-left\"></i>
							</a>
							<a class='right carousel-control' href='#carousel-custom' data-slide='next'>
								<i class=\"tf-ion-ios-arrow-right\"></i>
							</a>
						</div>

						<!-- thumb -->
						<ol class='carousel-indicators mCustomScrollbar meartlab'>
							<li data-target='#carousel-custom' data-slide-to='0' class='active'>
								<img src=".$products[$id]['imgRef']."  alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='1'>
								<img src=".$products[$id]['imgRefTwo']." alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='2'>
								<img src=".$products[$id]['imgRefThree']." alt='' />
							</li>
						</ol>
					</div>
				</div>
			</div>
			<div class=\"col-md-7\">
				<div class=\"single-product-details\">
					<h2>".$products[$id]['brand']." ".$products[$id]['model']."</h2>
					<p class=\"product-price\">".$products[$id]['price'].'$'."</p>

					<p class=\"product-description mt-20\">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum ipsum dicta quod, quia doloremque aut deserunt commodi quis. Totam a consequatur beatae nostrum, earum consequuntur? Eveniet consequatur ipsum dicta recusandae.
					</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, velit, sunt temporibus, nulla accusamus similique sapiente tempora, at atque cumque assumenda minus asperiores est esse sequi dolore magnam. Debitis, explicabo.</p>
					<div class=\"color-swatches\">
						<span>color:</span>
						<ul>
							<li>
								<a href=\"\" class=\"swatch-violet\"></a>
							</li>
							<li>
								<a href=\"\" class=\"swatch-black\"></a>
							</li>
							<li>
								<a href=\"\" class=\"swatch-cream\"></a>
							</li>
						</ul>
					</div>
					<div class=\"product-quantity\">
						<span>Quantity:</span>
						<div class=\"product-quantity-slider\">
							<input id=\"product-quantity\" type=\"text\" value=\"0\" name=\"quantity\">
						</div>
					</div>
					<div class=\"product-category\">
						<span>Categories:</span>
						<ul>
							<li><a href=\"#\">Products</a></li>
							<li><a href=\"products.php?".$products[$id]['type']."=1\">".$products[$id]['type']."</a></li>
						</ul>
					</div>
					<a href=\"shoppingcart.php\" class=\"btn btn-main mt-20\">Add To Cart</a>
				</div>
			</div>
		</div>
		<div class=\"row\">
			<div class=\"col-xs-12\">
				<div class=\"tabCommon mt-20\">
					<ul class=\"nav nav-tabs\">
						<li class=\"active\"><a data-toggle=\"tab\" href=\"#details\" aria-expanded=\"true\">Details</a></li>
						<li class=\"\"><a data-toggle=\"tab\" href=\"#reviews\" aria-expanded=\"false\">Reviews (3)</a></li>
					</ul>
					<div class=\"tab-content patternbg\">
						<div id=\"details\" class=\"tab-pane fade active in\">
							<h4>Product Description</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut per spici</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis delectus quidem repudiandae veniam distinctio repellendus magni pariatur molestiae asperiores animi, eos quod iusto hic doloremque iste a, nisi iure at unde molestias enim fugit, nulla voluptatibus. Deserunt voluptate tempora aut illum harum, deleniti laborum animi neque, praesentium explicabo, debitis ipsa?</p>
						</div>
						<div id=\"reviews\" class=\"tab-pane fade\">
							<div class=\"post-comments\">
								<ul class=\"media-list comments-list m-bot-50 clearlist\">
									<!-- Comment Item start-->
									<li class=\"media\">

										<a class=\"pull-left\" href=\"#\">
											<img class=\"media-object comment-avatar\" src=\"images/blog/avater-1.jpg\" alt=\"\" width=\"50\" height=\"50\" />
										</a>

										<div class=\"media-body\">
											<div class=\"comment-info\">
												<h4 class=\"comment-author\">
													<a href=\"#\">Jonathon Andrew</a>

												</h4>
												<time datetime=\"2013-04-06T13:53\">July 02, 2015, at 11:34</time>
												<a class=\"comment-button\" href=\"#\"><i class=\"tf-ion-chatbubbles\"></i>Reply</a>
											</div>

											<p>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at magna ut ante eleifend eleifend.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod laborum minima, reprehenderit laboriosam officiis praesentium? Impedit minus provident assumenda quae.
											</p>
										</div>

									</li>
									<!-- End Comment Item -->

									<!-- Comment Item start-->
									<li class=\"media\">

										<a class=\"pull-left\" href=\"#\">
											<img class=\"media-object comment-avatar\" src=\"images/blog/avater-4.jpg\" alt=\"\" width=\"50\" height=\"50\" />
										</a>

										<div class=\"media-body\">

											<div class=\"comment-info\">
												<div class=\"comment-author\">
													<a href=\"#\">Jonathon Andrew</a>
												</div>
												<time datetime=\"2013-04-06T13:53\">July 02, 2015, at 11:34</time>
												<a class=\"comment-button\" href=\"#\"><i class=\"tf-ion-chatbubbles\"></i>Reply</a>
											</div>

											<p>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at magna ut ante eleifend eleifend. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni natus, nostrum iste non delectus atque ab a accusantium optio, dolor!
											</p>

										</div>

									</li>
									<!-- End Comment Item -->

									<!-- Comment Item start-->
									<li class=\"media\">

										<a class=\"pull-left\" href=\"#\">
											<img class=\"media-object comment-avatar\" src=\"images/blog/avater-1.jpg\" alt=\"\" width=\"50\" height=\"50\">
										</a>

										<div class=\"media-body\">

											<div class=\"comment-info\">
												<div class=\"comment-author\">
													<a href=\"#\">Jonathon Andrew</a>
												</div>
												<time datetime=\"2013-04-06T13:53\">July 02, 2015, at 11:34</time>
												<a class=\"comment-button\" href=\"#\"><i class=\"tf-ion-chatbubbles\"></i>Reply</a>
											</div>

											<p>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at magna ut ante eleifend eleifend.
											</p>

										</div>

									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
";
?>
<section class="single-product">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li><a href="products.php">Shop</a></li>
					<li class="active">Single Product</li>
				</ol>
			</div>
			<div class="col-md-6">
				<ol class="product-pagination text-right">
					<li><a href="#"><i class="tf-ion-ios-arrow-left"></i> Next </a></li>
					<li><a href="#">Preview <i class="tf-ion-ios-arrow-right"></i></a></li>
				</ol>
			</div>
		</div>
		<div class="row mt-20">
			<div class="col-md-5">
				<div class="single-product-slider">
					<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
						<div class='carousel-outer'>
							<!-- me art lab slider -->
							<div class='carousel-inner '>
								<div class='item active'>
									<img src= alt='' data-zoom-image="images/shop/single-products/product-1.jpg" />
								</div>
								<div class='item'>
									<img src='images/shop/single-products/product-2.jpg' alt='' data-zoom-image="images/shop/single-products/product-2.jpg" />
								</div>

								<div class='item'>
									<img src='images/shop/single-products/product-3.jpg' alt='' data-zoom-image="images/shop/single-products/product-3.jpg" />
								</div>
								<div class='item'>
									<img src='images/shop/single-products/product-4.jpg' alt='' data-zoom-image="images/shop/single-products/product-4.jpg" />
								</div>
								<div class='item'>
									<img src='images/shop/single-products/product-5.jpg' alt='' data-zoom-image="images/shop/single-products/product-5.jpg" />
								</div>
								<div class='item'>
									<img src='images/shop/single-products/product-6.jpg' alt='' data-zoom-image="images/shop/single-products/product-6.jpg" />
								</div>

							</div>

							<!-- sag sol -->
							<a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
								<i class="tf-ion-ios-arrow-left"></i>
							</a>
							<a class='right carousel-control' href='#carousel-custom' data-slide='next'>
								<i class="tf-ion-ios-arrow-right"></i>
							</a>
						</div>

						<!-- thumb -->
						<ol class='carousel-indicators mCustomScrollbar meartlab'>
							<li data-target='#carousel-custom' data-slide-to='0' class='active'>
								<img src='images/shop/single-products/product-1.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='1'>
								<img src='images/shop/single-products/product-2.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='2'>
								<img src='images/shop/single-products/product-3.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='3'>
								<img src='images/shop/single-products/product-4.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='4'>
								<img src='images/shop/single-products/product-5.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='5'>
								<img src='images/shop/single-products/product-6.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='6'>
								<img src='images/shop/single-products/product-7.jpg' alt='' />
							</li>
						</ol>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="single-product-details">
					<h2>Eclipse Crossbody</h2>
					<p class="product-price">$300</p>

					<p class="product-description mt-20">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum ipsum dicta quod, quia doloremque aut deserunt commodi quis. Totam a consequatur beatae nostrum, earum consequuntur? Eveniet consequatur ipsum dicta recusandae.
					</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, velit, sunt temporibus, nulla accusamus similique sapiente tempora, at atque cumque assumenda minus asperiores est esse sequi dolore magnam. Debitis, explicabo.</p>
					<div class="color-swatches">
						<span>color:</span>
						<ul>
							<li>
								<a href="" class="swatch-violet"></a>
							</li>
							<li>
								<a href="" class="swatch-black"></a>
							</li>
							<li>
								<a href="" class="swatch-cream"></a>
							</li>
						</ul>
					</div>
					<div class="product-size">
						<span>Size:</span>
						<select class="form-control">
							<option>S</option>
							<option>M</option>
							<option>L</option>
							<option>XL</option>
						</select>
					</div>
					<div class="product-quantity">
						<span>Quantity:</span>
						<div class="product-quantity-slider">
							<input id="product-quantity" type="text" value="0" name="product-quantity">
						</div>
					</div>
					<div class="product-category">
						<span>Categories:</span>
						<ul>
							<li><a href="#">Products</a></li>
							<li><a href="#">Soap</a></li>
						</ul>
					</div>
					<a href="shoppingcart.php" class="btn btn-main mt-20">Add To Cart</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="tabCommon mt-20">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#details" aria-expanded="true">Details</a></li>
						<li class=""><a data-toggle="tab" href="#reviews" aria-expanded="false">Reviews (3)</a></li>
					</ul>
					<div class="tab-content patternbg">
						<div id="details" class="tab-pane fade active in">
							<h4>Product Description</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut per spici</p>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis delectus quidem repudiandae veniam distinctio repellendus magni pariatur molestiae asperiores animi, eos quod iusto hic doloremque iste a, nisi iure at unde molestias enim fugit, nulla voluptatibus. Deserunt voluptate tempora aut illum harum, deleniti laborum animi neque, praesentium explicabo, debitis ipsa?</p>
						</div>
						<div id="reviews" class="tab-pane fade">
							<div class="post-comments">
								<ul class="media-list comments-list m-bot-50 clearlist">
									<!-- Comment Item start-->
									<li class="media">

										<a class="pull-left" href="#">
											<img class="media-object comment-avatar" src="images/blog/avater-1.jpg" alt="" width="50" height="50" />
										</a>

										<div class="media-body">
											<div class="comment-info">
												<h4 class="comment-author">
													<a href="#">Jonathon Andrew</a>

												</h4>
												<time datetime="2013-04-06T13:53">July 02, 2015, at 11:34</time>
												<a class="comment-button" href="#"><i class="tf-ion-chatbubbles"></i>Reply</a>
											</div>

											<p>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at magna ut ante eleifend eleifend.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod laborum minima, reprehenderit laboriosam officiis praesentium? Impedit minus provident assumenda quae.
											</p>
										</div>

									</li>
									<!-- End Comment Item -->

									<!-- Comment Item start-->
									<li class="media">

										<a class="pull-left" href="#">
											<img class="media-object comment-avatar" src="images/blog/avater-4.jpg" alt="" width="50" height="50" />
										</a>

										<div class="media-body">

											<div class="comment-info">
												<div class="comment-author">
													<a href="#">Jonathon Andrew</a>
												</div>
												<time datetime="2013-04-06T13:53">July 02, 2015, at 11:34</time>
												<a class="comment-button" href="#"><i class="tf-ion-chatbubbles"></i>Reply</a>
											</div>

											<p>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at magna ut ante eleifend eleifend. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni natus, nostrum iste non delectus atque ab a accusantium optio, dolor!
											</p>

										</div>

									</li>
									<!-- End Comment Item -->

									<!-- Comment Item start-->
									<li class="media">

										<a class="pull-left" href="#">
											<img class="media-object comment-avatar" src="images/blog/avater-1.jpg" alt="" width="50" height="50">
										</a>

										<div class="media-body">

											<div class="comment-info">
												<div class="comment-author">
													<a href="#">Jonathon Andrew</a>
												</div>
												<time datetime="2013-04-06T13:53">July 02, 2015, at 11:34</time>
												<a class="comment-button" href="#"><i class="tf-ion-chatbubbles"></i>Reply</a>
											</div>

											<p>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at magna ut ante eleifend eleifend.
											</p>

										</div>

									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="products related-products section">
	<div class="container">
		<div class="row">
			<div class="title text-center">
				<h2>Related Products</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="product-item">
					<div class="product-thumb">
						<span class="bage">Sale</span>
						<img class="img-responsive" src="images/shop/products/product-5.jpg" alt="product-img" />
						<div class="preview-meta">
							<ul>
								<li>
									<span  data-toggle="modal" data-target="#product-modal">
										<i class="tf-ion-ios-search"></i>
									</span>
								</li>
								<li>
									<a href="#" ><i class="tf-ion-ios-heart"></i></a>
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
			<div class="col-md-3">
				<div class="product-item">
					<div class="product-thumb">
						<img class="img-responsive" src="images/shop/products/product-1.jpg" alt="product-img" />
						<div class="preview-meta">
							<ul>
								<li>
									<span  data-toggle="modal" data-target="#product-modal">
										<i class="tf-ion-ios-search-strong"></i>
									</span>
								</li>
								<li>
									<a href="#" ><i class="tf-ion-ios-heart"></i></a>
								</li>
								<li>
									<a href=""><i class="tf-ion-android-cart"></i></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="product-content">
						<h4><a href="product-single.html">Rainbow Shoes</a></h4>
						<p class="price">$200</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="product-item">
					<div class="product-thumb">
						<img class="img-responsive" src="images/shop/products/product-2.jpg" alt="product-img" />
						<div class="preview-meta">
							<ul>
								<li>
									<span  data-toggle="modal" data-target="#product-modal">
										<i class="tf-ion-ios-search"></i>
									</span>
								</li>
								<li>
									<a href="#" ><i class="tf-ion-ios-heart"></i></a>
								</li>
								<li>
									<a href=""><i class="tf-ion-android-cart"></i></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="product-content">
						<h4><a href="product-single.html">Strayhorn SP</a></h4>
						<p class="price">$230</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="product-item">
					<div class="product-thumb">
						<img class="img-responsive" src="images/shop/products/product-3.jpg" alt="product-img" />
						<div class="preview-meta">
							<ul>
								<li>
									<span  data-toggle="modal" data-target="#product-modal">
										<i class="tf-ion-ios-search"></i>
									</span>
								</li>
								<li>
									<a href="#" ><i class="tf-ion-ios-heart"></i></a>
								</li>
								<li>
									<a href=""><i class="tf-ion-android-cart"></i></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="product-content">
						<h4><a href="product-single.html">Bradley Mid</a></h4>
						<p class="price">$200</p>
					</div>
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBItRd4sQ_aXlQG_fvEzsxvuYyaWnJKETk&callback=initMap"></script>

<!-- Main Js File -->
<script src="../js/script.js"></script>



</body>
</html>
