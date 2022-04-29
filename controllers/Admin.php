<?php
    require 'models/ADatabase.php';

    class Admin{

        public function getAdmin($id){
            $database = new CDatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("SELECT * FROM admin WHERE admin_id = $id");
            $query->execute();

            $customer = $query->fetch(PDO::FETCH_ASSOC);
            if($customer){
                return $customer;
            }
            else {
                return false;
            }
        }
        
        public function deleteCustomer($id)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("DELETE FROM customers WHERE cust_id = $id");

            $delete = $query->execute();

            if($delete)
            {
                return true;
            }
            else
            {
                return false;
            } 
            
        }

        public function getAllCustomer()
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('SELECT * FROM customers ');
            $query->execute();

            $allCustomers = $query->fetchAll(PDO::FETCH_ASSOC);
            if($allCustomers){
                return $allCustomers;
            }
            else {
                return false;
            }
        }

        public function getCustomerbyId($id)
        {
            $database = new ADatabase();
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

        public function insertProperty($titre, $nb_piece, $nb_chambre, $nb_douche, $nb_wc, $addresse, $superficie, $type, $prix, $Description, $image, $nom_proprio, $contact_proprio)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("INSERT INTO proprietes (titre, nb_piece,	nb_chambre,	nb_douche,	nb_wc, addresse, superficie, type, prix,	Description, image,	nom_proprio, contact_proprio, enable) VALUES (:titre, :nb_piece, :nb_chambre, :nb_douche, :nb_wc, :addresse, :superficie, :type, :prix, :Description, :image, :nom_proprio, :contact_proprio, :enable)");
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
                "nom_proprio" => $nom_proprio,
                "contact_proprio" => $contact_proprio,
                "enable" => 1
            ]);

            if($insert){
                return true;
            }
            else {
                return false;
            }

        }

        public function getAllProperty()
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('SELECT * FROM proprietes ');
            $query->execute();

            $allProperties = $query->fetchAll(PDO::FETCH_ASSOC);
            if($allProperties){
                return $allProperties;
            }
            else {
                return false;
            }
        }

        public function getActiveProperty()
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('SELECT * FROM proprietes WHERE enable = 1');
            $query->execute();

            $allProperties = $query->fetchAll(PDO::FETCH_ASSOC);
            if($allProperties){
                return $allProperties;
            }
            else {
                return false;
            }
        }

        public function getnotActiveProperty()
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('SELECT * FROM proprietes WHERE enable = 0');
            $query->execute();

            $allProperties = $query->fetchAll(PDO::FETCH_ASSOC);
            if($allProperties){
                return $allProperties;
            }
            else {
                return false;
            }
        }

        public function getPropertybyId($id)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("SELECT * FROM proprietes WHERE prop_id = $id");
            $query->execute();

            $property = $query->fetch(PDO::FETCH_ASSOC);
            if($property){
                return $property;
            }
            else {
                return false;
            }
        }


    }
?>