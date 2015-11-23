<?php include("layouts/top.php"); ?>

<h2>View Record</h2>

<?php
	if($_GET["id"])
	{
		$name = "";
		$street1 = "";
		$street2 = "";
		$city = "";
		$state = "";
		$zip = "";
		$contact = "";

		$statement = $database->prepare('SELECT * FROM graveyard WHERE id= :id');
		$statement->bindParam(":id", $_GET["id"]);
		$statement->execute();

		while($row = $statement->fetch())
		{
			$name = ucfirst($row['name']);
			if($row['street1'])
			{
				$street1 = ucfirst($row['street1']);
			}
			if($row['street2'])
			{
				$street2 = ucfirst($row['street2']);
			}
			if($row['city'])
			{
				$city = ucfirst($row['city']);
			}
			if($row['state'])
			{
				$state = ucfirst($row['state']);
			}
			if($row['zip'])
			{
				$zip = $row['zip'];
			}
			if($row['contact'])
			{
				$contact = ucfirst($row['contact']);
			}
		}
		echo "<h4 class='subheader'>";
		echo $name;
		echo "</h4>";

		echo "<p>&lt;Graveyard information here&gt;</p>";
	}
?>


<?php include("layouts/bottom.php"); ?>