<?php


// Un controller chope ce que l'utilisateur cherche à faire ( données entrées, etc.... )
// Il interragit avec le modèle ( adéquat )
// Il affiche la vue adéquate en fonction de la demande de l'utilisateur.

require_once $_SERVER["DOCUMENT_ROOT"] . '/assets/parts/functionUtils.php';

require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/DB.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Manager/Traits/ManagerTrait.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Controller/Traits/RenderViewTrait.php';

require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Entity/User.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Entity/Article.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Entity/Comment.php';

require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Manager/ArticleManager.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Manager/UserManager.php';

session_start();