<?php

namespace Blog\Model;

use Exception;
use PDO;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @param $id
     * @return array
     */
    public function getCommentsAwaitingValidation(): array
    {
        $comments = [];
        $query = $this->db->prepare('SELECT * FROM comment WHERE status = "en cours de validation" 
                 ORDER BY created_at');
        $query->execute([$id]);
        while($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    /**
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function refuseComment($id): bool
    {
        $query = $this->db->prepare('UPDATE comment SET status = "refusé" WHERE id = ?');
        $affectedLines = $query->execute([$id]);

        if ($affectedLines == false) {
            throw new Exception('Impossible de passer le commentaire en refusé !');
        }

        return $affectedLines;
    }

    /**
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function validateComment($id): bool
    {
        $query = $this->db->prepare('UPDATE comment SET status = "validé" WHERE id = ?');
        $affectedLines = $query->execute([$id]);

        if ($affectedLines == false) {
            throw new Exception('Impossible de passer le commentaire en validé !');
        }

        return $affectedLines;
    }
}