<?php

namespace Blog\Model;

use PDO;

/**
 * Class PostsManager
 */

class PostsManager extends Manager
{
    /**
     * @return array
     */
    public function all()
    {
        $posts = [];
        $query = $this->db->query('SELECT * FROM post ORDER BY created_at');
        while($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $posts [] = new Post($data);
        }
        return $posts;
    }

    /**
     * @param $id
     * @return Post
     */
    public function one($id): Post
    {
        $query = $this->db->prepare('SELECT * FROM post WHERE id = ?');
        $query->execute([$id]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return new Post($data);
    }
}