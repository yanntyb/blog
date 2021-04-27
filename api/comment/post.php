<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/parts/include.php";

use Model\Manager\UserManager;
use Model\Manager\ArticleManager;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];
$userManager = new UserManager();
$articleManager = new ArticleManager();

switch($requestType) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        if(isset($_GET["delete"]) && $_GET["delete"] === "true"){
            deleteComment($articleManager, $data->id);
        }
        else{
            addComment($articleManager, $data->user, $data->articleId, $data->content);
        }
        break;
    default:
        break;
}

function addComment(ArticleManager $manager, $userId, $articleId, $content){
    $manager->addComment($userId,$articleId,$content);
}

function deleteComment(ArticleManager $manager, int $id){
    $manager->removeComment($id);
}