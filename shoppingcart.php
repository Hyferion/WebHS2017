<?php
require_once './cart.php';
// Start session
session_start();
// Create cart on first request
if (!isset($_SESSION["cart"])) {
	$_SESSION["cart"] = new Cart();
}

// Get cart from session
$cart = $_SESSION["cart"];

$db = new mysqli("localhost:8889", "root", "test123", "carscars");
if ($db->connect_error) {
	echo("Unable to connect to the database" . $db->connect_error);
}

// ADD ITEM
if (isset($_GET['item_id'])) {
	$itemid = $_GET['item_id'];

	if (isset($_POST['color'])) {
		$color = $_POST['color'];
	}

	if (!$result = $db->query("SELECT productgroupid FROM products WHERE id = $itemid")) {
		echo("There was an erros connecting to the db");
	}
	$productgroupid = $result->fetch_assoc();
	$productgroupid = $productgroupid['productgroupid'];

	if (!$result = $db->query("SELECT id FROM products WHERE productgroupid = '" . $productgroupid . "' and color = '" . $color . "'")) {
		echo("There was an errors connecting to the db");
	}

	$id = $result->fetch_assoc();
	$id = $id['id'];

	// Add item on post
	$cart->addItem($id, $_POST["quantity"]);
	header("Location: ./shoppingcart.php");

}
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

	if (!$result = $db->query("SELECT * FROM products WHERE id IN (" . implode(',', $ids) . ")")) {
		echo("There was an error connecting to the db");
	}
	while ($car = $result->fetch_assoc()) {
		$products[$car['id']] = array(
			'id' => $car['id'],
			'brand' => $car ['brand'],
			'model' => $car ['model'],
			'price' => $car ['price'],
			'type' => $car['type'],
			'imgRef' => $car['imgRef'],
			'color' => $car ['color'],
		);
	}
}

?>
<!DOCTYPE html>
<html>
<title>Cars</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
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
<?php include_once 'sidebar.php' ?>

<?php include "header.php"; ?>
<div class="w3-row-padding">
	<?php
	foreach ($products as $product) {

		switch ($product['color']){
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
		<img src='" . $product['imgRef'] . "' alt=\"\" style=\"width:100%\" class=\"w3-hover-opacity\">
		<div class=\"w3-container w3-white\">
			<p><b>" . $product['brand'] . " " . $product['model'] . "</b></p>
			<p><b>" . $product['price'] . " $" . "</b></p>
			<p><b>" . $items[$product['id']] . "</b></p>
			<p class='w3-btn' style='background-color: #".$colorstyle."'><b></b></p>
			<p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
			<a class='w3-btn w3-black' href='shoppingcart.php?iddelete=" . $product['id'] . "'> Delete</a>
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
include_once 'footer.php';
?>
<!-- End page content --></div>
<script>
	// Accordion
	function myAccFunc() {
		var x = document.getElementById("demoAcc");
		if (x.className.indexOf("w3-show") == -1) {
			x.className += " w3-show";
		} else {
			x.className = x.className.replace(" w3-show", "");
		}
	}

	// Click on the "Jeans" link on page load to open the accordion for demo purposes
	document.getElementById("myBtn").click();


	// Script to open and close sidebar
	function w3_open() {
		document.getElementById("mySidebar").style.display = "block";
		document.getElementById("myOverlay").style.display = "block";
	}

	function w3_close() {
		document.getElementById("mySidebar").style.display = "none";
		document.getElementById("myOverlay").style.display = "none";
	}
</script>
</body>
</html>