
	<h3>Home</h3>
	<h5><?php echo $message; ?></h5>
	<p>&raquo; <a href="index.php?action=list_students">The list of students</a></p>
	<p>&raquo; <a href="index.php?action=contact">Contact</a></p>

	<?php if ($this->controller->isLoggedIn()) echo "<p>&raquo; <a href=\"index.php?action=logout\">Logout</a></p>";?>
