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
<main>
<?php

if(isset($_GET['id'])) {
	$id = $_GET['id'];
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
			'type' => $car['type']
		);
	}
	$db->close();

echo "<table style='margin-top: 50px'>";
	echo "<tr>
		<td> Marke: ".$products[$id]['brand']."</td>
		<td>Model: ".$products[$id]['model']."</td>
		<td>Kategorie: ".$products[$id]['category']."</td>.
		<td>Preis: ".$products[$id]['price']."</td>
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

</main>
<footer>
	<?php include'footer.php'; ?>
</footer>
</body>
</html>
