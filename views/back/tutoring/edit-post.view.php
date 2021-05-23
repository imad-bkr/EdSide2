<?php ob_start(); ?>
<main class="edit-post-main">
    <a class="edit-post-cancel" href="<?= URL ?>tutoring/profil">Annuler</a>
    <form action="profil.php" method="post">
        <div class="edit-post-tags">
            <div class="post-tag">
                <input class="post-tag" type="checkbox">
                <label for="">tag</label>
            </div>
            <div class="post-tag">
                <input class="post-tag" type="checkbox">
                <label for="">tag</label>
            </div>
            <div class="post-tag">
                <input class="post-tag" type="checkbox">
                <label for="">tag</label>
            </div>
            <div class="post-tag">
                <input class="post-tag" type="checkbox">
                <label for="">tag</label>
            </div>
        </div>
        <div class="edit-post-content">
            Titre :
            <input class="edit-post-title" type="text">
            Description : 
            <textarea class="edit-post-desc"></textarea>
        </div>
        <input class="edit-post-confirm" type="submit" value="Valider">
    </form>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php" 
?>

 