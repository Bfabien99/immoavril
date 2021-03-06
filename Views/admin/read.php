<?php $title = 'lire le message';
define('PROPERTY_IMG','\immoavril\uploads\\');
ob_start();
?>
<style>
        .messageBox{
            margin: 2em;
        }
        .messageBox .sender_info{
            display: flex;
            flex-direction: column;
            gap: 1em;
            margin: 0 auto;
            width: 90%;
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 10px 5px rgba(0, 0, 0, 0.08);
        }

        .sender_info img{
            width:100%;
            height:300px;
            object-fit: cover;
        }

        .separator{
            text-align: center;
            text-transform: uppercase;
            color: #287bff;
            text-decoration: underline;
        }

        .libelé{
            color: #999;
            text-decoration: underline;
            margin:0 5px;
            font-size: 16px;
        }
    </style>
       <?php if(!empty($message)):?>
            <div class="messageBox">
                    <div class="sender_info">
                        <img src="<?= PROPERTY_IMG. $message['image']?>" alt="" width="100px" height="100px">
                        <p class="separator">Informations propriété</p>
                        <h4><span class="libelé">Titre : </span><?= $message['titre'] ?></h4>
                        <h4><span class="libelé">Localisation : </span><?= $message['addresse'] ?></h4>
                        <h4><span class="libelé">Type : </span><?= $message['type'] ?></h4>
                        <h4><span class="libelé">Prix : </span><?= $message['prix'] ?></h4>
                        <h4><span class="libelé">Proprio Nom: </span><?= $message['nom_proprio'] ?></h4>
                        <h4><span class="libelé">Proprio Email : </span><?= $message['proprio_email'] ?></h4>
                        <h4><span class="libelé">Proprio Contact : </span><?= $message['contact_proprio'] ?></h4>
                        <p class="separator">
                            Informations message
                        </p>
                        <h3><span class="libelé">Envoyé par : </span><?= $message['nom'] ?></h3>
                        <h4><span class="libelé">Email : </span><?= $message['email'] ?></h4>
                        <h4><span class="libelé">Contact : </span><?= $message['contact'] ?></h4>
                        <h4><span class="libelé">Message : </span><?= nl2br($message['message']) ?></h4>
                        <h4><span class="libelé">Reçu le : </span><?= $message['date'] ?></h4>
                    </div>
            </div>
        <?php endif?>
<?php
$content = ob_get_clean();
require 'template.php';
?>