<?php
include('../db_conn.php');
include("getalluser.php");

if(isset($_POST["utilisateur_id"]))
{
	$statement = $connection->prepare(
		"DELETE FROM utilisateur WHERE ID_Utilisateur = :utilisateur_id"
	);
	$resultado = $statement->execute(
		array(
			':utilisateur_id'	=>	$_POST["utilisateur_id"]
		)
	);
	
	if(!empty($resultado))
	{
		echo 'Utilisateur supprimer avec succée';
	}
}
?>