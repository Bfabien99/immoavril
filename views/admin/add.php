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
        grid-template-columns: 1fr 1fr;
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
    <div class="left">
        <div class="group">
            <label for="titre">Titre de la propriété</label>
            <input type="text" name="titre" id="titre">
        </div>
        <div class="group">
            <label for="titre">Nombre de pièce</label>
            <input type="number" name="nombre_piece" id="np" min="0">
        </div>
        <div class="group">
            <label for="titre">Nombre de chambre</label>
            <input type="number" name="nombre_chambre" id="nc" min="0">
        </div>
        <div class="group">
            <label for="titre">Nombre de douche</label>
            <input type="number" name="nombre_douche" id="nd" min="0">
        </div>
        <div class="group">
            <label for="titre">Nombre de WC</label>
            <input type="number" name="nombre_wc" id="nwc" min="0">
        </div>
        <div class="group">
            <label for="addresse">Addresse</label>
            <input type="text" name="addresse" id="autocomplete">
        </div>
        <div class="group">
            <label for="superficie">Superficie</label>
            <input type="number" name="superficie" id="superficie" min="0">
        </div>
        <div class="group">
            <label for="titre">Type</label>
            <select name="type" id="">
                <option value="Vendre">Vendre</option>
                <option value="Location">Location</option>
            </select>
        </div>

    </div>

    <div class="right">
        <div class="group">
            <label for="prix">Prix de la propriété</label>
            <input type="number" name="prix" id="prix" min="0">
        </div>
        <div class="group">
            <label for="description">Description de la propriété</label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
        </div>
        <div class="group">
            <label for="nom proprio">Nom du propriétaire</label>
            <input type="text" name="nom_proprio" id="nom_proprio">
        </div>
        <div class="group">
            <label for="tel proprio">Contact du propriétaire</label>
            <input type="tel" name="tel_proprio" id="tel_proprio">
        </div>
        <div class="group">
            <label for="image">Image de la propriété</label>
            <input type="file" name="image" id="image">
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