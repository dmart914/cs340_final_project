<?php include("../layouts/top.php"); ?>

<h2>View Record</h2>

<?php
	if($_GET["id"])
	{
		$name = "";
		$origin = "unknown";

		$statement = $database->prepare('SELECT name, origin FROM family WHERE id= :id');
		$statement->bindParam(":id", $_GET["id"]);
		$statement->execute();

		while($row = $statement->fetch())
		{
			$name = ucfirst($row['name']);
			if($row['origin'])
			{
				$origin = ucfirst($row['origin']);
			}
		}
		echo "<h4 class='subheader'>";
		echo "The ".$name." Family";
		echo "</h4>";

		echo "<dl><dt>Origin</dt><dd>".ucfirst($origin)."</dd></dl>";

		$statement = $database->prepare('SELECT p.id, p.first_name, p.middle_name, p.last_name FROM person AS p WHERE p.family_id= :id');
		$statement->bindParam(":id", $_GET["id"]);
		$statement->execute();

		echo "<h5>Registered members</h5>";
		echo "<table>";
		while($row = $statement->fetch())
		{
			echo "<tr>";
				echo "<td>";
					echo "<a href='../people/person.php?id=".$row['id']."'>";
					echo ucfirst($row['last_name']);
					if($row['first_name'])
					{
						echo ", ".ucfirst($row['first_name']);
					}
					if($row['middle_name'])
					{
						echo " ".ucfirst($row['middle_name']);
					}
					echo "</a>";
				echo "</td>";
			echo "</tr>";
		}
		echo "</table>";

		echo "<a class='tiny button' href='edit.php'>Edit Entry</a>";
	}
?>


<?php include("../layouts/bottom.php"); ?>