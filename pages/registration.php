<?php
session_start();
$db = new mysqli("localhost:8889", "root", "test123", "carscars");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registrierung</title>
</head>
<body>

<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['register'])) {
	$error = false;
	$email = $_POST['email'];
	$passwort = $_POST['passwort'];
	$passwort2 = $_POST['passwort2'];
	$surname = $_POST['surname'];
	$lastname = $_POST['lastname'];


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

		$sql = "INSERT INTO users (email, passwort,vorname,nachname) VALUES ($email,$passwort_hash,$surname,$lastname)";


		if(!$result = $db->query($sql)) {
			echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
			$showFormular = false;
		} else {
			echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
		}
	}
}

if($showFormular) {
	?>

	<form action="?register=1" method="post">
		Vorname: <br>
		<input type="text" size="40" maxlength="250" name="surname"><br>
		Nachname: <br>
		<input type="text" size="40" maxlength="250" name="lastname"><br>
		E-Mail:<br>
		<input type="email" size="40" maxlength="250" name="email"><br><br>

		Dein Passwort:<br>
		<input type="password" size="40"  maxlength="250" name="passwort"><br>

		Passwort wiederholen:<br>
		<input type="password" size="40" maxlength="250" name="passwort2"><br><br>

		<input type="submit" value="Abschicken">
	</form>

	<?php
} //Ende von if($showFormular)
?>

</body>
</html>