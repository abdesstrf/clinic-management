<?php
include('../db_conn.php');
include('getalluser.php');
if(isset($_POST["utilisateur_id"]))
{
	$saida = array();
	
	$statement = $connection->prepare(
		"SELECT * FROM Utilisateur 
		WHERE ID_Utilisateur = '".$_POST["utilisateur_id"]."' 
		LIMIT 1"
	);
	
	$statement->execute();
	$resultado = $statement->fetchAll();
	
	foreach($resultado as $linha)
	{
		$saida["nomcomplet"] = $linha["NomComplet"];
		$saida["email"] = $linha["Email"];
		$saida["mdp"] = $linha["MotDePasse"];
	}
	echo json_encode($saida);
}
?>