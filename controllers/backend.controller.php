<?php 

require_once "models/user.dao.php";
require_once "config/config.php";

/* AUTH */

function getPageConnexion() {
    $title = "EdSide - Connexion";
    $desc = "Page de connexion à EdSide";
    $css = "public/css/auth.css";

    if(Securite::verificationAccess()) {
        if($_COOKIE[COOKIE_PROTECT] === $_SESSION[COOKIE_PROTECT]) {
            Securite::generateCookiePassword();
            header("Location: tutoring/browse");
            exit();
        } else {
            session_destroy();
            throw new Exception("Vous n'avez pas le droit d'être là!");
        }
    }
        
    $alert = "";
    if(isset($_POST['username']) && !empty($_POST['username'])
    && isset($_POST['password']) && !empty($_POST['password'])) {
        $username = Securite::secureHTML($_POST['username']);
        $password = Securite::secureHTML($_POST['password']);
        if (isConnexionValid($username, $password)) {
            $_SESSION['access'] = "user";
            $_SESSION['user'] = $username;
            Securite::generateCookiePassword();
            header("Location: tutoring/browse");
            exit();
        } else {
           $alert = "Nom d'utilisateur ou mot de passe invalide";
        }
    } 

    require_once "views/back/auth/log-in.view.php";
}

/* SETTINGS */

function getPageSettings() {
    if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "true") {
        session_destroy();
        header("Location:".URL."accueil");
    }   

    if(Securite::verificationAccess()) {
        require_once "models/user.dao.php";
        $title = "EdSide - Paramètres du compte";
        $desc = "Cette page vous permet de modifier vos paramètres utilisateur";
        $curr = "";
        $css = "public/css/template.css";

        require_once "views/back/settings/settings.view.php";
    } else {
        throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
}

/* SIMULATOR */

function getPageSimulator() {
    if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "true") {
        session_destroy();
        header("Location:".URL."accueil");
    }   

    if(Securite::verificationAccess()) {
        require_once "models/simulator.dao.php";
        $title = "EdSide - Simulateur de notes";
        $desc = "Simulez vos notes pour savoir si vous validez votre année ou pas";
        $curr = "simulator";
        $css = "public/css/template.css";

        require_once "views/back/simulator/simulator.view.php";
    } else {
        throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
}

/* CALENDAR */

function getPageCalendar() {
    if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "true") {
        session_destroy();
        header("Location:".URL."accueil");
    }   

    if(Securite::verificationAccess()) {
        require_once "models/calendar.dao.php";
        require 'models/Date/Month.php';

        $month = new App\Date\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
        $start = $month->getStartingDay();
        $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
        $weeks = $month->getWeeks();
        $end = (clone $start)->modify('+' . (6 + 7 * ($weeks -1)) . ' days');
        
        $title = "EdSide - Calendrier";
        $desc = "Organisez vos journée grâce au calendrier et au système de groupe de EdSide";
        $curr = "calendar";
        $css = "public/css/template.css";

        require_once "views/back/calendar/calendar.view.php";
    } else {
        throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
}

/* TUTORING */ 

function getPageTutoringBrowse() {
    if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "true") {
        session_destroy();
        header("Location:".URL."accueil");
    }

    if(Securite::verificationAccess()) {
        require_once "models/tutoring.dao.php";
        $annonces = getAnnoncesFromBD();
        $title = "EdSide - Les annonces";
        $desc = "Cette page vous permet de chercher un parrain ou un filleul!";
        $curr = "tutoring";
        $css = "public/css/template.css";

        require_once "views/back/tutoring/browse.view.php";
    } else {
        throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
}

function getPageTutoringViewPost() {
    if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "true") {
        session_destroy();
        header("Location:". URL ."accueil");
    }   
    if(Securite::verificationAccess()) {
        require_once "models/tutoring.dao.php";

        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $idAnnonce = Securite::secureHTML($_GET['id']);
            $annonce = getAnnonceFromBD($idAnnonce);
        }

        $title = "EdSide - Annonce";
        $desc = "Annonce";
        $curr = "tutoring";
        $css = "public/css/template.css";

        require_once "views/back/tutoring/view-post.view.php";
    } else {
        throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
}

function getPageTutoringProfil() {
    if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "true") {
        session_destroy();
        header("Location:". URL ."accueil");
    }   
    if(Securite::verificationAccess()) {
        require_once "models/user.dao.php";
        require_once "models/tutoring.dao.php";

        $user = getIdUser($_SESSION['user']);
        $mesAnnonces = getMyAnnoncesFromBD($user['id_user']);

        $title = "EdSide - Profil parrainage";
        $desc = "Voici votre espace parrainage, créez une annonce pour commencer!";
        $curr = "tutoring";
        $css = "public/css/template.css";

        require_once "views/back/tutoring/profil.view.php";
    } else {
        throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
}

function getPageTutoringNewPost() {
    if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "true") {
        session_destroy();
        header("Location:". URL ."accueil");
    }   
    if(Securite::verificationAccess()) {
        require_once "models/user.dao.php";
        require_once "models/tutoring.dao.php";

        $msg = "";
        if(isset($_POST['submit']) && !empty($_POST['submit'])) {
            if(isset($_POST['title']) && !empty($_POST['title'])
            && isset($_POST['desc']) && !empty($_POST['desc'])
            && isset($_POST['tags']) && !empty($_POST['tags'])) {
                $title = Securite::secureHTML($_POST['title']);
                $desc = Securite::secureHTML($_POST['desc']);
                $tags = Securite::secureHTML($_POST['tags']);
                $user = getIdUser($_SESSION['user']);
                addAnnonceDB($title, $desc, $tags, $user['id_user']);
                header("Location:" . URL . "tutoring/profil");
            } else {
                $msg = "Veuillez remplir les champs manquants";
            }
        }

        $title = "EdSide - Nouvelle annonce";
        $desc = "Créez votre annonce!";
        $curr = "tutoring";
        $css = "public/css/template.css";

        require_once "views/back/tutoring/new-post.view.php";
    } else {
        throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
}

function getPageTutoringEditPost() {
    if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "true") {
        session_destroy();
        header("Location:". URL ."accueil");
    }   
    if(Securite::verificationAccess()) {
        require_once "models/tutoring.dao.php";

        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $idAnnonce = Securite::secureHTML($_GET['id']);
            $annonce = getAnnonceFromBD($idAnnonce);
        }

        $msg = "";
        if(isset($_POST['edit']) && !empty($_POST['edit'])) {
            if(isset($_POST['title']) && !empty($_POST['title'])
            && isset($_POST['desc']) && !empty($_POST['desc'])
            && isset($_POST['tags']) && !empty($_POST['tags'])) {
                $title = Securite::secureHTML($_POST['title']);
                $desc = Securite::secureHTML($_POST['desc']);
                $tags = Securite::secureHTML($_POST['tags']);
                UpdateAnnonceDB($title, $desc, $tags, $idAnnonce);
                $annonce = getAnnonceFromBD($idAnnonce);
                header("Location:" . URL . "tutoring/profil");
            } else {
                $msg = "Veuillez remplir les champs manquants";
            }
        }
        
        if (isset($_POST['delete']) && !empty($_POST['delete'])) {
            deleteAnnonceFromDB($idAnnonce);
            header("Location:" . URL . "tutoring/profil");
        }

        $title = "EdSide - Editer l'annonce";
        $desc = "Editez votre annonce";
        $curr = "tutoring";
        $css = "public/css/template.css";

        require_once "views/back/tutoring/edit-post.view.php";
    } else {
        throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
}

