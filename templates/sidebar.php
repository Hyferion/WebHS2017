<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
	<div class="w3-container w3-display-container w3-padding-16">
		<i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
		<a href="../index.php" style="text-decoration: none;"> <h3 class="w3-wide"><b>Car</b></h3></a>
	</div>
	<div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
		<a href="../index.php?brand=BMW" class="w3-bar-item w3-button">BMW</a>
		<a href="../index.php?brand=VW" class="w3-bar-item w3-button">VW</a>
		<a href="../index.php?brand=Audi" class="w3-bar-item w3-button">Audi</a>
		<a href="../index.php?brand=Dacia" class="w3-bar-item w3-button">Dacia</a>
		<a href="../index.php?brand=Mercedes Benz" class="w3-bar-item w3-button">Mercedes Benz</a>
		<a href="../index.php?brand=Porsche" class="w3-bar-item w3-button">Porsche</a>
		<a href="../index.php?brand=Ford" class="w3-bar-item w3-button">Ford</a>
	</div>
	<a href="#footer" class="w3-bar-item w3-button w3-padding">Contact</a>
	<?php if ($_SERVER['REQUEST_URI'] == '/index.php') {?>
	<a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding" onclick="document.getElementById('newsletter').style.display='block'">Newsletter</a>
	<a href="#footer"  class="w3-bar-item w3-button w3-padding">Subscribe</a>
	<?php } ?>
</nav>