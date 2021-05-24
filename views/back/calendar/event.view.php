<?php ob_start(); ?>
<main class="event-main">
    <h1><?= Securite::secureHTML(($event->getName())); ?></h1>

    <ul>
    <li>Date: <?= $event->getStart()->format('d/m/Y'); ?></li>
    <li>Heure de démarrage: <?= $event->getStart()->format('H:i'); ?></li>
    <li>Heure de fin: <?= $event->getEnd()->format('H:i'); ?></li>
    <li>
        Description:<br>
        <?= Securite::secureHTML($event->getDescription()); ?>
    </li>
    </ul>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php" 
?>

 