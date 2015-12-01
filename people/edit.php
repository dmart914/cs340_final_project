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
		echo "<h4 class='subheader'>People</h4>";
		echo "<form>";
			echo "<div class='row'>";
				echo "<div class='small-2 columns'>";
					echo "<label>First name";
					echo "<input type='text'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-2 columns'>";
					echo "<label>Middle name";
					echo "<input type='text'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-2 columns'>";
					echo "<label>Last name";
					echo "<input type='text'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-6 columns'>";
				echo "</div>";
			echo "</div>";

			echo "<div class='row'>";
				echo "<div class='small-2 columns'>";
					echo "<label>Birth year";
					echo "<input type='text'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-2 columns'>";
					echo "<label>Death year";
					echo "<input type='text'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-8 columns'>";
				echo "</div>";
			echo "</div>";

			echo "<div class='row'>";
				echo "<div class='small-6 columns'>";
					echo "<label>Cause of death";
					echo "<input type='text'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-6 columns'>";
				echo "</div>";
			echo "</div>";
		echo "</form>";
		echo "<a href='#' class='button'>Search</a>";
	}
?>

<?php include("../layouts/bottom.php"); ?>