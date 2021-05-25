<?php ob_start(); ?>
<main class="new-event-main">
    <a class="link-top-left" href="<?= URL ?>calendar">Annuler</a>
    <?php if (!empty($errors)) : ?>
        <div class="invalid-inputs">
            Merci de corriger vos erreurs
        </div>
    <?php endif; ?>

    <form class="form" action="" method="POST">
        <h1 class="form-title">Ajouter un évènement</h1>
        <div class="form-field">
            <input id="name" class="form-input" type="text" required class="event-name" name="name" placeholder="" value="<?= isset($data['name']) ? Securite::secureHTML($data['name']) : ''; ?>">
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
        <input class="button" type="submit" value="Ajouter l'évènement">
    </form>
</main>
<?php
$content = ob_get_clean();
require "views/commons/template.php"
?>