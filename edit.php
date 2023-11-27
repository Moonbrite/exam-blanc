<?php
session_start();
include ("blocks/function.php");
$pdo = dbconnect();
$errors = [];

if (array_key_exists("modifier",$_GET)){
    $query = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $query->execute(["id"=>$_GET['modifier']]);
    $result = $query->fetch();
    var_dump($result);
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
    include "blocks/style.php";
    ?>
    <title>admin</title>
</head>
<body>
<?php
include "blocks/header.php";
?>

<h1>Bonjour <?php
    echo ($_SESSION["user"]);
    ?></h1>
<section class="login-container">
    <div class="">
        <h4 class="text-dark">Ajouter un Joueur</h4>
        <?php

        if($_SERVER["REQUEST_METHOD"]=="POST") {
            var_dump($_POST['date_of_birth']);
            $qury = $pdo->prepare("UPDATE `foot_2_ouf`.`users` SET name = :name , firstname = :firstname , date_of_birth = :date_of_birth , poste = :poste   WHERE  id = :id;");
            $qury ->execute([
                "id"=>$_GET['modifier'],
                "name"=>$_POST['name'],
                "firstname"=>$_POST['lastname'],
                "date_of_birth"=>$_POST['date_of_birth'],
                "poste"=>$_POST['type'],
            ]);
        }
        ?>
        <form action="" method="post">
            <input class="form-control <?php
            if(array_key_exists("lastname",$errors)){
                echo('is-invalid');
            }elseif(!empty($_POST['lastname'])) {
                echo ('is-valid');
            }
            ?>" type="text" name="lastname" placeholder="Nom" required="required" value="<?php
            if(empty($_POST['lastname'])){
                echo($result['firstname']);
            }
            ?>"/>
            <div class='invalid-feedback msg'>
                <?php
                if(array_key_exists("lastname",$errors)){
                    echo($errors["lastname"]);
                }
                ?>
            </div>

            <!---------------------------------------------------------------------------->

            <input class="form-control <?php
            if(array_key_exists("name",$errors)){
                echo('is-invalid');
            }elseif(!empty($_POST['name'])) {
                echo ('is-valid');
            }
            ?>" type="text" name="name" placeholder="Prenom" required="required" value="<?php
            if(empty($_POST['name'])){
                echo($result['name']);
            }
            ?>"/>
            <div class='invalid-feedback msg'>
                <?php
                if(array_key_exists("name",$errors)){
                    echo($errors["name"]);
                }
                ?>
            </div>

            <!---------------------------------------------------------------------------->

            <input class="form-control <?php
            if(array_key_exists("date_of_birth",$errors)){
                echo('is-invalid');
            }elseif(!empty($_POST['date_of_birth'])) {
                echo ('is-valid');
            }
            ?>" type="date" name="date_of_birth" placeholder="Date de Naisance" required="required" value="<?php
            if(empty($_POST['date_of_birth'])){
                echo($result['date_of_birth']);
            }
            ?>"/>
            <div class='invalid-feedback msg'>
                <?php
                if(array_key_exists("date_of_birth",$errors)){
                    echo($errors["date_of_birth"]);
                }
                ?>
            </div>
            <!---------------------------------------------------------------------------->
            <select  name="type" class="form-select">
                <option><?php echo($result["poste"]) ?></option>
                <?php
                $types = ["Gardien de but","Attaquant","Milieux défensifs"];
                foreach($types as $type){
                    if($_SERVER["REQUEST_METHOD"]=='POST' && $_POST["type"] == $type){
                        $actif = 'selected';
                    }
                    echo('<option value="'.$type.'">'.$type.'</option>');
                }

                ?></select>
            <!---------------------------------------------------------------------------->
            <button type="submit">Crée votre compte</button>
        </form>
    </div>
</section>

<?php
include "blocks/js.php";
?>
</body>
</html>

