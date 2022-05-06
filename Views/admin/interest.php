<?php $title = 'interest';
define('IMG_PATHS','\immoavril\assets\images\icon\\');
ob_start();
?>
<style>
    .container h2{
            margin: 0 auto;
            text-align: center;
            border-radius: 6px;
            color:#fff;
            background-color: #287bff;
            padding: 10px;
            width: fit-content;
        }
        
        .container table{
            border-collapse: collapse;
            margin:2em auto;
            border:1px solid #ccc;
            width:90%;
        }

        .container table tr td{
            text-align: center;
            padding: 5px;
        }

        .container table tr td.action{
            min-width:100px;
            text-align: center;
        }

        .container table tr td.action a{
            margin: 0 5px;
        }

        .delete{
            color: #fff;
            padding: 5px 10px;
            border-radius: 6px;
            background-color: red;
            text-decoration: none;
        }

        .back{
        color: #fff;
        background-color: #287bff;
        padding: 5px 10px;
        border-radius: 6px;
        text-decoration: none;
        }

        .container table tbody tr:nth-child(odd){
            background-color: #ccc;
        }

        .container table tbody tr:nth-child(even){
            background-color: #fff;
        }
        
        .envelope{
            filter: invert(1);
        }
</style>
    <h2>Interressé</h2>
            <table>
            <thead>
                <tr>
                    <td>lu</td>
                    <td>envoyé par</td>
                    <td>Email</td>
                    <td>Contact</td>
                    <td>Message</td>
                    <td>Reçu le</td>
                    <td colspan="2">Action</td>
                </tr>
                <tbody>
                <?php if(!empty($interests)):?>
                <?php foreach($interests as $interest):?>
                    <tr>
                    <?php if($interest['lu'] == 0):?>
                        <td><img src="<?= IMG_PATHS.'envelope.png'?>" alt="interest_icon" class="envelope"></td>
                        <?php else:?>
                            <td><img src="<?= IMG_PATHS.'open_envelope.png'?>" alt="interest_icon" class="envelope"></td>
                        <?php endif;?>
                            <td><?= $interest['nom'] ?></td>
                            <td><?= $interest['email'] ?></td>
                            <td><?= $interest['contact'] ?></td>
                            <td><?= substr($interest['message'],0,15) . '...' ?></td>
                            <td><?= $interest['date'] ?></td>
                            <td><a href="interest/<?= $interest['id'] ?>" class="back">voir</a><a href="" class="delete" id="<?= $interest['id'] ?>">supp</a></td>
                    </tr>
                <?php endforeach?>
                <?php endif?>
                </tbody>
            </thead>
        </table>

        <script>
        let supprimer = document.querySelectorAll('.delete');

        supprimer.forEach(function(element){
            element.addEventListener('click',function(e){
                e.preventDefault();
                if(confirm('Voulez-vous vraiment supprimer ce message?')){
                    window.location.href = '/immoavril/admin/interests/delete/'+element.id;
                }
            });
        });
    </script>
<?php
$content = ob_get_clean();
require 'template.php';
?>