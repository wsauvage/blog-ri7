
<?php
session_start();

include_once 'utils/DBClass.php';
include_once 'entities/Article.php';
include_once 'entities/Category.php';

$connection = (new DBClass())->getConnection();
$categoryInstance = new Category($connection);
$categories = $categoryInstance->selectAll();

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mon Blog</title>
        <link rel="stylesheet" href="assets/css/bulma.min.css">
        <script src="https://kit.fontawesome.com/424eb58bc6.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-item" href="index.php">
                        <img src="https://ri7.fr/wp-content/uploads/2020/12/logo-200x100-bicolore.png" height="40">
                    </a>

                    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                    </a>
                </div>
                <div id="navbarBasicExample" class="navbar-menu">
                    <div class="navbar-start">
                        <a class="navbar-item" href="index.php">
                            Tous les articles
                        </a>

                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link">
                                Catégories
                            </a>
                            <div class="navbar-dropdown">
                                <?php foreach($categories as $key=>$c): ?>
                                    <a class="navbar-item">
                                        <?= $c ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="navbar-end">
                        <div class="navbar-item">
                            <div class="buttons">
                                <a class="button is-success" href="new_article.php">
                                    <span class="icon">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <strong>Nouvel article</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <section class="section">
            <div class="container">
                <?php if ($_SESSION && array_key_exists('message',$_SESSION)): ?>
                <article class="message is-success">
                    <div class="message-header">
                        <p>Info</p>
                        <button class="delete" aria-label="delete"></button>
                    </div>
                    <div class="message-body">
                        <?= $_SESSION['message'] ?>
                    </div>
                </article>
                <?php endif; ?>
