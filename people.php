<?php include("layouts/top.php"); ?>

<h2>View Records by Name</h2>

<h4 class="subheader">&lt;BLURB HERE&gt;</h4>

<p>&lt;Sorting options here&gt;</p>


<!-- TODO: pagination -->
<?php 
	$statement = $database->prepare(
		'SELECT p.id, p.first_name, p.middle_name, p.last_name, p.birthdate, p.death_date, g.city, g.state
		 FROM person AS p, graveyard AS g, plot
		 WHERE p.plot_id = plot.id
		 	AND g.id = plot.graveyard_id
		 GROUP BY p.last_name
		 ORDER BY p.last_name
		 LIMIT 10');
	$statement->execute();

	echo "<table>";
	while ($row = $statement->fetch())
	{
		echo "<tr>";
			echo "<td>";
				echo "<a href='person.php?id=".$row['id']."'>";
				echo ucfirst($row['last_name']).', ';
				echo ' ' .ucfirst($row['first_name']);
				if ($row['middle_name'])
				{
					echo ' ' .ucfirst($row['middle_name']);
				}
				echo "</a>";
			echo "</td>";
			echo "<td>";
				if($row['birthdate'])
				{
					echo $row['birthdate'];
				}
				else
				{
					echo "unknown";
				}
				echo " - ";
				if($row['death_date'])
				{
					echo $row['death_date'];
				}
				else
				{
					echo "unknown";
				}
			echo "</td>";
			echo "<td>";
				if($row['city'])
				{
					echo $row['city'];
				}
				if($row['city'] && $row['state'])
				{
					echo ", ";
				}
				if($row['state'])
				{
					echo $row['state'];
				}
			echo "</td>";
		echo "</tr>";
	};
	echo "</table>";
?>

<?php include("layouts/bottom.php"); ?>