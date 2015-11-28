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
		# code...
	}
	else
	{
		echo "<dl><dt>An error occurred.</dt><dd>Please <a href='search.php'>try again</a>.</dd></dl>";
	}
?>

<?php include("layouts/bottom.php"); ?>