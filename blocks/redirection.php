<?php

function redirectionConnectionIsConected (){
    if(!array_key_exists("user",$_SESSION)) {
        header('Location: index.php');
        exit();
    }
}

function redirectionIndex (){
    if(array_key_exists("user",$_SESSION)) {
        header('Location: index.php');
        exit();
    }
}
