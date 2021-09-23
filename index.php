<?php
session_start();
require 'vendor/autoload.php';

use App\Model\Category;
use App\Model\Article;
use App\Utils\DBClass;

$connection = (new DBClass())->getConnection();
$categoryInstance = new Category($connection);
$categories = $categoryInstance->findAll();

include_once 'app/views/layout/header.php';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
else {
    $page = 'article-index';
}

switch($page ) {
    case "article-index":
        include("app/views/article/index.php");
        break;
    case "article-show":
        include("app/views/article/show.php");
        break;
    case "article-new":
        include("app/views/article/new.php");
        break;
    case "article-create":
        createArticle();
        header('Location: index.php');
        break;
    case "article-edit":
        include("app/views/article/edit.php");
        break;
    case "article-update":
        updateArticle();
        header('Location: index.php');
        break;
    default:
        include("app/views/article/index.php");
}

function createArticle() {
    $connection = (new DBClass())->getConnection();
    $articleInstance = new Article($connection);
    $success = $articleInstance->create($_POST['title'], $_POST['content'], $_POST['author'], new \DateTime(), $_POST['imageUrl'], $_POST['categoryId'], $_POST['keywords']);

    if ($success) {
        $_SESSION['message'] = 'Article ajouté dans la base.';
        $_SESSION['status'] = 'success';
    }
    else {
        $_SESSION['message'] = 'Erreur lors de l\'ajout de l\'article dans la base';
        $_SESSION['status'] = 'error';
    }
}

function updateArticle() {
    $connection = (new DBClass())->getConnection();
    $articleInstance = new Article($connection);
    $success = $articleInstance->update($_POST['articleId'], $_POST['title'], $_POST['content'], $_POST['author'], new \DateTime(), $_POST['imageUrl'], $_POST['categoryId'], $_POST['keywords']);

    if ($success) {
        $_SESSION['message'] = 'Modifications enregistrées dans la base.';
        $_SESSION['status'] = 'success';
    }
    else {
        $_SESSION['message'] = 'Erreur lors de l\'ajout de l\'article dans la base';
        $_SESSION['status'] = 'error';
    }
}

if ($_SESSION && array_key_exists('message',$_SESSION)) {
    unset($_SESSION['message']);
}

include 'app/views/layout/footer.php';