<?php

$connect = new PDO('mysql:host=localhost;dbname=db_clinique', 'root', '');

if(isset($_POST["id"]))
{
    $query = "UPDATE events SET 
            nomcomplet = :nomcomplet, telephone = :telephone, start_event = :start_event, end_event = :end_event, 
            categorie = :categorie, description = :description, backgroundColor = :backgroundColor
            WHERE id=:id";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            'nomcomplet'   => $_POST["nomcomplet"],
            'telephone'   => $_POST["telephone"],
            'start_event'   => $_POST["start"],
            'end_event'   => $_POST["end"],
            'categorie'   => $_POST["categorie"],
            'description'   => $_POST["description"],
            'backgroundColor' => $_POST["backgroundColor"],
            'id' => $_POST["id"],
        )
    );
}

?>