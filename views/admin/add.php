<?php $title = 'Ajouter une nouvelle propriété';
ob_start();
?>
<style>
    .contentForm{
        position: relative;
        display: flex;
        flex-direction: column;
        width: 90%;
        margin:0 auto;
        padding: 20px;
        gap: 20px;
        margin-top:20px;
        align-items: center;
        background-color: var(--white);
        box-shadow:0 7px 25px rgba(0,0,0,0.08);
        border-radius:20px;
    }

    .contentForm .cardHeader{
        display: flex;
        width: 100%;
    }

    .contentForm form{
        display:grid;
        grid-template-columns: 1fr;
        width: 100%;
    }

    .contentForm form .right,.contentForm form .left{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 1.3em;
        align-items:center;
        padding:15px;
    }

    .contentForm form .right{
        border-left: 1px dotted black;
    }

    .contentForm form .group{
        display: flex;
        flex-direction: column;
        width: 100%;
        gap: 0.5em;
    }

    .contentForm form .group label{
        font-weight: 600;
        color: var(--blue);
        text-shadow: 0px 0px 0px #000;
        font-size:1.2em;
    }

    .contentForm form .group input{
        padding: 10px;
        height:35px;
        outline: none;
    }
</style>
<div class="contentForm">
    <div class="cardHeader">
        <h2>Ajouter une nouvelle propriété</h2>
        <a href="/immoavril/admin/propriete" class="btn">Retour</a>
    </div>

    <form action="" id="myform" method="post" enctype="multipart/form-data" autocomplete="off">
        <?php if(!empty($msg)):?>
            <?= $msg;?>
        <?php endif;?>
        <div class="left">
            <div class="group">
                <label for="titre">Titre de la propriété (*)</label>
                <input required type="text" name="titre" id="titre" value="<?= !empty($_POST['titre']) ? $_POST['titre']:""?>">
            </div>
            <div class="group">
                <label for="titre">Nombre de pièce (*)</label>
                <input required type="number" name="nombre_piece" id="np" min="0" value="<?= !empty($_POST['nombre_piece']) ? $_POST['nombre_piece']:""?>">
            </div>
            <div class="group">
                <label for="titre">Nombre de chambre (*)</label>
                <input required type="number" name="nombre_chambre" id="nc" min="0" value="<?= !empty($_POST['nombre_chambre']) ? $_POST['nombre_chambre']:""?>">
            </div>
            <div class="group">
                <label for="titre">Nombre de douche (*)</label>
                <input required type="number" name="nombre_douche" id="nd" min="0" value="<?= !empty($_POST['nombre_douche']) ? $_POST['nombre_douche']:""?>">
            </div>
            <div class="group">
                <label for="titre">Nombre de WC (*)</label>
                <input required type="number" name="nombre_wc" id="nwc" min="0" value="<?= !empty($_POST['nombre_wc']) ? $_POST['nombre_wc']:""?>">
            </div>
            <div class="group">
                <label for="addresse">Addresse (*)</label>
                <input required type="text" name="addresse" id="autocomplete" value="<?= !empty($_POST['addresse']) ? $_POST['addresse']:""?>">
            </div>
            <div class="group">
                <label for="superficie">Superficie (*)</label>
                <input required type="number" name="superficie" id="superficie" min="0" value="<?= !empty($_POST['superficie']) ? $_POST['superficie']:""?>">
            </div>
            <div class="group">
                <label for="titre">Type (*)</label>
                <select name="type" id="">
                    <option value="">--</option>
                    <option value="Vendre">Vendre</option>
                    <option value="Location">Location</option>
                </select>
            </div>

        </div>

        <div class="right">
            <div class="group">
                <label for="prix">Prix de la propriété (*)</label>
                <input required type="number" name="prix" id="prix" min="0" value="<?= !empty($_POST['prix']) ? $_POST['prix']:""?>">
            </div>
            <div class="group">
                <label for="description">Description de la propriété (*)</label>
                <textarea required name="description" id="description" cols="30" rows="10"><?= !empty($_POST['description']) ? $_POST['description']:""?></textarea>
            </div>
            <div class="group">
                <label for="nom proprio">Nom du propriétaire (*)</label>
                <input required type="text" name="nom_proprio" id="nom_proprio" value="<?= !empty($_POST['nom_proprio']) ? $_POST['nom_proprio']:""?>">
            </div>
            <div class="group">
                <label for="tel proprio">Contact du propriétaire (*)</label>
                <input required type="tel" name="tel_proprio" id="tel_proprio" value="<?= !empty($_POST['tel_proprio']) ? $_POST['tel_proprio']:""?>">
            </div>
            <div class="group">
                <label for="email proprio">Email du propriétaire (*)</label>
                <input type="email" name="email_proprio" id="tel_proprio" value="<?= !empty($_POST['email_proprio']) ? $_POST['email_proprio']:""?>">
            </div>
            <div class="group">
                <label for="image">Image de la propriété (*)</label>
                <input required type="file" name="image" id="image">
            </div>

            <input type="submit" value="Enregistrer" name="submit">
        </div>
    </form>
</div>
<script>
    let autocomplete;
    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('autocomplete'), 
            {
             types: ['establishment'],
             componentRestrictions: {country: ['CI']},
             fields: ['place_id','address_components', 'geometry', 'icon', 'name']
            });

        let lg = new google.maps.GeocoderRequest();
        lg.location = autocomplete.getPlace().geometry.location;
        console.log(lg.location);
    }
</script>
<?php
$content = ob_get_clean();
require 'template.php';
?>