<?php include("../layouts/top.php"); ?>

<h3>View Records by Name</h3>

<!-- TODO: pagination -->
<?php 
	$statement = $database->prepare(
		'SELECT *, p.id AS person_id
		 FROM person AS p
		 	LEFT JOIN plot ON p.plot_id = plot.id
		 	LEFT JOIN graveyard g ON plot.graveyard_id = g.id
		 ORDER BY p.last_name
		 LIMIT 50');
	$statement->execute();

	echo "<table>";
	echo "<tr>";
		echo "<th>Name</th>";
		echo "<th>Birthdate - Death Date</th>";
		echo "<th>Grave Location</th>";
	echo "</tr>";
	while ($row = $statement->fetch())
	{
		echo "<tr>";
			echo "<td>";
				echo "<a href='person.php?id=".$row['person_id']."'>";
				echo ucfirst($row['last_name']);
				if($row['first_name'])
				{
					echo ', ' .ucfirst($row['first_name']);
					if ($row['middle_name'])
					{
						echo ' ' .ucfirst($row['middle_name']);
					}
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

<?php include("../layouts/bottom.php"); ?>