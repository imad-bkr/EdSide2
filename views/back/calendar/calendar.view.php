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
        <button class="calendar-add-event">Ajouter évènement</button>
        <button class="calendar-add-group">Ajouter groupe</button>
    </div>
</main>
<?php
$content = ob_get_clean();
require "views/commons/template.php"
?>