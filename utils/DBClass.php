<?php

class DBClass {

    const HOST = "localhost";

    private $host = "localhost";
    private $username = "blog";
    private $password = "blog2021";
    private $database = "blog";

    public $connection;

    // get the database connection
    public function getConnection() {

        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->connection->exec("set names utf8");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}
?>