<?php
session_start();
if (isset($_GET['id'])&& isset($_SESSION['userid'])) {
	$id = $_GET['id'];
	$usrid = $_SESSION['userid'];

	$db = new mysqli("localhost:8889", "root", "test123", "carscars");
	if ($db->connect_error) {
		echo("Unable to connect to the database" . $db->connect_error);
	}

	if (!$result = $db->query("SELECT * FROM orders
inner join order_adress on orders.id = order_adress.orderid
inner join order_items on orders.id = order_items.orderid
 where order_adress.usrid=" . $usrid . " and order_adress.orderid =" . $id . "")) {
		echo("There was an error connecting to the db");
	}
	while ($order = $result->fetch_assoc()) {
		if ($order === NULL) {
			echo "Not so fast there! You should not be here..";
		} else {
			$final_order[] = array(
				'orderid' => $order ['orderid'],
				'productid' => $order ['productid'],
				'quantity' => $order['quantity'],
				'total' => $order ['total'],
				'email' => $order ['email'],
				'firstname' => $order ['firstname'],
				'lastname' => $order ['lastname'],
				'adress' => $order ['adress'],
				'zip' => $order ['zip'],
				'city' => $order ['city']
			);
		}
	}

	foreach ($final_order as $final){
		$productid = $final['productid'];
		$quantity = $final['quantity'];

		if (!$result = $db->query("select * from products WHERE id = $productid")) {
			echo("There was an error connecting to the db");
		}
		while ($car = $result->fetch_assoc()) {
			if ($car === NULL) {
				echo "Not so fast there! You should not be here..";
			} else {
				$cars[$productid] = array(
					'brand' => $car ['brand'],
					'model' => $car ['model'],
					'description' => $car['description'],
					'price' => $car ['price'],
					'type' => $car ['type'],
					'imgRef' => $car ['imgRef'],
					'quantity' => $quantity,
					'color' => $car['color'],
				);
			}
		}
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
<style>
	#customers {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	#customers td, #customers th {
		border: 1px solid #ddd;
		padding: 8px;
	}

	#customers tr:nth-child(even){background-color: #f2f2f2;}

	#customers tr:hover {background-color: #ddd;}

	#customers th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #4CAF50;
		color: white;
	}
</style>
<body class="w3-content" style="max-width:1200px">
<?php
include_once './templates/sidebar.php';
include_once './templates/header.php';


foreach ($cars as $car){


	switch ($car['color']){
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
		<img src='".$car['imgRef']."' alt=\"\" style=\"width:100%\" class=\"w3-hover-opacity\">
		<div class=\"w3-container w3-white\">
			<p><b>".$car['brand']. " " . $car['model']."</b></p>
			<p><b>".$car['price']." $"."</b></p>
			<p><b>".$car['quantity']."</b></p>
			<p class='w3-btn' style='background-color: #".$colorstyle."'><b></b></p>
			<p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
		</div>
	</div>";
}



echo "
<style>
table, th, td {
    border: 1px solid black;
}
</style>
	<table id='customers' style='margin-bottom: 30%';>";
echo "

		<tr>
			<td> BestellNr.: </td>
			<td> " . $final_order[0]['orderid'] . "</td></tr>
			<tr>
			<td>Total: </td>
			<td>" . $final_order[0]['total'] . "</td></tr>
		<tr>
			<td> Email: </td>
			<td>" . $final_order[0]['email'] . "</td></tr>
			<tr>
			<td> Vorname: </td>
			<td>" . $final_order[0]['firstname'] . "</td></tr>
			<tr>
			<td> Nachname: </td>
			<td>" . $final_order [0]['lastname'] . "</td></tr>
			<tr>
			<td>Adresse: </td>
			<td>" . $final_order[0]['adress'] . "</td></tr>
			<tr>
			<td> Stadt:</td>
			<td>" . $final_order[0]['city'] . "</td></tr>
			<tr>
			<td> Postleihzahl:</td>
			<td> " . $final_order[0]['zip'] . "</td></tr>
	</table>
		";

?>
<div style="margin-top: 5%;">
<?php include_once "./templates/footer.php" ?>
</div>
<!-- End page content -->	</div>
</body>
</html>


