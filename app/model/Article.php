<?php

namespace App\Model;

class Article {

    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public static function getSelectSql(?int $id = null, ?string $query = '') : string {

        $sql =
            'SELECT a.id, 
                c.id as category_id, 
                a.title, 
                a.content, 
                c.name as category_name, 
                a.author, 
                a.image_url, 
                a.created_at '.
            'FROM article a '.
            'LEFT JOIN category c ON a.category_id = c.id
             WHERE 1 ';

        if ($id !== null) {
            $sql  .= 'AND a.id = '.$id.' ';
        }

        if (!empty($query))  {
            $sql  .= 'AND (a.title LIKE \'%'.$query.'%\' OR a.content LIKE \'%'.$query.'%\' ) ';
        }

        $sql .='ORDER BY a.created_at DESC';

        return $sql;
    }

    public function find(int $id) : array {
        $sql = self::getSelectSql($id);
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function search(?string $query = '') {
        $sql = self::getSelectSql(null, $query);

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findKeywords(int $articleId) : array {

        $query =
            'SELECT k.id, 
                k.name '.
            'FROM keyword k '.
            'LEFT JOIN article_keyword ak ON ak.keyword_id = k.id '.
            'LEFT JOIN article a ON ak.article_id = a.id '.
            'WHERE a.id='.$articleId;

        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create(string $title, string $content, string $author, \DateTime $createdAt, string $imageUrl, int $categoryId, ?array $keywords) {

        $sql = "INSERT INTO `article` (`id`, `title`, `content`, `author`, `created_at`, `image_url`, `category_id`) ".
            "VALUES (NULL, '$title', '$content', '$author', '".$createdAt->format('y-m-d h:i:s')."', '$imageUrl', '$categoryId')";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
        }
        catch(PDOException $exception){
            return $exception;
        }

        $articleId = $this->connection->lastInsertId();

        foreach ($keywords as $keyword) {
            $sql= "INSERT INTO `article_keyword` (`article_id`, `keyword_id`) ".
                "VALUES (".$articleId.", ".$keyword['id'].")";

            try {
                $stmt = $this->connection->prepare($sql);
                $stmt->execute();
            }
            catch(PDOException $exception){
                return $exception;
            }
        }

        return true;
    }

    public function update(int $articleId, string $title, string $content, string $author, \DateTime $createdAt, string $imageUrl, int $categoryId, ?array $keywords) {

        $sql = "UPDATE `article` SET 
                `title` = '$title', 
                `content` = '$content', 
                `author` = '$author', 
                `created_at` = '".$createdAt->format('y-m-d h:i:s')."', 
                `image_url` = '$imageUrl', 
                `category_id` = '$categoryId' 
            WHERE `article`.`id` = $articleId;";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
        }
        catch(PDOException $exception){
            return $exception;
        }

        //Mise à jour des keywords
        $currentKeywords = $this->findKeywords($articleId);
        $currentKeywordIds = [];

        foreach ($currentKeywords as $k) {
            array_push($currentKeywordIds, $k['id']);
        }

        foreach ($keywords as $k) {
            if (!in_array($k, $currentKeywordIds)) {
                $sql= "INSERT INTO `article_keyword` (`article_id`, `keyword_id`) ".
                    "VALUES (".$articleId.", ".$keyword['id'].")";
                try {
                    $stmt = $this->connection->prepare($sql);
                    $stmt->execute();
                }
                catch(PDOException $exception){
                    return $exception;
                }
            }
        }

        foreach ($currentKeywords  as $ck) {
            if (!in_array($ck, $keywords)) {
                //remove
            }
        }

        return true;
    }


}

