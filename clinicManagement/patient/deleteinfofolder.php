<?php

include('../db_conn.php');
// include("getallpatient.php");

if(isset($_POST["patient_id"]))
{
	$statement = $connection->prepare(
		"DELETE FROM Info_Folder WHERE ID_Patientfk = :patient_idfk"
	);
	$resultado = $statement->execute(
		array(
			':patient_idfk'	=>	$_POST["patient_id"]
		)
	);
	
	// if(!empty($resultado))
	// {
	// 	echo 'Patient supprimer';
	// }
}
?>