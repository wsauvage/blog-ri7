<?php

use App\Model\Article;

$query =  isset($_GET['query']) ? $_GET['query'] : '';
$articleInstance = new Article($connection);
$articles = $articleInstance->search($query);
?>

<form method="get" action="index.php">
    <div class="columns mb-3">
        <div class="column is-four-fifths">
            <div class="field">
                <div class="control is-large has-icons-left">
                    <input id="query" name="query" class="input is-large" type="text" placeholder="Rechercher un article" value="<?= $query ?>">
                    <span class="icon is-small is-left">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="column">
            <button type="submit" class="button is-primary is-large">
                <span class="icon is-small is-left">
                    <i class="fas fa-check"></i>
                </span>
            </button>
        </div>
        <div class="column">
            <a href="#!">Recherche avancée</a>
        </div>
    </div>
</form>

<?php if (!empty($query)): ?>
    <article class="message is-info">
        <div class="message-body">
            <b><?= sizeof($articles) ?></b> résultat(s)
        </div>
    </article>
<?php endif; ?>

<?php foreach($articles as $key=>$a): ?>

    <?php
        $keywords = $articleInstance->findKeywords($a['id']);
    ?>
    <div class="card mb-3">
        <header class="card-header">
            <p class="card-header-title has-text-info">
                Article N°#<?= $a['id'] ?> : <?= $a['title'] ?>
            </p>
        </header>
        <div class="card-image">
            <figure class="image is-4by3">
                <img src="<?= !empty($a['image_url']) ? $a['image_url'] : 'https://bulma.io/images/placeholders/1280x960.png"'  ?>" alt="">
            </figure>
        </div>
        <div class="card-content">
            <div class="media">
                <div class="media-left">
                    <figure class="image is-48x48">
                        <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                    </figure>
                </div>
                <div class="media-content">
                    <p class="title is-4"><?= $a['author'] ?></p>
                    <p class="subtitle is-6">@johnsmith</p>
                </div>
            </div>

            <div class="content">
                <?= $a['content'] ?>
                <br>
                <div class="mt-2">
                    <time>
                        <i class="has-text-grey-light">
                            <?= 'publié le '.$a['created_at'] ?>
                        </i>
                    </time>
                    <span>dans <a href="#!" class="has-text-weight-bold"><?= $a['category_name'] ?></a>
                </div>

                <?php if (sizeof($keywords) > 0): ?>
                <div class="mt-2">
                    <?php foreach($keywords as $k): ?>
                        <span class="tag is-link mr-2">#<?= $k['name'] ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <footer class="card-footer">
            <p class="card-footer-item">
                <a class="button is-black mr-2" href="index.php?page=article-show&articleId=<?= $a['id'] ?>">
                    <span class="icon">
                        <i class="fas fa-eye"></i>
                    </span>
                    <span>Voir le contenu</span>
                </a>
                <a class="button is-black mr-2" href="index.php?page=article-edit&articleId=<?= $a['id'] ?>">
                    <span class="icon">
                        <i class="fas fa-edit"></i>
                    </span>
                    <span>Modifier</span>
                </a>
                <button class="button is-danger">
                <span class="icon">
                    <i class="fas fa-trash"></i>
                </span>
                    <span>Supprimer</span>
                </button>
            </p>
        </footer>
    </div>
<?php endforeach; ?>

