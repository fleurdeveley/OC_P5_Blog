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
    public function getPosts() {
        $posts = [];

        $query = $this->db->query('SELECT * FROM post ORDER BY created_at');

        while($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $posts [] = new Post($data);
        }

        return $posts;
    }
}