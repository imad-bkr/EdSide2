<?php ob_start(); ?>
<main class="view-post-main">
    <a class="back-to-posts" href="<?= URL ?>tutoring/browse">Retour aux annonces</a>
    <div class="view-post">
        <h3 class="view-post-title">Annonce</h3>
        <p class="view-post-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        <div class="view-post-tags">
            <span class="post-tag">Tag1</span> <span class="post-tag">Tag2</span> <span class="post-tag">Tag3</span>
        </div>
    </div>
    <div class="view-profile">
        <img class="view-profile-pic" src="/img/profil-pic.png" alt="photo de profil">
        <p class="view-profile-contact"></p>
        <p class="view-profile-desc"></p>
    </div>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php" 
?>

 