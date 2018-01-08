<?php
$db = new mysqli("localhost:8889", "root", "test123", "carscars");
if ($db->connect_error) {
	echo("Unable to connect to the database" . $db->connect_error);
}

//DELETE ACTION
if (isset($_GET['delete'])){
	$id = $_GET['delete'];

	if(!$result = $db->query("DELETE from products where id = ".$id."")) {
		echo("There was an error connecting to the db");
	}
	header("Location: ./adminproducts.php");
}

//EDIT VIEW
if (isset($_GET['edit'])){
	$id = $_GET['edit'];
	$edit = true;
}

if(isset($_GET['edited'])){
	$id = $_GET['edited'];
	$brand = $_POST['brand'];
	$model = $_POST['model'];
	$price = $_POST['price'];
	$type = $_POST['type'];
	$imgRef = $_POST['imgRef'];


	if (!$result = $db->query("UPDATE products set brand = '$brand', model = '$model' , price = '$price', type = '$type', imgRef = '$imgRef' WHERE id = $id")) {
		echo("There was an error connecting to the db");
	}
}

//ADD VIEW
if(isset($_GET['add'])){
	$add = true;
}

if(isset($_GET['added'])){
	$brand = $_POST['brand'];
	$model = $_POST['model'];
	$model = $_POST['description'];
	$price = $_POST['price'];
	$type = $_POST['type'];
	$imgRef = $_POST['imgRef'];

	if (!$result = $db->query("SELECT MAX(id) from products")) {
		echo("There was an error connecting to the db");
	}
	$res = $result->fetch_assoc();

	$idmax = $res['MAX(id)'] + 1;

	if (!$result = $db->query("INSERT INTO products (brand, model,description,price,type,imgRef) VALUES ('$brand','$model','$description','$price','$type','$imgRef')")) {
		echo("There was an error connecting to the db");
	}
}





//STANDARD VIEW
if (!$result = $db->query("SELECT * FROM products;")) {
	echo("There was an error connecting to the db");
}

while ($car = $result->fetch_assoc()) {
	$products[$car['id']] = array(
		'brand' => $car ['brand'],
		'model' => $car ['model'],
		'description' => $car['description'],
		'price' => $car ['price'],
		'type' => $car['type'],
		'imgRef' => $car['imgRef'],
		'color' => $car['color'],
	);
}

echo "<a href='./adminarea.php'> Back </a>";

if($edit) {

	echo "<form action=\"?edited=".$id."\" method=\"post\">
		Brand:<br> <input type=\"text\" size=\"40\" maxlength=\"250\" value=\"".$products[$id]['brand']."\" name=\"brand\"><br>
		 Model: <br><input type=\"text\" size=\"40\" maxlength=\"250\" name=\"model\" value=\" ".$products[$id]['model']."\"><br>
		 Description:<br> <input type=\"text\" size=\"40\" maxlength=\"250\" value=\"".$products[$id]['description']."\" name=\"description\"><br>
		 Price: <br> <input type=\"text\" size=\"40\" maxlength=\"250\" name=\"price\" value=\" ".$products[$id]['price']." \"><br>
		 Type: <br><input type=\"text\" size=\"40\" name=\"type\" value=\" ".$products[$id]['type']."\"> <br>
		 ImgRef: <br><input type=\"text\" size=\"40\" maxlength=\"250\" name=\"imgRef\" value=\" ".$products[$id]['imgRef']."\"> <br> 
		 <input type=\"submit\" value=\"Abschicken\">
	</form>";
}
if ($add) {
	echo "<form action=\"?added=1\" method=\"post\">
		Brand:<br> <input type=\"text\" size=\"40\" maxlength=\"250\"  name=\"brand\"><br>
		 Model: <br><input type=\"text\" size=\"40\" maxlength=\"250\" name=\"model\" ><br>
		 Description:<br> <input type=\"text\" size=\"40\" maxlength=\"250\"  name=\"description\"><br>
		 Price: <br> <input type=\"text\" size=\"40\" maxlength=\"250\" name=\"price\"  \"><br>
		 Type: <br><input type=\"text\" size=\"40\" name=\"type\" > <br>
		 ImgRef: <br><input type=\"text\" size=\"40\" maxlength=\"250\" name=\"imgRef\" > <br> 
		 <input type=\"submit\" value=\"Abschicken\">
	</form>";
}


echo "

<table class=\"container\">
	<thead>
		<tr>
			<th><h1>ID</h1></th>
			<th><h1>Brand</h1></th>
			<th><h1>Model</h1></th>
			<th><h1>Description</h1></th>
			<th><h1>Type</h1></th>
			<th><h1>Price</h1></th>
			<th><h1>Color</h1></th>
			<th><h1>ImgRef</h1></th>
		</tr>
	</thead>
	<tbody>";
	foreach ($products as $id => $product) {

		echo "<tr>
			<td>".$id."</td>
			<td>".$product['brand']."</td>
			<td>".$product['model']."</td>
			<td>".$product['description']."</td>
			<td>".$product['type']."</td>
			<td>".$product['price']."</td>
			<td>".$product['color']."</td>
			<td>".$product['imgRef']."</td>
			<td><a href='adminproducts.php?delete=".$id."'> Delete</a> </td>
			<td><a href='adminproducts.php?edit=".$id."'> Edit</a> </td>
		</tr>
	";
	}
echo "	</tbody>
</table>
<a href='?add'> Add </a> ";

?>