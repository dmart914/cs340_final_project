<?php include("../layouts/top.php"); ?>

<h3>View Records by Cemetery</h3>

<!-- <h4 class="subheader">&lt;BLURB HERE&gt;</h4> -->

<!-- TODO: Pagination; number of occupants registered? -->
<!-- NOTE: Don't bother with pagination... Takes too much time - DM 12/1/15 -->
<?php 
	$statement = $database->prepare('SELECT id, name, city, state FROM graveyard ORDER BY name LIMIT 10');
	$statement->execute();

	echo "<table>";
	echo "<tr>";
		echo "<th>Name</th>";
		echo "<th>Location</th>";
	echo "</tr>";
	while ($row = $statement->fetch()) {
		echo "<tr>";
			echo "<td>";
				echo "<a href='graveyard.php?id=".$row['id']."'>";
				echo ucfirst($row['name']);
				echo "</a>";
			echo "</td>";
			echo "<td>";
				if($row['city'])
				{
					echo ucfirst($row['city']);
				}
				if($row['city'] && $row['state'])
				{
					echo ", ";
				}
				if($row['state'])
				{
					echo ucfirst($row['state']);
				}
			echo "</td>";
		echo "</tr>";
	};
	echo "</table>";
?>

<?php include("../layouts/bottom.php"); ?>