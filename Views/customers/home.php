<?php
define('IMG_PATH','\immoavril\assets\images\icon\\');
define('PROPERTY_IMG','\immoavril\uploads\\');
ob_start();
?>  
    <?php if(!empty($properties)):?>
    <div class="propertiesBlock">
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
    </div>

    <?php if($title == "Accueil"):?>
        <a href="" id="loadmore">Charger plus</a>
    <?php endif;?>
    
    <?php else:?>
        <h3>Désolé, nous n'avons trouvé aucun résultat</h3>
    <?php endif;?>
<?php
$content = ob_get_clean();
require 'template.php';
?>