<?php
session_start();
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$idprev = $id - 1;
	$idnext = $id + 1;
}

$db = new mysqli("localhost:8889", "root", "test123", "carscars");
if ($db->connect_error) {
	echo("Unable to connect to the database" . $db->connect_error);
}

if (!$result = $db->query("SELECT * FROM products WHERE id =" . $id . ";")) {
	echo("There was an error connecting to the db");
}
while ($car = $result->fetch_assoc()) {
	$products[$car['id']] = array(
		'brand' => $car ['brand'],
		'model' => $car ['model'],
		'price' => $car ['price'],
		'type' => $car['type'],
		'imgRef' => $car ['imgRef'],
		'imgRefTwo' => $car['imgRefTwo'],
		'imgRefThree' => $car['imgRefThree']
	);
}
if (!$result = $db->query("SELECT MAX(id) from products")) {
	echo("There was an error connecting to the db");
}
$res = $result->fetch_assoc();

$idmax = $res['MAX(id)'];
$db->close();
?>
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<title>Cars</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/main.scss">
<style>
	.w3-sidebar a {
		font-family: "Roboto", sans-serif
	}

	body, h1, h2, h3, h4, h5, h6, .w3-wide {
		font-family: "Montserrat", sans-serif;
	}
</style>
<body class="w3-content" style="max-width:1200px">
<?php

include_once 'sidebar.php';

?><?php
include_once 'header.php';
echo "<div class=\"row mt-20\">
			<div class=\"col-md-5\">
				<div class=\"single-product-slider\">
					<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
						<div class='carousel-outer'>
							<!-- me art lab slider -->
							<div class='carousel-inner '>
								<div class='item active'>
									<img src=" . $products[$id]['imgRef'] . " alt='' data-zoom-image=\"images/shop/single-products/product-1.jpg\" class='w3-border' style=\"padding:4px;width:100%;max-width:400px\"/>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class=\"col-md-7\">
				<div class=\"single-product-details\">
					<h2>" . $products[$id]['brand'] . " " . $products[$id]['model'] . "</h2>
					<p class=\"product-price\">" . $products[$id]['price'] . '$' . "</p>

					<p class=\"product-description mt-20\">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum ipsum dicta quod, quia doloremque aut deserunt commodi quis. Totam a consequatur beatae nostrum, earum consequuntur? Eveniet consequatur ipsum dicta recusandae.
					</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, velit, sunt temporibus, nulla accusamus similique sapiente tempora, at atque cumque assumenda minus asperiores est esse sequi dolore magnam. Debitis, explicabo.</p>
					<form action=\"shoppingcart.php?item_id=" . $id . "\" method=\"post\">
					
<div class=\"custom-radios\">
  <div>
    <input type=\"radio\" id=\"color-1\" name=\"color\" value=\"green\" checked>
    <label for=\"color-1\">
      <span>
        <img src=\"https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg\" alt=\"Checked Icon\" />
      </span>
    </label>
  </div>
  
  <div>
    <input type=\"radio\" id=\"color-2\" name=\"color\" value=\"blue\">
    <label for=\"color-2\">
      <span>
        <img src=\"https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg\" alt=\"Checked Icon\" />
      </span>
    </label>
  </div>
  
  <div>
    <input type=\"radio\" id=\"color-3\" name=\"color\" value=\"yellow\">
    <label for=\"color-3\">
      <span>
        <img src=\"https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg\" alt=\"Checked Icon\" />
      </span>
    </label>
  </div>

  <div>
    <input type=\"radio\" id=\"color-4\" name=\"color\" value=\"red\">
    <label for=\"color-4\">
      <span>
        <img src=\"https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg\" alt=\"Checked Icon\" />
      </span>
    </label>
  </div>
</div>
					
					<div class=\"product-quantity\">
						<span>Quantity:</span>
						<div class=\"product-quantity-slider\">
							<input id=\"product-quantity\" type=\"number\" value=\"0\" name=\"quantity\">
						</div>
					</div>
					<input type=\"submit\" value=\"Add to Cart\" class=\"w3-btn w3-black\" style='margin:2%';>
					</form>
					<div class=\"product-category\">
						<span>Categories:</span>
						<ul>
							<li><a href=\"#\">Products</a></li>
							<li><a href=\"index.php?type=" . $products[$id]['type'] ."\">" . $products[$id]['type'] . "</a></li>
							<li><a href=\"index.php?brand=" . $products[$id]['brand'] ."\">" . $products[$id]['brand'] . "</a></li>
						</ul>
					</div>
				
				</div>
			</div>
		</div>
		";
include_once "footer.php";
?>
</body>
</html>
<script>
	// Script to open and close sidebar
	function w3_open() {
		document.getElementById("mySidebar").style.display = "block";
		document.getElementById("myOverlay").style.display = "block";
	}

	function w3_close() {
		document.getElementById("mySidebar").style.display = "none";
		document.getElementById("myOverlay").style.display = "none";
	}
</script>



