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
        <img class="logo-mini" src="<?= URL ?>public/img/logo.png" alt="EdSide">
        <div class="user"><?php echo $_SESSION['user'];?></div>
        <ul class="user-menu hidden">
            <a href=""><li>Paramètres</li></a>
            <a href=""><li>English</li></a>
            <form method="POST" action="">
                <input type="hidden" name="deconnexion" value="true" />
                <input type="submit" value="Déconnexion" />
            </form>
        </ul>
    </header>
    <?php include("navbar.php"); ?>
    <?= $content ?>
    <footer class="footer">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur eligendi tempora corporis rem maiores architecto adipisci veritatis sunt aperiam, nemo exercitationem dignissimos dolor, iste assumenda explicabo dicta expedita autem temporibus.</footer>
    <script src="<?= URL ?>public/js/layout.js"></script>
</body>
</html>

