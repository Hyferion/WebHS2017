<?php
require_once './cart.php';
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
	header("Location: ./login.php");
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
	echo("There was an error csonnecting to the db");
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
foreach ($products as $product) {
	$sql = "Insert into order_items (usrid, items, total) VALUES ('$usrid','$final_items','$final_total')";

	$final_total = $final_total + $product['price'] * $items[$product['id']];
}

if (isset($_GET['checkout'])) {
	$sql = "Insert into orders (usrid, total) VALUES ('$usrid','$final_total')";
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


		foreach ($products as $product) {
			$productid = $product['id'];
			$quantity = $items[$product['id']];
			$sql = "Insert into order_items (usrid, productid,orderid, quantity) VALUES ('$usrid','$productid','$final_id','$quantity')";
			if (!$result = $db->query($sql)) {
				echo("There was an error connecting to the db");
			}
		}


		$sql = "Insert into order_adress (usrid, orderid, email, firstname, lastname, adress, zip, city) Values ('$usrid', '$final_id', '$email','$surname','$lastname','$adress','$zip','$city')";
		if (!$result = $db->query($sql)) {
			echo("There was an error connecting to the db");
		}
		$cart->removeAllItems();
		//Redirect to other page so no reload error
		header("Location: ./index.php");
	}

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
include_once 'sidebar.php';
include_once 'header.php';

?>
<div class="w3-row-padding">
	<?php
	foreach ($products as $product){


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
		<img src='".$product['imgRef']."' alt=\"\" style=\"width:100%\" class=\"w3-hover-opacity\">
		<div class=\"w3-container w3-white\">
			<p><b>".$product['brand']. " " . $product['model']."</b></p>
			<p><b>".$product['price']." $"."</b></p>
			<p><b>".$items[$product['id']]."</b></p>
			<p class='w3-btn' style='background-color: #".$colorstyle."'><b></b></p>
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
		E-Mail:<br> <input type="email" size="40" maxlength="250" value="<?php echo $person['email']; ?>" name="email"><br> Vorname: <br>
		<input type="text" size="40" maxlength="250" name="surname" value="<?php echo $person['firstname']; ?>"><br> Nachname: <br>
		<input type="text" size="40" maxlength="250" name="lastname" value="<?php echo $person['lastname']; ?>"><br> Adresse: <br>
		<input type="text" size="40" name="adress" value="<?php echo $person['adress']; ?>"> <br> Postleihzahl: <br>
		<input type="number" size="40" maxlength="250" name="zip" value="<?php echo $person['zip']; ?>"> <br> Ort: <br>
		<input type="text" size="40" maxlength="250" name="city" value="<?php echo $person['city']; ?>"> <br> <input class="w3-btn w3-green" type="submit" value="Abschicken">
	</form>
	<?php
}
?>
<?php include_once "footer.php" ?>
<!-- End page content -->	</div>
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