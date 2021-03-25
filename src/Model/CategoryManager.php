<?php

namespace Blog\Model;

use PDO;

/**
 * Class CategoryManager
 */

class CategoryManager extends Manager
{
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