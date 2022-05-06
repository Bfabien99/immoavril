<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propriétés</title>
    <style>
        .add{
            width:200px;
            text-align: center;
            margin: 10px auto;
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
    </style>
</head>
<body>
    <?php include 'menutop.php';?>
    <div class="container">
        <a href="/immoavril/customer/compte/propriete/add" class="back add">Ajouter une propriéte</a>
    <table>
            <thead>

                <tr>
                    <td>Image</td>
                    <td>Titre</td>
                    <td>Addresse</td>
                    <td>Superficie (m2)</td>
                    <td>Active</td>
                    <td colspan="2">Action</td>
                </tr>

            </thead>

            <tbody>

            <?php if(!empty($properties)):?>
                <?php foreach($properties as $property):?>
                <tr>
                    <td width="100px">
                        <div class="imgBox">
                        <img src="<?= PROPERTY_IMG.$property['image']; ?>" alt="image_maison" width="100%">
                        </div>
                    </td>
                    <td><?= $property['titre']; ?></td>
                    <td><?= $property['addresse']; ?></td>
                    <td><?= $property['superficie']; ?></td>
                    <td><?= ($property['enable'] == 1) ? "oui":"non" ; ?></td>
                    <td class="action"><a href="/immoavril/customer/compte/propriete/edit/<?= $property['prop_id']; ?>" class="back">Editer</a><a href="" class="delete" id="<?= $property['prop_id']; ?>">Supp</a></td>
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
                if(confirm('Voulez-vous vraiment supprimer cette propriété ?')){
                    window.location.href = '/immoavril/customer/compte/propriete/delete/'+element.id;
                }
            });
        });
    </script>
</body>
</html>