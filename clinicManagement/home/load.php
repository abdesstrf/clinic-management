<?php

$connect = new PDO('mysql:host=localhost;dbname=db_clinique', 'root', '');
$data = array();
$query = "SELECT * FROM events ORDER BY id";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

foreach($result as $row)
{
  $data[] = array(
    'id'   => $row["id"],
    'nomcomplet'   => $row["nomcomplet"],
    'telephone'   => $row["telephone"],
    'start'   => $row["start_event"],
    'end'   => $row["end_event"],
    'categorie'   => $row["categorie"],
    'description'   => $row["description"],
    'backgroundColor' => $row["backgroundColor"],
    'title'=> "--> ".$row["nomcomplet"],
  );
}

echo json_encode($data);
?>