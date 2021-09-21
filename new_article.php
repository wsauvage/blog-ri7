<?php include_once 'header.php' ?>

<form method="post" action="create_article.php">
    <div class="field">
        <label class="label">Titre</label>
        <div class="control">
            <input id="title" name="title" class="input" type="text" placeholder="Titre">
        </div>
    </div>

    <div class="field">
        <label class="label">Contenu</label>
        <div class="control">
            <textarea id="content" name="content" class="textarea" placeholder="Textarea"></textarea>
        </div>
    </div>

    <div class="field">
        <label class="label">Auteur</label>
        <div class="control">
            <input id="author" name="author" class="input" type="text" placeholder="Auteur">
        </div>
    </div>

    <div class="field">
        <label class="label">Image (url)</label>
        <div class="control">
            <input id="imageUrl" name="imageUrl" class="input" type="text" placeholder="URL de l'image">
        </div>
    </div>

    <div class="field">
        <label class="label">Catégorie</label>
        <div class="control">
            <div class="select">
                <select id="categoryId" name="categoryId">
                    <?php foreach($categories as $c): ?>
                        <option value="<?= $c['id'] ?>">
                            <?= $c['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="field is-grouped">
        <div class="control">
            <button type="submit" class="button is-success">Ajouter</button>
        </div>
        <div class="control">
            <a href="index.php" class="button is-link is-light">Annuler</a>
        </div>
    </div>
</form>
<?php include_once 'footer.php' ?>

