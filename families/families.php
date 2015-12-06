<?php include("../layouts/top.php"); ?>

<h3>View Records by Family</h3>
<?php 
	$statement = $database->prepare('SELECT id, name, origin FROM family ORDER BY name LIMIT 10');
	$statement->execute();

	echo "<table>";
	echo "<tr>";
		echo "<th>Family Name</th>";
		echo "<th>Place of Origin</th>";
	echo "</tr>";
	while ($row = $statement->fetch()) {
		echo "<tr>";
			echo "<td>";
				echo "<a href='family.php?id=".$row['id']."'>";
				echo ucfirst($row['name']);
				echo "</a>";
			echo "</td>";
			echo "<td>";
				echo ucfirst($row['origin']);
			echo "</td>";
		echo "</tr>";
	};
	echo "</table>";
?>

<?php include("../layouts/bottom.php"); ?>