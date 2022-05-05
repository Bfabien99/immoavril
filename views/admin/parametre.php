<?php $title = 'parametres';
ob_start();
?>
<style>
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
            margin: 0 auto;
            padding-bottom: 10px;
            margin-top: 2em;
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
            width:200px;
            margin: 0 auto;
        }

        .titre{
            color:#fff;
            background-color: #287bff;
            padding: 10px;
            text-align: center;
        }

        input[type="submit"]{
            width: 60%;
            margin: 0 auto;
            cursor: pointer;
            padding:5px 10px;
            width: 60%;
            outline: none;
            border: none;
            color: var(--white);
            background-color: var(--blue);
            border-radius:3px;
        }
</style>
<div class="params">
    <?php if(!empty($admin)): ?>
    <h1 class="titre">Paramètres</h1>
    <form action="" method="post" id="contactForm">
        <h2 class="titre">Modifier vos informations de connexion</h2>
        <div class="group">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" value="<?= $admin['ad_pseudo']?>">
        </div>
        <div class="group">
            <label for="password">Nouveau mot de passe</label>
            <input type="password" name="npassword" id="npassword">
        </div>
        <div class="group">
            <label for="password">Confirmer mot de passe</label>
            <input type="password" name="cpassword" id="cpassword">
        </div>
        <input type="submit" value="modifier" name="submit">
    </form>
    <?php if(!empty($msg)): ?>
        <?= $msg;?>
    <?php endif;?>
    <?php endif;?>
</div>
<?php
$content = ob_get_clean();
require 'template.php';
?>