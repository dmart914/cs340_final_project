<?php include("layouts/top.php"); ?>

<h3>Search Records</h3>

<!-- <h4 class="subheader">&lt;BLURB HERE&gt;</h4> -->

<?php
	$searchString = "";
	if($_POST['searchString'])
	{
		$searchString = $_POST['searchString'];
	}

	if(!$_POST['searchString'])
	{
		# Handle empty search string here
	}

	else
	{
		echo "<h5>Results for <i>".$searchString."</i></h5>";
	}
	
?>

<?php include("layouts/bottom.php"); ?>