<?php include("../layouts/top.php"); ?>

<h3>Delete Record</h3>

<?php
	if(!isset($_GET['id']))
	{
		echo "<dl><dt>An error occurred.</dt><dd>Please go back and try again</a>.</dd></dl>";
	}

	else
	{
		// Set plots to null
		$plots_q = 'UPDATE plot SET graveyard_id=NULL WHERE graveyard_id=' . $_GET['id'];
		$plots_stmt = $database->prepare($plots_q);
		$plots_stmt->execute();

		$statement = $database->prepare('DELETE FROM graveyard WHERE id=' . $_GET['id']);
		// $statement->bindParam(":id", $_GET['id']);

		$statement->execute();

		#print_r('<pre>');
		#print_r('$statement: ');
		#var_dump($statement);
		#print_r('</pre>');

		echo "<h5>Record deleted.</h5>";
		echo "<a href='../browse.php'>Return to browsing</a>";
	}
?>

<?php include("../layouts/bottom.php"); ?>