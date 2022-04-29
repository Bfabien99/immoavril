<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'link.php';?>
    <title><?=$title;?></title>
</head>
<body>
    <header>
        <div class="left">
            <div class="logo">LOGO</div>
            <ul class="navigation">
                <li><a href="/immoavril/">Accueil</a></li>
                <li><a href="a_louer">Location</a></li>
                <li><a href="en_vente">En vente</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
        
        <div class="right">
            <a href="/immoavril/signup" class="signup">S'inscrire</a>
            <a href="/immoavril/login" class="signin">Connexion</a>
        </div>
        
    </header>
    <?php if($title !== "propriete"):?>
    <section>
        <form action="">
            <input type="search" name="search" id="locationSearch" placeholder="Recherche par prix, localisation...">
            <input type="submit" value="🔍">
        </form>
    </section>
    <?php endif;?>
    <div class="container">
        <?=$content;?>
        
        <?php if($title !== "propriete"):?>
        <div class="content">
        <div id="about">
            <h1>About</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores, accusantium facere nihil assumenda tempore suscipit earum velit nisi reiciendis ab unde aut vel doloremque officia eos ipsam ex omnis sequi quam. Eveniet, consequuntur inventore? Corporis dignissimos odio sed cupiditate similique necessitatibus rem, animi dolor voluptatum, tempore quibusdam aperiam cumque? Consequatur!</p>
        </div>
        <div id="contact">
            <h1>Contact</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, rem.</p>
            <form action="" method="post" id="contactForm">
            <h2>Nous Contacter</h2>
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
                <label for="">Message*</label>
                <textarea name="message" id="message"></textarea required>
            </div>

            <input type="submit" value="Envoyer">
            <div id="msg"></div>
        </form>
        </div>
        </div>
        <?php endif;?>
    
    </div>
</body>
<script>
    let autocomplete;
    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('locationSearch'), 
            {
             types: ['establishment'],
             componentRestrictions: {country: ['CI']},
             fields: ['place_id','address_components', 'geometry', 'icon', 'name']
            });

    }
</script>
</html>