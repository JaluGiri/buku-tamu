<?php

//action.php

include('function.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'Add' || $_POST["action"] == 'Update')
	{
		$output = array();
		$name 		= $_POST["name"		];
		$password 		= $_POST["password"	];

		if(empty($name))
		{
			$output['name_error'] 		= 'Nama is Required';
		}

		if(empty($password))
		{
			$output['password_error'] 		= 'Password is Required';
		}

		if(count($output) > 0)
		{
			echo json_encode($output);
		}
		else
		{
			$data = array(
				':name'			=>	$name,
				':password'		=>	$password
			);
			
			if($_POST['action'] == 'Add')
			{
				$query = "
				INSERT INTO users 
				(name, password) 
				VALUES (:name, :password)
				";

				$statement = $connect->prepare($query);

				if($statement->execute($data))
				{
					$output['success'] = '<div class="alert alert-success">New Data Added</div>';

					echo json_encode($output);
				}
			}

			if($_POST['action'] == 'Update')
			{
				$query = "
				UPDATE users 
				SET name 	= :name, 
				password 	= :password
				WHERE id 	= '".$_POST["id"]."'
				";

				$statement = $connect->prepare($query);

				if($statement->execute($data))
				{
					$output['success'] = '<div class="alert alert-success">Data Updated</div>';
				}

				echo json_encode($output);
			}
		}
	}

	if($_POST['action'] == 'fetch')
	{
		$query = "
		SELECT * FROM users 
		WHERE id = '".$_POST["id"]."'
		";

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{

			$data['name'] 		= $row['name'];

			$data['password']	 	= $row['password'];

		}

		echo json_encode($data);
	}

	if($_POST['action'] == 'delete')
	{
		$query = "
		DELETE FROM users 
		WHERE id = '".$_POST["id"]."'
		";

		if($connect->query($query))
		{
			$output['success'] = '<div class="alert alert-success">Data Deleted</div>';

			echo json_encode($output);
		}
	}
}

?>