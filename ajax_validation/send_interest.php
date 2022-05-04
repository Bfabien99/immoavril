<?php
    session_start();

    require '../models/CDatabase.php';
    require '../functions/inputClean.php';

    if (!empty($_POST['nom']) && !empty($_POST['tel'])) {
        $nom = inputClean($_POST['nom']);
        $contact = inputClean($_POST['tel']);
        $email = inputClean($_POST['email']);
        $message = inputClean($_POST['message']);
        $database = new CDatabase();
        $db = $database->dbconnect();

        $query = $db->prepare("INSERT INTO messages (nom,contact,email,message,propriete_id,proprio_email) VALUES(:nom,:contact,:email,:message,:propriete_id,:proprio_email)");
        $insert = $query->execute([
            "nom" => $nom,
            "contact" => $contact,
            "email" => $email,
            "message" => !empty($message) ? $message : "JE SUIS INTERRESSER PAR CETTE PROPRIETE",
            "propriete_id" => $_SESSION['xmobilier_id'],
            "proprio_email" => $_SESSION['xcustomer_email']
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

