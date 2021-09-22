<?php

class Keyword {

    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function findAll() {
        $query =    'SELECT * '.
                    'FROM keyword k '.
                    'ORDER BY k.name ASC';

        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>