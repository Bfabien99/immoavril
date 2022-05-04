<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'link2.php';?>
    <title>Modifier</title>
</head>
<body>
    <?php include 'menutop.php';?>
    <div class="container">
        <?php if(!empty($property)):?>
        <div class="contentForm">
            <div class="cardHeader">
                <h2>Modifier la propriété</h2>
                <a href="/immoavril/admin/propriete" class="btn">Retour</a>
            </div>

            <form action="" id="myform" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="left">
                    <div class="group">
                        <label for="titre">Titre de la propriété</label>
                        <input required type="text" name="titre" id="titre" value="<?= $property['titre'];?>">
                    </div>
                    <div class="group">
                        <label for="titre">Nombre de pièce</label>
                        <input required type="number" name="nombre_piece" id="np" min="0" value="<?= $property['nb_piece'];?>">
                    </div>
                    <div class="group">
                        <label for="titre">Nombre de chambre</label>
                        <input required type="number" name="nombre_chambre" id="nc" min="0" value="<?= $property['nb_chambre'];?>">
                    </div>
                    <div class="group">
                        <label for="titre">Nombre de douche</label>
                        <input required type="number" name="nombre_douche" id="nd" min="0" value="<?= $property['nb_douche'];?>">
                    </div>
                    <div class="group">
                        <label for="titre">Nombre de WC</label>
                        <input required type="number" name="nombre_wc" id="nwc" min="0" value="<?= $property['nb_wc'];?>">
                    </div>
                    <div class="group">
                        <label for="addresse">Addresse</label>
                        <input required type="text" name="addresse" id="autocomplete" value="<?= $property['addresse'];?>">
                    </div>
                    <div class="group">
                        <label for="superficie">Superficie</label>
                        <input required type="number" name="superficie" id="superficie" min="0" value="<?= $property['superficie'];?>">
                    </div>
                    <div class="group">
                        <label for="titre">Type</label>
                        <select name="type" id="">
                            <?php if($property['etat'] == 'Vendre'):?>
                                <option value="Vendre">Vendre</option>
                                <option value="Location">Location</option>
                            <?php else:?>
                                <option value="Vendre">Vendre</option>
                                <option value="Location">Location</option>
                            <?php endif;?>
                        </select>
                    </div>

                </div>

                <div class="right">
                    <div class="group">
                        <label for="prix">Prix de la propriété</label>
                        <input required type="number" name="prix" id="prix" min="0" value="<?= $property['prix'];?>">
                    </div>
                    <div class="group">
                        <label for="description">Description de la propriété</label>
                        <textarea required name="description" id="description" cols="30" rows="10"><?= $property['Description'];?></textarea>
                    </div>
                    <div class="group">
                        <label for="image">Image de la propriété</label>
                        <input type="file" name="image" id="image">
                    </div>

                    <?php if(!empty($msg)):?>
                        <?= $msg;?>
                    <?php endif;?>

                    <input type="submit" value="Enregistrer" name="submit">
                </div>
            </form>
        </div>
        <?php endif;?>
    </div>
</body>
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
</html>