<?php ob_start(); ?>
<main class="view-post-main">
    <a class="back-to-posts" href="browse.php">Retour aux annonces</a>
    <div class="view-post">
        <h3 class="view-post-title"><?= $annonce['titre'] ?></h3>
        <p class="view-post-desc"><?= $annonce['description'] ?></p>
        <div class="view-post-tags">
            <span class="post-tag"><?= $annonce['tag'] ?></span>
        </div>
    </div>
    <div class="view-profile">
        <img class="view-profile-pic" src="<?= URL ?>public/img/profil-pic.png" alt="photo de profil">
        <p class="view-profile-contact"></p>
        <p class="view-profile-desc"></p>
    </div>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php" 
?>

 