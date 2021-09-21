<?php

class Article {

    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function selectAll() {
        $query =    'SELECT a.id, c.id as category_id, a.title, a.content, c.name as category_name, k.name as keyword_name, a.author, a.image_url, a.created_at '.
                    'FROM article a '.
                    //'WHERE a.category_id = c.id '.
                    //'AND a.id = ak.article_id '.
                    //'AND k.id = ak.keyword_id '.
                    //'OR  k.id IS NULL '.
                    'LEFT JOIN category c ON a.category_id = c.id '.
                    'LEFT JOIN article_keyword ak ON ak.article_id = a.id '.
                    'LEFT JOIN keyword k ON ak.keyword_id = k.id '.
                    'ORDER BY a.created_at DESC';


        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        //$this->connection->query($query);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert(string $title, string $content, string $author, \DateTime $createdAt, string $imageUrl, int $categoryId){
        $query = "INSERT INTO `article` (`id`, `title`, `content`, `author`, `created_at`, `image_url`, `category_id`) ".
            "VALUES (NULL, '$title', '$content', '$author', '".$createdAt->format('y-m-d h:i:s')."', '$imageUrl', '$categoryId')";
        echo $query;
        $stmt = $this->connection->prepare($query);
        return $stmt->execute();
    }

}
?>