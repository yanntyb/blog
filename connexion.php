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
    if(is_string($user)){
        header("Location: index.php?error=" . $user . "&color=red");
    }
    else{
        $_SESSION["user"] = $user;
        print_r($_SESSION["user"]);
        header('Location: index.php?controller=articles');
    }
}
else{
    echo "ok";
}