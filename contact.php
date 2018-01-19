<?php

$email = test_input($_POST['email']);
$name = test_input($_POST['name']);
$subject = test_input($_POST['subject']);
$message = test_input($_POST['message']);

$to      = 'silas.stulz@gmail.com';
$subject = $subject;
$message = $message;
$headers = 'From: cars@cars.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
header("Location: ./index.php")
?>