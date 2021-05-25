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
                            <?php foreach ($eventsForDay as $event) : ?>
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
        <h1>Groupes</h1>
        <div class="calendar-groups-list">
            <?php foreach ($groupes as $groupe) : ?>
                <div class="calendar-group">
                    <p class="calendar-group-name"><span>Nom : </span><?= $groupe['nom'] ?></p>
                    <p class="calendar-group-code"><span>Code : </span><?= $groupe['code'] ?></p>
                    <div class="calendar-group-edit" title="modifier groupe"><?php echo file_get_contents("public/icons/edit.svg"); ?></div>
                    <form action="" method="POST">
                        <button class="calendar-group-leave" type="submit" title="quitter groupe"><?php echo file_get_contents("public/icons/arrow-right.svg"); ?></button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="calendar-button-box">
            <button class="calendar-new-group-button button">Créer un groupe</button>
            <button class="calendar-join-group-button button">Rejoindre un groupe</button>
            <a class="calendar-add-event button" href="<?= URL ?>calendar/new-event">Ajouter un évènement</a>
        </div>
        <?php if ($group === "Ce groupe n'existe pas") : ?>
            <span class="calendar-group-alert alert alert-danger"><?= $group ?></span>
        <?php endif; ?>
        <?php if ($group === "Vous avez bien été ajouté au groupe") : ?>
            <span class="calendar-group-alert alert alert-success"><?= $group ?></span>
        <?php endif; ?>
    </div>
</main>
<form class="calendar-new-group hidden" action="" method="post">
    <input class="calendar-new-group-name" type="text" name="nom_groupe" placeholder="Nom du groupe">
    <input class="calendar-new-group-confirm button" type="submit" name="creer_groupe" value="Créer">
    <input class="calendar-new-group-cancel button" type="button" value="Annuler">
</form>
<form class="calendar-join-group hidden" action="" method="post">
    <input class="calendar-join-group-name" type="text" name="code_groupe" placeholder="Code du groupe">
    <input class="calendar-join-group-confirm button" type="submit" name="rejoindre_groupe" value="Rejoindre">
    <input class="calendar-join-group-cancel button" type="button" value="Annuler">
</form>
<script src="<?= URL ?>public/js/calendar.js"></script>

<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>