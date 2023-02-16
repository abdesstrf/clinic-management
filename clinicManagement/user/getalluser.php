<?php

function get_total_registros()
{
	include('../db_conn.php');
	$statement = $connection->prepare("SELECT * FROM Utilisateur");
	$statement->execute();
	$resultado = $statement->fetchAll();
	return $statement->rowCount();
}

?>