<?php include("layouts/top.php"); ?>

<h2>View Record</h2>

<?php
	if($_GET["id"])
	{
		$first_name = "";
		$middle_name = "";
		$last_name = "";

		$statement = $database->prepare('SELECT first_name, middle_name, last_name FROM person WHERE id= :id');
		$statement->bindParam(":id", $_GET["id"]);
		$statement->execute();

		while($row = $statement->fetch())
		{
			$first_name = ucfirst($row['first_name']);
			if($row['middle_name'])
			{
				$middle_name = ucfirst($row['middle_name']);
			}
			$last_name = ucfirst($row['last_name']);
		}
		echo "<h4 class='subheader'>";
		echo $first_name;
		if(strlen($middle_name) > 0)
		{
			echo " ".$middle_name;
		}
		echo " ".$last_name;
		echo "</h4>";

		echo "<ul>";
			echo "<li>Born: </li>";
			echo "<li>Died: </li>";
			echo "<li>Cause of death: </li>";
			echo "<li>&lt;etc&gt;</li>";
		echo "</ul>";
	}
?>


<?php include("layouts/bottom.php"); ?>