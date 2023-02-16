<?php
include('../db_conn.php');
include('getalluser.php');
$query = '';
$saida = array();
$query .= "SELECT * FROM Utilisateur ";


	if(isset($_POST["search"]["value"]))
	{
		$query .= 'WHERE ID_Utilisateur LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR NomComplet LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR Email LIKE "%'.$_POST["search"]["value"].'%" ';
	}

	if(isset($_POST["order"]))
	{
		$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	}
	else
	{
		$query .= 'ORDER BY ID_Utilisateur DESC ';
	}

	if($_POST["length"] != -1)
	{
		$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}	

	$statement = $connection->prepare($query);
	$statement->execute();	
	$resultado = $statement->fetchAll();
	
	$dados = array();
	$contar_rows = $statement->rowCount();
	
	foreach($resultado as $row)
	{
		$sub_array = array();
		$sub_array[] = $row["ID_Utilisateur"];
		$sub_array[] = $row["NomComplet"];
		$sub_array[] = $row["Email"];
		$sub_array[] = $row["MotDePasse"];
		$sub_array[] = '<button type="button" name="update" id="'.$row["ID_Utilisateur"].'" class="bg-transparent btn-sm update border-0"><img src="../includes/img/edit_64.png" style="height: 28px; width: 28px;" alt=""></button>';
		$sub_array[] = '<button type="button" name="delete" id="'.$row["ID_Utilisateur"].'" class="bg-transparent btn-sm delete border-0"><img src="../includes/img/delete_64.png" style="height: 28px; width: 28px;" alt=""></button>';
		$dados[] = $sub_array;
	}

	$saida = array(
	 	"draw"				=>	intval($_POST["draw"]),
		"recordsTotal"		=> 	$contar_rows,
		"recordsFiltered"	=>	get_total_registros(),
		"data"				=>	$dados
	);

	echo json_encode($saida);
?>