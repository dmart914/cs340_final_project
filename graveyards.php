<?php include("layouts/top.php"); ?>

<h2>View Records by Cemetery</h2>

<h4 class="subheader">&lt;BLURB HERE&gt;</h4>

<p>&lt;Sorting options here&gt;</p>


<!-- TODO: Pagination; number of occupants registered? -->
<?php 
	$statement = $database->prepare('SELECT id, name, city FROM graveyard ORDER BY name LIMIT 10');
	$statement->execute();

	echo "<table>";
	while ($row = $statement->fetch()) {
		echo "<tr>";
			echo "<td>";
				echo "<a href='graveyard.php?id=".$row['id']."'>";
				echo ucfirst($row['name']);
				echo "</a>";
			echo "</td>";
			echo "<td>";
				echo ucfirst($row['city']);
			echo "</td>";
		echo "</tr>";
	};
	echo "</table>";
?>

<?php include("layouts/bottom.php"); ?>