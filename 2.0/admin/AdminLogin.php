<?php
session_start();

if (isset($_SESSION['adminid'])){
	header("Location: ./adminarea.php");
}

$db = new mysqli("localhost:8889", "root", "test123", "carscars");
if ($db->connect_error) {
	echo("Unable to connect to the database" . $db->connect_error);
}

if(isset($_GET['login'])) {
	$email = $_POST['email'];
	$passwort = $_POST['passwort'];

	if (!$result = $db->query("SELECT * FROM users WHERE admin = 1 and email ='".$email."';")){
		echo("There was an error connecting to the db");
	} else {
		$user = $result->fetch_assoc();

	}

	//Überprüfung des Passworts
	if ($user !== false && password_verify($passwort, $user['passwort'])) {
		$_SESSION['adminid'] = $user['id'];

		header("Location: ./adminarea.php");
	} else {
		$errorMessage = "E-Mail oder Passwort war ungültig<br>";
	}

}
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

<?php
if(isset($errorMessage)) {
	echo $errorMessage;
}
?>

<form style="margin-top: 60px;" action="?login=1" method="post">
	E-Mail:<br>
	<input type="email" size="40" maxlength="250" name="email"><br><br>

	Dein Passwort:<br>
	<input type="password" size="40"  maxlength="250" name="passwort"><br>

	<input type="submit" value="Abschicken">
</form>
</body>
</html>