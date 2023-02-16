<?php
function get_total_InfoDossier()
{
	include('../db_conn.php');
	$statement = $connection->prepare("SELECT * FROM Info_Folder");
	$statement->execute();
	$resultado = $statement->fetchAll();
	return $statement->rowCount();
}
?>