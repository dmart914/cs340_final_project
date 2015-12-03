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

		print_r('<pre>');
		print_r('$rel_ins_stmt: ');
		var_dump($rel_ins_stmt);
		print_r('</pre>');



		$statement = $database->prepare('DELETE FROM person WHERE id=' . $_GET['id']);
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