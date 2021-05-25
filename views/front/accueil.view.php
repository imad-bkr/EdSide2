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
    <header class="header">
        <img src="public/img/flag.png" alt="language">
        <p class="log-in"><a href="log-in">Connexion</a> | <a href="sign-in">Inscription</a></p>
    </header>
    <main class="main">
        <section class="presentation">
            <img class="logo" src="public/img/logo.png" alt="Edside">
            <div class="edside-presentation">
                <h1>Edside, get better organized</h1>
                <p>Edside est une plateforme de gestion de cours créée par des étudiants de l'EFREI pour des étudiants de l'EFREI.<br>Vous y trouverez des outils permettant une meilleure organisation de votre scolarité.</p>
            </div>
        </section>
        <section class="info-calendar">
            <img class="section-img" src="public/tmp/calendrier.PNG" alt="calendar">
            <div class="section-text">
                <h2 class="section-title">CALENDRIER</h2>
                <p>calendrier synchronisé qui permetaux utilisateursindividuellement, mais aussi en groupe,de visualiser chronologiquement des évènementsprévus au préalable. La synchronisation sert à tenir tous les membres d’un groupe informés en temps et en heure de toutes les informations relatives à un évènement</p>
            </div>
        </section>
        <section class="info-simulator">
            <div class="section-text">
                <h2 class="section-title">SIMULATEUR</h2>
                <p>Plus tard, Edside proposera également un simulateur de notes permettant aux étudiants de se situer à tout moment de leur scolarité</p>
            </div>
            <div class="coming-soon">Coming soon</div>
        </section>
        <section class="info-tutoring">
            <img class="section-img" src="public/tmp/parrainage.PNG" alt="tutoring">
            <div class="section-text">
                <h2 class="section-title">PARRAINAGE</h2>
                <p>Edside propose un système de parrainage permettant aux étudiants de parrainer d’autres étudiants, mais aussi permettant aux étudiants en recherche de parrains de trouver un parrain correspondant à leurs attentes. Ceci grâce à divers outils tels que les annonces, les tags ou encore les recherches ciblées</p>
            </div>
        </section>
    </main>
    <footer class="footer">
        <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>
    </footer>
</body>

</html>