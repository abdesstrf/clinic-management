<?php
include('../db_conn.php');
include('getallpatient.php');
$query = '';
$saida = array();
$query .= "SELECT * FROM Patient ";

	if(isset($_POST["search"]["value"]))
	{
		$query .= 'WHERE ID_FolderPatient LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR F_Nom LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR F_Prenom LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR F_CIN LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR F_Tel LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR H_Nom LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR H_Prenom LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR H_CIN LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR H_Tel LIKE "%'.$_POST["search"]["value"].'%" ';
		$query .= 'OR dateInscription LIKE "%'.$_POST["search"]["value"].'%" ';	
	}
	if(isset($_POST["order"]))
	{
		$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	}
	else
	{
	$query .= 'ORDER BY ID_Patient DESC ';
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

		// $sub_array[] = $row["ID"];
		$sub_array[] = $row["ID_FolderPatient"];
		$sub_array[] = $row["F_Nom"];
		$sub_array[] = $row["F_Prenom"];
		$sub_array[] = $row["F_DateNaissance"];
		$sub_array[] = $row["F_CIN"];
		$sub_array[] = $row["F_Tel"];

		$sub_array[] = $row["H_Nom"];
		$sub_array[] = $row["H_Prenom"];
		$sub_array[] = $row["H_DateNaissance"];
		$sub_array[] = $row["H_CIN"];
		$sub_array[] = $row["H_Tel"];

		$sub_array[] = $row["Adresse"];
		$sub_array[] = $row["Couv_Sanitaire"];
		$sub_array[] = $row["Tentative"];
		
		$sub_array[] = '<button type="button" name="update" id="'.$row["ID_Patient"].'" class="bg-transparent btn-sm update border-0"><img src="../includes/img/edit_64.png" style="height: 28px; width: 28px;" alt=""></button>';
		$sub_array[] = '<button type="button" name="delete" id="'.$row["ID_Patient"].'" class="bg-transparent btn-sm delete border-0"><img src="../includes/img/delete_64.png" style="height: 28px; width: 28px;" alt=""></button>';
		$sub_array[] = '<button type="button" name="dossier" id="'.$row["ID_Patient"].'" class="bg-transparent btn-sm dossier border-0"><img src="../includes/img/folderAdd_64.png" style="height: 28px; width: 28px;" alt=""></button>';
		
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