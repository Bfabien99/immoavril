<?php
    require '../models/CDatabase.php';
    require '../functions/encryptpass.php';
    require '../functions/inputClean.php';

    if(!empty($_POST['nom']) && !empty($_POST['prenoms']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['contact']) && !empty($_POST['password']))
    {
        $nom = $_POST['nom'];
        $prenoms = $_POST['prenoms'];
        $pseudo = $_POST['pseudo'];
        $contact = preg_replace('/[^0-9]/', '', $_POST['contact']);
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "<p class='error'>L'email n'est pas valide<p>";
            die();
        }
        if(strlen($_POST['password'])<6 ){
            echo "<p class='error'>Le mot de passe doit contenir au moins 6 caractères<p>";
            die();
        }

        $database = new CDatabase();
        $db = $database->dbconnect();

        $query = $db->prepare('SELECT cust_nom FROM customers WHERE cust_email = ' .'"'. inputClean($email) .'"'. ' OR cust_pseudo = ' .'"'. inputClean($pseudo) .'"');
        $query->execute();
        $exist = $query->fetchAll();
        if($exist){
            echo "<p class='error'>L'email ou le pseudo correspond à un utilisateur, veuillez reessayer...</p>";
        }
        else{
            $query = $db->prepare("INSERT INTO customers (cust_nom, cust_prenoms, cust_pseudo, cust_contact, cust_email, cust_password) VALUES (:nom, :prenoms, :pseudo, :contact, :email, :password)");

            $insert = $query->execute(
                [
                    "nom" => inputClean($nom),
                    "prenoms" => inputClean($prenoms),
                    "pseudo" => inputClean($pseudo),
                    "contact" => inputClean($contact),
                    "email" => inputClean($email),
                    "password" => encryptpass(strip_tags($password))
                ]
            );

            if ($insert) {
                echo "OK";
            }
            else{
                echo "<p class='error'>Connexion au serveur impossible veuillez réessayer plus tard...<p>";
            }

        }
        

    }
    else {
        echo "<p class='error'>Remplir tous les champs suivit d'un (*)<p>";
    }
?>