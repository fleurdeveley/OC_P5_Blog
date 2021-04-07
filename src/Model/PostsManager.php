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
       //récupérer lid du post puis faire un if
        return $this->update($post);

    }

    protected function update(Post $post)
    {
        $query = $this->db->prepare('UPDATE post SET title=?, chapo=?, content=?, updated_at=NOW(), 
                picture=? WHERE id = ?');
        $affectedLines = $query->execute([
            $post->getTitle(),
            $post->getChapo(),
            $post->getContent(),
            $post->getPicture(),
            $post->getId(),
        ]);

        if ($affectedLines == false) {
            throw new Exception('Impossible de modifier l\'article !');
        }

        return $affectedLines;
    }

    protected function create(Post $post)
    {

    }
}