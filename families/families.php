<?php include("layouts/top.php"); ?>

<h3>View Records by Family</h3>

<!-- <h4 class="subheader">&lt;BLURB HERE&gt;</h4> -->

<p>&lt;Sorting options here&gt;</p>


<!-- TODO: Pagination; number of members registered? -->
<?php 
	$statement = $database->prepare('SELECT id, name, origin FROM family ORDER BY name LIMIT 10');
	$statement->execute();

	echo "<table>";
	while ($row = $statement->fetch()) {
		echo "<tr>";
			echo "<td>";
				echo "<a href='families/family.php?id=".$row['id']."'>";
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

<?php include("layouts/bottom.php"); ?>