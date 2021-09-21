
<?php
session_start();

include_once 'utils/DBClass.php';
include_once 'entities/Article.php';

$connection = (new DBClass())->getConnection();
$articleInstance = new Article($connection);

$success = $articleInstance->insert($_POST['title'], $_POST['content'], $_POST['author'], new \DateTime(), $_POST['imageUrl'], $_POST['categoryId']);

if ($success) {
    $_SESSION['message'] = 'Article ajouté dans la base.';
    $_SESSION['status'] = 'success';
}
else {
    $_SESSION['message'] = 'Erreur lors de l\'ajout de l\'article dans la base';
    $_SESSION['status'] = 'error';
}

header('Location: index.php');

?>
