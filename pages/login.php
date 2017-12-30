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
	<?php include'navigation.php'; ?>
</header>
<?php
session_start();
$db = new mysqli("localhost:8889", "root", "test123", "carscars");

if(isset($_GET['login'])) {
	$email = $_POST['email'];
	$passwort = $_POST['passwort'];

	$statement = $db->prepare("SELECT * FROM users WHERE email = :email");
	$result = $statement->execute(array('email' => $email));
	$user = $statement->fetch();

	//Überprüfung des Passworts
	if ($user !== false && password_verify($passwort, $user['passwort'])) {
		$_SESSION['userid'] = $user['id'];
		die('Login erfolgreich. Weiter zu <a href="account.php.php">internen Bereich</a>');
	} else {
		$errorMessage = "E-Mail oder Passwort war ungültig<br>";
	}

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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