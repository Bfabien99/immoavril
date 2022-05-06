<?php 
define('IMG_PATHS','\immoavril\assets\images\icon\\');
$title = 'message';
$search = '<form class="search" method="get" action="">
<label for="search">
    <input type="search" name="search" id="search" placeholder="Search..." autocomplete="off">
    <img src="'.IMG_PATHS.'search.png'.'" alt="search" class="search_icon">
</label>
</form>';
ob_start();
?>
<style>
    .users{
        position: relative;
        width: 95%;
        margin: 0 auto;
        margin-top: 20px;
        padding: 20px;
        box-shadow:0 7px 25px rgba(0,0,0,0.08);
        border-radius:20px;
        display: grid;
        min-height: 250px;
        max-height: 600px;
        overflow: auto;
        grid-template-rows: 50px 1fr;
        grid-gap: 20px;
        color: var(--black1);
        background-color: var(--white);
    }

    .users table{
        width: 100%;
        border-collapse: collapse;
    }

    .users table tr td{
        width: fit-content;
        text-align: center;
    }

    .users table thead tr td{
        font-weight: 600;
    }

    .users table tbody tr td.action a{
        margin: 0 3px;
        text-decoration: none;
        color: var(--white);
        padding: 5px;
        border-radius: 6px;
    }

    .users table tbody tr td{
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    .edit{
        background: var(--blue);
    }
    .delete{
        background: red;
    }

    .envelope{
        filter: invert(1);
    }
</style>

    <div class="users">
        <div class="cardHeader">
            <h2><span><?= !empty($messages) ? count($messages):"0"?></span> message(s) au total</h2>
        </div>
        <table>
            <thead>

                <tr>
                    <td></td>
                    <td>Nom</td>
                    <td>Contact</td>
                    <td>Message</td>
                    <td>Recu le</td>
                    <td colspan="2">Action</td>
                    
                </tr>

            </thead>

            <tbody>

            <?php if(!empty($messages)):?>
                <?php foreach($messages as $message):?>
                <tr>
                <?php if($message['lu'] == 0):?>
                        <td><img src="<?= IMG_PATHS.'envelope.png'?>" alt="message_envelope" class="envelope"></td>
                        <?php else:?>
                            <td><img src="<?= IMG_PATHS.'open_envelope.png'?>" alt="message_envelope" class="envelope"></td>
                        <?php endif;?>
                    <td><?= ucfirst($message['nom']);?></td>
                    <td><?=$message['contact'];?></td>
                    <td><?= substr($message['message'],0,15) . '...';?></td>
                    <td><?= $message['date'];?></td>
                    <td class="action"><a href="/immoavril/admin/messages/<?= $message['id']; ?>" class="edit">voir</a><a href="" class="delete" id="<?= $message['id']; ?>">Supp</a></td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
    </div>

    <script>
        let supprimer = document.querySelectorAll('.delete');

        supprimer.forEach(function(element){
            element.addEventListener('click',function(e){
                e.preventDefault();
                if(confirm('Voulez-vous vraiment supprimer ce message?')){
                    window.location.href = '/immoavril/admin/message/delete/'+element.id;
                }
            });
        });
    </script>
<?php
$content = ob_get_clean();
require 'template.php';
?>