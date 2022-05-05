<?php include 'session.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sécurité</title>
    <style>
        .container{
            align-items: center;
        }

        form{
            display: flex;
            flex-direction: column;
            gap:1.2em;
            box-shadow: 0px 10px 5px rgba(0, 0, 0, 0.08);
        }

        form{
            width: 100%;
            max-width:600px;
            text-align: center;
            background-color:white;
            border-radius: 5px;
            overflow: hidden;
        }

        .group{
            display: grid;
            grid-template-columns: auto 400px;
            padding:5px 10px;
        }

        .group input{
            height:30px;
            padding:5px 15px;
            outline: none;
            border: 1Px solid #999;
        }

        h1.titre{
            border-radius: 6px;
        }

        .titre{
            color:#fff;
            background-color: #287bff;
            padding: 10px;
        }

        input[type="submit"]{
            width: 60%;
            margin: 0 auto;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include 'menutop.php';?>
    <div class="container">
        <h1 class="titre">Sécurité</h1>
    <?php if($customer): ?>
    <form action="" method="post" id="form" enctype="multipart/form-data">
            <h2 class="titre">Modifier vos informations</h2>
            <p>Modifier vos informations de connexion</p>
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
            
            
            <input type="submit" value="Modifier" name="submit" class="back">

                <?php if(!empty($msg)):?>
                        <?=$msg?>
                <?php endif;?>
            
        </form>
    </div>
    <?php endif; ?>
</body>
<script>
    let msg = document.getElementById('msg');
    let ok = document.getElementById('ok');

    ok.addEventListener('click', function(e){
        e.preventDefault();
        msg.innerHTML = "";
        msg.style.display = "none";
    })
    
</script>
</html>