<?php
include('../db_conn.php');
include('getalldoctor.php');
$query = '';
$saida = array();
$query .= "SELECT * FROM Medecin ";

	if(isset($_POST["search"]["value"]))
	{
		$query .= 'WHERE ID_Medecin LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR Nom_Complet LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR Specialite LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR Tel_Fixe LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR Tel_Portable LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR Tel_Perso LIKE "%'.$_POST["search"]["value"].'%" ';
	}
	if(isset($_POST["order"]))
	{
		$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	}
	else
	{
	$query .= 'ORDER BY ID_Medecin DESC ';
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
		$sub_array[] = $row["ID_Medecin"];
		$sub_array[] = $row["Nom_Complet"];
		$sub_array[] = $row["Specialite"];
		$sub_array[] = $row["Adresse"];
		$sub_array[] = $row["Tel_Fixe"];
		$sub_array[] = $row["Tel_Portable"];
		$sub_array[] = $row["Tel_Perso"];
		$sub_array[] = '<button type="button" name="update" id="'.$row["ID_Medecin"].'" class="bg-transparent btn-sm update border-0"><img src="../includes/img/edit_64.png" style="height: 28px; width: 28px;" alt=""></button>';
		$sub_array[] = '<button type="button" name="delete" id="'.$row["ID_Medecin"].'" class="bg-transparent btn-sm delete border-0"><img src="../includes/img/delete_64.png" style="height: 28px; width: 28px;" alt=""></button>';
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