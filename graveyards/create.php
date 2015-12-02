<?php include("../layouts/top.php"); ?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// print_r('<pre>');
	// print_r('$_POST: ');
	// var_dump($_POST);
	// print_r('</pre>');

	// Insert query
	$q = 'INSERT INTO graveyard (name, street1, street2, city, state, zip, contact) VALUES ';
	$q .= '("' . $_POST['name'] . '","' . $_POST['street1'] . '","' . $_POST['street2'] . '","';
	$q .= $_POST['city'] . '","' . $_POST['state'] . '","' . $_POST['zip'] . '","';
	$q .= $_POST['contact'] . '")';
	// print_r('<pre>');
	// print_r('$q: ');
	// var_dump($q);
	// print_r('</pre>');

	$new_entry = $database->prepare($q);

	try{
		$new_entry->execute();

		// Get ID of last inserted element
		$last_id_stmt = $database->query('SELECT LAST_INSERT_ID()');
		$last_id_arr = $last_id_stmt->fetch(PDO::FETCH_NUM);
		$last_id = $last_id_arr[0];
		// print_r('<pre>');
		// print_r('$last_id: ');
		// var_dump($last_id);
		// print_r('</pre>');

		echo '<div data-alert class="alert-box success">Graveyard added!</div>';
	} catch (PDOException $e) {
		echo '<div data-alert class="alert-box alert">Something went wrong!<br>';
		echo $e->getMessage();
		echo '</div>';
	}
}



?>

<div class="row">
	<h1>New graveyard</h1>

	<form action="./create.php" method="POST">
		<div class="large-12 columns">
			<label>Name
				<input type="text" name="name" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Street
				<input type="text" name="street1" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Street 2
				<input type="text" name="street2" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>City
				<input type="text" name="city" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>State
				<input type="text" name="state" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Zip
				<input type="text" name="zip" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Contact
				<input type="text" name="contact" />
			</label>
		</div>
		<div class="large-12 columns">
			<input type="submit" value="Add graveyard" class="button expand" />
		</div>
	</form>
</div>

<?php include("../layouts/bottom.php"); ?>