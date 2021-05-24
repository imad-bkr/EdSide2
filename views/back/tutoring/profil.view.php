<?php ob_start(); ?>
<main class="profil-main">
    <a class="back-to-posts" href="<?= URL ?>tutoring/browse">Retour aux annonces</a>
    <section class="profil-info">
        <h1 class="profil-name"><?php echo $_SESSION['user'];?></h1>
        <div class="profil-pic-box">
            <img class="profil-pic" src="<?= URL ?>public/img/profil-pic.png" alt="photo de profil">
            <input class="profil-pic-upload" type="file">
        </div>
        <form class="contact-info-box" action="" method="POST">
            <textarea placeholder="Informations de contact <?= "\n"?>(numéro de téléphone, adresse email...)" name="contact-informations" class="contact-info" readonly="readonly"><?php if($user['contact_info'] !== "") { echo $user['contact_info']; } else {echo ""; }?></textarea>
            <div class="contact-info-edit"><?php echo file_get_contents("public/icons/edit.svg"); ?></div>
            <div class="contact-info-cancel hidden"><?php echo file_get_contents("public/icons/cross.svg"); ?></div>
            <label class="contact-info-validate hidden">
                <input class="hidden" type="submit" name="submit-contact">
                <?php echo file_get_contents("public/icons/check.svg"); ?>
            </label>
        </form>
        <form class="user-info-box" action="" method="POST">
            <textarea placeholder="Description" name="desc" class="user-info" readonly="readonly"><?php if($user['description_profil'] !== "") { echo $user['description_profil']; } else {echo ""; }?></textarea>
            <div class="user-info-edit"><?php echo file_get_contents("public/icons/edit.svg"); ?></div>
            <div class="user-info-cancel hidden"><?php echo file_get_contents("public/icons/cross.svg"); ?></div>
            <label class="user-info-validate hidden">
                <input class="hidden" type="submit" name="submit-desc">
                <?php echo file_get_contents("public/icons/check.svg"); ?>
            </label>
        </form>
    </section>
    <section class="my-posts-box">
        <h2>Mes annonces</h2>
        <div class="my-posts">
            <?php foreach ($mesAnnonces as $annonce) : ?>
                <div class="my-post">
                    <h3><?= $annonce['titre'] ?></h3>
                    <p>Le <?php $date = date_create($annonce['date']);
                            echo date_format($date, "d/m/Y"); ?></p>
                    <p><?= $annonce['description'] ?></p>
                    <span class="post-tag"><?= $annonce['tag'] ?></span>
                    <a class="post-edit" href="<?= URL ?>tutoring/edit-post&id=<?= $annonce['id_annonce'] ?>"><?php echo file_get_contents("public/icons/edit.svg"); ?></a>
                </div>
            <?php endforeach; ?>
        </div>
        <a class="post-add button" href="<?= URL ?>tutoring/new-post">Ajouter une annonce</a>
    </section>
</main>
<script src="<?= URL ?>public/js/tutoring/profil.js"></script>
<?php
$content = ob_get_clean();
require "views/commons/template.php"
?>