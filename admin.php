<?php
session_start();
if(!array_key_exists("user",$_SESSION)) {
    header('Location: connection.php');
    exit();
}
include ("blocks/function.php");
$pdo = dbconnect();
$errors = [];

if (array_key_exists("suprimer",$_GET)){
    $query = $pdo->prepare("DELETE  FROM users WHERE id = :id");
    $query->execute(["id"=>$_GET['suprimer']]);
    $result = $query->fetch();
    header("Location:index.php");
    exit();
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
    <title>Edit</title>
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
        $allwoedExtension =["image/jpeg","image/png"];
        if($_SERVER["REQUEST_METHOD"]=="POST") {
            $query = $pdo->query('SELECT * FROM users');
            $resultas = $query->fetchAll();
            if ($_FILES["photos"]["error"] != 0){
                $errors [] ="inconu";
            }
            if (in_array($_FILES["photos"]["type"],$allwoedExtension)){
                if ($_FILES["photos"]["size"]>2097152){
                    $errors [] = "tros grosse";
                }
            }else{
                $errors [] = "Pas bon";
            }
            if (count($resultas) < 23 && count($errors)== 0) {
                $nameAssets = "assets/".uniqid().'-'.$_FILES["photos"]["name"];
                move_uploaded_file($_FILES["photos"]["tmp_name"],$nameAssets);
                $qury = $pdo->prepare("INSERT INTO `foot_2_ouf`.`users` (`name`, `firstname`, `date_of_birth`, `poste`,`image`) VALUES (:name, :firstname, :date_of_birth, :poste, :image)");
                $qury ->execute([
                    "name"=>$_POST['name'],
                    "firstname"=>$_POST['lastname'],
                    "date_of_birth"=>$_POST['date_of_birth'],
                    "poste"=>$_POST['type'],
                    "image"=>$nameAssets,
                ]);
                header('Location: index.php');
                exit();
            }else{
                $errors ["result"] = "La limite de 23 joueur et atteinte";
            }

        }


        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input class="form-control <?php
            if(array_key_exists("lastname",$errors)){
                echo('is-invalid');
            }elseif(!empty($_POST['lastname'])) {
                echo ('is-valid');
            }
            ?>" type="text" name="lastname" placeholder="Nom" required="required" value="<?php
            if(!empty($_POST['lastname'])){
                echo($_POST['lastname']);
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
            if(!empty($_POST['name'])){
                echo($_POST['name']);
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
            if(!empty($_POST['date_of_birth'])){
                echo($_POST['date_of_birth']);
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
            <select name="type" class="form-select mb-3">
                <option></option>
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
            <input type="file" class="form-control" name="photos">

            <!---------------------------------------------------------------------------->
            <button type="submit">Ajouter un Joueur</button>
            <?php
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo('<div>' . $error . '</div>');
                }
            }
            ?>
        </form>
    </div>
</section>

<?php
include "blocks/js.php";
?>
</body>
</html>
