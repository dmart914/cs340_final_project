<?php include('../layouts/top.php'); ?>

<?php 
// Get the ID of the requested object
$obj_id = 0;
if (!isset($_GET['id']))
{
    echo "<h5>No family was selected. Please go back and try again.";    
}

else
{
    $obj_id = $_GET['id'];
}


// Check for POST, edit object
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Build the query, make the SQL call
    $q_edit = 'UPDATE family SET ';
    $q_edit .= 'name="' . $_POST["name"] . '", ';
    $q_edit .= 'origin="' . $_POST["origin"] . '" ';
    $q_edit .= 'WHERE id=' . $obj_id . ' LIMIT 1';

    $edit_object = $database->prepare($q_edit);

    try {

        $edit_object->execute();

        echo '<div data-alert class="alert-box success">Family edited!</div>';

    } catch (PDOException $e) {
        echo '<div data-alert class="alert-box alert">Something went wrong!<br>';
        echo $e->getMessage();
        echo '</div>';
    }
}


// Get the requested object
// Build the query and make the SQL call
$q = 'SELECT * FROM family WHERE family.id=' . $obj_id;
$stmt = $database->prepare($q);

try {
    $stmt->execute();
    $entry = $stmt->fetch();

} catch (PDOException $e) {
    echo '<div data-alert class="alert-box alert">Something went wrong!<br>';
    echo $e->getMessage();
    echo '</div>';
}

?>

<div class="row">
    <h1>Edit family: <?php echo $entry["name"]; ?></h1>

    <form action="./edit.php?id=<?php echo $obj_id ?>" method="POST">
        <div class="large-12 columns">
            <label>Name
                <input type="text" name="name" value="<?php echo $entry["name"]; ?>" />
            </label>
        </div>
        <div class="large-12 columns">
            <label>Origin
                <input type="text" name="origin" value="<?php echo $entry["origin"]; ?>" />
            </label>
        </div>
        <div class="row">
            <div class="small-3 columns">
                <input type="submit" value="Submit Changes" class="button" />
            </div>
            <div class="small-3 columns">
                <a href="delete.php?id=<?php echo $obj_id ?>" class="button alert">Delete Family</a>
            </div>
            <div class="small-6 columns">
            </div>
        </div>
    </form>
</div>


<?php include('../layouts/bottom.php'); ?>