<?php include('../../../ubuntu/00_PUBLIC_HTML/cs340_final_project/db.cfg.php'); ?>

<?php

	if(!isset($_POST['id']))
	{
		echo "<dl><dt>An error occurred.</dt><dd>Please go back and try again</a>.</dd></dl>";
	}

	else
	{
		$data = array(
			$_POST['first_name'], $_POST['middle_name'],
			$_POST['last_name'], $_POST['birthdate'],
			$_POST['death_date'], $_POST['cause_of_death'],
			$_POST['death_location'], $_POST['id']);

		$statement = $database->prepare('
			UPDATE person
			SET first_name = ?,
				middle_name = ?,
				last_name = ?,
				birthdate = ?,
				death_date = ?,
				cause_of_death = ?,
				death_location = ?
			WHERE id = ?');
		$statement->execute($data);

		header("Location: person.php?id=".$_POST['id']);
		exit;
	}

?>