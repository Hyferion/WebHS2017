<?php
$db = new mysqli("localhost", "root", "test123", "CARSCARS");
if ($db->connect_error) {
	echo("Unable to connect to the database" . $db->connect_error);
}

//DELETE ACTION
if (isset($_GET['delete'])){
	$id = $_GET['delete'];

	if(!$result = $db->query("DELETE from users where id = ".$id."")) {
		echo("There was an error connecting to the db");
	}
	header("Location: ./adminusers.php");
}

//EDIT VIEW
if (isset($_GET['edit'])){
	$id = $_GET['edit'];
	$edit = true;
}

if(isset($_GET['edited'])){
	$id = $_GET['edited'];
	$email = $_POST['email'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$adress = $_POST['adress'];
	$zip = $_POST['zip'];
	$city = $_POST['city'];


	if (!$result = $db->query("UPDATE users set email = '$email', vorname = '$firstname' , nachname = '$lastname', adress = '$adress', zip = '$zip', city = '$city' WHERE id = $id")) {
		echo("There was an error connecting to the db");
	}
}

//ADD VIEW
if(isset($_GET['add'])){
	$add = true;
}

if(isset($_GET['added'])){
	$id = $_GET['edited'];
	$email = $_POST['email'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$adress = $_POST['adress'];
	$zip = $_POST['zip'];
	$city = $_POST['city'];

	$passwort = $_POST['password'];
	$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);



	if (!$result = $db->query("INSERT INTO users (email,passwort, vorname,nachname,adress,zip,city) VALUES ('$email','$passwort_hash','$firstname','$lastname','$adress','$zip','$city')")) {
		echo("There was an error connecting to the db");
	}
}





//STANDARD VIEW
if (!$result = $db->query("SELECT * FROM users;")) {
	echo("There was an error connecting to the db");
}

while ($user = $result->fetch_assoc()) {
	$users[$user['id']] = array(
		'id' => $user ['id'],
		'email' => $user ['email'],
		'firstname' => $user['vorname'],
		'lastname' => $user ['nachname'],
		'adress' => $user['adress'],
		'zip' => $user['zip'],
		'city' => $user['city'],
	);
}

echo "<a href='adminarea.php'> Back </a>";

if($edit) {

	echo "<form action=\"?edited=".$id."\" method=\"post\">
		Email:<br> <input type=\"text\" size=\"40\" maxlength=\"250\" value=\"".$users[$id]['email']."\" name=\"email\"><br>
		 Firstname: <br><input type=\"text\" size=\"40\" maxlength=\"250\" name=\"firstname\" value=\" ".$users[$id]['firstname']."\"><br>
		 Lastname:<br> <input type=\"text\" size=\"40\" maxlength=\"250\" value=\"".$users[$id]['lastname']."\" name=\"lastname\"><br>
		 Adress: <br> <input type=\"text\" size=\"40\" maxlength=\"250\" name=\"adress\" value=\" ".$users[$id]['adress']." \"><br>
		 Zip: <br><input type=\"text\" size=\"40\" name=\"zip\" value=\" ".$users[$id]['zip']."\"> <br>
		 City: <br><input type=\"text\" size=\"40\" maxlength=\"250\" name=\"city\" value=\" ".$users[$id]['city']."\"> <br> 
		 <input type=\"submit\" value=\"Abschicken\">
	</form>";
}
if ($add) {
	echo "<form action=\"?added=1\" method=\"post\">
		Email:<br> <input type=\"email\" size=\"40\" maxlength=\"250\"  name=\"email\"><br>
		Password:<br> <input type=\"password\" size=\"40\" maxlength=\"250\"  name=\"password\"><br>
		 Firstname: <br><input type=\"text\" size=\"40\" maxlength=\"250\" name=\"firstname\" ><br>
		 Lastname:<br> <input type=\"text\" size=\"40\" maxlength=\"250\"  name=\"lastname\"><br>
		 Adress: <br> <input type=\"text\" size=\"40\" maxlength=\"250\" name=\"adress\"  \"><br>
		 Zip: <br><input type=\"number\" size=\"40\" name=\"zip\" > <br>
		 City: <br><input type=\"text\" size=\"40\" maxlength=\"250\" name=\"city\" > <br> 
		 <input type=\"submit\" value=\"Abschicken\">
	</form>";
}


echo "

<table class=\"container\">
	<thead>
		<tr>
			<th><h1>ID</h1></th>
			<th><h1>Email</h1></th>
			<th><h1>Firstname</h1></th>
			<th><h1>Lastname</h1></th>
			<th><h1>Adress</h1></th>
			<th><h1>ZIP</h1></th>
			<th><h1>City</h1></th>
		</tr>
	</thead>
	<tbody>";
foreach ($users as $id => $user) {

	echo "<tr>
			<td>".$id."</td>
			<td>".$user['email']."</td>
			<td>".$user['firstname']."</td>
			<td>".$user['lastname']."</td>
			<td>".$user['adress']."</td>
			<td>".$user['zip']."</td>
			<td>".$user['city']."</td>
			<td><a href='adminusers.php?delete=".$id."'> Delete</a> </td>
			<td><a href='adminusers.php?edit=".$id."'> Edit</a> </td>
		</tr>
	";
}
echo "	</tbody>
</table>
<a href='?add'> Add </a> ";

?>