<?php

namespace App\Model;

class Category {

    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function findAll() {
        $query =    'SELECT * '.
                    'FROM category c '.
                    'ORDER BY c.name ASC';

        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}

