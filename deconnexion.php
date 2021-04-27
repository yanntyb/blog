<?php

session_start();

if(isset($_SESSION["user"]) && !is_string($_SESSION["user"])){
    unset($_SESSION["user"]);
    header("Location: index.php");
}