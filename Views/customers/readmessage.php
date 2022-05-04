<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lire le message</title>
</head>
<body>
    <?php include 'menutop.php';?>
    <div class="container">
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
        <?php endif?>

    </div>
</body>
</html>