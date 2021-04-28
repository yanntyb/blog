<?php

session_start();

//Si un user est connecté alors on le déconnecte
if(isset($_SESSION["user"]) && !is_string($_SESSION["user"])){
    unset($_SESSION["user"]);
    header("Location: index.php");
}