<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$mysqli = new mysqli("localhost:8889", "root", "test123", "carscars");

// Check connection
if($mysqli === false){
	die("ERROR: Could not connect. " . $mysqli->connect_error);
}

if(isset($_REQUEST['term'])){
	// Prepare a select statement
	$sql = "SELECT * FROM products WHERE products.model LIKE ? AND color = ''";

	if($stmt = $mysqli->prepare($sql)){
		// Bind variables to the prepared statement as parameters
		$stmt->bind_param("s", $param_term);

		// Set parameters
		$param_term = $_REQUEST['term'] . '%';

		// Attempt to execute the prepared statement
		if($stmt->execute()){
			$result = $stmt->get_result();

			// Check number of rows in the result set
			if($result->num_rows > 0){
				// Fetch result rows as an associative array
				while($row = $result->fetch_array(MYSQLI_ASSOC)){
					echo "<p>" . $row["model"] . "</p>";
				}
			} else{
				echo "<p>No matches found</p>";
			}
		} else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
	}

	// Close statement
	$stmt->close();
}

// Close connection
$mysqli->close();
?>