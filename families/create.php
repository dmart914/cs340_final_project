<?php include("../layouts/top.php"); ?>

<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// Insert query
		$q = 'INSERT INTO family (name, origin) VALUES ';
		$q .= '("' . $_POST['name'] . '","' . $_POST['origin'] . '")';
		
		$new_entry = $database->prepare($q);

		try {
			$new_entry->execute();

			// Get ID of last inserted element
			$last_id_stmt = $database->query('SELECT LAST_INSERT_ID()');
			$last_id_arr = $last_id_stmt->fetch(PDO::FETCH_NUM);
			$last_id = $last_id_arr[0];
			
			echo '<div data-alert class="alert-box success">Family added!</div>';

		} catch (PDOException $e) {
			echo '<div data-alert class="alert-box alert">Something went wrong!<br>';
			echo $e->getMessage();
			echo '</div>';
		}
	}





?>

<div class="row">
	<h1>New family</h1>

	<form action="./create.php" method="POST">
		<div class="large-12 columns">
			<label>Name
				<input type="text" name="name" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Origin
				<input type="text" name="origin" />
			</label>
		</div>
		<div class="large-12 columns">
			<input type="submit" value="Add Family" class="button expand" />
		</div>
	</form>
</div>

<?php include ("../layouts/bottom.php"); ?>