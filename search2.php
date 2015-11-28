<?php
	if($_GET["find"] != "person" && $_GET["find"] != "family" && $_GET["find"] != "graveyard")
	{
		header("Location: search.php");
		exit;
	}
?>
<?php include("layouts/top.php"); ?>

<h3>Search Records</h3>

<!-- <h4 class="subheader">&lt;BLURB HERE&gt;</h4> -->
<?php
	if($_GET["find"] == "person")
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

	elseif ($_GET["find"] == "family")
	{
		echo "<h4 class='subheader'>Families</h4>";
		echo "<form>";
			echo "<div class='row'>";
				echo "<div class='small-2 columns'>";
					echo "<label>Family name";
					echo "<input type='text'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-4 columns'>";
					echo "<label>Place of origin";
					echo "<input type='text'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-6 columns'>";
				echo "</div>";
			echo "</div>";
		echo "</form>";
		echo "<a href='#' class='button'>Search</a>";
	}

	elseif ($_GET["find"] == "graveyard")
	{
		echo "<h4 class='subheader'>Graveyards and Cemeteries</h4>";
		echo "<form>";
			echo "<div class='row'>";
				echo "<div class='small-4 columns'>";
					echo "<label>Name";
					echo "<input type='text'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-8 columns'>";
				echo "</div>";
			echo "</div>";

			echo "<div class='row'>";
				echo "<div class='small-5 columns'>";
					echo "<label>Street address";
					echo "<input type='text'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-7 columns'>";
				echo "</div>";
			echo "</div>";

			echo "<div class='row'>";
				echo "<div class='small-3 columns'>";
					echo "<label>City";
					echo "<input type='text'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-2 columns'>";
					echo "<label>State";
					echo "<input type='text'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-2 columns'>";
					echo "<label>Zip code";
					echo "<input type='text'>";
					echo "</label>";
				echo "</div>";
				echo "<div class='small-5 columns'>";
				echo "</div>";
			echo "</div>";
		echo "</form>";
		echo "<a href='#' class='button'>Search</a>";
	}

	else
	{
		echo "<dl><dt>An error occurred.</dt><dd>Please <a href='search.php'>try again</a>.</dd></dl>";
	}
?>

<?php include("layouts/bottom.php"); ?>