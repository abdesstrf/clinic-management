<?php
include('../db_conn.php');
include('getalldoctor.php');
if(isset($_POST["operacao"]))
{
	if($_POST["operacao"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO Medecin (Nom_Complet, Specialite, Adresse, Tel_Fixe, Tel_Portable, Tel_Perso)
			VALUES (:nomcomplet, :specialite, :adresse, :tel_fix, :tel_potable, :tel_perso)
		");
	
			$resultado = $statement->execute(
				array(
					':nomcomplet'	=>	$_POST["nomcomplet"],
					':specialite'	=>	$_POST["specialite"],
					':adresse'	=>	$_POST["adresse"],
					':tel_fix'	=>	$_POST["tel_fix"],
					':tel_potable'	=>	$_POST["tel_potable"],
					':tel_perso'	=>	$_POST["tel_perso"],
					)
				);	
		
		if(!empty($resultado))
		{
			echo 'Médecin ajouter.';
		}
	}

	if($_POST["operacao"] == "Edit")
	{
		$statement = $connection->prepare(
			"UPDATE Medecin
			SET Nom_Complet = :nomcomplet, Specialite = :specialite, Adresse = :adresse, 
			Tel_Fixe = :tel_fix, Tel_Portable = :tel_potable, Tel_Perso = :tel_perso
			WHERE ID_Medecin = :medecin_id
			"
		);

		$resultado = $statement->execute(
			array(
				':nomcomplet'	=>	$_POST["nomcomplet"],
				':specialite'	=>	$_POST["specialite"],
				':adresse'	=>	$_POST["adresse"],
				':tel_fix'	=>	$_POST["tel_fix"],
				':tel_potable'	=>	$_POST["tel_potable"],
				':tel_perso'	=>	$_POST["tel_perso"],
				':medecin_id'	=>	$_POST["medecin_id"]
			)
		);

		if(!empty($resultado))
		{
			echo 'Médecin modifier.';
		}
	}
}

?>