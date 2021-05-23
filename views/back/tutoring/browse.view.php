<?php ob_start(); ?>
<main class="browse-main">
    <aside class="sidebar">
        <div class="parrain-fillot">
            Parrain:
            <input class="parrain-checkbox" type="checkbox" name="parrain">
            Fillot:
            <input class="fillot-checkbox" type="checkbox" name="fillot">
        </div>
        <div class="search-tags">
            Recherche par mot-clé:
            <form action="#" method="POST">
                <input type="search" name="bytags" id="">
                <input type="submit" name="search" value="rechercher">
            </form>
        </div>
    </aside>
    <section class="posts">
        <?php foreach($annonces as $annonce) : ?>
            <a class="post" href="<?= URL ?>tutoring/view-post&id=<?= $annonce['id_annonce'] ?>">
                <div class="preview-profil">
                    <img class="preview-profil-pic" src="https://placehold.co/100x100" alt="photo de profil">
                </div>
                <div class="post-body">
                    <h3 class="post-title"><?= $annonce['titre'] ?></h3>
                    <p class="post-date">Publié le <?php $date = date_create($annonce['date']); echo date_format($date, "Y/m/d"); ?></p>
                    <p class="post-description"><?= $annonce['description'] ?></p>
                    <span class="post-tag"><?= $annonce['tag'] ?></span>
                </div>
            </a>
        <?php endforeach ?>
    </section>
    <a class="browse-link-profil" href="<?= URL ?>tutoring/profil">Mon profil</a>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php" 
?>