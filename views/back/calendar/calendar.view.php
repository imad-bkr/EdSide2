<?php ob_start(); ?>
<main class="calendar-main">
    <div class="calendar-box">
        <?php if ($created != "") : ?>
            <span class="alert calendar-alert alert-success"><?= $created ?></span>
        <?php endif; ?>
        <?php if ($modified != "") : ?>
            <span class="alert calendar-alert alert-success"><?= $modified ?></span>
        <?php endif; ?>
        <?php if ($deleted != "") : ?>
            <span class="alert calendar-alert alert-danger"><?= $deleted ?></span>
        <?php endif; ?>
        <div class="calendar-header">
            <a class="calendar-nav" href="<?= URL ?>calendar&month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>">&lt;</a>
            <h1 class="calendar-title"><?= $month->toString(); ?></h1>
            <a class="calendar-nav" href="<?= URL ?>calendar&month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>">&gt;</a>
        </div>
        <table class="calendar-table calendar-table--<?= $month->getWeeks(); ?>weeks">
            <tr>
                <?php foreach ($month->days as $k => $day) : ?>
                    <th>
                        <?= $day; ?>
                    </th>
                <?php endforeach; ?>
            </tr>
            <?php for ($i = 0; $i < $month->getWeeks(); $i++) : ?>
                <tr>
                    <?php
                    foreach ($month->days as $k => $day) :
                        $date = (clone $start)->modify("+" . ($k + $i * 7) . " days");
                        $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
                    ?>
                        <td class="<?= $month->withinMonth($date) ? '' : 'calendar-othermonth'; ?>">
                            <div class="calendar-day"><?= $date->format('d'); ?></div>
                            <?php foreach($eventsForDay as $event): ?>
                                <div id="events" class="calendar-event">
                                    <?= (new DateTime($event['date_debut']))->format('H:i') ?> - <a href="<?= URL ?>calendar/event&id=<?= $event['id_evenement'] ?>"><?= Securite::secureHTML(($event['nom'])); ?></a>
                                </div>
                            <?php endforeach; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
    <div class="calendar-groups-box">
        <div class="calendar-groups-list">
        <?php foreach($groupes as $groupe) : ?>
            <div class="calendar-group">
                <input class="checkbox" id="groupe" type="checkbox" checked>
                <label for="groupe"><?= $groupe['nom'] ?></label>
            </div>
        <?php endforeach; ?>
        </div>
        <div class="calendar-button-box">
            <a class="calendar-add-event button" href="<?= URL ?>calendar/new-event">Ajouter évènement</a>
            <button class="calendar-add-group button">Créer groupe</button>
            <button class="calendar-join-group-button button">Rejoindre groupe</button>
        </div>
    </div>
</main>
<form class="calendar-new-group hidden" action="" method="post">
    <input class="calendar-new-group-name" type="text" placeholder="Nom du groupe">
    <input class="calendar-new-group-confirm button" type="submit" value="Créer">
    <input class="calendar-new-group-cancel button" type="button" value="Annuler">
</form>
<form class="calendar-join-group hidden" action="" method="post">
    <input class="calendar-join-group-name" type="text" placeholder="Code du groupe">
    <input class="calendar-join-group-confirm button" type="submit" value="Rejoindre">
    <input class="calendar-join-group-cancel button" type="button" value="Annuler">
</form>
<script src="<?= URL ?>public/js/calendar.js"></script>

<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>