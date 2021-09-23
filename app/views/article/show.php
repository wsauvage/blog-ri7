<?php
use App\Model\Article;

if (!isset($_GET['articleId'])) {
    exit("Veuillez spécifier un articleId");
}

$articleId = $_GET['articleId'];

$articleInstance = new Article($connection);
$article = $articleInstance->find($articleId);
$keywords = $articleInstance->findKeywords($articleId);

?>

<section class="section">
    <h1 class="title"><?= $article['title'] ?></h1>
    <h2 class="subtitle">
        <time>
            <i class="has-text-grey-light">
                <?= 'publié le '.$article['created_at'] ?>
            </i>
        </time>
        <span>dans <a href="#!" class="has-text-weight-bold"><?= $article['category_name'] ?></a>
    </h2>
    <div class="card">
        <div class="card-image">
            <figure class="image is-4by3">
                <img src="<?= $article['image_url'] ?>" alt="">
            </figure>
        </div>
    </div>
</section>
<section class="section">
    <p>
        <?= $article['content'] ?>
    </p>
    <p class="mt-3 has-text-grey-light">
        <i>Auteur : @<?= $article['author'] ?></i>
    </p>
</section>
<?php if (sizeof($keywords) > 0): ?>
<section class="section">
    <b>Mot clés : </b>
    <?php foreach($keywords as $k): ?>
        <span class="tag is-link mr-2">#<?= $k['name'] ?></span>
    <?php endforeach; ?>
</section>
<?php endif; ?>
<section class="section">
    <a class="button is-black mr-2" href="index.php">
        <span class="icon">
            <i class="fas fa-arrow-left"></i>
        </span>
        <span>Retour</span>
    </a>
</section>

