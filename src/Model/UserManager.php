<?php

namespace Blog\Model;

use PDO;

/**
 * Class UserManager
 */

class UserManager extends Manager
{
    /**
     * @param $id
     * @return User
     */
    public function one($id): User
    {
        $query = $this->db->prepare('SELECT * FROM user WHERE id = ?');
        $query->execute([$id]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return new User($data);
    }

    /**
     * @param $email
     * @return User
     */
    public function oneByEmail($email): User
    {
        $query = $this->db->prepare('SELECT * FROM user WHERE email = ?');
        $query->execute([$email]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return new User($data);
    }
}