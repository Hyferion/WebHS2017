<!DOCTYPE html>
<html>
<title>Cars & Cars</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/w3c.css">
<body>

<?php
$name = $email = $subject = $comment = '';
$email_to = "siou10@gmail.com";
$email_subject = "New Contact form";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $subject = test_input($_POST["subject"]);
    $comment = test_input($_POST["comment"]);
}

$email_message .= "First Name: ".$name."\n";
$email_message .= "Email: ".$email."\n";
$email_message .= "Subject: ".$subject."\n";
$email_message .= "Comment: ".$comment."\n";

$headers = 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);




function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-wide w3-padding w3-card-2">
        <a href="index.php" class="w3-bar-item w3-button"><b>CC</b> Cars & Cars</a>
        <!-- Float links to the right. Hide them on small screens -->
        <div class="w3-right w3-hide-small">
            <a href="./products.php" class="w3-bar-item w3-button">Shop</a>
            <a href="./account.php" class="w3-bar-item w3-button">Account</a>
        </div>
    </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
    <img class="w3-image" src="../src/car4.jpg" alt="Car" width="1500" height="800">
    <div class="w3-display-middle w3-margin-top w3-center">
        <div style="color:lawngreen; font-size:32px;"><?php echo "Thank you " . $name . "! We will get in touch with you as fast as possible";?> </div>
        <h1 class="w3-xxlarge w3-text-white"><a href="index.php" style="text-decoration:none;" class="w3-padding w3-black w3-opacity-min"><b>Back</b>
            </a> </h1>
    </div>
</header>

    <!-- Footer -->
    <footer class="w3-center w3-black w3-padding-16">
        Silas Stulz & Manuel Egli <?php echo date('Y') ?>
    </footer>

</body>
</html>