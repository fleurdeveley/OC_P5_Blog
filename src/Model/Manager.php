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
            'mysql:host='.$_ENV['DB_HOST'].'; dbname='.$_ENV['DB_NAME'].'; charset=utf8',
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}