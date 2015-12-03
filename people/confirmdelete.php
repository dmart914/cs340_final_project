<?php include("../layouts/top.php"); ?>

<h3>Delete Record</h3>

<?php
	if(!isset($_GET['id']))
	{
		echo "<dl><dt>An error occurred.</dt><dd>Please go back and try again</a>.</dd></dl>";
	}

	else
	{
		$first_name = "";
		$middle_name = "";
		$last_name = "";

		$statement = $database->prepare('
			SELECT first_name, last_name, middle_name
			FROM person
			WHERE id = :id');
		$statement->bindParam(":id", $_GET['id']);
		$statement->execute();

		while($row = $statement->fetch())
		{
			if($row['first_name'])
			{
				$first_name = " ".ucfirst($row['first_name']);
			}
			if($row['middle_name'])
			{
				$middle_name = " ".ucfirst($row['middle_name']);
			}
			if($row['last_name'])
			{
				$last_name = " ".ucfirst($row['last_name']);
			}
		}

		echo "<dl>";
			echo "<dt>";
				echo "Really delete record for".$first_name.$middle_name.$last_name."?";
			echo "</dt>";
			echo "<dd>";
				echo "<a class='small button alert' href='delete.php?id=".$_GET['id']."'>Delete</a>";
				echo "<a class='small button secondary' href='../person.php?id=".$_GET['id']."'>Cancel</a>";
			echo "</dd>";
		echo "</dl>";
	}
?>

<?php include("../layouts/bottom.php"); ?>