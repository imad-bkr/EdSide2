<?php ob_start(); ?>
<main class="simulator-main">
    <form id="simulator-add-grade" class="simulator-form" method="POST">
        <h1 class="form-title">Nouvelle note</h1>
        <div class="form-field">
            <input class="form-input" type="text" name="ue" placeholder=" ">
            <label class="form-label">UE</label>
        </div>
        <div class="form-field">
            <input class="form-input" type="text" name="module" placeholder=" ">
            <label class="form-label">Module</label>
        </div>
        <div class="form-field">
            <input class="form-input" type="number" step="any" name="coef" placeholder=" ">
            <label class="form-label">Coefficient</label>
        </div>
        <div class="form-field">
            <input class="form-input" type="number" step="any" name="grade" placeholder=" ">
            <label class="form-label">Note</label>
        </div>
        <input class="button" type="submit" name="add" value="Ajouter note">
    </form>
    <table id="simulator-table" class="simulator-table hidden">
        <tr>
            <th>UE</th>
            <th>Module</th>
            <th>Coefficient</th>
            <th>Note</th>
        </tr>
    </table>
</main>
<script src="<?= URL ?>public/js/simulator.js"></script>
<?php
$content = ob_get_clean();
require "views/commons/template.php"
?>