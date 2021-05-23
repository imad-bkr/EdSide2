<?php
session_start();
require_once "controllers/backend.controller.php";
require_once "controllers/frontend.controller.php";
require_once "config/Securite.class.php";

try {
    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $page = Securite::secureHTML($_GET['page']);
        switch($page) {
            case "accueil": getPageAccueil();
            break;
            case "sign-in": getPageInscription();
            break;
            case "log-in": getPageConnexion();
            break;
            case "password_reset": getPagePasswordReset();
            break;
            case "tutoring/browse": getPageTutoringBrowse();
            break;
            case "tutoring/profil": getPageTutoringProfil();
            break;
            case "tutoring/edit-post": getPageTutoringEditPost();
            break;
            case "tutoring/view-post": getPageTutoringViewPost();
            break;
            case "error403": throw new Exception("Vous n'avez pas le droit d'accéder à ce dossier");
            break;
            case "error404": 
            default: throw new Exception("La page n'existe pas");
        }
    } else {
        getPageAccueil();
    }
} catch(Exception $e) {
    $title = "EdSide - 404";
    $desc = "Vous essayez d'accéder à une page qui n'existe pas";
    $css = "public/css/template.css";
    $errorMessage = $e->getMessage();
    require "views/commons/error.view.php"; 
}
