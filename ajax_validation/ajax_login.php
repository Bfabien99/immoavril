<?php
    session_start();

    require '../models/CDatabase.php';
    require '../functions/encryptpass.php';
    require '../functions/inputClean.php';

    if(!empty($_POST['pseudo']) && !empty($_POST['password'])){
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];
        $database = new CDatabase();
        $db = $database->dbconnect();

        $query = $db->prepare('SELECT * FROM customers WHERE (cust_email = ' .'"'. inputClean($pseudo) .'"'. ' OR cust_pseudo = ' .'"'. inputClean($pseudo) .'"'.') AND cust_password ='.'"'. encryptpass($password).'"');
        $query->execute();
        $exist_customer = $query->fetch(PDO::FETCH_ASSOC);


        $query = $db->prepare('SELECT * FROM admin WHERE (ad_email = ' .'"'. inputClean($pseudo) .'"'. ' OR ad_pseudo = ' .'"'. inputClean($pseudo) .'"'.') AND ad_password ='.'"'. encryptpass($password).'"');
        $query->execute();
        $exist_admin = $query->fetch(PDO::FETCH_ASSOC);

        if($exist_customer){
            $_SESSION['xcustomer_id'] = $exist_customer['cust_id'];
            echo "customer";
        }
        elseif($exist_admin){
            $_SESSION['xadmin_id'] = $exist_admin['admin_id'];
            echo "admin";
        }
        else{
            echo "<p class='error'>Email/Pseudo ou mot de passe incorrect!<p>";
        }
    }
    else{
        echo "<p class='error'>Remplir tous les champs<p>";
    }
?>