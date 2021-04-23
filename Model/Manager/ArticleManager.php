<?php

namespace Model\Manager;


use Model\Entity\Article;
use Model\Entity\User;
use Model\Manager\Traits\ManagerTrait;
use Model\DB;
use Model\User\UserManager;

class ArticleManager {
    use ManagerTrait;



    /**
     * Retourne tous les articles.
     */
    public function getAll(): array {
        $articles = [];
        $request = $this->db->prepare("SELECT * FROM article");
        $result = $request->execute();
        if($result) {
            $data = $request->fetchAll();
            foreach ($data as $article_data) {
                $user = UserManager::getManager()->getById($article_data['user_fk']);
                if($user->getId()) {
                    $articles[] = new Article($article_data['content'], $user, $article_data['id']);
                }
            }
        }
        return $articles;
    }

    /**
     * Add an article into the database.
     * @param Article $article
     * @return bool
     */
    public function add(Article $article) {
        $request = $this->db->prepare("
            INSERT INTO article (content, user_fk)
                VALUES (:content, :ufk) 
        ");

        $request->bindValue(':content', $article->getContent());
        $request->bindValue(':ufk', $article->getUser()->getId());

        return $request->execute() && DB::getInstance()->lastInsertId() != 0;
    }
}