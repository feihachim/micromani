<?php
require('bddmicromani.php');
$reqjeux = $db->prepare("SELECT id,nom FROM jeux_video");
$reqjeux->execute();
$nbjeux = $reqjeux->rowCount();
if ($nbjeux == 0) {
    $liste_jeux = "Pas de jeux";
} else {
    $liste_jeux = $reqjeux->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        a {
            margin: 5px;
        }
    </style>
    <title>Micromani</title>
</head>

<body>
    <a href="./nouveaujeu.php">Nouveau jeu</a>
    <h2>Liste des jeux</h2>
    <ul>
        <?php if ($nbjeux == 0) : ?>
            <li><?= $liste_jeux; ?></li>
        <?php else : ?>
            <?php foreach ($liste_jeux as $jeu) : ?>
                <li>
                    <a href="<?= "./detailjeu.php?id=" . $jeu['id']; ?>"><?= $jeu['nom']; ?></a>
                    <a href="<?= "./editionjeu.php?id=" . $jeu['id']; ?>">Editer fiche jeu</a>
                    <a href="<?= "./suppressionjeu.php?id=" . $jeu['id']; ?>">Supprimer jeu</a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</body>

</html>