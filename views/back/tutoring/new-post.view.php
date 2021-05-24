<?php ob_start(); ?>
<main class="new-post-main">
    <a class="new-post-cancel" href="<?= URL ?>tutoring/profil">Annuler</a>
    <form action="" method="POST">
        <div class="new-post-title">
            Titre :
            <input class="new-post-title" type="text" name="title">
        </div>
        <div class="new-post-content">
            Description : 
            <textarea class="new-post-desc" name="desc"></textarea>
        </div>
        <div class="new-post-tags">
            Tags : <input type="text" name="tags">
        </div>
        <input class="new-post-confirm" type="submit" name="submit" value="Valider">
    </form>
    <?php if($msg !== "") : ?>
        <div class="invalid-post"><?= $msg; ?></div>
    <?php endif; ?>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php" 
?>

 