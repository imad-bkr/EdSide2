<?php ob_start(); ?>
<main>
    <div>
    <h1><?= $month->toString(); ?></h1>
        <div>
            <a href="<?= URL ?>calendar&month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-primary">&lt;</a>
            <a href="<?= URL ?>calendar&month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>" class="btn btn-primary">&gt;</a>
        </div>
    </div>
    <table class="calendar-table calendar-table--<?= $month->getWeeks(); ?>weeks">
        <?php for ($i = 0; $i < $month->getWeeks(); $i++): ?>
        <tr>
            <?php
            foreach($month->days as $k => $day):
                $date = (clone $start)->modify("+" . ($k + $i * 7) . " days")
                ?>
            <td class="<?= $month->withinMonth($date) ? '' : 'calendar-othermonth'; ?>">
            <?php if ($i === 0): ?>
                <div class="calendar-weekday"><?= $day; ?></div>
            <?php endif; ?>
            <div class="calendar-day"><?= $date->format('d'); ?></div>
            </td>
            <?php endforeach; ?>
        </tr>
        <?php endfor; ?>
    </table>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php" 
?>