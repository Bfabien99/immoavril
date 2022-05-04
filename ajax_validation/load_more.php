<?php
require '../models/ADatabase.php';

if (isset($_POST['limite'])) {
    $limite = 3;

    $database = new ADatabase();
    $db = $database->dbconnect();

    $query = $db->prepare('SELECT * FROM proprietes WHERE enable = 1 LIMIT '.$_POST['limite'].','.$limite);
    $query->execute();

    $allProperties = $query->fetchAll(PDO::FETCH_ASSOC);
    if($allProperties){
        foreach($allProperties as $property){
            $data [] = $property;
        };

        $data = json_encode($data);
        echo $data;
    }
}
?>