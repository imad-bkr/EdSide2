<?php ob_start(); ?>
<main class="edit-post-main">
    <a class="edit-post-cancel" href="<?= URL ?>tutoring/profil">Retour au profil</a>
    <form action="#" method="POST">
        <div class="edit-post-title">
            Titre :
            <input class="edit-post-title" type="text" name="title" value="<?= $annonce['titre'] ?>">
        </div>
        <div class="edit-post-content">
            Description : 
            <textarea class="edit-post-desc" name="desc" ><?= $annonce['description'] ?></textarea>
        </div>
        <div class="edit-post-tags">
            Tags : <input type="text" name="tags" value="<?= $annonce['tag'] ?>">
        </div>
        <input class="edit-post-confirm" type="submit" name="edit" value="Valider">
        <input id="deleteBtn" class="edit-post-delete" type="submit" name="delete" value="Supprimer l'annonce">
    </form>
    <?php if($msg !== "L'annonce a bien modifiée") {?>
        <div class="invalid-post"><?= $msg; ?></div>
    <?php } else { ?>
        <div class="valid-post"><?= $msg; ?></div>
    <?php } ?>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php" 
?>


 