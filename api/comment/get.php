<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/parts/include.php";

use Model\Manager\UserManager;
use Model\Manager\ArticleManager;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];
$userManager = new UserManager();
$articleManager = new ArticleManager();

switch($requestType) {
    case 'GET':
        if(isset($_GET['id'])){
            echo getComment($_GET['id'], $articleManager);
        }
        break;
    default:
        break;
}

/**
 * Get all comment of a certain article
 * @param int $articleId
 * @param ArticleManager $articleManager
 */
function getComment(int $articleId, ArticleManager $articleManager){
    $comments = $articleManager->getComment($articleId);
    $response = [];
    foreach($comments as $comment){
        $response[] = [
            "author" => $comment->getAuthor()->getUsername(),
            "content" => sanitize($comment->getContent()),
            "id" => $comment->getId(),
            "admin" => $_SESSION["user"]->getAdmin()
        ];
    }
    return json_encode($response);
}



exit;