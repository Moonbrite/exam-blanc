<?php
session_start();
$error =null;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if($_POST["user"] == "Jose" && $_POST ["password"] == "eUDHdjs3") {
        $_SESSION["user"] = "Jose";
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
            <svg id="eye" class="d-none oeil" width="30" height="30" fill="#000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5ZM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5Zm-3-5c0-1.66 1.34-3 3-3s3 1.34 3 3-1.34 3-3 3-3-1.34-3-3Z" clip-rule="evenodd"></path>
            </svg>
            <svg id="eyeClose"  class="oeil"  width="30" height="30" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"></path>
                <path d="M14.12 14.12a3 3 0 1 1-4.24-4.24"></path>
                <path d="m1 1 22 22"></path>
                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"></path>
            </svg>
            <button type="submit">Connexion</button>
            <div>
                <?php
                if(!is_null($error)) {
                    echo ('<div class="text-danger">'.$error.'</div>');
                }
                ?>
            </div>
            <a href="inscription.php">S'inscrire</a>
        </form >
    </div>
</section>
<?php
include "blocks/js.php";
?>
</body>
</html>
