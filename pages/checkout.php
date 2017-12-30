<?php
require_once '../cart.php';
session_start();
if (!isset($_SESSION["cart"])) {
	$_SESSION["cart"] = new Cart();
}
// Get cart from session
$cart = $_SESSION["cart"];
$usrid = $_SESSION['userid'];

$db = new mysqli("localhost:8889", "root", "test123", "carscars");
if ($db->connect_error) {
	echo("Unable to connect to the database" . $db->connect_error);
}
$sql = "Select * from users where id = " . $usrid . "";
if (!$result = $db->query($sql)) {
	echo("There was an error connecting to the db");
}
while ($persons = $result->fetch_assoc()) {
	$person = array(
		'email' => $persons ['email'],
		'firstname' => $persons ['vorname'],
		'lastname' => $persons ['nachname'],
		'adress' => $persons['adress'],
		'zip' => $persons['zip'],
		'city' => $persons['city'],
	);
}
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
		'type' => $car['type']
	);
}
foreach ($products as $product) {
	$final_items .= $product['brand'] . " -- " . $product['model'] . " -- " . $product['price'] . " -- " . $items[$product['id']]."//";
	$final_total = $final_total + $product['price'] * $items[$product['id']];
}

if (isset($_GET['checkout'])) {
	$sql = "Insert into orders (usrid, items, total) VALUES ('$usrid','$final_items','$final_total')";
	if (!$result = $db->query($sql)) {
		echo("There was an error connecting to the db");
	}
	else {
		$email = $_POST['email'];
		$surname = $_POST['surname'];
		$lastname = $_POST['lastname'];
		$adress = $_POST['adress'];
		$zip = $_POST['zip'];
		$city = $_POST['city'];

		$sql = "Select id from orders where usrid = ".$usrid." order by created_at desc limit 1";

		if (!$result = $db->query($sql)) {
			echo("There was an error connecting to the db");
		}
		$id = $result->fetch_assoc();
		$final_id = $id['id'];

		$sql = "Insert into order_adress (usrid, orderid, email, firstname, lastname, adress, zip, city) Values ('$usrid', '$final_id', '$email','$surname','$lastname','$adress','$zip','$city')";
		if (!$result = $db->query($sql)) {
			echo("There was an error connecting to the db");
		}
		//Redirect to other page so no reload error
		header("Location: ./index.php");
		//$cart->removeAllItems();
	}

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/w3c.css"/>
	<title> Cars & Cars </title>
</head>
<body style="margin-top: 60px">
<?php
include_once 'navigation.php';
$total = 0;
foreach ($products as $product) {
	echo $product['brand'] . " -- " . $product['model'] . " -- " . $product['price'] . " -- " . $items[$product['id']] . "</br></br>";
	$total = $total + $product['price'] * $items[$product['id']];
}
echo "Total: " . $total . "</br>";

$db->close();

if (!isset($_GET['checkout'])){
?>
Please Check your credentials:
<form action="?checkout=1" method="post">
	E-Mail:<br> <input type="email" size="40" maxlength="250" value="<?php echo $person['email']; ?>" name="email"><br> Vorname: <br>
	<input type="text" size="40" maxlength="250" name="surname" value="<?php echo $person['firstname']; ?>"><br> Nachname: <br>
	<input type="text" size="40" maxlength="250" name="lastname" value="<?php echo $person['lastname']; ?>"><br> Adresse: <br>
	<input type="text" size="40" name="adress" value="<?php echo $person['adress']; ?>"> <br> Postleihzahl: <br>
	<input type="number" size="40" maxlength="250" name="zip" value="<?php echo $person['zip']; ?>"> <br> Ort: <br>
	<input type="text" size="40" maxlength="250" name="city" value="<?php echo $person['city']; ?>"> <br> <input type="submit" value="Abschicken">
</form>
<?php
}
?>
</body>
</html>