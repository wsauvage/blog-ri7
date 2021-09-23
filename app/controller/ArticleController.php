<?php

namespace App\Controller;

use App\Utils\DBClass;
use App\Model\Article;

class ArticleController {

    public static function index() {
        $connection = (new DBClass())->getConnection();
        $query =  isset($_GET['query']) ? $_GET['query'] : '';
        $articleInstance = new Article($connection);
        $articles = $articleInstance->search($query);

        $data = [];
        foreach($articles as $article) {
            $data[] = [
                'article' => $article,
                'keywords' => $articleInstance->findKeywords($article['id'])
            ];
        }


        return $data;
    }

    public static function create() {
        $connection = (new DBClass())->getConnection();
        $articleInstance = new Article($connection);
        $success = $articleInstance->create($_POST['title'], $_POST['content'], $_POST['author'], new \DateTime(), $_POST['imageUrl'], $_POST['categoryId'], $_POST['keywords']);

        $_SESSION['message'] = ($success) ? 'Article ajouté dans la base.' : 'Erreur lors de l\'ajout de l\'article dans la base';
    }

    public static function update() {
        $connection = (new DBClass())->getConnection();
        $articleInstance = new Article($connection);
        $success = $articleInstance->update($_POST['articleId'], $_POST['title'], $_POST['content'], $_POST['author'], new \DateTime(), $_POST['imageUrl'], $_POST['categoryId'], $_POST['keywords']);

        $_SESSION['message'] = ($success) ? 'Modifications enregistrées dans la base.' : 'Erreur lors de la modification de l\'article dans la base';
    }

}

