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
        require 'views/home.php';
    });

    $router->map('GET', '/immoavril/login',function(){
        require 'views/login.php';
    });

    $router->map('GET', '/immoavril/signup',function(){
        require 'views/signup.php';
    });

    $router->map('GET', '/immoavril/a_louer',function(){
        $adminClass = new Admin();
        $properties = $adminClass->getLocationProperty();//Les propriétés en location
        require 'views/home.php';
    });

    $router->map('GET', '/immoavril/en_vente',function(){
        $adminClass = new Admin();
        $properties = $adminClass->getBuyProperty();//Les propriétés en vente
        require 'views/home.php';
    });

    $router->map('GET', '/immoavril/propriete/[*:id]',function($id)
    {
        $adminClass = new Admin();
        $property = $adminClass->getPropertybyId($id);//Cibler la propriété par son id
        $Increment = $adminClass->vueIncrement($id);//augmenter la vue de la propriété
        require 'views/voir.php';
    });


    /* ------------- ADMIN ROUTES ------------------*/
    /* GET */
    $router->map('GET', '/immoavril/admin',function()
    {
        $adminClass = new Admin();
        $admin = $adminClass->getAdmin($_SESSION['xadmin_id']);
        $customers = $adminClass->getAllCustomer();//Les utilisateurs
        $properties = $adminClass->getAllProperty();//Toutes les propriétés
        $active_properties = $adminClass->getActiveProperty();//Les propriétés activées
        $notactive_properties = $adminClass->getnotActiveProperty();//Les propriétés pas encores activées
        require 'views/admin/home.php';
    });

    $router->map('GET', '/immoavril/admin/propriete',function()
    {
        $adminClass = new Admin();
        $admin = $adminClass->getAdmin($_SESSION['xadmin_id']);
        $properties = $adminClass->getAllProperty();//Toutes les propriétés
        require 'views/admin/propriete.php';
    });

    $router->map('GET', '/immoavril/admin/propriete/add',function(){
        require 'views/admin/add.php';
    });

    $router->map('GET', '/immoavril/admin/propriete/edit/id',function(){
        require 'views/admin/edit.php';
    });

    $router->map('GET', '/immoavril/admin/propriete/delete/id',function(){
        
    });

    $router->map('GET', '/immoavril/admin/utilisateur',function()
    {
        $adminClass = new Admin();
        $admin = $adminClass->getAdmin($_SESSION['xadmin_id']);
        $customers = $adminClass->getAllCustomer();
        require 'views/admin/utilisateur.php';
    });

    $router->map('GET', '/immoavril/admin/parametre',function(){
        require 'views/admin/parametre.php';
    });


    /* POST */
    $router->map('POST', '/immoavril/admin/propriete/add',function()
    {
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
                            
                            $Admin=$admin->insertProperty(inputClean($_POST['titre']), inputClean($_POST['nombre_piece']), inputClean($_POST['nombre_chambre']), inputClean($_POST['nombre_douche']), inputClean($_POST['nombre_wc']), inputClean($_POST['addresse']), inputClean($_POST['superficie']), inputClean($_POST['type']), inputClean($_POST['prix']), inputClean($_POST['description']), $image, inputClean($_POST['nom_proprio']), inputClean($contact));
    
                            if($Admin){
                                $msg = "Enregistré";
                                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
    
                            }
                            else{
                               $msg = "Non enregistré";
                            }
                            
    
                        }
                        else {
                           $msg = "Format non valide";
                        }
    
                    }
                    else {
                       $msg = "image trop volumineuse";
                    }
                }
                else {
                   $msg = "erreur d'image";
                }

            }
        }
        require 'views/admin/add.php';
    });


    /* ------------- CUSTOMERS ROUTES ------------------*/
    /* GET */
    $router->map('GET', '/immoavril/customer',function()
    {
        $adminClass = new Admin();
        $properties = $adminClass->getActiveProperty();//Les propriétés activées
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchProperty(strip_tags($_GET['search']));
        }
        require 'views/customers/home.php';
    });

    $router->map('GET', '/immoavril/customer/a_louer',function(){
        $adminClass = new Admin();
        $properties = $adminClass->getLocationProperty();//Les propriétés en location
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchPropertyType(strip_tags($_GET['search']),'location');
        }
        require 'views/customers/home.php';
    });

    $router->map('GET', '/immoavril/customer/en_vente',function(){
        $adminClass = new Admin();
        $properties = $adminClass->getBuyProperty();//Les propriétés en vente
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchPropertyType(strip_tags($_GET['search']),'vendre');
        }
        require 'views/customers/home.php';
    });

    $router->map('GET', '/immoavril/customer/compte',function()
    {
        require 'views/customers/dashboard.php';
    });

    $router->map('GET', '/immoavril/customer/propriete_consulter/[*:id]',function($id)
    {
        $adminClass = new Admin();
        $property = $adminClass->getPropertybyId($id);//Cibler la propriété par son id
        require 'views/customers/voir.php';
    });

    $router->map('GET', '/immoavril/customer/proprietes',function(){
        require 'views/customers/propriete.php';
    });

    $router->map('GET', '/immoavril/customer/propriete/add',function(){
        require 'views/customers/add.php';
    });

    $router->map('GET', '/immoavril/customer/propriete/edit/id',function(){
        require 'views/customers/edit.php';
    });

    $router->map('GET', '/immoavril/customer/propriete/delete/id',function(){
   
    });

    $router->map('GET', '/immoavril/customer/parametre',function(){
        require 'views/customers/parametre.php';
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