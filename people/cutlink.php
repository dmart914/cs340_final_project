<?php 
// Take in a method and two ids, cut the link between them on the table
// params:
//	id1=y&id2=z

include("../layouts/top.php");

if (!isset($_GET['id1'])) {
	echo "<dl><dt>An error occurred.</dt><dd>Please go back and try again</a>.</dd></dl>";
} else {
	
	$q = 'DELETE FROM relationship_instance WHERE ';
	$q .= '(person_id=' . $_GET['id1'] . ' AND relative_id=' . $_GET['id2'] . ')';
	$q .= ' OR ';
	$q .= '(person_id=' . $_GET['id2'] . ' AND relative_id=' . $_GET['id1'] . ')';

	$stmt = $database->prepare($q);

	$stmt->execute();

	echo "<h5>Relationship deleted.</h5>";
	echo "<a href='../browse.php'>Return to browsing</a>";
	
}

?>

<?php include("../layouts/bottom.php"); ?>