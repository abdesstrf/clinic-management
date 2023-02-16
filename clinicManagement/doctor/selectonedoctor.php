<?php
include('../db_conn.php');
include('getalldoctor.php');
if(isset($_POST["medecin_id"]))
{
	$saida = array();
	
	$statement = $connection->prepare(
		"SELECT * FROM Medecin 
		WHERE ID_Medecin = '".$_POST["medecin_id"]."' 
		LIMIT 1"
	);
	
	$statement->execute();
	$resultado = $statement->fetchAll();
	
	foreach($resultado as $linha)
	{
		$saida["nomcomplet"] = $linha["Nom_Complet"];
		$saida["specialite"] = $linha["Specialite"];
		$saida["adresse"] = $linha["Adresse"];
		$saida["tel_fix"] = $linha["Tel_Fixe"];
		$saida["tel_potable"] = $linha["Tel_Portable"];
		$saida["tel_perso"] = $linha["Tel_Perso"];
	}
	echo json_encode($saida);
}
?>