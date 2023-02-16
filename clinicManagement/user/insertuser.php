<?php
include('../db_conn.php');
include('getalluser.php');
if(isset($_POST["operacao"]))
{
	if($_POST["operacao"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO Utilisateur (NomComplet, Email, MotDePasse)
			VALUES (:nomcomplet, :email, :mdp)
		");
	
			$resultado = $statement->execute(
				array(
					':nomcomplet'	=>	$_POST["nomcomplet"],
					':email'	=>	$_POST["email"],
					':mdp'	=>	$_POST["mdp"],
					)
				);	
		
		
		if(!empty($resultado))
		{
			echo 'Utilisateur ajouter.';
		}
	}
	if($_POST["operacao"] == "Edit")
	{
		$statement = $connection->prepare(
			"UPDATE Utilisateur
			SET nomcomplet = :nomcomplet, email = :email, MotDePasse = :mdp
			WHERE ID_Utilisateur = :utilisateur_id
			"
		);
		$resultado = $statement->execute(
			array(
				':nomcomplet'	=>	$_POST["nomcomplet"],
				':email'	=>	$_POST["email"],
				':mdp'	=>	$_POST["mdp"],
				':utilisateur_id'			=>	$_POST["utilisateur_id"]
			)
		);
		if(!empty($resultado))
		{
			echo 'Utilisateur modifier.';
		}
	}
}

?>