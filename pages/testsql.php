<!DOCTYPE html>
<html><head></head>
<body>
<?php
echo "HALLO";
$db = new mysqli("localhost:8889","root","test123","carscars");
if ($db->connect_error) {
    echo ("Unable to connect to the database" .$db->connect_error);
}
echo "I GOT HERE";


if (!$result = $db->query("SELECT * FROM products;")){
    echo("There was an error connecting to the db");
}
echo $result->num_rows. " Products: </br>";
while($car = $result->fetch_assoc()){
    echo $car["brand"]." " .$car["model"]."<br />";
}
$db->close();
?>
</body>
</html>