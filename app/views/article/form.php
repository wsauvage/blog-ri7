<?php
use App\Model\Keyword;

$keywordInstance = new Keyword($connection);
$keywords = $keywordInstance->findAll();
?>

<form method="post" action="<?= isset($article) ? 'index.php?page=article-update' : 'index.php?page=article-create'?>">
    <div class="field" style="display:none">
        <div class="control">
            <input id="articleId" name="articleId" class="input" type="text" placeholder="ID" value="<?= isset($article) ? $article['id'] : '' ?>">
        </div>
    </div>

    <div class="field">
        <label class="label">Titre</label>
        <div class="control">
            <input id="title" name="title" class="input" type="text" placeholder="Titre" value="<?= isset($article) ? $article['title'] : '' ?>">
        </div>
    </div>

    <div class="field">
        <label class="label">Contenu</label>
        <div class="control">
            <textarea id="content" name="content" class="textarea" placeholder="Textarea"><?= isset($article) ? $article['content'] : '' ?></textarea>
        </div>
    </div>

    <div class="field">
        <label class="label">Auteur</label>
        <div class="control">
            <input id="author" name="author" class="input" type="text" placeholder="Auteur" value="<?= isset($article) ? $article['author'] : '' ?>">
        </div>
    </div>

    <div class="field">
        <label class="label">Image (url)</label>
        <div class="control">
            <input id="imageUrl" name="imageUrl" class="input" type="text" placeholder="URL de l'image" value="<?= isset($article) ? $article['image_url'] : '' ?>">
        </div>
    </div>

    <div class="field">
        <label class="label">Catégorie</label>
        <div class="control">
            <div class="select">
                <select id="categoryId" name="categoryId">
                    <?php foreach($categories as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= (isset($article) && ($article['category_id'] === $c['id'] )) ? 'selected' : '' ?>>
                            <?= $c['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="field">
        <label class="label">Mots clés</label>
        <div class="control">
            <div class="select is-multiple">
                <select multiple id="keywords" name="keywords[]">
                    <?php foreach($keywords as $k): ?>
                        <option value="<?= $k['id'] ?>" <?= (isset($selectedKeywordIds) && (in_array($k['id'], $selectedKeywordIds))) ? 'selected' : '' ?>>
                            <?= $k['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="field is-grouped">
        <div class="control">
            <button type="submit" class="button is-success"><?= isset($article) ? 'Mettre à jour' : 'Ajouter'?></button>
        </div>
        <div class="control">
            <a href="index.php" class="button is-link is-light">Annuler</a>
        </div>
    </div>
</form>


