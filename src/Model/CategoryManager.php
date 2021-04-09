<?php

namespace Blog\Model;

use PDO;

/**
 * Class CategoryManager
 */

class CategoryManager extends Manager
{

    /**
     * @return array
     */
    public function all(): array
    {
        $categories = [];
        $query = $this->db->query('SELECT * FROM category');
        while($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = new Category($data);
        }
        return $categories;
    }

    /**
     * @param $id
     * @return Category
     */
    public function one($id): Category
    {
        $query = $this->db->prepare('SELECT * FROM category WHERE id = ?');
        $query->execute([$id]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return new Category($data);
    }
}