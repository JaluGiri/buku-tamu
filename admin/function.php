<?php

//function.php

$connect = new PDO("mysql:host=localhost;dbname=riz", "root", "");

function fetch_top_five_data($connect)
{
	$query = "
	SELECT * FROM users 
	ORDER BY id DESC 
	LIMIT 5";

	$result = $connect->query($query);

	$output = '';

	foreach($result as $row)
	{
		$output .= '
		
		<tr>
			<td>'.$row["name"]		.'</td>
			<td class="td"><button type="button" onclick="fetch_data('.$row["id"].')" class="edit btn btn-warning btn-sm"><i class="bx bxs-edit" ></i></button>&nbsp;<button type="button" class="delete btn btn-danger btn-sm" onclick="delete_data('.$row["id"].')"><i class="bx bxs-trash" ></i></button></td>
		</tr>
		';
	}
	return $output;
}

function count_all_data($connect)
{
	$query = "SELECT * FROM users";

	$statement = $connect->prepare($query);

	$statement->execute();

	return $statement->rowCount();
}

?>