<?php include 'session.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sécurité</title>
</head>
<body>
    <?php include 'menutop.php';?>
    <div class="container">
        <h2>Sécurité</h2>
    <?php if($customer): ?>
    <form action="" method="post" id="form" enctype="multipart/form-data">
            <h2>Modifier vos informations</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, incidunt? Eius animi cupiditate quasi temporibus, aspernatur atque tenetur iste nam?</p>
            <div class="group">
                <label for="">Email *</label>
                <input type="email" name="email" id="email" required value="<?= $customer['cust_email'];?>">
            </div>
            <div class="group">
                <label for="">Pseudo *</label>
                <input type="text" name="pseudo" id="pseudo" required value="<?= $customer['cust_pseudo'];?>">
            </div>
            <div class="group">
                <label for="">Nouveau mot de passe</label>
                <input type="password" name="npassword" id="npassword">
            </div>
            <div class="group">
                <label for="">Confirmer mot de passe</label>
                <input type="password" name="cpassword" id="cpassword">
            </div>
            
            
            <input type="submit" value="Modifier" name="submit">

            <div id="msg"></div>
            
            <?php if(!empty($msg)):?>
                    <?=$msg?>
            <?php endif;?>
        </form>
    </div>
    <?php endif; ?>
</body>
</html>