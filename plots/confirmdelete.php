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
			SELECT x_coord, y_coord, graveyard_id
			FROM plot
			WHERE id = :id');
		$statement->bindParam(":id", $_GET['id']);
		$statement->execute();

		while($row = $statement->fetch())
		{
			if($row['x_coord'])
			{
				$x_coord = " ".ucfirst($row['x_coord']);
			}
			if($row['y_coord'])
			{
				$y_coord = " ".ucfirst($row['y_coord']);
			}
			if($row['graveyard_id'])
			{
				$graveyard_id = " ".ucfirst($row['graveyard_id']);
			}
		}

		echo "<dl>";
			echo "<dt>";
				echo "Really delete record for".$x_coord.", ".$y_coord."?";
			echo "</dt>";
			echo "<dd>";
				echo "<a class='small button alert' href='delete.php?id=".$_GET['id']."'>Delete</a>";
				echo "<a class='small button secondary' href='../person.php?id=".$_GET['id']."'>Cancel</a>";
			echo "</dd>";
		echo "</dl>";
	}
?>

<?php include("../layouts/bottom.php"); ?>