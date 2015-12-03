<?php include('../layouts/top.php'); ?>

<?php 
// Get the ID of the requested object
#print_r('<pre>');
#print_r('$_GET: ');
#var_dump($_GET);
#print_r('</pre>');

$obj_id = 0;
if (!isset($_GET['id']))
{
    // Add redirect or error message here
    
}

else
{
    $obj_id = $_GET['id'];
}


// Check for POST, edit object
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    #print_r('<pre>');
    #print_r('$_POST: ');
    #var_dump($_POST);
    #print_r('</pre>');

    // Build the query, make the SQL call
    $q_edit = 'UPDATE family SET ';
    $q_edit .= 'name="' . $_POST["name"] . '", ';
    $q_edit .= 'origin="' . $_POST["origin"] . '" ';
    $q_edit .= 'WHERE id=' . $obj_id . ' LIMIT 1';
    #print_r('<pre>');
    #print_r('$q_edit: ');
    #var_dump($q_edit);
    #print_r('</pre>');

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
    #print_r('<pre>');
    #print_r('$entry: ');
    #var_dump($entry);
    #print_r('</pre>');

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
        <div class="large-12 columns">
            <input type="submit" value="Submit Changes" class="button expand" />
        </div>
    </form>
</div>


<?php include('../layouts/bottom.php'); ?>