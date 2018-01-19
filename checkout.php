<?php
require_once 'autoloader.php';
require_once './helper/cart.php';
session_start();
if (!isset($_SESSION["cart"])) {
	$_SESSION["cart"] = new Cart();
}
// Get cart from session
$cart = $_SESSION["cart"];
$usrid = $_SESSION['userid'];


if (!DB::create('localhost', 'root', 'test123', 'CARSCARS')) {
	die("Unable to connect to database [" . DB::getInstance()->connect_error . "]");
}

$person = User::getUserbyId($usrid);
if ($person == NULL) {
	header("Location: ./login.php");
}
foreach ($cart->getItems() as $item => $num) {
	// Get product information
	$items[$item] = $num;
	$ids[] = $item;
}

$products = Product::getProductsbyIds($ids);
foreach ($products as $product) {
	$final_total = $final_total + $product->getPrice() * $items[$product->getId()];
}

if (isset($_GET['checkout'])) {
	$res = DB::doQuery("Insert into orders (usrid, total) VALUES ('$usrid','$final_total')");

	$email = $_POST['email'];
	$surname = $_POST['surname'];
	$lastname = $_POST['lastname'];
	$adress = $_POST['adress'];
	$zip = $_POST['zip'];
	$city = $_POST['city'];
	$order = Order::getLastOrder($usrid);
	$order = $order[0];
	$final_id = $order->getId();
	foreach ($products as $product) {
		$productid = $product->getId();
		$quantity = $items[$product->getId()];
		DB::doQuery("Insert into order_items (usrid, productid,orderid, quantity) VALUES ('$usrid','$productid','$final_id','$quantity')");
	}

	DB::doQuery("Insert into order_adress (usrid, orderid, email, firstname, lastname, adress, zip, city) Values ('$usrid', '$final_id', '$email','$surname','$lastname','$adress','$zip','$city')");
	$cart->removeAllItems();
	//Redirect to other page so no reload error
	header("Location: ./index.php");
}
?>
<!DOCTYPE html>
<html>
<title>Cars</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
<?php
include_once './templates/sidebar.php';
include_once './templates/header.php';

?>
<div class="w3-row-padding">
	<?php
	foreach ($products as $product) {


		switch ($product->getColor()) {
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
			<p class='w3-btn' style='background-color: #" . $colorstyle . "'><b></b></p>
			<p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
			
		</div>
	</div>";
	}

	?>
</div>
<?php
if (!isset($_GET['checkout'])) {
	echo "<div style='display: block' class='w3-btn w3-green'>Total: $final_total$</div>";
	?>
	Please Check your credentials:
	<form action="?checkout=1" method="post">
		E-Mail:<br> <input type="email" size="40" maxlength="250" value="<?php echo $person->getEmail(); ?>" name="email"><br> Vorname: <br>
		<input type="text" size="40" maxlength="250" name="surname" value="<?php echo $person->getVorname(); ?>"><br> Nachname: <br>
		<input type="text" size="40" maxlength="250" name="lastname" value="<?php echo $person->getNachname(); ?>"><br> Adresse: <br>
		<input type="text" size="40" name="adress" value="<?php echo $person->getAdress(); ?>"> <br> Postleihzahl: <br>
		<input type="number" size="40" maxlength="250" name="zip" value="<?php echo $person->getZip(); ?>"> <br> Ort: <br>
		<input type="text" size="40" maxlength="250" name="city" value="<?php echo $person->getCity(); ?>"> <br>
		<input class="w3-btn w3-green" type="submit" value="Abschicken">
	</form>
	<?php
}
?>
<?php include_once "./templates/footer.php" ?>
<!-- End page content -->    </div>
</body>
</html>