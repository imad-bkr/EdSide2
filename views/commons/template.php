<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $desc ?>">
    <title><?= $title ?></title>
    <link rel="stylesheet" href=<?= URL . $css ?>>
    <link rel="icon" href="<?= URL ?>public/img/favicon.ico" sizes="32x32">
</head>

<body>
    <header class="header">
        <a href="<?= URL ?>tutoring/browse"><img class="logo-mini" src="<?= URL ?>public/img/logo.png" alt="EdSide"></a>
        <div class="user"><?php echo $_SESSION['user']; ?></div>
        <ul class="user-menu hidden">
            <a href="<?= URL ?>settings">
                <li>Paramètres</li>
            </a>
            <a href="">
                <li>English</li>
            </a>
            <form method="POST" action="">
                <input type="hidden" name="deconnexion" value="true" />
                <input class="log-out" type="submit" value="Déconnexion" />
            </form>
        </ul>
    </header>
    <?php include("navbar.php"); ?>
    <?= $content ?>
    <footer class="footer">
        <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.
    </footer>
    <script src="<?= URL ?>public/js/layout.js"></script>
</body>

</html>