<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'link.php';?>
    <title>Connexion</title>
    <style>
    form{
        margin:auto;
        background-color: var(--white);
        width: 80%;
        max-width: 500px;
        display: grid;
        grid-template-columns: 1fr;
        background-color: var(--white);
        padding-bottom: 10px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.08);
        border-radius: 6px;
    }

    form h2{
    color: var(--white);
    background: var(--blue);
    padding: 10px;
    text-align: center;
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
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post" id="form">
            <h2>Mot de passe oublié</h2>
            <div id="msg"></div>
            <div class="group">
                <label for="">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo">
            </div>
            <div class="group">
                <label for="">Email</label>
                <input type="email" name="email" id="email">
            </div>

            <input type="submit" value="Verifiez">

            <div class="text">
            <p>Déja un compte ? <a href="/immoavril/login"> Connectez-vous</a> </p>
            <p>Pas de compte ? <a href="/immoavril/signup"> Créer un compte</a> </p>
            </div>
            
        </form>
    </div>
</body>
<script>
    $(document).ready(function()
    {

        $('#form').on('submit',function(e){
            e.preventDefault();
            var pseudo = $('#pseudo').val();
            var email = $('#email').val();

            $.ajax({
                url: 'ajax_validation/ajax_forget.php',
                type: 'POST',
                data: {pseudo: pseudo, email: email},
                success: function(data)
                {
                    if(data){
                        alert(data);
                    }
                }
            });

        });

    });
</script>
</html>