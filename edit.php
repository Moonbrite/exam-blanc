<?php
session_start();
if(!array_key_exists("user",$_SESSION)) {
    header('Location: connection.php');
    exit();
}
include ("blocks/function.php");
$pdo = dbconnect();
$errors = [];

if(array_key_exists("user",$_SESSION)) {
    if (array_key_exists("modifier",$_GET)){
        $query = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $query->execute(["id"=>$_GET['modifier']]);
        $result = $query->fetch();
    }
}

$allwoedExtension =["image/jpeg","image/png"];
if($_SERVER["REQUEST_METHOD"]=="POST") {
    var_dump($_FILES);
    var_dump($errors);
    if ($_FILES["photos"]["error"] != 0 and $_FILES["photos"]["error"] != 4){
        $errors [] ="inconu";
    }
    if (in_array($_FILES["photos"]["type"],$allwoedExtension)){
        if ($_FILES["photos"]["size"]>2097152){
            $errors [] = "tros grosse";
        }
    }

    if ($_FILES["photos"]["error"] != 4) {
        $erros_uplod = $errors;
        if (!empty($erros_uplod)){
            $errors["image"] = $erros_uplod;
        }
    }

    if (count($errors)== 0) {
        if ($_FILES["image"]["error"] != 4) {
            move_uploaded_file($_FILES["photos"]["tmp_name"],$result["image"]);
        }
        $qury = $pdo->prepare("UPDATE `foot_2_ouf`.`users` SET name = :name , firstname = :firstname , date_of_birth = :date_of_birth , poste = :poste WHERE  id = :id;");
        $qury ->execute([
            "id"=>$_GET['modifier'],
            "name"=>$_POST['name'],
            "firstname"=>$_POST['lastname'],
            "date_of_birth"=>$_POST['date_of_birth'],
            "poste"=>$_POST['type'],
        ]);
        header('Location: index.php');
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
        <h4 class="text-dark">Modifier le Joueur</h4>
        <?php
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input class="form-control <?php
            if(array_key_exists("lastname",$errors)){
                echo('is-invalid');
            }elseif(!empty($_POST['lastname'])) {
                echo ('is-valid');
            }
            ?>" type="text" name="lastname" placeholder="Nom" required="required" value="<?php
            if(empty($_POST['lastname'])){
                echo(htmlspecialchars($result['firstname']));
            }
            elseif(!empty($_POST['lastname'] && $_SERVER["REQUEST_METHOD"]=='POST')){
                echo(htmlspecialchars($_POST['lastname']));
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
                echo(htmlspecialchars($result['name']));
            }
            elseif(!empty($_POST['name'] && $_SERVER["REQUEST_METHOD"]=='POST')){
                echo(htmlspecialchars($_POST['name']));
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
                echo(htmlspecialchars($result['date_of_birth']));
            }
            elseif(!empty($_POST['date_of_birth'] && $_SERVER["REQUEST_METHOD"]=='POST')){
                echo(htmlspecialchars($_POST['date_of_birth']));
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

            <select  name="type" class="form-select mb-3">
                <?php
                $types = ["Gardien","Attaquant","Milieu","Défenseur"];
                foreach($types as $type){
                    $actif = '';
                    if($_SERVER["REQUEST_METHOD"]=='POST' && $_POST["type"] == $type || $result["poste"] == $type){
                        $actif = 'selected';
                    }
                    echo('<option '.$actif.' value="'.$type.'">'.$type.'</option>');
                }
                ?></select>

            <!---------------------------------------------------------------------------->
            <div>

                <?php
                echo ('<img class="img-previsu img-thumbnail mb-3" src="'.htmlspecialchars($result["image"]).'" alt="">');
                ?>
            </div>
            <input type="file" class="form-control mb-3" name="photos">
            <!---------------------------------------------------------------------------->
            <button type="submit">Modifier le Joueur</button>
            <ul>
                <?php
                if(count($errors) != 0){
                    foreach ($errors as $error){
                        echo("<li>".$error."</li>");
                    }
                }
                ?>
            </ul>
        </form>
    </div>
</section>




<?php
include "blocks/js.php";
?>
</body>
</html>

