<?php ob_start(); ?>
<main class="settings-main">
    <a class="link-top-left" href="<?= URL ?>calendar">Annuler</a>
    <form class="form" action="#" method="POST">
        <div class="form-field">
            <input class="form-input" name="email" type="email" id="email" placeholder=" ">
            <label class="form-label" for="email">Email :</label>
        </div>
        <div class="form-field">
            <input class="form-input" class="setting-form-input" type="password" id="pw" name="password" placeholder=" ">
            <label class="form-label" for="pw">Nouveau mot de passe :</label>
        </div>
        <div class="form-field">
            <input class="form-input" class="setting-form-input" type="password" id="confirm-pw" name="c_password" placeholder=" ">
            <label class="form-label" for="confirm-pw">Confirmer votre mot de passe :</label>
        </div>
        <div class="form-field-select">
            <select class="form-input" class="settings-form-select" name="promo">
                <option value="" disabled selected>Promo</option>
                <option value="L1">L1</option>
                <option value="L2">L2</option>
                <option value="L3">L3</option>
            </select>
        </div>
        <div class="form-field-select">
            <select class="form-input" class="settings-form-select" name="groupe">
                <option value="" disabled selected>Groupe</option>
                <option value="Classique">Classique</option>
                <option value="R">R</option>
                <option value="INT">INT</option>
                <option value="BN">BN</option>
            </select>
        </div>
        <div class="form-buttons">
            <input class="settings-form-submit button" type="submit" name="submit" value="Valider">
            <input class="settings-form-delete button" type="submit" name="delete" value="Supprimez votre compte">
        </div>
    </form>
</main>
<?php
$content = ob_get_clean();
require "views/commons/template.php"
?>