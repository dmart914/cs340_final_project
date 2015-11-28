<?php include("layouts/top.php"); ?>

<h4 class="subheader">View Record</h4>

<!-- TODO: List family members, link to family page, list burial information -->

<?php
	if($_GET["id"])
	{
		$first_name = "unknown";
		$middle_name = "unknown";
		$last_name = "unknown";
		$birthdate = "unknown";
		$death_date = "unknown";
		$death_location = "unknown";
		$cause_of_death = "unknown";

		$statement = $database->prepare('SELECT * FROM person WHERE id= :id');
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
			if($row['birthdate'])
			{
				$birthdate = ucfirst($row['birthdate']);
			}
			if($row['death_date'])
			{
				$death_date = ucfirst($row['death_date']);
			}
			if($row['death_location'])
			{
				$death_location = ucfirst($row['death_location']);
			}
			if($row['cause_of_death'])
			{
				$cause_of_death = ucfirst($row['cause_of_death']);
			}
		}
		echo "<h3>";
		echo $first_name;
		if($middle_name != "unknown")
		{
			echo " ".$middle_name;
		}
		echo " ".$last_name;
		echo "</h3>";

		echo "<dl>";
			echo "<dt>Born:</dt><dd>".$birthdate."</dd>";
			echo "<dt>Died:</dt><dd>".$death_date;
			if($death_location != "unknown")
			{
				echo " in ".$death_location;
			}
			echo "</dd>";
			echo "<dt>Cause of death:</dt><dd>".$cause_of_death."</dd>";
			echo "<dt>&lt;etc&gt;</dt>";
		echo "</dl>";

		echo "<a class='tiny button' href='#'>Edit Entry</a>";
	}
?>


<?php include("layouts/bottom.php"); ?>