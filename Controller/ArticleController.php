<?php


namespace Controller;

require_once $_SERVER["DOCUMENT_ROOT"] . '/Model/Entity/User.php';

use Controller\Traits\RenderViewTrait;
use Model\Entity\Article;
use Model\Entity\User;
use Model\Manager\ArticleManager;
use Model\Manager\UserManager;

class ArticleController {

    use RenderViewTrait;

    private ArticleManager $articleManager;
    private UserManager $userManager;

    public function __construct() {
        $this->articleManager = new ArticleManager();
        $this->userManager = new UserManager();
    }

    /**
     * Affiche la liste des articles disponibles.
     */
    public function articles() {
        $articles = $this->articleManager->getAll();

        $this->render('articles', 'Mes articles', [
            'articles' => $articles,
        ]);
    }

    /**
     * Ajoute un nouvel article.
     */
    public function addArticle($fields){
        if(isset($fields['content'], $fields['user'])) {
            // Alors ca veut dure que le formulaire a été envoyé.

            $content = htmlentities($fields['content']);
            $user_fk = intval($fields['user']);
            $title = htmlentities($fields['title']);

            $user = $this->userManager->getById($user_fk);
            if($user->getId()) {
                $article = new Article($content, $user, $title);
                $this->articleManager->add($article);
                header("Location: index.php?controller=articles");
            }
        }
        $this->render('add.article', 'Ajouter un article', ["user" => $_SESSION["user"]]);
    }

    public function showArticle($id){
        $article = $this->articleManager->getById($id);
        $this->render('article',$article->getTitle(),[
            'article' => $article,
            'id' => $id,
            'user' => $_SESSION['user'],
        ]);
    }
}