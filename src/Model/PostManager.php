<?php

namespace Blog\Model;

use PDO;

class PostManager extends Manager
{
    public function getPosts() {
        $posts = [];

        $query = $this->db->query('SELECT * FROM post ORDER BY created_at');

        while($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $posts [] = new Post($data);
        }
        return $posts;
    }
}