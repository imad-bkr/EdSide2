<?php ob_start(); ?>
<main class="settings-main">
    <a class="settings-cancel" href="<?= URL ?>tutoring/browse">Annuler</a>
    <form class="settings-form" action="#" method="POST"> 
        <div>
            <label for="email">Email :</label>
            <input class="setting-form-input" name="email" type="email" id="email" >
        </div>
        <div>
            <label for="pw">Nouveau mot de passe :</label>
            <input class="setting-form-input" type="password" id="pw" name="password">
            <label for="confirm-pw">Confirmer votre mot de passe :</label>
            <input class="setting-form-input" type="password" id="confirm-pw" name="c_password">
        </div>
        <div>
            <select class="settings-form-select" name="promo">
                <option value="" disabled selected>Promo</option>
                <option value="L1">L1</option>
                <option value="L2">L2</option>
                <option value="L3">L3</option>
            </select>
            <select class="settings-form-select" name="groupe">
                <option value="" disabled selected>Groupe</option>
                <option value="Classique">Classique</option>
                <option value="R">R</option>
                <option value="INT">INT</option>
                <option value="BN">BN</option>
            </select>
        </div>
        <div>
            <input class="settings-form-submit" type="submit" name="submit" value="Valider">
        </div>
        <div>
            <input class="settings-form-delete" type="submit" name="delete" value="Supprimez votre compte">
        </div>
    </form>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php"
?>