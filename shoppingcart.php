<?php
require_once './helper/cart.php';
require_once 'autoloader.php';
// Start session
session_start();
// Create cart on first request
if (!isset($_SESSION["cart"])) {
	$_SESSION["cart"] = new Cart();
}

// Get cart from session
$cart = $_SESSION["cart"];

if (!DB::create('localhost', 'root', 'test123', 'CARSCARS')) {
	die("Unable to connect to database [".DB::getInstance()->connect_error."]");
}

// ADD ITEM
if (isset($_GET['item_id'])) {
	$itemid = $_GET['item_id'];
	if (isset($_POST['color'])) {
		$color = $_POST['color'];
	}
	$product = Product::getProductById($itemid);
	$productgroupid = $product->getProductgroupid();
	$product = Product::getProductByGroupIdAndColor($productgroupid,$color);
	$id = $product->getId();
	$cart->addItem($id, $_POST["quantity"]);
	header("Location: ./shoppingcart.php");
}
//DELETE ITEM
if (isset($_GET['iddelete'])) {
	$cart->removeItem($_GET['iddelete'], 1);
	header("Location: ./shoppingcart.php");
}
if (!$cart->isEmpty()) {
	foreach ($cart->getItems() as $item => $num) {
		// Get product information
		$items[$item] = $num;
		$ids[] = $item;
	}
}

//DISPLAY ITEMS
$products = Product::getProductsbyIds($ids);
?>
<!DOCTYPE html>
<html>
<title>Cars</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="./css/main.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="script" href="./js/script.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

<?php include "./templates/header.php"; ?>
<div class="w3-row-padding">
	<?php
	foreach ($products as $product) {

		switch ($product->getColor()){
			case 'red':
				$colorstyle = 'E54D42';
				break;
			case 'blue':
				$colorstyle = '3A99D9';
				break;
			case 'green':
				$colorstyle = '39CB74';
				break;
			case 'yellow':
				$colorstyle = 'F0C330';
				break;
		}

		echo "<div class=\"w3-third w3-container w3-margin-bottom\">
		<img src='" . $product->getImgRef() . "' alt=\"\" style=\"width:100%\" class=\"w3-hover-opacity\">
		<div class=\"w3-container w3-white\">
			<p><b>" . $product->getBrand() . " " . $product->getModel() . "</b></p>
			<p><b>" . $product->getPrice() . " $" . "</b></p>
			<p><b>" . $items[$product->getId()] . "</b></p>
			<p class='w3-btn' style='background-color: #".$colorstyle."'><b></b></p>
			<p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
			<a class='w3-btn w3-black' href='shoppingcart.php?iddelete=" . $product->getId() . "'> Delete</a>
		</div>
	</div>";
	}
	if (!$cart->isEmpty()) {
		echo "<a class='w3-btn w3-red' href='checkout.php'> Checkout</a>";
	} else {
		echo "<p> Your cart is empty...";
	}
	?>
</div>
<?php
include_once './templates/footer.php';
?>
<!-- End page content --></div>

</body>
</html>