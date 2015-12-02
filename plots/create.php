<?php include("../layouts/top.php"); ?>

<?php 
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$q = 'INSERT INTO plot (x_coord, y_coord, graveyard_id) ';
		$q .= 'VALUES (';

		$q .= $_POST["x_coord"] . ',';
		$q .= $_POST["y_coord"] . ',';
		
		if ($_POST["graveyard"] == "none") {
			$q .= 'NULL' . ')';
		} else {
			$q .= $_POST["graveyard"] . ')';
		}

		// var_dump($q);

		$new_entry = $database->prepare($q);
		$last_id = 0;

		try { 
			$new_entry->execute();
			
			// Get ID of inserted element
			$stmt = $database->query('SELECT LAST_INSERT_ID()');
			$last_id = $stmt->fetch(PDO::FETCH_NUM);

			// print_r('last id: ' . $last_id[0]);

			echo '<div data-alert class="alert-box success">Plot added!</div>';
		} catch (PDOException $e) {
			echo '<div data-alert class="alert-box alert">Something went wrong!<br>';
			echo $e->getMessage();
			echo '</div>';
		}

		// Check plot has person
		if ($last_id != 0 && $_POST['occupant'] != 'none') {
			$q_2 = 'UPDATE person SET plot_id=' . $last_id[0];
			$q_2 .= ' WHERE person.id=' . $_POST['occupant'];

			try {
				// Set person.plot_id to last plot id
				$modified_person = $database->query($q_2);
				$modified_person->execute();

				// print_r('updated rows: ' . $modified_person->rowCount() . '<br>');
				// print_r('last row modified: ' . $database->lastInsertId() . '<br>');
				// var_dump($modified_person->errorInfo());
			} catch (PDOException $e) {
				echo '<div data-alert class="alert-box alert">Something went wrong!<br>';
				echo $e->getMessage();
				echo '</div>';		
			}
		}
	}
	

	// Get people and graveyards
	$q_1 = 'SELECT id, first_name, middle_name, last_name FROM person ORDER BY id';
	$q_2 = 'SELECT id, name FROM graveyard ORDER BY id';

	$people = $database->prepare($q_1);
	$people->execute();

	$graveyards = $database->prepare($q_2);
	$graveyards->execute();

?>

<div class="row">
	<h1>New plot</h1>

	<form action="./create.php" method="POST">
		<div class="large-12 columns">
			<label>X coordinate
				<input type="text" name="x_coord" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Y coordinate
				<input type="text" name="y_coord" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Occupant
				<select name="occupant">
					<option value="none">&nbsp;</option>
					<?php
						while ($row = $people->fetch()) {
							$output = "<option value=\"";
							$output .= $row['id'];
							$output .= "\">";
							$output .= $row['first_name'] . ' ';
							$output .= $row['middle_name'] . ' ';
							$output .= $row['last_name'];
							$output .= "</option>";
							echo $output;
						}
					?>
				</select>
			</label>
		</div>
		<div class="large-12 columns">
			<label>Graveyard
				<select name="graveyard">
					<option value="none">&nbsp;</option>
					<?php 
						while ($row = $graveyards->fetch()) {
							$output = "<option value=\"";
							$output .= $row['id'];
							$output .= "\">";
							$output .= $row['name'];
							$output .= "</option>";
							echo $output;
						}
					?>
				</select>
			</label>
		</div>
		<div class="large-12 columns">
			<input type="submit" value="Add person" class="button expand" />
		</div>
	</form>
</div>

<?php include("../layouts/bottom.php"); ?>