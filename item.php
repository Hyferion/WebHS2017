<?php
session_start();

require_once 'autoloader.php';
if (!DB::create('localhost', 'root', 'test123', 'CARSCARS')) {
	die("Unable to connect to database [".DB::getInstance()->connect_error."]");
}


if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$product = Product::getProductById($id);
}

elseif (isset($_POST['search'])) {
	$model = $_POST['search'];
	$product = Product::getProductbyModel($model);

}
	if(is_null($product)){
		header("Location: ./index.php?".$model."");

	}
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

include_once './templates/sidebar.php';

?><?php
include_once './templates/header.php';
echo "<div class=\"row mt-20\">
			<div class=\"col-md-5\">
				<div class=\"single-product-slider\">
					<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
						<div class='carousel-outer'>
							<!-- me art lab slider -->
							<div class='carousel-inner '>
								<div class='item active'>
									<img src=" . $product->getImgRef() . " alt=''  class='w3-border' style=\"padding:4px;width:100%;max-width:400px\"/>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class=\"col-md-7\">
				<div class=\"single-product-details\">
					<h2>" . $product->getBrand() . " " . $product->getModel() . "</h2>
					<p class=\"product-price\">" . $product->getPrice(). '$' . "</p>

					<p class=\"product-description mt-20\">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum ipsum dicta quod, quia doloremque aut deserunt commodi quis. Totam a consequatur beatae nostrum, earum consequuntur? Eveniet consequatur ipsum dicta recusandae.
					</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, velit, sunt temporibus, nulla accusamus similique sapiente tempora, at atque cumque assumenda minus asperiores est esse sequi dolore magnam. Debitis, explicabo.</p>
					<form action=\"shoppingcart.php?item_id=" . $product->getId() . "\" method=\"post\">
					
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
							<input id=\"product-quantity\" type=\"number\" value=\"1\" name=\"quantity\">
						</div>
					</div>
					<input type=\"submit\" value=\"Add to Cart\" class=\"w3-btn w3-black\" style='margin:2%';>
					</form>
					<div class=\"product-category\">
						<span>Categories:</span>
						<ul>
							<li><a href=\"#\">Products</a></li>
							<li><a href=\"index.php?type=" . $product->getType() ."\">" . $product->getType() . "</a></li>
							<li><a href=\"index.php?brand=" . $product->getBrand() ."\">" . $product->getBrand() . "</a></li>
						</ul>
					</div>
				
				</div>
			</div>
		</div>
		";
include_once "./templates/footer.php";
?>
</body>
</html>



