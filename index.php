<?php
session_start();
require 'vendor/autoload.php';

use App\Model\Category;
use App\Model\Article;
use App\Utils\DBClass;
use App\Controller\ArticleController;

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

switch($page) {
    case "article-index":
        $data = ArticleController::index();
        include("app/views/article/index.php");
        break;
    case "article-show":
        include("app/views/article/show.php");
        break;
    case "article-new":
        include("app/views/article/new.php");
        break;
    case "article-create":
        ArticleController::create();
        header('Location: index.php');
        break;
    case "article-edit":
        include("app/views/article/edit.php");
        break;
    case "article-update":
        ArticleController::update();
        header('Location: index.php');
        break;
    default:
        include("app/views/article/index.php");
}

if ($_SESSION && array_key_exists('message',$_SESSION)) {
    unset($_SESSION['message']);
}

include 'app/views/layout/footer.php';