<?php

include('../db_conn.php');
include("getallpatient.php");

if(isset($_POST["patient_id"]))
{
	$statement = $connection->prepare(
		"DELETE FROM Patient WHERE ID_Patient = :patient_id"
	);
	$resultado = $statement->execute(
		array(
			':patient_id'	=>	$_POST["patient_id"]
		)
	);
	
	if(!empty($resultado))
	{
		echo 'Patient supprimer';
	}
}
?>