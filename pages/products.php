<?php
session_start();
	echo "<a style='margin-top: 30px;' href='?SUV=1'> SUV </a>";

	if (isset($_GET['SUV'])){
		$sort = 'SUV';
	}

	$db = new mysqli("localhost:8889", "root", "test123", "carscars");
	if ($db->connect_error) {
		echo("Unable to connect to the database" . $db->connect_error);
	}

	if (!$result = $db->query("SELECT * FROM products;")) {
		echo("There was an error connecting to the db");
	}
	while ($car = $result->fetch_assoc()) {
		if ($sort != NULL) {
			if ($car['type'] == $sort) {
				$products[$car['id']] = array(
					'brand' => $car ['brand'],
					'model' => $car ['model'],
					'price' => $car ['price'],
					'type' => $car['type'],
					'imgRef' => $car['imgRef']
				);
			}
		}
		else {
			$products[$car['id']] = array(
				'brand' => $car ['brand'],
				'model' => $car ['model'],
				'price' => $car ['price'],
				'type' => $car['type'],
				'imgRef' => $car['imgRef']
			);
		}
	}
	$db->close();
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

	<title>Cars</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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

			</div>

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
					<h1 class="page-name">Shop</h1>
					<ol class="breadcrumb">
						<li><a href="#">Home</a></li>
						<li class="active">shop</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="products section">
	<div class="container">
		<div class="row">

<?php
foreach ($products as $id => $product) {
	echo '	<div class="col-md-4">
				<div class="product-item">
					<div class="product-thumb">
						<span class="bage">Sale</span>
						<img class="img-responsive" src='.$product['imgRef'].' alt="product-img" />
						<div class="preview-meta">
							<ul>
								<li>
									<a href="item.php?id='.$id.'">
										<i class="glyphicon glyphicon-search"></i>
									</a>
								</li>
								<li>
									<a href="shoppingcart.php"><i class="glyphicon glyphicon-shopping-cart"></i></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="product-content">
						<h4><a href="item.php?id='.$id.'">'.$product['model'].'</a></h4>
						<p class="price">'.$product['price']."$".'</p>
					</div>
				</div>
			</div>';
}
?>


		</div>
	</div>
</section>



<?php
include_once 'footer.php';
?>




<script src="https://code.jquery.com/jquery-git.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/slick-carousel/slick/slick.min.js"></script>

<!-- Main Js File -->
<script src="../js/script.js"></script>



</body>
</html>

