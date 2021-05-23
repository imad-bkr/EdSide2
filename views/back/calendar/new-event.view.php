<?php ob_start(); ?>
<main class="new-event-main">
    <a class="new-event-cancel" href="<?= URL ?>calendar">Annuler</a>
    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        Merci de corriger vos erreurs
      </div>
    <?php endif; ?>

    <h1>Ajouter un évènement</h1>
    <form action="#" method="POST">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input id="name" type="text" required class="form-control" name="name" value="<?= isset($data['name']) ? Securite::secureHTML($data['name']) : ''; ?>">
                    <?php if (isset($errors['name'])): ?>
                        <small class="form-text text-muted"><?= $errors['name']; ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input id="date" type="date" required class="form-control" name="date" value="<?= isset($data['date']) ? Securite::secureHTML($data['date']) : ''; ?>">
                    <?php if (isset($errors['date'])): ?>
                        <small class="form-text text-muted"><?= $errors['date']; ?></small>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="start">Démarrage</label>
                    <input id="start" type="time" required class="form-control" name="start" placeholder="HH:MM" value="<?= isset($data['start']) ? Securite::secureHTML($data['start']) : ''; ?>">
                    <?php if (isset($errors['start'])): ?>
                        <small class="form-text text-muted"><?= $errors['start']; ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="end">Fin</label>
                    <input id="end" type="time" required class="form-control" name="end" placeholder="HH:MM" value="<?= isset($data['end']) ? Securite::secureHTML($data['end']) : ''; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"><?= isset($data['description']) ? Securite::secureHTML(($data['description'])) : ''; ?></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Ajouter l'évènement</button>
        </div>
    </form>
</main>
<?php
    $content = ob_get_clean();
    require "views/commons/template.php" 
?>

 