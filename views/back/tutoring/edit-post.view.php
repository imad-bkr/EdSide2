<?php ob_start(); ?>
<main class="edit-post-main">
    <a class="link-top-left" href="<?= URL ?>tutoring/profil">Retour au profil</a>
    <form class="form" action="#" method="POST">
        <h1 class="form-title">Nouvel annonce</h1>
        <div class="form-field">
            <input class="form-input" type="text" name="title" placeholder="" value="<?= $annonce['titre'] ?>">
            <label class="form-label">Titre</label>
        </div>
        <div class="form-field-textarea">
            <textarea class="form-input" name="desc" placeholder=""><?= $annonce['description'] ?></textarea>
            <label class="form-label">Description</label>
        </div>
        <div class="form-field">
            <input class="form-input" type="text" name="tags" placeholder="" value="<?= $annonce['tag'] ?>">
            <label class="form-label">Tags</label>
        </div>
        <div class="form-buttons">
            <input class="button" type="submit" name="edit" value="Valider">
            <input id="deleteBtn" class="button" type="submit" name="delete" value="Supprimer l'annonce">
        </div>
    </form>
    <?php if ($msg !== "L'annonce a bien modifiée") { ?>
        <div class="invalid-post"><?= $msg; ?></div>
    <?php } else { ?>
        <div class="valid-post"><?= $msg; ?></div>
    <?php } ?>
</main>
<?php
$content = ob_get_clean();
require "views/commons/template.php"
?>