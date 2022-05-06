<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'link.php';?>
    <title>Inscription</title>
    <style>
    form{
        margin:10px auto;
        background-color: var(--white);
        width: 80%;
        max-width: 500px;
        display: grid;
        grid-template-columns: 1fr;
        background-color: var(--white);
        padding-bottom: 10px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.08);
        border-radius: 6px;
        color: var(--black1);
    }

    form h2{
    color: var(--white);
    background: var(--blue);
    padding: 10px;
    text-align: center;
    }

    form p{
        text-align: center;
        padding: 10px;
    }

    form input[type="submit"]{
        width: 70%;
        max-width:400px;
        padding:10px 5px;
        margin: 0 auto;
        outline: none;
        border: none;
        border-radius: 5px;
        color: var(--white);
        background: var(--blue);
        cursor: pointer;
    }

    form .group{
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        width: 100%;
        max-width:500px;
        gap: 5px;
        padding: 20px;
    }

    form .group label{
        font-weight: 600;
    }

    form .group input{
        outline: none;
        border: 1px solid rgba(0, 0, 0, 0.3);
        height:30px;
        padding:5px 20px;
    }

    form .text{
        display: flex;
        justify-content: space-between;
        padding: 10px;
    }

    form .text a{
        text-decoration: none;
        color: var(--black2);
    }

    form .text a:hover{
        text-decoration: underline;
        color: var(--blue);
    }

    #msg{
        width: fit-content;
        margin: 0 auto;
        text-align:center;
        font-weight: 600;
        height: fit-content;
    }

    .error{
        color: red;
    }

    .success{
        color: #287bff;
    }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post" id="form" enctype="multipart/form-data">
            <h2>Signup</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, incidunt? Eius animi cupiditate quasi temporibus, aspernatur atque tenetur iste nam?</p>
            <div class="group">
                <label for="">Nom*</label>
                <input type="text" name="nom" id="nom" required>
            </div>
            <div class="group">
                <label for="">Prenoms*</label>
                <input type="text" name="prenom" id="prenoms" required>
            </div>
            <div class="group">
                <label for="">Pseudo*</label>
                <input type="text" name="pseudo" id="pseudo" required>
            </div>
            <div class="group">
                <label for="">Contact*</label>
                <input type="tel" name="tel" id="tel" required>
            </div>
            
            <div class="group">
                <label for="">Email*</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="group">
                <label for="">Mot de passe*</label>
                <input type="password" name="password" id="password" required>
            </div>
            
            <input type="submit" value="Signup">

            <div id="msg"></div>

            <div class="text">
            <p><a href="/immoavril/"> Continuez sans compte</a></p>
            <p>Déja un compte ? <a href="/immoavril/login"> Connectez-vous</a> </p>
            </div>
            
        </form>
    </div>
</body>
<script>
    $(document).ready(function()
    {

        $('#form').on('submit',function(e){
            e.preventDefault();
            var nom = $('#nom').val();
            var prenoms = $('#prenoms').val();
            var pseudo = $('#pseudo').val();
            var contact = $('#tel').val();
            var email = $('#email').val();
            var password = $('#password').val();

            $.ajax({
                url: 'ajax_validation/ajax_signup.php',
                type: 'POST',
                data: {nom: nom, prenoms: prenoms, pseudo: pseudo, email: email, contact: contact, password: password},
                success: function(data)
                {
                    if(data == "OK"){
                        $('#msg').html("<p class='success'>Enregistrement effectué... Connectez-vous!</p>")
                        $('#form')[0].reset();
                    }
                    else{
                        $('#msg').html(data);
                        setTimeout(function() {
                            $('#msg').html("");
                        },5000)
                    }
                }
            });

        });

    });
</script>
</html>