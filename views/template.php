<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'link.php';?>
    <title><?=$title;?></title>
    <style>
        section{
            position: relative;
            background: url('/immoavril/pexels-pixabay-280229.jpg') no-repeat center/cover;
        }
        section .title{
            position: absolute;
            top: 40%;
            font-size: 2.3em;
            margin: 0 auto;
            width: 90%;
            text-transform: uppercase;
            color: #fff;
            text-align: center;
            text-shadow: 0px 0px 10px #000;
        }
    </style>
</head>
<body>
    <header>
        <div class="left">
            <div class="logo">X-mobilier</div>
            <ul class="navigation">
                <li><a href="/immoavril/">Accueil</a></li>
                <li><a href="a_louer">Location</a></li>
                <li><a href="en_vente">En vente</a></li>
                <li><a href="/immoavril/#about">About Us</a></li>
                <li><a href="/immoavril/#contact">Contact</a></li>
            </ul>
        </div>
        
        <div class="right">
            <a href="/immoavril/signup" class="signup">S'inscrire</a>
            <a href="/immoavril/login" class="signin">Connexion</a>
        </div>
        
    </header>
    <?php if($title !== "propriete"):?>
    <section>
        <h1 class="title">X-mobilier vous propose une sélection des plus beaux appartements et maisons à vendre</h1>
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
            <h3>Pour toutes vos préoccupations, contacter nous...</h3>
            <h3>Tel: +212 658 987 654</h3>
            <h3>Email: xmobilier@nan.ci</h3>
            <br>
            <h3>Ou remplissez ce formulaire et nous vous contacterons</h3>
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
    <footer style="padding: 10px;display:flex;justify-content:center; color:#999"><h3>&copy; 2022 - Tous droits réservé, X-MOBILIER - PROJETAVRIL_NAN522 - BFABIEN99</h3></footer>
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
<script>
        $(document).ready(function()
    {

        $('#contactForm').on('submit',function(e){
            e.preventDefault();
            var nom = $('#nom').val();
            var tel = $('#tel').val();
            var email = $('#email').val();
            var message = $('#message').val();

            $.ajax({
                url: '/immoavril/ajax_validation/send_message.php',
                type: 'POST',
                data: {nom: nom, tel: tel, email: email, message: message},
                success: function(data)
                {
                    if(data == "OK"){
                        $('#msg').html("<p class='success'>Messages envoyé</p>")
                        $('#contactForm')[0].reset();
                    }
                    else{
                        $('#msg').html(data);
                    }
                    
                }
            });

        });

    });
    </script>
</html>