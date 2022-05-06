<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
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
            width:100%;
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
</head>
<body>
    <?php include 'menutop.php';?>
    <div class="container">
        <h2>Boîte de réception</h2>
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
                <?php if(!empty($messages)):?>
                <?php foreach($messages as $message):?>
                    <tr>
                    <?php if($message['lu'] == 0):?>
                        <td><img src="<?= IMG_PATH.'envelope.png'?>" alt="message_icon" class="envelope"></td>
                        <?php else:?>
                            <td><img src="<?= IMG_PATH.'open_envelope.png'?>" alt="message_icon" class="envelope"></td>
                        <?php endif;?>
                            <td><?= $message['nom'] ?></td>
                            <td><?= $message['email'] ?></td>
                            <td><?= $message['contact'] ?></td>
                            <td><?= substr($message['message'],0,15) . '...' ?></td>
                            <td><?= $message['date'] ?></td>
                            <td><a href="messages/<?= $message['id'] ?>" class="back">voir</a><a href="message/delete/<?= $message['id'] ?>" class="delete">supp</a></td>
                    </tr>
                <?php endforeach?>
                <?php endif?>
                </tbody>
            </thead>
        </table>

    </div>
</body>
</html>