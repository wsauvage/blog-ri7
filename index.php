<?php include_once 'header.php' ?>

<?php

$articleInstance = new Article($connection);
$articles = $articleInstance->selectAll();

?>

<?php foreach($articles as $key=>$a): ?>
    <div class="card">
        <header class="card-header">
            <p class="card-header-title has-text-info">
                Article N°#<?= $a['id'] ?> : <?= $a['title'] ?>
            </p>
            <button class="card-header-icon" aria-label="more options">
              <span class="icon">
                <i class="fas fa-angle-down" aria-hidden="true"></i>
              </span>
            </button>
        </header>
        <div class="card-image">
            <figure class="image is-4by3">
                <!-- <img src="https://bulma.io/images/placeholders/1280x960.png" alt="Placeholder image">-->
                <img src="<?= $a['image_url'] ?>" alt="">
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
                <time>
                    <i class="has-text-grey-light">
                        <?= 'publié le '.$a['created_at'] ?>
                    </i>
                </time>
            </div>
        </div>
        <footer class="card-footer">
            <p class="card-footer-item">
                <button class="button is-black mr-2">
                    <span class="icon">
                        <i class="fas fa-eye"></i>
                    </span>
                    <span>Voir le contenu</span>
                </button>
                <button class="button is-black">
                    <span class="icon">
                        <i class="fas fa-edit"></i>
                    </span>
                    <span>Modifier</span>
                </button>
            </p>
        </footer>
    </div>
<?php endforeach; ?>

<?php include_once 'footer.php' ?>

