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

        if($data == false) {
            $data = [];
        }

        return new User($data);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user): bool
    {
        return $this->register($user);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function register(User $user): bool
    {
         $query = $this->db->prepare('INSERT INTO user (firstname, lastname, email, password)
                                            VALUES (?, ?, ?, ?)');

        $affectedLines = $query->execute([
            $user->getFirstname(),
            $user->getLastname(),
            $user->getEmail(),
            md5($user->getPassword())
        ]);

        if ($affectedLines === false) {
            throw new Exception('Impossible de s\'inscrire !');
        }

        return $affectedLines;
    }
}