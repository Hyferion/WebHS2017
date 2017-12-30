<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/w3c.css"/>
	<title> Cars & Cars </title>
</head>

<body>
<header>
	<?php include'navigation.php'; ?>
</header>
<?php
require_once '../cart.php';
// Start session
session_start();
// Create cart on first request
if (!isset($_SESSION["cart"])) {
	$_SESSION["cart"] = new Cart();
}
// Get cart from session
$cart = $_SESSION["cart"];
// Add item on post
if (isset($_GET["item_id"])) {
	$cart->addItem($_GET["item_id"], $_POST["quantity"]);
}



?>
<!DOCTYPE html>
<html>
<head><!-- ... --></head>
<body>
<h4>Your Shopping Cart:</h4>
<?php

// Render cart explicitly to enhence it
if ($cart->isEmpty()) {
	echo "<div class=\"cart empty\">[Empty Cart]</div>";
} else {
	foreach ($cart->getItems() as $item=>$num) {
		// Get product information
		$items[$item] = $num;
		$ids[] = $item;
	}

	$db = new mysqli("localhost:8889", "root", "test123", "carscars");
	if ($db->connect_error) {
		echo("Unable to connect to the database" . $db->connect_error);
	}

	if (!$result = $db->query("SELECT * FROM products WHERE id IN (".implode(',',$ids).")")){
		echo("There was an error connecting to the db");
	}
	while ($car = $result->fetch_assoc()) {
		$products[$car['id']] = array(
			'id' => $car['id'],
			'brand' => $car ['brand'],
			'model' => $car ['model'],
			'price' => $car ['price'],
			'type' => $car['type']
		);
	}
	foreach ($products as $product){
		echo $product['brand']." -- " .$product['model']." -- ".$product['price']." -- ". $items[$product['id']]."</br></br>";
		$total = $total + $product['price']*$items[$product['id']];
	}
	echo "Total: ". $total."</br>";

	$db->close();
}
echo "<a href='./products.php'> Products </a>"
?>
</body>
</html>