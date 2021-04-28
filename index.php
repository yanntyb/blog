<?php

require_once './assets/parts/include.php';

require_once './Controller/HomeController.php';
require_once './Controller/ArticleController.php';
require_once './Controller/UserController.php';


use Controller\HomeController;
use Controller\ArticleController;
use Controller\UserController;


// Soit l'url contient le paramètre controller ( $_GET['controller'] => http://localhost?controller=MonSuperController.
if(isset($_GET['controller'])) {
    if(isset($_SESSION["user"]) && !is_string($_SESSION["user"])){
        // Alors, l'utilisateur demande une action à effectuer.
        switch($_GET['controller']) {

            case 'articles': // ex: http://localhost?controller=articles
                $controller = new ArticleController();
                if(isset($_GET['action'])) {
                    switch($_GET['action']) {
                        case 'new' :
                            //Affiche la page d'ajout d'article
                            $controller->addArticle($_POST);
                            break;
                        case 'see' :
                            //Affiche l'article dont l'id = $_GET["article"]
                            if(isset($_GET["article"])){
                                $controller->showArticle($_GET["article"]);
                            }
                            break;
                        default:
                            break;
                    }
                }
                else {
                    // Affichage de tous les articles.
                    $controller->articles();
                }

                break;
            default:
                // Éventuellement, afficher une page 404 not found. Car le controller n'existe pas !
                break;
        }
    }
    else{
        //Affiche la page de connexion
        $controller = new UserController();
        $controller->connexionPage();
    }
}
else {
    //Affiche les articles
    if(isset($_SESSION["user"]) && !is_string($_SESSION["user"])){
        header("Location: index.php?controller=articles");
    }
    //Affiche la page de connexion
    else{
        $controller = new UserController();
        $controller->connexionPage();
    }
}
