<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propriétés</title>
</head>
<body>
    <?php include 'menutop.php';?>
    <div class="container">
        <a href="/immoavril/customer/compte/propriete/add" class="add">Ajouter une propriéte</a>
    <table>
            <thead>

                <tr>
                    <td>Image</td>
                    <td>Titre</td>
                    <td>Addresse</td>
                    <td>Superficie</td>
                    <td>Active</td>
                    <td colspan="2">Action</td>
                </tr>

            </thead>

            <tbody>

            <?php if(!empty($properties)):?>
                <?php foreach($properties as $property):?>
                <tr>
                    <td width="60px">
                        <div class="imgBox">
                        <img src="<?= PROPERTY_IMG.$property['image']; ?>" alt="image_maison" width="100%">
                        </div>
                    </td>
                    <td><?= $property['titre']; ?></td>
                    <td><?= $property['addresse']; ?></td>
                    <td><?= $property['superficie']; ?></td>
                    <td><?= ($property['enable'] == 1) ? "oui":"non" ; ?></td>
                    <td class="action"><a href="/immoavril/customer/compte/propriete/edit/<?= $property['prop_id']; ?>" class="edit">Editer</a><a href="/immoavril/customer/compte/propriete/delete/<?= $property['prop_id']; ?>" class="delete">Supp</a></td>
                </tr>
                <?php endforeach;?>
            <?php endif;?>

            </tbody>
        </table>
    </div>
</body>
</html>