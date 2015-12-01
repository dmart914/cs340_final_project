<?php include("../layouts/top.php"); ?>

<?php 
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$q = 'INSERT INTO person (first_name, middle_name, last_name, birthdate, ';
		$q .= 'death_date, death_location, cause_of_death, family_id, plot_id) VALUES ';
		$q .= '("' . $_POST["first_name"] . '","';
		$q .= $_POST["middle_name"] . '","';
		$q .= $_POST["last_name"] . '","';
		$q .= $_POST["birthdate"] . '","';
		$q .= $_POST["death_date"] . '","';
		$q .= $_POST["death_location"] . '","';
		$q .= $_POST["cause_of_death"] . '",';
		if ($_POST["family"] == "none") {
			$q .= 'NULL' . ',';
		} else {
			$q .= $_POST["family"] . ',';
		}

		if ($_POST["plot"] == "none") { 
			$q .= 'NULL' . ')';
		} else {
			$q .= $_POST["plot"] . ")";
		}

		$new_entry = $database->prepare($q);

		try { 
			$new_entry->execute();
			echo '<div data-alert class="alert-box success">Person added!</div>';
		} catch (PDOException $e) {
			echo '<div data-alert class="alert-box alert">Something went wrong!<br>';
			echo $e->getMessage();
			echo '</div>';
		}
	}
	

	// Get plots and families for form
	$q_1 = 'SELECT id, name FROM family ORDER BY id';
	$q_2 = 'SELECT p.id, p.x_coord, p.y_coord, g.name FROM plot p ';
	$q_2 .= 'INNER JOIN graveyard g ON g.id = p.graveyard_id ORDER BY id';

	$families = $database->prepare($q_1);
	$families->execute();

	$plots = $database->prepare($q_2);
	$plots->execute();

?>

<div class="row">
	<h1>New person</h1>

	<form action="./create.php" method="POST">
		<div class="large-12 columns">
			<label>First name
				<input type="text" name="first_name" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Middle name
				<input type="text" name="middle_name" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Last name
				<input type="text" name="last_name" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Birthdate (format: YYYY-MM-DD)
				<input type="text" name="birthdate"/>
			</label>
		</div>
		<div class="large-12 columns">
			<label>Death date (format: YYYY-MM-DD)
				<input type="text" name="death_date" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Death location
				<input type="text" name="death_location" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Cause of death
				<input type="text" name="cause_of_death" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Family
				<select name="family">
					<option value="none">&nbsp;</option>
					<?php
						while ($row = $families->fetch()) {
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
			<label>Plot
				<select name="plot">
					<option value="none">&nbsp;</option>
					<?php 
						while ($row = $plots->fetch()) {
							$output = "<option value=\"";
							$output .= $row['id'];
							$output .= "\">" . $row['id'] . ":";
							$output .= $row['name'] . " (" . $row['x_coord'];
							$output .= ", " . $row['y_coord'] . ")";
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