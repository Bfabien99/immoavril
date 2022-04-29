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

        public function updateCustomer($nom, $prenoms, $pseudo, $contact, $email, $password, $photo)
        {
            $database = new CDatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("UPDATE customers SET (cust_nom=:nom, cust_prenoms=:prenoms, cust_pseudo=:pseudo, cust_contact=:contact, cust_email=:email, cust_password=:password, cust_photo=:photo)");

            $insert = $query->execute(
                [
                    "nom" => inputClean($nom),
                    "prenoms" => inputClean($prenoms),
                    "pseudo" => inputClean($pseudo),
                    "contact" => inputClean($contact),
                    "email" => inputClean($email),
                    "password" => encryptpass(strip_tags($password)),
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

    }
?>