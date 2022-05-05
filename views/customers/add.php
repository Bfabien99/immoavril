<?php include 'session.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'link2.php';?>
    <title>ajouter</title>
    <style>
        .container{
            align-items: center;
        }

        .cardHeader{
            display: flex;
            width: 100%;
            justify-content: space-between;
            align-items: center;
        }

        .cardHeader a{
            color: #fff;
            background-color: #222;
            text-align: center;
            padding: 5px 10px;
            border-radius: 6px;
        }

        form{
            display: flex;
            flex-direction: column;
            gap:1.2em;
            box-shadow: 0px 10px 5px rgba(0, 0, 0, 0.08);
            padding:10px;
        }

        form{
            width: 100%;
            max-width:700px;
            text-align: center;
            background-color:white;
            border-radius: 5px;
            overflow: hidden;
        }

        .group{
            display: grid;
            grid-template-columns: auto 400px;
            grid-gap: 10px;
            padding:5px 10px;
        }

        .group label {
            text-align:left;
            font-weight: 600;
        }

        .group input{
            height:30px;
            padding:5px 15px;
            outline: none;
            border: 1Px solid #999;
        }

        .titre{
            color:#fff;
            background-color: #287bff;
            padding: 10px;
        }

        input[type="submit"]{
            width: 60%;
            margin: 0 auto;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include 'menutop.php';?>
<div class="container">
    <div class="contentForm">
        <div class="cardHeader">
            <h2 class="titre">Ajouter une nouvelle propriété</h2>
            <a href="/immoavril/customer/compte/propriete" class="btn">Retour</a>
        </div>

        <form action="" id="myform" method="post" enctype="multipart/form-data" autocomplete="off">
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
                    <select name="type" id="" required>
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
                    <label for="image">Image de la propriété (*) (taille <= 4mo)</label>
                    <input required type="file" name="image" id="image">
                </div>

                <input type="submit" value="Enregistrer" name="submit" class="back">
            </div>

            <?php if(!empty($msg)):?>
                        <?=$msg?>
                <?php endif;?>
        </form>
    </div>

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
<script>
    let msg = document.getElementById('msg');
    let ok = document.getElementById('ok');

    ok.addEventListener('click', function(e){
        e.preventDefault();
        msg.innerHTML = "";
        msg.style.display = "none";
    })
    
</script>
</html>