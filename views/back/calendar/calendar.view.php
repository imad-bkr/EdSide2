<?php ob_start(); ?>
<main class="calendar-main">
    <div class="calendar-box">
        <?php if ($created != "") : ?>
            <span><?= $created ?></span>
        <?php endif; ?>
        <?php if ($modified != "") : ?>
            <span><?= $modified ?></span>
        <?php endif; ?>
        <?php if ($deleted != "") : ?>
            <span><?= $deleted ?></span>
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
        <a class="calendar-add-event" href="<?= URL ?>calendar/new-event">Ajouter évènement</a>
        <a class="calendar-add-group" href="">Créer groupe</a>
    </div>
</main>
<?php
$content = ob_get_clean();
require "views/commons/template.php"
?>