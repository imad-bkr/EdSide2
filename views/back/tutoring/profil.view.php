<?php ob_start(); ?>
<main class="profil-main">
    <a class="back-to-posts" href="<?= URL ?>tutoring/browse">Retour aux annonces</a>
    <section class="profil-info">
        <h1 class="profil-name">John Doe</h1>
        <div class="profil-pic-box">
            <img class="profil-pic" src="<?= URL ?>public/img/profil-pic.png" alt="photo de profil">
            <input class="profil-pic-upload" type="file">
        </div>
        <div class="contact-info-box">
            <textarea class="contact-info" readonly="readonly">
                Téléphone: +33XXXXX
                Adresse e-mail: example@yahoo.fr
            </textarea>
            <div class="contact-info-edit"><?php echo file_get_contents("public/icons/edit.svg"); ?></div>
            <div class="contact-info-cancel hidden"><?php echo file_get_contents("public/icons/cross.svg"); ?></div>
            <div class="contact-info-validate hidden"><?php echo file_get_contents("public/icons/check.svg"); ?></div>
        </div>
        <div class="user-info-box">
            <textarea class="user-info" readonly="readonly">
                Classe
                Description
            </textarea>
            <div class="user-info-edit"><?php echo file_get_contents("public/icons/edit.svg"); ?></div>
            <div class="user-info-cancel hidden"><?php echo file_get_contents("public/icons/cross.svg"); ?></div>
            <div class="user-info-validate hidden"><?php echo file_get_contents("public/icons/check.svg"); ?></div>
        </div>
    </section>
    <section class="my-posts-box">
        <h2>Mes annonces</h2>
        <div class="my-posts">
        <?php foreach ($mesAnnonces as $annonce) : ?>
            <div class="my-post">
                <h3><?= $annonce['titre'] ?></h3>
                <p>Le <?php $date = date_create($annonce['date']); echo date_format($date, "Y/m/d"); ?></p>
                <p><?= $annonce['description'] ?></p>
                <span class="post-tag"><?= $annonce['tag'] ?></span>
                <a class="post-edit" href="<?= URL ?>tutoring/edit-post&id=<?= $annonce['id_annonce'] ?>"><?php echo file_get_contents("public/icons/edit.svg"); ?></a>
            </div>
        <?php endforeach; ?>
        </div>
        <a class="post-add" href="<?= URL?>tutoring/new-post">Ajouter une annonce</a>
    </section>
</main>
    <script src="<?= URL ?>public/js/tutoring/profil.js"></script>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php" 
?>