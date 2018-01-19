<?php
require_once '../autoloader.php';
if (!DB::create('localhost', 'root', 'test123', 'CARSCARS')) {
	die("Unable to connect to database [".DB::getInstance()->connect_error."]");
}

//DELETE ACTION
if (isset($_GET['delete'])){
	$id = $_GET['delete'];

	Product::delete($id);
	header("Location: ./adminproducts.php");
}

//EDIT VIEW
if (isset($_GET['edit'])){
	$id = $_GET['edit'];
	$product = Product::getProductById($id);
	$edit = true;
}

if(isset($_GET['edited'])){
	$id = $_GET['edited'];
	$brand = $_POST['brand'];
	$model = $_POST['model'];
	$price = $_POST['price'];
	$type = $_POST['type'];
	$imgRef = $_POST['imgRef'];


	DB::doQuery("UPDATE products set brand = '$brand', model = '$model' , price = '$price', type = '$type', imgRef = '$imgRef' WHERE id = $id");
}

//ADD VIEW
if(isset($_GET['add'])){
	$add = true;
}

if(isset($_GET['added'])){
	$brand = $_POST['brand'];
	$model = $_POST['model'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$type = $_POST['type'];
	$imgRef = $_POST['imgRef'];

	DB::doQuery("INSERT INTO products (brand, model,description,price,type,imgRef) VALUES ('$brand','$model','$description','$price','$type','$imgRef')");
}


//STANDARD VIEW
$products = Product::getALLProducts();


echo "<a href='./adminarea.php'> Back </a>";

if($edit) {

	echo "<form action=\"?edited=".$id."\" method=\"post\">
		Brand:<br> <input type=\"text\" size=\"40\" maxlength=\"250\" value=\"".$product->getBrand()."\" name=\"brand\"><br>
		 Model: <br><input type=\"text\" size=\"40\" maxlength=\"250\" name=\"model\" value=\" ".$product->getModel()."\"><br>
		 Description:<br> <input type=\"text\" size=\"40\" maxlength=\"250\" value=\"".$product->getDescription()."\" name=\"description\"><br>
		 Price: <br> <input type=\"text\" size=\"40\" maxlength=\"250\" name=\"price\" value=\" ".$product->getPrice()." \"><br>
		 Type: <br><input type=\"text\" size=\"40\" name=\"type\" value=\" ".$product->getType()."\"> <br>
		 ImgRef: <br><input type=\"text\" size=\"40\" maxlength=\"250\" name=\"imgRef\" value=\" ".$product->getImgRef()."\"> <br> 
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
			<td>".$product->getBrand()."</td>
			<td>".$product->getModel()."</td>
			<td>".$product->getDescription()."</td>
			<td>".$product->getType()."</td>
			<td>".$product->getPrice()."</td>
			<td>".$product->getColor()."</td>
			<td>".$product->getImgRef()."</td>
			<td><a href='adminproducts.php?delete=".$id."'> Delete</a> </td>
			<td><a href='adminproducts.php?edit=".$id."'> Edit</a> </td>
		</tr>
	";
	}
echo "	</tbody>
</table>
<a href='?add'> Add </a> ";

?>