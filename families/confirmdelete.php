<?php include("../layouts/top.php"); ?>

<h3>Delete Record</h3>

<?php
	if(!isset($_GET['id']))
	{
		echo "<dl><dt>An error occurred.</dt><dd>Please go back and try again</a>.</dd></dl>";
	}

	else
	{
		$name = "";
		$origin = "";

		$statement = $database->prepare('
			SELECT name, origin
			FROM family
			WHERE id = :id');
		$statement->bindParam(":id", $_GET['id']);
		$statement->execute();

		while($row = $statement->fetch())
		{
			if($row['name'])
			{
				$name = " ".ucfirst($row['name']);
			}
			if($row['origin'])
			{
				$origin = " ".ucfirst($row['origin']);
			}
		}

		echo "<dl>";
			echo "<dt>";
				echo "Really delete record for".$name.' - '.$origin."?";
			echo "</dt>";
			echo "<dd>";
				echo "<a class='small button alert' href='delete.php?id=".$_GET['id']."'>Delete</a>";
				echo "<a class='small button secondary' href='../person.php?id=".$_GET['id']."'>Cancel</a>";
			echo "</dd>";
		echo "</dl>";
	}
?>

<?php include("../layouts/bottom.php"); ?>