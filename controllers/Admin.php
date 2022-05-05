<?php
    require 'models/ADatabase.php';

    class Admin{

        public function getAdmin($id){
            $database = new CDatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("SELECT * FROM admin WHERE admin_id = $id");
            $query->execute();

            $admin = $query->fetch(PDO::FETCH_ASSOC);
            if($admin){
                return $admin;
            }
            else {
                return false;
            }
        }

        public function updateAdmin($id,$pseudo,$password){
            $database = new CDatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("UPDATE admin SET ad_pseudo=:pseudo, ad_password=:password WHERE admin_id = $id");
            $update=$query->execute([
                "pseudo" => $pseudo,
                "password" => $password
            ]);

            if($update){
                return true;
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

        public function getCustomerbyEmail($email)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('SELECT * FROM customers WHERE cust_email LIKE '.'"'.'%'.$email.'%'.'"');
            $query->execute();

            $customer = $query->fetch(PDO::FETCH_ASSOC);
            if($customer){
                return $customer;
            }
            else {
                return false;
            }
        }


        public function searchCustomer($search)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('SELECT * FROM customers WHERE cust_nom LIKE '.'"'.'%'.$search.'%'.'"'.' OR cust_prenoms LIKE '.'"'.'%'.$search.'%'.'"');
            $query->execute();

            $customer = $query->fetchAll(PDO::FETCH_ASSOC);
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

        public function updateProperty($id,$titre, $nb_piece, $nb_chambre, $nb_douche, $nb_wc, $addresse, $superficie, $type, $prix, $Description, $image)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("UPDATE proprietes SET titre=:titre, nb_piece=:nb_piece,	nb_chambre=:nb_chambre,	nb_douche=:nb_douche,	nb_wc=:nb_wc, addresse=:addresse, superficie=:superficie, type=:type, prix=:prix, Description=:Description, image=:image WHERE prop_id =:id");
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

            $query = $db->prepare('SELECT * FROM proprietes ORDER BY prop_created');
            $query->execute();

            $allProperties = $query->fetchAll(PDO::FETCH_ASSOC);
            if($allProperties){
                return $allProperties;
            }
            else {
                return false;
            }
        }

        public function getRecentProperty()
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('SELECT * FROM proprietes ORDER BY prop_created DESC LIMIT 5 ');
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

            $query = $db->prepare('SELECT * FROM proprietes WHERE enable = 1 LIMIT 3');
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

            $query = $db->prepare('SELECT * FROM proprietes WHERE addresse LIKE '.'"'.'%'.$search.'%'.'"'.' OR prix <=  '.'"'.$search.'"'.' AND enable = 1');
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

            $query = $db->prepare('SELECT * FROM proprietes WHERE addresse ='.'"'.$search.'"'.' OR prix <=  '.'"'.$search.'"'.' AND type = '.'"'.$type.'"'.' AND enable = 1');
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


        public function getAllMessage()
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('SELECT * FROM contact ORDER BY date DESC');
            $query->execute();

            $message = $query->fetchAll(PDO::FETCH_ASSOC);
            if($message){
                return $message;
            }
            else {
                return false;
            }
        }

        public function getMessagebyId($id)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('SELECT * FROM contact WHERE id = '.$id);
            $query->execute();

            $message = $query->fetch(PDO::FETCH_ASSOC);
            if($message){
                return $message;
            }
            else {
                return false;
            }
        }

        public function deleteMessagebyId($id)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('DELETE FROM contact WHERE id = '.$id);
            $delete=$query->execute();

            if($delete){
                return true;
            }
            else {
                return false;
            }
        }

        public function getInterestbyId($id)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('SELECT * FROM messages WHERE id = '.$id);
            $query->execute();

            $message = $query->fetch(PDO::FETCH_ASSOC);
            if($message){
                return $message;
            }
            else {
                return false;
            }
        }

        public function deleteInterest($email)
        {
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('DELETE FROM messages WHERE proprio_email = '.'"'.$email.'"');
            $delete = $query->execute();

            if($delete){
                return true;
            }
            else {
                return false;
            }
        }

        public function getMessages(){
            $database = new CDatabase();
            $db = $database->dbconnect();

            $query = $db->prepare('SELECT * FROM messages');
            $query->execute();

            $messages = $query->fetchAll(PDO::FETCH_ASSOC);
            if($messages){
                return $messages;
            }
            else {
                return false;
            }
        }

        public static function lu($id){
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("UPDATE messages SET lu = 1 WHERE id = $id");
            $lu = $query->execute();

            if($lu){
                return true;
            }
            else {
                return false;
            }
        }

        public static function lu_2($id){
            $database = new ADatabase();
            $db = $database->dbconnect();

            $query = $db->prepare("UPDATE contact SET lu = 1 WHERE id = $id");
            $lu = $query->execute();

            if($lu){
                return true;
            }
            else {
                return false;
            }
        }


    }
?>