<?php

function get_total_registros()
{
	include('../db_conn.php');
	$statement = $connection->prepare("SELECT * FROM Medecin");
	$statement->execute();
	$resultado = $statement->fetchAll();
	return $statement->rowCount();
}

?>