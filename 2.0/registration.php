<?php
session_start();

$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

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

	$db = new mysqli("localhost:8889", "root", "test123", "carscars");
	if ($db->connect_error) {
		echo("Unable to connect to the database" . $db->connect_error);
	}

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
		$error = true;
	}
	if(strlen($passwort) == 0) {
		echo 'Bitte ein Passwort angeben<br>';
		$error = true;
	}
	if($passwort != $passwort2) {
		echo 'Die Passwörter müssen übereinstimmen<br>';
		$error = true;
	}
	/*
	//Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
	if(!$error) {
		$statement = $db->prepare("SELECT * FROM users WHERE email =".$email);
		$result = $statement->execute(array('email' => $email));
		$user = $statement->fetch();


		if($user !== false) {
			echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
			$error = true;
		}
	}*/

	//Keine Fehler, wir können den Nutzer registrieren
	if(!$error) {
		$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);


		$sql = "INSERT INTO users (email, passwort,vorname,nachname,adress,zip,city) VALUES ('$email','$passwort_hash','$surname','$lastname','$adress','$zip','$city')";


		if(!$result = $db->query($sql)) {
			echo("There was an error connecting to the db");
		} else {
			echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
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
<!-- Sidebar/menu -->
<?php include_once 'sidebar.php' ?>

<?php include_once 'header.php'; ?>

<div style="margin:2%" class="w3-container w3-black">
	<h2>Please Register to continue</h2>
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
include_once "footer.php";
?>
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