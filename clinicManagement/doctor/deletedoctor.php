<?php
include('../db_conn.php');
include("getalldoctor.php");

if(isset($_POST["medecin_id"]))
{
	$statement = $connection->prepare(
		"DELETE FROM Medecin WHERE ID_Medecin = :medecin_id"
	);
	$resultado = $statement->execute(
		array(
			':medecin_id'	=>	$_POST["medecin_id"]
		)
	);
	
	if(!empty($resultado))
	{
		echo 'Médecin supprimer !';
	}
}
?>