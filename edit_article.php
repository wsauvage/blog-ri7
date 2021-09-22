<?php include_once 'header.php' ?>

<?php

if (!isset($_GET['articleId'])) {
    exit("Veuillez spécifier un articleId");
}

$articleId = $_GET['articleId'];
$articleInstance = new Article($connection);

$article = $articleInstance->find($articleId);

$selectedKeywords = $articleInstance->findKeywords($articleId);

$selectedKeywordIds = [];

foreach ($selectedKeywords as $k) {
    array_push($selectedKeywordIds, $k['id']);
}

?>

<?php include_once 'form_article.php' ?>

<?php include_once 'footer.php' ?>

