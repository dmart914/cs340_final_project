<?php include("../layouts/top.php"); ?>

<?php
// Get the ID of the requested object
// print_r('<pre>');
// print_r('$_GET: ');
// var_dump($_GET);
// print_r('</pre>');

$obj_id = 0;
if ($_GET['id']) {
    $obj_id = $_GET['id'];
} else {
    // Add redirect or error message here
}

// Check for POST, edit object
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // print_r('<pre>');
    // print_r('$_POST: ');
    // var_dump($_POST);
    // print_r('</pre>');

    // Build the query, make the SQL call
    $q_edit = 'UPDATE graveyard SET ';
    $q_edit .= 'name="' . $_POST["name"] . '", ';
    $q_edit .= 'street1="' . $_POST["street1"] . '", ';
    $q_edit .= 'street2="' . $_POST["street2"] . '", ';
    $q_edit .= 'city="' . $_POST["city"] . '", ';
    $q_edit .= 'state="' . $_POST["state"] . '", ';
    $q_edit .= 'zip="' . $_POST["zip"] . '", ';
    $q_edit .= 'contact="' . $_POST["contact"] . '" ';
    $q_edit .= 'WHERE id=' . $obj_id . ' LIMIT 1';
    // print_r('<pre>');
    // print_r('$q_edit: ');
    // var_dump($q_edit);
    // print_r('</pre>');

    $edit_object = $database->prepare($q_edit);

    try {
    	$edit_object->execute();

    	echo '<div data-alert class="alert-box success">Graveyard edited!</div>';
    } catch (PDOException $e) {
        echo '<div data-alert class="alert-box alert">Something went wrong!<br>';
        echo $e->getMessage();
        echo '</div>';
    }
}

// Get the requested object
// Build the query and make the SQL call
$q = 'SELECT * FROM graveyard WHERE graveyard.id=' . $obj_id;
$stmt = $database->prepare($q);

try {
    $stmt->execute();
    $entry = $stmt->fetch();
    // print_r('<pre>');
    // print_r('$entry: ');
    // var_dump($entry);
    // print_r('</pre>');

} catch (PDOException $e) {
    echo '<div data-alert class="alert-box alert">Something went wrong!<br>';
    echo $e->getMessage();
    echo '</div>';
}

?>

<div class="row">
	<h1>New graveyard</h1>

	<form action="./edit.php?id=<?php echo $obj_id; ?>" method="POST">
		<div class="large-12 columns">
			<label>Name
				<input type="text" name="name" value="<?php echo $entry["name"]; ?>" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Street
				<input type="text" name="street1" value="<?php echo $entry["street1"]; ?>" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Street 2
				<input type="text" name="street2" value="<?php echo $entry["street2"]; ?>" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>City
				<input type="text" name="city" value="<?php echo $entry["city"]; ?>" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>State
				<input type="text" name="state" value="<?php echo $entry["state"]; ?>" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Zip
				<input type="text" name="zip" value="<?php echo $entry["zip"]; ?>" />
			</label>
		</div>
		<div class="large-12 columns">
			<label>Contact
				<input type="text" name="contact" value="<?php echo $entry["contact"]; ?>" />
			</label>
		</div>
		<div class="row">
            <div class="small-3 columns">
                <input type="submit" value="Submit Changes" class="button" />
            </div>
            <div class="small-3 columns">
                <a href="delete.php?id=<?php echo $obj_id ?>" class="button alert">Delete Graveyard</a>
            </div>
            <div class="small-6 columns">
            </div>
        </div>
	</form>
</div>

<?php include("../layouts/bottom.php"); ?>