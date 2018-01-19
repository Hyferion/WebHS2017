<?php
require_once '../autoloader.php';
$db = new mysqli("localhost:8889", "root", "test123", "carscars");
if ($db->connect_error) {
	echo("Unable to connect to the database" . $db->connect_error);
}

//DELETE ACTION
if (isset($_GET['delete'])){
	$id = $_GET['delete'];

	if(!$result = $db->query("DELETE from orders where id = ".$id."")) {
		echo("There was an error connecting to the db");
	}
	header("Location: ./adminorders.php");
}

//EDIT VIEW
if (isset($_GET['edit'])){
	$id = $_GET['edit'];
	$edit = true;
}

if(isset($_GET['edited'])){
	$id = $_GET['edited'];
	$usrid = $_POST['usrid'];
	$items = $_POST['items'];
	$total = $_POST['total'];


	if (!$result = $db->query("UPDATE orders set usrid = '$usrid', total = '$total' WHERE id = $id")) {
		echo("There was an error connecting to the db");
	}
}

//ADD VIEW
if(isset($_GET['add'])){
	$add = true;
}

if(isset($_GET['added'])){
	$usrid = $_POST['usrid'];
	$items = $_POST['items'];
	$total = $_POST['total'];


	if (!$result = $db->query("INSERT INTO orders (usrid,items, total) VALUES ($usrid,$total)")) {
		echo("There was an error connecting to the db");
	}
}





//STANDARD VIEW
if (!$result = $db->query("SELECT * FROM orders;")) {
	echo("There was an error connecting to the db");
}

while ($order = $result->fetch_assoc()) {
	$orders[$order['id']] = array(
		'id' => $order ['id'],
		'usrid' => $order ['usrid'],
		'items' => $order['items'],
		'total' => $order ['total']
	);
}

echo "<a href='./adminarea.php'> Back </a>";

if($edit) {

	echo "<form action=\"?edited=".$id."\" method=\"post\">
		usrid:<br> <input type=\"text\" size=\"40\" maxlength=\"250\" value=\"".$orders[$id]['usrid']."\" name=\"usrid\"><br>
		 Total:<br> <input type=\"text\" size=\"40\" maxlength=\"250\" value=\"".$orders[$id]['total']."\" name=\"total\"><br>
		 <input type=\"submit\" value=\"Abschicken\">
	</form>";
}
if ($add) {
	echo "<form action=\"?added=1\" method=\"post\">
		usrid:<br> <input type=\"number\" size=\"40\" maxlength=\"250\"  name=\"usrid\"><br>
		items:<br> <input type=\"text\" size=\"40\" maxlength=\"250\"  name=\"items\"><br>
		 total: <br><input type=\"number\" size=\"40\" maxlength=\"250\" name=\"total\" ><br>
		 <input type=\"submit\" value=\"Abschicken\">
	</form>";
}


echo "

<table class=\"container\">
	<thead>
		<tr>
			<th><h1>ID</h1></th>
			<th><h1>usrid</h1></th>
			<th><h1>Items</h1></th>
			<th><h1>Total</h1></th>
		</tr>
	</thead>
	<tbody>";
foreach ($orders as $id => $order) {

	echo "<tr>
			<td>".$id."</td>
			<td>".$order['usrid']."</td>
			<td>".$order['items']."</td>
			<td>".$order['total']."</td>
		
			<td><a href='adminorders.php?delete=".$id."'> Delete</a> </td>
			<td><a href='adminorders.php?edit=".$id."'> Edit</a> </td>
		</tr>
	";
}
echo "	</tbody>
</table>
<a href='?add'> Add </a> ";

?>