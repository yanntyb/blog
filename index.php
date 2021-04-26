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
        case "connexion":
            $controller = new UserController();
            $controller->connexionPage();
            break;
        default:
            // Éventuellement, afficher une page 404 not found. Car le controller n'existe pas !
            break;
    }
}
else {
    // Si le paramètre cxontroller ne se trouve pas dans l'url, alors la page 'home' doit être affichée.
    // Donc on part sur le Home controller en demandant d'afficher la home page.
    $controller = new HomeController();
    $controller->homePage();
}

// Soit l'url ne contient pas le paramètre controller.