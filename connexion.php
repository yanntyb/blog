<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/assets/parts/functionUtils.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/DB.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Manager/Traits/ManagerTrait.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Entity/User.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Manager/UserManager.php';

session_start();

use Model\Manager\UserManager;

if(isset($_GET, $_GET["name"], $_GET["password"])){
    $name = sanitize($_GET["name"]);
    $pass = sanitize($_GET["password"]);
    $userManager = new UserManager();
    $user = $userManager->getUser($name, $pass);
    //Si getUser() renvoie un string ça veut dire qu'il ya une erreur dont on renvoie a la page de connexion
    if(is_string($user)){
        header("Location: index.php?error=" . $user . "&color=red");
    }
    //Sinon on stock l'user dans la variable session
    else{
        $_SESSION["user"] = $user;
        header('Location: index.php?controller=articles');
    }
}
else{
    echo "ok";
}