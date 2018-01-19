<?php
session_start();

require_once 'autoloader.php';

if (!DB::create('localhost', 'root', 'test123', 'CARSCARS')) {
	die("Unable to connect to database [".DB::getInstance()->connect_error."]");
}

$lang = $_SESSION['lang'];

$_SESSION['lang'] = 'en';

$products = Product::getProducts();
if (isset($_GET['brand'])) {
	$brand = $_GET['brand'];

 $products = Product::getProductsbyBrand($brand);
}

if (isset($_GET['type'])) {
	$type = $_GET['type'];
	$products = Product::getProductsbyType($type);
}


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<title>Cars</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="script" href="./js/script.js">
<style>
	.w3-sidebar a {
		font-family: "Roboto", sans-serif
	}

	body, h1, h2, h3, h4, h5, h6, .w3-wide {
		font-family: "Montserrat", sans-serif;
	}
</style>
<body class="w3-content" style="max-width:1200px">
<!-- Sidebar/menu -->
<?php include_once './templates/sidebar.php' ?>

<?php include_once './templates/header.php'; ?>

<?php if (!isset($_GET['brand'])){

?>
<!-- Image header -->
<div class="w3-display-container w3-container">
	<img src="../src/background.jpg" alt="" style="width:100%">
	<div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
		<h1 class="w3-jumbo w3-hide-small"><?php $txt = array('en' => 'New Models',
				'de' => 'Neue Modelle'); echo $txt[$lang];?></h1>
		<h1 class="w3-hide-large w3-hide-medium">Mustang GT</h1>
		<h1 class="w3-hide-small">2018</h1>
		<p><a href="#cars" class="w3-button w3-black w3-padding-large w3-large"><?php $txt = array('en' => 'Shop Now!',
					'de' => 'Kaufen!'); echo $txt[$lang];?></a></p>
	</div>
</div>
<?php }?>
<div class="w3-container w3-text-grey" id="cars">
	<?php echo "<p> " . count($products) . " Items" . " </p>" ?>
</div>
<!-- Product grid -->
<div class="w3-row w3-grayscale">
	<?php

	foreach ($products as $product) {
		echo " <div class='w3-col l3 s6'>
		<div class='w3-container'>
			<div class='w3-display-container'>
				<img src='".$product->getImgRef()."' style='width:100%'>
				<span class='w3-tag w3-display-topleft'>Sale</span>
				<div class='w3-display-middle w3-display-hover'>
					<a href='item.php?id=" . $product->getId() . "' class='w3-button w3-black'>Buy now <i class='fa fa-shopping-cart'></i></a>
				</div>
			</div>
		<a style='text-decoration:none;' href='item.php?id=" . $id . "'>
		<p>" . $product->getBrand(). ' ' . $product->getModel() . "<br><b class='w3-text-red'>" . $product->getPrice() . ' $' . "</b></p>
		</a>
		</div>
	</div>";
	} ?>
</div>
<?php if (!isset($_GET['brand'])) {

	?>
	<!-- Subscribe section -->
	<div class="w3-container w3-black w3-padding-32">
		<h1><?php $txt = array('en' => 'Subscribe',
				'de' => 'Abonnieren'); echo $txt[$lang];?></h1>
		<p><?php $txt = array('en' => 'To get special offers:',
				'de' => 'Um einzigartige Angebote zu erhalten schreiben Sie sich in unserem Newsletter ein'); echo $txt[$lang];?></p>
		<form action="processNewsletter.php" method="post"><p><input class="w3-input w3-border" required type="email" placeholder="Enter e-mail" name="email" style="width:100%"></p>
			<button class="w3-btn w3-red"> Subscribe! </button>
		</form>
	</div>
	<?php
}
include_once "./templates/footer.php";
?>
<!-- End page content --></div>
<!-- Newsletter Modal -->
<div id="newsletter" class="w3-modal">
	<div class="w3-modal-content w3-animate-zoom" style="padding:32px">
		<div class="w3-container w3-white w3-center">
			<i onclick="document.getElementById('newsletter').style.display='none'" class="fa fa-remove w3-right w3-button w3-transparent w3-xxlarge"></i>
			<h2 class="w3-wide">NEWSLETTER</h2>
			<p>Join our mailing list to receive updates on new arrivals and special offers.</p>
			<form action="./processNewsletter.php" method="post">
			<p><input class="w3-input w3-border" type="email" placeholder="Enter e-mail" required name="email"></p>
				<button class="w3-btn w3-red"> Subscribe! </button>
			</form>
		</div>
	</div>
</div>
</body>
</html>
