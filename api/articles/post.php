<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/parts/include.php";

use Model\Manager\ArticleManager;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];
$articleManager = new ArticleManager();

switch($requestType) {
    case 'POST':
        //Get Ajax post content
        $data = json_decode(file_get_contents('php://input'));
        //Modify an article
        if(isset($_GET, $_GET["id"])){
            modifyArticle($articleManager, $_GET["id"], $data->content);
            break;
        }
        //Delete an article
        deleteArticle($articleManager, $data->id);
        break;
    default:
        break;
}

function deleteArticle(ArticleManager $articleManager, int $id){
    $articleManager->deleteArticle($id);
}

function modifyArticle(ArticleManager $articleManager, int $id, string $content){
    $articleManager->modifyArticle($id,$content);
}