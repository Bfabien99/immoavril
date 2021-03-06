<?php
    session_start();
    require 'vendor/autoload.php';
    require 'controllers/Customers.php';
    require 'controllers/Admin.php';
    include 'functions/encryptpass.php';
    include 'functions/inputClean.php';

    $router = new AltoRouter();

    /* ------------- HOME ROUTES ------------------*/
    /* GET */
    $router->map('GET', '/immoavril/',function(){
        $adminClass = new Admin();
        $properties = $adminClass->getActiveProperty();//Les propriétés activées
        $title = "Accueil";
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchProperty(strip_tags($_GET['search']));
            $title = "Search";
        }
        require 'views/home.php';
    });

    $router->map('GET', '/immoavril/customer/deconnect',function(){
        unset($_SESSION['xcustomer_id']);
        header('location: /immoavril/');
    });

    $router->map('GET', '/immoavril/admin/deconnect',function(){
        unset($_SESSION['xadmin_id']);
        header('location: /immoavril/');
    });

    $router->map('GET', '/immoavril/login',function(){
        require 'views/login.php';
    });

    $router->map('GET', '/immoavril/signup',function(){
        require 'views/signup.php';
    });

    $router->map('GET', '/immoavril/forget',function(){
        require 'views/forget.php';
    });

    $router->map('GET', '/immoavril/a_louer',function(){
        $adminClass = new Admin();
        $properties = $adminClass->getLocationProperty();//Les propriétés en location
        $title = "En location";
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchPropertyType(strip_tags($_GET['search']),'location');
            $title = "Search";
        }
        require 'views/home.php';
    });

    $router->map('GET', '/immoavril/en_vente',function(){
        $adminClass = new Admin();
        $properties = $adminClass->getBuyProperty();//Les propriétés en vente
        $title = "En vente";
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchPropertyType(strip_tags($_GET['search']),'vendre');
            $title = "Search";
        }
        require 'views/home.php';
    });

    $router->map('GET', '/immoavril/propriete/[*:id]',function($id)
    {
        $_SESSION['xmobilier_id'] = $id;
        $adminClass = new Admin();
        $property = $adminClass->getPropertybyId($id);//Cibler la propriété par son id
        $customer = $adminClass->getCustomerbyEmail($property['email_proprio']);
        
        $Increment = $adminClass->vueIncrement($id);//augmenter la vue de la propriété
        $_SESSION['xcustomer_email'] = $property['email_proprio'];
        require 'views/voir.php';
    });

    /* ------------- ADMIN ROUTES ------------------*/
    /* GET */
    $router->map('GET', '/immoavril/admin',function()
    {   
        if(!isset($_SESSION['xadmin_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $adminClass = new Admin();
        $admin = $adminClass->getAdmin($_SESSION['xadmin_id']);
        $customers = $adminClass->getAllCustomer();//Les utilisateurs
        $rcustomers = $adminClass->getRecentCustomer();//Les utilisateurs
        $properties = $adminClass->getAllProperty();//Toutes les propriétés
        $recents = $adminClass->getRecentProperty();//Toutes les propriétés
        $messages = $adminClass->getAllMessage();//Tous les mesages
        $active_properties = $adminClass->getActiveProperty();//Les propriétés activées
        $notactive_properties = $adminClass->getnotActiveProperty();//Les propriétés pas encores activées
        require 'views/admin/home.php';
    });

    $router->map('GET', '/immoavril/admin/propriete',function()
    {   
        if(!isset($_SESSION['xadmin_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $adminClass = new Admin();
        $admin = $adminClass->getAdmin($_SESSION['xadmin_id']);
        $properties = $adminClass->getAllProperty();//Toutes les propriétés
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchProperty2(strip_tags($_GET['search']));
        }
        require 'views/admin/propriete.php';
    });

    $router->map('GET', '/immoavril/admin/propriete/activate/[*:id]',function($id)
    {
        if(!isset($_SESSION['xadmin_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $adminClass = new Admin();
        $property = $adminClass->activateProperty($id);//Toutes les propriétés
        header('location: /immoavril/admin/propriete/edit/'.$id);
    });//TERMINER

    $router->map('GET', '/immoavril/admin/propriete/desactivate/[*:id]',function($id)
    {
        if(!isset($_SESSION['xadmin_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $adminClass = new Admin();
        $property = $adminClass->desactivateProperty($id);//Toutes les propriétés
        header("location:/immoavril/admin/propriete/edit/$id");
    });

    $router->map('GET', '/immoavril/admin/propriete/add',function(){
        if(!isset($_SESSION['xadmin_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        require 'views/admin/add.php';
    });

    $router->map('GET', '/immoavril/admin/propriete/edit/[*:id]',function($id){
        if(!isset($_SESSION['xadmin_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $adminClass = new Admin();
        $property = $adminClass->getPropertybyId($id);//Cibler la propriété par son id
        require 'views/admin/edit.php';
    });//TERMINER

    $router->map('GET', '/immoavril/admin/propriete/delete/[*:id]',function($id){
        if(!isset($_SESSION['xadmin_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $adminClass = new Admin();
        $delete = $adminClass->deleteProperty($id);
        if($delete)
        {
            header('Location: /immoavril/admin/propriete');
        }
        else
        {
            echo "Erreur lors de la suppression de la propriété";
        }
    });

    $router->map('GET', '/immoavril/admin/utilisateur',function()
    {
        if(!isset($_SESSION['xadmin_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $adminClass = new Admin();
        $admin = $adminClass->getAdmin($_SESSION['xadmin_id']);
        $customers = $adminClass->getAllCustomer();
        if (isset($_GET['search'])) {
            $customers = $adminClass->searchCustomer($_GET['search']);
        }
        require 'views/admin/utilisateur.php';
    });

    $router->map('GET', '/immoavril/admin/messages',function()
    {
        if(!isset($_SESSION['xadmin_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $adminClass = new Admin();
        $admin = $adminClass->getAdmin($_SESSION['xadmin_id']);
        $messages = $adminClass->getAllMessage();
        require 'views/admin/messages.php';
    });

    $router->map('GET', '/immoavril/admin/messages/[*:id]',function($id)
    {
        if(!isset($_SESSION['xadmin_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $adminClass = new Admin();
        $getMessage = $adminClass->getMessagebyId($id);
        if($getMessage){
            Admin::lu_2($id);
        }
        require 'views/admin/readmessage.php';
    });

    $router->map('GET', '/immoavril/admin/message/delete/[*:id]',function($id)
    {
        if(!isset($_SESSION['xadmin_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $adminClass = new Admin();
        $getMessage = $adminClass->deleteMessagebyId($id);
        if($getMessage){
            header('Location:/immoavril/admin/messages');
        }
        require 'views/admin/readmessage.php';
    });

    $router->map('GET', '/immoavril/admin/interest',function()
    {
        if(!isset($_SESSION['xadmin_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $adminClass = new Admin();
        $interests = $adminClass->getAllAdminMessages();

        require 'views/admin/interest.php';
    });

    $router->map('GET', '/immoavril/admin/interest/[*:id]',function($id)
    {
        if(!isset($_SESSION['xadmin_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $customerClass= new Customers();
        $message = $customerClass->getMessagebyId($id);
        if($message){Admin::lu($id);}
        require 'views/admin/read.php';
    });

    $router->map('GET', '/immoavril/admin/interests/delete/[*:id]',function($id)
    {
        if(!isset($_SESSION['xadmin_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $admin= new Admin();
        $interest = $admin->getInterestbyId($id);
        $customer = $admin->getCustomerbyEmail($interest['proprio_email']);
        if(empty($customer)){
            $delete = $admin->deleteInterest($interest['id']);
        }
        else {
            header('location:/immoavril/admin/interest');
        }
        
        if($delete){
            header('location:/immoavril/admin/interest');
        }
        require 'views/admin/read.php';
    });


    $router->map('GET', '/immoavril/admin/utilisateur/delete/[*:id]',function($id){
        if(!isset($_SESSION['xadmin_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $adminClass = new Admin();
        $delete = $adminClass->deleteCustomer($id);
        if($delete)
        {
            header('Location: /immoavril/admin/utilisateur');
        }
        else
        {
            echo "Erreur lors de la suppression de l'utilisateur";
        }
    });

    $router->map('GET', '/immoavril/admin/parametre',function(){
        if(!isset($_SESSION['xadmin_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $adminClass= new Admin();
        $admin = $adminClass->getAdmin($_SESSION['xadmin_id']);
        require 'views/admin/parametre.php';
    });


    /* POST */
    $router->map('POST', '/immoavril/admin/propriete/add',function()
    {   
        $msg="";
        if(isset($_POST['submit']))
        {
            if(!empty($_POST['titre']) && !empty($_POST['nombre_piece']) && !empty($_POST['nombre_chambre']) && !empty($_POST['nombre_douche']) && !empty($_POST['nombre_wc']) && !empty($_POST['addresse']) && !empty($_POST['superficie']) && !empty($_POST['type']) && !empty($_POST['prix']) && !empty($_POST['description']) && !empty($_POST['nom_proprio']) && !empty($_POST['tel_proprio']))
            {

                if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
                    //Verifie la taille de l'image
                    if($_FILES['image']['size'] <= 4000000){
                        $fileInfo = pathinfo($_FILES['image']['name']);
                        $extension = $fileInfo['extension'];
                        $allowedExtensions = array('jpg', 'jpeg', 'png');
    
                        //Verifie si l'extension est valide
                        if(in_array($extension, $allowedExtensions)){
                            //On stocke le fichier
                            $image = str_replace("/","",password_hash(rand(1,9999999), PASSWORD_DEFAULT) . basename($_FILES['image']['name']));
                            
                            $contact = preg_replace('/[^0-9]/', '', $_POST['tel_proprio']);
                            $admin = new Admin();
                            
                            $Admin=$admin->insertProperty(inputClean($_POST['titre']), inputClean($_POST['nombre_piece']), inputClean($_POST['nombre_chambre']), inputClean($_POST['nombre_douche']), inputClean($_POST['nombre_wc']), inputClean($_POST['addresse']), inputClean($_POST['superficie']), inputClean($_POST['type']), inputClean($_POST['prix']), inputClean($_POST['description']), $image, inputClean($_POST['nom_proprio']), inputClean($_POST['email_proprio']), inputClean($contact));
    
                            if($Admin){
                                $msg = "<div id='msg'><p class='success'>Enregistré</p><a href='' id='ok'>ok</a></div>";
                                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
                                $_POST['titre'] = $_POST['nombre_piece'] = $_POST['nombre_chambre'] = $_POST['nombre_douche'] = $_POST['nombre_wc'] = $_POST['addresse'] = $_POST['superficie'] = $_POST['type'] = $_POST['prix'] = $_POST['description'] = $_POST['nom_proprio'] = $_POST['tel_proprio'] = $_POST['email_proprio'] = "";
    
                            }
                            else{
                               $msg = "<div id='msg'><p class='error'>Non enregistré</p><a href='' id='ok'>ok</a></div>";
                            }
                            
    
                        }
                        else {
                           $msg = "<div id='msg'><p class='error'>Format non valide</p><a href='' id='ok'>ok</a></div>";
                        }
    
                    }
                    else {
                       $msg = "<div id='msg'><p class='error'>image trop volumineuse</p><a href='' id='ok'>ok</a></div>";
                    }
                }
                else {
                   $msg = "<div id='msg'><p class='error'>erreur d'image</p><a href='' id='ok'>ok</a></div>";
                }

            }
            else{
                $msg = "<div id='msg'><p class='error'>Veuillez remplir tous les champs suivis d'un (*)</p><a href='' id='ok'>ok</a></div>";
            }
        }
        require 'views/admin/add.php';
    });//TERMINER

    $router->map('POST', '/immoavril/admin/propriete/edit/[*:id]',function($id){
        $admin = new Admin();
        $property = $admin->getPropertybyId($id);
        $msg="";
        if(isset($_POST['submit']))
        {
            if(!empty($_POST['titre']) && !empty($_POST['nombre_piece']) && !empty($_POST['nombre_chambre']) && !empty($_POST['nombre_douche']) && !empty($_POST['nombre_wc']) && !empty($_POST['addresse']) && !empty($_POST['superficie']) && !empty($_POST['type']) && !empty($_POST['prix']) && !empty($_POST['description']) && !empty($_POST['nom_proprio']) && !empty($_POST['tel_proprio']))
            {   
                $contact = preg_replace('/[^0-9]/', '', $_POST['tel_proprio']);

                if(isset($_FILES['image']) && $_FILES['image']['error'] == 0)
                {
                    //Verifie la taille de l'image
                    if($_FILES['image']['size'] <= 4000000){
                        $fileInfo = pathinfo($_FILES['image']['name']);
                        $extension = $fileInfo['extension'];
                        $allowedExtensions = array('jpg', 'jpeg', 'png');
    
                        //Verifie si l'extension est valide
                        if(in_array($extension, $allowedExtensions)){
                            //On stocke le fichier
                            $image = str_replace("/","",password_hash(rand(1,9999999), PASSWORD_DEFAULT) . basename($_FILES['image']['name']));
                            
                            
                            $Admin=$admin->updateProperty($id,inputClean($_POST['titre']), inputClean($_POST['nombre_piece']), inputClean($_POST['nombre_chambre']), inputClean($_POST['nombre_douche']), inputClean($_POST['nombre_wc']), inputClean($_POST['addresse']), inputClean($_POST['superficie']), inputClean($_POST['type']), inputClean($_POST['prix']), inputClean($_POST['description']), $image, inputClean($_POST['nom_proprio']), inputClean($_POST['email_proprio']), inputClean($contact));
    
                            if($Admin){
                                $msg = "Modification effectuée";
                                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
                                header('Location: /immoavril/admin/propriete/edit/'.$id);
                            }
                            else{
                               $msg = "<div id='msg'><p class='error'>Non enregistré</p><a href='' id='ok'>ok</a></div>";
                            }
                            
    
                        }
                        else {
                           $msg = "<div id='msg'><p class='error'>Format non valide</p><a href='' id='ok'>ok</a></div>";
                        }
    
                    }
                    else {
                       $msg = "<div id='msg'><p class='error'>image trop volumineuse</p><a href='' id='ok'>ok</a></div>";
                    }
                }
                else 
                {
                    $Admin=$admin->updateProperty($id,inputClean($_POST['titre']), inputClean($_POST['nombre_piece']), inputClean($_POST['nombre_chambre']), inputClean($_POST['nombre_douche']), inputClean($_POST['nombre_wc']), inputClean($_POST['addresse']), inputClean($_POST['superficie']), inputClean($_POST['type']), inputClean($_POST['prix']), inputClean($_POST['description']), $property['image'], inputClean($_POST['nom_proprio']), inputClean($_POST['email_proprio']), inputClean($contact));
    
                    if($Admin){
                        $msg = "Modification effectuée";
                        header('Location: /immoavril/admin/propriete/edit/'.$id);
                    }
                    else{
                       $msg = "Non enregistré</p><a href='' id='ok'>ok</a></div>";
                    }
                }

            }
            else{
                $msg = "Veuillez remplir tous les champs suivis d'un (*)</p><a href='' id='ok'>ok</a></div>";
            }
        }
        require 'views/admin/edit.php';
    });//TERMINER

    $router->map('POST','/immoavril/admin/parametre',function(){
        $adminClass= new Admin();
        $admin = $adminClass->getAdmin($_SESSION['xadmin_id']);
        // echo $customer['cust_password'];
        if(isset($_POST['submit'])){
            if (!empty($_POST['pseudo'])) 
            {
                if (!empty($_POST['npassword']) && empty($_POST['cpassword'])) 
                {
                    $msg = "<div id='msg'><p class='error'>Veuillez confirmer votre mot de passe</p><a href='' id='ok'>ok</a></div>";
                }
                elseif((!empty($_POST['npassword']) || !empty($_POST['cpassword'])) && $_POST['npassword'] == $_POST['cpassword'])
                {    
                    $update=$adminClass->updateAdmin($_SESSION['xadmin_id'],$_POST['pseudo'],encryptpass($_POST['npassword']));

                    if ($update) 
                    {
                        $msg = "Modification effectuée";
                        header('Location: /immoavril/admin/parametre');
                    }
                    else
                    {
                        $msg = "<div id='msg'><p class='error'>Non enregistré</p><a href='' id='ok'>ok</a></div>";
                    }
                }
                else{
                    $update=$adminClass->updateAdmin($_SESSION['xadmin_id'],$_POST['pseudo'], $admin['ad_password']);

                    if ($update) {
                        $msg = "Modification effectuée";
                        header('Location: /immoavril/admin/parametre');
                    }
                    else{
                        $msg = "<div id='msg'><p class='error'>Non enregistré</p><a href='' id='ok'>ok</a></div>";
                    }
                }
            }
            else{
                $msg = "<div id='msg'><p class='error'>Veuillez remplir tous les champs suivis d'un (*)</p><a href='' id='ok'>ok</a></div>";
            }
        }
        require 'views/admin/parametre.php';
    });


    /* ------------- CUSTOMERS ROUTES ------------------*/
    /* GET */
    $router->map('GET', '/immoavril/customer',function()
    {
        $adminClass = new Admin();
        $properties = $adminClass->getActiveProperty();//Les propriétés activées
        $title = "Accueil";
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchProperty(strip_tags($_GET['search']));
            $title = "Search";
        }
        require 'views/customers/home.php';
    });//TERMINER

    $router->map('GET', '/immoavril/customer/a_louer',function(){
        $adminClass = new Admin();
        $properties = $adminClass->getLocationProperty();//Les propriétés en location
        $title = "En location";
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchPropertyType(strip_tags($_GET['search']),'location');
            $title = "Search";
        }
        
        require 'views/customers/home.php';
    });//TERMINER

    $router->map('GET', '/immoavril/customer/en_vente',function(){
        $adminClass = new Admin();
        $properties = $adminClass->getBuyProperty();//Les propriétés en vente
        $title = "En vente";
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchPropertyType(strip_tags($_GET['search']),'vendre');
            $title = "Search";
        }
        require 'views/customers/home.php';
    });//TERMINER


    $router->map('GET', '/immoavril/customer/propriete_consulter/[*:id]',function($id)
    {
        $_SESSION['xmobilier_id'] = $id;
        $adminClass = new Admin();
        $property = $adminClass->getPropertybyId($id);//Cibler la propriété par son id
        $_SESSION['xcustomer_email'] = $property['email_proprio'];
        $customerClass= new Customers();
        $customerPic = $adminClass->getCustomerbyEmail($property['email_proprio']);
        $customer = $customerClass->getCustomer($_SESSION['xcustomer_id']);
        $Increment = $adminClass->vueIncrement($id);
        require 'views/customers/voir.php';
    });//TERMINER


    $router->map('GET', '/immoavril/customer/compte',function()
    {
        if(!isset($_SESSION['xcustomer_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        header('Location: /immoavril/customer/compte/propriete');
    });

    $router->map('GET', '/immoavril/customer/compte/messages',function()
    {
        if(!isset($_SESSION['xcustomer_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $customerClass= new Customers();
        $customer = $customerClass->getCustomer($_SESSION['xcustomer_id']);
        $messages = $customerClass->getMessages($customer['cust_email']);
        require 'views/customers/messages.php';
    });

    $router->map('GET', '/immoavril/customer/compte/messages/[*:id]',function($id)
    {
        if(!isset($_SESSION['xcustomer_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $customerClass= new Customers();
        $customer = $customerClass->getCustomer($_SESSION['xcustomer_id']);
        $message = $customerClass->getMessagebyId($id);
        if($message['proprio_email'] !== $customer['cust_email']){
            header('location:/immoavril/customer/compte/messages');
        }
        if($message){Admin::lu($id);}
        require 'views/customers/readmessage.php';
    });

    $router->map('GET', '/immoavril/customer/compte/message/delete/[*:id]',function($id)
    {
        if(!isset($_SESSION['xcustomer_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $customerClass= new Customers();
        $customer = $customerClass->getCustomer($_SESSION['xcustomer_id']);
        $message = $customerClass->deleteMessage($id,$customer['cust_email']);
        if($message){
            header('location:/immoavril/customer/compte/messages');
        }
        require 'views/customers/messages.php';
    });

    $router->map('GET', '/immoavril/customer/compte/profil',function()
    {   
        $customerClass= new Customers();
        $customer = $customerClass->getCustomer($_SESSION['xcustomer_id']);
        require 'views/customers/profil.php';
    });

    $router->map('GET', '/immoavril/customer/compte/securite',function()
    {
        if(!isset($_SESSION['xcustomer_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $customerClass= new Customers();
        $customer = $customerClass->getCustomer($_SESSION['xcustomer_id']);
        require 'views/customers/securite.php';
    });

    $router->map('GET', '/immoavril/customer/compte/propriete',function(){
        if(!isset($_SESSION['xcustomer_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $customerClass= new Customers();
        $properties = $customerClass->getCustomerProperties($_SESSION['xcustomer_id']);
        require 'views/customers/propriete.php';
    });

    $router->map('GET', '/immoavril/customer/compte/propriete/add',function(){
        if(!isset($_SESSION['xcustomer_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        require 'views/customers/add.php';
    });

    $router->map('GET', '/immoavril/customer/compte/propriete/edit/[*:id]',function($id){
        if(!isset($_SESSION['xcustomer_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $adminClass = new Admin();
        $property = $adminClass->getPropertybyId($id);//Cibler la propriété par son id
        require 'views/customers/edit.php';
    });

    $router->map('GET', '/immoavril/customer/compte/propriete/delete/[*:id]',function($id){
        if(!isset($_SESSION['xcustomer_id'])){
            header('Location:/immoavril/');
            die('ERROR');
        }
        $adminClass = new Admin();
        $delete = $adminClass->deleteProperty($id);
        if($delete)
        {
            header('Location: /immoavril/customer/compte/propriete');
        }
        else
        {
            echo "Erreur lors de la suppression de la propriété";
        }
    });


    /* POST */
    $router->map('POST', '/immoavril/customer/compte/profil',function()
    { 
        $customerClass= new Customers();
        $customer = $customerClass->getCustomer($_SESSION['xcustomer_id']);
        $msg="";
        if(isset($_POST['submit']))
        {
            if(!empty($_POST['nom']) && !empty($_POST['prenoms']) && !empty($_POST['tel']))
            {   
                $contact = preg_replace('/[^0-9]/', '', $_POST['tel']);

                if(isset($_FILES['image']) && $_FILES['image']['error'] == 0)
                {
                    //Verifie la taille de l'image
                    if($_FILES['image']['size'] <= 4000000){
                        $fileInfo = pathinfo($_FILES['image']['name']);
                        $extension = $fileInfo['extension'];
                        $allowedExtensions = array('jpg', 'jpeg', 'png');
    
                        //Verifie si l'extension est valide
                        if(in_array($extension, $allowedExtensions)){
                            //On stocke le fichier
                            $image = str_replace("/","",password_hash(rand(1,9999999), PASSWORD_DEFAULT) . basename($_FILES['image']['name']));
                            
                            
                            $Admin=$customerClass->updateCustomer($_SESSION['xcustomer_id'],inputClean($_POST['nom']), inputClean($_POST['prenoms']), inputClean($_POST['tel']), $image);
    
                            if($Admin){
                                $msg = "Modification effectuée";
                                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
                                header('Location: /immoavril/customer/compte/profil');
                            }
                            else{
                               $msg = "<div id='msg'><p class='error'>Non enregistré</p><a href='' id='ok'>ok</a></div>";
                            }
                            
    
                        }
                        else {
                           $msg = "<div id='msg'><p class='error'>Format non valide</p><a href='' id='ok'>ok</a></div>";
                        }
    
                    }
                    else {
                       $msg = "<div id='msg'><p class='error'>image trop volumineuse</p><a href='' id='ok'>ok</a></div>";
                    }
                }
                else 
                {
                    $Admin=$customerClass->updateCustomer($_SESSION['xcustomer_id'],inputClean($_POST['nom']), inputClean($_POST['prenoms']), inputClean($_POST['tel']),$customer['cust_photo']);
    
                    if($Admin){
                        $msg = "Modification effectuée";
                        header('Location: /immoavril/customer/compte/profil');
                    }
                    else{
                       $msg = "<div id='msg'><p class='error'>Non enregistré</p><a href='' id='ok'>ok</a></div>";
                    }
                }

            }
            else{
                $msg = "<div id='msg'><p class='error'>Veuillez remplir tous les champs suivis d'un (*)</p><a href='' id='ok'>ok</a></div>";
            }
        }
        require 'views/customers/profil.php';
    });

    $router->map('POST', '/immoavril/customer/compte/securite',function()
    {
        $customerClass= new Customers();
        $customer = $customerClass->getCustomer($_SESSION['xcustomer_id']);
        // echo $customer['cust_password'];
        if(isset($_POST['submit'])){
            if (!empty($_POST['email']) && !empty($_POST['pseudo'])) 
            {
                if (!empty($_POST['npassword']) && empty($_POST['cpassword'])) 
                {
                    $msg = "<div id='msg'><p class='error'>Veuillez confirmer votre mot de passe</p><a href='' id='ok'>ok</a></div>";
                }
                elseif((!empty($_POST['npassword']) && !empty($_POST['cpassword'])) && $_POST['npassword'] == $_POST['cpassword'])
                {    
                    $Customer=$customerClass->updateCustomer2($_SESSION['xcustomer_id'],$_POST['pseudo'], $_POST['email'], encryptpass($_POST['npassword']));

                    if ($Customer) 
                    {
                        $msg = "Modification effectuée";
                        header('Location: /immoavril/customer/compte/securite');
                    }
                    else
                    {
                        $msg = "<div id='msg'><p class='error'>Non enregistré</p><a href='' id='ok'>ok</a></div>";
                    }
                }
                else{
                    
                    $msg = "<div id='msg'><p class='error'>Les mots de passe ne corresponde pas</p><a href='' id='ok'>ok</a></div>";
                    
                }
            }
            else{
                $msg = "<div id='msg'><p class='error'>Veuillez remplir tous les champs suivis d'un (*)</p><a href='' id='ok'>ok</a></div>";
            }
        }
        require 'views/customers/securite.php';
    });

    $router->map('POST', '/immoavril/customer/compte/propriete/add',function(){
        $msg="";
        $customerClass = new Customers();
        $customer = $customerClass->getCustomer($_SESSION['xcustomer_id']);
        if(isset($_POST['submit']))
        {
            if(!empty($_POST['titre']) && !empty($_POST['nombre_piece']) && !empty($_POST['nombre_chambre']) && !empty($_POST['nombre_douche']) && !empty($_POST['nombre_wc']) && !empty($_POST['addresse']) && !empty($_POST['superficie']) && !empty($_POST['type']) && !empty($_POST['prix']) && !empty($_POST['description']))
            {

                if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
                    //Verifie la taille de l'image
                    if($_FILES['image']['size'] <= 4000000){
                        $fileInfo = pathinfo($_FILES['image']['name']);
                        $extension = $fileInfo['extension'];
                        $allowedExtensions = array('jpg', 'jpeg', 'png');
    
                        //Verifie si l'extension est valide
                        if(in_array($extension, $allowedExtensions)){
                            //On stocke le fichier
                            $image = str_replace("/","",password_hash(rand(1,9999999), PASSWORD_DEFAULT) . basename($_FILES['image']['name']));
                            
                            $insertProperty=$customerClass->insertCustomersProperty($_SESSION['xcustomer_id'],inputClean($_POST['titre']), inputClean($_POST['nombre_piece']), inputClean($_POST['nombre_chambre']), inputClean($_POST['nombre_douche']), inputClean($_POST['nombre_wc']), inputClean($_POST['addresse']), inputClean($_POST['superficie']), inputClean($_POST['type']), inputClean($_POST['prix']), inputClean($_POST['description']), $image, inputClean($customer['cust_nom']." ".$customer['cust_prenoms']),  inputClean($customer['cust_contact']),  inputClean($customer['cust_email']));
    
                            if($insertProperty){
                                $msg = "<div id='msg'><p class='success'>Enregistré</p><a href='' id='ok'>ok</a></div>";
                                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
                                $_POST['titre'] = $_POST['nombre_piece'] = $_POST['nombre_chambre'] = $_POST['nombre_douche'] = $_POST['nombre_wc'] = $_POST['addresse'] = $_POST['superficie'] = $_POST['type'] = $_POST['prix'] = $_POST['description'] = "";
    
                            }
                            else{
                               $msg = "<div id='msg'><p class='error'>Non enregistré</p><a href='' id='ok'>ok</a></div>";
                            }
                            
    
                        }
                        else {
                           $msg = "<div id='msg'><p class='error'>Format non valide</p><a href='' id='ok'>ok</a></div>";
                        }
    
                    }
                    else {
                       $msg = "<div id='msg'><p class='error'>image trop volumineuse</p><a href='' id='ok'>ok</a></div>";
                    }
                }
                else {
                   $msg = "<div id='msg'><p class='error'>erreur d'image</p><a href='' id='ok'>ok</a></div>";
                }

            }
            else{
                $msg = "<div id='msg'><p class='error'>Veuillez remplir tous les champs suivis d'un (*)</p><a href='' id='ok'>ok</a></div>";
            }
        }
        require 'views/customers/add.php';
    });

    $router->map('POST', '/immoavril/customer/compte/propriete/edit/[*:id]',function($id){
        $adminClass = new Admin();
        $property = $adminClass->getPropertybyId($id);//Cibler la propriété par son id
        $msg="";
        $customerClass = new Customers();
        if(isset($_POST['submit']))
        {
            if(!empty($_POST['titre']) && !empty($_POST['nombre_piece']) && !empty($_POST['nombre_chambre']) && !empty($_POST['nombre_douche']) && !empty($_POST['nombre_wc']) && !empty($_POST['addresse']) && !empty($_POST['superficie']) && !empty($_POST['type']) && !empty($_POST['prix']) && !empty($_POST['description']))
            {   

                if(isset($_FILES['image']) && $_FILES['image']['error'] == 0)
                {
                    //Verifie la taille de l'image
                    if($_FILES['image']['size'] <= 4000000){
                        $fileInfo = pathinfo($_FILES['image']['name']);
                        $extension = $fileInfo['extension'];
                        $allowedExtensions = array('jpg', 'jpeg', 'png');
    
                        //Verifie si l'extension est valide
                        if(in_array($extension, $allowedExtensions)){
                            //On stocke le fichier
                            $image = str_replace("/","",password_hash(rand(1,9999999), PASSWORD_DEFAULT) . basename($_FILES['image']['name']));
                            
                            
                            $update=$customerClass->updateCustProperty($id,inputClean($_POST['titre']), inputClean($_POST['nombre_piece']), inputClean($_POST['nombre_chambre']), inputClean($_POST['nombre_douche']), inputClean($_POST['nombre_wc']), inputClean($_POST['addresse']), inputClean($_POST['superficie']), inputClean($_POST['type']), inputClean($_POST['prix']), inputClean($_POST['description']), $image);
    
                            if($update){
                                $msg = "Modification effectuée";
                                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
                                header('Location: /immoavril/customer/compte/propriete/edit/'.$id);
                            }
                            else{
                               $msg = "<div id='msg'><p class='error'>Non enregistré</p><a href='' id='ok'>ok</a></div>";
                            }
                            
    
                        }
                        else {
                           $msg = "<div id='msg'><p class='error'>Format non valide</p><a href='' id='ok'>ok</a></div>";
                        }
    
                    }
                    else {
                       $msg = "<div id='msg'><p class='error'>image trop volumineuse, la taille ne doit pas depasser 4 mo</p><a href='' id='ok'>ok</a></div>";
                    }
                }
                else 
                {
                    $update=$customerClass->updateCustProperty($id,inputClean($_POST['titre']), inputClean($_POST['nombre_piece']), inputClean($_POST['nombre_chambre']), inputClean($_POST['nombre_douche']), inputClean($_POST['nombre_wc']), inputClean($_POST['addresse']), inputClean($_POST['superficie']), inputClean($_POST['type']), inputClean($_POST['prix']), inputClean($_POST['description']), $property['image']);
    
                    if($update){
                        $msg = "Modification effectuée";
                        header('Location: /immoavril/customer/compte/propriete/edit/'.$id);
                    }
                    else{
                       $msg = "<div id='msg'><p class='error'>Non enregistré</p><a href='' id='ok'>ok</a></div>";
                    }
                }

            }
            else{
                $msg = "<div id='msg'><p class='error'>Veuillez remplir tous les champs suivis d'un (*)</p><a href='' id='ok'>ok</a></div>";
            }
        }
        require 'views/customers/edit.php';
    });

    $match = $router->match();

    if( is_array($match) && is_callable( $match['target'] ) ) 
   {
	    call_user_func_array( $match['target'], $match['params'] ); 
    } 
    else 
    {
	    require 'views/error404.php';
        die();
    }