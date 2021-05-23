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