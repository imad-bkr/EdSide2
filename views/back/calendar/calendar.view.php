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
        <?php if ($leaved != "") : ?>
            <span class="alert calendar-alert alert-danger"><?= $leaved ?></span>
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
                                <?php foreach ($groupes as $groupe) :
                                    if ($event['id_groupe'] === $groupe['id_groupe']) : ?>
                                        <div id="events" class="calendar-event">
                                            <?= (new DateTime($event['date_debut']))->format('H:i') ?> - <a title="<?= $event['description'] ?>" href="<?= URL ?>calendar/event&id=<?= $event['id_evenement'] ?>"><?= Securite::secureHTML(($event['nom'])); ?></a>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
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
                    <!-- <div class="calendar-group-edit" title="modifier groupe"><?php echo file_get_contents("public/icons/edit.svg"); ?></div> -->
                    <form action="" method="POST">
                        <button value="<?= $groupe['id_groupe'] ?>" name="leave" class="calendar-group-leave" type="submit" title="quitter le groupe"><?php echo file_get_contents("public/icons/arrow-right.svg"); ?></button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="calendar-button-box">
            <button class="calendar-new-group-button button">Créer un groupe</button>
            <button class="calendar-join-group-button button">Rejoindre un groupe</button>
            <button class="calendar-new-event-button button">Ajouter un évènement</button>
        </div>
        <?php if ($group === "Ce groupe n'existe pas") : ?>
            <span class="calendar-group-alert alert alert-danger"><?= $group ?></span>
        <?php endif; ?>
        <?php if ($group === "Vous avez bien été ajouté au groupe") : ?>
            <span class="calendar-group-alert alert alert-success"><?= $group ?></span>
        <?php endif; ?>
    </div>
</main>
<!--//* new group -->
<form class="calendar-new-group hidden" action="" method="post">
    <input class="calendar-new-group-name" type="text" name="nom_groupe" placeholder="Nom du groupe">
    <input class="calendar-new-group-confirm button" type="submit" name="creer_groupe" value="Créer">
    <input class="calendar-new-group-cancel button" type="button" value="Annuler">
</form>
<!--//* join group -->
<form class="calendar-join-group hidden" action="" method="post">
    <input class="calendar-join-group-name" type="text" name="code_groupe" placeholder="Code du groupe">
    <input class="calendar-join-group-confirm button" type="submit" name="rejoindre_groupe" value="Rejoindre">
    <input class="calendar-join-group-cancel button" type="button" value="Annuler">
</form>
<!--//* New event -->
<form class="calendar-new-event form hidden" action="" method="POST">
    <h1 class="form-title">Ajouter un évènement</h1>
    <div class="form-field">
        <input class="form-input" id="name" type="text" required class="event-name" name="name" placeholder=" " value="<?= isset($data['name']) ? Securite::secureHTML($data['name']) : ''; ?>">
        <label class="form-label" for="name">Nom</label>
        <?php if (isset($errors['name'])) : ?>
            <small><?= $errors['name']; ?></small>
        <?php endif; ?>
    </div>
    <div class="form-field">
        <input class="form-input" id="date" type="date" required name="date" value="<?= isset($data['date']) ? Securite::secureHTML($data['date']) : ''; ?>">
        <label class="form-label" for="date">Date</label>
        <?php if (isset($errors['date'])) : ?>
            <small><?= $errors['date']; ?></small>
        <?php endif; ?>
    </div>
    <div class="form-field">
        <input class="form-input" id="start" type="time" required name="start" placeholder="HH:MM" value="<?= isset($data['start']) ? Securite::secureHTML($data['start']) : ''; ?>">
        <label class="form-label" for="start">Démarrage</label>
        <?php if (isset($errors['start'])) : ?>
            <small><?= $errors['start']; ?></small>
        <?php endif; ?>
    </div>
    <div class="form-field">
        <input class="form-input" id="end" type="time" required name="end" placeholder="HH:MM" value="<?= isset($data['end']) ? Securite::secureHTML($data['end']) : ''; ?>">
        <label class="form-label" for="end">Fin</label>
    </div>
    <div class="form-field-textarea">
        <textarea class="form-input" name="description" id="description"><?= isset($data['description']) ? Securite::secureHTML(($data['description'])) : ''; ?></textarea>
        <label class="form-label" for="description">Description</label>
    </div>
    <div class="form-field-select">
        <select class="form-input" name="groupe" id="groupe">
            <?php foreach ($groupes as $groupe) : ?>
                <option value="<?= $groupe['nom'] ?>"><?= $groupe['nom'] ?></option>
            <?php endforeach; ?>
        </select>
        <label class="form-label" for="groupe">Groupe associé</label>
    </div>
    <div class="form-buttons">
        <input class="button" type="submit" value="Ajouter l'évènement">
        <input class="calendar-new-event-cancel button" type="button" value="Annuler">
    </div>
</form>
<!--//todo edit event  -->

<script src="<?= URL ?>public/js/calendar.js"></script>

<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>