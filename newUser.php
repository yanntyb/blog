<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/assets/parts/functionUtils.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/DB.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Manager/Traits/ManagerTrait.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Entity/User.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Manager/UserManager.php';

use Model\Manager\UserManager;

if(isset($_POST,$_POST["name"], $_POST["password"])){
    $name = sanitize($_POST["name"]);
    if(strlen($_POST["password"]) < 1){
        header("Location: index.php?error=mauvaise infromation d'inscription&color=red");
        exit;
    }

    $pass = password_hash(sanitize($_POST["password"]), PASSWORD_DEFAULT);
    $manager = new UserManager();
    $manager->insertUser($name,$pass);
    header("Location: index.php?controller=articles");

}
else{
    header("Location: index.php?error=mauvaise infromation d'inscription&color=red");
}