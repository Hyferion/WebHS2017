<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
	<div class="w3-bar-item w3-padding-24 w3-wide">Car</div>
	<a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px">
	<!-- Push down content on small screens -->
	<div class="w3-hide-large" style="margin-top:83px"></div>
	<div class="w3-right"><?php include_once 'search.php';?></div>

	<!-- Top header -->
	<header class="w3-container w3-xlarge">
		<p class="w3-left"><?php echo $_GET['brand'];?></p>

		<p class="w3-right">
			<a href="account.php">
			<i class="fa fa-user-circle w3-margin-right" aria-hidden="true"></i></a>
			<a href="shoppingcart.php">
				<i class="fa fa-shopping-cart w3-margin-right"></i></a>
			<?php if (isset($_SESSION['userid'])) {?>
				<a href="logout.php">
				<i class="fa fa-sign-out" aria-hidden="true"></i></a>

			<?php
			}
			?>
		</p>
	</header>