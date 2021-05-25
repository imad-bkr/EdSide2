<?php ob_start(); ?>
<main class="new-post-main">
    <a class="link-top-left" href="<?= URL ?>tutoring/profil">Annuler</a>
    <form class="form" action="" method="POST">
        <h1 class="form-title">Nouvelle annonce</h1>
        <div class="form-field">
            <input class="form-input" type="text" name="title" placeholder=" ">
            <label class="form-label">Titre</label>
        </div>
        <div class="form-field-textarea">
            <textarea class="form-input" name="desc" placeholder=" "></textarea>
            <label class="form-label">Description</label>
        </div>
        <div class="form-field">
            <input class="form-input" type="text" name="tags" placeholder=" ">
            <label class="form-label">Tags</label>
        </div>
        <input class="button" type="submit" name="submit" value="Valider">
    </form>
    <?php if ($msg !== "") : ?>
        <div class="invalid-post"><?= $msg; ?></div>
    <?php endif; ?>
</main>
<?php
$content = ob_get_clean();
require "views/commons/template.php"
?>