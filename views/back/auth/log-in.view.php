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
    <form class="form" action="" method="POST">
        <a class="back" href="<?= URL ?>accueil">← Retour à l'accueil</a>
        <h1 class="form-title">Connexion</h1>
        <input class="form-input" type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input class="form-input" type="password" name="password" placeholder="Mot de passe" required>
        <a class="text-right" href="password_reset">Mot de passe oublié ?</a>
        <input class="form-submit" type="submit" value="Se connecter">
        <a href="sign-in">Nouveau ? Créer un compte</a>
    </form>
    <?php if ($alert !== "") { ?>
        <div class="invalid-password"> 
            <?= $alert ?>
        </div>
    <?php } ?>
</body>
</html>