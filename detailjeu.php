<?php
require('bddmicromani.php');
if (isset($_GET['id']) and $_GET['id'] > 0) :
    $reqjeu = $db->prepare("SELECT * FROM jeux_video WHERE id=:id");
    $reqjeu->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $reqjeu->execute();
    $jeu = $reqjeu->fetch(PDO::FETCH_ASSOC);

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        </style>
        <title>Détail du jeu</title>
    </head>

    <body>
        <h2>Détail du produit</h2>
        <table>
            <tr>
                <td>N° jeu</td>
                <td><?= $jeu['id']; ?></td>
            </tr>
            <tr>
                <td>Nom</td>
                <td><?= $jeu['nom']; ?></td>
            </tr>
            <tr>
                <td>Prix</td>
                <td><?= $jeu['prix'] . " EUR"; ?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><?= $jeu['description']; ?></td>
            </tr>
            <tr>
                <td>Quantité</td>
                <td><?= $jeu['quantite'] . " exemplaire(s)"; ?></td>
            </tr>
        </table>
        <a href="index.php">Retour à l'index</a>
    </body>

    </html>
<?php endif;
