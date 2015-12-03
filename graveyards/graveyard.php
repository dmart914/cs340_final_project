<?php include("../layouts/top.php"); ?>

<h4 class="subheader">View Record</h4>

<?php
	if($_GET["id"])
	{
		$name = "";
		$street1 = "";
		$street2 = "";
		$city = "";
		$state = "";
		$zip = "";
		$contact = "Unavailable";

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
		echo "<h3>";
		echo $name;
		echo "</h3>";

		echo "<p>";
			if(strlen($street1) > 0)
			{
				echo $street1."<br>";
			}
			if(strlen($street2) > 0)
			{
				echo $street2."<br>";
			}
			echo $city;
			if(strlen($city) > 0 && strlen($state) > 0)
			{
				echo ", ";
			}
			echo $state." ";
			echo $zip;
		echo "</p>";

		echo "<p>Contact: ".$contact."</p>";

		echo "<h5>Registered occupants</h5>";

		$statement = $database->prepare(
			'SELECT p.id, p.last_name, p.first_name, p.middle_name, plot.x_coord, plot.y_coord
			FROM person AS p, plot, graveyard AS g
			WHERE g.id= :id
				AND plot.graveyard_id = g.id
				AND p.plot_id = plot.id
			GROUP BY p.last_name
			ORDER BY p.last_name
			LIMIT 10');
		$statement->bindParam(":id", $_GET["id"]);
		$statement->execute();

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
				echo "<td>";
					if($row['x_coord'] && $row['y_coord'])
					{
						echo "(".$row['x_coord'].", ".$row['y_coord'].")";
					}
					else
					{
						echo "Coordinates unavailable.";
					}
				echo "</td>";
			echo "</tr>";
		}
		echo "</table>";

		echo "<a class='tiny button' href='edit.php'>Edit Entry</a>";
	}
?>


<?php include("../layouts/bottom.php"); ?>