<?php
include('../db_conn.php');
include('getallpatient.php');
if(isset($_POST["operacao"]))
{
	if($_POST["operacao"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO Patient (ID_FolderPatient, F_Nom, F_Prenom, F_DateNaissance, F_CIN, F_Tel, H_Nom, H_Prenom, H_DateNaissance, H_CIN, H_Tel, Adresse, Couv_Sanitaire, Tentative)
			VALUES (:ID_FolderPatient, :Fnom, :Fprenom,  :FdateNaissance , :Fcin, :Ftel, :Hnom, :Hprenom, :HdateNaissance, :Hcin, :Htel, :adresse, :couv_sanitaire, :tentative)
		");
	
			$resultado = $statement->execute(
				array(
					':ID_FolderPatient' => $_POST["ID_Folder"],
					// femme
					':Fnom'	=>	$_POST["Fnom"],
					':Fprenom'	=>	$_POST["Fprenom"],
					':FdateNaissance'	=>	$_POST["FdateNaissance"],
					':Ftel'	=>	$_POST["Ftel"],
					':Fcin'	=>	$_POST["Fcin"],
					// homme
					':Hnom'	=>	$_POST["Hnom"],
					':Hprenom'	=>	$_POST["Hprenom"],
					':HdateNaissance'	=>	$_POST["HdateNaissance"],
					':Htel'	=>	$_POST["Htel"],
					':Hcin'	=>	$_POST["Hcin"],
					// both
					':adresse'	=>	$_POST["adresse"],
					':couv_sanitaire'	=>	$_POST["couv_sanitaire"],
					':tentative'	=>	$_POST["tentative"],
					)
				);	
		
		if(!empty($resultado))
		{
			echo 'Patient ajouter.';
		}
	}

	if($_POST["operacao"] == "Edit")
	{
		$statement = $connection->prepare(
			"UPDATE Patient
			SET ID_FolderPatient = :ID_FolderPatient, F_Nom = :Fnom, F_Prenom = :Fprenom, F_CIN = :Fcin, F_DateNaissance = :FdateNaissance, F_Tel = :Ftel, 
				H_Nom = :Hnom, H_Prenom = :Hprenom, H_CIN = :Hcin, H_DateNaissance = :HdateNaissance, H_Tel = :Htel, 
				Adresse = :adresse, Couv_Sanitaire = :couv_sanitaire, Tentative = :tentative
			WHERE ID_Patient = :patient_id
			"
		);
		$resultado = $statement->execute(
			array(
				':ID_FolderPatient' => $_POST["ID_Folder"],
				// femme
				':Fnom'	=>	$_POST["Fnom"],
				':Fprenom'	=>	$_POST["Fprenom"],
				':FdateNaissance'	=>	$_POST["FdateNaissance"],
				':Ftel'	=>	$_POST["Ftel"],
				':Fcin'	=>	$_POST["Fcin"],
				// homme
				':Hnom'	=>	$_POST["Hnom"],
				':Hprenom'	=>	$_POST["Hprenom"],
				':HdateNaissance'	=>	$_POST["HdateNaissance"],
				':Htel'	=>	$_POST["Htel"],
				':Hcin'	=>	$_POST["Hcin"],
				// both
				':adresse'	=>	$_POST["adresse"],
				':couv_sanitaire'	=>	$_POST["couv_sanitaire"],
				':tentative'	=>	$_POST["tentative"],
				':patient_id'	=>	$_POST["patient_id"]
			)
		);
		if(!empty($resultado))
		{
			echo 'Patient modifier.';
		}
	}
}
?>