<?php include("../layouts/top.php"); ?>

<h3>Delete Record</h3>

<?php
	if(!isset($_GET['id']))
	{
		echo "<dl><dt>An error occurred.</dt><dd>Please go back and try again</a>.</dd></dl>";
	}

	else
	{
		// Delele relationship instances
		$rel_ins_q = 'DELETE FROM relationship_instance WHERE ';
		$rel_ins_q .= 'person_id=' . $_GET['id'] . ' OR ';
		$rel_ins_q .= 'relative_id=' . $_GET['id'];
		$rel_ins_stmt = $database->prepare($rel_ins_q);
		$rel_ins_stmt->execute();

		$statement = $database->prepare('DELETE FROM person WHERE id=' . $_GET['id']);

		$statement->execute();

		echo "<h5>Record deleted.</h5>";
		echo "<a href='../browse.php'>Return to browsing</a>";
	}
?>

<?php include("../layouts/bottom.php"); ?>