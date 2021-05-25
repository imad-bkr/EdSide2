<?php 

function getGroupesFromDB(){
    $bdd = connexionPDO();
    $req = "SELECT * FROM groupe";
    $stmt = $bdd->prepare($req);
    $stmt->execute();
    $groupes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $groupes;
}

function getGroupeFromDB($group){
    $bdd = connexionPDO();
    $req = "SELECT * FROM groupe
    WHERE nom = :nom";
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":nom", $group, PDO::PARAM_STR);
    $stmt->execute();
    $groupe = $stmt->fetch(\PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $groupe;
}

function InsertGroupIntoBD($nom_groupe, $code) {
    $bdd = connexionPDO();
    $req = "INSERT INTO groupe (nom, code)
    VALUES (:nom, :code)";
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":nom", $nom_groupe, PDO::PARAM_STR);
    $stmt->bindValue(":code", $code, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
}

function SetAppartenirIntoBD($id_groupe, $id_user) {
    $bdd = connexionPDO();
    $req = "INSERT INTO appartenir (id_user, id_groupe)
    VALUES (:id_user, :id_groupe)";
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":id_user", $id_user, PDO::PARAM_INT);
    $stmt->bindValue(":id_groupe", $id_groupe, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
}

function getIdGroupeFromDB($groupe){
    $bdd = connexionPDO();
    $req = "SELECT id_groupe FROM groupe
    WHERE nom = :nom";
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":nom", $groupe, PDO::PARAM_STR);
    $stmt->execute();
    $idGroupe = $stmt->fetch(\PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $idGroupe;
}

function getGroupesUserFromDB($idUser) {
    $bdd = connexionPDO();
    $req = "SELECT * FROM groupe g
    INNER JOIN appartenir a ON g.id_groupe = a.id_groupe  
    WHERE id_user = :id";
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":id", $idUser, PDO::PARAM_INT);
    $stmt->execute();
    $groupes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $groupes;
}

function findGroupByCodeDB($code_groupe) {
    $bdd = connexionPDO();
    $req = "SELECT * FROM groupe 
    WHERE code = :code";
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":code", $code_groupe, PDO::PARAM_STR);
    if ($stmt->execute()) {
        $groupe = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $groupe;
    } else {
        return false;
    }
}

function deleteFromAppartenirDB($idUser, $idGroup) {
    $bdd = connexionPDO();
    $req = "DELETE FROM appartenir
    WHERE id_user = :id_user AND id_groupe = :id_groupe";
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":id_user", $idUser, PDO::PARAM_INT);
    $stmt->bindValue(":id_groupe", $idGroup, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
}