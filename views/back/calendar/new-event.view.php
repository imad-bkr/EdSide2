<?php ob_start(); ?>
<main class="new-event-main">
    <a class="new-event-cancel" href="<?= URL ?>calendar">Annuler</a>
    <?php if (!empty($errors)): ?>
      <div class="invalid-inputs">
        Merci de corriger vos erreurs
      </div>
    <?php endif; ?>

    <h1>Ajouter un évènement</h1>
    <form action="#" method="POST">
        <div>
            <label for="name">Nom</label>
            <input id="name" type="text" required class="event-name" name="name" value="<?= isset($data['name']) ? Securite::secureHTML($data['name']) : ''; ?>">
            <?php if (isset($errors['name'])): ?>
                <small><?= $errors['name']; ?></small>
            <?php endif; ?>
        </div>
        <div>
            <label for="date">Date</label>
            <input id="date" type="date" required name="date" value="<?= isset($data['date']) ? Securite::secureHTML($data['date']) : ''; ?>">
            <?php if (isset($errors['date'])): ?>
                <small><?= $errors['date']; ?></small>
            <?php endif; ?>
        </div>
        <div>
            <label for="start">Démarrage</label>
            <input id="start" type="time" required name="start" placeholder="HH:MM" value="<?= isset($data['start']) ? Securite::secureHTML($data['start']) : ''; ?>">
            <?php if (isset($errors['start'])): ?>
                <small><?= $errors['start']; ?></small>
            <?php endif; ?>
        </div>
        <div>
            <label for="end">Fin</label>
            <input id="end" type="time" required name="end" placeholder="HH:MM" value="<?= isset($data['end']) ? Securite::secureHTML($data['end']) : ''; ?>">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description"><?= isset($data['description']) ? Securite::secureHTML(($data['description'])) : ''; ?></textarea>
        </div>
        <div>
        <label for="groupe">Groupe associé</label>
        <select name="groupe" id="groupe">
            <?php foreach($groupes as $groupe) : ?>
                <option value="<?= $groupe['nom']?>"><?= $groupe['nom'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div>
            <button>Ajouter l'évènement</button>
        </div>
    </form>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php" 
?>

 