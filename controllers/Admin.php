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

        public function insertProperty($titre, $nb_piece, $nb_chambre, $nb_douche, $nb_wc, $addresse, $superficie, $type, $prix, $Description, $image, $nom_proprio, $email_proprio, $contact_proprio)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("INSERT INTO proprietes (titre, nb_piece,	nb_chambre,	nb_douche,	nb_wc, addresse, superficie, type, prix,	Description, image,	nom_proprio, contact_proprio, email_proprio, enable) VALUES (:titre, :nb_piece, :nb_chambre, :nb_douche, :nb_wc, :addresse, :superficie, :type, :prix, :Description, :image, :nom_proprio, :contact_proprio, :email_proprio, :enable)");
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
                "email_proprio" => $email_proprio,
                "enable" => 1
            ]);

            if($insert){
                return true;
            }
            else {
                return false;
            }

        }

        public function updateProperty($id,$titre, $nb_piece, $nb_chambre, $nb_douche, $nb_wc, $addresse, $superficie, $type, $prix, $Description, $image, $nom_proprio, $email_proprio, $contact_proprio)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("UPDATE proprietes SET titre=:titre, nb_piece=:nb_piece,	nb_chambre=:nb_chambre,	nb_douche=:nb_douche,	nb_wc=:nb_wc, addresse=:addresse, superficie=:superficie, type=:type, prix=:prix, Description=:Description, image=:image, nom_proprio=:nom_proprio, email_proprio=:email_proprio, contact_proprio=:contact_proprio WHERE prop_id =:id");
            $insert = $query->execute([
                "id" => $id,
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
                "email_proprio" => $email_proprio,
            ]);

            if($insert){
                return true;
            }
            else {
                return false;
            }

        }

        public function activateProperty($id)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("UPDATE proprietes SET enable = 1 WHERE prop_id = $id");
            $activate = $query->execute();

            if($activate){
                return true;
            }
            else {
                return false;
            }

        }

        public function desactivateProperty($id)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("UPDATE proprietes SET enable = 0 WHERE prop_id = $id");
            $desactivate = $query->execute();

            if($desactivate){
                return true;
            }
            else {
                return false;
            }

        }

        public function deleteProperty($id)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("DELETE FROM proprietes WHERE prop_id = $id");
            $property = $query->execute();

            if($property){
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

        public function getLocationProperty()
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('SELECT * FROM proprietes WHERE enable = 1 AND type = "location"');
            $query->execute();

            $allProperties = $query->fetchAll(PDO::FETCH_ASSOC);
            if($allProperties){
                return $allProperties;
            }
            else {
                return false;
            }
        }

        public function getBuyProperty()
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('SELECT * FROM proprietes WHERE enable = 1 AND type = "vendre"');
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

        public function searchProperty($search)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('SELECT * FROM proprietes WHERE addresse ='.'"'.$search.'"'.' OR prix <=  '.'"'.$search.'"');
            $query->execute();

            $property = $query->fetchAll(PDO::FETCH_ASSOC);
            if($property){
                return $property;
            }
            else {
                return false;
            }
        }

        public function searchPropertyType($search, $type)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('SELECT * FROM proprietes WHERE addresse ='.'"'.$search.'"'.' OR prix <=  '.'"'.$search.'"'.' AND type = '.'"'.$type.'"');
            $query->execute();

            $property = $query->fetchAll(PDO::FETCH_ASSOC);
            if($property){
                return $property;
            }
            else {
                return false;
            }
        }

        public function vueIncrement($id)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("UPDATE `proprietes` SET `vue` = (`vue`+1) WHERE `proprietes`.`prop_id` = $id");
            $property=$query->execute();

            if($property){
                return $property;
            }
            else {
                return false;
            }
        }


    }
?>