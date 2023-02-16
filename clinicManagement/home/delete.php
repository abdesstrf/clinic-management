
<?php

    $connect = new PDO('mysql:host=localhost;dbname=db_clinique', 'root', '');
    $query = "DELETE from events WHERE id = :id";

    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':id' => $_POST['id']
        )
    );

?>
