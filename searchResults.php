<?php include("layouts/top.php"); ?>

<h3>Search Records</h3>

<!-- <h4 class="subheader">&lt;BLURB HERE&gt;</h4> -->

<!-- TODO: Pagination of search results -->
<!-- TODO: Handle zero results and empty search string -->

<?php
	$searchString = "";
	if($_POST['searchString'])
	{
		$searchString = $_POST['searchString'];
		$searchParam = "%".strtolower($_POST['searchString'])."%";
	}

	if(!$_POST['searchString'])
	{
		# Handle empty search string here
	}

	else
	{
		echo "<h5>Results for <i>".$searchString."</i></h5>";

		# Search people
		$statement = $database->prepare(
			'SELECT id, first_name, middle_name, last_name, birthdate, death_date
			 FROM person
			 WHERE LOWER(first_name) LIKE :searchString
			 	OR LOWER(middle_name) LIKE :searchString
			 	OR LOWER(last_name) LIKE :searchString
			 GROUP BY last_name
			 ORDER BY last_name
			 LIMIT 50');
		$statement->bindParam(":searchString", $searchParam);
		$statement->execute();

		echo "<dl>";
		while($row = $statement->fetch())
		{
			echo "<dt>";
				echo "<a href='person.php?id=".$row['id']."'>";
				echo ucfirst($row['last_name']);
				if($row['first_name'])
				{
					echo ", ".ucfirst($row['first_name']);
					if($row['middle_name'])
					{
						echo " ".ucfirst($row['middle_name']);
					}
				}
				echo "</a>";
			echo "</dt>";
			echo "<dd><h6>";
				if($row['birthdate'])
				{
					echo "Born ".$row['birthdate'].". ";
				}
				if($row['death_date'])
				{
					echo "Died ".$row['death_date'].". ";
				}
			echo "</h6></dd>";
		}
		echo "</dl>";

		# Search families
		$statement = $database->prepare(
			'SELECT id, name, origin
			 FROM family
			 WHERE LOWER(name) LIKE :searchString
			 ORDER BY name
			 LIMIT 50');
		$statement->bindParam(":searchString", $searchParam);
		$statement->execute();

		echo "<dl>";
		while($row = $statement->fetch())
		{
			echo "<dt>";
				echo "<a href='family.php?id=".$row['id']."'>";
				echo "The ".ucfirst($row['name'])." Family";
				echo "</a>";
			echo "</dt>";
			echo "<dd><h6>";
				if($row['origin'])
				{
					echo "Origin: ".ucfirst($row['origin']);
				}
			echo "</h6></dd>";
		}
		echo "</dl>";

		# Search graveyards
		$statement = $database->prepare(
			'SELECT id, name, city, state
			 FROM graveyard
			 WHERE LOWER(name) LIKE :searchString
			 ORDER BY name
			 LIMIT 50');
		$statement->bindParam(":searchString", $searchParam);
		$statement->execute();

		echo "<dl>";
		while($row = $statement->fetch())
		{
			echo "<dt>";
				echo "<a href='graveyard.php?id=".$row['id']."'>";
				echo ucfirst($row['name']);
				echo "</a>";
			echo "</dt>";
			echo "<dd><h6>";
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
			echo "</h6></dd>";
		}
		echo "</dl>";
	}
	
?>

<?php include("layouts/bottom.php"); ?>