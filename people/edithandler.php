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
			$_POST['death_location'], $_POST['image_path'],
			$_POST['id']);

		$statement = $database->prepare('
			UPDATE person
			SET first_name = ?,
				middle_name = ?,
				last_name = ?,
				birthdate = ?,
				death_date = ?,
				cause_of_death = ?,
				death_location = ?,
				image = ?
			WHERE id = ?');
		$statement->execute($data);

		// Add relationship if set
		if ($_POST['relative'] != 'none' && $_POST['relationship_type'] != 'none') {
			$q = 'INSERT INTO relationship_instance (person_id, relative_id, relationship_id) VALUES (';
			$q .= $_POST['id'] . ',' . $_POST['relative'] . ',' . $_POST['relationship_type'] . ')';
			
			$rel_stmt = $database->prepare($q);
			$rel_stmt->execute();
		}

		// Add graveyard if set
		if(isset($_POST['graveyard']))
		{
			/*$data = array($_POST['id'], $_POST['graveyard'],
						  $_POST['id'], $_POST['id'],
						  $_POST['graveyard']);
			$statement = $database->prepare('
				IF EXISTS ( SELECT id
							FROM plot
							WHERE id IN (SELECT plot_id
										 FROM person
										 WHERE id = :id))
					UPDATE plot
					SET graveyard_id = :gid
					WHERE id IN (SELECT plot_id
								 FROM person
								 WHERE id = :id))
				ELSE
					INSERT INTO plot (graveyard_id)
					VALUES (?)');
			$statement->execute($data);*/

			# Check whether this person already has a plot
			$statement = $database->prepare('
				SELECT id
				FROM plot
				WHERE id IN (SELECT plot_id
							 FROM person
							 WHERE id = :id)');
			$statement->bindParam(":id", $_POST['id']);
			$statement->execute();

			# Person has a plot. Update plot's graveyard.
			if($statement->rowCount() > 0)
			{
				$data = array($_POST['graveyard'], $_POST['id']);
				$statement = $database->prepare('
					UPDATE plot
					SET graveyard_id = ?
					WHERE plot.id IN (SELECT plot_id
								 FROM person
								 WHERE person.id = ?)');
				$statement->execute($data);
			}

			# Person has no plot. Create plot and attach it.
			else
			{
				$data = array($_POST['graveyard']);
				$statement = $database->prepare('
					INSERT INTO plot (graveyard_id)
					VALUES (?)');
				$statement->execute($data);

				$last_plot_id = $database->lastInsertId();
				$data = array($last_plot_id, $_POST['id']);

				$statement = $database->prepare('
					UPDATE person
					SET plot_id = ?
					WHERE id = ?');
				$statement->execute($data);
			}
		}

		header("Location: person.php?id=".$_POST['id']);
		exit;
	}

?>