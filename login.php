<?php
session_start();
if (isset($_GET['registered'])){
	$registered = true;
}
$db = new mysqli("localhost", "root", "test123", "carscars");
if ($db->connect_error) {
	echo("Unable to connect to the database" . $db->connect_error);
}
	$email= "";
if(isset($_GET['login'])) {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = $_POST['email'];
	$email = trim($email);
	$email = stripslashes($email);
	$email = htmlspecialchars($email);
}
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
<!-- Sidebar/menu -->
<?php include_once './templates/sidebar.php' ?>

<?php include_once './templates/header.php';

if (!$registered) {
	?>
	<div style="margin:2%" class="w3-container w3-black">
		<h2>Please Login to continue</h2>
	</div>
	<?php
}
else {
	?>
	<div style="margin:2%" class="w3-container w3-black">
		<h2>Your Registration was successful! Please Login!</h2>
	</div>
	<?php
}
?>
<form class="w3-container" action="?login=1" method="post">
	<label  class="w3-text-black"><b>Email:</b></label>
	<input style="margin-top:3%" class="w3-input w3-border w3-light-grey" type="email" name="email" required>

	<div style="margin-top:3%"><label  class="w3-text-black"><b>Password:</b></label></div>
	<input style="margin-top:3%" class="w3-input w3-border w3-light-grey" type="password" name="passwort" required>

	<input style="margin-top:3%" class="w3-btn w3-black" type="submit" value="Login">
	<a style="margin-top:3%" href="registration.php" class="w3-btn w3-black"> Register </a>
</form>


<?php
include_once "./templates/footer.php";
?>
</body>
</html>