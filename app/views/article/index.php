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
            <b><?= sizeof($data) ?></b> résultat(s)
        </div>
    </article>
<?php endif; ?>

<?php foreach($data as $key=>$value): ?>

    <div class="card mb-3">
        <header class="card-header">
            <p class="card-header-title has-text-info">
                Article N°#<?= $value['article']['id'] ?> : <?= $value['article']['title'] ?>
            </p>
        </header>
        <div class="card-image">
            <figure class="image is-4by3">
                <img src="<?= !empty($value['article']['image_url']) ? $value['article']['image_url'] : 'https://bulma.io/images/placeholders/1280x960.png"'  ?>" alt="">
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
                    <p class="title is-4"><?= $value['article']['author'] ?></p>
                    <p class="subtitle is-6">@johnsmith</p>
                </div>
            </div>

            <div class="content">
                <?= $value['article']['content'] ?>
                <br>
                <div class="mt-2">
                    <time>
                        <i class="has-text-grey-light">
                            <?= 'publié le '.$value['article']['created_at'] ?>
                        </i>
                    </time>
                    <span>dans <a href="#!" class="has-text-weight-bold"><?= $value['article']['category_name'] ?></a>
                </div>

                <?php if (sizeof($value['keywords']) > 0): ?>
                <div class="mt-2">
                    <?php foreach($value['keywords'] as $k): ?>
                        <span class="tag is-link mr-2">#<?= $k['name'] ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <footer class="card-footer">
            <p class="card-footer-item">
                <a class="button is-black mr-2" href="index.php?page=article-show&articleId=<?= $value['article']['id'] ?>">
                    <span class="icon">
                        <i class="fas fa-eye"></i>
                    </span>
                    <span>Voir le contenu</span>
                </a>
                <a class="button is-black mr-2" href="index.php?page=article-edit&articleId=<?= $value['article']['id'] ?>">
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

