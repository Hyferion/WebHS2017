<?php session_start();
if (!isset($_SESSION['userid'])) {
	header("Location: ./login.php");
}

$usrid = $_SESSION['userid'];

$db = new mysqli("localhost:8889", "root", "test123", "carscars");
if ($db->connect_error) {
	echo("Unable to connect to the database" . $db->connect_error);
}

if (!$result = $db->query("SELECT email,vorname,nachname,adress,city,zip FROM users WHERE id =" . $usrid . ";")) {
	echo("There was an error connecting to the db");
}
$user = $result->fetch_assoc();
if (!$result = $db->query("SELECT * FROM CARSCARS.orders
 where usrid=" . $usrid . ";")) {
	echo("There was an error connecting to the db");
}
while ($orders = $result->fetch_assoc()) {
	$order[$orders['id']] = array(
		'items' => $orders ['items'],
		'total' => $orders ['total']
	);
}
$db->close();

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
<nav>
	<header style="margin-top: 50px">
		<?php include 'navigation.php'; ?>
		<container>
			<?php
			echo "
	<table style='margin-top: 50px'>";
			echo "
		<tr>
			<td> Email: " . $user['email'] . "</td></tr>
			<tr>
			<td> Vorname: " . $user['vorname'] . "</td></tr>
			<tr>
			<td> Nachname: " . $user ['nachname'] . "</td></tr>
			<tr>
			<td>Adresse: " . $user['adress'] . "</td></tr>
			<tr>
			<td> Stadt: " . $user['city'] . "</td></tr>
			<tr>
			<td> Postleihzahl: " . $user['zip'] . "</td></tr>
	</table>
		";
			?>
		</container>
		<orders>
			<?php
			echo "
	<table style='margin-top: 50px'>";
			foreach ($order as $id => $orders) {
				echo "
		<tr>
			<td><a href='./order.php?id=$id'> BestellNr.: " . $id . "</a></td>
			<td>Bestellte Autos: " . $orders['items'] . "</td>
			<td>Total: " . $orders['total'] . "</td>
		</tr>
		";
			}
			echo "
	</table>
	";
			?>
		</orders>
	</header>
</nav>
<footer>
	<?php include 'footer.php'; ?>
</footer>
</body>
</html>
