<?php 
require_once "config/config.php";
require "models/pdo.php";

function getPageAccueil(){
    $title = "EdSide - Always by your side!";
    $desc = "Bienvenue sur EdSide! Ce site est un outil crée par des étudiants de l'EFREI,
    pour des étudiants de l'EFREI, afin de leur permettre une meilleure gestion de leur
    vie et de leur organisation scolaire";
    $css = "public/css/visitor.css";

    require_once "views/front/accueil.view.php";
}

function getPagePasswordReset() {
    $title = "EdSide - Mot de passe oublié?";
    $desc = "Page d'oubli du mot de passe'";
    $css = "public/css/auth.css";

    require_once "views/front/password_reset.view.php";
}

function getPageInscription() {
    $title = "EdSide - Inscription";
    $desc = "Page d'inscription à EdSide";
    $css = URL. "public/css/auth.css";
    $msg = "";
    if(isset($_POST['register'])) {
        if(isset($_POST['username']) && !empty($_POST['username'])
        && isset($_POST['email']) && !empty($_POST['email'])
        && isset($_POST['password']) && !empty($_POST['password'])
        && isset($_POST['c_password']) && !empty($_POST['c_password'])
        && ($_POST['c_password'] == $_POST['password'])
        && isset($_POST['promo']) && !empty($_POST['promo']) 
        && isset($_POST['groupe']) && !empty($_POST['groupe'])) {
            $username = Securite::secureHTML($_POST['username']);
            $email = Securite::secureHTML($_POST['email']);
            $hashed = password_hash(Securite::secureHTML($_POST['password']), PASSWORD_DEFAULT);
            $promo = Securite::secureHTML($_POST['promo']);
            $groupe = Securite::secureHTML($_POST['groupe']);
            /* ajout de l'utilisateur dans la bdd */
            newUser($username, $email, $hashed, $promo, $groupe);
            $msg = "Votre compte a bien été crée";
        } else if (isset($_POST['password']) && !empty($_POST['password'])
        && isset($_POST['c_password']) && !empty($_POST['c_password'])
        && $_POST['c_password'] != $_POST['password']) {
            $msg = "Votre mot de passe n'a pas été correctement resaisi";
        } else {
            $msg = "Veuillez remplir les champs manquants";
        }
    }
    
    require_once "views/front/sign-in.view.php";
}
