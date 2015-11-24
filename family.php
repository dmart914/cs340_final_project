<?php include("layouts/top.php"); ?>

<h2>View Record</h2>

<?php
	if($_GET["id"])
	{
		$name = "";
		$origin = "";

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

		echo "<p>&lt;Family information here&gt;</p>";

		echo "<a class='tiny button' href='#'>Edit Entry</a>";
	}
?>


<?php include("layouts/bottom.php"); ?>