<?php ob_start(); ?>
<main class="settings-main">
    <a class="settings-cancel" href="<?= URL ?>tutoring/browse">Annuler</a> <!--//: tmp link  -->
    <form class="settings-form" action="<?= URL ?>tutoring/browse" method="post"> <!--//: tmp link  -->
        <input class="setting-form-input" type="email">
        <input class="setting-form-input" type="password">
        <input class="setting-form-input" type="password">
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
        <input class="settings-form-submit" type="submit">
    </form>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php"
?>