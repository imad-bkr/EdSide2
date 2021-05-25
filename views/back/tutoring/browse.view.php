<?php ob_start(); ?>
<main class="browse-main">
    <a class="link-top-right" href="<?= URL ?>tutoring/profil">Mon profil</a>
    <aside class="sidebar">
        <div class="parrain-fillot">
            Parrain:
            <input class="parrain-checkbox" type="checkbox" name="parrain">
            Fillot:
            <input class="fillot-checkbox" type="checkbox" name="fillot">
        </div>
        <div class="search-tags">
            <form class="browse-search" action="#" method="POST">
                <label class="browse-search-label">Recherche par mot-clé:</label>
                <input class="browse-search-bar" type="search" name="bytags">
                <input class="button" type="submit" name="search" value="rechercher">
            </form>
        </div>
    </aside>
    <section class="posts">
        <?php foreach ($annonces as $annonce) : ?>
            <?php $user = getUserById($annonce['id_user']); ?>
            <a class="post" href="<?= URL ?>tutoring/view-post&id=<?= $annonce['id_annonce'] ?>">
                <div class="preview-profil">
                    <img class="preview-profil-pic" src="https://placehold.co/100x100" alt="photo de profil">
                    <h3 class="preview-profil-name"><?= $user['username']?></h3>
                    <p class="preview-profil-desc"><?= $user['description_profil']?></p>
                </div>
                <div class="post-body">
                    <h3 class="post-title"><?= $annonce['titre'] ?></h3>
                    <p class="post-date">Publié le <?php $date = date_create($annonce['date']); echo date_format($date, "d/m/Y"); ?></p>
                    <p class="post-description"><?= $annonce['description'] ?></p>
                    <span class="post-tag"><?= $annonce['tag'] ?></span>
                </div>
            </a>
        <?php endforeach ?>
    </section>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php" 
?>