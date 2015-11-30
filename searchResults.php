<?php include("layouts/top.php"); ?>

<h3>Search Records</h3>

<!-- <h4 class="subheader">&lt;BLURB HERE&gt;</h4> -->

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
			 LIMIT 10');
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
			'SELECT
			 FROM 
			 WHERE 
			 GROUP BY 
			 ORDER BY 
			 LIMIT ');
		$statement->execute();

		while($row = $statement->fetch())
		{
			
		}

		# Search graveyards
		$statement = $database->prepare(
			'SELECT
			 FROM 
			 WHERE 
			 GROUP BY 
			 ORDER BY 
			 LIMIT ');
		$statement->execute();

		while($row = $statement->fetch())
		{
			
		}
	}
	
?>

<?php include("layouts/bottom.php"); ?>