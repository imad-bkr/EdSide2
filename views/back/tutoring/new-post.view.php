<?php ob_start(); ?>
<main class="new-post-main">
    <a class="new-post-cancel" href="<?= URL ?>tutoring/profil">Annuler</a>
    <form action="profil.php" method="POST">
        <div class="new-post-title">
            Titre :
            <input class="new-post-title" type="text">
        </div>
        <div class="new-post-content">
            Description : 
            <textarea class="new-post-desc"></textarea>
        </div>
        <div class="new-post-tags">
            Tags : <input type="text" name="tags">
        </div>
        <input class="new-post-confirm" type="submit" value="Valider">
    </form>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php" 
?>

 