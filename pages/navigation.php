<?php
require_once '../cart.php';
if (!isset($_SESSION["cart"])) {
	$_SESSION["cart"] = new Cart();
}
// Get cart from session
$cart = $_SESSION["cart"];
?>
<div class="w3-top">
	<div class="w3-bar w3-white w3-wide w3-padding w3-card-2">
		<a href="index.php" class="w3-bar-item w3-button"><b>CC</b> Cars & Cars</a>
		<!-- Float links to the right. Hide them on small screens -->
		<div class="w3-right w3-hide-small">
			<a href="./products.php" class="w3-bar-item w3-button">Shop</a>
			<a href="./account.php" class="w3-bar-item w3-button">Account</a>
			<?php if ($_SESSION['userid'] != NULL){
				echo "<a href=\"./logout.php\" class=\"w3-bar-item w3-button\">Logout</a>";
}
						echo "<a href=\"./shoppingcart.php\" class=\"w3-bar-item w3-button\">Cart</a>";


?>
		</div>
	</div>
</div>