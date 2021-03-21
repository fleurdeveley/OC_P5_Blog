<?php

namespace Blog\Model;

use PDO;

/**
 * Class CommentsManager
 */

class CommentsManager extends Manager
{
    /**
     * @param $id
     * @return array
     */
    public function all($id): array
    {
        $comments = [];
        $query = $this->db->prepare('SELECT * FROM comment WHERE post_id = ? ORDER BY created_at');
        $query->execute([$id]);
        while($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = new Comment($data);
        }
        return $comments;
    }
}