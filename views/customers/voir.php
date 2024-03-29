<?php
define('IMG_PATH','\immoavril\assets\images\icon\\');
define('PROPERTY_IMG','\immoavril\uploads\\');
$title = "propriete";
ob_start();
?>  
    <style>
        #map{
            width: 100%;
            height: 400px;
            border: 1px solid black;
        }

        .marker{
            width: 27px;
            height: 35px;
            background: url('/immoavril/assets/images/icon/marker.png') no-repeat center/cover;
        }

        #msg{
            width: fit-content;
            display: flex;
            justify-content: center;
            padding: 5px;
            margin: 0 auto;
            color: #999;
        }

        .detail h3{
            text-decoration: underline;
        }

        .description h3{
            text-decoration: underline;
        }
    </style>

<?php if(!empty($property)):?>
    <div class="propertyBlock">
    <img src="<?= PROPERTY_IMG. $property['image']?>" alt="">
    </div>
    <div class="userBlock">
        <img src="<?= !(empty($customerPic)) ? PROPERTY_IMG.$customerPic['cust_photo']:'/immoavril/pexels-pixabay-280229.jpg'; ?>" alt="" width="90px" height="90px">
        <div class="userInfo">
            <h3 class="nom">Propriétaire : <?= $property['nom_proprio']?></h3>
            <h3 class="tel">Contact : <?= $property['contact_proprio']?></h3>
            <h3 class="email">Email : <?= !empty($property['email_proprio'])? $property['email_proprio']:""?></h3>
        </div>
    </div>

    <div class="propertyInfo">

        
            <div class="detail">
                <h3>Detail</h3>
                <div>
                    <h4>Pièce: <span><?= $property['nb_piece']; ?></span> </h4>
                    <h4>Prix: <span><?= $property['prix']; ?> Fcfa</span> </h4>
                    <h4>Superficie: <span><?= $property['superficie']; ?> m2</span> </h4>
                    <h4>Type: <span><?= $property['type']; ?></span> </h4>
                    <h4>Localisation: <span><?= $property['addresse']; ?></span> </h4>
                    <h4>vues: <span><?= $property['vue']; ?></span> </h4>
                </div>
            </div>

            <div class="description">
                <h3>Description</h3>
                <img src="<?= PROPERTY_IMG. $property['image']?>" alt="" width="300px" height="300px" style="margin:0 auto;">
                <h4 style="margin:0 auto;"><span><?= mb_strtoupper($property['titre']); ?></span> </h4>
                <p><?= nl2br(ucfirst($property['Description']));?></p>
            </div>

            <div class="description">
                <h3>Localisation</h3>
                <div id="map"></div>
            </div>

        <?php if($property['email_proprio'] !== $customer['cust_email']):?>
        <form action="" method="post" id="messageForm">
            <h2>Contacter l' annonceur</h2>
            <div class="group">
                <label for="">Nom et prénoms *</label>
                <input type="text" name="nom" id="nom" value="<?= $customer['cust_nom']." ".$customer['cust_prenoms'];?>" required>
            </div>

            <div class="group">
                <label for="">Contact *</label>
                <input type="tel" name="tel" id="tel" value="<?= $customer['cust_contact'];?>" required>
            </div>

            <div class="group">
                <label for="">Email</label>
                <input type="email" name="email" id="email" value="<?= $customer['cust_email'];?>">
            </div>

            <div class="group">
                <label for="">Message</label>
                <textarea name="message" id="message"></textarea>
            </div>

            <input type="submit" value="Envoyer">
            <div id="msg"></div>
        </form>
        <?php endif;?>
        <a href="/immoavril/customer" class="back">Retour</a>
    </div>
    
<?php
$location = $property['addresse'];
$imgpath = PROPERTY_IMG. $property['image'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($location)."&key=AIzaSyAgwEcOb6n37QfBvC5JuTGKxV9QQUBxgs8",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$datas = curl_exec($curl);

if ($datas === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) 
{
    return null;
} 
$datas = json_decode($datas, true);

if (!in_array('ZERO_RESULTS', $datas)) {
    $_SESSION['xmobilier_lat'] = $datas["results"][0]["geometry"]["location"]["lat"];
    $_SESSION['xmobilier_lng'] = $datas["results"][0]["geometry"]["location"]["lng"];
}
else{
    $_SESSION['xmobilier_lat'] = 5.4101225;
    $_SESSION['xmobilier_lng'] = -4.007531699999999;
}


curl_close($curl);
?>
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiZmFiaWVuYnJvdTk5IiwiYSI6ImNsMmthZDM5aTBlYzYza2wxYmUwNjQzeDMifQ.WBt2pWQTIbQpj1fZMi3IWQ';
    
// Retrouver la position exacte du visiteur
navigator.geolocation.getCurrentPosition(successLocation,errorLocation,{ enableHighAccuracy: true });

// Si la position est retrouvée
function successLocation(position){
    setupMap([position.coords.longitude, position.coords.latitude]);
}

// Sinon on génère une position par défaut
function errorLocation(){
    setupMap([<?php echo $_SESSION['xmobilier_lat'];?>,<?php echo $_SESSION['xmobilier_lng'];?>])
}

// on place les markers sur la carte
function setupMap(center){
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [<?php echo $_SESSION['xmobilier_lng'];?>, <?php echo $_SESSION['xmobilier_lat'];?>],
        zoom:11
      });
    
      const marker = new mapboxgl.Marker()
            .setLngLat([<?php echo $_SESSION['xmobilier_lng'];?>, <?php echo $_SESSION['xmobilier_lat'];?>])
            .setPopup(new mapboxgl.Popup().setHTML("<img src='<?php echo '/immoavril/uploads/'.$property['image']?>' width='100%' height='100px' style='object-fit:cover;'><h2><?php echo $property['titre']?></h2><h4><?php echo $property['prix']?> fcfa</h4><p><?php echo $property['addresse']?></p>"))
            .addTo(map); // add the marker to the map
        
            marker.togglePopup(); // toggle popup open or closed
            const el = document.createElement('div');
            el.className = 'marker';
    const Usermarker = new mapboxgl.Marker(el)
            .setLngLat(center)
            .setPopup(new mapboxgl.Popup().setHTML("vous etes ici"))
            .addTo(map); // add the marker to the map
        
            Usermarker.togglePopup(); // toggle popup open or closed
            map.addControl(new mapboxgl.NavigationControl());
}
</script>
<script>
        $(document).ready(function()
    {

        $('#messageForm').on('submit',function(e){
            e.preventDefault();
            var nom = $('#nom').val();
            var tel = $('#tel').val();
            var email = $('#email').val();
            var message = $('#message').val();

            $.ajax({
                url: '/immoavril/ajax_validation/send_interest.php',
                type: 'POST',
                data: {nom: nom, tel: tel, email: email, message: message},
                success: function(data)
                {
                    if(data == "OK"){
                        $('#msg').html("<p class='success'>Messages envoyé</p>")
                        $('#messageForm')[0].reset();
                    }
                    else{
                        $('#msg').html(data);
                    }
                    
                }
            });

        });

    });
    </script>
<?php endif;?>
<?php
$content = ob_get_clean();
require 'template.php';
?>
