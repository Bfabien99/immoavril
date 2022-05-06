<?php 
define('IMG_PATHS','\immoavril\assets\images\icon\\');
define('PROPERTY_IMG','\immoavril\uploads\\');
$title = 'utilisateurs';
$search = '<form class="search" method="get" action="">
<label for="search">
    <input type="search" name="search" id="search" placeholder="Search..." autocomplete="off">
    <img src="'.IMG_PATHS.'search.png'.'" alt="search" class="search_icon">
</label>
</form>';
ob_start();
?>
<style>
    .users{
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

    .users table{
        width: 100%;
        border-collapse: collapse;
    }

    .users table tr td{
        width: fit-content;
        text-align: center;
    }

    .users table thead tr td{
        font-weight: 600;
    }

    .users table tbody tr td.action a{
        margin: 0 3px;
        text-decoration: none;
        color: var(--white);
        padding: 5px;
        border-radius: 6px;
    }

    .users table tbody tr td{
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    .edit{
        background: var(--blue);
    }
    .delete{
        background: red;
    }

    .imgBox{
        width: 60px;
        overflow: hidden;
        height: 60px;
        border-radius: 50%;
        margin: 0 auto;
    }

    .userImg{
        width: 100%;
        height: 100%;
        object-fit:cover;
    }
</style>

    <div class="users">
        <div class="cardHeader">
            <h2><span><?= !empty($customers) ? count($customers):"0"?></span> inscrit(s) au total</h2>
        </div>
        <table>
            <thead>

                <tr>
                    <td>Image</td>
                    <td>Nom</td>
                    <td>Prénoms</td>
                    <td>Contact</td>
                    <td>Inscrit le</td>
                    <td colspan="2">Action</td>
                </tr>

            </thead>

            <tbody>

            <?php if(!empty($customers)):?>
                <?php foreach($customers as $customer):?>
                <tr>
                    <td width="60px">
                        <div class="imgBox">
                        <img src="<?= PROPERTY_IMG.$customer['cust_photo'] ?>" alt="user" class="userImg">
                        </div>
                    </td>
                    <td><?= ucfirst($customer['cust_nom']);?></td>
                    <td><?= ucwords($customer['cust_prenoms']);?></td>
                    <td><?= $customer['cust_contact'];?></td>
                    <td><?= date('d-m-Y à H:i',strtotime($customer['cust_created']));?></td>
                    <td class="action"><a href="/immoavril/admin/utilisateur/delete/<?= $customer['cust_id'];?>" class="delete">Supp</a></td>
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