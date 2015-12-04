<?php include("../layouts/top.php"); ?>

<h3>Delete Record</h3>

<?php
	if(!isset($_GET['id']))
	{
		echo "<dl><dt>An error occurred.</dt><dd>Please go back and try again</a>.</dd></dl>";
	}

	else
	{

		$statement = $database->prepare('DELETE FROM plot WHERE id=' . $_GET['id']);
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