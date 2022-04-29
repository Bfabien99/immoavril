<?php 
define('IMG_PATHS','\immoavril\assets\images\icon\\');
define('PROPERTY_IMG','\immoavril\uploads\\');
$title = 'proprietes';
$search = '<div class="search">
<label for="search">
    <input type="search" name="search" id="search" placeholder="Search..." autocomplete="off">
    <img src="'.IMG_PATHS.'search.png'.'" alt="search" class="search_icon">
</label>
</div>';
ob_start();
?>
<style>
    .properties{
        position: relative;
        width: 95%;
        margin: 0 auto;
        margin-top: 20px;
        padding: 20px;
        box-shadow:0 7px 25px rgba(0,0,0,0.08);
        border-radius:20px;
        display: grid;
        min-height: 200px;
        max-height: 600px;
        overflow: auto;
        grid-template-rows: 50px 1fr;
        grid-gap: 20px;
        color: var(--black1);
        background-color: var(--white);
    }

    .properties table{
        width: 100%;
        border-collapse: collapse;
    }

    .properties table tr td{
        width: fit-content;
        text-align: center;
    }

    .properties table thead tr td{
        font-weight: 600;
    }

    .properties table tbody tr td .imgBox{
        width: 150px;
        height: 150px;
        overflow: hidden;
        padding: 5px;
        margin: 0 auto;
    }

    .properties table tbody tr td .imgBox img{
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .properties table tbody tr td.action a{
        margin: 0 3px;
        text-decoration: none;
        color: var(--white);
        padding: 5px;
        border-radius: 6px;
    }

    .properties table tbody tr td{
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    .edit{
        background: var(--blue);
    }
    .delete{
        background: red;
    }
</style>
<div class="properties">
        <div class="cardHeader">
            <h2><span><?= (!empty($properties)) ? count($properties):0; ?></span> propriété(s) au total</h2>
            <a href="propriete/add" class="btn">➕ Ajouter une propriété</a>
        </div>
        <table>
            <thead>

                <tr>
                    <td>Image</td>
                    <td>Titre</td>
                    <td>Addresse</td>
                    <td>Superficie</td>
                    <td>Active</td>
                    <td colspan="2">Action</td>
                </tr>

            </thead>

            <tbody>

            <?php if(!empty($properties)):?>
                <?php foreach($properties as $property):?>
                <tr>
                    <td width="60px">
                        <div class="imgBox">
                        <img src="<?= PROPERTY_IMG.$property['image']; ?>" alt="image_maison">
                        </div>
                    </td>
                    <td><?= $property['titre']; ?></td>
                    <td><?= $property['addresse']; ?></td>
                    <td><?= $property['superficie']; ?></td>
                    <td><?php if($property['enable'] = 1) echo "non"; else echo "oui"; ?></td>
                    <td class="action"><a href="/immoavril/admin/propriete/edit/<?= $property['prop_id']; ?>" class="edit">Editer</a><a href="/immoavril/admin/propriete/delete/<?= $property['prop_id']; ?>" class="delete">Supp</a></td>
                </tr>
                <?php endforeach;?>
            <?php endif;?>

            </tbody>
        </table>
</div>
<?php
$content = ob_get_clean();
require 'template.php';
?>