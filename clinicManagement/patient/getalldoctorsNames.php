<?php
include('../db_conn.php');

$statement = $connection->prepare("SELECT * FROM Medecin");
$statement->execute();
$resultado = $statement->fetchAll();
$dados = array();
    
foreach($resultado as $row)
{
    $dados[] = $row["Nom_Complet"];
}

echo json_encode($dados);

?>