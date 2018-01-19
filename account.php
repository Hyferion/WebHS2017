<?php session_start();
if (!isset($_SESSION['userid'])) {
	header("Location: ./login.php");
}

$usrid = $_SESSION['userid'];
$db = new mysqli("localhost", "root", "test123", "carscars");
if ($db->connect_error) {
	echo("Unable to connect to the database" . $db->connect_error);
}

if (isset($_GET['edit'])){
	$edit = true;
}

if(isset($_GET['edited'])){
	$email = test_input($_POST['email']);
	$surname = test_input($_POST['surname']);
	$lastname = test_input($_POST['lastname']);
	$adress = test_input($_POST['adress']);
	$zip = test_input($_POST['zip']);
	$city = test_input($_POST['city']);



	if (!$result = $db->query("UPDATE users set email = '$email', vorname = '$surname' , nachname = '$lastname', adress = '$adress', zip = '$zip', city = '$city' WHERE id = $usrid")) {
		echo("There was an error connecting to the db");
	}
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
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
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
<?php include_once "./templates/sidebar.php" ?>
<?php
include_once "./templates/header.php"; ?>
<!-- Product grid -->
<div class="w3-row w3-grayscale">
	<?php
	if ($edit){
		echo "<form class=\"w3-container\" action=\"?edited=1\" method=\"post\">
	<label  class=\"w3-text-black\"><b>Email:</b></label>
	<input style=\"margin-top:3%\" class=\"w3-input w3-border w3-light-grey\" type=\"email\" name=\"email\" value='" . $user['email'] . "'>

	<div style=\"margin-top:3%\"><label  class=\"w3-text-black\"><b>Vorname:</b></label></div>
	<input style=\"margin-top:3%\" class=\"w3-input w3-border w3-light-grey\" type=\"text\" name=\"surname\"  value='" . $user['vorname'] . "'>

	<div style=\"margin-top:3%\"><label  class=\"w3-text-black\"><b>Nachname:</b></label></div>
	<input style=\"margin-top:3%\" class=\"w3-input w3-border w3-light-grey\" type=\"text\" name=\"lastname\"  value='" . $user['nachname'] . "'>

	<div style=\"margin-top:3%\"><label  class=\"w3-text-black\"><b>Adress:</b></label></div>
	<input style=\"margin-top:3%\" class=\"w3-input w3-border w3-light-grey\" type=\"text\" name=\"adress\"  value='" . $user['adress'] . "'>

	<div style=\"margin-top:3%\"><label  class=\"w3-text-black\"><b>ZIP:</b></label></div>
	<input style=\"margin-top:3%\" class=\"w3-input w3-border w3-light-grey\" type=\"number\" name=\"zip\"  value='" . $user['city'] . "'>

	<div style=\"margin-top:3%\"><label  class=\"w3-text-black\"><b>City:</b></label></div>
	<input style=\"margin-top:3%\" class=\"w3-input w3-border w3-light-grey\" type=\"text\" name=\"city\"  value='" . $user['zip'] . "'>

	<input style=\"margin-top:3%\" class=\"w3-btn w3-black\" type=\"submit\" value=\"Update\">
</form>";
	}
	else{

	echo "
<a style='text-decoration:none;' href='account.php?edit'>
	<table style='margin-top: 50px'>
	<h4>Click to edit!</h4>";
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
	</table></a>
		";}
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
<?php include_once "./templates/footer.php" ?>
<!-- End page content -->	</div>
</body>
</html>
