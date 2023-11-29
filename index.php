<?php
session_start();
include "blocks/function.php";
$pdo = dbconnect();
if (array_key_exists("postes",$_GET)) {
    $query = $pdo->prepare('SELECT * FROM users WHERE poste = :poste');
    $query->execute(["poste" => $_GET['postes']]);
    $resultas = $query->fetchAll();
}else{
    $query = $pdo->query('SELECT * FROM users ORDER BY poste');
    $resultas = $query->fetchAll();
}
if (array_key_exists("ages", $_GET)) {
    // Assurez-vous que la valeur passée dans $_GET['ages'] est soit "ASC" soit "DESC"
    $direction = ($_GET['ages'] == 'DESC') ? 'DESC' : 'ASC';

    $query = $pdo->prepare('SELECT * FROM users ORDER BY date_of_birth ' . $direction);
    $query->execute();
    $resultas = $query->fetchAll();
}else{
    $query = $pdo->query('SELECT * FROM users ORDER BY poste');
    $resultas = $query->fetchAll();
}

if(array_key_exists("user",$_SESSION)) {
    if (array_key_exists("suprimer",$_GET)){

        $queryFilePath = $pdo->prepare("SELECT image FROM users WHERE id = :id");
        $queryFilePath->execute(["id" => $_GET['suprimer']]);
        $filePath = $queryFilePath->fetch();
        $file =$filePath["image"];
        unlink($file);

        $query = $pdo->prepare("DELETE  FROM users WHERE id = :id");
        $query->execute(["id"=>$_GET['suprimer']]);

        header("Location:index.php");
        exit();

    }if (array_key_exists("suprimertout",$_GET)){

        $queryAllFilePaths = $pdo->query("SELECT image FROM users");
        $allFilePaths = $queryAllFilePaths->fetchAll(PDO::FETCH_COLUMN);

        $query = $pdo->query("DELETE FROM users");
        $query->execute();

        foreach ($allFilePaths as $filePath) {
            if (!empty($filePath) && file_exists($filePath)) {
                unlink($filePath);
            }
        }
        header("Location:index.php");
        exit();
    }
}


?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
     include ("blocks/style.php");
    ?>
    <title>Exam Blanc</title>
</head>
<body>
<?php
include "blocks/header.php";
?>
<h3 class="text-center"><?php
    if (array_key_exists("postes",$_GET)) {
        echo ($_GET['postes']);
    }else{
        echo ("<h2 class='text-center'>L'équipe de ouf !!!</h2>");
    }
?></h3>
<div class="container row m-auto mb-5">
    <?php
    foreach ($resultas as $resulta) {
            $nomPernom = $resulta["name"] . " " . $resulta["firstname"];
            echo('<div class="col-3 mt-5"><div class="card">
        <img src="' . htmlspecialchars($resulta["image"]) . '" class="card-img-top" alt="...">
        <div class="card-body">
        <h5 class="card-title">' . htmlspecialchars($nomPernom) . '</h5>
        <p class="card-text">Date de Naissance : ' . htmlspecialchars($resulta["date_of_birth"]) . '</p>
        <p class="card-text ' . htmlspecialchars($resulta["poste"]) . ' ">Poste : ' . htmlspecialchars($resulta["poste"]) . '</p>');
            if (array_key_exists("user", $_SESSION)) {
                echo('<a class="btn btn-danger" href="?suprimer=' . htmlspecialchars($resulta["id"]) . '">Suprimer le joueur</a>
                    <a class="btn btn-success mt-2" href="edit.php?modifier=' . htmlspecialchars($resulta["id"]) . '">Modifier le joueur</a>');
            }
            echo('</div>
</div></div>');
    }
    ?>
</div>

    <?php
    if (array_key_exists("user",$_SESSION)) {
        if (count($resultas) > 0 ) {

            echo ('<div class="text-center"><h3>Tout suprimer</h3><a class="btn btn-danger text-center mb-3" href="?suprimertout=all">Suprimer tout les joueurs</a>');
        }else{
            echo ('<h2>Pas de Joueur</h2>');
        }
    }echo ("</div>")
    ?>

<?php
include "blocks/js.php";
?>

</body>
</html>
