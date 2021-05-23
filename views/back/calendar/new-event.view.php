<?php ob_start(); ?>
<main class="new-event-main">
    <a class="new-event-cancel" href="<?= URL ?>calendar">Annuler</a>
    <form action="#" method="POST">
        <div class="new-event-name">
            Nom :
            <input class="new-event-name" type="text" name="name">
        </div>
        <div class="new-event-content">
            Description : 
            <textarea class="new-event-desc" name="desc"></textarea>
        </div>
        <div class="new-event-date">
            Date : 
            <input class="new-event-day" type="date" name="date">
            Démarrage :
            <input class="new-event-start" type="time" name="start">
            Fin :
            <input class="new-event-end" type="time" name="end">
           
        </div>
        <div class="new-event-group">
            Groupe associé : 
            <select name="group">
                <option value="1"></option>
            </select>
        </div>
        <input class="new-event-confirm" type="submit" name="submit" value="Créer nouvel évenement">
    </form>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php" 
?>

 