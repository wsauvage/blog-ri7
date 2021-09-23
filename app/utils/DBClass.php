<?php
namespace App\Utils;

use App\AppConfig;

class DBClass {

    public $connection;

    public function getConnection() {

        $this->connection = null;

        try {
            $this->connection = new \PDO("mysql:host=" . AppConfig::DB_HOST . ";dbname=" . AppConfig::DB_DATABASE, AppConfig::DB_USERNAME, AppConfig::DB_PASSWORD);
            $this->connection->exec("set names utf8");
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}
?>