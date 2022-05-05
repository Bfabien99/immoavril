<?php
    require '../models/ADatabase.php';
    require '../functions/inputClean.php';
    require '../functions/encryptpass.php';

    if(!empty($_POST['pseudo']) && !empty($_POST['email'])){
        $pseudo = inputClean($_POST['pseudo']);
        $email = inputClean($_POST['email']);

        $database = new ADatabase();
        $db = $database->dbconnect();

        $query = $db->prepare('SELECT * FROM customers WHERE cust_pseudo ='.'"'. $pseudo .'"'. ' AND cust_email ='.'"'. $email .'"');
        $query->execute();

        $customer = $query->fetch(PDO::FETCH_ASSOC);
        if(!empty($customer)){
            $query = $db->prepare('UPDATE customers set cust_password ='.'"'.encryptpass('12345678#').'"'.'WHERE cust_pseudo ='.'"'. $pseudo .'"'. ' AND cust_email ='.'"'. $email .'"');
            $update = $query->execute();

            if($update){
                echo "Votre nouveau mot de passe est 12345678#";
            }
        }else{
            echo 'Utilisateur inconnu...';
        }
    }
    else {
        echo "remplir tous les champs";
    }
?>