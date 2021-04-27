<?php

namespace Model\Manager;


use Model\Entity\Article;
use Model\Entity\Comment;
use Model\Entity\User;
use Model\Manager\Traits\ManagerTrait;
use Model\Manager\UserManager;
use Model\DB;


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
                $manager = new UserManager();
                $user = $manager->getById($selected["user_fk"]);
                return new Article($selected["content"], $user ,$selected["title"]);
            }
            $user = new User("User inconnu","","0");
            return new Article("L'article nexiste pas ",$user, "Inconnu");
        }
    }

    function getComment($id){
        $request = $this->db->prepare("SELECT c.content, c.id, a.user_fk FROM articleComment as a INNER JOIN comment as c ON a.comment_fk = c.id WHERE a.article_fk = :id");
        $request->bindValue(":id", $id);
        if($request->execute()){
            $comments = [];
            $userManager = new UserManager();
            foreach($request->fetchAll() as $selected){
                $comment = new Comment();
                $comment
                    ->setContent($selected["content"])
                    ->setId($selected["id"])
                    ->setAuthor($userManager->getById($selected["user_fk"]));
                $comments[] = $comment;
            }
            return $comments;
        }
    }

    public function addComment(int $idUser, int $idArticle, string $content){
        $request = $this->db->prepare("INSERT INTO comment (content) VALUES (:content)");
        $request->bindValue(":content", sanitize($content));
        $request->execute();
        $id = $this->db->lastInsertId();

        $request = $this->db->prepare("INSERT INTO articleComment (article_fk, comment_fk, user_fk) VALUES (:article_fk, :comment_fk, :user_fk)");
        $request->bindValue(":article_fk", $idArticle);
        $request->bindValue(":comment_fk", $id);
        $request->bindValue(":user_fk", $idUser);
        $request->execute();
    }

    public function deleteArticle($id){
        $request = $this->db->prepare("DELETE FROM article WHERE id = :id");
        $request->bindValue(":id", $id);
        $request->execute();
    }

    public function removeComment($id){
        $request = $this->db->prepare("DELETE FROM comment WHERE id = :id");
        $request->bindValue(":id", $id);
        $request->execute();
    }

    public function modifyArticle($id, $content){
        $request = $this->db->prepare("UPDATE article SET content = :content WHERE id = :id");
        $request->bindValue(":content", sanitize($content));
        $request->bindValue(":id", $id);
        $request->execute();
    }
}