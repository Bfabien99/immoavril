<?php
define('IMG_PATHS','\immoavril\assets\images\icon\\');
define('PROPERTY_IMG','\immoavril\uploads\\');
$title = 'home';
ob_start();
?>
<style>
    
</style>
<!-- cards -->
<div class="cardBox">

    <div class="card">

        <div>
            <div class="numbers"><?= (!empty($properties)) ? count($properties):0; ?></div>
            <div class="cardName">Propriétés</div>
        </div>

        <div class="iconBox">
            <img src="<?= IMG_PATHS.'city.png'; ?>" alt="">
        </div>

    </div>

    <div class="card">

        <div>
            <div class="numbers"><?= (!empty($customers)) ? count($customers):0; ?></div>
            <div class="cardName">Inscrits</div>
        </div>

        <div class="iconBox">
            <img src="<?= IMG_PATHS.'align.png'; ?>" alt="">
        </div>

    </div>

    <div class="card">

        <div>
            <div class="numbers"><?= (!empty($messages)) ? count($messages):0; ?></div>
            <div class="cardName">Messages</div>
        </div>

        <div class="iconBox">
            <img src="<?= IMG_PATHS.'letter.png'; ?>" alt="">
        </div>

    </div>

    <div class="card">

        <div>
            <div class="numbers"><?= (!empty($notactive_properties)) ? count($notactive_properties):0; ?></div>
            <div class="cardName">A confirmer</div>
        </div>

        <div class="iconBox">
            <img src="<?= IMG_PATHS.'inspection.png'; ?>" alt="">
        </div>

    </div>

</div>

<!-- data list  -->
<div class="details">

    <div class="recentProperty">

        <div class="cardHeader">
            <h2>Recent Property</h2>
            <a href="admin/propriete" class="btn">View All</a>
        </div>

        <table>
            <thead>

                <tr>
                    <td>Titre</td>
                    <td>prix (Fcfa)</td>
                    <td>Proprio</td>
                    <td>Contact</td>
                    <td>Vue</td>
                </tr>

            </thead>

            <tbody>
            <?php if(!empty($recents)):?>
                <?php foreach($recents as $property):?>
                <tr>
                    <td><?= $property['titre']?></td>
                    <td><?= number_format($property['prix'], 2, '.', ',')?></td>
                    <td><?= $property['nom_proprio']?></td>
                    <td><?= $property['contact_proprio']?></td>
                    <td><?= $property['vue']?></td>
                </tr>
                <?php endforeach;?>
            <?php endif;?>

            </tbody>
        </table>
    </div>

    <!-- Derniers inscrits -->
    <div class="recentCustomers">

        <div class="cardHeader">
            <h2>Recent Customers</h2>
        </div>

        <table>

        <?php if(!empty($customers)):?>
            <?php foreach($customers as $customer):?>
                <tr>
                    <td width="60px">
                        <div class="imgBox">
                        <img src="<?= PROPERTY_IMG.$customer['cust_photo'] ?>" alt="user" class="userImg">
                        </div>
                    </td>
                    <td><h4><?= $customer['cust_nom']." ".$customer['cust_prenoms'];?><br> <span><?= $customer['cust_created']?></span></h4></td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>

        </table>

    </div>

</div>
<?php
$content = ob_get_clean();
require 'template.php';
?>