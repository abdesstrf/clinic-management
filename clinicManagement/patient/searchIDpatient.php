<?php
include('../db_conn.php');
include('getallpatient.php');

if(isset($_POST["ID_Folder"]))
{
    $saida = array();
        
    $statement = $connection->prepare(
        "SELECT ID_FolderPatient FROM Patient 
        WHERE ID_FolderPatient = '".$_POST["ID_Folder"]."' 
        LIMIT 1"
    );

    $statement->execute();
    $resultado = $statement->fetchAll();

    foreach($resultado as $linha)
    {
        $saida["ID_Folder"] = $linha["ID_FolderPatient"];
    }
    echo json_encode($saida);
}
?>