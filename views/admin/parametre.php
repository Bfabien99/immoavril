<?php $title = 'parametres';
ob_start();
?>
<div class="params">
    <?php if(!empty($admin)): ?>
    <h1>Paramètres</h1>
    <form action="" method="post" id="contactForm">
        <h3>Modifier vos informations de connexion</h3>
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