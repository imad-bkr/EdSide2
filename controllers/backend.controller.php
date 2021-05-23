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

/*PARAMETERS */

/* SIMULATOR */

/* CALENDAR */

/* TUTORING */ 

function getPageTutoringBrowse() {
    if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "true") {
        session_destroy();
        header("Location:".URL."accueil");
    }   

    if(Securite::verificationAccess()) {
        require_once "models/tutoring.dao.php";
        $title = "EdSide - Les annonces";
        $desc = "Cette page vous permet de chercher un parrain ou un filleul!";
        $css = "public/css/template.css";

        require_once "views/back/tutoring/browse.view.php";
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
        require_once "models/tutoring.dao.php";

        $title = "EdSide - Profil parrainage";
        $desc = "Voici votre espace parrainage, créez une annonce pour commencer!";
        $css = "public/css/template.css";

        require_once "views/back/tutoring/profil.view.php";
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

        $title = "EdSide - Editer l'annonce";
        $desc = "Editez votre annonce";
        $css = "public/css/template.css";

        require_once "views/back/tutoring/edit-post.view.php";
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

        $title = "EdSide - Annonce";
        $desc = "Annonce";
        $css = "public/css/template.css";

        require_once "views/back/tutoring/view-post.view.php";
    } else {
        throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
}