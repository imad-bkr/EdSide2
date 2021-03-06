<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $desc ?>">
    <title><?= $title ?></title>
    <link rel="stylesheet" href=<?= $css ?>>
    <link rel="icon" href="public/img/favicon.ico" sizes="32x32"> 
</head>
<body>
    <?php ?>
    <form class="form" action="" method="POST">
        <a class="back" href="<?php URL ?>accueil">← Retour à l'accueil</a>
        <h1 class="form-title">Inscription</h1>
        <input class="form-input" type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input class="form-input" type="email" name="email" placeholder="Adresse e-mail" required>
        <input class="form-input" type="password" name="password" placeholder="Mot de passe" required>
        <input class="form-input" type="password" name="c_password" placeholder="Confirmer mot de passe" required>
        <select class="form-select" name="promo" required>
            <option value="" disabled selected>Promo</option>
            <option value="L1">L1</option>
            <option value="L2">L2</option>
            <option value="L3">L3</option>
        </select>
        <select class="form-select" name="groupe" required>
            <option value="" disabled selected>Groupe</option>
            <option value="Classique">Classique</option>
            <option value="R">R</option>
            <option value="INT">INT</option>
            <option value="BN">BN</option>
        </select>
        <div>
            <input class="form-submit" type="submit" name="register" value="S'inscrire">
            <a href="<?php URL?>log-in">Déjà inscrit ? Se connecter</a>
        </div>
        <?php if ($msg === "Veuillez remplir les champs manquants") { ?>
            <div class="alert alert-danger"><?= $msg ?></div>
        <?php } elseif ($msg === "Votre mot de passe n'a pas été correctement resaisi") { ?>
            <div class="alert alert-danger"><?= $msg ?></div>
        <?php }; ?>
    </form>
</body>
</html>