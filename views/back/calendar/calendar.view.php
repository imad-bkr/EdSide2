<?php ob_start(); ?>
<main class="calendar-main">
    <div class="calendar-box">
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
                        $date = (clone $start)->modify("+" . ($k + $i * 7) . " days")
                    ?>
                        <td class="<?= $month->withinMonth($date) ? '' : 'calendar-othermonth'; ?>">
                            <div class="calendar-day"><?= $date->format('d'); ?></div>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
    <div class="calendar-groups-box">
        <div class="calendar-groups-list">
            <div class="calendar-group">
                <input type="checkbox" checked>
                <label for="">groupe</label>
            </div>
            <div class="calendar-group">
                <input type="checkbox" checked>
                <label for="">groupe</label>
            </div>
            <div class="calendar-group">
                <input type="checkbox" checked>
                <label for="">groupe</label>
            </div>
        </div>
        <div class="calendar-button-box">
            <a class="calendar-add-event button" href="<?= URL ?>calendar/edit-event">Ajouter évènement</a>
            <button class="calendar-add-group button">Créer groupe</button>
            <button class="calendar-join-group-button button">Créer groupe</button>
        </div>
    </div>
</main>
<form class="calendar-new-group hidden" action="" method="post">
    <input class="calendar-new-group-name" type="text" placeholder="Nom du groupe">
    <input class="calendar-new-group-confirm button" type="submit" value="Créer groupe">
    <input class="calendar-new-group-cancel button" type="button" value="Annuler">
</form>
<form class="calendar-join-group hidden" action="" method="post">
    <input class="calendar-join-group-name" type="text" placeholder="Code du groupe">
    <input class="calendar-join-group-confirm button" type="submit" value="Créer groupe">
    <input class="calendar-join-group-cancel button" type="button" value="Annuler">
</form>
<script src="<?= URL ?>public/js/calendar.js"></script>
<?php
$content = ob_get_clean();
require "views/commons/template.php"
?>