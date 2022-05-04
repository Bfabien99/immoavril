<?php
    session_start();

    require '../models/ADatabase.php';
    require '../functions/inputClean.php';

    if (!empty($_POST['nom']) && !empty($_POST['tel']) && !empty($_POST['message'])) {
        $nom = inputClean($_POST['nom']);
        $contact = inputClean($_POST['tel']);
        $email = inputClean($_POST['email']);
        $message = inputClean($_POST['message']);

        $database = new ADatabase();
        $db = $database->dbconnect();

        $query = $db->prepare("INSERT INTO contact (nom,contact,email,message) VALUES(:nom,:contact,:email,:message)");
        $insert = $query->execute([
            "nom" => $nom,
            "contact" => $contact,
            "email" => $email,
            "message" => $message,
        ]);

        if($insert){
            echo "OK";
        }
        else {
            echo "Veuillez réessayer plus tard";
        }
        
    }
    else {
        echo "Remplir les champs suivits d'un (*)";
    }

