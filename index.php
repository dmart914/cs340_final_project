<?php include("layouts/top.php"); ?>

<h1>Grave History </h1>

<h4 class="subheader">Preserving historical graveyard information for researchers, cemetery districts and the curious</h4>

<h4>Graveyards:</h4>
<ul>
<?php 
	$statement = $database->prepare('SELECT name, city, state FROM graveyard LIMIT 10');
	$statement->execute();
	while ($row = $statement->fetch()) {
		echo "<li>";
		echo $row['name'] . ' - ';
		if ($row['city']) {
			echo $row['city'] . ', ';
		}
		echo $row['state'];
		echo "</li>";
	};
?>
</ul>

<h4>People:</h4>
<ul>
<?php 
	$statement = $database->prepare('SELECT first_name, middle_name, last_name FROM person LIMIT 10');
	$statement->execute();
	while ($row = $statement->fetch()) {
		echo "<li>";
		echo $row['first_name'];
		if ($row['middle_name']) {
			echo ' ' . $row['middle_name'];
		}
		echo ' ' . $row['last_name'];
		echo "</li>";
	};

?>
</ul>


<h4>Families:</h4>
<ul>
<?php 
	$statement = $database->prepare('SELECT name FROM family LIMIT 10');
	$statement->execute();
	while ($row = $statement->fetch()) {
		echo "<li>";
		echo $row['name'];
		echo "</li>";
	};

?>
</ul>


<?php include("layouts/bottom.php"); ?>