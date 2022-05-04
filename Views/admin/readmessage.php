<?php $title = 'lire le message';
define('PROPERTY_IMG','\immoavril\uploads\\');
ob_start();
?>
    <style>
        .sender_info{
            margin: auto;
            width: 90%;
            max-width:600px;
            margin-top:3em;
            display: flex;
            flex-direction: column;
            gap: 1em;
            box-shadow: 0 7px 25px rgba(0,0,0,0.08);
            padding-bottom: 10px;
        }

        .sender_info h1{
            text-align: center;
            color: #fff;
            padding: 10px;
            background-color: var(--blue);
        }

        .sender_info h3{
            display: grid;
            grid-template-columns: 100px 250px;
            margin:0 auto;
        }

        .sender_info h3 .libelé{
            color: var(--black2);
        }

        .back{
            margin:0 auto;
            color: var(--white);
            background-color: var(--black1);
            text-decoration: none;
            padding:5px 10px;
            border-radius: 6px;
        }
    </style>
        <?php if(!empty($getMessage)):?>
                    <div class="sender_info">
                        <h1>Information</h1>
                        <h3><span class="libelé">Nom: </span><?= $getMessage['nom'] ?></h3>
                        <h3><span class="libelé">Email: </span><?= $getMessage['email'] ?></h3>
                        <h3><span class="libelé">Contact: </span><?= $getMessage['contact'] ?></h3>
                        <h3><span class="libelé">Message: </span><?= $getMessage['message'] ?></h3>
                        <h3><span class="libelé">Recu le: </span><?= $getMessage['date'] ?></h3>
                        <a href="/immoavril/admin/messages" class="back">Retour</a>
                    </div>
        <?php endif?>
<?php
$content = ob_get_clean();
require 'template.php';
?>