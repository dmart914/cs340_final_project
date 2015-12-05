<?php include('/home/ubuntu/00_PUBLIC_HTML/cs340_final_project/db.cfg.php'); ?>

<?php

	if(!isset($_POST['id']))
	{
		echo "<dl><dt>An error occurred.</dt><dd>Please go back and try again</a>.</dd></dl>";
	}

	else
	{

		// print_r('<pre>');
		// print_r('$_POST: ');
		// var_dump($_POST);
		// print_r('</pre>');

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
		// $statement->execute($data);

		// Add relationship if set
		if ($_POST['relative'] != 'none' && $_POST['relationship_type'] != 'none') {
			$q = 'INSERT INTO relationship_instance (person_id, relative_id, relationship_id) VALUES (';
			$q .= $_POST['id'] . ',' . $_POST['relative'] . ',' . $_POST['relationship_type'] . ')';
			
			$rel_stmt = $database->prepare($q);
			$rel_stmt->execute();
		}

		header("Location: person.php?id=".$_POST['id']);
		exit;
	}

?>