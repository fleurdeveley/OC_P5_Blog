<?php

namespace Blog\Model;

use Exception;
use PDO;

/**
 * Class PostsManager
 */

class PostsManager extends Manager
{
    /**
     * @return array
     */
    public function all(): array
    {
        $posts = [];
        $query = $this->db->query('SELECT * FROM post ORDER BY created_at');
        while($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = new Post($data);
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

    /**
     * @param Post $post
     * @return bool
     */
    public function save(Post $post): bool
    {
        if($post->getId()) {
            return $this->update($post);
        } else {
            return $this->create($post);
        }
    }

    /**
     * @param Post $post
     * @return bool
     * @throws Exception
     */
    protected function update(Post $post): bool
    {
        $query = $this->db->prepare('UPDATE post SET title=?, category_id=?, chapo=?, content=?, updated_at=NOW(), 
                 picture=? WHERE id = ?');
        $affectedLines = $query->execute([
            $post->getTitle(),
            $post->getCategoryId(),
            $post->getChapo(),
            $post->getContent(),
            $post->getPicture(),
            $post->getId(),
        ]);

        if ($affectedLines === false) {
            throw new Exception('Impossible de modifier l\'article !');
        }

        return $affectedLines;
    }

    /**
     * @param Post $post
     * @return bool
     * @throws Exception
     */
    protected function create(Post $post): bool
    {
        $query = $this->db->prepare('INSERT INTO post (title, category_id, user_id, chapo, content, created_at, 
                updated_at, picture) VALUES (?, ?, ?, ?, ?, NOW(), NOW(), ?)');

        $affectedLines = $query->execute([
            $post->getTitle(),
            $post->getCategoryId(),
            $post->getUserId(),
            $post->getChapo(),
            $post->getContent(),
            $post->getPicture()
        ]);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'insérer l\'article !');
        }

        return $affectedLines;
    }

    /**
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function delete($id): bool
    {
        $query = $this->db->prepare('DELETE FROM post WHERE id = ?');
        $affectedLines = $query->execute([$id]);

        if ($affectedLines === false) {
            throw new Exception('Impossible de supprimer l\'article !');
        }

        return $affectedLines;
    }
}