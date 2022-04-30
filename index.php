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
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchProperty(strip_tags($_GET['search']));
        }
        $title = "Accueil";
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
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchPropertyType(strip_tags($_GET['search']),'location');
        }
        $title = "En location";
        require 'views/home.php';
    });

    $router->map('GET', '/immoavril/en_vente',function(){
        $adminClass = new Admin();
        $properties = $adminClass->getBuyProperty();//Les propriétés en vente
        $title = "En vente";
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchPropertyType(strip_tags($_GET['search']),'vendre');
        }
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
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchProperty(strip_tags($_GET['search']));
        }
        require 'views/admin/propriete.php';
    });

    $router->map('GET', '/immoavril/admin/propriete/activate/[*:id]',function($id)
    {
        $adminClass = new Admin();
        $property = $adminClass->activateProperty($id);//Toutes les propriétés
        header('location: /immoavril/admin/propriete/edit/'.$id);
    });//TERMINER

    $router->map('GET', '/immoavril/admin/propriete/desactivate/[*:id]',function($id)
    {
        $adminClass = new Admin();
        $property = $adminClass->desactivateProperty($id);//Toutes les propriétés
        header("location:/immoavril/admin/propriete/edit/$id");
    });

    $router->map('GET', '/immoavril/admin/propriete/add',function(){
        require 'views/admin/add.php';
    });

    $router->map('GET', '/immoavril/admin/propriete/edit/[*:id]',function($id){
        $adminClass = new Admin();
        $property = $adminClass->getPropertybyId($id);//Cibler la propriété par son id
        require 'views/admin/edit.php';
    });//TERMINER

    $router->map('GET', '/immoavril/admin/propriete/delete/[*:id]',function($id){
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
        $adminClass = new Admin();
        $admin = $adminClass->getAdmin($_SESSION['xadmin_id']);
        $customers = $adminClass->getAllCustomer();
        require 'views/admin/utilisateur.php';
    });

    $router->map('GET', '/immoavril/admin/utilisateur/delete/[*:id]',function($id){
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
                                $msg = "Enregistré";
                                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
                                $_POST['titre'] = $_POST['nombre_piece'] = $_POST['nombre_chambre'] = $_POST['nombre_douche'] = $_POST['nombre_wc'] = $_POST['addresse'] = $_POST['superficie'] = $_POST['type'] = $_POST['prix'] = $_POST['description'] = $_POST['nom_proprio'] = $_POST['tel_proprio'] = $_POST['email_proprio'] = "";
    
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
            else{
                $msg = "Veuillez remplir tous les champs suivis d'un (*)";
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
                else 
                {
                    $Admin=$admin->updateProperty($id,inputClean($_POST['titre']), inputClean($_POST['nombre_piece']), inputClean($_POST['nombre_chambre']), inputClean($_POST['nombre_douche']), inputClean($_POST['nombre_wc']), inputClean($_POST['addresse']), inputClean($_POST['superficie']), inputClean($_POST['type']), inputClean($_POST['prix']), inputClean($_POST['description']), $property['image'], inputClean($_POST['nom_proprio']), inputClean($_POST['email_proprio']), inputClean($contact));
    
                    if($Admin){
                        $msg = "Modification effectuée";
                    }
                    else{
                       $msg = "Non enregistré";
                    }
                }

            }
            else{
                $msg = "Veuillez remplir tous les champs suivis d'un (*)";
            }
        }
        require 'views/admin/edit.php';
    });//TERMINER


    /* ------------- CUSTOMERS ROUTES ------------------*/
    /* GET */
    $router->map('GET', '/immoavril/customer',function()
    {
        $adminClass = new Admin();
        $properties = $adminClass->getActiveProperty();//Les propriétés activées
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchProperty(strip_tags($_GET['search']));
        }
        $title = "Accueil";
        require 'views/customers/home.php';
    });//TERMINER

    $router->map('GET', '/immoavril/customer/a_louer',function(){
        $adminClass = new Admin();
        $properties = $adminClass->getLocationProperty();//Les propriétés en location
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchPropertyType(strip_tags($_GET['search']),'location');
        }
        $title = "En location";
        require 'views/customers/home.php';
    });//TERMINER

    $router->map('GET', '/immoavril/customer/en_vente',function(){
        $adminClass = new Admin();
        $properties = $adminClass->getBuyProperty();//Les propriétés en vente
        if(!empty($_GET['search'])){
            $properties = $adminClass->searchPropertyType(strip_tags($_GET['search']),'vendre');
        }
        $title = "En vente";
        require 'views/customers/home.php';
    });//TERMINER

    $router->map('GET', '/immoavril/customer/propriete_consulter/[*:id]',function($id)
    {
        $adminClass = new Admin();
        $property = $adminClass->getPropertybyId($id);//Cibler la propriété par son id
        require 'views/customers/voir.php';
    });//TERMINER


    $router->map('GET', '/immoavril/customer/compte',function()
    {
        require 'views/customers/dashboard.php';
    });

    $router->map('GET', '/immoavril/customer/compte/messages',function()
    {
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
        $customerClass= new Customers();
        $customer = $customerClass->getCustomer($_SESSION['xcustomer_id']);
        require 'views/customers/securite.php';
    });

    $router->map('GET', '/immoavril/customer/compte/propriete',function(){
        require 'views/customers/propriete.php';
    });

    $router->map('GET', '/immoavril/customer/compte/propriete/add',function(){
        require 'views/customers/add.php';
    });

    $router->map('GET', '/immoavril/customer/compte/propriete/edit/id',function(){
        require 'views/customers/edit.php';
    });

    $router->map('GET', '/immoavril/customer/compte/propriete/delete/id',function(){
   
    });

    $router->map('GET', '/immoavril/customer/compte/parametre',function(){
        require 'views/customers/parametre.php';
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
                else 
                {
                    $Admin=$customerClass->updateCustomer($_SESSION['xcustomer_id'],inputClean($_POST['nom']), inputClean($_POST['prenoms']), inputClean($_POST['tel']),$customer['cust_photo']);
    
                    if($Admin){
                        $msg = "Modification effectuée";
                        header('Location: /immoavril/customer/compte/profil');
                    }
                    else{
                       $msg = "Non enregistré";
                    }
                }

            }
            else{
                $msg = "Veuillez remplir tous les champs suivis d'un (*)";
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
                    $msg = "Veuillez confirmer votre mot de passe";
                }
                elseif((!empty($_POST['npassword']) || !empty($_POST['cpassword'])) && $_POST['npassword'] == $_POST['cpassword'])
                {    
                    $Customer=$customerClass->updateCustomer2($_SESSION['xcustomer_id'],$_POST['pseudo'], $_POST['email'], encryptpass($_POST['npassword']));

                    if ($Customer) 
                    {
                        $msg = "Modification effectuée";
                        header('Location: /immoavril/customer/compte/securite');
                    }
                    else
                    {
                        $msg = "Non enregistré";
                    }
                }
                else{
                    $Customer=$customerClass->updateCustomer2($_SESSION['xcustomer_id'],$_POST['pseudo'], $_POST['email'], $customer['cust_password']);

                    if ($Customer) {
                        $msg = "Modification effectuée";
                        header('Location: /immoavril/customer/compte/securite');
                    }
                    else{
                        $msg = "Non enregistré";
                    }
                }
            }
            else{
                $msg = "Veuillez remplir tous les champs suivis d'un (*)";
            }
        }
        require 'views/customers/securite.php';
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