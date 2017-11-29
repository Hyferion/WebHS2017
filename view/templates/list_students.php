
	<h2>Students</h2>
	<?php
	
	echo isset($message) ? "<h5>".$message."</h5>" : "";

	foreach($students as $student) {
		$id = $student->getId();
		echo "<span class=\"student\">$student</span> <a href=\"index.php?action=edit_student&id=$id\">Edit</a> | <a href=\"index.php?action=delete_student&id=$id\">Delete</a><br/>";
	}
	?>
