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

    $success = "";
    if (isset($_GET['success']) && !empty($_GET['success'])){
        $success = "Votre compte a bien été crée";
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

        if(isset($_POST['submit']) && !empty($_POST['submit'])) {
            $email = Securite::secureHTML($_POST['email']);

            if(isset($_POST['password']) && !empty($_POST['password'])
            && isset($_POST['c_password']) && !empty($_POST['c_password'])) {
                
            }

            //UpdateUser();
        }

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
        require 'models/Calendar/Month.php';
        require 'models/Calendar/Events.php';
        require_once "models/groups.dao.php";

        if(isset($_POST['creer_groupe']) && !empty($_POST['creer_groupe'])) {
            if (isset($_POST['nom_groupe']) && !empty($_POST['nom_groupe'])){
                $nom_groupe = Securite::secureHTML($_POST['nom_groupe']);
                $code_groupe = uniqid();
                InsertGroupIntoBD($nom_groupe, $code_groupe);
                $idGroupe = getIdGroupeFromDB($nom_groupe);
                $user = getIdUser($_SESSION['user']);
                $idUser = $user['id_user'];
                SetAppartenirIntoBD($idGroupe['id_groupe'], $idUser);
            }
        }

        $groupes = getGroupesFromDB();
        
        $bdd = connexionPDO();
        $events = new Calendar\Events($bdd);

        $month = new Calendar\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
        $start = $month->getStartingDay();
        $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
        $weeks = $month->getWeeks();
        $end = (clone $start)->modify('+' . (6 + 7 * ($weeks -1)) . ' days');
        
        $events =  $events->getEventsBetweenByDay($start, $end);

        $modified = "";
        if (isset($_GET['success']) && !empty($_GET['success'])){
            $modified = "L'évenement a bien été modifié";
        }

        $created = "";
        if (isset($_GET['created']) && !empty($_GET['created'])){
            $created = "L'évenement a bien été crée et ajouté au calendrier";
        }

        $deleted = "";
        if (isset($_GET['delete']) && !empty($_GET['delete'])){
            $deleted = "L'évenement a été supprimé";
        }
    
        $title = "EdSide - Calendrier";
        $desc = "Organisez vos journée grâce au calendrier et au système de groupe de EdSide";
        $curr = "calendar";
        $css = "public/css/template.css";

        require_once "views/back/calendar/calendar.view.php";
    } else {
        throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
}

function getPageCalendarEvent() {
    if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "true") {
        session_destroy();
        header("Location:".URL."accueil");
    }   

    if(Securite::verificationAccess()) {
        require_once "models/groups.dao.php";
        require 'models/Calendar/Events.php';
        require 'models/Calendar/EventValidator.php'; 

        $bdd = connexionPDO();
        $events = new Calendar\Events($bdd);

        if (!isset($_GET['id'])) {
            header('Location:'. URL . 'calendar');
        }
        

        try {
            $event = $events->find($_GET['id']);
        } catch (\Exception $e) {
            header('Location:'. URL . 'calendar');
        }

        $groupes = getGroupesFromDB();

        $data = [
            'name'        => $event->getName(),
            'date'        => $event->getStart()->format('Y-m-d'),
            'start'       => $event->getStart()->format('H:i'),
            'end'         => $event->getEnd()->format('H:i'),
            'description' => $event->getDescription(),
            'id_groupe'   => $event->getIdGroup()
        ];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $validator = new Calendar\EventValidator();
            $errors = $validator->validates($data);
            $group = Securite::secureHTML($_POST['groupe']);
            $idGrp = getGroupeFromDB($group);
            if (empty($errors)) {
                $events->hydrate($event, $data, $idGrp['id_groupe']);
                $events->update($event);
                $events->hydrate($event, $data, $idGrp['id_groupe']);
                header('Location:'.URL. 'calendar&success=1');
                exit();
            }
        }

        if(isset($_POST['delete']) && !empty($_POST['delete'])) {
            $events->delete($event);
            header("Location:".URL."calendar&delete=1");
        }

        
        $title = "EdSide - Evenement";
        $desc = "Evenement";
        $curr = "calendar";
        $css = "public/css/template.css";

        require_once "views/back/calendar/event.view.php";
    } else {
        throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
}

function getPageCalendarNewEvent() {
    if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "true") {
        session_destroy();
        header("Location:".URL."accueil");
    }

    if(Securite::verificationAccess()) {
        require_once "models/groups.dao.php";
        require 'models/Calendar/Events.php';
        require 'models/Calendar/Event.php';
        require 'models/Calendar/EventValidator.php'; 

        $groupes = getGroupesFromDB();

        $data = [
            'date'  => $_GET['date'] ?? date('Y-m-d'),
            'start' => date('H:i'),
            'end'   => date('H:i')
        ];
        $validator = new \Calendar\Validator($data);
        if (!$validator->validate('date', 'date')) {
            $data['date'] = date('Y-m-d');
        }
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $validator = new \Calendar\EventValidator();
            $errors = $validator->validates($_POST);
            $group = Securite::secureHTML($_POST['groupe']);
            $idGrp = getGroupeFromDB($group);
            if (empty($errors)) {
                $bdd = connexionPDO();
                $events = new \Calendar\Events($bdd);
                $event = $events->hydrate(new \Calendar\Event(), $data, $idGrp['id_groupe']);
                $events->create($event);
                header('Location:'.URL. 'calendar&created=1');
                exit();
            }
        }  
        
        $title = "EdSide - Nouvel évenement";
        $desc = "Créez un nouvel évenement";
        $curr = "calendar";
        $css = "public/css/template.css";

        require_once "views/back/calendar/new-event.view.php";
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
        $idUser = $user['id_user'];
        $mesAnnonces = getMyAnnoncesFromBD($idUser);

    if(isset($_POST['submit-desc']) && !empty($_POST['submit-desc'])) {
        $description = Securite::secureHTML($_POST['desc']);
        insertDescToUserInDB($description, $idUser);
        $user = getIdUser($_SESSION['user']);
    }

    if(isset($_POST['submit-contact']) && !empty($_POST['submit-contact'])) {
        $contact_info = Securite::secureHTML($_POST['contact-informations']);
        insertContactInfoToUserInDB($contact_info, $idUser);
        $user = getIdUser($_SESSION['user']);
    }

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

