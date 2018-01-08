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
<?php include_once "sidebar.php" ?>
<?php
include_once "header.php"; ?>
<!-- Product grid -->
<div class="w3-row w3-grayscale">
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

		function random_color_part() {
			return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
		}

		function random_color() {
			return random_color_part() . random_color_part() . random_color_part();
		}
		echo "
	<table style='margin-top: 50px'>";
		foreach ($order as $id => $orders) {
		$var = random_color();
			echo "
		<tr>
			<a style='margin: 2%; background-color: #$var' class='w3-button' href='./order.php?id=$id'> BestellNr.: " . $id . "</a>
		</tr>
		";
		}
		echo "
	</table>
	";
		?>
</div>
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
