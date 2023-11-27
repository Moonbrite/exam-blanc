<?php
session_start();
include "blocks/function.php";
$pdo = dbconnect();
$query = $pdo->query('SELECT * FROM users');
$resultas = $query->fetchAll();
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
var_dump($_SESSION);
?>
<div class="container row ">
    <?php
    foreach ($resultas as $resulta){
        echo ('<div class="col-3 m-auto mt-5"><div class="card">
    <img src="'.$resulta["image"].'" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">'.$resulta["name"].$resulta["firstname"].'</h5>
        <p class="card-text">Date de Naisance : '.$resulta["date_of_birth"].'</p>
        <p class="card-text">Poste : '.$resulta["poste"].'</p>
    </div>
</div></div>');
    }
    ?>
</div>



<?php
include "blocks/js.php";
?>
</body>
</html>
