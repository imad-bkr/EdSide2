<?php ob_start(); ?>
<main class="browse-main">
    <aside class="sidebar">
        <div class="switch mentor-mentee">
            <input id="" class="" type="checkbox" name="">
            <label for="">parrain/fillot</label>
        </div>
        <div class="tags">
            <span class="post-tag tag-filter">Tag1</span> <span class="post-tag tag-filter">Tag2</span> <span class="post-tag tag-filter">Tag3</span>
        </div>
    </aside>
    <section class="posts">
        <?php foreach($annonces as $annonce) : ?>
            <a class="post" href="<?= URL ?>tutoring/view-post">
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