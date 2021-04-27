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
            // Affichage de tous les articles.
            case 'articles': // ex: http://localhost?controller=articles
                $controller = new ArticleController();

                // Pour l'ajout / l'édition / la suppression, on va checker un paramètre 'action' => http://localhost?controller=articles&action=new
                if(isset($_GET['action'])) {
                    switch($_GET['action']) {
                        case 'new' :
                            $controller->addArticle($_POST);
                            break;
                        case 'see' :
                            if(isset($_GET["article"])){
                                $controller->showArticle($_GET["article"]);
                            }
                            break;
                        default:
                            break;
                    }
                }
                else {
                    $controller->articles();
                }

                break;
            default:
                // Éventuellement, afficher une page 404 not found. Car le controller n'existe pas !
                break;
        }
    }
    else{
        $controller = new UserController();
        $controller->connexionPage();
    }
}
else {
    if(isset($_SESSION["user"]) && !is_string($_SESSION["user"])){
        header("Location: index.php?controller=articles");
    }
    else{
        $controller = new UserController();
        $controller->connexionPage();
    }

}

// Soit l'url ne contient pas le paramètre controller.