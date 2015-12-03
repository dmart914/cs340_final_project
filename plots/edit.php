<?php include("../layouts/top.php"); ?>

<?php 

// STILL NEED TO FIGURE OUT HOW TO SET INITIAL
// VALUE OF GRAVEYARD AND PERSON TO CORRECT
// VALUES

// Get the ID of the requested object
print_r('<pre>');
print_r('$_GET: ');
var_dump($_GET);
print_r('</pre>');

$obj_id = 0;
if ($_GET['id']) {
    $obj_id = $_GET['id'];
} else {
    // Add redirect or error message here
}


// Check for POST, edit object
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r('<pre>');
    print_r('$_POST: ');
    var_dump($_POST);
    print_r('</pre>');

    // Build the query, make the SQL call
    $q_edit = 'UPDATE plot SET ';
    $q_edit .= 'x_coord=' . $_POST["x_coord"] . ', '; 
    $q_edit .= 'y_coord=' . $_POST["y_coord"] . ', '; 
    $q_edit .= 'graveyard_id=' . $_POST["graveyard"] . ' ';
    $q_edit .= 'WHERE id=' . $obj_id . ' LIMIT 1';
    print_r('<pre>');
    print_r('$q_edit: ');
    var_dump($q_edit);
    print_r('</pre>');

    $edit_object = $database->prepare($q_edit);

    try {
        $edit_object->execute();

        echo '<div data-alert class="alert-box success">Family edited!</div>';

    } catch (PDOException $e) {
        echo '<div data-alert class="alert-box alert">Something went wrong!<br>';
        echo $e->getMessage();
        echo '</div>';
    }

    // Get person to whom plot belongs
    $person_q = 'SELECT id FROM person WHERE plot_id=' . $obj_id;
	print_r('<pre>');
	print_r('$person_q: ');
	var_dump($person_q);
	print_r('</pre>');

    $person_stmt = $database->prepare($person_q);
    $person_stmt->execute();
    $person_id = $person_stmt->fetch();
    print_r('<pre>');
	print_r('$person_id: ');
	var_dump($person_id);
	print_r('</pre>');

    // Check for diff, update
    if ($person_id[0] != $_POST['occupant']) {
    	$old_person_update = 'UPDATE person SET plot_id=NULL WHERE id=';
    	$old_person_update .= $person_id[0];
    	$new_person_update = 'UPDATE person SET plot_id=';
    	$new_person_update .= $obj_id . ' WHERE id=' . $_POST['occupant'];

    	print_r('<pre>');
		print_r('$old_person_update: ');
		var_dump($old_person_update);
		print_r('</pre>');
		print_r('<pre>');
		print_r('$new_person_update: ');
		var_dump($new_person_update);
		print_r('</pre>');

    	$old_person_stmt = $database->prepare($old_person_update);
    	$new_person_stmt = $database->prepare($new_person_update);

    	try {
    		$old_person_stmt->execute();
    		$new_person_stmt->execute();
    	} catch (PDOException $e) {
			echo '<div data-alert class="alert-box alert">Something went wrong!<br>';
			echo $e->getMessage();
			echo '</div>';		
		}
    }
}


// Get the requested object
$q = 'SELECT * FROM plot WHERE plot.id=' . $obj_id;
$stmt = $database->prepare($q);

try {
	$stmt->execute();
	$entry = $stmt->fetch();
	print_r('<pre>');
    print_r('$entry: ');
    var_dump($entry);
    print_r('</pre>');

} catch (PDOException $e) {
    echo '<div data-alert class="alert-box alert">Something went wrong!<br>';
    echo $e->getMessage();
    echo '</div>';
}

// Get people and graveyards
$current_person_q = 'SELECT id, first_name, middle_name, last_name FROM person WHERE id=' . $entry['id'];
$current_person_stmt = $database->prepare($current_person_q);
$current_person_stmt->execute();
$current_person = $current_person_stmt->fetch();
print_r('<pre>');
print_r('$current_person: ');
var_dump($current_person);
print_r('</pre>');

$current_graveyard_q = 'SELECT id, name FROM graveyard WHERE id=' . $entry['graveyard_id'];
$current_graveyard_stmt = $database->prepare($current_graveyard_q);
$current_graveyard_stmt->execute();
$current_graveyard = $current_graveyard_stmt->fetch();
print_r('<pre>');
print_r('$current_graveyard_q: ');
var_dump($current_graveyard_q);
print_r('</pre>');
print_r('<pre>');
print_r('$current_graveyard: ');
var_dump($current_graveyard);
print_r('</pre>');

$q_1 = 'SELECT id, first_name, middle_name, last_name, plot_id FROM person ORDER BY id';
$q_2 = 'SELECT id, name FROM graveyard ORDER BY id';

$people = $database->prepare($q_1);
$people->execute();

$graveyards = $database->prepare($q_2);
$graveyards->execute();

?>

<div class="row">
	<h1>New plot</h1>

	<form action="./edit.php?id=<?php echo $obj_id; ?>" method="POST">
		<div class="large-12 columns">
			<label>X coordinate
				<input type="text" name="x_coord" value="<?php echo $entry['x_coord']; ?>" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Y coordinate
				<input type="text" name="y_coord" value="<?php echo $entry['y_coord']; ?>" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Occupant
				<select name="occupant">
					<?php
						if ($current_person) {
							echo "<option value=\"";
							echo $current_person['id'];
							echo "\">";
							echo $current_person['first_name'] . ' ';
							echo $current_person['middle_name'] . ' ';
							echo $current_person['last_name'];
							echo "</option>";
						}
					?>
					<option value="none">(none)</option>
					<?php 
						while ($row = $people->fetch()) {
							if ($row['id'] != $current_person['id']) {
								$output = "<option value=\"";
								$output .= $row['id'];
								$output .= "\">";
								$output .= $row['first_name'] . ' ';
								$output .= $row['middle_name'] . ' ';
								$output .= $row['last_name'];
								$output .= "</option>";
								echo $output;
							}
						}
					?>
				</select>
			</label>
		</div>
		<div class="large-12 columns">
			<label>Graveyard
				<select name="graveyard">
					<?php 
						if ($current_graveyard) {
							echo "<option value=\"";
							echo $current_graveyard['id'];
							echo "\">";
							echo $current_graveyard['name'];
							echo "</option>";
						}
					?>
					<option value="none">(none)</option>
					<?php 
						while ($row = $graveyards->fetch()) {
							if ($row['id'] != $current_graveyard['id']) {
								$output = "<option value=\"";
								$output .= $row['id'];
								$output .= "\">";
								$output .= $row['name'];
								$output .= "</option>";
								echo $output;
							}
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