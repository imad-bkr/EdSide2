<?php 

function newUser($username, $email, $password, $promo, $groupe) {
    $bdd = connexionPDO();
    $req = "INSERT INTO utilisateurs
    (username, email, password, promo, groupe) VALUES
    (:username, :email, :password, :promo, :groupe)";
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":username", $username, PDO::PARAM_STR);
    $stmt->bindValue(":email", $email, PDO::PARAM_STR);
    $stmt->bindValue(":password", $password, PDO::PARAM_STR);
    $stmt->bindValue(":promo", $promo, PDO::PARAM_STR);
    $stmt->bindValue(":groupe", $groupe, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
}

function getPasswordUser($username) {
    $bdd = connexionPDO();
    $req = "SELECT * FROM utilisateurs
    WHERE username = :username";
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":username", $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user === false) {
        throw new Exception("Nom d'utilisateur ou mot de passe invalide");
    }
    $stmt->closeCursor();
    return $user;
}

function isConnexionValid($username, $password) {
    try {
        $user = getPasswordUser($username);
        return (password_verify($password, $user['password']));
    } catch(Exception $e) {};
}

function getIdUser($username) {
    $bdd = connexionPDO();
    $req = "SELECT * FROM utilisateurs
    WHERE username = :username";
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":username", $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $user;
}

function UdpateUser($email, $password, $promo, $groupe, $idUser) {
    $bdd = connexionPDO();
    $req = "UPDATE utilisateurs
    SET email = :email, password = :password, promo = :promo, groupe = :groupe
    WHERE id_user = :id";
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":email", $email, PDO::PARAM_STR);
    $stmt->bindValue(":password", $password, PDO::PARAM_STR);
    $stmt->bindValue(":promo", $promo, PDO::PARAM_STR);
    $stmt->bindValue(":groupe", $groupe, PDO::PARAM_STR);
    $stmt->bindValue(":id", $idUser, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
}

function insertDescToUserInDB($description, $idUser) {
    $bdd = connexionPDO();
    $req = "UPDATE utilisateurs
    SET description_profil = :desc
    WHERE id_user = :id";
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":desc", $description, PDO::PARAM_STR);
    $stmt->bindValue(":id", $idUser, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
}