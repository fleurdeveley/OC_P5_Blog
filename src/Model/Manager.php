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
            'mysql:host='.getenv('DB_HOST').'; dbname='.getenv('DB_NAME').'; charset=utf8',
            getenv('DB_USER'),
            getenv('DB_PASSWORD'),
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}