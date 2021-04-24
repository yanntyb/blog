<?php

namespace Model\Manager;


use Model\Entity\Article;
use Model\Entity\Comment;
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
                $manager = new UserManager();
                $user = $manager->getById($article_data['user_fk']);
                if($user->getId()) {
                    $articles[] = new Article($article_data['content'], $user, $article_data["title"],[],  $article_data['id']);
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
            INSERT INTO article (content, user_fk, title)
                VALUES (:content, :ufk, :title) 
        ");

        $request->bindValue(':content', $article->getContent());
        $request->bindValue(':ufk', $article->getUser()->getId());
        $request->bindValue(":title", $article->getTitle());

        return $request->execute() && DB::getInstance()->lastInsertId() != 0;
    }

    public function getById($id){
        $request = $this->db->prepare("SELECT * FROM article WHERE id = :id");
        $request->bindValue(":id", $id);
        if($request->execute()){
            if($selected = $request->fetch()){
                $request = $this->db->prepare("SELECT * FROM articleComment as a INNER JOIN comment as c ON a.comment_fk = c.id WHERE a.article_fk = :id");
                $request->bindValue(":id", $id);
                if($request->execute()){
                    $comments = [];
                    $userManager = new UserManager();
                    foreach($request->fetchAll() as $commentSelected){
                        $comment = new Comment();
                        $comment
                            ->setContent($commentSelected["content"])
                            ->setAuthor($userManager->getById($commentSelected["user_fk"]));
                        $comments[] = $comment;
                    }
                    $manager = new UserManager();
                    $user = $manager->getById($selected["user_fk"]);
                    return new Article($selected["content"], $user ,$selected["title"], $comments);
                }
            }
        }
    }
}