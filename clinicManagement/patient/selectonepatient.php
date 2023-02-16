<?php
include('../db_conn.php');
include('getallpatient.php');
if(isset($_POST["patient_id"]))
{
	$saida = array();
	
	$statement = $connection->prepare(
		"SELECT * FROM Patient 
		WHERE ID_Patient = '".$_POST["patient_id"]."' 
		LIMIT 1"
	);
	
	$statement->execute();
	$resultado = $statement->fetchAll();
	
	foreach($resultado as $linha)
	{
		$saida["ID_Folder"] = $linha["ID_FolderPatient"];
		// femme
		$saida["Fnom"] = $linha["F_Nom"];
		$saida["Fprenom"] = $linha["F_Prenom"];
		$saida["FdateNaissance"] = $linha["F_DateNaissance"];
		$saida["Fcin"] = $linha["F_CIN"];
		$saida["Ftel"] = $linha["F_Tel"];
		// homme
		$saida["Hnom"] = $linha["H_Nom"];
		$saida["Hprenom"] = $linha["H_Prenom"];
		$saida["HdateNaissance"] = $linha["H_DateNaissance"];
		$saida["Hcin"] = $linha["H_CIN"];
		$saida["Htel"] = $linha["H_Tel"];
		// both
		$saida["adresse"] = $linha["Adresse"];
		$saida["couv_sanitaire"] = $linha["Couv_Sanitaire"];
		$saida["tentative"] = $linha["Tentative"];
	}
	echo json_encode($saida);
}
?>