<?php

namespace Model\User;

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
}