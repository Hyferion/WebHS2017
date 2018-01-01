<?php
session_start();
?>
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
	<?php //include 'navigation.php'; ?>
</header>
<main>
	<?php
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

	echo "
	<table style='margin-top: 50px'>";
	foreach ($products as $id => $product) {
		echo "
		<tr>
			<td><a href='./item.php?id=$id'> Marke: " . $product['brand'] . "</a></td>
			<td>Model: " . $product['model'] . "</td>
			<td>Kategorie: " . $product['type'] . "</td>
			.
			<td>Preis: " . $product['price'] . "</td>
			<td> <img src=".$product['imgRef']." style='width:256px; height:256px;'> </td>
		</tr>
		";
	}
	echo "
	</table>
	";
	?>
</main>
<footer>
	<?php include 'footer.php'; ?>
</footer>
</body>
</html>
