<?php
require('bddmicromani.php');

if (isset($_POST['formajout']))
{

    $erreur = "";
    $nom = filter_input(INPUT_POST, 'newnom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prix = filter_input(INPUT_POST, 'newprix', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $description = filter_input(INPUT_POST, 'newdescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $quantite = filter_input(INPUT_POST, 'newquantite', FILTER_SANITIZE_NUMBER_INT);
    if ($nom == null)
    {
        $erreur .= "Le nom du jeu doit être défini<br>";
    }
    else if ($nom == false)
    {
        $erreur .= "Le nom du jeu n'est pas valide<br>";
    }
    if ($prix == null)
    {
        $erreur .= "Le prix du jeu doit être défini<br>";
    }
    else if ($prix == false)
    {
        $erreur .= "Le prix du jeu n'est pas valide<br>";
    }
    if ($description == null)
    {
        $erreur .= "La description du jeu doit être définie<br>";
    }
    else if ($description == false)
    {
        $erreur .= "La description du jeu n'est pas valide<br>";
    }
    if ($quantite == null)
    {
        $erreur .= "La quantité de jeux doit être définie<br>";
    }
    else if ($quantite == false)
    {
        $erreur .= "La quantité de jeux n'est pas valide<br>";
    }

    if ($erreur == "")
    {

        $insertjeu = $db->prepare("INSERT INTO jeux_video (nom,prix,description,quantite) VALUES(:nom,:prix,:description,:quantite)");
        $insertjeu->bindParam(':nom', $nom, PDO::PARAM_STR);
        $insertjeu->bindParam(':prix', $prix, PDO::PARAM_STR);
        $insertjeu->bindParam(':description', $description, PDO::PARAM_STR);
        $insertjeu->bindParam(':quantite', $quantite, PDO::PARAM_INT);
        $result = $insertjeu->execute();
        if ($result)
        {
            echo "Jeu ajouté";
            header('Location: index.php');
        }
        else
        {
            echo "Erreur lors de l'ajout du jeu";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        i {
            color: red;
        }
    </style>
    <title>Nouveau jeu</title>
</head>

<body>
    <h2>Nouveau jeu</h2>
    <form method="POST" action="">
        <div>
            <label for="newnom">Nom :
                <input type="text" name="newnom" id="newnom" placeholder="Nom du jeu">
            </label>
        </div>
        <div>
            <label for="newprix">Prix:
                <input type="text" name="newprix" id="newprix" placeholder="Prix"> EUR
            </label>
        </div>
        <div>
            <label for="newdescription">Description :
                <textarea name="newdescription" id="newdescription" cols="30" rows="10" placeholder="Description du jeu"></textarea>
            </label>
        </div>
        <div>
            <label for="newquantite">Quantité :
                <input type="number" name="newquantite" id="newquantite" placeholder="Nombre d'exemplaires"> exemplaire(s)
            </label>
        </div>
        <input type="submit" name="formajout" value="Ajouter le jeu !">
        <a href="index.php">Retour</a>
    </form>
    <i>
        <?= isset($erreur) ? $erreur : ''; ?>
    </i>
</body>

</html>