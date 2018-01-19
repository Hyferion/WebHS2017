<?php
session_start();

if(isset($_GET['register'])) {
	$error = false;
	$email = $_POST['email'];
	$passwort = $_POST['passwort'];
	$passwort2 = $_POST['passwort2'];
	$surname = $_POST['surname'];
	$lastname = $_POST['lastname'];
	$adress = $_POST['adress'];
	$zip = $_POST['zip'];
	$city = $_POST['city'];

	$db = new mysqli("localhost", "root", "test123", "CARSCARS");
	if ($db->connect_error) {
		echo("Unable to connect to the database" . $db->connect_error);
	}

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errormsg = 'Bitte eine gültige E-Mail-Adresse eingeben';
		$error = true;
	}
	if(strlen($passwort) == 0) {
		$errormsg = 'Bitte ein Passwort angeben';
		$error = true;
	}
	if($passwort != $passwort2) {
		$errormsg = 'Die Passwörter müssen übereinstimmen';
		$error = true;
	}


	//Keine Fehler, wir können den Nutzer registrieren
	if(!$error) {
		$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);


		$sql = "INSERT INTO users (email, passwort,vorname,nachname,adress,zip,city) VALUES ('$email','$passwort_hash','$surname','$lastname','$adress',$zip,'$city')";


		if(!$result = $db->query($sql)) {
			echo("There was an error connecting to the db");
		} else {
			header("Location: ./login.php?registered");
			$showFormular = false;
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
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="script" href="./js/script.js">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="script" href="./js/script.js">
<style>
	.w3-sidebar a {
		font-family: "Roboto", sans-serif
	}

	body, h1, h2, h3, h4, h5, h6, .w3-wide {
		font-family: "Montserrat", sans-serif;
	}
</style>
<body class="w3-content" style="max-width:1200px">
<!-- Sidebar/menu -->
<?php include_once './templates/sidebar.php' ?>

<?php include_once './templates/header.php'; ?>

<div style="margin:2%" class="w3-container w3-black">
	<h2>Please Register to continue</h2>
</div>
<div style="margin:2%">
<?php

echo $errormsg;
?>
</div>
<form class="w3-container" action="?register=1" method="post">
	<label  class="w3-text-black"><b>Email:</b></label>
	<input style="margin-top:3%" class="w3-input w3-border w3-light-grey" type="email" name="email">

	<div style="margin-top:3%"><label  class="w3-text-black"><b>Password:</b></label></div>
	<input style="margin-top:3%" class="w3-input w3-border w3-light-grey" type="password" name="passwort">

	<div style="margin-top:3%"><label  class="w3-text-black"><b>Passwort wiederholen:</b></label></div>
	<input style="margin-top:3%" class="w3-input w3-border w3-light-grey" type="password" name="passwort2">

	<div style="margin-top:3%"><label  class="w3-text-black"><b>Vorname:</b></label></div>
	<input style="margin-top:3%" class="w3-input w3-border w3-light-grey" type="text" name="surname">

	<div style="margin-top:3%"><label  class="w3-text-black"><b>Nachname:</b></label></div>
	<input style="margin-top:3%" class="w3-input w3-border w3-light-grey" type="text" name="lastname">

	<div style="margin-top:3%"><label  class="w3-text-black"><b>Adress:</b></label></div>
	<input style="margin-top:3%" class="w3-input w3-border w3-light-grey" type="text" name="adress">

	<div style="margin-top:3%"><label  class="w3-text-black"><b>ZIP:</b></label></div>
	<input style="margin-top:3%" class="w3-input w3-border w3-light-grey" type="number" name="zip">

	<div style="margin-top:3%"><label  class="w3-text-black"><b>City:</b></label></div>
	<input style="margin-top:3%" class="w3-input w3-border w3-light-grey" type="text" name="city">

	<input style="margin-top:3%" class="w3-btn w3-black" type="submit" value="Register">
	<a style="margin-top:3%" href="login.php" class="w3-btn w3-black"> Login </a>
</form>





<?php
include_once "./templates/footer.php";
?>
</body>
</html>