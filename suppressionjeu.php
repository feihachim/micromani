<?php
require('bddmicromani.php');

if (isset($_POST['suppressionjeu'])) {
    $deletejeu = $db->prepare("DELETE FROM jeux_video WHERE id=?");
    $deletejeu->bindValue(1, $_GET['id'], PDO::PARAM_INT);
    $resultat = $deletejeu->execute();
    if ($resultat) {
        echo "Jeu supprimé";
        header('Location: index.php');
    } else {
        echo "Erreur lors de la suppression du jeu";
    }
}

if (isset($_POST['retour_index'])) {
    header('Location: index.php');
}

if (isset($_GET['id']) and $_GET['id'] > 0) :
    $reqjeu = $db->prepare("SELECT id,nom FROM jeux_video WHERE id=:id");
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
        <title>Supprimer jeu</title>
    </head>

    <body>
        <h2>Suppression jeu</h2>
        <form method="POST" action="">
            <div>
                <label for="">Etes-vous sûr?
                    <input type="submit" name="suppressionjeu" value="Oui">
                    <input type="button" name="retour_index" value="Non">
                </label>
            </div>
        </form>
    </body>

    </html>
<?php endif;
