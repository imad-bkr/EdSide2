<?php

function getAnnoncesFromBD() {
    $bdd = connexionPDO();
    $req = "SELECT * FROM annonces";
    $stmt = $bdd->prepare($req);
    $stmt->execute();
    $annonces = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $annonces;
}

function getAnnonceFromBD($idAnnonce) {
    $bdd = connexionPDO();
    $req = "SELECT * FROM annonces
    WHERE id_annonce = :id";
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":id", $idAnnonce, PDO::PARAM_INT);
    $stmt->execute();
    $annonce = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $annonce;
}

function addAnnonceDB($title, $desc, $tags, $idUser) {
    $bdd = connexionPDO();
    $req = "INSERT INTO annonces
    (titre, date, description, tag, id_user) 
    VALUES (:title, now(), :desc, :tags, :id)";
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":title", $title, PDO::PARAM_STR);
    $stmt->bindValue(":desc", $desc, PDO::PARAM_STR);
    $stmt->bindValue(":tags", $tags, PDO::PARAM_STR);
    $stmt->bindValue(":id", $idUser, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
}

function getMyAnnoncesFromBD($idUser) {
    $bdd = connexionPDO();
    $req = "SELECT * FROM annonces
    WHERE id_user = :id";
    $stmt = $bdd->prepare($req);
    $stmt->bindValue(":id", $idUser, PDO::PARAM_INT);
    $stmt->execute();
    $mesAnnonces = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $mesAnnonces;
}