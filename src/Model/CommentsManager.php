<?php

namespace Blog\Model;

use Exception;
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
        $query = $this->db->prepare('SELECT * FROM comment WHERE post_id = ? AND status = "validé" 
                 ORDER BY created_at');
        $query->execute([$id]);
        while($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    /**
     * @param Comment $comment
     * @return bool
     * @throws Exception
     */
    public function save(Comment $comment): bool
    {
        $query = $this->db->prepare('INSERT INTO comment (post_id, content, author, status, created_at, 
        updated_at) VALUES(?, ?, ?, "en cours de validation", NOW(), NOW())');
        $affectedLines = $query->execute([
            $comment->getPostId(),
            $comment->getContent(),
            $comment->getAuthor()
        ]);

        if ($affectedLines == false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }

        return $affectedLines;
    }
}