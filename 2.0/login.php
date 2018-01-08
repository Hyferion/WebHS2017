<?php
session_start();

$db = new mysqli("localhost:8889", "root", "test123", "carscars");
if ($db->connect_error) {
	echo("Unable to connect to the database" . $db->connect_error);
}

if(isset($_GET['login'])) {
	$email = $_POST['email'];
	$passwort = $_POST['passwort'];

	if (!$result = $db->query("SELECT * FROM users WHERE email ='".$email."';")){
		echo("There was an error connecting to the db");
	} else {
		$user = $result->fetch_assoc();

	}

	//Überprüfung des Passworts
	if ($user !== false && password_verify($passwort, $user['passwort'])) {
		$_SESSION['userid'] = $user['id'];

		header("Location: ./account.php");
	} else {
		$errorMessage = "E-Mail oder Passwort war ungültig<br>";
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
	<h2>Please Login to continue</h2>
</div>

<form class="w3-container" action="?login=1" method="post">
	<label  class="w3-text-black"><b>Email:</b></label>
	<input style="margin-top:3%" class="w3-input w3-border w3-light-grey" type="email" name="email">

	<div style="margin-top:3%"><label  class="w3-text-black"><b>Password:</b></label></div>
	<input style="margin-top:3%" class="w3-input w3-border w3-light-grey" type="password" name="passwort">

	<input style="margin-top:3%" class="w3-btn w3-black" type="submit" value="Login">
	<a style="margin-top:3%" href="registration.php" class="w3-btn w3-black"> Register </a>
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