<?php
require('bddmicromani.php');

if (isset($_POST['formedition']))
{

    $erreur = "";
    $nom = filter_input(INPUT_POST, 'editnom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prix = filter_input(INPUT_POST, 'editprix', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $description = filter_input(INPUT_POST, 'editdescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $quantite = filter_input(INPUT_POST, 'editquantite', FILTER_SANITIZE_NUMBER_INT);
    $id = $_GET['id'];
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
        $editjeu = $db->prepare("UPDATE jeux_video SET nom=?, prix=?, description=?, quantite=? WHERE id=?");
        $resultat = $editjeu->execute(array($nom, floatval($prix), $description, intval($quantite), $id));
        if ($resultat)
        {
            echo "Jeu modifié";
            header('Location: index.php');
        }
        else
        {
            echo "Erreur lors de la modification de la fiche du jeu !";
        }
    }
}

if (isset($_GET['id']) and $_GET['id'] > 0)
{
    $reqjeu = $db->prepare("SELECT * FROM jeux_video WHERE id=:id");
    $reqjeu->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $reqjeu->execute();
    $jeu = $reqjeu->fetch(PDO::FETCH_ASSOC);
}
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
    <title>Editer jeu</title>
</head>

<body>
    <h2>Edition jeu</h2>
    <form method="POST" action="">
        <div class="form-control">
            <label for="editnom">Nom :
                <input type="text" name="editnom" id="editnom" placeholder="Nom du jeu" value="<?= isset($jeu) ? $jeu['nom'] : ''; ?>">
            </label>
        </div>
        <div>
            <label for="editprix">Prix:
                <input type="text" name="editprix" id="editprix" placeholder="Prix" value="<?= isset($jeu) ? $jeu['prix'] : ''; ?>"> EUR
            </label>
        </div>
        <div>
            <label for="editdescription">Description :
                <textarea name="editdescription" id="editdescription" cols="30" rows="10" placeholder="Description du jeu"><?= isset($jeu) ? $jeu['description'] : ''; ?></textarea>
            </label>
        </div>
        <div>
            <label for="editquantite">Quantité :
                <input type="number" name="editquantite" id="editquantite" placeholder="Nombre d'exemplaires" value="<?= isset($jeu) ? $jeu['quantite'] : ''; ?>"> exemplaire(s)
            </label>
        </div>
        <input type="submit" name="formedition" value="Editer le jeu !">
        <a href="index.php">Retour</a>
    </form>
</body>

</html>