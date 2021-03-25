<?php

namespace Blog\Model;

use PDO;

/**
 * Class Manager
 */

abstract class Manager
{
    protected $db;

    /**
     * Manager constructor.
     */
    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    /**
     * @return PDO
     */
    protected function dbConnect(): PDO
    {
        return new PDO(
            'mysql:host=mysql_mysql; dbname=blog; charset=utf8',
            'root',
            'garfield',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}