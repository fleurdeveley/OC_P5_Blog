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
        $query = $this->db->prepare('SELECT * FROM comment WHERE post_id = ? AND status = "validé" ORDER BY created_at');
        $query->execute([$id]);
        while($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    public function postComment($postId, $author, $content)
    {
        $query = $this->db->prepare('INSERT INTO comment (post_id, content, author, status, created_at, 
        updated_at) VALUES(?, ?, ?, "en cours de validation", NOW(), NOW())');
        $affectedLines = $query->execute([$postId, $content, $author]);
        return $affectedLines;
    }
}