
<?php

//insert.php

$connect = new PDO('mysql:host=localhost;dbname=db_clinique', 'root', '');

if(isset($_POST["nomcomplet"]))
{
 $query = "INSERT INTO events (nomcomplet, telephone, start_event, end_event, categorie, description, backgroundColor) 
            VALUES (:nomcomplet, :telephone, :start_event, :end_event, :categorie, :description, :backgroundColor)";

 $statement = $connect->prepare($query);
 
 $ret = $statement->execute(
    array(
    ':nomcomplet'  => $_POST['nomcomplet'],
    ':telephone'  => $_POST['telephone'],
    ':start_event' => $_POST['start'],
    ':end_event' => $_POST['end'],
    ':categorie' => $_POST['categorie'],
    ':description' => $_POST['description'],
    ':backgroundColor' => $_POST['backgroundColor']
    )
 );
 echo $ret;
}
?>