<?php
    require 'models/CDatabase.php';

    class Customers{
        
        public function getCustomer($id){
            $database = new CDatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("SELECT * FROM customers WHERE cust_id = $id");
            $query->execute();

            $customer = $query->fetch(PDO::FETCH_ASSOC);
            if($customer){
                return $customer;
            }
            else {
                return false;
            }
        }

        public function updateCustomer($id,$nom, $prenoms, $contact, $photo)
        {
            $database = new CDatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("UPDATE customers SET cust_nom=:nom, cust_prenoms=:prenoms, cust_contact=:contact, cust_photo=:photo WHERE cust_id=$id");

            $insert = $query->execute(
                [
                    "nom" => inputClean($nom),
                    "prenoms" => inputClean($prenoms),
                    "contact" => inputClean($contact),
                    "photo" => $photo,
                ]
            );

            if($insert)
            {
                return true;
            }
            else
            {
                return false;
            } 
            
        }

        public function updateCustomer2($id, $pseudo, $email, $password)
        {
            $database = new CDatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("UPDATE customers SET cust_pseudo=:pseudo, cust_email=:email, cust_password=:password WHERE cust_id=$id");

            $insert = $query->execute(
                [
                    "pseudo" => inputClean($pseudo),
                    "email" => inputClean($email),
                    "password" => $password
                ]
            );

            if($insert)
            {
                return true;
            }
            else
            {
                return false;
            } 
            
        }
        

        public function insertCustProperty($id,$titre, $nb_piece, $nb_chambre, $nb_douche, $nb_wc, $addresse, $superficie, $type, $prix, $Description, $image)
        {
            $database = new CDatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("INSERT INTO proprietes (titre, nb_piece,	nb_chambre,	nb_douche,	nb_wc, addresse, superficie, type, prix, Description, image, customer_id, enable) VALUES (:titre, :nb_piece, :nb_chambre, :nb_douche, :nb_wc, :addresse, :superficie, :type, :prix, :Description, :image, :customer_id, :enable)");
            $insert = $query->execute([
                "titre" => $titre,
                "nb_piece" => $nb_piece,
                "nb_chambre" => $nb_chambre,
                "nb_douche" => $nb_douche,
                "nb_wc" => $nb_wc,
                "addresse" => $addresse,
                "superficie" => $superficie,
                "type" => $type,
                "prix" => $prix,
                "Description" => $Description,
                "image" => $image,
                "customer_id" => $id,
                "enable" => 0
            ]);

            if($insert){
                return true;
            }
            else {
                return false;
            }

        }

    }
?>