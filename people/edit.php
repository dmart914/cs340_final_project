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

		echo "<h4 class='subheader'>People</h4>";
		echo "<form>";
			echo "<div class='row'>";
				echo "<div class='small-2 columns'>";
					echo "<label>First name";
					echo "<input type='text' placeholder='".$first_name."'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-2 columns'>";
					echo "<label>Middle name";
					echo "<input type='text' placeholder='".$middle_name."'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-2 columns'>";
					echo "<label>Last name";
					echo "<input type='text' placeholder='".$last_name."'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-6 columns'>";
				echo "</div>";
			echo "</div>";

			echo "<div class='row'>";
				echo "<div class='small-2 columns'>";
					echo "<label>Birth date";
					echo "<input type='text' placeholder='".$birthdate."'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-2 columns'>";
					echo "<label>Death date";
					echo "<input type='text' placeholder='".$death_date."'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-8 columns'>";
				echo "</div>";
			echo "</div>";

			echo "<div class='row'>";
				echo "<div class='small-6 columns'>";
					echo "<label>Cause of death";
					echo "<input type='text' placeholder='".$cause_of_death."'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-6 columns'>";
				echo "</div>";
			echo "</div>";

			echo "<div class='row'>";
				echo "<div class='small-4 columns'>";
					echo "<label>Place of death";
					echo "<input type='text' placeholder='".$death_location."'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-8 columns'>";
				echo "</div>";
			echo "</div>";

		echo "</form>";

		echo "<div class='row'>";
			echo "<div class='small-3 columns'>";
				echo "<a href='#' class='button'>Submit Changes</a>";
			echo "</div>";
			echo "<div class='small-3 columns'>";
				echo "<a href='#' class='button alert'>Delete Record</a>";
			echo "</div>";
			echo "<div class='small-6 columns'>";
			echo "</div>";
		echo "</div>";
	}
?>

<?php include("../layouts/bottom.php"); ?>