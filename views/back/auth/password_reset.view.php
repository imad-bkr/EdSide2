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
    <form class="form" action="" method="post">
        <a class="back" href="<?= URL ?>log-in">← Retour à la page de connexion</a>
        <h1 class="form-title">Reinitialiser votre mot de passe</h1>
        <p>Entrez l'adresse e-mail vérifiée de votre compte utilisateur et nous vous enverrons un lien de réinitialisation du mot de passe.</p>
        <input class="form-input" type="email" name="input-mail" placeholder="Adresse e-mail">
        <input class="form-submit" type="submit" value="Envoyer">
    </form>
</body>
</html>