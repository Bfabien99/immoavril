<?php include 'session.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
    <?php include 'menutop.php';?>
    <div class="container">
    <?php if($customer): ?>
        <h2>Informations de l'utilisateur</h2>
        <div class="info">
            <h1>Profil</h1>
            <p>Vous êtes connecté en tant que <?=$customer['cust_nom']?> <?=$customer['cust_prenoms']?></p>
            <p>Votre email est <?=$customer['cust_email']?></p>
            <p>Votre pseudo est <?=$customer['cust_pseudo']?></p>
            <p>Votre contact est <?=$customer['cust_contact']?></p>
            <img src="<?= !empty($customer['cust_photo']) ? PROPERTY_IMG.$customer['cust_photo']:""?>" alt="" width="90px" height="90px">
        </div>
        <form action="" method="post" id="form" enctype="multipart/form-data">
            <h2>Modifier vos informations</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, incidunt? Eius animi cupiditate quasi temporibus, aspernatur atque tenetur iste nam?</p>
            <div class="group">
                <label for="">Nom*</label>
                <input type="text" name="nom" id="nom" required value="<?= $customer['cust_nom'];?>">
            </div>
            <div class="group">
                <label for="">Prenoms*</label>
                <input type="text" name="prenoms" id="prenoms" required value="<?= $customer['cust_prenoms'];?>">
            </div>
            <div class="group">
                <label for="">Contact*</label>
                <input type="tel" name="tel" id="tel" required value="<?= $customer['cust_contact'];?>">
            </div>
            <div class="group">
                <label for="">Ajouter une image de profile</label>
                <input type="file" name="image" id="photo">
            </div>
            
            
            <input type="submit" value="Modifier" name="submit">

            <div id="msg"></div>
            
            <?php if(!empty($msg)):?>
                    <?=$msg?>
            <?php endif;?>
        </form>
    <?php endif; ?>
    </div>
</body>
</html>