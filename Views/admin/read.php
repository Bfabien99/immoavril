<?php $title = 'lire le message';
define('PROPERTY_IMG','\immoavril\uploads\\');
ob_start();
?>
        <?php if(!empty($message)):?>
            <div class="messageBox">
                    <img src="" alt="message_icon">
                    <div class="sender_info">
                        <h3><?= $message['nom'] ?></h3>
                        <h4><?= $message['email'] ?></h4>
                        <h4><?= $message['contact'] ?></h4>
                        <h4><?= $message['message'] ?></h4>
                        <img src="<?= PROPERTY_IMG. $message['image']?>" alt="" width="100px" height="100px">
                        <h4><?= $message['titre'] ?></h4>
                        <h4><?= $message['addresse'] ?></h4>
                        <h4><?= $message['type'] ?></h4>
                        <h4><?= $message['prix'] ?></h4>
                        <h4><?= $message['date'] ?></h4>
                    </div>
            </div>

            <a href="/immoavril/admin/interest" class="back">Retour</a>
        <?php endif?>
<?php
$content = ob_get_clean();
require 'template.php';
?>