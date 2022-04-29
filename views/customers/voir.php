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
    </style>

<?php if(!empty($property)):?>
    <div class="propertyBlock">
    <img src="<?= PROPERTY_IMG. $property['image']?>" alt="">
    </div>
    <div class="userBlock">
        <img src="<?= IMG_PATH.'userA.jpg'?>" alt="">
        <div class="userInfo">
            <h2 class="nom">Brou fabien</h2>
            <h3 class="tel">010000000</h3>
            <h4 class="email">email@gmail.ci</h4>
            <span>Abobo</span>
        </div>
    </div>

    <div class="propertyInfo">

        
            <div class="detail">
                <h3>Detail</h3>
                <div>
                    <h4>Chambre: <span><?= $property['nb_chambre']; ?></span> </h4>
                    <h4>Douche: <span><?= $property['nb_douche']; ?></span> </h4>
                    <h4>Superficie: <span><?= $property['superficie']; ?></span> </h4>
                    <h4>Type: <span><?= $property['type']; ?></span> </h4>
                    <h4>Localisation: <span><?= $property['addresse']; ?>Abobo pk18</span> </h4>
                    <h4>vues: <span><?= $property['vue']; ?></span> </h4>
                </div>
            </div>

            <div class="description">
                <h3>Description</h3>
                <p><?= $property['Description'];?></p>
            </div>

            <div id="map">

            </div>

        <form action="" method="post" id="contactForm">
            <h2>Contacter l' annonceur</h2>
            <div class="group">
                <label for="">Nom et prénoms *</label>
                <input type="text" name="nom" id="nom" required>
            </div>

            <div class="group">
                <label for="">Contact *</label>
                <input type="tel" name="tel" id="tel" required>
            </div>

            <div class="group">
                <label for="">Email</label>
                <input type="email" name="email" id="email">
            </div>

            <div class="group">
                <label for="">Message</label>
                <textarea name="message" id="message"></textarea>
            </div>

            <input type="submit" value="Envoyer">
            <div id="msg"></div>
        </form>
        <a href="/immoavril" class="back">Retour</a>
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
echo $_SESSION['xmobilier_lat'];
?>
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiZmFiaWVuYnJvdTk5IiwiYSI6ImNsMmthZDM5aTBlYzYza2wxYmUwNjQzeDMifQ.WBt2pWQTIbQpj1fZMi3IWQ';

navigator.geolocation.getCurrentPosition(successLocation,errorLocation,{ enableHighAccuracy: true });


function successLocation(position){
    setupMap([position.coords.longitude, position.coords.latitude]);
}

function errorLocation(){
    setupMap([<?php echo $_SESSION['xmobilier_lat'];?>,<?php echo $_SESSION['xmobilier_lng'];?>])
}

function setupMap(center){
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [<?php echo $_SESSION['xmobilier_lng'];?>, <?php echo $_SESSION['xmobilier_lat'];?>],
        zoom:11
      });
    
      const marker = new mapboxgl.Marker()
            .setLngLat([<?php echo $_SESSION['xmobilier_lng'];?>, <?php echo $_SESSION['xmobilier_lat'];?>])
            .setPopup(new mapboxgl.Popup().setHTML("<h4><?php echo $property['prix']?> fcfa</h4><p><?php echo urldecode($location)?></p>"))
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
<?php endif;?>
<?php
$content = ob_get_clean();
require 'template.php';
?>