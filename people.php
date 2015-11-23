<?php include("layouts/top.php"); ?>

<h2>View Records by Name</h2>

<h4 class="subheader">&lt;BLURB HERE&gt;</h4>

<p>&lt;Sorting options here&gt;</p>


<!-- TODO: Use joins to grab dates and locations for each person -->
<?php 
	$statement = $database->prepare('SELECT first_name, middle_name, last_name FROM person ORDER BY last_name LIMIT 10');
	$statement->execute();

	echo "<table>";
	while ($row = $statement->fetch()) {
		echo "<tr>";
			echo "<td>";
			echo ucfirst($row['last_name']).', ';
			echo ' ' .ucfirst($row['first_name']);
			if ($row['middle_name']) {
				echo ' ' .ucfirst($row['middle_name']);
			echo "</td>";
		}
		echo "<td>Birthdate - death date?</td><td>Grave location?</td>";
		echo "</tr>";
	};
	echo "</table>";
?>


<?php include("layouts/bottom.php"); ?>