<?php
session_start();
if (isset($_GET['id'])&& isset($_SESSION['userid'])) {
	$id = $_GET['id'];
	$usrid = $_SESSION['userid'];

	$db = new mysqli("localhost:8889", "root", "test123", "carscars");
	if ($db->connect_error) {
		echo("Unable to connect to the database" . $db->connect_error);
	}

	if (!$result = $db->query("SELECT * FROM orders
inner join order_adress on orders.id = order_adress.orderid
 where order_adress.usrid=" . $usrid . " and order_adress.orderid =" . $id . "")) {
		echo("There was an error connecting to the db");
	}
	$order = $result->fetch_assoc();
	if ($order === NULL) {
		echo "Not so fast there! You should not be here..";
	} else {
			$final_order = array(
				'orderid' => $order ['orderid'],
				'items' => $order ['items'],
				'total' => $order ['total'],
				'email' => $order ['email'],
				'firstname' => $order ['firstname'],
				'lastname' => $order ['lastname'],
				'adress' => $order ['adress'],
				'zip' => $order ['zip'],
				'city' => $order ['city']
			);
		}

include_once 'navigation.php';
		echo "
<style>
table, th, td {
    border: 1px solid black;
}
</style>
	<table style='margin-top: 50px;';>";
		echo "

		<tr>
			<td> BestellNr.: </td>
			<td> " . $final_order['orderid'] . "</td></tr>
			<tr>
			<td> Bestellte Autos: </td>
			<td>" . $final_order['items'] . "</td></tr>
			<tr>
			<td>Total: </td>
			<td>" . $final_order['total'] . "</td></tr>
		<tr>
			<td> Email: </td>
			<td>" . $final_order['email'] . "</td></tr>
			<tr>
			<td> Vorname: </td>
			<td>" . $final_order['firstname'] . "</td></tr>
			<tr>
			<td> Nachname: </td>
			<td>" . $final_order ['lastname'] . "</td></tr>
			<tr>
			<td>Adresse: </td>
			<td>" . $final_order['adress'] . "</td></tr>
			<tr>
			<td> Stadt:</td>
			<td>" . $final_order['city'] . "</td></tr>
			<tr>
			<td> Postleihzahl:</td>
			<td> " . $final_order['zip'] . "</td></tr>
	</table>
		";
}
?>


