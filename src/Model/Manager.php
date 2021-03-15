<?php

namespace Blog\Model;

use PDO;

class Manager 
{
    protected $db;

    public function __construct() 
    {
        $this->db = $this->dbConnect();
    }

    protected function dbConnect() 
    {
        return new PDO(
            'mysql:host=mysql_mysql; dbname=blog; charset=utf8',
            'root',
            'garfield',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}