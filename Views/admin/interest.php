<?php $title = 'interest';
ob_start();
?>
    <?php if(!empty($interests)):?>
            <div class="messageBox" style="display:flex">
            <?php foreach($interests as $interest):?>
                
                    <img src="" alt="interest_icon">
                    <div class="sender_info">
                        <h3><?= $interest['nom'] ?></h3>
                        <h4><?= $interest['email'] ?></h4>
                        <h4><?= $interest['contact'] ?></h4>
                        <h4><?= $interest['message'] ?></h4>
                        <h4><?= $interest['date'] ?></h4>
                        <a href="interest/<?= $interest['id'] ?>">voir</a>
                    </div>
                
            <?php endforeach?>
            </div>
        <?php endif?>
<?php
$content = ob_get_clean();
require 'template.php';
?>