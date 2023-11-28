<?php
session_start();
$error =null;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if($_POST["user"] == "ddechamps" && $_POST ["password"] == "ddechamps") {
        $_SESSION["user"] = "dechamps";
        header("Location: index.php");
    }else{
        $error = "Le user ou le mot de passe ne corsponde pas";
    }
}

if($_SERVER["REQUEST_METHOD"]=="POST") {
    if(array_key_exists("user",$_SESSION)) {
        if ($_SESSION["user"]) {
            header('Location: index.php');
            exit();
        }
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
    <title>Document</title>
</head>
<body class="">
<header class="">
    <?php
    include 'blocks/header.php';
    ?>
</header>
<section class="login-container">
    <div>
        <header>
            <h2 class="text-dark">Identification</h2>
        </header>
        <form class="" action="" method="post">
            <input class="form-control " type="text" name="user" placeholder="User" required="required" value="<?php
            if(!empty($_POST['user'])){
                echo($_POST['user']);
            }
            ?>"/>

            <input id="pswd" class="form-control" type="password" name="password" placeholder="Mot de passe" required="required" value="<?php
            if(!empty($_POST['password'])){
                echo($_POST['password']);
            }
            ?>"/>
            <button type="submit">Connexion</button>
            <div>
                <?php
                if(!is_null($error)) {
                    echo ('<div class="text-danger">'.$error.'</div>');
                }
                ?>
            </div>
        </form >
    </div>
</section>
<?php
include "blocks/js.php";
?>
</body>
</html>
