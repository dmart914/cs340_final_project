<?php include("../layouts/top.php"); ?>

<h3>Edit Record</h3>

<!-- <h4 class="subheader">&lt;BLURB HERE&gt;</h4> -->
<?php
	if(!isset($_POST['id']))
	{
		echo "<dl><dt>An error occurred.</dt><dd>Please go back and try again</a>.</dd></dl>";
	}

	else
	{
		$first_name = "";
		$middle_name = "";
		$last_name = "";
		$birthdate = "";
		$death_date = "";
		$death_location = "";
		$cause_of_death = "";
		$family_id = "";
		$plot_id = "";
		$graveyard_id = "";

		$statement = $database->prepare('
			SELECT *
			FROM person
			WHERE id = :id');
		$statement->bindParam(":id", $_POST['id']);
		$statement->execute();

		while($row = $statement->fetch())
		{
			if($row['first_name'])
			{
				$first_name = ucfirst($row['first_name']);
			}
			if($row['middle_name'])
			{
				$middle_name = ucfirst($row['middle_name']);
			}
			if($row['last_name'])
			{
				$last_name = ucfirst($row['last_name']);
			}
			if($row['birthdate'])
			{
				$birthdate = ucfirst($row['birthdate']);
			}
			if($row['death_date'])
			{
				$death_date = ucfirst($row['death_date']);
			}
			if($row['death_location'])
			{
				$death_location = ucfirst($row['death_location']);
			}
			if($row['cause_of_death'])
			{
				$cause_of_death = ucfirst($row['cause_of_death']);
			}
		}

		// Get the user's relatives
		$q = 'SELECT p.id, p.first_name, p.last_name, rt.relationship_type from person p INNER JOIN ';
		$q .= '(SELECT * FROM relationship_instance WHERE person_id='. $_POST["id"] . ') r ON r.person_id=p.id OR r.relative_id=p.id INNER JOIN ';
		$q .= 'relationship rt ON rt.id = r.relationship_id WHERE p.id <> '. $_POST["id"];
		$relatives = $database->prepare($q);
		$relatives->execute();
		$person = $relatives->fetch();

		print_r('<pre>');
		print_r('$person: ');
		var_dump($person);
		print_r('</pre>'); 

		print_r('<pre>');
		print_r('$q: ');
		var_dump($q);
		print_r('</pre>'); 

		echo "<h4 class='subheader'>People</h4>";
		echo "<form action='edithandler.php' method='POST'>";
			echo "<input type='hidden' name='id' value='".$_POST['id']."'>";

			echo "<div class='row'>";
				echo "<div class='small-2 columns'>";
					echo "<label>First name";
					echo "<input type='text' value='".$first_name."' name='first_name'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-2 columns'>";
					echo "<label>Middle name";
					echo "<input type='text' value='".$middle_name."' name='middle_name'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-2 columns'>";
					echo "<label>Last name";
					echo "<input type='text' value='".$last_name."' name='last_name'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-6 columns'>";
				echo "</div>";
			echo "</div>";

			echo "<div class='row'>";
				echo "<div class='small-2 columns'>";
					echo "<label>Birth date";
					echo "<input type='text' value='".$birthdate."' name='birthdate'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-2 columns'>";
					echo "<label>Death date";
					echo "<input type='text' value='".$death_date."' name='death_date'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-8 columns'>";
				echo "</div>";
			echo "</div>";

			echo "<div class='row'>";
				echo "<div class='small-6 columns'>";
					echo "<label>Cause of death";
					echo "<input type='text' value='".$cause_of_death."' name='cause_of_death'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-6 columns'>";
				echo "</div>";
			echo "</div>";

			echo "<div class='row'>";
				echo "<div class='small-4 columns'>";
					echo "<label>Place of death";
					echo "<input type='text' value='".$death_location."' name='death_location'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-8 columns'>";
				echo "</div>";
			echo "</div>";

		echo "<div class='row'>";
			echo "<div class='small-3 columns'>";
				echo "<input type='submit' class='button' value='Submit Changes'>";
			echo "</div>";
		echo "</form>";

			echo "<div class='small-3 columns'>";
				echo "<a href='confirmdelete.php?id=".$_POST['id']."' class='button alert'>Delete Record</a>";
			echo "</div>";
			echo "<div class='small-6 columns'>";
			echo "</div>";
		echo "</div>";
	}
?>

<?php include("../layouts/bottom.php"); ?>