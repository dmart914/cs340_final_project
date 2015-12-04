<?php include("../layouts/top.php"); ?>

<h4 class="subheader">View Record</h4>

<!-- TODO: List family members, link to family page, list burial information -->

<?php
	if($_GET["id"])
	{
		$first_name = "Unknown";
		$middle_name = "Unknown";
		$last_name = "Unknown";
		$birthdate = "Unknown";
		$death_date = "Unknown";
		$death_location = "Unknown";
		$cause_of_death = "Unknown";
		$image_path = "none";
		$plot_id = "";
		$graveyard_id = "";
		$graveyard_name = "Unknown";
		$plot_x = "";
		$plot_y = "";

		$statement = $database->prepare(
			'SELECT *, p.id AS person_id, plot.id AS plot_id, g.id AS g_id,
				g.name AS g_name
		 	 FROM person AS p
		 	 	LEFT JOIN plot ON p.plot_id = plot.id
		 	 	LEFT JOIN graveyard g ON plot.graveyard_id = g.id
			 WHERE p.id= :id');
		$statement->bindParam(":id", $_GET["id"]);
		$statement->execute();

		while($row = $statement->fetch())
		{
			$first_name = ucfirst($row['first_name']);
			if(isset($row['middle_name']))
			{
				$middle_name = ucfirst($row['middle_name']);
			}
			$last_name = ucfirst($row['last_name']);
			if(isset($row['birthdate']))
			{
				$birthdate = ucfirst($row['birthdate']);
			}
			if(isset($row['death_date']))
			{
				$death_date = ucfirst($row['death_date']);
			}
			if(isset($row['death_location']))
			{
				$death_location = ucfirst($row['death_location']);
			}
			if(isset($row['cause_of_death']))
			{
				$cause_of_death = ucfirst($row['cause_of_death']);
			}
			if(isset($row['plot_id']))
			{
				$plot_id = $row['plot_id'];
			}
			if(isset($row['g_id']))
			{
				$graveyard_id = $row['g_id'];
			}
			if(isset($row['g_name']))
			{
				$graveyard_name = ucfirst($row['g_name']);
			}
			if(isset($row['x_coord']))
			{
				$plot_x = ucfirst($row['x_coord']);
			}
			if(isset($row['y_coord']))
			{
				$plot_y = ucfirst($row['y_coord']);
			}
		}

		echo "<div class='row'>";
			echo "<div class='small-12 columns'>";
				echo "<h3>";
				echo $first_name;
				if($middle_name != "unknown")
				{
					echo " ".$middle_name;
				}
				echo " ".$last_name;
				echo "</h3>";
			echo "</div>";
		echo "</div>";

		echo "<div class='row'>";
			echo "<div class='small-8 columns'>";
				echo "<dl>";

					echo "<dt>Born:</dt><dd>".$birthdate."</dd>";

					echo "<dt>Died:</dt><dd>".$death_date;
					if($death_location != "unknown")
					{
						echo " in ".$death_location;
					}
					echo "</dd>";

					echo "<dt>Cause of death:</dt><dd>".$cause_of_death."</dd>";

					echo "<dt>Interred at:</dt>";
					echo "<dd>";
						if(strlen($graveyard_id) > 0)
						{
							echo "<a href='../graveyards/graveyard.php?id=".$graveyard_id."'>";
						}
						echo $graveyard_name;
						if(strlen($graveyard_id) > 0)
						{
							echo "</a>";
						}
					echo "</dd>";

					echo "<dt>Plot location:</dt>";
					echo "<dd>";
						if(strlen($plot_x) > 0 && strlen($plot_y) > 0)
						{
							echo "(".$plot_x.", ".$plot_y.")";
						}
						else
						{
							echo "Unknown";
						}
					echo "</dd>";

				echo "</dl>";

				/*$statement = $database->prepare(
					'SELECT id, first_name, middle_name, last_name
				 	 FROM person
					 WHERE id IN (  SELECT relative_id
					 				FROM relationship_instance
					 				WHERE person_id= :id)');*/
				$statement = $database->prepare(
					'SELECT p.id, p.first_name, p.last_name, rt.relationship_type
					 FROM person p
					 	INNER JOIN (SELECT *
					 				FROM relationship_instance
					 				WHERE person_id= :id) r
							ON r.person_id=p.id OR r.relative_id=p.id
						INNER JOIN relationship rt
							ON rt.id = r.relationship_id
					 WHERE p.id <> :id');
				$statement->bindParam(":id", $_GET["id"]);
				$statement->execute();

				echo "<h5>Listed family members:</h5>";
				echo "<table>";
				echo "<tr>";
					echo "<th>Name</th>";
					echo "<th>Relation to ".ucfirst($first_name)."</th>";
				echo "</tr>";
				while($row = $statement->fetch())
				{
					echo "<tr>";
						echo "<td>";
							echo "<a href='person.php?id=".$row['id']."'>";
							if(isset($row['last_name']))
							{
								echo ucfirst($row['last_name']);
							}
							if(isset($row['first_name']))
							{
								echo ", ".ucfirst($row['first_name']);
								if(isset($row['middle_name']))
								{
									echo " ".ucfirst($row['middle_name']);
								}
							}
							echo "</a>";
						echo "</td>";
						echo "<td>";
							if(isset($row['relationship_type']))
							{
								echo ucfirst($row['relationship_type']);
							}
						echo "</td>";
					echo "</tr>";
				}
				echo "</table>";

				echo "<form action='edit.php' method='post'>";
					echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
					echo "<input type='submit' class='tiny button' value='Edit Entry'>";
				echo "</form>";
			echo "</div>";
			echo "<div class='small-4 columns'>";
				if($image_path == "none")
				{
					echo "<h6 class='subheader'><i>No image available.</i></h6>";
				}
				else
				{
					echo "<img src='".$image_path."' 
						   	   alt='".$first_name." ".$middle_name." ".$last_name."'>";
				}
			echo "</div>";
		echo "</div>";
	}
?>


<?php include("../layouts/bottom.php"); ?>