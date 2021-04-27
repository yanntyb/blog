<?php

namespace Model\Manager;

use Model\DB;
use Model\Entity\User;
use Model\Manager\Traits\ManagerTrait;

class UserManager {

    use ManagerTrait;

    /**
     * Retourne un utilisateur via son id.
     * @param int $id
     * @return User
     */
    public function getById(int $id): User {
        $user = new User();
        $request = $this->db->prepare("SELECT id, username FROM user WHERE id = :user_fk");
        $request->bindValue(':user_fk', $id);
        $result = $request->execute();
        if($result) {
            $user_data = $request->fetch();
            if($user_data) {
                $user->setId($user_data['id']);
                $user->setPassword('');
                $user->setUsername($user_data['username']);
            }
        }
        return $user;
    }

    public function getAll(){
        $request = $this->db->prepare("SELECT * FROM user");
        if($request->execute()){
            $users = [];
            foreach($request->fetchAll() as $selected){
                $user = new User();
                $user
                    ->setId($selected["id"])
                    ->setUsername($selected["username"]);
                $users[] = $user;
            }
            return $users;
        }
    }
    
    public function insertUser($name, $pass): int{
        $request = $this->db->prepare("INSERT INTO user (username, password) VALUES (:name, :pass)");
        $request->bindValue(":name", $name);
        $request->bindValue(":pass", $pass);
        $request->execute();
        return $this->db->lastInsertId();
    }

    public function getUser($name, $pass){
        $request = $this->db->prepare("SELECT * FROM user WHERE username = :name");
        $request->bindValue(":name", $name);
        if($request->execute() && $select = $request->fetch()){
            if(password_verify($pass, $select["password"])){
                $user = new User();
                $user
                    ->setId($select["id"])
                    ->setUsername($select["username"])
                    ->setAdmin($select["admin"]);
                return $user;
            }
            return "bad pass ";
        }
        return "bad name";
    }
}