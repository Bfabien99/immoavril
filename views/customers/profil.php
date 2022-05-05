<?php include 'session.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <style>
        .container{
            align-items: center;
        }

        form,.info{
            display: flex;
            flex-direction: column;
            gap:1.2em;
            box-shadow: 0px 10px 5px rgba(0, 0, 0, 0.08);
        }

        .info{
            align-items: center;
            background-color:white;
            border-radius: 5px;
            width: 100%;
            max-width:600px;
        }

        .info div{
            display: grid;
            grid-template-columns: auto 200px;
            text-align: center;
            margin: 0 auto;
            width: 300px;
            text-transform:capitalize ;
            padding: 5px;
        }

        .info img{
            width: 150px;
            height: 150px;
            object-fit:cover;
            border-radius:50%;
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
        <h1 class="titre">Profil</h1>
    <?php if($customer): ?>
        <div class="info">
        <h2 class="titre">Informations de l'utilisateur</h2>
        <img src="<?= !empty($customer['cust_photo']) ? PROPERTY_IMG.$customer['cust_photo']:""?>" alt="" width="90px" height="90px">
            <div><span class="libelé">Nom: </span> <?=$customer['cust_nom']?></div>
            <div><span class="libelé">Prénoms: </span> <?=$customer['cust_prenoms']?></div>
            <div><span class="libelé">Email: </span> <?=$customer['cust_email']?></div>
            <div><span class="libelé">pseudo: </span> <?=$customer['cust_pseudo']?></div>
            <div><span class="libelé">Contact: </span> <?=$customer['cust_contact']?></div>
        </div>
        <form action="" method="post" id="form" enctype="multipart/form-data">
            <h2 class="titre">Modifier vos informations</h2>
            <p>Modifier vos informations personnelles</p>
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
                <label for="">Modifier la photo de profile</label>
                <input type="file" name="image" id="photo">
            </div>
            
            
            <input type="submit" value="Modifier" name="submit" class="back">


                <?php if(!empty($msg)):?>
                        <?=$msg?>
                <?php endif;?>

        </form>
    <?php endif; ?>
    </div>
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