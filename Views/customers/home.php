<?php
define('IMG_PATH','\immoavril\assets\images\icon\\');
define('PROPERTY_IMG','\immoavril\uploads\\');
$title = "Accueil";
ob_start();
?>  

    <div class="propertiesBlock">

    <?php if(!empty($properties)):?>
        <?php foreach($properties as $property):?>
        <div class="cardBox">
            <div class="cardImg">
            <img src="<?= PROPERTY_IMG. $property['image']?>" alt="image_maison" class="icon">
            </div>
            <div class="cardContent">
                <div class="type_price">
                    <span><?= $property['type']; ?></span>
                    <h2><?= $property['prix']; ?></h2>
                </div>
                <div class="title_view">
                    <h3><?= $property['titre']; ?></h3>
                    <h4><?= $property['vue']; ?> vues</h4>
                </div>
                <div class="info">
                    <span><img src="<?= IMG_PATH.'bedroom.png'?>" alt="chambre" class="icon"><?= $property['nb_chambre']; ?> chambre</span>
                    <span><img src="<?= IMG_PATH.'bathtub.png'?>" alt="douche" class="icon"><?= $property['nb_douche']; ?> douche</span>
                    <span><img src="<?= IMG_PATH.'area.png'?>" alt="superficie" class="icon"><?= $property['superficie']; ?> m<sup>2</sup> </span>
                </div>
                <div class="localisation">
                    <span><img src="<?= IMG_PATH.'pointer.png'?>" alt="localistion" class="icon"><?= $property['addresse']; ?></span>
                    <a href="customer/propriete_consulter/<?= $property['prop_id']; ?>" class="voir">Voir</a>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    <?php endif;?>

    </div>

    <a href="" id="loadmore">Charger plus</a>
<?php
$content = ob_get_clean();
require 'template.php';
?>